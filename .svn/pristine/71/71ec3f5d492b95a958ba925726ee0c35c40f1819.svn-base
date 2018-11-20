
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add User </h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('user')}}">Manage User</a></li>
              <li class="breadcrumb-item active">Add User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
#error_msg{color:#FD2D01;}
</style>
<section class="content">
	<div class="container-fluid">
			<div class="row justify-content-md-center">
			  <!-- left column -->
			 <div class="col-md-6" >
            <!-- general form elements -->
            <div class="card card-primary">
                <!--<div class="card-header">
              <h3 class="card-title">Add User</h3>
              </div>-->
              <!-- /.card-header -->
              <!-- form start -->
			  {!! Form::open(array("enctype"=>"multipart/form-data","id"=>"demo-form","data-parsley-validate"=>"")) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('name','Name') !!}<span class="mandatory">*</span>
					{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Name','required'=>""]) !!}
					<a class="error_1">{{ $errors->first('name') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('email','Email') !!}
					{!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email','data-parsley-trigger'=>"change",'id'=>'email']) !!}
					<a class="error_1" id="error_email">{{ $errors->first('email') }}</a>
                  </div>
				  <!--<div class="form-group">
                    {!! Form::label('default_location','Location') !!}
					{!!Form::text('default_location',null,['class'=>'form-control','placeholder'=>'Location']) !!}
                  </div>-->
				  
				  <div class="form-group">
                    {!! Form::label('user_type_code','User Type') !!}<span class="mandatory">*</span>
					<select name="user_type_code" class="form-control" required>
					<option value="">Select User Type</option>
					<option value="sa">Super Admin</option>
					<option value="ad">Admin</option>
					<option value="iu">Internal User</option>
					</select>
                  </div>
					
				  
				  <div class="form-group">
                    {!! Form::label('default_language','Language') !!}
					<select class="form-control" name="default_language">
						<option>Please Select Language</option>
						@foreach($language as $lang)
					   <option value="{{$lang->language_id}}">{{$lang->name_in_english}}</option>
					   @endforeach
					   </select>
                  </div>
				  <div class="form-group">
                    {!! Form::label('mobile','Mobile') !!}<span class="mandatory">*</span><span id="error_msg"></span>
					{!!Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Mobile','required'=>"",'id'=>'mobile','data-parsley-minlength'=>'10','data-parsley-maxlength'=>'10']) !!}
					<a class="error_1" id="mobile_error">{{ $errors->first('mobile') }}</a>
                  </div>
				  <div class="form-group">
				  {!! Form::label('password','Password') !!}<span class="mandatory">*</span>
					  {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password','id'=>'exampleInputPassword1','required'=>"",'data-parsley-minlength'=>'8']) !!}
					  <a class="error_1">{{ $errors->first('password') }}</a>
                  </div>

				<!--  <div class="form-group">
					{!! Form::label('profile','Profile') !!}
                    <div class="input-group">
                      <div class="custom-file">
							<input type="file" name="profile" class="form-control">
                      </div>
                    </div>
                  </div>  -->
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit_button','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('user')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
	<script>
	/* jQuery(function ($) {
    $('form').validatr(); 
}); */
$(function () {
  $('#demo-form').parsley() 
  });
  
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('#email').keyup(function(){
	var email_value = $('#email').val();
	
	$.ajax({
		type:"POST",
	
		url:"user_email_unique",
		data:{
			email:email_value,
			_token:'{{ csrf_token() }}'
		},
		success:function(response)
		{
			/* alert(response); */
			if(response == 1)
			{
				$('#submit_button').attr('disabled','disabled');
				$('#error_email').html('<div id="email_unique">Email Id is exists</div>');
			/* 	alert('Email is exits') */
			}
			else
			{
				$('#error_email').html('');
				if($('#mobile_error').html()=="")
				{
				$('#submit_button').removeAttr('disabled');
				}
				
			}
		}
	})
});


$('#mobile').keyup(function(){
	var mobile_value = $(this).val();
	
	
	$.ajax({
		type:"POST",
	
		url:"user_mobile_unique",
		data:{
			mobile:mobile_value,
			_token:'{{ csrf_token() }}'
		},
		success:function(response)
		{
			/* alert(response); */
			if(response == 1)
			{
				$('#submit_button').attr('disabled','disabled');
				$('#mobile_error').html('<div id="mobile_unique">Mobile Number is exists</div>');
				
			}
			else
			{
				$('#mobile_error').html('');
				if($('#error_email').html() =="")
				{
				$('#submit_button').removeAttr('disabled');
				}
				
			}
		}
	})
	
	
});



  $("#mobile").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#error_msg").html("Digits Only").show().fadeOut("1000");
               return false;
    }
   });
	</script>
	
    </section>
</div>
	
