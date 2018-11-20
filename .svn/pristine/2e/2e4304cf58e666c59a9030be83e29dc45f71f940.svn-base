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
            <h1>Add User Bank Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('user')}}">Manage User</a></li>
              <li class="breadcrumb-item active">Add User Bank Details</li>
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
                    {!! Form::label('channel','Channel') !!}<span class="mandatory">*</span>
					{!!Form::text('channel',null,['class'=>'form-control','placeholder'=>'Channel']) !!}
					<a class="error_1">{{ $errors->first('channel') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('ac_holdeer_name','Account Holder Name') !!}
					{!!Form::text('ac_holdeer_name',null,['class'=>'form-control','placeholder'=>'Account Holder Name']) !!}
					<a class="error_1">{{ $errors->first('ac_holdeer_name') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('code','Code') !!}<span class="mandatory">*</span>
					{!!Form::text('code',null,['class'=>'form-control','placeholder'=>'Code']) !!}
					<a class="error_1">{{ $errors->first('code') }}</a>
                  </div>
                  <div class="form-group">
                    {!! Form::label('ifsc','Ifsc') !!}
					{!!Form::text('ifsc',null,['class'=>'form-control','placeholder'=>'Ifsc']) !!}
					<a class="error_1">{{ $errors->first('ifsc') }}</a>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('users_bank_details')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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