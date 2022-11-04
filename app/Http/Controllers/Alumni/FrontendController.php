<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
public function register(){
    return view('member.auth.register');
}
public function otp(){
    return view('member.auth.otp');
}

public function otpVerify(){
    return view('member.auth.otp-verify');
}

public function registration1(){
    return view('member.auth.reg-step-1');
}

public function registration2(){
    return view('member.auth.reg-step-2');
}
    public function profile(){
        return view('member.profile');
    }
}
