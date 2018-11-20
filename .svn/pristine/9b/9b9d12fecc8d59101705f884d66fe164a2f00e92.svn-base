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
            <h1>Manage User Payment Method Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage User Payment Method Detail</li>
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
					url       : "{{URL('u_pay_method_detailactive')}} ",   
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

          <div class="">
            <div class="">
              <!--<h3 class="card-title">Data Table With Full Features</h3>-->
			 <!-- <a href="#" onclick="call_add_page()" style="font-color:#000000 !important; text-decoration:none;"><button class="btn btn-success" >Add User Payment Method Detail</button></a>-->
            </div>
            <!-- /.card-header -->
			<?PHP 
			/* print_r($deatils);exit; */
			/* $pay_id = array_column($u_pay_method,'user_payment_method_id'); */
			?>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				
                <tr>
				  <th>#</th>
				  <th>User Name</th>
                  <th>User Payment Method</th>
                  <th>Detail Key</th>
                  <th>Detail Value</th>
                  <!---<th style="min-width: 145px;">Action</th>-->
                </tr>
                </thead>
                <tbody>
				
				<?PHP 
				/* echo "<pre>"; */
					/* print_r($u_pay_method_detail);exit; */
					if(!empty($u_pay_method_detail)) {
						$i =1 ;
						$checkid[]	=	"";
						// $detail_key	=	"";
						foreach($u_pay_method_detail as $v)
						{
							/* $test[$i]['detail_key'] =  $v->detail_key;
							$test[$i]['detail_value'] =  $v->detail_value;
							$test[$i]['channel_code'] =  $v->channel_code; */
							$test[$i]['user_payment_method_id'] =  $v->user_payment_method_id;
							$testall[$v->user_payment_method_id]['username'][]	=	$v->name;
							$testall[$v->user_payment_method_id]['channel_code'][]	=	$v->channel_code;
							$testall[$v->user_payment_method_id]['detail_key'][]	=	$v->detail_key;
							$testall[$v->user_payment_method_id]['detail_value'][]	=	$v->detail_value;
							
						}
					}
					/* print_r($test); */
					// print_r($testall);
					// exit;
					
					if(!empty($testall)) {
						foreach($testall as $key=>$d)
						{
						/* 	echo '<pre>';
							print_r($d); */
							
						
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php  echo implode(',',array_unique($d['username']));?></td>
								<td><?php  echo strtoupper(implode(',',array_unique(($d['channel_code']))));?></td>
								<td><?php  echo implode(',',array_unique($d['detail_key']));?></td>
								<td><?php	echo implode(',',array_unique($d['detail_value'])); ?></td>
							</tr>
							
					<?php $i++; }  } ?>
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
            <div class="modal-content" style="width: 943px";>
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
		
		/* columnDefs: [ {targets: [3], "orderable": false } ] */
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
			url:"{{URL('u_pay_method_detailsingle')}}",
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
		var ur = 'u_pay_method_detailedit/'+id;
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
			url:"{{url('u_pay_method_detailadd')}}",
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