@foreach($events as $event)
    @if(\App\Models\EventUser::getRegisterUser($event->id)!=false)
        @php
            $registerUser = \App\Models\EventUser::getRegisterUser($event->id);

            $amount = $registerUser->amount + $registerUser->spouse_amount + $registerUser->driver_amount;
        @endphp
    @endif
    <div class="dashboard_content event_view">

        <div class="event_banner_img school_event_box mb-5">
            @if($event->banner)
                @php
                    $url =$event->banner->getUrl();
                @endphp
            @else
                @php
                    $url = 'assets/alumni/images/gray.png';
                @endphp
            @endif
            <div class="event_banner" style="background: url({{ url($url) }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                <div class="event_date">
                    <p class="day">{{ date('j ', strtotime($event->event_date))  }}</p>
                    <p class="month">{{ date('M ', strtotime($event->event_date))  }}</p>
                </div>

                <div class="event_details">
                    <p class="event_title">{{ $event->name }}</p>
                    <p class="event_school_name">{{ $event->event_category->name }}</p>
                    <p class="event_location">{{ $event->address }}</p>
                </div>
            </div>

            <div class="going_box">
                <div class="participant_box">
                    <p>Going</p>

                    <div class="participant_img_count">
                        @foreach(\App\Models\Event::lastFiveusers() as $user)
                            <div class="participant_img">
                                @if($user->user->avatar)
                                    <img src="{{ $user->user->avatar->getUrl('thumb') }}" alt="{{ $user->user->name }}">
                                @else
                                    <img src="{{ url('assets/alumni/images/gray.png') }}" alt=" {{ $user->user->name }}">
                                @endif
                            </div>
                        @endforeach
                        <div class="participant_img participant_count ml_negative">
                            <p>{{ count($event->users) }}</p>
                        </div>
                    </div>
                </div>

                <div class="btn_box">
                    @if(\App\Models\EventUser::checkEventRegistration($event->id)==false)
                        <a href="{{ route('member.eventDetails',[$event->id,$event->slug]) }}" class="btn_green_large">Going</a>
                    @else
                        <a  class="btn_green_large">You already going</a>
                        @if($registerUser->payment_status!=1)

                            <form method="POST" action="{{ route('event-payment') }}">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="event_user_id" value="{{ $registerUser->event_user_id }}">
                                <input type="hidden" name="user_id" value="{{ $registerUser->user_id }}">
                                <input type="hidden" name="event_id" value="{{ $registerUser->event_id }}">
                                <input type="hidden" name="currency" value="BDT">
                                <button class="btn_red_large" style="background-color: orangered" type="submit">Make
                                    Payment
                                </button>
                            </form>
                        @else
                            <a class="btn_red_large">Your Payment Done</a>

                        @endif
                    @endif
                </div>
            </div>
        </div>
        @if(\App\Models\EventUser::getRegisterUser($event->id)!=false)
            @if($registerUser->payment_status==1)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                        <div class="id_box" id="member_id" style="width: 324px; height: 462px">
                            <div class="id_box_main participant_id">

                                <div class="id_img">
                                    @if($registerUser->user)
                                        <img src="{{ $registerUser->user->avatar->getUrl() }}" alt="{{ $registerUser->user->name??"" }}">
                                    @else
                                        <img src="{{ url('assets/alumni/images/participant.png') }}" alt="">
                                    @endif
                                </div>

                                <div class="id_info">
                                    <div class="id_name">{{ $registerUser->user->name??""  }}</div>
                                    <div class="id_school">{{ $registerUser->user->school->name??"" }}</div>
                                    <div class="id_district">{{$registerUser->user->district->name??""}}{{$registerUser->user->id_ssc_district??""}}</div>
                                </div>
                            </div>

                        </div>
                        <button style="margin-left: 32px" class="going_btn" id="doPrint">Download</button>
                    </div>
                    @if($registerUser->spouse==1)
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                            <div class="id_box spouse_id" id="spouse_id" style="width: 324px; height: 462px">
                                <div class="id_box_main spouse_id">
                                    <div class="id_img">
                                        @if($registerUser->user->spouse)
                                            <img src="{{ $registerUser->user->spouse->avatar->getUrl() }}" alt="{{ $registerUser->user->spouse->name??"" }}">
                                        @else
                                            <img src="{{ url('assets/alumni/images/participant.png') }}">
                                        @endif
                                    </div>

                                    <div class="id_info">
                                        <div class="id_name">{{ $registerUser->user->spouse->name??""  }}</div>
                                        <div class="id_school">Spouse: {{ $registerUser->user->name??""  }}</div>
                                        <div class="id_district">{{$registerUser->user->district->name??""}}{{$registerUser->user->id_ssc_district??""}}</div>
                                    </div>
                                </div>
                            </div>
                            <button style="margin-left: 32px" class="going_btn" id="spouse">Download</button>
                        </div>
                    @endif
                    <div id="only_mobile">
                        <a class="btn_green_large" href="{{ route('member.cardDownload') }}">
                            Download ID Card
                        </a>
                    </div>
                </div>
            @endif
        @endif
    </div>



@endforeach


@push('style')
    <style>
        @media (max-width: 767px) {
            #only_mobile {
                display: block;
            }
            #doPrint{display: none}
            #spouse{display: none}
        }

        @media (min-width: 767px) {
            #only_mobile {
                display: none;
            }

        }
    </style>
@endpush


@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script>

        //download pdf file
        // document.addEventListener('DOMContentLoaded', function(){
        //     document.getElementById("doPrint").addEventListener("click", function(){
        //         html2canvas(document.querySelector("#member_id")).then(canvas => {
        //             var imgData = canvas.toDataURL('image/png');
        //             var pdf = new jsPDF();
        //             pdf.addImage(imgData, 'PNG', 0, 0);
        //             pdf.save("download.pdf");
        //         });
        //     });
        // }, false);

        //print an image
        // window.addEventListener("load", function(){
        //     document.getElementById("spouse").addEventListener("click", function(){
        //         html2canvas(document.querySelector("#spouse_id")).then(canvas => {
        //             var imgData = canvas.toDataURL("image/png");
        //             var image = new Image();
        //             image.src = imgData;
        //             document.body.appendChild(image);
        //         });
        //     });
        // });
        //download image
        document.getElementById("doPrint").addEventListener("click", function(){
            html2canvas(document.querySelector("#member_id")).then(canvas => {
                var imgData = canvas.toDataURL("image/png");
                var link = document.createElement('a');
                link.href = imgData;
                link.download = "member.png";
                link.click();
            });
        });

        document.getElementById("spouse").addEventListener("click", function(){
            html2canvas(document.querySelector("#spouse_id")).then(canvas => {
                var imgData = canvas.toDataURL("image/png");
                var link = document.createElement('a');
                link.href = imgData;
                link.download = "spouse.png";
                link.click();
            });
        });
    </script>
@endpush
