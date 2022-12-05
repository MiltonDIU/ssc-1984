@extends('member.layouts.login')
@section('content')
    <!-- ---------------------- sign up start ---------------------- -->
    <form action="">
        <div class="otp_input_group">
            <input type="number" placeholder="-">
            <input type="number" placeholder="-">
            <input type="number" placeholder="-">
            <input type="number" placeholder="-">
        </div>
{{--        <button type="submit" class="btn_green_large">Verify</button>--}}
        <a  href="{{ route('member.registration1') }}" class="btn_green_large">Verify</a>
    </form>

    <p class="font_12">Code expires in : <span class="font_green">00 : 56</span></p>

    <p class="font_12 mt_15">Didn't receive code? <a href="#" class="font_14 link_underline">Resend Code</a></p>

    <p class="font_12 mt_30">example form uses only the @ in its copyright notice</p>
    <!-- ---------------------- sign up end ---------------------- -->

@endsection
