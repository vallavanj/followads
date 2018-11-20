<style>
.select2-selection__choice__remove {
	color:#fff !important;	
}
.select2-selection__choice {
	background-color: #007bff !important;
    border-color: #006fe6 !important;
    padding: 1px 10px !important;
    color: #fff !important;
}
.select2-search__field {
	width:320px !important;
}

</style>


<section class="content">
	<div class="container-fluid">
			<div class="row">
				<div class="col-12">
			  <!-- left column -->
            <!-- general form elements -->
			
				<table id="advertisement_list" class="table table-bordered">
					<thead>
					  <tr >
					  <?php  foreach($business_name  as $value) { ?>
						<th colspan="5">Advertisment for {{ $value->name }}</th>
					  <?php } ?>
					  </tr>
					  <tr >
						<th >SNO</th>
						 <th >Advertisment Name</th>
						  <th >Icon</th>
						  <th >Valid From</th>
						  <th >Valid To</th>
					  </tr>
					</thead>
					<tbody>
					<?php //print_r($ads_view_business);
					 $i=1;
					  foreach($ads_view_business as $values) {
					?>
					  <tr>
						<td>{{$i}}</td>
						<td>{{ $values->name }}</td>
						<td>
						<?php 
						 $path='ads1/uploads/doc/'.$values->advertisement_id.'/'.$values->icon_image_url;
						if(!($values->icon_image_url)) 
						{
						$icon_url = 'No image available';
						}
						else
						{
							if(file_exists($path))
							{
								$icon = url($path);
								$icon_url = "<img src=".$icon." width='50px' height='50px' class='img-circle'>";
							}
							else
							{
								$icon_url = 'No image available';
							}
						}
						echo 	$icon_url;
						?>
						<!--<img src="{{url('ads1/uploads/doc/'.$values->advertisement_id.'/'.$values->icon_image_url)}}" width="50px" height="50px" class="img-circle"></td>-->
						<td>
						
						 <?php 
						$value_split=explode(' ',$values->valid_from);
						$newDate = date("d-m-Y", strtotime($value_split['0']));
						echo $newDate;?>
						
						
						</td>
						<td>
						 <?php $value_split=explode(' ',$values->valid_to);
						$newDate_to = date("d-m-Y", strtotime($value_split['0']));
						echo $newDate_to;  ?>
						
						
						</td>
					  </tr>
					 
					  <?php $i++; } ?>
					</tbody>
				  </table>
           

		</div>
	</div>
	
	
	</div>
	
	<script>
	  $(function () {
    $("#advertisement_list").DataTable({
		'paging'      : true,
		 "pageLength": 10,
		'lengthChange': false,
		'searching'   : true,
		'ordering'    : true,
		'info'        : false,
		'autoWidth'   : false,
		
		/* columnDefs: [ {targets: [8,9], "orderable": false } ] */
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
	</script>


	
