@extends('alumni.layouts.login')
@section('content')
    <!-- ---------------------- sign up start ---------------------- -->

                <div class="sign_up_social">
                    <a class="social_btn" href="#"><img src="{{ url('assets/alumni/images/facebook-logo.png') }}">Continue with Facebook</a>

                    <a class="social_btn" href="#"><img src="{{ url('assets/alumni/images/google-logo.png') }}">Continue with Google</a>

                    <a class="phone_btn" href="{{ route('alumni.otp') }}"><img src="{{ url('assets/alumni/images/phone-icon.png') }}">Continue with Phone</a>
                </div>

                <p class="font_16">Already have an account? <a href="#">Sign In</a></p>

                <p class="font_12">example form uses only the @ in its copyright notice</p>

    <!-- ---------------------- sign up end ---------------------- -->

@endsection
