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
            <h1>Manage User Redeemed Advertisement Code</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage User Redeemed Advertisement Code</li>
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
					url       : "{{URL('user_red_adv_codeactive')}} ",   
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
							$('#modal-default').modal('show');
						}
						if(response==0)
						{
							$('#status_'+id).removeClass("status_checks btn btn_w btns-success");
							$('#status_'+id).addClass("status_checks btn btn_w btns-danger");
							$("#single_details").html('<div class="alert alert-warning text-center">Deactivated Sucessfully</div>');
							$('#modal-default').modal('show')
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

          <div class="">
            <div class="add-adv-btn">
			<?php $user_role = Session::get('user_role');
				if($user_role != "3"){?>
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			  <a href="#" onclick="call_add_page()" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success"  title="Add Redeemed Advertisement Code" data-toggle="tooltip" data-placement="bottom">Add Redeemed Advertisement Code</button></a>
				<?php } ?>
            </div>
            <!-- /.card-header -->
			<?PHP 
			/* print_r($deatils);exit; */
			?>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
                  <th>User Name</th>
                  <th>Advertisement Offer Code</th>
                  <th style="min-width: 145px;">Action</th>
                </tr>
                </thead>
                <tbody>
				@foreach($u_r_adv_code as $u_r_code)
				<?PHP 
	
				$status = ($u_r_code['is_active']==1)? 'Active' : 'Inactive';
				$status_class = ($u_r_code['is_active']==1)? 'btns-success': 'btns-danger';
			/* print_r($user);exit; */
			$user_name = "";
			foreach($user as $users)
			{
				
				if($users->user_id == $u_r_code->user_id)
				{
					 $user_name = $users->name;
				}
				
			}
			$code = "";
			foreach($adv_off_code as $adv_code)
			{
				if($adv_code->advertisement_offer_code_id == $u_r_code->advertisement_offer_code_id)
				{
					$code = $adv_code->offer_code;
				}
			}
			/* echo $user_name;exit; */
			?>
                <tr>
                  <td>{{$user_name}}</td>
                  <td><a title="View" class="" href="javascript:void(0)" onclick = "single_view('{{$u_r_code->user_redeemed_advertisement_code_id}}')">{{$code}}</a></td>
				  <td>
				  <?php 
				  $user_role = Session::get('user_role');
				if($user_role != "3")
				{
					?> 
				  <!--<a title="View" class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "single_view('{{$u_r_code->user_redeemed_advertisement_code_id}}')"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i></a>-->
				  <a href="#" class="btn btn-outline-primary btn-sm" onclick="call_page('{{encrypt($u_r_code->user_redeemed_advertisement_code_id)}}')"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a href="{{url('user_red_adv_codedelete/'.encrypt($u_r_code->user_redeemed_advertisement_code_id))}}"class="btn btn-outline-primary btn-sm"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a>
				  <a href="#" class="btn btn-outline-primary btn-sm">
				   <i title="Status" id="status_{{$u_r_code->user_redeemed_advertisement_code_id}}" data="{{$u_r_code->user_redeemed_advertisement_code_id}}" class="status_checks btn btn_w {{$status_class}}"><span class='{{$status}}'></span></i> </a>
				<?php 
				}
				else
				{
				?>
					<!--<a title="View" class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "single_view('{{$u_r_code->user_redeemed_advertisement_code_id}}')"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i></a>-->
				<?php 
				}
				?></td>
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
		<div id="modal-default_1" class="modal fade in bd-example-modal-lg" style="display: none; padding-right: 220px;">
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
			url:"{{URL('user_red_adv_codesingle')}}",
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
		var ur = 'user_red_adv_codeedit/'+id;
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
			url:"{{url('user_red_adv_codeadd')}}",
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