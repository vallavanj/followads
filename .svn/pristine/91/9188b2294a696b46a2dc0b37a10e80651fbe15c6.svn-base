
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="popup_title">Add Advertisement Business Address-{{$bus_addr[0]->name}}</h1>
          </div>
         <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads')}}">Manage Advertisement</a></li>
              <li class="breadcrumb-item active">Add Advertisement Business Address</li>
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
                    {!! Form::label('ads_name','Advertisement Name') !!}<span class="mandatory">*</span>
					
					
					<select class="form-control" name="ads_name" required="">
					
					@foreach($ads as $busi)
					<option value="{{$busi->advertisement_id}}">{{$busi->name}}</option>
					@endforeach
					</select>
					<a class="error_1">{{ $errors->first('ads_name') }}</a>
					<input type="text" name="ads_id" id="ads_id" value="{{$busi->advertisement_id}}" hidden>
                  </div>
				  <div class="form-group">
                    {!! Form::label('business_address','Business Address') !!}<span class="mandatory">*</span>
					
					
					<select class="form-control" name="business_address" id="address" required="">
							<option value="0">--Select Business Address--</option>
					@foreach($bus_addr as $bus_add)
					<option value="{{$bus_add->business_address_id}}">{{$bus_add->address}}</option>
					@endforeach
					</select>
					<a class="error_1" id="address_check">{{ $errors->first('business_address') }}</a>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit",'id'=>'submit_button']) !!}
				<a href="{{url('ads_list')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
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
	/* $('#validfrom').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy/MM/dd HH:mm:ss'
				});
				$('#validto').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy/MM/dd HH:mm:ss'
				}); */
	$(function () {
  $('#demo-form').parsley() 
  });
  
  	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('#address').change(function(){
	var address_id = $('#address').val();
	var ads_id = $('#ads_id').val();
/* 	alert(address_id +','+ ads_id); */
	/* alert(); */
	
	$.ajax({
		type:"POST",
	
		url:"{{url('ads_address_check')}}",
		data:{
			address_id:address_id,
			ads_id:ads_id,
			_token:'{{ csrf_token() }}'
		},
		success:function(response)
		{
			/* alert(response); */
			if(response == 1)
			{
				$('#submit_button').attr('disabled','disabled');
				$('#address_check').html('<div id="offercode_unique">Address is exists for this Advertisement</div>');
			/* 	alert('Email is exits') */
			}
			else
			{
				$('#address_check').html('');
				$('#submit_button').removeAttr('disabled');
			}
		}
	})
 
});

</script>
