
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Categories</h1>
          </div>
           <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('categories')}}">Manage Categories</a></li>
              <li class="breadcrumb-item active">Add Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
	<div class="container-fluid">
			<div class="row justify-content-md-center">
			  <!-- left column -->
			 <div class="col-md-6" style="margin-left: 22%">
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
					{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Name','required'=>'','id'=>'category_name']) !!}
					<a class="error_1" id="category_unique_error">{{ $errors->first('name') }}</a>
                  </div>  
                   <div class="form-group">
                    {!! Form::label('parent_cat','Parent Category') !!}
					<select class='form-control' name="parent_cat" id="parent_category" >
					<option value="0">Please select your Parent Category</option>
					@foreach($categories as $categ)
					<option value="{{$categ->category_id}}" >{{$categ->category_name}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('name') }}</a>
                  </div> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                {!! Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit_button','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('categories')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
    </section>
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

$('#category_name').keyup(function(){
	/* var category_name = $('#category_name').val();
		alert(category_name); */
		/* alert($('#parent_category').val()); */
	if($('#parent_category').val() == 0)
	{
		var category_name = $('#category_name').val();
		/* alert(category_name); */
		$.ajax({
			Type:'Get',
			url:"{{('categories_unique')}}",
			data:{
				category:category_name,
			},success:function(response){
				if(response == 'Category already exists')
				{
					$('#submit_button').attr('disabled','disabled');
					$('#category_unique_error').text(response);
				}
				else
				{
					$('#submit_button').removeAttr('disabled','disabled');
					$('#category_unique_error').text('');
				}
			}
		});
	}
	else
	{
		$('#submit_button').removeAttr('disabled','disabled');
		$('#category_unique_error').text('');
	}
})

$('#parent_category').change(function(){

	if($(this).val() != 0)
	{
		var parent = $(this).val();

		if($('#category_name').val() != "")
		{
			var category_name = $('#category_name').val();
			$.ajax({
			Type:'Get',
			url:"{{('categories_unique')}}",
			data:{
				parentcategory:parent,
				category:category_name,
			},success:function(response){
				//alert(response);
				if(response == 'Category already exists')
				{
					$('#submit_button').attr('disabled','disabled');
					$('#category_unique_error').text(response);
				}
				else
				{
					$('#submit_button').removeAttr('disabled','disabled');
					$('#category_unique_error').text('');
				}
			}
		});
		/* $('#submit_button').removeAttr('disabled','disabled');
		$('#category_unique_error').text(''); */
		}
		else
		{
			$('#submit_button').attr('disabled','disabled');
			$('.parsley-required').hide();
			$('#category_unique_error').text('This value is required.');
		}
	}
	else
	{
		var category_name = $('#category_name').val();
		/* alert(category_name); */
		
		$.ajax({
			Type:'Get',
			url:"{{('categories_unique')}}",
			data:{
				category:category_name,
			},success:function(response){
				if(response == 'Category already exists')
				{
					$('#submit_button').attr('disabled','disabled');
					$('#category_unique_error').text(response);
				}
				else
				{
					$('#submit_button').removeAttr('disabled','disabled');
					$('#category_unique_error').text('');
				}
			}
		});
		
		
	/* 	$('#submit_button').removeAttr('disabled','disabled');
		$('#category_unique_error').text(''); */
	}
})

</script>
</div>
	
