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
            <h1 class="popup_title">Edit Advertisement</h1>
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
								<option value="">--Select Business Name--</option>
								@foreach($business as $busi)
								<option value="{{$busi->business_id}}" @if($ads[0]->business_id == $busi->business_id){{'selected'}}@endif>{{$busi->name}}</option>
								@endforeach
					</select>
					<a class="error_1">{{ $errors->first('business_name') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('ads_name','Advertisement Name') !!}<span class="mandatory">*</span>
					{!!Form::text('ads_name',$ads[0]->name,['class'=>'form-control','placeholder'=>'Name','required'=>""]) !!}
					<a class="error_1">{{ $errors->first('ads_name') }}</a>
                  </div>
				  <div class="form-group">
				  
				  <?php 
					$date_from = date('d-m-Y', strtotime($ads[0]->valid_from));
					$date_to = date('d-m-Y', strtotime($ads[0]->valid_to));
					?>
                  {!! Form::label('valid_from','Valid From') !!}<span class="mandatory">*</span>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
					{!! Form::text('valid_from',$date_from,['class'=>'form-control float-right','placeholder'=>'Valid From','id'=>"validfrom",'required'=>""]) !!}
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
					{!! Form::text('valid_to',$date_to,['class'=>'form-control float-right','placeholder'=>'Valid To','id'=>'validto','required'=>""]) !!}
                  </div>
                  <!-- /.input group -->
                </div>
				
				
				 <div class="form-group">
					{!! Form::label('ads_icon','Advertisment icon') !!}<span class="mandatory">*</span> <br>
					<div class="form-group">
                    <img src="{{url('ads1/uploads/doc/'.$ads[0]->advertisement_id.'/'.$ads[0]->icon_image_url)}}" width="50px" height="50px" class="img-circle">
                  </div>
                    <div class="input-group">
                      <div class="custom-file">
						<!--{!!Form::file('ads_icon',['class'=>'custom-file-input','id'=>'exampleInputFile']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}-->
						<input type="file" name="ads_icon" class="form-control" accept =".jpg,.png" >
                      </div>
                    </div>
                  </div>
				 
				<p>{!! Form::label('ads_image','Advertisement Image') !!}<span class="mandatory">*</span> <br>
			
				
               <?php foreach($adv_img as $adsv){ ?>
				<div class="form-group rem_img_class" id="img_{{ $adsv->sequence_no  }}">
				  <img src="{{url('advertisement_images/uploads/doc/'.$adsv->advertisement_id.'/'.$adsv->image_url)}}" width="50px" height="50px" class="img-circle">
					<a href="#" class="imge_remove_{{$adsv->advertisement_image_id}} btn btn_rem btn-sm btn-default"  data-id="{{ $adsv->advertisement_id }}" data-imgrmv="img_{{ $adsv->sequence_no  }}"   data-imgid="{{$adsv->advertisement_image_id }}" data="{{ $adsv->sequence_no }}"      ><i class="fa fa-times" aria-hidden="true"></i> remove</a>
					<p id="imgremove" class="error_1"></p>
				</div>
			   <?php } ?>
					<a  href="#" class="btn btn-sm btn-default" id="add_image_field" ><i class="fa fa-plus" aria-hidden="true"></i> Add Image</a> <a href="#" class="btn btn-sm btn-default" id="remove_image_field"><i class="fa fa-times" aria-hidden="true"></i> Remove Image</a>
					</p>
                    <div class="input-group">
                      <div class="custom-file">
					   <input type="file" name="ads_image[]" class="form-control" accept =".jpg,.png">
						
                      </div>
                    </div>
				  <div id="add_img_field"> </div>
				  
				   <div class="form-group">
                    {!! Form::label('category_name','Category Name') !!}<span class="mandatory">*</span><br>
					<?php foreach($adv_categ as $values_select) { $selected_cat[]=$values_select['category_id']; } ?>
					<select class="form-control select2"  name="category_name[]" multiple="multiple" required data-placeholder="category name">
						@foreach($result_parent_id_group as $value)
								<optgroup label="{{$value['parent_cat']}}">
								<?php   $get_child_val=explode(",", $value['children_value']);
										$parent_category_id=explode(",", $value['parent_category_id']);
										foreach (array_combine($parent_category_id, $get_child_val) as $parent_category_id => $get_child_val) {
											?>
										<option value="{{ $parent_category_id }}" <?php if (in_array($parent_category_id, $cat_id_val_par))  { echo 'selected'; }?> >{{ $get_child_val }}</option>
									<?php	}   ?>
								</optgroup>
							@endforeach
							
							
							@foreach($category_list as $categ)
									<option  value="{{$categ->category_id}}" <?php  if(in_array($categ->category_id, $selected_cat)) { echo 'selected'; } ?>  >{{$categ->category_name}}</option>
							@endforeach
					</select>
						
					<a class="error_1">{{ $errors->first('category_name') }}</a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('search_term','Search Terms') !!}<span class="mandatory">*</span>
					{!!Form::text('search_term',$ads[0]->search_term,['class'=>'form-control','placeholder'=>'Search Terms','required'=>'','id'=>'search_term']) !!}
					<a class="error_1" id='searchterm_error'></a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('offer_code','Offer Code') !!}
					{!!Form::text('offer_code',$ads[0]->offer_code,['class'=>'form-control','placeholder'=>'Offer Code','id'=>'offer_code']) !!}
					<a class="error_1" id="offer_error"></a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('offer_type_code','Offer Type Code') !!}
					<select class="form-control" name="offer_type_code" >
					<option value="">--Please Select Offer Type Code --</option>
					<option value="barcode" @if($ads[0]->offer_type_code == "barcode"){{'selected'}}@endif>Barcode</option>
					<option value="qrcode"  @if($ads[0]->offer_type_code == "qrcode"){{'selected'}}@endif>QRcode</option>
					<option value="plaincode" @if($ads[0]->offer_type_code == "plaincode"){{'selected'}}@endif >Plaincode</option>
					</select>
					<a class="error_1">{{ $errors->first('offer_type_code') }}</a>
                  </div>
				  <div class="form-group">
				  <a href="#" id="add_lang_1" class="btn btn-sm btn-default"><i class="fa fa-plus" aria-hidden="true"></i>  Add Language
					</a> <a href="#" id="remove_lang_1" class="btn btn-sm btn-default"><i class="fa fa-times" aria-hidden="true"></i>
					Remove Language</a> <hr>
					</div>
					 
				  @foreach($adv_desc  as  $key=>$ad_desc)
				  <div class="add_lang_ext">
				    <div class="form-group">
					
					 
                    {!! Form::label('language_name','Language Name') !!}<span class="mandatory">*</span>
					
					<br>
					<?php /* <select class="form-control" name="language_name[]">
					<option value="">--Select Language--</option>
					@foreach($lang as $lan)
					<option value="{{$lan->language_id}}">{{$lan->name_in_english}}</option>
					@endforeach
					</select> 
					<a class="error_1">{{ $errors->first('language_name') }}</a>*/ ?>
					
					@foreach($lang as $lan)
					<input type="radio" name="language_name[{{$key}}]" required="" @if($lan->language_id == $ad_desc->language_id){{'checked'}} @endif value="{{$lan->language_id}}" class="">{{$lan->name_in_english}}
					@endforeach
                  </div>
				
				   <div class="form-group">
                    {!! Form::label('desc','Description') !!}<span class="mandatory">*</span>
					{!!Form::textarea('desc[]',$ad_desc->description,['class'=>'form-control','placeholder'=>'Description','col'=>5,'rows'=>3,"required"=>""]) !!}
					<a class="error_1">{{ $errors->first('desc') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('caption','Caption') !!}
					{!!Form::text('caption[]',$ad_desc->caption,['class'=>'form-control','placeholder'=>'Caption']) !!}
					<a class="error_1">{{ $errors->first('caption') }}</a>
                  </div>
				   <hr>
				   
				   </div>
				  @endforeach
				  
				   <div id="add_lang">
				  
				  </div>
				  <div>
				  <?php $ads_id = decrypt(Request::segment(2));?>
				  <input type="text" name="ads_id" value={{$ads_id }} id="ads_id" hidden>
				  </div>
				</div>
                <!-- /.card-body -->

                <div class="card-footer">
                {!! Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit_button','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('ads_list')}}" >{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
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
	$('#add_img_field').append('<p><input type="file" name="ads_image[]" class="form-control" accept =".jpg,.png"></p>');
});

