<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Timesharesimplyfied</title>    
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/auth.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/header-footer.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/plugins/apexcharts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/plugins/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/home.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/notification.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/settings.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/contracts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/support.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/pointsestimation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/coupon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/notification.css')}}">
    <script src="{{asset('public/admin_assets/js/jquery-3.7.0.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/plugins/Iconsax/geticons.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/plugins/apexcharts/apexcharts.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/plugins/owlcarousel/owl.carousel.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin_assets/js/function.js')}}" type="text/javascript"></script>
</head>

<body class="main-site">
    <div class="page-body-wrapper">
         @php
            $route_name = \Request::route()->getName();    
        @endphp
        
        @include('admin/sidebar')
        <div class="body-wrapper">
            @include('admin/header')          
            @section('container')
            @show
        </div>
    </div>
    @yield('scripts')
</body>
</html>
