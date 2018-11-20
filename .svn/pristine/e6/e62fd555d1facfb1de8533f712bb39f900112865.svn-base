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
            <h1>Manage Users</h1>
			
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Users</li>
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
					url       : "{{URL('user_single_active')}} ",   
					data:{id:id ,
						status:status,
						_token: '{{ csrf_token() }}'
							},
					success : function(response) {
						/* alert(response); */
						if(response==1)
						{
							$("#single_details").html('<div class="alert alert-success text-center">Activated Sucessfully</div>');
							$('#status_'+id).removeClass("status_checks btn btn_w btns-danger");
							$('#status_'+id).addClass("status_checks btn btn_w btns-success");
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
<style>
table tr td.user_name 
{
  table-layout:fixed;
  width:100px;
  overflow:hidden;
  word-wrap:break-word;
}
table tr td.email_user 
{
  table-layout:fixed;
  width:100px;
  overflow:hidden;
  word-wrap:break-word;
}
</style>
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
			
         <div class="card">
		 <?php 
		 
		$user_role = Session::get('user_role');
		
		 if($user_role != '2' && $user_role != '3'){?>
            <div class="add-adv-btn">
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			  <a href="#"  onclick="call_add_page()" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success" title="Add User" data-toggle="tooltip" data-placement="bottom">Add User</button></a>
            </div>
            <!-- /.card-header -->
		<?PHP 
		 }
		
			/* print_r($deatils);exit; */
			$i =1;
			?>
            <div class="card-body">
			<div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
				
                <tr>
				<th>#</th>
                  <th>Name</th>
                  <th style="max-width: 50px;">User Type</th>
                  <th>Email</th>
                <!--  <th>Location</th>
                  <th>Language</th>  -->
                  <th>Mobile</th>
                  <!--<th>Profile</th>  -->
                  <th style="min-width: 145px;">Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($deatils as $user)
				<?PHP 
	
				$status = ($user->is_active==1)? 'Active' : 'Inactive';
				$status_class = ($user->is_active==1)? 'btns-success': 'btns-danger';
				
			/* print_r($lang);exit; */
			
			if(is_numeric($user->email)|| $user->email == "")
			{
				$email = "";
			}
			else
			{
				$email = $user->email;
			}
			
			$location = json_decode($user->default_location,true);
			?>
                <tr>
					<td>{{$i}}</td>
                  <td class="user_name"> <a title="View" data-toggle="tooltip" data-placement="bottom" class="" href="javascript:void(0)" onclick = "single_view('{{$user->user_id}}')">{{$user->name}}</a> </td>
                  <td>
				  <?php
				  
					if($user->user_type_code == 'sa')
					{  echo 'Super Admin';   }
					else if($user->user_type_code == 'ad')
					{   echo 'Admin';    }
					else if($user->user_type_code == 'iu')
					{   echo  'Internal User';   }
					else
					{  $user_type = '';   }
						  
				    ?>
				  </td>
                  <td class="email_user">{{$email}}</td>
                  <!--<td><?php  //echo "Lat:".round($location['lat'],3).",<br>","Long:".round($location['lan'],3);  ?></td>
				 
                  <td>  
					@foreach($language as $lang )
					  @if($user->default_language_id == $lang->language_id)
					  {{$lang->name_in_english}}
					   @endif
					@endforeach
				  </td>  -->
				 
                  <td>{{$user->mobile_number}}</td>
				  
                 <!-- <td>
						 
						<?php
						
					/*	if(!($user->profile_img_url)) {
							echo 'No image available';
						}
						else {
						$path='profile/uploads/doc/'.$user->user_id.'/'.$user->profile_img_url;
						if(file_exists($path)) {  ?>
						<img src="{{url('profile/uploads/doc/'.$user->user_id.'/'.$user->profile_img_url)}}" width="50px" height="50px" class="img-circle">
						<?php }  else {
						echo 'No image available'; } 
						} */  ?> 
						
						
						
						</td>  -->
				  <td class="user_action">
				  <?php
				  if($user_role != '2' && $user_role != '3')
				  {
					?>
				<a title="Saved Advertisement" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "page_view('{{'user_saved_adv/'.$user->user_id}}')"><i class="fa fa-hdd-o fa-lg" aria-hidden="true" ></i></a>
				  <a title="Followed Business" data-toggle="tooltip" data-placement="bottom"   class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "page_view('{{'user_follow_business/'.$user->user_id}}')"><i class="fa fa-briefcase fa-lg" aria-hidden="true" ></i></a>
				  
				 <?php /*  <a title="View" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "single_view('{{$user->user_id}}')"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i></a> */ ?>
				  <a  title="Edit" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-outline-primary btn-sm" onclick="call_page('{{encrypt($user->user_id)}}')"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a title="Delete" data-toggle="tooltip" data-placement="bottom" href="{{url('userdelete/'.encrypt($user->user_id))}}" class="btn btn-outline-primary btn-sm"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a>
				  <a href="#" title="Status" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm">
				  <i id="status_{{$user->user_id}}" data="{{$user->user_id}}" class="status_checks btn btn_w {{$status_class}}"><span class={{$status}}></span></i></a>
				 
				   <?php 
				   }
				   else
				   {
					?>
					  
					  <a title="Saved Advertisement" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "page_view('{{'user_saved_adv/'.$user->user_id}}')"><i class="fa fa-hdd-o fa-lg" aria-hidden="true" ></i></a>
				  <a title="Followed Business" data-toggle="tooltip" data-placement="bottom"   class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "page_view('{{'user_follow_business/'.$user->user_id}}')"><i class="fa fa-briefcase fa-lg" aria-hidden="true" ></i></a>
				  <?php 
				   }
				   ?> 
				 
				  
				  </td>
                </tr>
				<?php $i++;?>
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
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
		    
        </div>
		
		<!--Pop up-->
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
               <h4 class="modal-title "><b></b></h4>
					<div  class="map_section">
							<div id='singlecontent_id'></div>
					</div>
			    </div>
			 
			 
              <div class="modal-body page_details" id="page_details" style="padding:0px;"></div>
						
            
            </div>
                
			 
		
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		
		<!--Pages Modal-->
		<div id="modal-default_2" class="modal fade in bd-example-modal-lg" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header modal_head_bg">
               <!-- <button aria-label="Close" data-dismiss="modal" class="close" type="button"></button>-->
                <a aria-label="Close" data-dismiss="modal" class="close"><span aria-hidden="true">×</span></a>
				  <!--<a class="close-modal" rel="modal:close" href="#close-modal">Close</a>-->
               <h4 class="modal-title "><b></b></h4><div id='singlecontent_id'></div>
              </div>
             
			  
              <!--<div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Close</button>
                <button class="btn btn-primary" type="button">Save changes</button>
              </div>-->
            </div>
			 <div class="modal-body page_details" id="page_details_1" style="padding:0px;"></div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		
		
        <!-- /.col -->
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
	
	
	
	
	
	<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
		'paging'      : true,
		 "pageLength": 10,
		'lengthChange': false,
		'searching'   : true,
		'ordering'    : true,
		'info'        : false,
		'autoWidth'   : false,
		
		
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
  
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  
  
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
		/* alert(id); */
		var token = $('meta[name="csrf_token"]').attr('content');
		$.ajax({
			type:"POST",
			url:"{{URL('user_single')}}",
			data:{
				uid:id,
				_token: '{{ csrf_token() }}'
			},success:function(response)
			{
				/* alert(response); */
				$("#single_details").html(response);
			}
			
		});
		$('#modal-default').modal('show');
	}
	
	
	function call_page(id)
	{
		/* alert('yes'); */
		var ur = 'useredit/'+id;
		/* alert(ur); */
		$.ajax({
			type:"GET",
			url:ur,
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
	function call_add_page()
	{
		$.ajax({
			type:"GET",
			url:"{{url('useradd')}}",
			data:{
			},success:function(response)
			{
				$("#page_details").html(response);
				
			}
			
		});
		$('#modal-default_1').modal('show');
		
	}

	function page_view(url)
	{
		$.ajax({
			type:"GET",
			url:url,
			data:{
			},success:function(response)
			{
				$("#page_details_1").html(response);
			}
			
		});
		$('#modal-default_2').modal('show');
	}
</script>
@include('adminpages.adminfooter')
@stop