$('#remove_image_field').on('click', function () {
    $('#add_img_field input:file:last').remove();
});



	/* $('#reservation').daterangepicker(); */
	/* $('#validfrom').dateTimePicker({
                mode: 'date',
                /* format: 'yyyy/MM/dd HH:mm:ss' */
				/*format: 'dd-MM-yyyy',
				todayHighlight: true,
				autoclose: true
				});
				$('#validto').dateTimePicker({
                mode: 'date',
                /* format: 'yyyy/MM/dd HH:mm:ss' */
				  /*format: 'dd-MM-yyyy',
				todayHighlight: true,
				autoclose: true
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
				
				
				
/* 	jQuery(function ($) {
    $('form').validatr(); 
}); */

/*function remove_image(id,aid)
{
	
	
	$.ajax({
		type : "POST",
		url  : "{{url('adv_img_remove')}}",
		data :{
			id:id,
			aid:aid,
			_token: '{{ csrf_token() }}'
		},success:function(response)
		{
			
			if(response == "Image Deleted Sucessfully")
			{
			$('.imge_remove_'+id).text('removed successfully');
			}
			else
			{
				alert(response);
			}
		}
	}); 
}  */


$(document).on("click",".btn_rem",function (){
	var seq_no=$(this).attr('data');
	var aid=$(this).attr("data-id");
	var img_id=$(this).attr('data-imgid');
	var img_rem=$(this).attr('data-imgrmv');
	var get_leng=$('.rem_img_class').length;
	
if(get_leng == 1){
		$('#count_image_id').val(1);
		$('#imgremove').text('Image could not be deleted');
		setTimeout(function(){
			$('#imgremove').hide();
		},1000);
		
	}
	else {
		$.ajax({
			type : "POST",
			url  : "{{url('adv_img_remove')}}",
			data :{
				id:img_id,
				aid:aid,
				seq_no:seq_no,
				_token: '{{ csrf_token() }}'
			},success:function(response)
				{
					
					if(response == 1)
					{
						//console.log('#'+img_rem);
						$('#'+img_rem).remove();
					}
					
				}
			}); 
	}   
	

	
});





