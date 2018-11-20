
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Payment Method</h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('user')}}">Manage User</a></li>
              <li class="breadcrumb-item active">Add User Payment Method</li>
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
                    {!! Form::label('user_name','User Name') !!}<span class="mandatory">*</span>
					<select name="user_name" class="form-control" required="">
					<option value="">--Please Select User Name--</option>
					@foreach($users as $usr)
					<option value="{{$usr->user_id}}">{{$usr->name}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('channel') }}</a>
                  </div>
				
                  <div class="form-group">
                    {!! Form::label('channel','Channel') !!}<span class="mandatory">*</span>
					<select name="channel" class="form-control" required="">
					<option value="">--Please Select Payment method--</option>
					<option value="bt">BT</option>
					<option value="paytm">PayTM</option>
					<option value="mmid">MMID</option>
					</select>
					<a class="error_1">{{ $errors->first('channel') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('ac_holdeer_name','Account Holder Name') !!}
					{!!Form::text('ac_holdeer_name',null,['class'=>'form-control','placeholder'=>'Account Holder Name']) !!}
					<a class="error_1">{{ $errors->first('ac_holdeer_name') }}</a>
                  </div>
                  
                <!-- /.card-body -->

                <div class="card-footer">
                  {!! Form::submit('Submit',['class'=>'btn btn-primary','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('users_payment_method')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
	<script>
	$(function () {
  $('#demo-form').parsley() 
  });
  
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
    </section>
</div>

