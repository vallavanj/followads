@extends('layouts.layout')
@section('title')
@stop
@section('content')
@include('adminpages.adminheader')
@include('adminpages.leftmenu')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">

	

 window.onload = function () {
			 var mapOptions = {
			 center: new google.maps.LatLng(13.059914471078944, 80.24351539410532),
			 zoom: 14,
			 mapTypeId: google.maps.MapTypeId.ROADMAP
			 };
			 var infoWindow = new google.maps.InfoWindow();
			 var latlngbounds = new google.maps.LatLngBounds();

			 //This will load your map with default location co-ordinates.
			 var map = new google.maps.Map(document.getElementById("map_sec"), mapOptions);

			 //To capture click event.
			 google.maps.event.addListener(map, 'click', function (e) {
				
			 document.getElementById("lat").value = e.latLng.lat();
			 document.getElementById("lng").value = e.latLng.lng();
			 document.getElementById("latitude").value = e.latLng.lat();
			 document.getElementById("longitude").value = e.latLng.lng();
			 $('#latitude').attr('readonly', true);
			 $('#longitude').attr('readonly', true);
			 
			 
			
			 placeMarker(e.latLng,map);
			 });
			 
 
	 
 }

var marker;
function placeMarker(location,map) {
  if ( marker ) {
    marker.setPosition(location);
  } else {
    marker = new google.maps.Marker({
      position: location,
      map: map
    });
  }
}
</script>
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <!--<h1>Manage Business Address-{{$business[0]->name}}</h1>-->
            <h1>Manage  Address-{{$business[0]->name}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
             <!-- <li class="breadcrumb-item active">Manage Business Address-{{$business[0]->name}}</li>-->
           <li class="breadcrumb-item active">Manage  Address-{{$business[0]->name}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<script type="text/javascript">
	// Status 
	jQuery(document).on('click','.status_checks',function(){
	var status = ($(this).hasClass("btns-success")) ? '0' : '1';
	var msg = (status =='0')? 'Deactivate' : 'Activate';	
	/* alert(msg); */
	var current_element = $(this); 
	
	var id = $(current_element).attr('data');
	/* alert(id); */
/* alert(status); */
		$.ajax({
					type      : "POST",
					url       : "{{URL('business_addr_active')}} ",   
					data:{id:id ,
						status:status,
						_token: '{{ csrf_token() }}'
							},
					success : function(response) {
						/* alert(response); */
						if(response==1)
						{
							
							$('#status_'+id).removeClass("status_checks btn btn_w btns-danger");
							$('#status_'+id).addClass("status_checks btn btn_w btns-success");
							$("#single_details").html('<div class="alert alert-success text-center">Activated Sucessfully</div>');
							/* $('.modal-title').text('Status'); */
							$('#modal-default').modal('show');
						}
						if(response==0)
						{
							$('#status_'+id).removeClass("status_checks btn btn_w btns-success");
							$('#status_'+id).addClass("status_checks btn btn_w btns-danger");
							$("#single_details").html('<div class="alert alert-warning text-center">Deactivated Sucessfully</div>');
							/* $('.modal-title').text('Status'); */
							$('#modal-default').modal('show');
						}
					}
			});
    });
</script>
<section class="content">
      <div class="row">
        <div class="col-12">
		@if(Session::has('success'))
			<li class="alert alert-success">{{Session::get('success')}}<a class="close" data-dismiss="alert">×</a></li>
		@endif
          <div class="">
            <div class="">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            
          <!-- /.card -->

          <div class="card  business_back">
            <div class="add-adv-btn">
			<div class="row">
			<div class='col-6'>
			<?php 
			 $user_role = Session::get('user_role');
				if($user_role != "3")
				{
			 ?>
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			 <!--<a href="#" onclick="call_add_page('{{$id}}')" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success"  title="Add Business Address" data-toggle="tooltip" data-placement="bottom" >Add Business Address</button></a>-->
			 
			 <a href="#" onclick="call_add_page('{{$id}}')" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success"  title="Add Address" data-toggle="tooltip" data-placement="bottom" >Add Address</button></a>
			  <?php 
				}
				?>
				</div>
				
				
				 </div>
            </div>
            <!-- /.card-header -->
			<?PHP 
			/* print_r($deatils);exit; */
			?>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
				
                <tr>
                  <th>Business Name</th>
                  <th>Address</th>
                  <th>Area</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Location</th>
                  <th>Phone Number</th>
                  <th>Map Url</th>
                  <th style="min-width: 171px;">Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($buss_addr as $buss_addr)
				<?PHP 
	
				$status = ($buss_addr->is_active==1)? 'Active' : 'Inactive';
				$status_class = ($buss_addr->is_active==1)? 'btns-success': 'btns-danger';
			/* print_r($lang);exit; */
			
			 $location = json_decode($buss_addr->location,true);
			?>
                <tr>
					@foreach($business as $buss)
					 @if($buss->business_id == $buss_addr->business_id)
					  <td><a data-toggle="tooltip" data-placement="bottom" title="View" class="" href="javascript:void(0)" onclick = "single_view('{{$buss_addr->business_address_id}}')">{{$buss->name}}</a></td>
					@endif
				@endforeach
                  <td>{{$buss_addr->address}}</td>
                  <td>{{$buss_addr->area}}</td>
                  <td>{{$buss_addr->city}}</td>
                  <td>{{$buss_addr->state}}</td>
                  <td><?php
				 echo "Lat:".round($location['lat'],3).",<br>","Long:".round($location['lan'],3);
				  ?></td>
                  <td>{{$buss_addr->phone_number}}</td>
                  <td style="word-break: break-all;min-width: 200px;">{{$buss_addr->map_url}}</td>
				  <td>
				  <?php 
				  if($user_role != "3")
					{
				  ?>
				  
				  <a href="#" title="Edit" data-toggle="tooltip" data-placement="bottom"  class="btn btn-outline-primary btn-sm" onclick="call_page('{{encrypt($buss_addr->business_address_id)}}')"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a href="{{url('buss_addrdelete/'.encrypt($buss_addr->business_address_id))}}" title="Delete" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a>
				   <a href="#" title="Status" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm">
				  <i  id="status_{{$buss_addr->business_address_id}}" data="{{$buss_addr->business_address_id}}" class="status_checks btn btn_w {{$status_class}}"><span class="{{$status}}"></span></i> </a>
					<?php 
					}
					else
					{
					?>
					<!--<a data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "single_view('{{$buss_addr->business_address_id}}')"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i></a>-->
					<?php
					}
					?>
					</td>
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
			<div class="d-flex justify-content-end">
				<div class="p-2">
					<a href="javascript:history.go(-1)"  style="font-color:#000000 !important; text-decoration:none;">
						<button class="btn btn-info" title="Back" data-toggle="tooltip" data-placement="bottom">Back</button>
					</a>
				</div>
			</div>
			 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
		
		<div id="modal-default" class="modal fade in" style="display: none; padding-right: 17px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header modal_head_bg">
               <!-- <button aria-label="Close" data-dismiss="modal" class="close" type="button"></button>-->
                
				  <!--<a class="close-modal" rel="modal:close" href="#close-modal">Close</a>-->
               <h4 class="modal-title "><b>Details</b></h4><a aria-label="Close" data-dismiss="modal" class="close"><span aria-hidden="true">×</span></a><div id='singlecontent_id'></div>
              </div>
              <div class="modal-body single_details" id="single_details"></div>
              <!--<div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Close</button>
                <button class="btn btn-primary" type="button">Save changes</button>
              </div>-->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		
		
		<!--Pages Modal-->
		<div id="modal-default_1" class="modal fade in bd-example-modal-lg" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header modal_head_bg">
               <!-- <button aria-label="Close" data-dismiss="modal" class="close" type="button"></button>-->
                <a aria-label="Close" data-dismiss="modal" class="close"><span aria-hidden="true">×</span></a>
				  <!--<a class="close-modal" rel="modal:close" href="#close-modal">Close</a>-->
               <h4 class="modal-title "><b></b></h4><div id='singlecontent_id'></div>
              </div>
              <div class="modal-body page_details" id="page_details" style="padding:0px;"></div>
              <!--<div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Close</button>
                <button class="btn btn-primary" type="button">Save changes</button>
              </div>-->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		
      </div>
      <!-- /.row -->
    </section>
	</div>
<!---  Map section model -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			    <h4>Pick the Latitude and Longitude</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
				<div class="container">
					<div class="form-group">
						<label for="location">Location</label><span class="mandatory">*</span>
						<div class="row">
						 <div class="col-md-6">
								<input class="form-control" type="text" id="lat" readonly>
							</div>
						<div class="col-md-6">
								<input class="form-control"  type="text"  id="lng" readonly>
						</div>
						</div>
					</div>
					 <div class="form-group">
						<div id="map_sec" style="width:100%; height: 500px;margin:0 auto;"></div>
					</div>
				</div>
			</div>
      </div>
 </div>
		
<!-- ** End map  Model  **  -->		
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
		
		columnDefs: [ {targets: [8], "orderable": false } ]
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
  
  $('.modal').on('hidden.bs.modal', function (e) {
    if($('.modal').hasClass('in')) {
    $('body').addClass('modal-open');
    }    
});
  function doconfirm()
	{
		var delete_content=confirm("Are you sure want to delete this record?");
		if(delete_content!=true)
		{
			return false;
		}
	}
	
	function single_view(id)
	{
		var token = $('meta[name="csrf_token"]').attr('content');
		$.ajax({
			type:"POST",
			url:"{{URL('business_addr_single')}}",
			data:{
				uid:id,
				_token: '{{ csrf_token() }}'
			},success:function(response)
			{
				$("#single_details").html(response);
			}
			
		});
		$('#modal-default').modal('show');
	}
	
	function call_page(id)
	{
		/* alert('fdasf'); */
		/* var ur = 'buss_addredit/'+id; */
		/* alert(ur); */
		$.ajax({
			type:"GET",
			url:"{{url('buss_addredit')}}/"+id,
			data:{
				uid:id,
				_token: '{{ csrf_token() }}'
			},success:function(response)
			{
				$("#page_details").html(response);
			}
			
		});
		$('#modal-default_1').modal('show');
		
	}
	function call_add_page(id)
	{
		$.ajax({
			type:"GET",
			url:"{{url('business_addradd')}}/"+id,
			data:{
			},success:function(response)
			{
				$("#page_details").html(response);
			}
			
		});
		$('#modal-default_1').modal('show');
	}
	
	
		$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@include('adminpages.adminfooter')
@stop