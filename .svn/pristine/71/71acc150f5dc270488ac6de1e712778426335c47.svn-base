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
            <h1>Edit Store</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('stores')}}">Manage Store</a></li>
              <li class="breadcrumb-item active">Edit Store</li>
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
			  <?PHP
              /*  echo"<pre>";			  
			  print_r($store);exit; */
			?>
			  {!! Form::open(array("enctype"=>"multipart/form-data")) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('name','Name') !!}<span class="mandatory">*</span>
					{!!Form::text('name',$store[0]->store_name,['class'=>'form-control','placeholder'=>'Name']) !!}
					<a class="error_1">{{ $errors->first('name') }}</a> 
                  </div>
				  <div class="form-group">
                    {!! Form::label('address','Address') !!}<span class="mandatory">*</span>
					{!!Form::text('address',$store[0]->store_address,['class'=>'form-control','placeholder'=>'Address']) !!}
					<a class="error_1">{{ $errors->first('address') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('area','Area') !!}<span class="mandatory">*</span>
					{!!Form::text('area',$store[0]->store_area,['class'=>'form-control','placeholder'=>'Area']) !!}
					<a class="error_1">{{ $errors->first('area') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('city','City') !!}<span class="mandatory">*</span>
					{!!Form::text('city',$store[0]->store_city,['class'=>'form-control','placeholder'=>'City']) !!}
					<a class="error_1">{{ $errors->first('city') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('state','State') !!}<span class="mandatory">*</span>
					{!!Form::text('state',$store[0]->store_state,['class'=>'form-control','placeholder'=>'State']) !!}
					<a class="error_1">{{ $errors->first('state') }}</a>
                  </div>
				  <div class="form-group">
                    {!! Form::label('location','Location') !!}<span class="mandatory">*</span>
					{!!Form::text('location',$store[0]->store_location,['class'=>'form-control','placeholder'=>'Location']) !!}
					<a class="error_1">{{ $errors->first('location') }}</a>
                  </div>
				  <div class="form-group">
                    <img src="{{url('store/uploads/doc/'.$store[0]->store_id.'/'.$store[0]->store_logo_url)}}" width="50px" height="50px">
                  </div>
				  <div class="form-group">
					{!! Form::label('store_image','StoreImage') !!}<span class="mandatory">*</span>
                    <div class="input-group">
                      <div class="custom-file">
						{!!Form::file('store_image',['class'=>'custom-file-input','id'=>'exampleInputFile']) !!}
						{!! Form::label('Choose file','Choose file',['class'=>'custom-file-label']) !!}
						<a class="error_1">{{ $errors->first('store_image') }}</a>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
				<a href="{{url('stores')}}">{!! Form::button('Cancel',['class'=>'btn btn-danger']) !!}</a>
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