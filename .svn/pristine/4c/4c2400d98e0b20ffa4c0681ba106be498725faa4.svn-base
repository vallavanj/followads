
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add User Payment Method Details</h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('user')}}">Manage User</a></li>
              <li class="breadcrumb-item active">Add User Payment Method Details</li>
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
                    {!! Form::label('user_payment_method','User Payment Method') !!}<span class="mandatory">*</span>
					<select name="user_payment_method" class="form-control" required>
					<option value="">--Select User Payment Method--</option>
					@foreach($u_pay_method as $u_pay)
					<option value="{{$u_pay->user_payment_method_id}}">{{$u_pay->channel_code}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('user_payment_method') }}</a>
                  </div>
                  <div class="form-group">
                    {!! Form::label('detail_key','Detail Key') !!}<span class="mandatory">*</span>
					{!!Form::text('detail_key',null,['class'=>'form-control','placeholder'=>'Detail Key','required']) !!}
					<a class="error_1">{{ $errors->first('detail_key') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('detail_value','Detail Value') !!}<span class="mandatory">*</span>
					{!!Form::text('detail_value',null,['class'=>'form-control','placeholder'=>'Detail Value','required']) !!}
					<a class="error_1">{{ $errors->first('detail_value') }}</a>
                  </div>
                  
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('u_pay_method_detail')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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

