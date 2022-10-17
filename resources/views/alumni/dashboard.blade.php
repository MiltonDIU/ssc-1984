@extends('alumni.layouts.master')
@section('top_content')
    <h2 class="Welcome_message font_22">Hi, <span>{{ auth()->user()->name??'' }}</span>, We have found your <span>{{ $total_users??'' }}</span> friends 👋</h2>
@endsection
@section('content')
    <div class="dashboard_tab d-flex">
        <a href="#">
            <div class="dashboard_tab_box dashboard_tab_friend">
                <div class="dashboard_tab_icon">
                    <img src="{{ url('assets/alumni/images/friedns.png') }}" alt="">
                </div>
                <p class="dashboard_tab_title">Friends List</p>
            </div>
        </a>

        <a href="#">
            <div class="dashboard_tab_box dashboard_tab_school">
                <div class="dashboard_tab_icon">
                    <img src="{{ url('assets/alumni/images/school.png') }}" alt="">
                </div>
                <p class="dashboard_tab_title">Schools</p>
            </div>
        </a>

        <a href="#">
            <div class="dashboard_tab_box dashboard_tab_event">
                <div class="dashboard_tab_icon">
                    <img src="{{ url('assets/alumni/images/events.png') }}" alt="">
                </div>
                <p class="dashboard_tab_title">Events</p>
            </div>
        </a>

        <a href="#">
            <div class="dashboard_tab_box dashboard_tab_profile">
                <div class="dashboard_tab_icon">
                    <img src="{{ url('assets/alumni/images/My profile.png') }}" alt="">
                </div>
                <p class="dashboard_tab_title">My Profile</p>
            </div>
        </a>
    </div>

    <div class="dashboard_featured_event">
        <div class="featured_top">
            <p>Featured Events</p>
            <a href="{{ route('alumni.events') }}">See All</a>
        </div>

        <div class="event_main">
            @foreach($events as $event)
            <div class="event_box">
                <div class="event_banner" style="background: url({{ url('assets/alumni/images/gray.png') }});">
                    <div class="event_date">
                        <p class="day"> {{ date('j ', strtotime($event->event_date))  }}</p>
                        <p class="month">{{ date('M ', strtotime($event->event_date))  }}</p>

                    </div>
                    <div class="event_details">
                        <p class="event_title">{{ $event->event_category->name }}</p>
                        <p class="event_location">{{ $event->address }}</p>
                    </div>
                </div>
                <div class="going_box">
                    <div class="participant_box">
                        <p>Going</p>

                        <div class="participant_img_count">
                            @foreach($event->users as $user)
                            <div class="participant_img">
                                <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                            </div>
                            @endforeach
                            <div class="participant_img participant_count ml_negative">
                                <p>{{ count($event->users) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="going_btn_box">
                        <a href="#" class="going_btn">Going</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    @parent

@endsection
