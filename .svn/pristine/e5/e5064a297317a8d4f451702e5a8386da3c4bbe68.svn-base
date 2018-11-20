


<div class="content-wrapper">
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Edit User Feedback</h1>
          </div>
           <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('user')}}">Manage User</a></li>
              <li class="breadcrumb-item active">Edit User Feedback</li>
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
                    {!! Form::label('feedback_subject','Feedback Subject') !!}<span class="mandatory">*</span>
					{!!Form::text('feedback_subject',$userfeedback[0]->feedback_subject,['class'=>'form-control','placeholder'=>'Feedback Subject','required']) !!}
					<a class="error_1">{{ $errors->first('feedback_subject') }}</a>
                  </div>
				 <div class="form-group">
                    {!! Form::label('feedback_description','Feedback Description') !!}
					{!!Form::textarea('feedback_description',$userfeedback[0]->feedback_description,['class'=>'form-control','placeholder'=>'Feedback Description','cols'=>5,'rows'=>2]) !!}
					<a class="error_1">{{ $errors->first('feedback_description') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('feedback_status','Feedback Status') !!}
					{!!Form::text('feedback_status',$userfeedback[0]->	feedback_status_code,['class'=>'form-control','placeholder'=>'Feedback Status']) !!}
					<a class="error_1">{{ $errors->first('feedback_status') }}</a>
                  </div>
                </div>		
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('users_feedback')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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
	

