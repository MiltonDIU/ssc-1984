@extends('member.layouts.master')
@section('content')
    <div class="event_box_main">
        <div class="event_box school_event_box">

            <div class="btns_group" style="padding-bottom: 20px">

                <div class="btn_wrap">
                    <a href="{{ route('member.my-reference-member') }}" class="group_btn group_btn_green">Reference Member List</a>
                </div>

            </div>

            <div class="card">

                <div class="card-body">
                    @if(session('message'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                    @endif
                    <form method="POST" action="{{ route("member.settings") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row bottom-padding-line">
                            <div class="col-md-12"><h4>Personal Information</h4></div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required">Are you hide your mobile number</label>
                                            <select class="form-control {{ $errors->has('is_hide_mobile') ? 'is-invalid' : '' }}" name="is_hide_mobile" id="is_hide_mobile" required>
                                                <option value disabled {{ old('is_hide_mobile', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Models\User::IS_HIDE as $key => $label)
                                                    <option value="{{ $key }}" {{ old('is_hide_mobile',auth()->user()->is_hide_mobile) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('is_hide_mobile'))
                                                <span class="text-danger">{{ $errors->first('is_hide_mobile') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required">Are you hide your email address?</label>
                                            <select class="form-control {{ $errors->has('is_hide_email') ? 'is-invalid' : '' }}" name="is_hide_email" id="is_hide_email" required>
                                                <option value disabled {{ old('is_hide_email', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Models\User::IS_HIDE as $key => $label)
                                                   <option value="{{ $key }}" {{ old('is_hide_email',auth()->user()->is_hide_email) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('is_hide_email'))
                                                <span class="text-danger">{{ $errors->first('is_hide_email') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('style')
    <link rel="stylesheet" href="{{ url('assets/alumni/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('assets/alumni/css/select2.min.css') }}">
    <style>
        .form-control{ min-height: 48px; line-height: 48px}
        .form-group{ padding-bottom: 20px}
        .bottom-padding-line { margin: 20px 0px; border-bottom: 3px solid gray}
        .select2-container--default .select2-selection--single{ height: 48px}
        .select2-container--default .select2-selection--single .select2-selection__rendered{ line-height: 48px}
        .select2-selection__choice{ color: black}
    </style>
@endpush

@push('script')

@endpush
