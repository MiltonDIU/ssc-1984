@extends('alumni.layouts.master')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search among 3032 Schools">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')

    <div class="btns_group">
        <div class="btn_wrap">
            <button class="group_btn active">My Events</button>
            <button class="group_btn mid_btn">Featured Events</button>
            <button class="group_btn last_btn">All Events</button>
        </div>

        <div class="btn_wrap">
            <button class="group_btn active">Up Coming </button>
            <button class="group_btn last_btn">Expired</button>
        </div>

        <div class="btn_wrap">
            <button class="group_btn group_btn_green">Request Event <i class="bi bi-plus-circle"></i></button>
        </div>

        <div class="btn_wrap">
            <button class="group_btn group_btn_gray">My Requests</button>
        </div>
    </div>

    <div class="event_box_main">
        <div class="event_box school_event_box">
            <div class="event_banner" style="background: url({{ url('assets/alumni/images/gray.png') }});">
                <div class="event_date">
                    <p class="day">8</p>
                    <p class="month">May</p>
                </div>

                <div class="event_details">
                    <p class="event_title">Reunion 2022</p>
                    <p class="event_school_name">School Full Name</p>
                    <p class="event_location">Park Hight, Dhanmondi 27, Dhaka 1203</p>
                </div>
            </div>

            <div class="going_box">
                <div class="participant_box">
                    <p>Going</p>

                    <div class="participant_img_count">
                        <div class="participant_img">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img participant_count ml_negative">
                            <p>180+</p>
                        </div>
                    </div>
                </div>

                <div class="going_btn_box">
                    <a href="#" class="going_btn">Going</a>
                </div>
            </div>
        </div>

        <div class="event_box school_event_box">
            <div class="event_banner" style="background: url({{ url('assets/alumni/images/gray.png') }});">
                <div class="event_date">
                    <p class="day">8</p>
                    <p class="month">May</p>
                </div>

                <div class="event_details">
                    <p class="event_title">Reunion 2022</p>
                    <p class="event_school_name">School Full Name</p>
                    <p class="event_location">Park Hight, Dhanmondi 27, Dhaka 1203</p>
                </div>
            </div>

            <div class="going_box">
                <div class="participant_box">
                    <p>Going</p>

                    <div class="participant_img_count">
                        <div class="participant_img">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img participant_count ml_negative">
                            <p>180+</p>
                        </div>
                    </div>
                </div>

                <div class="going_btn_box">
                    <a href="#" class="going_btn">Going</a>
                </div>
            </div>
        </div>
        <div class="event_box school_event_box">
            <div class="event_banner" style="background: url({{ url('assets/alumni/images/gray.png') }});">
                <div class="event_date">
                    <p class="day">8</p>
                    <p class="month">May</p>
                </div>

                <div class="event_details">
                    <p class="event_title">Reunion 2022</p>
                    <p class="event_school_name">School Full Name</p>
                    <p class="event_location">Park Hight, Dhanmondi 27, Dhaka 1203</p>
                </div>
            </div>

            <div class="going_box">
                <div class="participant_box">
                    <p>Going</p>

                    <div class="participant_img_count">
                        <div class="participant_img">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img participant_count ml_negative">
                            <p>180+</p>
                        </div>
                    </div>
                </div>

                <div class="going_btn_box">
                    <a href="#" class="going_btn">Going</a>
                </div>
            </div>
        </div>
        <div class="event_box school_event_box">
            <div class="event_banner" style="background: url({{ url('assets/alumni/images/gray.png') }});">
                <div class="event_date">
                    <p class="day">8</p>
                    <p class="month">May</p>
                </div>

                <div class="event_details">
                    <p class="event_title">Reunion 2022</p>
                    <p class="event_school_name">School Full Name</p>
                    <p class="event_location">Park Hight, Dhanmondi 27, Dhaka 1203</p>
                </div>
            </div>

            <div class="going_box">
                <div class="participant_box">
                    <p>Going</p>

                    <div class="participant_img_count">
                        <div class="participant_img">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img participant_count ml_negative">
                            <p>180+</p>
                        </div>
                    </div>
                </div>

                <div class="going_btn_box">
                    <a href="#" class="going_btn">Going</a>
                </div>
            </div>
        </div>
        <div class="event_box school_event_box">
            <div class="event_banner" style="background: url({{ url('assets/alumni/images/gray.png') }});">
                <div class="event_date">
                    <p class="day">8</p>
                    <p class="month">May</p>
                </div>

                <div class="event_details">
                    <p class="event_title">Reunion 2022</p>
                    <p class="event_school_name">School Full Name</p>
                    <p class="event_location">Park Hight, Dhanmondi 27, Dhaka 1203</p>
                </div>
            </div>

            <div class="going_box">
                <div class="participant_box">
                    <p>Going</p>

                    <div class="participant_img_count">
                        <div class="participant_img">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img participant_count ml_negative">
                            <p>180+</p>
                        </div>
                    </div>
                </div>

                <div class="going_btn_box">
                    <a href="#" class="going_btn">Going</a>
                </div>
            </div>
        </div>
        <div class="event_box school_event_box">
            <div class="event_banner" style="background: url({{ url('assets/alumni/images/gray.png') }});">
                <div class="event_date">
                    <p class="day">8</p>
                    <p class="month">May</p>
                </div>

                <div class="event_details">
                    <p class="event_title">Reunion 2022</p>
                    <p class="event_school_name">School Full Name</p>
                    <p class="event_location">Park Hight, Dhanmondi 27, Dhaka 1203</p>
                </div>
            </div>

            <div class="going_box">
                <div class="participant_box">
                    <p>Going</p>

                    <div class="participant_img_count">
                        <div class="participant_img">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img ml_negative">
                            <img src="{{ url('assets/alumni/images/gray.png')}}" alt="">
                        </div>

                        <div class="participant_img participant_count ml_negative">
                            <p>180+</p>
                        </div>
                    </div>
                </div>

                <div class="going_btn_box">
                    <a href="#" class="going_btn">Going</a>
                </div>
            </div>
        </div>


        <nav aria-label="...">
            <ul class="pagination pagination-sm justify-content-end">
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#">6</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">12</a></li>
                <li class="page-item"><a class="page-link" href="#">13</a></li>
            </ul>
        </nav>
    </div>





@endsection
@section('scripts')
    @parent

@endsection
