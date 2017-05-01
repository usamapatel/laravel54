<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Laravel Base</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Laravel Base" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Signika+Negative:400,600,700" rel="stylesheet">
        <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('css/admin/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('css/admin/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('css/admin/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/themes/blue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />

        @yield('page-style')

        <link href="{{ asset('css/admin/custom.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        @include('elements.admin.header')
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            @include('elements.admin.sidebar')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="page-content-body">
                        @yield('page-content')
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        @include('elements.admin.footer')
            <!-- END QUICK NAV -->
            <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('js/admin/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{ asset('js/admin/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/quick-sidebar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/quick-nav.min.js') }}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        @yield("page-script")
    </body>
</html>