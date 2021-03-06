
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Edit Advertisement Offer Code</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads')}}">Manage Advertisement</a></li>
              <li class="breadcrumb-item active">Edit Advertisement Offer Code</li>
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
			  {!! Form::open(array("enctype"=>"multipart/form-data","id"=>"demo-form", "data-parsley-validate"=>"")) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('ads_name','Advertisement Name') !!}<span class="mandatory">*</span>
					
					
					<select class="form-control" name="ads_name" required>
					<option value="">--Select Advertisment--</option>
					@foreach($adv as $ads)
				
					<option value="{{$ads->advertisement_id}}" @if($adv_img[0]->advertisement_id == $ads->advertisement_id){{'selected'}}@endif>{{$ads->advertisement_id}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('ads_name') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('offer_code','Offer Code') !!}<span class="mandatory">*</span>
					{!!Form::text('offer_code',$adv_img[0]->offer_code,['class'=>'form-control','placeholder'=>'Offer Code',"required"]) !!}
					<a class="error_1">{{ $errors->first('offer_code') }}</a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('offer_type_code','Offer Type Code') !!}<span class="mandatory">*</span>
					<select class="form-control" name="offer_type_code" required>
					<option value="barcode" @if($adv_img[0]->offer_type_code == 'barcode'){{'selected'}}@endif>Barcode</option>
					<option value="qrcode" @if($adv_img[0]->offer_type_code == 'qrcode'){{'selected'}}@endif>QRcode</option>
					<option value="plaincode" @if($adv_img[0]->offer_type_code == 'plaincode'){{'selected'}}@endif>Plaincode</option>
					</select>
					<a class="error_1">{{ $errors->first('offer_type_code') }}</a>
                  </div>
				   
				  
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('ads_offer')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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
