<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Portal</title>
    <link rel="shortcut icon" href="images/fav-icon.png" type="image/x-icon">

    <!-- ---------------------- Google Fonts start ---------------------- -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- ---------------------- Google Fonts end ---------------------- -->

    <!-- ---------------------- Bootstrap icon start ---------------------- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- ---------------------- Bootstrap icon end ---------------------- -->

    <!-- ---------------------- CSS start ---------------------- -->
    <link rel="stylesheet" href="{{ url('assets/alumni/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/alumni/css/style.css') }}">
    <!-- ---------------------- CSS end ---------------------- -->
<style>
    .dashboard_content{ padding: 25px}
</style>
    @stack('style')
</head>
<body>
<section id="dashboard" class="d-flex">
    <!-- ---------------------- side navbar start ---------------------- -->
    <div class="sidenav d-flex flex-column flex-shrink-0 bg-white" style="width: 278px; height: 100vh;">
        <a href="{{ route('member.dashboard') }}" class="d-flex align-items-center">
            <img src="{{ url('assets/alumni/images/logo.png') }}" alt="" class="logo_img">
            <div class="sidenav_top_text">
                <p class="batch_name">SSC-1984 Bangladesh</p>
                <p class="tagline">Unity Through Friendship</p>
            </div>
        </a>

{{--        <div class="search">--}}
{{--            <div class="search_wrap">--}}
{{--                <i class="bi bi-search"></i>--}}
{{--                <input type="search" placeholder="Search">--}}
{{--            </div>--}}
{{--        </div>--}}

        <ul class="nav nav-pills flex-column mb-auto">
{{--            <p class="sidenav_title">Menu</p>--}}
            <li class="nav-item" style="margin-top: 20px">
                <a href="{{ route('member.dashboard') }}" class="nav-link active" aria-current="page">
                    <i class="bi bi-house"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('member.batch-mate') }}" class="nav-link">
                    <i class="bi bi-people-fill"></i>
                    Batch Mate
                </a>
            </li>
            <li>
                <a href="{{ route('member.schools') }}" class="nav-link">
                    <i class="bi bi-building"></i>
                    School
                </a>
            </li>
            <li>
                <a href="{{ route('member.events') }}" class="nav-link">
                    <i class="bi bi-calendar-event"></i>
                    Events
                </a>
            </li>
            <li>
                <a href="{{ route('member.profile') }}" class="nav-link">
                    <i class="bi bi-person-circle"></i>
                    My Profile
                </a>
            </li>

            <li>
                <a href="{{ route('member.my-reference-member') }}" class="nav-link">
                    <i class="bi bi-person-circle"></i>
                    My Reference
                </a>
            </li>
        </ul>

        <div class="profile_part">
{{--            <p class="sidenav_title">Profile</p>--}}

            <a href="{{ route('member.settings') }}" class="d-flex align-items-center">

                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar->getUrl('thumb') }}" alt="{{ auth()->user()->name }}" class="profile_img">
                @else
                    <img src="{{ url('assets/alumni/images/My profile.png') }}" alt="" class="profile_img">
                @endif
{{--                --}}
{{--                <img src="{{ url('assets/alumni/images/img.png') }}" alt="" class="profile_img">--}}
{{--                --}}
{{--                --}}

                <div class="sidenav_bottom_profile">
                    <p class="profile_name"> {{ auth()->user()->name??"" }}</p>
                    <p class="profile_type font_14">Account Settings</p>
                </div>
                <span><i class="bi bi-three-dots"></i></span>
            </a>

        </div>

        <div class="logout">
            <a href="#" class="logout_btn" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="bi bi-box-arrow-right"></i>Logout</a>
        </div>


        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>



    </div>
    <!-- ---------------------- side navbar end ---------------------- -->

    <!-- ---------------------- Dashboard content end ---------------------- -->
    <div class="dashboard_content {{ $page_class??'' }}">

      @yield('content')
    </div>
    <!-- ---------------------- Dashboard content end ---------------------- -->
</section>


<!-- ---------------------- JS start ---------------------- -->
<script src="{{ url('assets/alumni/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ url('assets/alumni/js/bootstrap.bundle.min.js') }}"></script>

<!-- ---------------------- JS end ---------------------- -->

@stack('script')

<script src="{{ url('assets/alumni/js/script.js') }}"></script>
</body>
</html>


