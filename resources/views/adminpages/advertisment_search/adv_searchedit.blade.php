
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Edit Advertisement Search</h1>
          </div>
           <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads')}}">Manage Advertisement</a></li>
              <li class="breadcrumb-item active">Edit Advertisement Search</li>
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
                    {!! Form::label('ads_name','Advertisement Name') !!}<span class="mandatory">*</span>
					
					
					<select class="form-control" name="ads_name" required>
					<option value="">--Select Advertisment--</option>
					@foreach($adv as $ads)
					<option value="{{$ads->advertisement_id}}" @if($ads->advertisement_id == $adv_img[0]->advertisement_id){{'selected'}}@endif>{{$ads->advertisement_id}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('ads_name') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('search_term','Search Terms') !!}<span class="mandatory">*</span>
					{!!Form::text('search_term',$adv_img[0]->search_term,['class'=>'form-control','placeholder'=>'Search Terms','required']) !!}
					<a class="error_1">{{ $errors->first('search_term') }}</a>
                  </div>
				   
				  
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('ads_search')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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