/* Add And Remove Language */
$("#add_lang_1").click(function(){
	var len = $('.add_lang_ext').length;
	$('#add_lang').append('<div class="add_lang_ext"><hr><div class="form-group">{!! Form::label('language_name','Language Name') !!}<span class="mandatory">*</span><br> @foreach($lang as $lan)<input type="radio" name="language_name['+len+']" value="{{$lan->language_id}}" class="" required="">{{$lan->name_in_english}}@endforeach<a class="error_1">{{ $errors->first('language_name') }}</a></div><div class="form-group">{!! Form::label('desc','Description') !!}<span class="mandatory">*</span>{!!Form::textarea('desc[]',null,['class'=>'form-control','placeholder'=>'Description','col'=>5,'rows'=>3,"required"=>""]) !!}<a class="error_1">{{ $errors->first('desc') }}</a></div> <div class="form-group">{!! Form::label('caption','Caption') !!}{!!Form::text('caption[]',null,['class'=>'form-control','placeholder'=>'Caption']) !!}<a class="error_1">{{ $errors->first('caption') }}</a></div></div>')
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
	var ads_id = $('#ads_id').val();
	$.ajax({
		type:"POST",
	
		url:"ads_searchterm_unique2",
		data:{
			search_term:search_term,
			ads_id:ads_id,
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
	  var ads_id = $('#ads_id').val();
	  $.ajax({
		type:"POST",
	
		url:"ads_offercode_unique2",
		data:{
			offer_code:offer_code,
			ads_id:ads_id,
			_token:'{{ csrf_token() }}'
		},
		success:function(response)
		{
			// alert(response);
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
