
<div class="content-wrapper">
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Edit Wallet</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads_image')}}">Manage Wallet</a></li>
              <li class="breadcrumb-item active">Edit Wallet</li>
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
                    {!! Form::label('username','User Name') !!}<span class="mandatory">*</span>
					{!!Form::text('username',$wallet[0]->name,['class'=>'form-control','placeholder'=>'Balance','required','readonly']) !!}
					<a class="error_1">{{ $errors->first('balance') }}</a>
                  </div>
				  
				   <div class="form-group">
                    {!! Form::label('balance','Balance') !!}<span class="mandatory">*</span>
					{!!Form::text('balance',$wallet[0]->balance,['class'=>'form-control','placeholder'=>'Balance','required']) !!}
					<a class="error_1">{{ $errors->first('balance') }}</a>
                  </div>
				  
				 
				
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('wallet')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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
