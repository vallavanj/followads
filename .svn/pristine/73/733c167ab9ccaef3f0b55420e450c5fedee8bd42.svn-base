@extends('layouts.layout')
@section('title')
@stop
@section('content')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   <b>Change</b> Password
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
	@if(Session::has('success'))
			<li class="alert alert-success">{{Session::get('success')}}<a class="close" data-dismiss="alert">×</a></li>
		@endif
      <p class="login-box-msg"></p>

		{{Form::open(array("enctype"=>"multipart/form-data","id"=>"demo-form","data-parsley-validate"=>""))}}
		<!--<div class="form-group has-feedback">
		{!!Form::label('old_password','Old Password')!!}
		  {!! Form::password('old_password',null,['class'=>'form-control',"placeholder"=>"Old Password"]) !!}
          
        </div>-->
        <div class="form-group has-feedback">
		{!!Form::label('new_password','New Password')!!}<span class="mandatory">*</span>
		  <!--{!! Form::password('new_password',null,['class'=>'form-control','required'=>'','placeholder'=>'New Password']) !!}-->
		  <input type="password" class = 'form-control' placeholder='New Password' required  data-parsley-minlength ='8'>
         
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
$(document).ready(function(){
  $('#demo-form').parsley();
});
 
</script>

</body>
