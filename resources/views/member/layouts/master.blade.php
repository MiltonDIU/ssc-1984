<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>{{ trans('panel.site_title') }}</title>
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
    <link rel="stylesheet" href="{{ url('assets/alumni/css/responsive.css') }}">
    <!-- ---------------------- CSS end ---------------------- -->
<style>
    .dashboard_content{ padding: 25px}
</style>
    @stack('style')
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <!-- ---------------------- side navbar start ---------------------- -->
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white">
            <div class="d-flex flex-column align-items-center align-items-sm-start text-white min-vh-100">

                <ul class="nav sidenav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                            <a href="{{ route('member.dashboard') }}" class="d-flex align-items-center">
                                <img src="{{ url('assets/alumni/images/logo.png') }}" alt="" class="logo_img">
                            <div class="sidenav_top_text sm_d_none">
                                <p class="batch_name">SSC-1984 Bangladesh</p>
                                <p class="tagline">Unity Through Friendship</p>
                            </div>
                        </a>
                    </li>
                    <li class="w_100">
                        <ul class="nav nav-pills flex-column mb-auto a_center">
                    <li class="nav-item">
                        <a href="{{ route('member.dashboard') }}" class="nav-link active" aria-current="page">
                            <i class="bi bi-house"></i>
                            <span class="sm_d_none">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('member.batch-mate') }}" class="nav-link">
                            <i class="bi bi-people-fill"></i>
                            <span class="sm_d_none">Friends List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('member.schools') }}" class="nav-link">
                            <i class="bi bi-building"></i>
                            <span class="sm_d_none">School</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('member.events') }}" class="nav-link">
                            <i class="bi bi-calendar-event"></i>
                            <span class="sm_d_none">Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('member.profile') }}" class="nav-link">
                            <i class="bi bi-person-circle"></i>
                            <span class="sm_d_none">My Profile</span>
                        </a>
                    </li>
                            @can('member_reference_by')
                            <li>
                        <a href="{{ route('member.my-reference-member') }}" class="nav-link">
                            <i class="bi bi-people-fill"></i>
                            <span class="sm_d_none">  My Reference</span>
                        </a>
                    </li>
                            @endcan
                </ul>

                    </li>
                    <div class="profile_part">
                        <p class="sidenav_title"><span class="My Profile">Profile</span></p>

                        <a href="{{ route('member.settings') }}"  class="d-flex align-items-center">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar->getUrl('thumb') }}" alt="{{ auth()->user()->name }}" class="profile_img">
                            @else
                                <img src="{{ url('assets/alumni/images/My profile.png') }}" alt="" class="profile_img">
                            @endif
                            <div class="sidenav_bottom_profile">
                                <p class="profile_name"> <span class="sm_d_none">{{ auth()->user()->name??"" }}</span></p>
                                <p class="profile_type font_14"><span class="sm_d_none">Account Settings</span></p>
                            </div>
                            <span class="sm_d_none"><i class="bi bi-three-dots"></i></span>
                        </a>
                    </div>


                    <div class="logout">
                        <a href="#" class="logout_btn" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="bi bi-box-arrow-right"></i><span class="sm_d_none">Logout</span></a>
                    </div>

                    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </ul>
            </div>
        </div>
        <!-- ---------------------- Dashboard content start ---------------------- -->
        <div class="col py-3">
            <div class="dashboard_content {{ $page_class??'' }}">
                @yield('content')
            </div>
        </div>
        <!-- ---------------------- Dashboard content end ---------------------- -->
    </div>
</div>
<!-- ---------------------- JS start ---------------------- -->
<script src="{{ url('assets/alumni/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ url('assets/alumni/js/bootstrap.bundle.min.js') }}"></script>

<!-- ---------------------- JS end ---------------------- -->

@stack('script')

<script src="{{ url('assets/alumni/js/script.js') }}"></script>
</body>
</html>


