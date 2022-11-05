@extends('member.layouts.profile')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search among 3032 Schools">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')

    <!-- ---------------------- Dashboard content end ---------------------- -->
    <div class="dashboard_content profile_view">
        <div class="dashboard_content_top">
            <div class="profile_notification">
{{--                <div class="notification">--}}
{{--                    <i class="bi bi-bell"></i>--}}
{{--                </div>--}}

                <div class="dashboard_left_top_profile">
{{--                    <img src="images/img.png" alt="">--}}
                </div>
            </div>
        </div>

        <div class="view_profile_box">

            <div class="profile_basic_info">
                <div class="profile_img">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar->getUrl('thumb') }}" alt="{{ auth()->user()->name }}">
                    @else
                        <img src="{{ url('assets/alumni/images/My profile.png') }}" alt="">
                    @endif
                </div>

                <div class="profile_info">
                    <p class="profile_name">{{ auth()->user()->name??"" }}</p>
                    <p class="profile_location">{{ auth()->user()->upazila->name??"" }}, {{ auth()->user()->district->name??"" }}</p>
                    <p class="profile_school">{{ auth()->user()->school->name??"" }}</p>
                </div>
            </div>



            <div class="profile_contact_info">
                <div class="Contact_box">
                    <a href="mailto:{{ auth()->user()->email??"" }}" class="white_btn"><i class="bi bi-envelope-paper"></i>{{ auth()->user()->email??"" }}</a>
                    <a href="tel:{{ auth()->user()->mobile??"" }}" class="white_btn"><i class="bi bi-telephone"></i>{{ auth()->user()->mobile??"" }}</a>
                </div>
                <div class="current_location_box">
                    <p class="location_title">Current Location:</p>
                    <p class="location_text">   {!! auth()->user()->userAddresses[0]->area?? '' !!}, {{ auth()->user()->userAddresses[0]->upazila->name ?? '' }}, {{ auth()->user()->userAddresses[0]->district->name ?? '' }}</p>
                    <hr>
                </div>

                <div class="job_history_box">
                    @foreach(auth()->user()->professions as $key=> $profession)
                        <div class="step">
                            <div class="circle {{ ($key<=0)?"current":"previous" }}"></div>
                            <p class="job_history"><i class="bi bi-briefcase"></i>{{ $profession->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- ---------------------- Dashboard content end ---------------------- -->


@endsection
@section('scripts')
    @parent

@endsection
