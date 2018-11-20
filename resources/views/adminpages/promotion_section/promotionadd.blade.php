
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Promotion Section</h1>
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
					
					{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Name','required'=>'']) !!}

					<a class="error_1">{{ $errors->first('business_name') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('no_of_ads','No of ads') !!}<span class="mandatory">*</span>
					{!!Form::text('no_of_ads',null,['class'=>'form-control','placeholder'=>'No of ads','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('no_of_ads') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('height','Height ') !!}
					{!!Form::text('height',null,['class'=>'form-control','placeholder'=>'Height']) !!}
					<a class="error_1">{{ $errors->first('offer_code') }}</a>
                  </div>
				  <div class="form-group">
                   {!! Form::label('width','Width ') !!}
					{!!Form::text('width',null,['class'=>'form-control','placeholder'=>'Width']) !!}
					<a class="error_1">{{ $errors->first('offer_code') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('caption','Caption') !!}
					{!!Form::text('caption',null,['class'=>'form-control','placeholder'=>'Caption']) !!}
					<a class="error_1">{{ $errors->first('caption') }}</a>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit_button','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('promotion_section')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
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

/* $('#email').change(function(){
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
			alert(response);
			if(response == 1)
			{
				$('#submit_button').addClass('disabled');
				$('#email').siblings().html('<div class="validatr-message" style="color: rgb(240, 68, 77); background-color: rgb(255, 203, 203); border: 1px solid rgb(228, 166, 175); padding: 2px 6px; border-radius: 2px; position: absolute; top: 511.5px; left: 358px;>EmailId is exists</div>');
			}
			else
			{
				$('#submit_button').removeClass('disabled');
				$('#error_email').prepend('<span class="validatr-message">EmailId is exists</span>');
			}
		}
	})
}); */

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
	
	</script>
    </section>
</div>
	
