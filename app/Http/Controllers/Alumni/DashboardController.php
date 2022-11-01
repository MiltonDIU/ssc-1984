<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
//        return view('alumni.dashboard',compact('total_users','events'));
        return view('alumni.dashboard2');
    }
    public function batchMate(){
        return view('alumni.batch-mate');
    }
    public function batchMateProfile(){
        return view('alumni.batch-mate-profile');
    }
    public function schools(){
        return view('alumni.schools');
    }

    public function schoolProfile(){
        return view('alumni.schoolProfile');
    }
    public function events(){
//        $upcoming_events =  Event::where('event_date','<',date('Y-m-d',strtotime(Carbon::now())))->get();
//        dd($upcoming_events);
//        return view('alumni.events');
        return view('alumni.events2');
    }

}
