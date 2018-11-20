@extends('layouts.layout')
@section('title')
@stop
@section('content')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   <b>Forgot</b> Password
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
	@if(Session::has('success'))
			<li class="alert alert-success">{{Session::get('success')}}<a class="close" data-dismiss="alert">×</a></li>
		@endif
      <p class="login-box-msg"></p>

		{{Form::open(array("enctype"=>"multipart/form-data","id"=>"demo-form","data-parsley-validate"=>""))}}
        <div class="form-group has-feedback">
		{!!Form::label('email','Email')!!}<span class="mandatory">*</span>
		  {!! Form::email('email',null,['class'=>'form-control',"placeholder"=>"Email","required"=>""]) !!}
          <!--<span class="fa fa-lock form-control-feedback"></span>--->
        </div>
        <div class="row">
          <div class="col-8">
           <!-- <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>-->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
          </div>
          <!-- /.col -->
        </div>
		{{Form::close()}}
      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<script>
$(function () {
  $('#demo-form').parsley() 
  });
</script>
</body>
