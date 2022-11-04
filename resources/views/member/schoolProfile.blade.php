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
            <a href="#" class="close_btn">Close</a>
        </div>

        <div class="profile_basic_info">
            <div class="profile_img">
                <img src="{{ url('assets/alumni/images/gray.png') }}" alt="">
            </div>

            <div class="profile_info">
                <p class="profile_name">School Full Name</p>
                <p class="profile_location">School Location</p>
                <p class="profile_student">Total Students: <span>233245</span></p>
            </div>
        </div>

        <div class="profile_contact_info">
            <div class="Contact_box">
                <a href="mailto:mrbatchmate@domain.com" class="white_btn"><i class="bi bi-envelope-paper"></i>mrbatchmate@domain.com</a>

                <a href="tel:+8801773773344" class="white_btn"><i class="bi bi-telephone"></i>+8801773773344</a>

                <a href="#" class="white_btn"><i class="bi bi-calendar-week"></i>School Events</a>

                <a href="#" class="white_btn"><i class="bi bi-person-lines-fill"></i>Students</a>
            </div>

            <div class="social_box">
                <div class="s_box">
                    <p>F</p>
                </div>

                <div class="s_box">

                </div>

                <div class="s_box">

                </div>

                <div class="s_box">

                </div>
            </div>

            <div class="school_about">
                <p class="about_title">About</p>
                <p class="about_text">About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here About the school full details goes here</p>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

@endsection
