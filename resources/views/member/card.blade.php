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
    <a href="{{ url('member') }}"  style=""> Back to Home</a>
@if(auth())
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

                        </div>
                    @endif

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <button style="margin-left: 32px; background-color: #8DD7F5" class="btn_green_large" id="doPrint">Member Card Download</button>
                        <br>
                        <br>
                         @if($registerUser->spouse==1)
                        <button style="margin-left: 32px; background-color: #F6B9D3" class="btn_green_large" id="spouse">Spouse Card Download</button>

                         @endif
                        <br>
                        <br>
                        <a   href="{{ url('member') }}" style="margin-left: 32px;" class="btn_green_large" id="spouse">        Back to Dashboard</a>
                    </div>
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


