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

</style>
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Edit Business</h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('stores')}}">Manage business</a></li>
              <li class="breadcrumb-item active">Add business</li>
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
                    {!! Form::label('name','Name') !!}<span class="mandatory">*</span>
					{!!Form::text('name',$business[0]->name,['class'=>'form-control','placeholder'=>'Name','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('name') }}</a> 
                  </div>
				
				<div class="form-group">
					{!! Form::label('business_logo','Business Logo') !!}<span class="mandatory">*</span>
					<div class="form-group">
					<img src="{{url('business1/uploads/doc/'.$business[0]->business_id.'/'.$business[0]->logo_url)}}" width="50px" height="50px" class="img-circle">
                  </div>
                    <div class="input-group">
                      <div class="custom-file">
						<!--{!!Form::file('business_logo',['class'=>'custom-file-input','id'=>'exampleInputFile']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}-->
						<input type="file" name="business_logo" class="form-control" accept =".jpg,.png">
						<a class="error_1">{{ $errors->first('business_logo') }}</a>
                      </div>
                    </div>
                  </div>
				
				
				<div class="form-group">
				  <?php    foreach($buss_cat as $val) {   $cat_id[]=$val['category_id'];  }   ?>
                    {!! Form::label('category_name','Category Name') !!}<span class="mandatory">*</span><br>
					<select class="form-control select2"  name="category_name[]" multiple="multiple"  required  data-placeholder="category name">
						
						@foreach($result_parent_id_group as $value)
								<optgroup label="{{$value['parent_cat']}}">
								<?php   $get_child_val=explode(",", $value['children_value']);
										$parent_category_id=explode(",", $value['parent_category_id']);
										foreach (array_combine($parent_category_id, $get_child_val) as $parent_category_id => $get_child_val) {
											?>
										<option value="{{ $parent_category_id }}" <?php if (in_array($parent_category_id, $cat_id))  { echo 'selected'; }?> >{{ $get_child_val }}</option>
									<?php	}   ?>
								</optgroup>
							@endforeach
							 
							@foreach($category as $categ)
									<option  value="{{$categ->category_id}}" <?php if (in_array($categ->category_id, $cat_id))  { echo 'selected'; } ?>  >{{$categ->category_name}}</option>
							@endforeach
					</select>
					
				 <a class="error_1">{{ $errors->first('category_name') }}</a>
                  </div>
				  {!! Form::label('business_image','Business Image') !!}<span class="mandatory">*</span>
				  <input type="hidden" id="count_image_id" value="<?php echo count($buss_image); ?>">
				  <?php 
				     
				  foreach($buss_image as $bus){ ?>
				  <div class="form-group rem_img_class" id="img_{{ $bus->sequence_no  }}">
				  
				  
                    <img src="{{url('business_images/uploads/doc/'.$bus->business_id.'/'.$bus->images_url)}}" width="50px" height="50px" class="img-circle"><span>*</span>
					<a href="#" class="btn btn-sm btn-default text-primary btn_rem imge_remove_{{$bus->business_images_id}}"   data-id="{{ $bus->business_id }}" data-imgrmv="img_{{ $bus->sequence_no  }}"   data-imgid="{{$bus->business_images_id }}" data="{{ $bus->sequence_no }}" ><i class="fa fa-times" aria-hidden="true"></i> remove</a>
					<p id="imgremove" class="error_1"></p>
                  </div>
				  
				  <?php }?>
				   <div class="form-group">
					<p> <br><span class="btn btn-sm btn-default text-primary" id="add_image_field"> <i class="fa fa-times" aria-hidden="true"></i> Add Image</span> <span class="text-primary btn btn-sm btn-default" id="remove_image_field"> <i class="fa fa-times" aria-hidden="true"></i> Remove Image</span>
					</p>
                    <div class="input-group">
                      <div class="custom-file">
						
						<input type="file" name="business_image[]" class="form-control" accept =".jpg,.png">
						<a class="error_1">{{ $errors->first('business_image') }}</a>
                      </div>
                    </div>
                  </div>
				  <div id="add_img_field">
				  </div>
				  {!! Form::label('business_image','Business Video') !!}
				
				    <?php foreach($buss_video as $bus){?>
				   <div class="form-group">
				 
					<video width="290" height="240" controls>
					<source src="{{url('business_video/uploads/doc/'.$bus->business_id.'/'.$bus->business_video_url)}}" type="video/mp4" width="50px" height="50px">
					<source src="{{url('business_video/uploads/doc/'.$bus->business_id.'/'.$bus->business_video_url)}}"type="video/ogg" width="50px" height="50px">
					</video><a href="#" class="btn btn-sm btn-default text-primary vid_remove_{{$bus->business_video_id}}" onclick="remove_video('{{$bus->business_video_id}}',{{$bus->business_id}})"><i class="fa fa-times" aria-hidden="true"></i> remove</a>
					
                  </div>
				   <?php }?>
				   
				   
				   <div class="form-group">
					<p> <br><span class="text-primary btn btn-sm btn-default" id="add_video_field"> <i class="fa fa-times" aria-hidden="true"></i> Add Video</span> <span class="text-primary btn btn-sm btn-default" id="remove_video_field"> <i class="fa fa-times" aria-hidden="true"></i> Remove Video</span>
					</p>
                    <div class="input-group">
                      <div class="custom-file">
						<!--{!!Form::file('business_video[]',['class'=>'custom-file-input','id'=>'exampleInputFile','required',"accept"=>"video/*",'multiple']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}-->
						<input type="file" name="business_video[]" class="form-control" accept="video/*">
						
						<a class="error_1">{{ $errors->first('business_video') }}</a>
                      </div>
                    </div>
                  </div>
				   <div id="add_vid_field">
				  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
             {!! Form::submit('Submit',['class'=>'btn btn-primary','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('bussiness')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
<script src="{{URL::asset('admin/js/parsley.min.js')}}"></script>
<script src="{{URL::asset('admin/select2/select2.full.min.js')}}"></script>
<script>
$(document).ready(function () {
    $('.select2').select2();
		$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
	
  });
	
$(document).on("click",".btn_rem",function (){
	var seq_no=$(this).attr('data');
	var bus_id=$(this).attr("data-id");
	var img_id=$(this).attr('data-imgid');
	var img_rem=$(this).attr('data-imgrmv');
	var count_data=$('#count_image_id').val();
	
	if(count_data == 1){
		$('#count_image_id').val(1);
		$('#imgremove').text('Image could not be deleted');
		setTimeout(function(){
			$('#imgremove').hide();
		},1000);
		
	}
	else {
		$('#count_image_id').val(Number(count_data)-1);
		$.ajax({
			type : "POST",
			url  : "{{url('business_img_remove')}}",
			data :{
				id:img_id,
				bid:bus_id,
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

function remove_video(id,bid)
{
	$.ajax({
		type : "POST",
		url  : "{{url('business_vid_remove')}}",
		data :{
			id:id,
			bid:bid,
			_token: '{{ csrf_token() }}'
		},success:function(response)
		{
			alert(response);
			if(response == "Video Deleted Sucessfully")
			{
			$('.vid_remove_'+id).text('removed successfully');
			}
		}
	}); 
}

$('#add_image_field').click(function(){
	/* $('#add_img_field').html('<div class="input-group"><div class="custom-file"><input type="file" name="business_image[]" class="form-control></div></div></div>'); */
	$('#add_img_field').append('<p><input type="file" name="business_image[]" class="form-control" accept =".jpg,.png"></p>');
});


$('#add_video_field').click(function(){
	$('#add_vid_field').append('<p><input type="file" name="business_video[]" class="form-control" accept="video/*"></p>');
});
$('#remove_image_field').on('click', function () {
    $('#add_img_field input:file:last').remove();
});
$('#remove_video_field').on('click', function () {
    $('#add_vid_field input:file:last').remove();
});
	  $(function () {
  $('#demo-form').parsley() 
  });
	/* jQuery(function ($) {
    $('form').validatr(); 
}); */

/* Video control */
	var videos = document.querySelectorAll('video');
for(var i=0; i<videos.length; i++)
   videos[i].addEventListener('play', function(){pauseAll(this)}, true);


function pauseAll(elem){
	for(var i=0; i<videos.length; i++){
		//Is this the one we want to play?
		if(videos[i] == elem) continue;
		//Have we already played it && is it already paused?
		if(videos[i].played.length > 0 && !videos[i].paused){
		// Then pause it now
		  videos[i].pause();
		}
	}
  }
  
  

	</script>
    </section>
</div>
	
