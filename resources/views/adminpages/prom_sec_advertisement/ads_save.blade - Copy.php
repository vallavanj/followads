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
            <h1 class="">Add Promotion Section</h1>
          </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li><i class="nav-icon fa fa-dashboard"></i></li>
			  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              
              <li class="breadcrumb-item active">Add Promotion Section</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
	<div class="container-fluid">
			<div class="row justify-content-md-center">
			  <!-- left column -->
			 <div class="col-md-6" >
            <!-- general form elements -->
           
                <!--<div class="card-header">
              <h3 class="card-title">Add User</h3>
              </div>-->
              <!-- /.card-header -->
              <!-- form start -->
			  			  <?php echo "<pre>";

							/* print_r($pro_sec_ads); */
			  ?>
		@foreach($proms as $key=>$promotion) 
			<div><label>{{$promotion['name']}}</label></div>
			<?php 
			
			  foreach($pro_sec_ads[$promotion['promotion_section_id']] as $pro_sec)
				{
					print_r($pro_sec);
					if($pro_sec['advertisement_id'] == "")
					{
						print_r($pro_sec);
					}
				
				?>
		
			
<div> </div>
			
			<?php	} ?>
		@endforeach

			

		<!--<div id = "sortable" class="connectedSortable">
		<div class="context__item" id='item1'><i class="fa fa-arrows-h"></i><span>1</span><br>Hello,This is first Ad</div>
		<div class="context__item" id='item2'><i class="fa fa-arrows-h"></i>
		<span>2</span><br>
		Hello,This is second Ad
		<br>
		Select:
		<select id = "dropdown-item2">
		<option value="volvo">Volvo</option>
		<option value="saab">Saab</option>
		</select> 
		</div>
		<div class="context__item" id='item3'><i class="fa fa-arrows-h"></i><span>3</span><br>
		Hello,This is third Ad
		<br>
		Select:
		<select id = "dropdown-item3">
		<option value="bike">bike</option>
		<option value="auto">auto</option>
		</select> 
		</div>
		<div class="context__item" id='item4'><i class="fa fa-arrows-h"></i><span>4</span><br>Hello,This is fourth Ad</div>
	</div>-->
			  
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
	</div>
	</div>
	<script>

$(function () {
  $('#demo-form').parsley() 
  });

	</script>
	
	<script>
$(function() {
        $( "#sortable" ).sortable({ 
            connectWith: ".connectedSortable",
              update: function () {
			         var order1 = $('#sortable').sortable('toArray').toString();
					 var trainindIdArray = order1.split(',');
					 var dropdown_value = new Array();
					 $.each(trainindIdArray, function(index, value) { 
                           $option = $('#'+value +'  #dropdown-'+value).val(); 
						   
						   if($option){
						   dropdown_value.push(value + " : " + $option);
						   //$dropdown_value =  value + " : " + $option;
                           //alert($dropdown_value);
                          }						   
                      });
					  alert(order1 +' - '+ dropdown_value);
					  //alert(order1 + ' - ' + $dropdown_value);
					// $option = $('#item2 #dropdown').val();
					 //alert($option);
                     }			 
        });
    });
	
	$('.inner_sortable').click(function(){
		var seq = $(this).attr('data');
		var pro_id = $(this).attr('aria'); 
		/* alert(seq+','+pro_id); */
		

		$.ajax({
			type:"GET",
			url:"{{URL('prom_ads_add')}}",
			data:{
				seq:seq,
				pro_id:pro_id,
				_token: '{{ csrf_token() }}'
			},success:function(response)
			
			{
				/* alert(response); */
				$("#page_details").html(response);
			}
			
		});
		$('#modal-default_1').modal('show');
	
	});
	
</script>
<script>
	function remove_ads(pro_id,seq)
	{
		$.ajax({
			type:"POST",
			url:"{{URL('prom_ads_delete')}}",
			data:{
				seq:seq,
				pro_id:pro_id,
				_token: '{{ csrf_token() }}'
			},success:function(response)
			
			{
				alert(response);
				/* $("#page_details").html(response); */
			}
			
	});
	}
	</script> 
	
    </section>
</div>
@include('adminpages.adminfooter')
@stop
