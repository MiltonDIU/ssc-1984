@extends('member.layouts.master')
@section('top_content')

@endsection
@section('content')

    <div class="dashboard_content_top">
        <h2 class="Welcome_message font_22">Hi, <span>{{ auth()->user()->name??'' }}</span>, We have found your <span>{{ $total_users??'' }}</span> friends 👋</h2>
    </div>

    <div class="dashboard_tab">
        <a href="{{ route('member.batch-mate') }}">
            <div class="dashboard_tab_box dashboard_tab_friend">
                <div class="dashboard_tab_icon">
                    <img src="{{ url('assets/alumni/images/friedns.png') }}" alt="">
                </div>
                <p class="dashboard_tab_title">Friends List</p>
            </div>
        </a>

        <a href="{{ route('member.schools') }}">
            <div class="dashboard_tab_box dashboard_tab_school">
                <div class="dashboard_tab_icon">
                    <img src="{{ url('assets/alumni/images/school.png') }}" alt="">
                </div>
                <p class="dashboard_tab_title">Schools</p>
            </div>
        </a>

        <a href="{{ route('member.events') }}">
            <div class="dashboard_tab_box dashboard_tab_event">
                <div class="dashboard_tab_icon">
                    <img src="{{ url('assets/alumni/images/events.png') }}" alt="">
                </div>
                <p class="dashboard_tab_title">Events</p>
            </div>
        </a>

        <a href="{{ route('member.profile') }}">
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
            <a href="{{ route('member.events') }}">See All</a>
        </div>

        @if(count($events)>0)
        @include('member.section.event-card')
        @endif

    </div>
@endsection
@section('scripts')
    @parent

@endsection

@push('style')
    <style>
        .dashboard_featured_event{
            min-height: 399px;
            height: auto;
        }
    </style>
@endpush
