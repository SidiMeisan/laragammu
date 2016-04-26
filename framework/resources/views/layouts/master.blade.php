<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>{{ config('laragammu.appname') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        {!! Html::style("http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all") !!}
        {!! Html::style("assets/global/plugins/font-awesome/css/font-awesome.min.css") !!}
        {!! Html::style("assets/global/plugins/simple-line-icons/simple-line-icons.min.css") !!}
        {!! Html::style("assets/global/plugins/bootstrap/css/bootstrap.min.css") !!}
        {!! Html::style("assets/global/plugins/uniform/css/uniform.default.css") !!}
        {!! Html::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css") !!}

        {!! Html::style("assets/global/plugins/datatables/datatables.min.css") !!}
        {!! Html::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css") !!}

        {!! Html::style("assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css") !!}
        {!! Html::style("assets/global/plugins/morris/morris.css") !!}
        {!! Html::style("assets/global/plugins/fullcalendar/fullcalendar.min.css") !!}
        {!! Html::style("assets/global/plugins/jqvmap/jqvmap/jqvmap.css") !!}
        {!! Html::style("assets/global/css/components-md.min.css") !!}
        {!! Html::style("assets/global/css/plugins-md.min.css") !!}
        {!! Html::style("assets/layouts/layout/css/layout.min.css") !!}
        {!! Html::style("assets/layouts/layout/css/themes/darkblue.min.css") !!}
        {!! Html::style("assets/layouts/layout/css/custom.min.css") !!} 
        <link rel="shortcut icon" href="favicon.ico" /> 
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <div class="page-logo">
                    <a href="index.html">
                        {!! Html::image('assets/layouts/layout/img/logo.png', config('laragammu.appname'), 
                        array('class' => 'logo-default')) !!} 
                    </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                {!! Html::image('assets/layouts/layout/img/avatar3_small.jpg', '', array('class' => 'img-circle')) !!}
                                <span class="username username-hide-on-mobile"> {{ Sentinel::getUser()->first_name .' '. Sentinel::getUser()->last_name }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{ url('profile') }}">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                                <li>
                                    <a href="{{ url('logout') }}">
                                        <i class="icon-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="clearfix"> </div>
        <div class="page-container">
            @include('includes.sidebarmenu')
            <section class="content">
            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div></div>
            </section>
        </div>

        <div class="page-footer">
            <div class="page-footer-inner"> {{ date('Y') }} &copy; {{ config('laragammu.appname') }} </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>

        {!! Html::script('assets/global/plugins/jquery.min.js') !!} 
        {!! Html::script('assets/global/plugins/bootstrap/js/bootstrap.min.js') !!} 
        {!! Html::script('assets/global/plugins/js.cookie.min.js') !!}
        {!! Html::script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!} 
        {!! Html::script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!} 
        {!! Html::script('assets/global/plugins/jquery.blockui.min.js') !!} 
        {!! Html::script('assets/global/plugins/uniform/jquery.uniform.min.js') !!} 
        {!! Html::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!} 

        {!! Html::script('assets/global/plugins/moment.min.js') !!}
        {!! Html::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
        {!! Html::script('assets/global/plugins/morris/morris.min.js') !!}
        {!! Html::script('assets/global/plugins/morris/raphael-min.js') !!}
        {!! Html::script('assets/global/plugins/counterup/jquery.waypoints.min.js') !!}
        {!! Html::script('assets/global/plugins/counterup/jquery.counterup.min.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/amcharts/amcharts.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/amcharts/serial.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/amcharts/pie.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/amcharts/radar.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/amcharts/themes/light.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/amcharts/themes/patterns.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/amcharts/themes/chalk.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/ammap/ammap.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') !!}
        {!! Html::script('assets/global/plugins/amcharts/amstockcharts/amstock.js') !!}
        {!! Html::script('assets/global/plugins/fullcalendar/fullcalendar.min.js') !!}
        {!! Html::script('assets/global/plugins/flot/jquery.flot.min.js') !!}
        {!! Html::script('assets/global/plugins/flot/jquery.flot.resize.min.js') !!}
        {!! Html::script('assets/global/plugins/flot/jquery.flot.categories.min.js') !!}
        {!! Html::script('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') !!}
        {!! Html::script('assets/global/plugins/jquery.sparkline.min.js') !!}
        {!! Html::script('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') !!}

        {!! Html::script('assets/global/scripts/datatable.js') !!}
        {!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
        {!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}

        

        {!! Html::script('assets/global/scripts/app.min.js') !!}

        {!! Html::script('assets/pages/scripts/table-datatables-managed.min.js') !!}

        {!! Html::script('assets/pages/scripts/dashboard.min.js') !!} 
        {!! Html::script('assets/layouts/layout/scripts/layout.min.js') !!} 
        {!! Html::script('assets/layouts/layout/scripts/demo.min.js') !!} 

    </body>

</html>