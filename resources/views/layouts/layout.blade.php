<!DOCTYPE html>
<html>
<head>
<title>
		Followads Dashboard
</title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('admin/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('admin/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('admin/dist/css/adminlte.min.css')}}">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::asset('admin/iCheck/flat/blue.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{URL::asset('admin/morris/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{URL::asset('admin/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{URL::asset('admin/datepicker/datepicker3.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::asset('admin/daterangepicker/daterangepicker-bs3.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{URL::asset('admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::asset('admin/datatables/dataTables.bootstrap4.min.css')}}">
  <!--Style.css-->
  <link rel="stylesheet" href="{{URL::asset('admin/css/style.css')}}">
  <!--Css for Promotion UI-->
  <link rel="stylesheet" href="{{URL::asset('admin/css/jquery-ui.css')}}">
  <!---Script-->
 
  <script src="{{URL::asset('admin/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{URL::asset('admin/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src=" {{URL::asset('admin/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src=" {{URL::asset('admin/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{URL::asset('admin/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src=" {{URL::asset('admin/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{URL::asset('admin/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src=" {{URL::asset('admin/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{URL::asset('admin/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{URL::asset('admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{URL::asset('admin/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::asset('admin/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=" {{URL::asset('admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('admin/dist/js/demo.js')}}"></script>
<!--Data Tables-->
<script src="{{URL::asset('admin/datatables/jquery.dataTables.min.js')}}"></script>
<!--DatePicker-->
<script src="{{URL::asset('admin/js/date-time-picker.min.js')}}"></script>
<!--Parsley Js For Validation-->
<script src="{{URL::asset('admin/js/parsley.min.js')}}"></script>
<!--Jquery ui js for Promotion Page-->
<!--<script src="{{URL::asset('admin/js/jquery-ui.js')}}"></script>
<script src="{{URL::asset('admin/js/jquery-3.1.1.js')}}"></script>-->
<!--<script src="{{URL::asset('admin/js/jquery-ui.min.js')}}"></script>-->
<!---<script src="{{URL::asset('admin/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('admin/jquery-validation/dist/jquery.validate.js')}}"></script>
<script src="{{URL::asset('validatr-master/dist/validatr.min.js')}}"></script>--->
<!-- CK Editor -->
<script src="{{URL::asset('admin/ckeditor/ckeditor.js')}}"></script>

</head>
<body>

@yield('content')

</body>
</html>


