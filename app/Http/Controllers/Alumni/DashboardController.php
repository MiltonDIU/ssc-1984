<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\School;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }



    public function index(){
//        $total_users = count(User::all());
//        $events = Event::get()->take(2);
//        return view('member.dashboard',compact('total_users','events'));
        return view('member.dashboard2');
    }
    public function batchMate(){

        abort_if(Gate::denies('batch_mate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::where('approved','1')->where('verified','1')->paginate(20);;
         return view('member.batch-mate',compact('users'));
    }
    public function batchMateProfile($id,$name){
        $user = User::findOrFail($id);
        return view('member.batch-mate-profile',compact('user'));
    }
    public function schools(){
        $schools = School::where('is_approve','1')->paginate(20);
        return view('member.schools',compact('schools'));
    }

    public function schoolProfile($id,$name){
        $school = School::findOrFail($id);
        return view('member.schoolProfile',compact('school'));
    }
    public function events(){
        $events =  Event::where('event_date','<',date('Y-m-d',strtotime(Carbon::now())))->get();
        return view('member.events',compact('events'));
    }
    public function eventDetails($id,$name){
        $event =  Event::findOrFail($id);
        return view('member.events-details',compact('event'));
    }
    public function eventConfirm($id,){
        $event =  Event::findOrFail($id);
        return view('member.events-confirm',compact('event'));
    }

    public function eventConfirmSubmit(Request $request){
        $event = Event::findOrFail($request->input('event_id'));
$eventUser = EventUser::where('event_id',$request->input('event_id'))->where('user_id',auth()->id())->first();
if (!$eventUser){
    if($request->input('spouseCheck')=='on'){
        $data = $request->only(['name','event_id']);
        $data['user_id'] = auth()->id();
        $data['created_by_id'] = auth()->id();
        $spouse = Spouse::create($data);
        if ($request->input('avatar', false)) {
            $spouse->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
        }
//        $event_user = DB::table('event_user')->insert([
//            'user_id' => auth()->id(),
//            'event_id' => $event->id,
//        ]);

        $userData['user_id']= auth()->id();
        $userData['event_id']= $event->id;

        EventUser::create($userData);
        $message  = "Event registration successfully";
    }
}else{
    $message  = "You are already registered in this event";
}
        return redirect()->route('member.events')->with('message', __($message));
    }
}
