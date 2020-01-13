<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <title>@yield("titulo") | ReporsitorioCTIAM</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/Ionicons/css/ionicons.min.css")}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/jvectormap/jquery-jvectormap.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/AdminLTE.min.css")}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/skins/_all-skins.min.css")}}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset("assets/dropzone/css/dropzone.css")}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
    <!-- css Dumar -->
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-blue fixed sidebar-mini">
    
    <div class="wrapper">

      <!-- header -->
        @include("theme/$theme/header")
      <!-- fin header -->
      
      <!-- aside main -->
        @include("theme/$theme/asidemain")
      <!-- fin aside main -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
          @yield('titulo1')
        </section>

        <!-- Main content -->
        <section class="content">
          @yield('contenido')
        </section>
        <!-- /.content -->

      </div>
      <!-- /.content-wrapper -->

      <!-- footer -->
        @include("theme/$theme/footer")
      <!-- fin footer-->

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{asset("assets/$theme/bower_components/jquery/dist/jquery.min.js")}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset("assets/$theme/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
    <!-- FastClick -->
    <script src="{{asset("assets/$theme/bower_components/fastclick/lib/fastclick.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>
    <!-- Sparkline -->
    <script src="{{asset("assets/$theme/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js")}}"></script>
    <!-- jvectormap  -->
    <script src="{{asset("assets/$theme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>
    <script src="{{asset("assets/$theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset("assets/$theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
    <!-- ChartJS -->
    <script src="{{asset("assets/$theme/bower_components/chart.js/Chart.js")}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset("assets/$theme/dist/js/pages/dashboard2.js")}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>
    <!-- js Dumar -->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
    <script src="{{asset("js/dumar.js")}}"></script>
     @yield('script')
  </body>
</html>