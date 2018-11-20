@extends('layouts.layout')
@section('title')
@stop
@section('content')
@include('adminpages.adminheader')
@include('adminpages.leftmenu')
<style>
.search_section {
	margin-top:30px;
}
div.dataTables_wrapper div.dataTables_filter {
		top: -37px;
		position: relative;
		width: 23%;
		padding: 0px 5px;
		left: 76%;
}
</style>
<div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Wallet Redeem</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Wallet Redeem</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<script type="text/javascript">

 
 $(document).ready(function() {
	$('.status_checks').click(function() {
				var status = ($(this).hasClass("btn-success")) ? '0' : '1';
				var msg = (status =='0')? 'Deactivate' : 'Activate';	
				//alert(msg); 
				var current_element = $(this); 
	
					if(msg !== 'Activate')
					{
					
							var id = $(current_element).attr('data');
							var amount = $(current_element).attr('aria');
							var w_id = $(current_element).attr('data-id');
							
								$.ajax({
											type      : "POST",
											url       : "{{URL('wallet_redeem_activestatus')}} ",   
											data:{id:id ,
												status:status,
												amount:amount,
												wid :w_id,
												_token: '{{ csrf_token() }}'
													},
											success : function(response) {
											
												if(response==0)
												{
													//$('#status_'+id).removeClass("status_checks btn btn_w btn-success");
												  /* $('#status_'+id).addClass("status_checks btn btn_w btn-danger"); */
													$("#single_details").html('<div class="alert alert-warning text-center">Amount Activated Sucessfully</div>');
													$('#modal-default').modal('show');
													window.location.reload();
													//$(".status_checks").html('Approved');
												}
												
											
											}
									});
							
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
				<div class="add-adv-btn" style="display:inline-block;top:20px;">
				<?php 
				
				$i = 1;
			 $user_role = Session::get('user_role');
				if($user_role != "3")
				{
			 ?>
					<!--<h3 class="card-title">Data Table With Full Features</h3>-->
					<a href="#" onclick="call_add_page()"  style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success" title="Add Wallet Redeem" data-toggle="tooltip" data-placement="bottom">Add Wallet Redeem</button></a>
				<?php 
				}
				?>
				</div>
					
					
		    
		  
            
            <!-- /.card-header -->
			<?PHP 
			/* print_r($w_transaction);exit; */
			?>
            <div class="card-body">
			     <div class="search_section">
					<div class="row clearfix" >
					   <div class="col-7">
					    <div class="input-group input-daterange">
							<label class="col-sm-3 col-form-label">Date Range Filter :</label>
								<div class="input-group-prepend">
									  <span class="input-group-text">
										<i class="fa fa-calendar"></i>
									  </span>
								</div>
							<input type="text" id="min-date" class="form-control date-range-filter" data-date-format="dd-mm-yyyy" placeholder="From Date" >
							<div class="input-group-addon">to</div>
							<input type="text" id="max-date" class="form-control date-range-filter" data-date-format="dd-mm-yyyy" placeholder="To Date">
							<div class="input-group-prepend">
									  <span class="input-group-text">
										<i class="fa fa-calendar"></i>
									  </span>
								</div>
						</div>
					  </div>
						<div class="col-2">
								<select id="exportLink" class="form-control">
								<option>Export Redeem Request</option>
								<option id="excel">Export as XLS</option>                                         
								<option id="pdf">Export as PDF</option>
								<option id="csv">Export as CSV</option>
							</select>
						</div>
					</div>
		    </div>
				 <table id="example1" class="table table-bordered table-responsive">
							<thead>
							
									<tr>
											<th>#</th>
											<th>Wallet Id</th>
											<th>Name</th>
											<th>Payment Channel</th>
											<th>Account Holder Name</th>
											<th>Account Number</th>
											<th>IFSC CODE</th>
											<th>Bank Name</th>
											<th>Branch Name</th>
											<th>MMID</th>
											<th>Redeem Amount</th>
											<th>Requested Date</th>
											<th>Payment Status</th>
									</tr>
							</thead>
					<tbody>
				
				
				<?PHP 

	          
			foreach($wallet_reedem_all_pay as $w_transaction) {
				
				//print_r($w_transaction);
				$status = ($w_transaction['is_active']==1)? 'Active' : 'Inactive';
				/* $status_class = ($w_transaction['is_active'] ==1)? 'btn-success': 'btn-danger'; */
				$status_class = ($w_transaction['is_active'] ==1)? 'btn-success': 'btn-success';
				$status_approved = ($w_transaction['is_active']==1)? 'Done' : 'Approved';
			/* print_r($lang);exit; */
			

			?>
               <tr>
					<td>{{ $i++}}</td>
					<td>{{ $w_transaction['wallet_id'] }}</td>
					<td>{{ $w_transaction['username']  }}</td>
					<td>{{ strtoupper($w_transaction['payment_channel']) }}</td>
					<td>{{ $w_transaction['Acccount_holder_name'] }}</td>
					<td>{{ $w_transaction['Account_Number'] }}</td>
					<td>{{ $w_transaction['IFSC_CODE'] }}</td>
					<td>{{ $w_transaction['Bank_Name'] }}</td>
					<td>{{ $w_transaction['Branch_Name'] }}</td>
					<td>{{ $w_transaction['MIMD'] }}</td>  
				 <td class="r_amount"><i class="fa fa-inr"> {{ $w_transaction['reedem_amount'] }}</i>  </td>
				 <td>
				   <?php 
						$request_date=$w_transaction['request_date'];
						$value_split=explode(' ',$request_date);
						$newDate = date("d-m-Y", strtotime($value_split['0']));
						echo $newDate;
						//echo $value_split['0'];
				    ?>
				</td>
				 
			
				 
			<td>
			 <?php
				  if($user_role != "3")
					{
						if($status_approved == 'Approved') {
							$request_date=$w_transaction['updated_at'];
							$value_split=explode(' ',$request_date);
							$newDate = date("d-M-Y", strtotime($value_split['0']));
							echo "Completed on $newDate";
							
						} else {	
				  ?>
			
				  <button type="button" title="{{$status_approved}}" data-toggle="tooltip" data-placement="bottom" id="status_{{$w_transaction['wallet_redeem_id'] }}" data="{{$w_transaction['wallet_redeem_id'] }}" aria="{{$w_transaction['reedem_amount'] }}" data-id="{{$w_transaction['wallet_id']}}" class="status_checks btn btn_w {{$status_class}}"  >{{$status_approved}}</button>
				
						<?php }
					}
				else
				{
					echo "<font style=''>Permission Denied For User</font>";
				}
				?>
			</td>

                </tr>
				<?php } ?>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.js"></script>
<script>
 $(document).ready(function() {
	 $('#example1').DataTable( {
        dom: 'Bfrtip',
		 "bInfo" : false,
        buttons: [
			{
                extend: 'excelHtml5',
				 title: 'User Wallet Reedem Request',
                messageTop: 'Export user wallet redeem request sucessfully'
            },
            'csvHtml5',
            'pdfHtml5'
        ],
       initComplete: function() {
       	 var $buttons = $('.dt-buttons').hide();
         $('#exportLink').on('change', function() {
            var btnClass = $(this).find(":selected")[0].id 
               ? '.buttons-' + $(this).find(":selected")[0].id 
               : null;
            if (btnClass) $buttons.find(btnClass).click(); 
			$('#exportLink').prop('selectedIndex',0);
         })
       } 
    } );


$('.input-daterange input').each(function() {
  $(this).datepicker('clearDates');
});

$.fn.dataTable.ext.search.push(
  function(settings, data, dataIndex) {
   
				var date_min = $('#min-date').val();
				data_values_min = date_min.split("-");
				
				var dated_min=data_values_min[2]+'-'+data_values_min[1]+'-'+data_values_min[0];
				if(dated_min == 'undefined-undefined-') {
					var min="";
				}
				else {
					var min=data_values_min[2]+'-'+data_values_min[1]+'-'+data_values_min[0];
				}
				
				var date_max = $('#max-date').val();
				data_values_max = date_max.split("-");
				var max_values=data_values_max[2]+'-'+data_values_max[1]+'-'+data_values_max[0];
				if(max_values == 'undefined-undefined-') {
					var max="";
				}
				else {
					var max=data_values_max[2]+'-'+data_values_max[1]+'-'+data_values_max[0];
				}
					
				var date_format= data[10];
				data_values = date_format.split("-");
				var dates=data_values[2]+'-'+data_values[1]+'-'+data_values[0];
				var createdAt = dates || 0; 

				if (
				  (min == "" || max == "") ||
				  (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
				) {
				  return true;
				}
				return false;
			  }
		);

		$('.date-range-filter').change(function() {
		     $('#example1').DataTable().draw();
		});

		$('#my-table_filter').hide();
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
			url:"{{URL('wallet_redeem_single')}}",
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
		var ur = 'wallet_redeemedit/'+id;
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
			url:"{{url('wallet_redeemadd')}}",
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