@extends('layouts.layout')
@section('title')
@stop
@section('content')
@include('adminpages.adminheader')
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('sample')}}">Manage User</a></li>
              <li class="breadcrumb-item active">Add User</li>
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
                    {!! Form::label('name','Name') !!}
					{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Name']) !!}
                  </div>
				  <div class="form-group">
                    {!! Form::label('email','Email') !!}
					{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
                  </div>
				  <div class="form-group">
                    {!! Form::label('default_location','Location') !!}
					{!!Form::text('default_location',null,['class'=>'form-control','placeholder'=>'Location']) !!}
                  </div>
				  <div class="form-group">
                    {!! Form::label('default_language','Language') !!}
					{!!Form::text('default_language',null,['class'=>'form-control','placeholder'=>'Language']) !!}
                  </div>
				  <div class="form-group">
                    {!! Form::label('mobile','Mobile') !!}
					{!!Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Mobile']) !!}
                  </div>
				  <div class="form-group">
				  {!! Form::label('password','Password') !!}
					  {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password','id'=>'exampleInputPassword1']) !!}
                  </div>
				  <div class="form-group">
					{!! Form::label('profile','Profile') !!}
                    <div class="input-group">
                      <div class="custom-file">
						{!!Form::file('profile',['class'=>'custom-file-input','id'=>'exampleInputFile']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('sample')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
                </div>
             {!! Form::close() !!}
            </div>

		</div>
	</div>
	</div>
    </section>
</div>
	
@include('adminpages.adminfooter')
@stop