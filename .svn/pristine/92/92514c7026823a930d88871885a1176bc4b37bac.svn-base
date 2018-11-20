@extends('layouts.layout')
@section('title')
@stop
@section('content')
@include('adminpages.adminheader')
@include('adminpages.leftmenu')
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Offers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('ads')}}">Manage Offers</a></li>
              <li class="breadcrumb-item active">Add Offers</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
	<div class="container-fluid">
			<div class="row">
			  <!-- left column -->
			 <div class="col-md-6" style="margin-left: 22%">
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
                    {!! Form::label('name','Name') !!}<span class="mandatory">*</span>
					{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Name']) !!}
					<a class="error_1">{{ $errors->first('name') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('description','Description') !!}<span class="mandatory">*</span>
					{!!Form::textarea('description',null,['class'=>'form-control','placeholder'=>'Description',"cols"=>"20","rows"=>"2"]) !!}
					<a class="error_1">{{ $errors->first('description') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('offer_caption','Caption') !!}
					{!! Form::text('offer_caption',null,['class'=>'form-control','placeholder'=>'Caption']) !!}
                  </div> 
				  <div class="form-group">
                  {!! Form::label('valid_from','Valid From') !!}

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
					{!! Form::text('valid_from',null,['class'=>'form-control float-right','placeholder'=>'Valid From','id'=>"validfrom"]) !!}
                  </div>
                  <!-- /.input group -->
                </div>
				<div class="form-group">
					 {!! Form::label('valid_to','Valid To') !!}
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
					{!! Form::text('valid_to',null,['class'=>'form-control float-right','placeholder'=>'Valid To','id'=>'validto']) !!}
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('offers')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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
</script>
@include('adminpages.adminfooter')
@stop