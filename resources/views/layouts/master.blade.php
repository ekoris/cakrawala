<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets') }}/images/icon/favicon.ico">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/metisMenu.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/typography.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/default-css.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/styles.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/responsive.css">
    <!-- modernizr css -->
    <script src="{{ asset('assets') }}/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>

	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('assets/images/icon/logo.png') }}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                           @include('layouts.side-navigation')
                           <li class=""><a href="maps.html"><i class="fa fa-cog"></i> <span>Profil</span></a></li>
                           <li class=""><a href="maps.html"><i class="fa fa-sign-out"></i> <span>Signout</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="header-area">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="breadcrumbs-area clearfix pull-left">
							@stack('breadcumb')
						</div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                    <span>2</span>
                                </i>
                                <div class="dropdown-menu bell-notify-box notify-box">
                                    <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                    <div class="nofity-list">
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                            <div class="notify-text">
                                                <p>You have Changed Your Password</p>
                                                <span>Just Now</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-content-inner">
                @yield('content')
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by Cakrawala</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>


    <script src="{{ asset('assets') }}/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('assets') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('assets') }}/js/metisMenu.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ asset('assets') }}/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="{{ asset('assets') }}/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="{{ asset('assets') }}/js/plugins.js"></script>
    <script src="{{ asset('assets') }}/js/scripts.js"></script>
</body>

</html>


