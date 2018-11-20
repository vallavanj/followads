
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Business Images</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('store_image')}}">Manage Business Images</a></li>
              <li class="breadcrumb-item active">Add Business Images</li>
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
			  {!! Form::open(array("enctype"=>"multipart/form-data")) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('business_name','Business Name') !!}<span class="mandatory">*</span>
					<select name='business_name' class='form-control' required>
					<option value="">Please select Your Business Name</option>
					@foreach($business as $buss)
					<option value="{{$buss->business_id}}">{{$buss->name}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('business_name') }}</a>
                  </div>
				  
				  <div class="form-group">
					{!! Form::label('business_image','BusinessImage') !!}<span class="mandatory">*</span>
                    <div class="input-group">
                      <div class="custom-file">
						{!!Form::file('business_image',['class'=>'custom-file-input','id'=>'exampleInputFile','required']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}
						<a class="error_1">{{ $errors->first('business_image') }}</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('buss_image')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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
