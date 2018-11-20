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
            <h1>Manage Wallet</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Wallet</li>
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
					url       : "{{URL('wallet_activestatus')}} ",   
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
						}
						if(response==0)
						{
							$('#status_'+id).removeClass("status_checks btn btn_w btns-success");
							$('#status_'+id).addClass("status_checks btn btn_w btns-danger");
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
            <div class="">
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			  <!--<a href="#" onclick="call_add_page()" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success" >Add Wallet</button></a>-->
            </div>
            <!-- /.card-header -->
			<?PHP 
			/* print_r($deatils);exit; */
			?>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
					<th>S.NO</th>
					<th>User Name</th>
                  <th>Balance</th>
                <th></th>
                </tr>
                </thead>
                <tbody>
				<?php $i=1;?>
				@foreach($wallet as $wallets)
				<?PHP 
	
				$status = ($wallets->is_active==1)? 'Active' : 'Inactive';
				$status_class = ($wallets->is_active ==1)? 'btns-success': 'btns-danger';
			/* print_r($lang);exit; */
			
			?>
			<?php
					$name= "";
			foreach($user as $users)
					{
					if($users->user_id == $wallets->users_id)
					{
						$name = $users->name;
					}
					}?>
                <tr>
					<td>{{$i++}}</td>
					<td>{{$name}}</td>
					
                  <td><i class="fa fa-inr"> {{$wallets->balance}} </i></td>
				 <td>
				 
				  <!--<a href="url('{{'wallet_transaction/'.encrypt($wallets->wallet_id)}}')" title="Wallet Transaction" data-toggle="tooltip" data-placement="bottom"   class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "page_view('{{'wallet_transaction/'.encrypt($wallets->wallet_id)}}')"><i class="fa fa-briefcase fa-lg" aria-hidden="true" ></i></a>	-->			  
				  <a href="{{URL('wallet_transaction/'.encrypt($wallets->wallet_id))}}" title="Wallet Transaction" data-toggle="tooltip" data-placement="bottom"   class="btn btn-outline-primary btn-sm"><i class="fa fa-briefcase fa-lg" aria-hidden="true" ></i></a>
				  
				
				 <!-- <a href="#" title="Status" data-toggle="tooltip" data-placement="bottom"  class="btn btn-outline-primary btn-sm">
				  <i  id="status_{{$wallets->wallet_id}}" data="{{$wallets->wallet_id}}" class="status_checks btn btn_w {{$status_class}}"><span class="{{$status}}"></span></i></a>
					<a title="View" data-toggle="tooltip" data-placement="bottom"  class="btn btn-outline-primary btn-sm" href="javascript:void(0)" onclick = "single_view({{$wallets->wallet_id}})"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i></a>				  
				  <a href="#" title="Edit" data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm" onclick="call_page('{{encrypt($wallets->wallet_id)}}')"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a title="Delete" href="{{url('walletdelete/'.encrypt($wallets->wallet_id))}}"  data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a>
				    <a title="Transaction" href="#"  onclick = "page_view('{{'wallet_transaction/'.encrypt($wallets->wallet_id)}}') "data-toggle="tooltip" data-placement="bottom" class="btn btn-outline-primary btn-sm"><li  class="fa fa-hdd-o fa-lg"></li></a>-->
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
		
		columnDefs: [ {targets: [3], "orderable": false } ]
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
			url:"{{URL('wallet_single')}}",
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
		/* alert('fdasf'); */
		var ur = 'walletedit/'+id;
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
			url:"{{url('walletadd')}}",
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
	function page_view(url)
	{
		$.ajax({
			type:"GET",
			url:url,
			data:{
			},success:function(response)
			{
				$("#page_details").html(response);
			}
			
		});
		$('#modal-default_1').modal('show');
	}
</script>
	

@include('adminpages.adminfooter')
@stop