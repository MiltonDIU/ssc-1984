@extends('member.layouts.master')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search among 3032 Schools">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')


        <div class="event_box_large">

            <p class="event_page_title">{{ $event->name??"" }}</p>
            @if($event->banner)
                @php
                    $url =$event->banner->getUrl();
                @endphp
            @else
                @php
                    $url = 'assets/alumni/images/gray.png';
                @endphp
            @endif

            <div class="event_banner_img">
                <img src="{{ url($url) }}" alt="Event banner">
            </div>

            <div class="event_info_box">
                <div class="event_info_left">
                    <p class="event_sub_title">{{ $event->name??"" }}</p>

                    <div class="event_date_location_box">
                        <div class="event_info_inner">
                            <div class="icon_box">
                                <i class="bi bi-calendar-event"></i>
                            </div>

                            <div class="event_info_text">
                                <p class="info_title">{{ date('l, j, M, Y ', strtotime($event->event_date))  }}</p>
                                <p class="info_text">{{date('h:i A', strtotime($event->event_time)) }} - {{date('h:i A', strtotime($event->event_end_time)) }}</p>
                            </div>
                        </div>

                        <div class="event_info_inner inner_bottom">
                            <div class="icon_box">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>

                            <div class="event_info_text">
                                <p class="info_title">Get Direction</p>
                                <p class="info_text">{{ $event->address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="event_creator_cost_box">
                        <div class="event_creator">
                            <div class="creator_img">
                                <img src="http://ssc-1984.test/assets/alumni/images/logo.png">
                            </div>
                            <div class="creator_text">
                                <p class="creator_title">Created By</p>
                                <p class="info_text">Spruce Springclean</p>
                            </div>
                        </div>

                        <div class="event_cost">
                            <p class="cost_title">Cost</p>
                            <p class="cost_category">{{ $event->is_free=='0'?$event->price." tk":"Free" }}</p>
                        </div>
                    </div>
                </div>

                <div class="event_info_right">
{{--                    <p class="event_sub_title">Event Detail</p>--}}

                    <p class="info_text">
                        {!! $event->details !!}
                    </p>

                    <div class="register_btn_box">
                        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                             tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>{{ $event->name }}</h5>
                                        <p><a href="">Agreement Details</a> and you are agree with this event conditions.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="event_request_btn" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                                data-bs-dismiss="modal">CONFIRM REGISTRATION</button>
                                    </div>

                                    <form action="">
                                        <div class="form_top">
                                            <div class="input_box">
                                                <div class="input_group">
                                                    <label for="spouse_name" class="font_14">Spouse  Name</label>
                                                    <input type="text" name="spouse_name" id="spouse_name" placeholder="Spouse Name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form_top">
                                            <div class="input_box">
                                                <div class="input_group">
                                                    <label for="spouse_name" class="font_14">Spouse  Name</label>
                                                    <input type="text" name="spouse_name" id="spouse_name" placeholder="Spouse Name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="request_btn">
                                            <button type="submit" class="event_request_btn">SEND REQUEST</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
                             tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>CONFIRM REGISTRATION</h5>
                                        <p>You have successfully complete the registration for event name</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="event_request_btn">VIEW TICKET</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="event_request_btn" href="{{ route('member.eventConfirm',[$event->id]) }}">REGISTER NOW</a>
                    </div>
                </div>
            </div>
        </div>


@endsection
@section('scripts')
    @parent

@endsection

@push('style')
    <style>
        .event_info_right img{ width: 100%}
        .event_box_large{ min-height: 635px;
        height: auto;
        }
        .modal-content{ min-height: 279px; height: auto; min-width: 389px; width: 100%}
    </style>

@endpush
