@extends('member.layouts.login')
@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        @if(session()->has('message'))
            <p class="alert alert-info">
                {{ session()->get('message') }}
            </p>
        @endif
        <div class="input-box">

            <input id="email" type="email" class="input_border_bottom {{ $errors->has('email') ? ' is-invalid' : '' }}"
                   required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email"
                   value="{{ old('email', null) }}">

            @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" required placeholder="{{ trans('global.login_password') }}">

            @if($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif


        </div>
        <input class="btn_green_large" type="submit" value="Sing In">
    </form>


    <a class="btn_red_large" href="{{ route('register') }}">Sign Up <i class="bi bi-chevron-right"></i></a>

    <p class="font_12">example form uses only the @ in its copyright notice</p>

@endsection
