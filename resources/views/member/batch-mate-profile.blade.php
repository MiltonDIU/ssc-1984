@extends('member.layouts.master')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')

    <!-- ---------------------- Dashboard content end ---------------------- -->

    <div class="view_profile_box">
        <div class="profile_basic_info">
            <div class="profile_img">
                @if($user->avatar)
                    <img src="{{ $user->avatar->getUrl('thumb') }}" alt="{{ $user->name }}">
                @else
                    <img src="{{ url('assets/alumni/images/My profile.png') }}" alt="">
                @endif
            </div>

            <div class="profile_info">
                <p class="profile_name">{{ $user->name??"" }}</p>
                <p class="profile_location">{{ $user->upazila->name??"" }}, {{ $user->district->name??"" }}</p>
                <p class="profile_school">{{ $user->school->name??"" }}</p>
            </div>
        </div>

        <div class="profile_contact_info">
            <div class="Contact_box">
                <a href="mailto:{{ $user->email??"" }}" class="white_btn"><i class="bi bi-envelope-paper"></i>{{ $user->email??"" }}</a>
                <a href="tel:{{ $user->mobile??"" }}" class="white_btn"><i class="bi bi-telephone"></i>{{ $user->mobile??"" }}</a>
            </div>

{{--            <div class="social_box">--}}
{{--                <div class="s_box">--}}
{{--                    <p>F</p>--}}
{{--                </div>--}}

{{--                <div class="s_box">--}}

{{--                </div>--}}

{{--                <div class="s_box">--}}

{{--                </div>--}}

{{--                <div class="s_box">--}}

{{--                </div>--}}
{{--            </div>--}}

            <div class="current_location_box">
                <p class="location_title">Current Location:</p>
                <p class="location_text">   {{ $user->userAddresses[0]->area?? '' }}, {{ $user->userAddresses[0]->upazila->name ?? '' }}, {{ $user->userAddresses[0]->district->name ?? '' }}</p>
                <hr>
            </div>

            <div class="job_history_box">
                @foreach($user->professions as $key=> $profession)
                    <div class="step">
                        <div class="circle {{ ($key<=0)?"current":"previous" }}"></div>
                        <p class="job_history"><i class="bi bi-briefcase"></i>{{ $profession->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ---------------------- Dashboard content end ---------------------- -->
@endsection
@section('scripts')
    @parent

@endsection
