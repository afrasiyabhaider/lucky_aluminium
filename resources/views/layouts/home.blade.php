<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,600" rel="stylesheet" type="text/css">

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css?v='.$asset_v) }}">

        <!-- Styles -->
        <style>
            body {
                min-height: 100vh;
                background-color: #243949;
                color: #fff;
                background-image: url("img/index-bg.jpg");
                background-repeat:no-repeat;
                background-position: center center;
                background-size: cover;
            }
            .navbar-default {
                background-color: transparent;
                border: none;
            }
            .navbar-static-top {
                margin-bottom: 19px;
            }
            .navbar-default .navbar-nav>li>a {
                color: #fff;
                font-weight: 600;
                font-size: 15px
            }
            .navbar-default .navbar-nav>li>a:hover{
                color: #ccc;
            }
            .navbar-default .navbar-brand {
                color: #ccc;
            }
        </style>
    </head>

    <body>
        @include('layouts.partials.home_header')
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>
        @include('layouts.partials.javascripts')
    <script src="{{ asset('plugins/jquery.steps/jquery.steps.min.js?v=' . $asset_v) }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('AdminLTE/plugins/iCheck/icheck.min.js?v=' . $asset_v) }}"></script>
    @yield('javascript')
    </body>
</html>