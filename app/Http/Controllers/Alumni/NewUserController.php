<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\District;
use App\Models\Division;
use App\Models\Profession;
use App\Models\Role;
use App\Models\School;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use DB;

class NewUserController extends Controller
{
    use MediaUploadingTrait;

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

//        if(auth()->user()->roles()->where('title', 'Admin')->exists()){
//            return redirect()->route('admin.users.index');
//        }
//        else{
//            return redirect()->route('member.my-reference-member');
//        }
        return redirect()->route('member.my-reference-member')->with('message','New User Create Successfully');
    }

    public function update(UpdateUserRequest $request,$id )
    {

       $user  = User::findOrFail($id);

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

//        if(auth()->user()->roles()->where('title', 'Admin')->exists()){
//            return redirect()->route('admin.users.index');
//        }
//        else{
//            return redirect()->route('member.my-reference-member');
//        }
        return redirect()->route('member.my-reference-member')->with('message','Profile Update Successfully');
    }

}
