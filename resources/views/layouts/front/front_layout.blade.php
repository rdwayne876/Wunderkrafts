<!DOCTYPE html>
<html lang="en">
<head>
    <title>WunderKrafts - Home</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Fevicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg" color="#5bbad5')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/js/fancybox/source/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/jquery.scrollbar.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/mobile-menu.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/fonts/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css')}}">
</head>
<body class="home">
@include('layouts.front.front_header')

@yield('content')

@include('layouts.front.front_footer')

<script src="{{ asset('assets/front/js/jquery-1.12.4.min.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery.plugin-countdown.min.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery-countdown.min.js')}}"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/front/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('assets/front/js/magnific-popup.min.js')}}"></script>
<script src="{{ asset('assets/front/js/isotope.min.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery.scrollbar.min.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/front/js/mobile-menu.js')}}"></script>
<script src="{{ asset('assets/front/js/chosen.min.js')}}"></script>
<script src="{{ asset('assets/front/js/slick.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery.elevateZoom.min.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery.actual.min.js')}}"></script>
<script src="{{ asset('assets/front/js/fancybox/source/jquery.fancybox.js')}}"></script>
<script src="{{ asset('assets/front/js/lightbox.min.js')}}"></script>
<script src="{{ asset('assets/front/js/owl.thumbs.min.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery.scrollbar.min.js')}}"></script>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
<script src="{{ asset('assets/front/js/frontend-plugin.js')}}"></script>
</body>
</html>