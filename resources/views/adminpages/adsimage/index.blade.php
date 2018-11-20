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
            <h1>Manage Ads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Ads</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
      <div class="row">
        <div class="col-12">
		@if(Session::has('success'))
			<li class="alert alert-success">{{Session::get('success')}}</li>
		@endif
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage AdsImage</h3>
            </div>
            <!-- /.card-header -->
            
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			  <a href="{{url('ads_imageadd')}}" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success" >Add AdsImage</button></a>
            </div>
            <!-- /.card-header -->
			<?PHP 
			/* print_r($deatils);exit; */
			?>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
                  <th>Ads Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($ads_image as $ads)
                <tr>
                  <td><img src="{{url('adsimage/uploads/doc/'.$ads->ads_images_id.'/'.$ads->ads_images_url)}}" width="50px" height="50px" class="img-circle"></td>
				  <td><a href="{{url('ads_imageedit/'.encrypt($ads->ads_images_id))}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a href="{{url('ads_imagedelete/'.encrypt($ads->ads_images_id))}}"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a></td>
                </tr>
				@endforeach
                </tbody>
               <?PHP /* <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                  <th>CSS grade</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> */ ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	</div>
	
	<script>
  $(function () {
    $("#example1").DataTable({
		'paging'      : true,
		 "pageLength": 10,
		'lengthChange': false,
		'searching'   : true,
		'ordering'    : true,
		'info'        : false,
		'autoWidth'   : false,
		
		columnDefs: [ {targets: [1], "orderable": false } ]
	});
   /*  $('#example2').DataTable({
      'paging'      : false,
	  'lengthChange': false,
	  'searching'   : false,
	  'ordering'    : true,
	  'info'        : false,
	  'autoWidth'   : false,
    }); */
  });
  
  
  function doconfirm()
	{
		var delete_content=confirm("Are you sure want to delete this record?");
		if(delete_content!=true)
		{
			return false;
		}
	}
</script>
@include('adminpages.adminfooter')
@stop