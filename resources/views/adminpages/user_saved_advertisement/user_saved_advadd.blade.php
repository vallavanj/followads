
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add User Saved Advertisement</h1>
          </div>
         <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('user')}}">Manage User</a></li>
              <li class="breadcrumb-item active">Add User Saved Advertisement</li>
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
                    {!! Form::label('adv_name','Advertisement Name') !!}<span class="mandatory">*</span>
					<select name="adv_name" class="form-control" required>
					<option value="">--Select Advertisement Name--</option>
					@foreach($ads as $adv)
					<option value="{{$adv->advertisement_id}}">{{$adv->advertisement_id}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('adv_name') }}</a>
                  </div>
                  
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('user_saved_adv')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
	<script>
	jQuery(function ($) {
    $('form').validatr(); 
});
</script>
    </section>
</div>

