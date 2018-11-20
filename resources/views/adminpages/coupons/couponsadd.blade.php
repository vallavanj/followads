
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Coupons</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('coupons')}}">Manage Coupons</a></li>
              <li class="breadcrumb-item active">Add Coupons</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
	<div class="container-fluid">
			<div class="row justify-content-md-center">
			  <!-- left column -->
			 <div class="col-md-6">
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
                    {!! Form::label('business_name','Business Name') !!}<span class="mandatory">*</span>
					<select name="business_name" class="form-control" required="">
					<option value="">--Please select your Business--</option>
					@foreach($business as $wal)
					<option value="{{$wal->business_id}}">{{$wal->name}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('wallet') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('code','Code') !!}<span class="mandatory">*</span>
					{!!Form::text('code',null,['class'=>'form-control','placeholder'=>'Code','required'=>"",'id'=>'coupon_code']) !!}
					<a class="error_1" id="code_unique">{{ $errors->first('code') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('value','Value') !!}<span class="mandatory">*</span>
					{!! Form::text('value',null,['class'=>'form-control','placeholder'=>'Value','required'=>"",'data-parsley-type'=>"number"]) !!}
                  </div> 
				 
					 <div class="form-group">
                    {!! Form::label('max_redemption_count','Max Redemption Count') !!}
					{!! Form::text('max_redemption_count',null,['class'=>'form-control','placeholder'=>'Max Redemption Count','data-parsley-type'=>"number"]) !!}
                  </div> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
				{!! Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit_button','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('coupons')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
    </section>
</div>
<script>
	/* $('#reservation').daterangepicker(); */
	$('#validfrom').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy/MM/dd HH:mm:ss'
				});
				$('#validto').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy/MM/dd HH:mm:ss'
				});
/* 	jQuery(function ($) {
    $('form').validatr(); 
}); */

$(function () {
  $('#demo-form').parsley() 
  });
  
  
   $('#coupon_code').keyup(function(){
	  
	  var coupon_code = $('#coupon_code').val();
	  $.ajax({
		type:"POST",
	
		url:"coupon_code_unique",
		data:{
			coupon_code:coupon_code,
			_token:'{{ csrf_token() }}'
		},
		success:function(response)
		{
			/* alert(response); */
			if(response == 1)
			{
				$('#submit_button').attr('disabled','disabled');
				$('#code_unique').html('<div id="offercode_unique">Code is exists</div>');
			/* 	alert('Email is exits') */
			}
			else
			{
				$('#code_unique').html('');
				$('#submit_button').removeAttr('disabled');
			}
		}
	})
  });
  
  
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  
</script>
