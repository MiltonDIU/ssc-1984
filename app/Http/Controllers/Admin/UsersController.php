<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\District;
use App\Models\Division;
use App\Models\Profession;
use App\Models\Role;
use App\Models\School;
use App\Models\Upazila;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['school', 'professions', 'division', 'district', 'upazila', 'roles'])->select(sprintf('%s.*', (new User())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? User::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('blood_group', function ($row) {
                return $row->blood_group ? $row->blood_group : '';
            });
            $table->editColumn('avatar', function ($row) {
                if ($photo = $row->avatar) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('school_name', function ($row) {
                return $row->school ? $row->school->name : '';
            });

            $table->editColumn('profession', function ($row) {
                $labels = [];
                foreach ($row->professions as $profession) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $profession->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('district_name', function ($row) {
                return $row->district ? $row->district->name : '';
            });

            $table->addColumn('upazila_name', function ($row) {
                return $row->upazila ? $row->upazila->name : '';
            });

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('id_ssc_bd', function ($row) {
                return $row->id_ssc_bd ? $row->id_ssc_bd : '';
            });
            $table->editColumn('id_ssc_district', function ($row) {
                return $row->id_ssc_district ? $row->id_ssc_district : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'avatar', 'school', 'profession', 'district', 'upazila', 'roles']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       // $schools = School::get();
        $professions = Profession::where('profession_parrent',0)->pluck('name', 'id');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('districts', 'divisions', 'professions', 'roles', 'upazilas'));
    }

    public function store(StoreUserRequest $request)
    {

        $totalUsers = User::where('id_ssc_bd','!=',null)->where('id_ssc_district','!=',null)->get()->count();
        $dis_user = User::where('district_id',$request->input('district_id'))->get()->count();

        $userData = $request->only(['name','email','mobile','telephone_number','gender','date_of_birth','blood_group','division_id',
            'district_id','upazila_id','password']);

        $userData['approved']=1;
        $userData['verified']=1;
        $userData['id_ssc_bd']=User::ID_SELECT['bd']+$totalUsers+1;
        $userData['id_ssc_district']=User::ID_SELECT['zila']+$dis_user+1;
        $userData['created_by_id'] = Auth::id();

        $school = School::where('division_id',$request->input('school_division_id'))
            ->where('district_id',$request->input('school_district_id'))
            ->where('upazila_id',$request->input('school_upazila_id'))
            ->where('id',$request->input('school_id'))
        ->first();


        if ($school){
            $userData['school_id']=$request->input('school_id');
        }else{
            $schools = $request->input(['school_division_id','school_district_id','school_upazila_id','school_id']);
            $school = School::create($schools);
            $userData['school_id']=$school->id;
        }

        $user = User::create($userData);

        $user->professions()->sync($request->input('professions', []));
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('avatar', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $address['division_id'] = $request->input('address_division_id');
        $address['district_id'] = $request->input('address_district_id');
        $address['upazila_id'] = $request->input('address_upazila_id');
        $address['area'] = $request->input('area');
        $address['user_id'] = $user->id;
        $address['created_by_id'] = Auth::id();
        $address['type_of_address'] = 'Present';
        Address::create($address);

        if(auth()->user()->roles()->where('title', 'Admin')->exists()){
            return redirect()->route('admin.users.index');
        }
       else{
           return redirect()->route('member.my-reference-member');
       }

    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $professions = Profession::where('profession_parrent',0)->pluck('name', 'id');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        $user->load('school', 'professions', 'division', 'district', 'upazila', 'roles');

        return view('admin.users.edit', compact('districts', 'divisions', 'professions', 'roles', 'upazilas', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
//        $user->update($request->all());
//        $user->professions()->sync($request->input('professions', []));
//        $user->roles()->sync($request->input('roles', []));
//

        $userData = $request->only(['name','email','mobile','telephone_number','gender','date_of_birth','blood_group','division_id',
            'district_id','upazila_id','password']);

        $school = School::where('division_id',$request->input('school_division_id'))
            ->where('district_id',$request->input('school_district_id'))
            ->where('upazila_id',$request->input('school_upazila_id'))
            ->where('id',$request->input('school_id'))
            ->first();


        if ($school){
            $userData['school_id']=$request->input('school_id');
        }else{
            $schools = $request->input(['school_division_id','school_district_id','school_upazila_id','school_id']);
            $school = School::create($schools);
            $userData['school_id']=$school->id;
        }

        $user->update($userData);
        $user->professions()->sync($request->input('professions', []));
        $user->roles()->sync($request->input('roles', []));

        if ($request->input('avatar', false)) {
            if (!$user->avatar || $request->input('avatar') !== $user->avatar->file_name) {
                if ($user->avatar) {
                    $user->avatar->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
            }
        } elseif ($user->avatar) {
            $user->avatar->delete();
        }

        $existingAddress = Address::where('user_id',$user->id)->where('type_of_address','Present')->first();
        $address['division_id'] = $request->input('address_division_id');
        $address['district_id'] = $request->input('address_district_id');
        $address['upazila_id'] = $request->input('address_upazila_id');
        $address['area'] = $request->input('area');
        $address['user_id'] = $user->id;
        $address['created_by_id'] = $existingAddress?$existingAddress->created_by_id:Auth::id();
        $address['type_of_address'] = 'Present';
    if ($existingAddress){
    $existingAddress->update($address);
    }else{
    Address::create($address);
}

        if(auth()->user()->roles()->where('title', 'Admin')->exists()){
            return redirect()->route('admin.users.index');
        }
        else{
            return redirect()->route('member.my-reference-member');
        }
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('school', 'professions', 'division', 'district', 'upazila', 'roles', 'userAddresses', 'userEvents');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
