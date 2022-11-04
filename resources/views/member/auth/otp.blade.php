@extends('member.layouts.login')
@section('content')
    <!-- ---------------------- sign up start ---------------------- -->
    <form action="{{ route('member.otp-phone-signup') }}">
        <label for="phone" class="font_14">Mobile Number</label>
        <div class="input-box">
            <input type="number" name="phone" placeholder="+880">
        </div>

{{--        <button type="" class="btn_green_large">Next</button>--}}
        <a href="{{ route('member.otp-phone-signup') }}" class="btn_green_large">Next</a>
    </form>

    <p class="font_12">example form uses only the @ in its copyright notice</p>
    <!-- ---------------------- sign up end ---------------------- -->

@endsection
