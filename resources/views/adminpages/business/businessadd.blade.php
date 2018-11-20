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
.select2-search__field {
	width:320px !important;
}

</style>
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Business</h1>
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
					{!!Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Name','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('name') }}</a> 
                  </div>
				  <div class="form-group">
					{!! Form::label('business_logo','Business Logo') !!}<span class="mandatory">*</span>
                    <div class="input-group">
                      <div class="custom-filex w-100">
						<!--{!!Form::file('business_logo',['class'=>'custom-file-input','id'=>'exampleInputFile','required'=>'']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}-->
					<input type="file" name="business_logo" class="form-control"  required accept =".jpg,.png">
						
						<a class="error_1">{{ $errors->first('business_logo') }}</a>
                      </div>
                    </div>
                  </div>
               
				   <div class="form-group">
                    {!! Form::label('category_name','Category Name') !!}<span class="mandatory">*</span><br>
						
						
						
					
							
						
					<select class="form-control select2"  name="category_name[]" multiple="multiple" data-placeholder="category name" required="">
							
							
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
					<p>{!! Form::label('business_image','Business Image') !!}<span class="mandatory">*</span> <br><span class="text-primary btn btn-sm btn-default" id="add_image_field"><i class="fa fa-plus" aria-hidden="true"></i> Add Image</span> <span class="text-primary btn btn-sm btn-default" id="remove_image_field"><i class="fa fa-times" aria-hidden="true"></i> Remove Image</span>
					</p>
                    <div class="input-group">
                      <div class="custom-filex w-100">
						
					<input type="file" name="business_image[]" class="form-control" required ='' accept =".jpg,.png">
						<a class="error_1">{{ $errors->first('business_image') }}</a>
                      </div>
                    </div>
                  </div>
				  <div id="add_img_field">
				  </div>
				   
				  <div class="form-group">
					<p>{!! Form::label('business_image','Business Video') !!}<br><span class="text-primary btn btn-sm btn-default" id="add_video_field"><i class="fa fa-plus" aria-hidden="true"></i>Add Video</span> <span class="text-primary btn btn-sm btn-default" id="remove_video_field"> <i class="fa fa-times" aria-hidden="true"></i>Remove Video</span>
					</p>
                    <div class="input-group">
                      <div class="custom-filex w-100">
						<!--{!!Form::file('business_video[]',['class'=>'custom-file-input','id'=>'exampleInputFile','required',"accept"=>"video/*",'multiple']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}-->
						<input type="file" name="business_video[]" class="form-control" accept="video/*" >
						
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
 });


$(function () {
  $('#demo-form').parsley() 
  });

$('#add_image_field').click(function(){
	/* $('#add_img_field').html('<div class="input-group"><div class="custom-file"><input type="file" name="business_image[]" class="form-control></div></div></div>'); */
	$('#add_img_field').append('<p><input type="file" name="business_image[]" class="form-control" required="" accept =".jpg,.png"></p>');
});


$('#add_video_field').click(function(){
	$('#add_vid_field').append('<p><input type="file" name="business_video[]" class="form-control" accept="video/*" required=""></p>');
});
$('#remove_image_field').on('click', function () {
    $('#add_img_field input:file:last').remove();
});
$('#remove_video_field').on('click', function () {
    $('#add_vid_field input:file:last').remove();
});


	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
	</script>
    </section>   
</div>
	
