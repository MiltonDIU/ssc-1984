<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{ url('assets/alumni/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ url('assets/alumni/css/style.css')}}">
    <!-- ---------------------- CSS end ---------------------- -->
</head>
<body>
<!-- ---------------------- navbar start ---------------------- -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Public News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item nav_btn">
                    <a class="btn_red" href="#">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- ---------------------- navbar end ---------------------- -->

<!-- ---------------------- login end ---------------------- -->
<section id="login" class="mtn_white_box">
    <div class="container">
        <div class="login_box content_box white_box">
            <div class="logo_box">
                <img src="{{ url('assets/alumni/images/logo.png')}}" alt="">
            </div>

            @yield('content')
        </div>
    </div>
</section>
<!-- ---------------------- login end ---------------------- -->

<!-- ---------------------- JS start ---------------------- -->
<script src="{{ url('assets/alumni/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ url('assets/alumni/js/script.js')}}"></script>
<!-- ---------------------- JS end ---------------------- -->
</body>
</html>
