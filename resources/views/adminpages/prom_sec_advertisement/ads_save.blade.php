<?php 
use App\Http\Controllers\Promotion_Section_AdvertisementController;
?>

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
<style>
.busi_name_promo,.ads_name_promo{
	display: block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

</style>
<section class="content">
	<div class="container-fluid">
	<?php $user_role = Session::get('user_role');
	if($user_role == "3")
				{
				
		echo'<div class="user_pre" style="pointer-events: none;">';
		?>
	
				@if(Session::has('error'))
						<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a>
							{{ Session::get('error') }}
						</div>
				@elseif(Session::has( 'success' ))
						<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>
							{{ Session::get('success') }}
						</div>
				@endif
			<div class="row justify-content-md-center">
			  <!-- left column -->
			 <div class="col-md-6" >
            <!-- general form elements -->
           
                <!--<div class="card-header">
              <h3 class="card-title">Add User</h3>
              </div>-->
              <!-- /.card-header -->
              <!-- form start -->
			  			  <?php  /*echo "<pre>"; */

							 //print_r($pro_sec_ads); 
							 
			  ?>
		@foreach($proms as $key=>$promotion) 
			<div><label>{{$promotion['name']}}</label></div>
				<div id="sortableX" class="pro_{{$promotion['promotion_section_id']}} row mb-5">
				
			<?php 
			
			$i=1;
			  foreach($pro_sec_ads[$promotion['promotion_section_id']] as $pro_sec)
				{
					/* print_r($pro_sec); */
					if($pro_sec['advertisement_id'] == "")
					{
						echo "<div class='col-md-4'><div class='inner_sortable back_img_$pro_sec[promotion_section_id]'  data='$i' aria='$pro_sec[sec_adv_id]' style='' id='back_img_$pro_sec[promotion_section_id]'> </div></div>";
					}
					else
					{
						
					/* $after_get_advertisment = Promotion_Section_Advertisement::get_adv_after_promotion($pro_sec['sec_adv_id'],$pro_sec['advertisement_id']);  */
					/* echo Promotion_Section_Advertisement::get_adv_after_promotion($params); */
					/* $varbl = App::make("Promotion_Section_AdvertisementController")->get_adv_after_promotion($pro_sec['sec_adv_id'],$pro_sec['advertisement_id']); */
					
				
				        $adv_pro = Promotion_Section_AdvertisementController::get_adv_after_promotion($pro_sec['sec_adv_id'],$pro_sec['advertisement_id']);
						if($adv_pro->isNotEmpty())
						{
						$name = $adv_pro[0]->business_name;
						$adv = $adv_pro[0]->name;
						$pro_mo_id = $adv_pro[0]->promotion_section_id;
						$pro_id = $adv_pro[0]->promotion_section_advertisement_id;
						$url_img = 'ads1/uploads/doc/'.$adv_pro[0]->advertisement_id.'/'.$adv_pro[0]->icon_image_url;
						echo "<div class='col-md-4'><div class='inner_sortable back_img_$pro_sec[promotion_section_id]'  data='$pro_sec[sec_adv_id]' aria='$pro_sec[promotion_section_id]' id='back_img_$pro_sec[promotion_section_id]' style='background-image:url($url_img)'><div class='text-center badge badge-light img-label'>Business Name:<span class='busi_name_promo' alt='$name'>$name</span><br>Ad Name: <span class='ads_name_promo' alt='$adv'>$adv</span></div> </div><button class='btn btn-default btn-sm btn-block' onclick=remove_ads($pro_id)>&times; Remove</button></div>";
						}
											 
					}
				
				?>
		
			
			
			
			<?php	$i++;} ?>
			</div>
			
		@endforeach

			
<?php
echo '</div>'; 
				}
				else
				{
					?>
					@if(Session::has('error'))
						<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a>
							{{ Session::get('error') }}
						</div>
				@elseif(Session::has( 'success' ))
						<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>
							{{ Session::get('success') }}
						</div>
				@endif
			<div class="row justify-content-md-center">
			  <!-- left column -->
			 <div class="col-md-6" >
            <!-- general form elements -->
           
                <!--<div class="card-header">
              <h3 class="card-title">Add User</h3>
              </div>-->
              <!-- /.card-header -->
              <!-- form start -->
			  			  <?php  /*echo "<pre>"; */

							 //print_r($pro_sec_ads); 
							 
			  ?>
		@foreach($proms as $key=>$promotion) 
			<div><label>{{$promotion['name']}}</label></div>
				<div id="sortableX" class="pro_{{$promotion['promotion_section_id']}} row mb-5">
				
			<?php 
			
			$i=1;
			  foreach($pro_sec_ads[$promotion['promotion_section_id']] as $pro_sec)
				{
					if($pro_sec['seq'] == '0')
					{
						echo "<div class='col-md-4'><div class='inner_sortable back_img_$pro_sec[promotion_section_id]'  data='$i' aria='$pro_sec[sec_adv_id]'  id='back_img_$pro_sec[promotion_section_id]'> </div></div>";
					}
					else
					{
						
					
				        $adv_pro = Promotion_Section_AdvertisementController::get_adv_after_promotion($pro_sec['sec_adv_id'],$pro_sec['advertisement_id']);
						
						if($adv_pro->isNotEmpty())
						{
							//echo $i;
							 //print_r($adv_pro); 
						$sequence_no = $adv_pro[0]->sequence_no;
						$name = $adv_pro[0]->business_name;
						$adv = $adv_pro[0]->name;
						$pro_mo_id = $adv_pro[0]->promotion_section_id;
						$pro_id = $adv_pro[0]->promotion_section_advertisement_id;
						$url_img = 'ads1/uploads/doc/'.$adv_pro[0]->advertisement_id.'/'.$adv_pro[0]->icon_image_url;
						//echo $sequence_no;
						
						  echo "<div class='col-md-4'><div class='inner_sortable back_img_$pro_sec[promotion_section_id]'  data='$pro_sec[sec_adv_id]' aria='$pro_sec[promotion_section_id]' id='back_img_$pro_sec[promotion_section_id]' style='background-image:url($url_img)'><div class='text-left badge badge-light img-label'>Business Name:<br> <span  class='busi_name_promo' alt='$name'>$name</span><br>Ad Name:<br><span class='ads_name_promo' alt='$adv'>$adv</span></div> </div><button class='btn btn-default btn-sm btn-block' onclick=remove_ads($pro_id)>&times; Remove</button></div>";
						
						}
											 
					}
				
				?>
		
			
			
			
			<?php	$i++;} ?>
			</div>
			
		@endforeach
		<?php } ?>
	
			  
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
$('.alert').delay(2000).fadeOut();
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
		var div_id=$(this).attr('id');
		var  promotion_id= div_id.match(/\d+/); 
		

		$.ajax({
			type:"GET",
			url:"{{URL('prom_ads_add')}}",
			data:{
				seq:seq,
				pro_id:pro_id,
				promotion_id:promotion_id,
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
	function remove_ads(pro_id)
	{
		//alert()
		$.ajax({
			type:"POST",
			url:"{{URL('prom_ads_delete')}}",
			data:{
				/* seq:seq, */
				pro_id:pro_id,
				_token: '{{ csrf_token() }}'
			},success:function(response)
			
			{
				/* alert(response); */
				if(response == 1)
				{
					 location.reload();
				}
				/* $("#page_details").html(response); */
			}
			
	});
	}
	</script> 
	
    </section>
</div>
@include('adminpages.adminfooter')
@stop
