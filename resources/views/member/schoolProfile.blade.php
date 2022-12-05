@extends('member.layouts.master')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search among 3032 Schools">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')

    <div class="view_school_box">
        <div class="close_option">
{{--            <a href="#" class="close_btn">Close</a>--}}
        </div>

        <div class="profile_basic_info">
            <div class="profile_info">
                <p class="profile_name">{{ $school->name??"" }}</p>
                <p class="profile_location">{{ $school->address??"" }}, {{ $school->post_office?"PO: $school->post_office,":"" }} {{ $school->upazila->name??"" }}, {{ $school->district->name??"" }} , {{ $school->division->name??"" }}</p>
                <p class="profile_student">Total Students: <span>{{ count($school->schoolUsers) }}</span></p>
            </div>
        </div>

        <div class="profile_contact_info">
            <div class="Contact_box">
{{--                <a href="mailto:mrbatchmate@domain.com" class="white_btn"><i class="bi bi-envelope-paper"></i>mrbatchmate@domain.com</a>--}}

                <a href="tel:{{ $school->mobile??"" }}" class="white_btn"><i class="bi bi-telephone"></i>{{ $school->mobile??"" }}</a>

{{--                <a href="#" class="white_btn"><i class="bi bi-calendar-week"></i>School Events</a>--}}

{{--                <a href="#" class="white_btn"><i class="bi bi-person-lines-fill"></i>Students</a>--}}
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

{{--            <div class="school_about">--}}
{{--                <p class="about_title">About</p>--}}
{{--                <p class="about_text">About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here</p>--}}
{{--            </div>--}}

            @if(count($school->schoolUsers)>0)
            <div style="padding-top: 50px">
                <table class="table table-borderless table-hover">
                    <thead class="datalist_heading">
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">School Name</th>
                        <th scope="col">Profile</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($school->schoolUsers as $user)
                        <tr>
                            <th scope="row">
                                <div class="data_profile_img">
                                    @if($user->avatar)
                                        <img src="{{ $user->avatar->getUrl('thumb') }}" alt="{{ $user->name }}">
                                    @else
                                        <img src="{{ url('assets/alumni/images/My profile.png') }}" alt="">
                                    @endif
                                </div>
                            </th>
                            <td class="data_name " >{{ $user->name??"" }}</td>
                            <td>{{ $user->upazila->name??"" }}, {{ $user->district->name??"" }}</td>
                            <td>{{ $user->school->name??"" }}</td>
                            <td class="request_status request_sent"><a href="{{ route('member.batch-mate.profile',[$user->id,$user->name]) }}">View Profile</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>
@endsection
@section('scripts')
    @parent

@endsection


@push('style')
    <style>
        .view_school_box{
            min-height: 590px;
            height: auto;
        }
    </style>
@endpush
