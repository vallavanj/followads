
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="popup_title">Add Promotion Section Advertisement</h1>
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
				    <input type="hidden" name="promotion_id" value="<?php echo $promotion['0']; ?>">
                    {!! Form::label('business_name','Business Name') !!}<span class="mandatory">*</span>
					<select name="business_name" class="form-control" required="" id="bid">
					<option value="">--Please select your Business--</option>
					@foreach($business as $wal)
					<option value="{{$wal->business_id}}">{{$wal->name}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('wallet') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('sequence','Sequence No') !!}<span class="mandatory">*</span>
					{!! Form::text('sequence',$seq,['class'=>'form-control','placeholder'=>'Value','required'=>"",'readonly']) !!}
                  </div>
					<div id="pro_ads_field"></div>
				   <div class="form-group">
					{!! Form::text('promotion_section_id',$pro_id,['class'=>'form-control','placeholder'=>'	promotion_section_id','required'=>"",'hidden']) !!}
                  </div> 
				 
					
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('promotion_section_ads')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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
  
  $('#bid').change(function(){
	  var bid = $(this).val();
	  $.ajax({
			type:"POST",
			url:"{{URL('get_bus_ad')}}",
			data:{
				bid:bid,
				_token: '{{ csrf_token() }}'
			},success:function(response)
			
			{
				/* alert(response); */
				$('#pro_ads_field').html(response);
				
			}
			
		});
	  
  });
  
  
  
  
</script>
