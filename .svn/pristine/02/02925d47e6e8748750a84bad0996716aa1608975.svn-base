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
            <h1>Manage StoreImages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage StoreImages</li>
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
              <h3 class="card-title">Manage StoreImages</h3>
            </div>
            <!-- /.card-header -->
            
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			  <a href="{{url('store_imageadd')}}" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success" >Add StoreImages</button></a>
            </div>
            <!-- /.card-header -->
			<?PHP 
			/* print_r($deatils);exit; */
			?>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($deatils as $store_image)
                <tr>
                  <td><img src="{{url('storeimage/uploads/doc/'.$store_image->stores_images_id.'/'.$store_image->stores_images_url)}}" width="50px" height="50px" class="img-circle"></td>
				  <td><a href="{{url('store_imageedit/'.encrypt($store_image->stores_images_id))}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a href="{{url('store_imagedelete/'.encrypt($store_image->stores_images_id))}}"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a></td>
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