<style>
.select2-selection__choice__remove {
	color:#fff !important;	
}
.select2-selection__choice {
	background-color: #007bff !important;
    border-color: #006fe6 !important;
    padding: 1px 10px !important;
    color: #fff !important;
}
.select2-container--default .select2-search--inline .select2-search__field {
	width:334px !important;
}
</style>

  
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Advertisement</h1>
          </div>
           <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads')}}">Manage Ads</a></li>
              <li class="breadcrumb-item active">Add Ads</li>
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
					
					
						<select class="form-control" name="business_name" required="">
							<option value="">--Please Select Business Name--</option>
							@foreach($business as $busi)
								<option value="{{$busi->business_id}}">{{$busi->name}}</option>
							@endforeach
						</select>
					
					<a class="error_1">{{ $errors->first('business_name') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('ads_name','Advertisement Name') !!}<span class="mandatory">*</span>
					{!!Form::text('ads_name',null,['class'=>'form-control','placeholder'=>'Name','required'=>""]) !!}
					<a class="error_1">{{ $errors->first('ads_name') }}</a>
                  </div>
				  <div class="form-group">
                  {!! Form::label('valid_from','Valid From') !!}<span class="mandatory">*</span>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
					{!! Form::text('valid_from',null,['class'=>'form-control float-right','placeholder'=>'Valid From','id'=>"validfrom",'required'=>""]) !!}
                  </div>
                  <!-- /.input group -->
                </div>
				<div class="form-group">
					 {!! Form::label('valid_to','Valid To') !!}<span class="mandatory">*</span>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
					{!! Form::text('valid_to',null,['class'=>'form-control float-right','placeholder'=>'Valid To','id'=>'validto','required'=>""]) !!}
                  </div>
                  <!-- /.input group -->
                </div>
				 <div class="form-group">
					{!! Form::label('ads_icon','Advertisment icon') !!}<span class="mandatory">*</span> <br>
                    <div class="input-group">
						<div class="custom-filex w-100">
							<input type="file" name="ads_icon" class="form-control file_upload" accept =".jpg,.png" required="">
						</div>
                    </div>
                  </div>
                
				
				 <div class="form-group">
					<p>{!! Form::label('ads_image','Advertisement Image') !!}<span class="mandatory">*</span> <br><a class="btn btn-sm btn-default" id="add_image_field" href="#"><i class="fa fa-plus" aria-hidden="true"></i> Add Image</a> <a class="btn btn-sm btn-default" id="remove_image_field" href="#"><i class="fa fa-times" aria-hidden="true"></i> Remove Image</a>
					</p>
                    <div class="input-group">
                      <div class="custom-filex w-100">
					  <input type="file" name="ads_image[]" class="form-control file_upload"  accept =".jpg,.png" required="">
						<!--{!!Form::file('ads_image',['class'=>'custom-file-input','id'=>'exampleInputFile','multiple','required']) !!}-->
						
                      </div>
                    </div>
                  </div>
				  <div id="add_img_field">
				  </div>
				   <div class="form-group">
                    {!! Form::label('category_name','Category Name') !!}<span class="mandatory">*</span><br>
					
					<select class="form-control select2"  name="category_name[]" required multiple="multiple" data-placeholder="category name">
							@foreach($result_parent_id_group as $value)
								<optgroup label="{{$value['parent_cat']}}">
								<?php   $get_child_val=explode(",", $value['children_value']);
										$parent_category_id=explode(",", $value['parent_category_id']);
										foreach (array_combine($parent_category_id, $get_child_val) as $parent_category_id => $get_child_val) {
									echo '<option value="' . $parent_category_id . '">' . $get_child_val . '</option>';
										}   ?>
								</optgroup>
							@endforeach
							@foreach($category as $categ)
									<option value="{{$categ->category_id}}">{{$categ->category_name}}</option>
							@endforeach
							
					</select>
					
						
			   
			
				
					<a class="error_1">{{ $errors->first('category_name') }}</a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('search_term','Search Terms') !!}<span class="mandatory">*</span>
					{!!Form::text('search_term',null,['class'=>'form-control','placeholder'=>'Search Terms','required'=>'','id'=>'search_term']) !!}
					<a class="error_1" id='searchterm_error'></a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('offer_code','Offer Code') !!}
					{!!Form::text('offer_code',null,['class'=>'form-control','placeholder'=>'Offer Code','id'=>'offer_code']) !!}
					<a class="error_1" id="offer_error"></a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('offer_type_code','Offer Type Code') !!}
					<select class="form-control" name="offer_type_code" >
					<option value="">--Please Select Offer Type Code --</option>
					<option value="barcode">Barcode</option>
					<option value="qrcode">QRcode</option>
					<option value="plaincode">Plaincode</option>
					</select>
					<a class="error_1">{{ $errors->first('offer_type_code') }}</a>
                  </div>
				  <!--Lang Set-->
				  <div class="add_lang_ext">
				  <div class="form-group">
				 <a href="#" id="add_lang_1" class="btn btn-sm btn-default"><i class="fa fa-plus" aria-hidden="true"></i>  Add Language
 </a> <a href="#" id="remove_lang_1" class="btn btn-sm btn-default"><i class="fa fa-times" aria-hidden="true"></i>
 Remove Language</a> <hr>
                    {!! Form::label('language_name','Language Name') !!} <span class="mandatory">*</span>
					
					<br>
					<?php /* <select class="form-control" name="language_name[]">
					<option value="">--Select Language--</option>
					@foreach($lang as $lan)
					<option value="{{$lan->language_id}}">{{$lan->name_in_english}}</option>
					@endforeach
					</select> 
					<a class="error_1">{{ $errors->first('language_name') }}</a>*/ ?>
					@foreach($lang as $lan)
					<input type="radio" name="language_name[0]" value="{{$lan->language_id}}" class="" required=""> {{$lan->name_in_english}} 
					@endforeach
                  </div>
				   <div class="form-group">
                    {!! Form::label('desc','Description') !!}<span class="mandatory">*</span>
					{!!Form::textarea('desc[]',null,['class'=>'form-control','placeholder'=>'Description','col'=>5,'rows'=>3,"required"=>""]) !!}
					<a class="error_1">{{ $errors->first('desc') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('caption','Caption') !!}
					{!!Form::text('caption[]',null,['class'=>'form-control','placeholder'=>'Caption']) !!}
					<a class="error_1">{{ $errors->first('caption') }}</a>
                  </div>
				  <hr>
				  </div>
				  <div id="add_lang">
				  
				  </div>
				  
				</div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit_button','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('ads_list')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
    </section>
</div>

<script src="{{URL::asset('admin/js/parsley.min.js')}}"></script>
<script src="{{URL::asset('admin/select2/select2.full.min.js')}}"></script>
<script>
$(document).ready(function () {
    $('.select2').select2();
  });
$('#add_image_field').click(function(){
	/* $('#add_img_field').html('<div class="input-group"><div class="custom-file"><input type="file" name="business_image[]" class="form-control></div></div></div>'); */
	$('#add_img_field').append('<p><input type="file" name="ads_image[]" class="form-control" required="" accept =".jpg,.png"> </p>');
});

$('#remove_image_field').on('click', function () {
    $('#add_img_field input:file:last').remove();
});


	/* $('#reservation').daterangepicker(); */
	/* var startDate;
	$('#validfrom').dateTimePicker({
                mode: 'date',
               
				startDate: '+1d',
                format: 'dd-MM-yyyy',
				todayHighlight: true,
				autoclose: true,
				onChangeDateTime: function(dp,$input){
                               startDate = $("#validfrom").val();
                                        }
				});
				$('#validto').dateTimePicker({
                mode: 'date',
               
				startDate: '+1d',
				format: 'dd-MM-yyyy',
				todayHighlight: true,
				autoclose: true,
				  onClose: function(current_time, $input){
                            var endDate = $("#validto").val();
                            if(startDate>endDate){
                                   alert('Please select correct date');
                             }
             }
				}); */
				
	$("#validfrom").datepicker({
		  mode: 'date',
		format: 'dd-mm-yyyy',
		autoclose: true,
}).on('changeDate', function (selected) {
    var startDate = new Date(selected.date.valueOf());
    $('#validto').datepicker('setStartDate', startDate);
}).on('clearDate', function (selected) {
    $('#validto').datepicker('setStartDate', null);
});

$("#validto").datepicker({
	  mode: 'date',
  format: 'dd-mm-yyyy',
   autoclose: true,
  
}).on('changeDate', function (selected) {
   var endDate = new Date(selected.date.valueOf());
   $('#validfrom').datepicker('setEndDate', endDate);
}).on('clearDate', function (selected) {
   $('#validfrom').datepicker('setEndDate', null);
});


/* down vote
accepted
Try this. Its working for me. */

/* var startDate;
         $("#validfrom").dateTimePicker({
                     timepicker:true,
                     closeOnDateSelect:false,
                     closeOnTimeSelect: true,
                     initTime: true,
                     format: 'dd-MM-yyyy',
                     minDate: 0,
                     roundTime: 'ceil',
                     onChangeDateTime: function(dp,$input){
                               startDate = $("#validfrom").val();
                                                           }
                                                           });
        $("#validto").dateTimePicker({
                     timepicker:true,
                     closeOnDateSelect:false,
                     closeOnTimeSelect: true,
                     initTime: true,
                     format: 'dd-MM-yyyy',
                     onClose: function(current_time, $input){
                            var endDate = $("#validto").val();
                            if(startDate>endDate){
                                   alert('Please select correct date');
                             }
             }
              }); */


				
	/* Tooltip */
/* 	jQuery(function ($) {
    $('form').validatr(); 
}); */
/* Add And Remove Language */
$("#add_lang_1").click(function(){
	var len = $('.add_lang_ext').length;
	
	$('#add_lang').append('<div class="add_lang_ext"><hr><div class="form-group">{!! Form::label('language_name','Language Name') !!}<span class="mandatory">*</span><br> @foreach($lang as $lan)<input type="radio" name="language_name['+len+']" value="{{$lan->language_id}}" class="" required=""> {{$lan->name_in_english}} @endforeach<a class="error_1">{{ $errors->first('language_name') }}</a></div><div class="form-group">{!! Form::label('desc','Description') !!}<span class="mandatory">*</span>{!!Form::textarea('desc[]',null,['class'=>'form-control','placeholder'=>'Description','col'=>5,'rows'=>3,"required"=>""]) !!}<a class="error_1">{{ $errors->first('desc') }}</a></div> <div class="form-group">{!! Form::label('caption','Caption') !!}{!!Form::text('caption[]',null,['class'=>'form-control','placeholder'=>'Caption']) !!}<a class="error_1">{{ $errors->first('caption') }}</a></div></div>')
});

$('#remove_lang_1').on('click',function(){
	/* alert('dhfglsf'); */
	 $('#add_lang .add_lang_ext:last').remove();
})


$(function () {
  $('#demo-form').parsley() 
  });
  
  
  $('#search_term').keyup(function(){
	var search_term = $(this).val();
	
	$.ajax({
		type:"POST",
	
		url:"ads_searchterm_unique",
		data:{
			search_term:search_term,
			_token:'{{ csrf_token() }}'
		},
		success:function(response)
		{
			/* alert(response); */
			if(response == 1)
			{
				$('#submit_button').attr('disabled','disabled');
				$('#searchterm_error').html('<div id="search_unique">Search Term is exists</div>');
			/* 	alert('Email is exits') */
			}
			else
			{
				$('#searchterm_error').html('');
				if($('#offer_error').html() == "")
				{
				$('#submit_button').removeAttr('disabled');
				}
			}
		}
	})
  });
  
  $('#offer_code').keyup(function(){
	  
	  var offer_code = $('#offer_code').val();
	  $.ajax({
		type:"POST",
	
		url:"ads_offercode_unique",
		data:{
			offer_code:offer_code,
			_token:'{{ csrf_token() }}'
		},
		success:function(response)
		{
			/* alert(response); */
			if(response == 1)
			{
				$('#submit_button').attr('disabled','disabled');
				$('#offer_error').html('<div id="offercode_unique">Offer Code is exists</div>');
			/* 	alert('Email is exits') */
			}
			else
			{
				$('#offer_error').html('');
				if($('#searchterm_error').html() == "")
				{
				$('#submit_button').removeAttr('disabled');
				}
			}
		}
	})
  });
 
 
 $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
	
</script>
