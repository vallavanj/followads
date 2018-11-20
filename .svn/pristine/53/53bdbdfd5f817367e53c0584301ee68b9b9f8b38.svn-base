
<div class="content-wrapper">
 <section class="content-header">
     <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="popup_title">Edit Static Pages</h1>
          </div>
           <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('static_pages')}}">Manage Static Pages</a></li>
              <li class="breadcrumb-item active">Edit Static Pages</li>
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
                    {!! Form::label('page_title','Title') !!}<span class="mandatory">*</span>
					{!!Form::text('page_title',$deatils[0]->page_title,['class'=>'form-control','placeholder'=>'Title','required'=>'']) !!}
					<a class="error_1">{{ $errors->first('page_title') }}</a>
                  </div>
				  <div class="form-group add-s-page">
                    {!! Form::label('content','Content') !!}<span class="mandatory">*</span>
					{!!Form::textarea('content',$deatils[0]->page_content,['class'=>'form-control','placeholder'=>'Content',"id"=>"editor1",'required'=>'']) !!}
					<a class="error_1" id="content">{{ $errors->first('email') }}</a>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                {!! Form::submit('Submit',['class'=>'btn btn-primary','id'=>"submit_button",'data-toggle'=>"tooltip",'data-placement'=>"bottom",'title'=>"Submit"]) !!}
				<a href="{{url('static_pages')}}" >{!! Form::button('Cancel',['class'=>'btn btn-danger','data-toggle'=>"tooltip", 'data-placement'=>"bottom",'title'=>"Cancel"]) !!}</a>
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
	/* 	jQuery(function ($) {
    $('form').validatr(); 
}); */

$(function () {
  $('#demo-form').parsley() 
  });
  
   $('#submit_button').click(function(){
	 var ck_val = $('.ck-editor__main .ck-content p').text();
	 /* alert(ck_val); */
	 if(ck_val != "")
	 {
		$('#editor1').removeAttr('required'); 
		
	 }
	 else
	 {
		 $('#editor1').text(''); 
		 
	 }
	
   });
  
  
</script>
<script>
	 $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor
      .create(document.querySelector('#editor1'))
	
      .then(function (editor) {
        /* The editor instance */
      })
      .catch(function (error) {
        /* console.error(error) */
      })

    // bootstrap WYSIHTML5 - text editor

    /* $('.textarea').wysihtml5({
      toolbar: { fa: true }
    }) */
  })
  
  
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>
