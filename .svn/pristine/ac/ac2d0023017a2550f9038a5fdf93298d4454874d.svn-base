@extends('layouts.layout')
@section('title')
@stop
@section('content')
@include('adminpages.adminheader')
@include('adminpages.leftmenu')
<style>
.modal_gallery {
    display: none;
    position: fixed; 
    z-index: 1; 
    padding-top: 50px; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.9); 
	overflow-y: hidden;
}
/* Modal Content */
.modal_content_gallery {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close_button_gallery {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close_button_gallery:hover,
.close_button_gallery:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev_gallery,
.next_gallery {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next_gallery {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev_gallery:hover,
.next_gallery:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
     color: #151c25;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
    background: #fff;
    box-shadow: 2px 2px 2px 0.2px #3c2f2f;

}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Advertisement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Advertisement</li>
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
/* 	alert(id); */
/* alert(status); */
		$.ajax({
					type      : "POST",
					url       : "{{URL('ads_activestatus')}} ",   
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
						/* 	$('.modal-title').text('Status'); */
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

          <div class="card">
            <div class="add-adv-btn">
			<?php
			$user_role = Session::get('user_role');
			if($user_role != "3"){?>
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			  <a href="#" onclick="call_add_page()" style="font-color:#000000 !important; text-decoration:none;" ><button class="btn btn-success add_page" title="Add Advertisement" data-toggle="tooltip" data-placement="bottom">Add Advertisement</button></a>
			<?php } ?>
            </div>
            <!-- /.card-header -->
			
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
				
                <tr>
					<th style="max-width: 20px;">#</th>
                  <th>Business Name</th>
                  <th style="max-width: 20px;">Ad Name</th>
                  <th style="max-width: 65px;">Valid From</th>
                  <th style="    min-width: 45px;">Valid To</th>
                  <th>Description</th>
                  <th>Caption</th>
				  <th>Language</th>
				  <th>Icon</th>
				 <!-- <th>Advertisment Image</th>-->
				 
                  <th style="min-width: 190px !important;">Action</th>
                </tr>
                </thead>
                <tbody>
				<?php $i=1; /* echo"<pre>"; print_r($ads); */?>
				@foreach($ads as $ads)
				<?PHP 
			
				$status = ($ads['is_active']==1)? 'Active' : 'Inactive';
				$status_class = ($ads['is_active']==1)? 'btns-success': 'btns-danger';
					/* $lang_name ="";
					 foreach($lang as $language)
					{
						if($ads->language_id == $language->language_id)
						{
							$lang_name = $language->name_in_english;
						}
					}*/
					$business_name ="";
					foreach($business as $busi)
					{
						if($busi->business_id == $ads->business_id)
						{
							$business_name = $busi->name;
						}
					} 
					
			$date_from = date('d-m-Y', strtotime($ads->valid_from));
			$date_to = date('d-m-Y', strtotime($ads->valid_to));
			?>
                <tr>
					<td>{{$i++}}</td>
                  <td style="    max-width: 121px;">{{$business_name}}</td>
                  <td><a title="View" data-toggle="tooltip" data-placement="bottom" class="view" href="javascript:void(0)" onclick = "single_view('{{$ads->advertisement_id}}')">{{$ads->name}}</a></td>
                  <td> {{$date_from}}</td>
                  <td>{{$date_to}}</td>
                  <td style="width: 150px;word-wrap: break-word;word-break: break-all;"><?php foreach($adv_desc as $adv_des){
					  if($adv_des->advertisement_id == $ads->advertisement_id)
					  {?>
						  {{$adv_des->description}}
					 <?php }
				  }?></td>
                  <td><?php foreach($adv_desc as $adv_des){
					  if($adv_des->advertisement_id == $ads->advertisement_id)
					  {?>
						  {{$adv_des->caption}}
					 <?php }
				  }?></td>
                  <td style="word-wrap: break-word;word-break:break-all;width: 93px;"><?php foreach($adv_desc as $adv_des){
					  if($adv_des->advertisement_id == $ads->advertisement_id)
					  {?>
						  {{$adv_des->language}}
					 <?php }
				  }?></td>
				
                  <td><img src="{{url('ads1/uploads/doc/'.$ads->advertisement_id.'/'.$ads->icon_image_url)}}" width="50px" height="50px" class="img-circle"></td>
				  <!-- <td><img src="{{url('advertisement_images/uploads/doc/'.$ads->advertisement_id.'/'.$ads->image_url)}}" width="50px" height="50px" class="img-circle"></td>-->
				  <td>
				  <?php
				
					if($ads->active == 1)
					{
						if($user_role != "3")
						{
				?>
				 
				  <a title="Advertisement Business Address" href="{{url('ads_bus_addr/'.encrypt($ads->advertisement_id).'/'.encrypt($ads->business_id))}}" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm"><li  class="fa fa-hdd-o fa-lg"></li></a>
				  <a href="#" title="Edit" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm edit" onclick="call_page('{{encrypt($ads->advertisement_id)}}')"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a href="{{url('adsdelete/'.encrypt($ads->advertisement_id))}}" title="Delete" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a>
				   <a href="#" title="Status" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm">
				  <i title="Status" id="status_{{$ads->advertisement_id}}" data="{{$ads->advertisement_id}}" class="status_checks btn btn_w {{$status_class}}"><span class='{{$status}}'></span></i> </a>
				<?php 
						}
						else
						{
				?>
							<!--<a title="View" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "single_view('{{$ads->advertisement_id}}')"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i></a>-->
				<?php 
						}
				?>
				 <!-- <a title="Advertisement Business Address" href="{{url('ads_bus_addr/'.encrypt($ads->advertisement_id).'/'.encrypt($ads->business_id))}}" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm"><li  class="fa fa-hdd-o fa-lg"></li></a>-->
				<?php 
				  }
				  else
				  {
					echo "<a style='color:#ee2b01;'>Business deactivated</a>";
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
            <div class="modal-content " >
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
		
		columnDefs: [ {targets: [8,9], "orderable": false } ]
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
	
	function single_view(id)
	{
		/* alert(id); */
		var token = $('meta[name="csrf_token"]').attr('content');
		$.ajax({
			type:"POST",
			url:"{{URL('ads_single')}}",
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
		var ur = 'adsedit/'+id;
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
			url:"{{url('adsadd')}}",
			data:{
			},success:function(response)
			{
				$("#page_details").html(response);
			}
			
		});
		$('#modal-default_1').modal('show');
	}
	
		$(function () {
  $('[data-toggle="tooltip"]').tooltip({
	   trigger : 'hover'
  })
})
	
</script>
@include('adminpages.adminfooter')
@stop