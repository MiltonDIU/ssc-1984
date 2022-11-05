@extends('member.layouts.master')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search among 3032 Schools">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')

{{--    <div class="btns_group">--}}
{{--        <div class="btn_wrap">--}}
{{--            <button class="group_btn active">My Events</button>--}}
{{--            <button class="group_btn mid_btn">Featured Events</button>--}}
{{--            <button class="group_btn last_btn">All Events</button>--}}
{{--        </div>--}}

{{--        <div class="btn_wrap">--}}
{{--            <button class="group_btn active">Up Coming </button>--}}
{{--            <button class="group_btn last_btn">Expired</button>--}}
{{--        </div>--}}

{{--        <div class="btn_wrap">--}}
{{--            <button class="group_btn group_btn_green">Request Event <i class="bi bi-plus-circle"></i></button>--}}
{{--        </div>--}}

{{--        <div class="btn_wrap">--}}
{{--            <button class="group_btn group_btn_gray">My Requests</button>--}}
{{--        </div>--}}
{{--    </div>--}}

@if(session('message'))
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        </div>
    </div>
@endif

@include('member.section.event')



@endsection
@section('scripts')
    @parent

@endsection
