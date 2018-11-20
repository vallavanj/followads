
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Advertisement Image</h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads_image')}}">Manage Advertisement Image</a></li>
              <li class="breadcrumb-item active">Add Advertisement Image</li>
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
			  {!! Form::open(array("enctype"=>"multipart/form-data")) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('ads_name','Advertisement Name') !!}<span class="mandatory">*</span>
					
					
					<select class="form-control" name="ads_name" required>
					<option value="">--Select Advertisment--</option>
					@foreach($ads as $ads)
					<option value="{{$ads->advertisement_id}}">{{$ads->advertisement_id}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('ads_name') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('language_name','Language Name') !!}
					
					
					<select class="form-control" name="language_name">
					<option value="">--Select Language--</option>
					@foreach($lang as $lan)
					<option value="{{$lan->language_id}}">{{$lan->name_in_english}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('language_name') }}</a>
                  </div>
				  <div class="form-group">
					{!! Form::label('ads_image','Advertisement Image') !!}<span class="mandatory">*</span>
                    <div class="input-group">
                      <div class="custom-file">
						{!!Form::file('ads_image',['class'=>'custom-file-input','id'=>'exampleInputFile','required']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}
                      </div>
                    </div>
                  </div>
				  
				 
				
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('ads_image')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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
	jQuery(function ($) {
    $('form').validatr(); 
});
</script>