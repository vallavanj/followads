
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Redeem</h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('wallet_redeem')}}">Manage Redeem</a></li>
              <li class="breadcrumb-item active">Add Redeem</li>
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
                    {!! Form::label('wallet','Wallet') !!}<span class="mandatory">*</span>
					<select name="wallet" class="form-control" required="">
					<option value="">--Please select your wallet--</option>
					@foreach($wallet as $wal)
					<option value="{{$wal->wallet_id}}">{{$wal->name}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('wallet') }}</a>
                  </div>
				  
				   <div class="form-group">
                    {!! Form::label('redeem_amount','Redeem Amount') !!}<span class="mandatory">*</span>
					{!!Form::text('redeem_amount','',['class'=>'form-control','placeholder'=>'Redeem Amount','required'=>'','data-parsley-type'=>"number"]) !!}
					<a class="error_1">{{ $errors->first('redeem_amount') }}</a>
                  </div>
				  
				 
				
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('wallet_redeem')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
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
	$(function () {
  $('#demo-form').parsley() 
  });
  
  
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>
