<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IHAP - Globe Hack for a Nation</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/sb-admin.css" rel="stylesheet">
    <link href="/assets/css/plugins/morris.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">IHAP - Globe Hack for a Nation</a>
            </div>
            <ul class="nav navbar-right top-nav">
                <?php if(Auth::guest()): ?>
                <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                <?php else: ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo e(Auth::user()->name); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php /*
                        <li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a></li>
                        <li class="divider"></li>
                        */ ?>
                        <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active"><a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
                    <?php if(!Auth::guest()): ?>
                    <li><a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a></li>
                    <li><a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a></li>
                    <li><a href="<?php echo e(url('/auth/globe')); ?>"><i class="fa fa-fw fa-file"></i> GlobeApi</a></li>
                    <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-fw fa-dashboard"></i> Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard <small>Statistics Overview</small></h1>
                        <ol class="breadcrumb">
                            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- <div><?php echo $__env->yieldContent('content'); ?></div> -->
                <ul class='broadcasted'>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <?php /*
    <script src="/assets/js/plugins/morris/raphael.min.js"></script>
    <script src="/assets/js/plugins/morris/morris.min.js"></script>
    <script src="/assets/js/plugins/morris/morris-data.js"></script>
    */ ?>
    <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        //Pusher.logToConsole = true;
        var pusher = new Pusher('1342ad200fbd579a1922', {encrypted: true});
        var channel = pusher.subscribe('public');
        channel.bind('activity.detected', function(data) {
            console.debug(data);
            $('.broadcasted').append("<li>" + data.activity.description + "</li>");
        });
    </script>
</body>
</html>
