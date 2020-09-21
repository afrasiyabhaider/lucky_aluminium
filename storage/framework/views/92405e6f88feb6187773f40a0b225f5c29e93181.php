<!doctype html>
<html lang="<?php echo e(config('app.locale'), false); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,600" rel="stylesheet" type="text/css">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap.min.css?v='.$asset_v), false); ?>">

    <!-- Styles -->
    <style>
        body {
            min-height: 100vh;
            background-color: #0e778f;
            color: #fff;
            /* background-image: url("img/index-bg.jpg"); */
            background-repeat: no-repeat;
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

        .navbar-default .navbar-nav>li>a:hover {
            color: #ccc;
        }

        .navbar-default .navbar-brand {
            color: #ccc;
        }
    </style>
</head>

<body>
    <?php echo $__env->make('layouts.partials.home_header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <?php echo $__env->make('layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src="<?php echo e(asset('plugins/jquery.steps/jquery.steps.min.js?v=' . $asset_v), false); ?>"></script>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/login.js?v=' . $asset_v), false); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo e(asset('AdminLTE/plugins/iCheck/icheck.min.js?v=' . $asset_v), false); ?>"></script>
    <?php echo $__env->yieldContent('javascript'); ?>
</body>

</html>