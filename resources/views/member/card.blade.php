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
</head>
<body>

@if(auth()->id()===2)
    <a href="{{ url('member') }}"  style=""> Back to Home</a>
    @foreach($events as $event)
        @if(\App\Models\EventUser::getRegisterUser($event->id)!=false)
            @php
                $registerUser = \App\Models\EventUser::getRegisterUser($event->id);

                $amount = $registerUser->amount + $registerUser->spouse_amount + $registerUser->driver_amount;
            @endphp
        @endif
        <div class="dashboard_content event_view">
            @if(\App\Models\EventUser::getRegisterUser($event->id)!=false)
                @if($registerUser->payment_status==1)
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 ">
                            <div class="id_box" id="member_id">
                                <div class="id_box_main">
                                    <div class="id_logo">
                                        <img src="{{ url('assets/alumni/images/1984 lOGO_Final.png') }}">
                                    </div>

                                    <div class="id_heading">
                                        <p>SSC 1984 Bangladesh</p>
                                    </div>

                                    <div class="id_img_main">
                                        <div class="id_img">
                                            @if($registerUser->user)
                                                <img src="{{ $registerUser->user->avatar->getUrl() }}" alt="{{ $registerUser->user->name??"" }}">
                                            @else
                                                <img src="{{ url('assets/alumni/images/participant.png') }}" alt="">
                                            @endif
                                        </div>

                                        <div class="id_event">
                                            <p class="id_event_heading">
                                                <span>Central</span>
                                                <span>Get-Together</span>
                                            </p>
                                            @php
                                                $date = \Carbon\Carbon::createFromFormat('d-m-Y', $event->event_date);
                                              $formattedDate = $date->format('d F Y');
                                            @endphp
                                            <p class="id_event_date">{{ $formattedDate??"" }}</p>

                                        </div>

                                    </div>

                                    <div class="participant_info">
                                        <p class="id_name">{{ $registerUser->user->name??""  }}</p>
                                        <p class="id_school">{{ $registerUser->user->school->name??"" }}</p>
                                    </div>

                                    <p class="id_district">District ID No: <span>{{ $registerUser->user->id_ssc_district??"" }}</span></p>

                                    <div class="id_venue">
                                        <p class="id_venue">Venue: {{ $event->venue??"" }} </p>
                                    </div>
                                </div>

                            </div>
                            <button id="doPrint">Download</button>
                        </div>
                        @if($registerUser->spouse==1)
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div id="wrapper">
                                    <div class="id_box spouse_id" id="spouse_id">
                                        <div class="id_box_main">
                                            <div class="id_logo">
                                                <img src="{{ url('assets/alumni/images/1984 lOGO_Final.png') }}">
                                            </div>

                                            <div class="id_heading">
                                                <p>SSC 1984 Bangladesh</p>
                                            </div>

                                            <div class="id_img_main spouse_main">
                                                <div class="spouse_img_box">
                                                    <div class="id_img">
                                                        @if($registerUser->user->spouse)
                                                            <img src="{{ $registerUser->user->spouse->avatar->getUrl() }}" alt="{{ $registerUser->user->spouse->name??"" }}">
                                                        @else
                                                            <img src="{{ url('assets/alumni/images/participant.png') }}">
                                                        @endif
                                                    </div>

                                                    <p>Spouse</p>
                                                </div>

                                                <div class="id_event">
                                                    <p class="id_event_heading">
                                                        <span>Central</span>
                                                        <span>Get-Together</span>
                                                    </p>

                                                    @php
                                                        $date = \Carbon\Carbon::createFromFormat('d-m-Y', $event->event_date);
                                                      $formattedDate = $date->format('d F Y');
                                                    @endphp
                                                    <p class="id_event_date">{{ $formattedDate??"" }}</p>
                                                </div>
                                            </div>

                                            <div class="participant_info spouse_info">
                                                <p>Spouse Name: {{ $registerUser->user->spouse->name??""  }}</p>
                                                <p>Associated to: <span>{{ $registerUser->user->name??"" }}</span></p>
                                            </div>

                                            <div class="id_venue">
                                                <p>Venue: {{ $event->venue??"" }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <button id="spouse">Download</button>
                            </div>
                        @endif
                    </div>

                @endif
            @endif
        </div>
    @endforeach
@endif
<!-- ---------------------- JS start ---------------------- -->
<script src="{{ url('assets/alumni/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ url('assets/alumni/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/alumni/js/script.js') }}"></script>
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
</body>
</html>


