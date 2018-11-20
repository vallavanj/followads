
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Edit Promotion Section</h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('user')}}">Manage User</a></li>
              <li class="breadcrumb-item active">Add User</li>
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
                    {!! Form::label('name','Name') !!}<span class="mandatory">*</span>
					
					{!!Form::text('name',$promotion[0]->name,['class'=>'form-control','placeholder'=>'Name','required'=>'']) !!}

					<a class="error_1">{{ $errors->first('business_name') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('no_of_ads','No of ads') !!}<span class="mandatory">*</span>
					{!!Form::text('no_of_ads',$promotion[0]->no_of_ads,['class'=>'form-control','placeholder'=>'No of ads','required'=>'','id'=>'no_of_ad']) !!}<div id="check"><input type="checkbox" id="check_click" class="form-control normal"></div><span id="info" style="color:#F90505"></span>
					<a class="error_1">{{ $errors->first('no_of_ads') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('height','Height ') !!}
					{!!Form::text('height',$promotion[0]->height,['class'=>'form-control','placeholder'=>'Height']) !!}
					<a class="error_1">{{ $errors->first('offer_code') }}</a>
                  </div>
				  <div class="form-group">
                   {!! Form::label('width','Width ') !!}
					{!!Form::text('width',$promotion[0]->width,['class'=>'form-control','placeholder'=>'Width']) !!}
					<a class="error_1">{{ $errors->first('offer_code') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('caption','Caption') !!}
					{!!Form::text('caption',$promotion[0]->caption,['class'=>'form-control','placeholder'=>'Caption']) !!}
					<a class="error_1">{{ $errors->first('caption') }}</a>
                  </div>
                  <div>
				  <?php $pro_id = decrypt(Request::segment(2));?>
				  <input type="text" name="ads_id" value={{$pro_id }} id="pro_id" hidden>
				  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary','id'=>'submit_button','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('promotion_section')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
	<script>
	/* jQuery(function ($) {
    $('form').validatr(); 
}); */
$(function () {
  $('#demo-form').parsley() 
  });
  
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
	

$('#no_of_ad').keyup(function(){
	var pro_id = $('#pro_id').val();
	var no_of_ads = $('#no_of_ad').val();
	/* alert(pro_id+','+no_of_ads) */
	$.ajax({
		type:"POST",
	
		url:"check_pro_no_of_ads",
		data:{
			pro_id:pro_id,
			no_of_ads:no_of_ads,
			_token:'{{ csrf_token() }}'
		},
		success:function(response)
		{
			/* alert(response); */
			if(response == 1)
			{
				$('#check_click').show();
				$('#info').text('You cannot reduce the No Of Ads If you reduced all the Advertisement will be Deleted');
				$('#submit_button').attr('disabled','disabled');
			}
			else
			{
				$('#info').text('');
				$('#check_click').hide();
				$('#check_click').removeAttr('checked');
				$('#submit_button').removeAttr('disabled','disabled');
			}
		}
	})
});


$('#check #check_click').click(function(){
	/* alert('kk'); */
	if($(this).hasClass('normal'))
	{
	$(this).attr('checked','checked');
	$(this).removeClass('normal');
	$(this).addClass('danger');
				$('#info').text('Ok Proceed');
				$('#submit_button').removeAttr('disabled','disabled');
	}
	else
	{
		$(this).removeClass('danger');
		$(this).addClass('normal');
		$(this).removeAttr('checked','checked');
		$('#info').text('You cannot reduce the No Of Ads If you reduced all the Advertisement will be Deleted');
		$('#submit_button').attr('disabled','disabled');
	}
});

	$('#check_click').hide();
	</script>
    </section>
</div>
	
