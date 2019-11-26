<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LOC TROI GROUP | LOC TROI - VIEN THI</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('themes/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('themes/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{URL::asset('themes/gentelella/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{URL::asset('themes/gentelella/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{URL::asset('themes/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{URL::asset('themes/gentelella/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{URL::asset('themes/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{URL::asset('themes/gentelella/build/css/custom.min.css')}}" rel="stylesheet">

    @yield('css')
    

    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        

        <!-- top navigation -->
        @include('layouts.themes.gentelella.backend_horizontal_menu')
        <!-- /top navigation -->

        <!-- page content -->
        @yield('page_content')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by Colorlib
            & Develop by Hoang Anh - 0946 857 875
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{URL::asset('themes/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{URL::asset('themes/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::asset('themes/gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{URL::asset('themes/gentelella/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{URL::asset('themes/gentelella/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{URL::asset('themes/gentelella/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{URL::asset('themes/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{URL::asset('themes/gentelella/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{URL::asset('themes/gentelella/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{URL::asset('themes/gentelella/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{URL::asset('themes/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{URL::asset('themes/gentelella/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{URL::asset('themes/gentelella/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{URL::asset('themes/gentelella/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    
    <!-- bootstrap-daterangepicker -->
    <script src="{{URL::asset('themes/gentelella/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- bootstrap-datetimepicker -->    
    <script src="{{URL::asset('themes/gentelella/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{URL::asset('themes/gentelella/build/js/custom.min.js')}}"></script>

    @yield('javascript')
	
  </body>
</html>
