<!DOCTYPE html>
<html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

    <title><?php echo $__env->yieldContent('title'); ?></title> 

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/font-awesome/css/font-awesome.min.css?v='.$asset_v), false); ?>">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap.min.css?v='.$asset_v), false); ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/css/AdminLTE.min.css?v='.$asset_v), false); ?>">

    <!-- app css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <?php echo $__env->yieldContent('content'); ?>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js?v=$asset_v"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?v=$asset_v"></script>
    <![endif]-->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo e(asset('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js?v=' . $asset_v), false); ?>"></script>
    <script src="<?php echo e(asset('plugins/printThis.js?v=' . $asset_v), false); ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js?v=' . $asset_v), false); ?>"></script>
</body>

</html>