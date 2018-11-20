

<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="popup_title">Edit Address-{{$business[0]->name}}</h1>
          </div>
         <!--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('bussiness')}}">Manage Business</a></li>
              <li class="breadcrumb-item active">Add Business Address</li>
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
                    {!! Form::label('business_name','Name') !!}<span class="mandatory">*</span>
					<select name='business_name' class='form-control' required="">
					<option value="">Please select Your Business Name</option>
					@foreach($business as $buss)
					<option value="{{$buss->business_id}}"@if($buss->business_id == $buss_addr[0]->business_id ){{'selected'}}@endif>{{$buss->name}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('business_name') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('address','Address') !!}<span class="mandatory">*</span>
					{!!Form::text('address',$buss_addr[0]->address,['class'=>'form-control','placeholder'=>'Address','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('address') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('area','Area') !!}<span class="mandatory">*</span>
					{!!Form::text('area',$buss_addr[0]->area,['class'=>'form-control','placeholder'=>'Area','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('area') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('city','City') !!}<span class="mandatory">*</span>
					{!!Form::text('city',$buss_addr[0]->city,['class'=>'form-control','placeholder'=>'City','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('city') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('state','State') !!}<span class="mandatory">*</span>
					{!!Form::text('state',$buss_addr[0]->state,['class'=>'form-control','placeholder'=>'State','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('state') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('location','Location') !!}<span class="mandatory">*</span>
					<div class="row">
					<div class="col-md-4">
					<?php $location = json_decode($buss_addr[0]->location,true);?>
					
					{!!Form::text('lat',$location['lat'],['class'=>'form-control number','id'=>'latitude','placeholder'=>'Latitude','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('location') }}</a>
					</div>
					<div class="col-md-4">
					
					{!!Form::text('longt',$location['lan'],['class'=>'form-control number','id'=>'longitude','placeholder'=>'Langitude','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('location') }}</a>
					</div>
					<div class="col-md-3">
						<a><button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#myModal" title="Add" data-toggle="tooltip" data-placement="bottom">Add</button></a>
					</div>
					</div>
					<!--<div class="form-group">
							<button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#myModal">Add</button>
					</div>-->
				  <div class="form-group">
                    {!! Form::label('phone_number','Phone Number') !!}
					{!!Form::text('phone_number',$buss_addr[0]->phone_number,['class'=>'form-control','placeholder'=>'Phone Number']) !!}
					<a class="error_1">{{ $errors->first('phone_number') }}</a>
                  </div>
				   <div class="form-group">
                    {!! Form::label('map_url','Map Url') !!}<span class="mandatory">*</span>
					{!!Form::text('map_url',$buss_addr[0]->map_url,['class'=>'form-control','placeholder'=>'Map Url','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('map_url') }}</a>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
            {!! Form::submit('Submit',['class'=>'btn btn-primary','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('bussiness')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
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

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$('.number').keypress(function(event) {
    var $this = $(this);
    if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
       ((event.which < 48 || event.which > 57) &&
       (event.which != 0 && event.which != 8))) {
           event.preventDefault();
    }

    var text = $(this).val();
    if ((event.which == 46) && (text.indexOf('.') == -1)) {
        setTimeout(function() {
            if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
            }
        }, 1);
    }

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 5) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 5)) {
            event.preventDefault();
    }      
});
</script>
