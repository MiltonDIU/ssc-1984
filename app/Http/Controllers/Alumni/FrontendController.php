<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
public function register(){
    return view('alumni.auth.register');
}
public function otp(){
    return view('alumni.auth.otp');
}

public function otpVerify(){
    return view('alumni.auth.otp-verify');
}

public function registration1(){
    return view('alumni.auth.reg-step-1');
}

public function registration2(){
    return view('alumni.auth.reg-step-2');
}
    public function profile(){
        return view('alumni.profile');
    }
}
