<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Profession;
use App\Models\Role;
use App\Models\School;
use App\Models\State;
use App\Models\Upazila;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use App\Models\Spouse;
use Auth;
use DB;
use function Composer\Autoload\includeFile;

class DashboardController extends Controller
{
    use MediaUploadingTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function cardDownload(){
        $events = Event::where('is_active', '1')->where('event_date', '>', date('Y-m-d', strtotime(Carbon::now())))->get();
        $total_users = count(User::where('id_ssc_bd', '!=', null)->where('id_ssc_district', '!=', null)->get());
        return view('member.card',compact('events','total_users'));
    }
    public function settings()
    {
        abort_if(Gate::denies('member_settings'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('member.settings');
    }

    public function settingsUpdate(Request $request)
    {
        abort_if(Gate::denies('member_settings'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::findorFail(auth()->id());
        $user->update($request->all());
        return redirect()->route('member.settings')->with('message', __('Update successfully'));
    }

    public function index()
    {
        abort_if(Gate::denies('member_dashboard'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::where('is_active', '1')->where('event_date', '>', date('Y-m-d', strtotime(Carbon::now())))->get();
        $total_users = count(User::where('id_ssc_bd', '!=', null)->where('id_ssc_district', '!=', null)->get());
        return view('member.dashboard', compact('events', 'total_users'));
    }

    public function batchMate()
    {
        abort_if(Gate::denies('member_batch_mate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'admin');
        })->where('approved', '1')->where('verified', '1')->paginate(20);

        return view('member.batch-mate', compact('users'));
    }

    public function batchMateProfile($id, $name)
    {
        abort_if(Gate::denies('member_batch_mate_profile'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::findOrFail($id);
        return view('member.batch-mate-profile', compact('user'));
    }

    public function schools()
    {
        abort_if(Gate::denies('member_schools'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $schools = School::where('is_approve', '1')->paginate(20);
        return view('member.schools', compact('schools'));
    }

    public function schoolProfile($id, $name)
    {
        abort_if(Gate::denies('member_school_profile'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $school = School::findOrFail($id);
        return view('member.schoolProfile', compact('school'));
    }

    public function events()
    {
        abort_if(Gate::denies('member_events'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $events = Event::where('is_active', '1')->where('event_date', '>', date('Y-m-d', strtotime(Carbon::now())))->get();
        return view('member.events', compact('events'));
    }

    public function eventDetails($id, $name)
    {
        abort_if(Gate::denies('member_events_details'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $event = Event::findOrFail($id);
        return view('member.events-details', compact('event'));
    }

    public function eventConfirm($id)
    {
        abort_if(Gate::denies('member_events_registration'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $event = Event::findOrFail($id);
        return view('member.events-confirm', compact('event'));
    }

    public function myReferenceMember()
    {
        abort_if(Gate::denies('member_reference_by'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::where('approved', '1')->where('verified', '1')->where('created_by_id', auth()->id())->paginate(20);
        return view('member.my-reference-member', compact('users'));
    }


    public function addNewMember()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $schools = School::get();
        $professions = Profession::where('profession_parrent', 0)->where('is_active', '1')->pluck('name', 'id');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $roles = Role::where('id', 2)->pluck('title', 'id');

        return view('member.new-member', compact('districts', 'divisions', 'professions', 'roles', 'upazilas', 'countries', 'states', 'cities'));

        // return view('member.new-member');
    }


    public function editMember($id)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::findorFail($id);
        $professions = Profession::where('profession_parrent', 0)->where('is_active', '1')->pluck('name', 'id');
        $selectedProfessions = Profession::where('profession_parrent', count($user->professions2) > 0 ? $user->professions2[0]->id : '')->pluck('name', 'id');
        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $roles = Role::where('id', 2)->pluck('title', 'id');
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::where('country_id', $user->residence->country->id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::where('state_id', $user->residence->state->id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('school', 'professions', 'division', 'district', 'upazila', 'roles');

        return view('member.edit-member', compact('selectedProfessions', 'districts', 'divisions', 'professions', 'roles', 'upazilas', 'user', 'countries', 'states', 'cities'));
    }

    public function eventConfirmSubmit(Request $request)
    {
        abort_if(Gate::denies('member_events_confirm'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event = Event::findOrFail($request->input('event_id'));
        $eventUser = EventUser::where('event_id', $request->input('event_id'))->where('user_id', auth()->id())->first();

        if (!$eventUser) {

            if ($request->input('spouseCheck') == 'on') {
                $request->validate([
                    'avatar' => ['required', 'max:2048'],
                    'name' => ['required', 'string', 'max:100'],
                ]);
                $data = $request->only(['name', 'event_id']);
                $data['user_id'] = auth()->id();
                $data['created_by_id'] = auth()->id();

                $spouse = Spouse::create($data);
                if ($request->input('avatar', false)) {
                    $spouse->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
                }
            }
            if ($request->input('driver') == 1) {
                $userData['driver'] = '1';
                $userData['driver_amount'] = $event->driver_amount;
            } else {
                $userData['driver'] = '0';
                $userData['driver_amount'] = 0;
            }
            if ($request->input('spouseCheck') == "on") {
                $userData['spouse'] = '1';
                $userData['spouse_amount'] = $event->spouse_amount;
            } else {
                $userData['spouse'] = '0';
                $userData['spouse_amount'] = 0;
            }

            $userData['user_id'] = auth()->id();
            $userData['event_id'] = $event->id;
            $userData['amount'] = $event->price;
            $userData['payment_status'] = '0';
            EventUser::create($userData);
            $message = "Event registration successfully";

        } else {
            $message = "You are already registered in this event";
        }
        return redirect()->route('member.events')->with('message', __($message));
    }


    public function profile()
    {
        abort_if(Gate::denies('member_profile'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::findorFail(auth()->id());


        $professions = Profession::where('profession_parrent', 0)->where('is_active', '1')->pluck('name', 'id');


        $selectedProfessions = Profession::where('profession_parrent', count($user->professions2) > 0 ? $user->professions2[0]->id : '')->pluck('name', 'id');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::where('id', 2)->pluck('title', 'id');
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        $states = State::where('country_id', $user->residence->country->id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::where('state_id', $user->residence->state->id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        $user->load('school', 'professions', 'division', 'district', 'upazila', 'roles');

        return view('member.profile', compact('selectedProfessions', 'districts', 'divisions', 'professions', 'roles', 'upazilas', 'user', 'countries', 'states', 'cities'));


    }


    //return district wise upazila
    public function get_by_district(Request $request)
    {
       // abort_unless(\Gate::allows('district_access'), 401);

        if (!$request->district_id) {
            $html = '<option value="">' . trans('global.pleaseSelect') . '</option>';
        } else {
            $html = '';
            $upazilas = Upazila::where('district_id', $request->district_id)->get();
            $html .= '<option value="">Please select upazila/thana/area</option>';
            foreach ($upazilas as $city) {

                $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    //return district wise upazila
    public function school_get_by_upazila(Request $request)
    {
       // abort_unless(\Gate::allows('school_access'), 401);

        if (!$request->upazila_id) {
            $html = '<option value="">' . trans('global.pleaseSelect') . '</option>';
        } else {
            $html = '';
            $schools = School::where('upazila_id', $request->upazila_id)->get();
            $html .= '<option value="">Please select school</option>';
            foreach ($schools as $school) {

                $html .= '<option value="' . $school->id . '">' . Str::ucfirst(Str::lower($school->name)) . '</option>';
            }
        }

        return response()->json(['html' => $html]);
    }


    //return division wise district
    public function get_by_division(Request $request)
    {
       // abort_unless(\Gate::allows('division_access'), 401);

        if (!$request->division_id) {
            $html = '<option value="">' . trans('global.pleaseSelect') . '</option>';
        } else {
            $html = '';
            $districts = District::where('division_id', $request->division_id)->get();
            $html .= '<option value="">Please select district/city</option>';
            foreach ($districts as $city) {
                $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
        }
        return response()->json(['html' => $html]);
    }

    //return profession
    public function get_by_profession(Request $request)
    {

        if (!$request->profession_id) {
            $html = '<option value="">' . trans('global.pleaseSelect') . '</option>';
        } else {
            $html = '';
            $professions = Profession::where('profession_parrent', $request->profession_id)->where('is_active', '1')->get();
            $html .= '<option value="">Please select Profession</option>';
            foreach ($professions as $profession) {
                $html .= '<option value="' . $profession->id . '">' . $profession->name . '</option>';
            }
        }
        return response()->json(['html' => $html]);
    }


    private $models = [
        'School' => 'cruds.school.title',
//        'User'        => 'cruds.school.title',
    ];

    public function schoolSearch(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || !isset($search['term'])) {
            abort(400);
        }

        $term = $search['term'];
        $searchableData = [];
        foreach ($this->models as $model => $translation) {
            $modelClass = 'App\Models\\' . $model;
            $query = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->take(20)
                ->get();

            foreach ($results as $result) {
                $parsedData = $result->only($fields);
                $parsedData['model'] = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields = [];
                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }
                $parsedData['fields_formated'] = $formattedFields;
                $parsedData['url'] = route('member.schoolProfile', [$result->id, Str::slug($result->name)]);
                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }

    private $tModels = [
//        'School'        => 'cruds.school.title',
        'User' => 'cruds.user.title',
    ];

    public function memberSearch(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || !isset($search['term'])) {
            abort(400);
        }

        $term = $search['term'];
        $searchableData = [];
        foreach ($this->tModels as $model => $translation) {
            $modelClass = 'App\Models\\' . $model;
            $query = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->take(20)
                ->get();

            foreach ($results as $result) {
                $parsedData = $result->only($fields);
                $parsedData['model'] = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields = [];
                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }
                $parsedData['fields_formated'] = $formattedFields;
                $parsedData['url'] = route('member.schoolProfile', [$result->id, '1111']);
                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }

}
