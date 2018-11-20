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
            <h1>Manage Advertisement Business Address-{{$business[0]->name}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Advertisement Business Address-{{$business[0]->name}}</li>
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
					url       : "{{URL('ads_bus_addr_activestatus')}} ",   
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
          <div class="card">
            <div class="">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            
          <!-- /.card -->

          <div class="card">
            <div class="add-adv-btn">
			<div class="row">
			<div class='col-6'>
			<?php 
			 $user_role = Session::get('user_role');
				if($user_role != "3")
				{
			 ?>
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			  <a href="#" onclick="call_add_page('{{encrypt($id)}}','{{encrypt($business[0]->business_id)}}')" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success"  title="Add Advertisement Business Address" data-toggle="tooltip" data-placement="bottom">Add Advertisement Business Address</button></a>
			  <?php 
				}
			  ?>
			  </div>
			 
			</div>
            </div>
            <!-- /.card-header -->
			
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
                  <th>Advertisement Description</th>
                  <th>Business Address</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($ads_bus_addr as $ads)
				<?php $status = ($ads['is_active']==1)? 'Active' : 'Inactive';
				$status_class = ($ads['is_active']==1)? 'btns-success': 'btns-danger';?>
                <tr>
                  <td><a title="View" data-toggle="tooltip" data-placement="bottom" class="" href="javascript:void(0)" onclick = "single_view('{{$ads->advertisement_business_address_id}}')">{{$ads->description}}</a></td>
					
					
                  <td> {{$ads->address}}</td>
				
                  <td>
				  <?php 
				  if($user_role != "3")
					{
				  ?>
				 
				  <a href="#" title="Edit" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm" onclick="call_page('{{encrypt($ads->advertisement_business_address_id)}}','{{encrypt($business[0]->business_id)}}')"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a href="{{url('ads_bus_addrdelete/'.encrypt($ads->advertisement_business_address_id))}}" title="Delete" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a>
				  <a href="#" title="Status" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm">
				  <i  id="status_{{$ads->advertisement_business_address_id}}" data="{{$ads->advertisement_business_address_id}}" class="status_checks btn btn_w {{$status_class}}"><span class='{{$status}}'></span></i></a> 
				  <?php
					}
					else
					{
				?>
						<!---<a title="View" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "single_view('{{$ads->advertisement_business_address_id}}')"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i></a>--->
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
		
		<!--Pop Up single view-->
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
		<div id="modal-default_1" class="modal fade in bd-example-modal-lg" style="display: none; ">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" >
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
		
		columnDefs: [ {targets: [2], "orderable": false } ]
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
			url:"{{URL('ads_bus_addr_single')}}",
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
	
	function call_page(id,bus_id)
	{
		/* alert('fdasf'); */
		/* var ur = 'ads_bus_addredit/'+id; */
		/* alert(ur); */
		$.ajax({
			type:"GET",
			url:"{{url('ads_bus_addredit')}}/"+id+"/"+bus_id,
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
	function call_add_page(id,busid)
	{
		$.ajax({
			type:"GET",
			url:"{{url('ads_bus_addradd')}}/"+id+"/"+busid,
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