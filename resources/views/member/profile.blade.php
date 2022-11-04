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
                <div class="notification">
                    <i class="bi bi-bell"></i>
                </div>

                <div class="dashboard_left_top_profile">
                    <img src="images/img.png" alt="">
                </div>
            </div>
        </div>

        <div class="view_profile_box">
            <div class="close_option">
                <a href="#" class="close_btn">Close</a>
            </div>

            <div class="profile_basic_info">
                <div class="profile_img">
                    <img src="images/gray.png" alt="">
                </div>

                <div class="profile_info">
                    <p class="profile_name">Mr. Batch Mate</p>
                    <p class="profile_location">Upozila, Zila</p>
                    <p class="profile_school">School Name</p>
                </div>
            </div>

            <div class="profile_contact_info">
                <div class="Contact_box">
                    <a href="mailto:mrbatchmate@domain.com" class="white_btn"><i class="bi bi-envelope-paper"></i>mrbatchmate@domain.com</a>
                    <a href="tel:+8801773773344" class="white_btn"><i class="bi bi-telephone"></i>+8801773773344</a>
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

                <div class="current_location_box">
                    <p class="location_title">Current Location:</p>
                    <p class="location_text">House #20 (3rd Floor) Road # 17, Nikanjia-2, Dhaka 1207</p>
                    <hr>
                </div>

                <div class="job_history_box">
                    <div class="step">
                        <div class="circle current"></div>
                        <p class="job_history"><i class="bi bi-briefcase"></i>Manager | Business Name (2012-Present)</p>
                    </div>

                    <div class="step">
                        <div class="circle previous"></div>
                        <p class="job_history"><i class="bi bi-briefcase"></i>Manager | Business Name (2012-Present)</p>
                    </div>

                    <div class="step">
                        <div class="circle previous"></div>
                        <p class="job_history"><i class="bi bi-briefcase"></i>Manager | Business Name (2008-2010)</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- ---------------------- Dashboard content end ---------------------- -->


@endsection
@section('scripts')
    @parent

@endsection
