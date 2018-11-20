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
            <h1 class="popup_title">Manage Wallet Transaction</h1>
          </div>
         <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Wallet Transaction</li>
            </ol>
          </div>-->
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
					url       : "{{URL('wallet_transaction_activestatus')}} ",   
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
		<section class="content-header">
			  <div class="container-fluid">
				<div class="row mb-2">
				  <div class="col-sm-6">
					<h1>Add Wallet Transaction</h1>
				  </div>
				  <div class="col-sm-6">
					
				  </div>
				</div>
			  </div><!-- /.container-fluid -->
			</section>
		@if(Session::has('success'))
			<li class="alert alert-success">{{Session::get('success')}}</li>
		@endif
          <div class="card">
            <div class="">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            
          <!-- /.card -->

          <div class="">
            <div class="add-adv-btn">
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			 <a href="#" onclick="call_add_page({{$w_t_id}})" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success"  title="Add Wallet Transaction" data-toggle="tooltip" data-placement="bottom" >Add Wallet Transaction</button></a>
            </div>
            <!-- /.card-header -->
			<?PHP 
			$i=1;
			/* print_r($w_transaction);exit; */
			?>
            <div class="card-body">
              <table id="wallet_transaction_table" class="table table-bordered table-striped">
                <thead>
				
                <tr>
				 <th>#</th>
				 <th>Wallet Id</th>
				 <th>User Name</th>
                  <th>Transaction Type</th>
                  <th>Transaction Amount</th>
                  <th>Gift Coupon</th>
                  <!--<th style="min-width: 145px;">Action</th>-->
                </tr>
                </thead>
                <tbody>
				@foreach($w_transaction as $w_transactions)
				<?PHP 
	
				$status = ($w_transactions->is_active==1)? 'Active' : 'Inactive';
				$status_class = ($w_transactions->is_active ==1)? 'btns-success': 'btns-danger';
			/* print_r($lang);exit; */
			
			?>
                <tr>
					<td>{{$i++}}</td>
					<td>{{$w_transactions->wallet_id}}</td>
					<td>{{$w_transactions->user_name}}</td>
                  <td>
				  <?php
				  if($w_transactions->transaction_type == 1)
				  {
					  echo "Credit";
				  }
				  else
				  {
					  echo "Debit";
				  }
				  ?></td>
                  <td><i class="fa fa-inr"> {{$w_transactions->transaction_amount}} </i></td>
				  
                  <td>
				  @foreach($coupons as $coupon)
				  @if($w_transactions->gift_coupon_id == $coupon->gift_coupon_id){{$coupon->code}}@endif
				  @endforeach
				  </td>
				
				 <!-- <td>
				   <a href="#" class="btn btn-outline-primary btn-sm">
				  <i title="Status" id="status_{{$w_transactions->wallet_transaction_id}}" data="{{$w_transactions->wallet_transaction_id}}" class="status_checks btn btn_w {{$status_class}}"><span class="{{$status}}"></span></i></a>
					<a title="View" class="btn btn-outline-primary btn-sm"  href="javascript:void(0)" onclick = "single_view({{$w_transactions->wallet_transaction_id}})"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i></a>	
				  <a href="#" class="btn btn-outline-primary btn-sm" onclick="call_page('{{encrypt($w_transactions->wallet_transaction_id)}}')"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
				  <a href="{{url('wallet_transactiondelete/'.encrypt($w_transactions->wallet_transaction_id))}}" class="btn btn-outline-primary btn-sm"><li  class="fa fa-trash fa-lg" onclick= 'return doconfirm()'></li></a></td>-->
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
    $("#wallet_transaction_table").DataTable({
		'paging'      : true,
		 "pageLength": 10,
		'lengthChange': false,
		'searching'   : true,
		'ordering'    : true,
		'info'        : false,
		'autoWidth'   : false,
		
		/* columnDefs: [ {targets: [2], "orderable": false } ] */
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
			url:"{{URL('wallet_transaction_single')}}",
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
		var ur = 'wallet_transactionedit/'+id;
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
	function call_add_page(id)
	{
		$.ajax({
			type:"GET",
			url:"{{url('wallet_transactionadd')}}/"+id,
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
