
<div class="content-wrapper">
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Wallet Transaction</h1>
          </div>
            <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads_image')}}">Manage Wallet</a></li>
              <li class="breadcrumb-item active">Add Wallet Transaction</li>
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
			 
			  {!! Form::open(array("enctype"=>"multipart/form-data","id"=>"demo-form","data-parsley-validate"=>"")) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('Wallet','wallet') !!}<span class="mandatory">*</span>
					<select name="wallet" class="form-control" required="">
					<option value="">--Please select your wallet--</option>
					@foreach($wallet as $wal)
					<option value="{{$wal->wallet_id}}" @if($id == $wal->wallet_id){{'selected'}}@endif>{{$wal->wallet_id}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('wallet') }}</a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('name','User Name') !!}<span class="mandatory">*</span>
						{!!Form::text('name',$wallet[0]->user_name,["class"=>"form-control",'readonly' => 'true'])  !!}
					<a class="error_1">{{ $errors->first('name') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('coupons','Coupons') !!}<span class="mandatory">*</span>
					<select name="coupons" class="form-control" required="">
					<option value="">--Please select your Coupons--</option>
					@foreach($coupons as $coupon)
					<option value="{{$coupon->gift_coupon_id}}">{{$coupon->code}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('coupons') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('transaction_type','Transaction Type') !!}<span class="mandatory">*</span>
					<select name="transaction_type" class="form-control" required="" class='form-control'>
					<option>--Transaction Type---</option>
					<option value="1">Credit</option>
					</select>
					<a class="error_1">{{ $errors->first('transaction_type') }}</a>
                  </div>
				  
				 <div class="form-group">
                    {!! Form::label('transaction_amount','Transaction Amount') !!}<span class="mandatory">*</span>
					{!!Form::text('transaction_amount','',['class'=>'form-control','placeholder'=>'Transaction Amount','required']) !!}
					<a class="error_1">{{ $errors->first('transaction_amount') }}</a>
                  </div>
				
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
               {!! Form::submit('Submit',['class'=>'btn btn-primary',"title"=>"Submit","data-toggle"=>"tooltip","data-placement"=>"bottom"]) !!}
				<a  href="{{url('wallet')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger',"title"=>"Cancel","data-toggle"=>"tooltip", "data-placement"=>"bottom"]) !!}</a>
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
