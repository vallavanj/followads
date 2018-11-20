
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Add Advertisement Offer Code</h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads')}}">Manage Advertisement</a></li>
              <li class="breadcrumb-item active">Add Advertisement Offer Code</li>
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
			  {!! Form::open(array("enctype"=>"multipart/form-data","id"=>"form","name"=>"myForm" ,"onsubmit"=>"return validateForm()")) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('ads_name','Advertisement Name') !!}<span class="mandatory">*</span>
					
					
					<select class="form-control" name="ads_name" required>
					<option value="">--Select Advertisment--</option>
					@foreach($adv as $ads)
					<option value="{{$ads->advertisement_id}}">{{$ads->advertisement_id}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('ads_name') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('offer_code','Offer Code') !!}<span class="mandatory">*</span>
					{!!Form::text('offer_code',null,['class'=>'form-control','placeholder'=>'Offer Code',"required"]) !!}
					<a class="error_1">{{ $errors->first('offer_code') }}</a>
                  </div>
				  
				  <div class="form-group">
                    {!! Form::label('offer_type_code','Offer Type Code') !!}<span class="mandatory">*</span>
					<select class="form-control" name="offer_type_code" required>
					<option value="">--Please Select Offer Type Code --</option>
					<option value="barcode">Barcode</option>
					<option value="qrcode">QRcode</option>
					<option value="plaincode">Plaincode</option>
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
				
				
	

/* function validateForm()                                   
{
    var ads_name = document.forms["myForm"]["ads_name"];              
    var offer_code = document.forms["myForm"]["offer_code"];   
    var offer_type_code = document.forms["myForm"]["offer_type_code"];   
    
  if (ads_name.value == "")                                 
    {
		$(ads_name).css("background-color", "#FDEDED");
        ads_name.focus();
        return false;
    }
  if (offer_code.value == "")                                 
    {
		$(offer_code).css("background-color", "#FDEDED");
        offer_code.focus();
        return false;
    }
if (offer_type_code.value == "")                                 
    {
		$(offer_type_code).css("background-color", "#FDEDED");
        offer_type_code.focus();
        return false;
    }
  
   return true;
} */
/* $(function () {
  $('#demo-form').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
  .on('form:submit', function() {
    return false; // Don't submit form for this demo
  });
}); */
jQuery(function ($) {
    $('form').validatr(); 
});

</script>
