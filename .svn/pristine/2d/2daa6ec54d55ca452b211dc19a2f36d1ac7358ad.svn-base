<style>
.submenu_content{padding: 0 30px;}
</style>
<?php 
$currentroute_name = Route::getCurrentRoute()->getPath(); 
?>
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('dashboard')}}" class="brand-link">
      <img src="{{url('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Follow Ads</span>
	  
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
		<?PHP /* var_dump(Auth::check()); */?>
		@if(Auth::check())
          <!--<img src="{{url('profile/uploads/doc/'.Auth::user()->user_id.'/'.Auth::user()->profile_img_url)}}" class="img-circle elevation-2" alt="User Image">-->
	  <h4 style="color:#fcfdff" >{{Auth::user()->name}}</h4>
		  @endif
        </div>
        <div class="info">
          <a href="#" class="d-block" >Admin Panel</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item   change_<?php echo $currentroute_name; ?>">
            <a href="{{url('dashboard')}}" data-toggle="tooltip" data-placement="top"  title="Dashboard" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
                <!--<i class="right fa fa-angle-left"></i>-->
              </p>
            </a>
           <!--<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/')}}" class="nav-link active">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul> -->
          </li>
          <!---<li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>-->
		  <?php if ($currentroute_name=="promotion_section" || $currentroute_name=="promotion_section_ads" ) {	$promotion_parnet='menu-open';	} else {	$promotion_parnet='';	}?> 
		  
		    <li class="nav-item has-treeview <?php echo $promotion_parnet; ?>">
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Manage Promotion">
              <!--<i class="nav-icon fa fa-pie-chart"></i>-->
			  <!--<i class="fa fa-user-plus nav-icon"></i>-->
			  <i class="fa fa-tags" aria-hidden="true"></i>
              <p>
                 Promotions
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <!--User_Payment_Method-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('promotion_section')}}" class="nav-link <?php if ($currentroute_name=="promotion_section") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Promotion Section">
                  <!-- <i class="fa fa-circle-o nav-icon"></i> -->
					<p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Manage Promotion</p>
                </a>
              </li> 
             
            </ul>
			
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('promotion_section_ads')}}" class="nav-link <?php if ($currentroute_name=="promotion_section_ads") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Promotion Section Advertisement">
                  <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Promotion Section</p>
                </a>
              </li> 
             
            </ul>
          </li> 
		  
		  
		   <!--Ads-->
		  <li class="nav-item has-treeview <?php if ($currentroute_name=="ads_list") {echo "menu-open"; } else  { }?>">
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Manage Advertisement">
              <!--<i class="nav-icon fa fa-pie-chart"></i>-->
			  <!--<i class="fa fa-user-plus nav-icon"></i>-->
			  <i class="fa fa-bullhorn" aria-hidden="true"></i>
              <p>
                 Advertisement
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('ads_list')}}" class="nav-link <?php if ($currentroute_name=="ads_list") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Advertisement List">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Advertisement List</p>
                </a>
              </li> 
             
            </ul>
			<!--Advertisement Category-->
			<?php /* <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('ads_ctaeg')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Advertisement Category</p>
                </a>
              </li> 
             
            </ul> 
			<!--Advertisement_Business_Address-->
			 <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('ads_bus_addr')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Advertisement Business Address</p>
                </a>
              </li> 
             
            </ul>*/?>
			
			
			<!--Advertisement_Description-->
			<?php /* <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('adv_desc')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Advertisement Description</p>
                </a>
              </li> 
             
            </ul>
			<!--Advertisement Image-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('ads_image')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Advertisement Image</p>
                </a>
              </li> 
             
            </ul>
			
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('ads_search')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Advertisement Search Term</p>
                </a>
              </li> 
             
            </ul>
			
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('ads_offer')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Advertisement Offer Code</p>
                </a>
              </li> 
             
            </ul> */?>
			
          </li>
		  
		  <!--Business-->
		  <li class="nav-item has-treeview <?php if ($currentroute_name=="bussiness") {echo "menu-open"; } else  { }?>">
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="top"  title=" Manage Business">
              <!--<i class="nav-icon fa fa-pie-chart"></i>-->
			  <!--<i class="fa fa-user-plus nav-icon"></i>-->
			  <i class="fa fa-briefcase" aria-hidden="true"></i>
              <p>
                Businesses
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('bussiness')}}" class="nav-link <?php if ($currentroute_name=="bussiness") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Business List">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Businesses List</p>
                </a>
              </li> 
             
            </ul>
			<!--Business Address List-->
          <?php  /* <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('business_addr')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Business Address List</p>
                </a>
              </li> 
             
            </ul> */?>
			<!--Business Category List-->
			 <?php /*<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('buss_cat')}}" class="nav-link">
                  <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Business Category List</p>
                </a>
              </li> 
             
            </ul>
			<!--Business_Image-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('buss_image')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Business Images</p>
                </a>
              </li> 
             
            </ul>
			<!--Business Video-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('buss_video')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Business video</p>
                </a>
              </li> 
             
            </ul> */?>
          </li>  
		  
		  
		 <?php 	if ($currentroute_name=="coupons") {	$Coupons_parnet='menu-open';	} else {	$Coupons_parnet='';	}?> 
		   
		   <!--Coupons-->
		  <li class="nav-item has-treeview <?php echo $Coupons_parnet; ?>">
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Manage Gift Coupons">
              <!--<i class="nav-icon fa fa-pie-chart"></i>-->
			 <!-- <i class="fa fa-user-plus nav-icon"></i>--->
			 <i class="fa fa-gift" aria-hidden="true"></i>
              <p>
                Gift Coupons
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('coupons')}}" class="nav-link <?php if ($currentroute_name=="coupons") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Coupons List">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                 <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Coupons List</p>
                </a>
              </li> 
             
            </ul>
			<!--coupons code list-->
          </li>
		  <?php 	if ($currentroute_name=="wallet" || $currentroute_name=="wallet_redeem" || $currentroute_name=="user_red_adv_code" ) {	$Wallet_parnet='menu-open';	} else {	$Wallet_parnet='';	}?> 
		  
		    <!--Wallet-->
		   <li class="nav-item has-treeview <?php echo $Wallet_parnet; ?>">
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Manage Wallet">
              <!--<i class="nav-icon fa fa-pie-chart"></i>-->
			  <!--<i class="fa fa-user-plus nav-icon"></i>-->
			  <i class="fa fa-money" aria-hidden="true"></i>
              <p>
                 Wallet
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('wallet')}}" class="nav-link <?php if ($currentroute_name=="wallet") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Wallet List">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                   <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Wallet List</p>
                </a>
              </li> 
             
            </ul>
			<!--Wallet Transaction-->
			<!--<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('wallet_transaction')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  	<!--<p>Wallet Transaction</p>
                </a>
              </li> 
             
            </ul> -->
			<!--Wallet Redeem Request-->
			<ul class="nav nav-treeview">
              <li class="nav-item" class="nav-link " data-toggle="tooltip" data-placement="top"  title="Wallet Redeem Request">
                <a href="{{url('wallet_redeem')}}" class="nav-link <?php if ($currentroute_name=="wallet_redeem") {echo "active"; } else  { }?>">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Wallet Redeem Request</p>
                </a>
              </li> 
             
            </ul>
			
			<!--User_Redemmed_Advertisement_Code-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('user_red_adv_code')}}" class="nav-link <?php if ($currentroute_name=="user_red_adv_code") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Redemmed Advertisement Code">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Redeemed Advertisement Code</p>
                </a>
              </li> 
             
            </ul>
			
          </li>
		  
		  <?php 	if ($currentroute_name=="categories") {	$Categories_parnet='menu-open';	} else {	$Categories_parnet='';	}?> 
		  <!--Catagories-->
		 <li class="nav-item has-treeview <?php echo $Categories_parnet; ?>">
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Manage Categories">
              <!--<i class="nav-icon fa fa-pie-chart"></i>-->
			  <!--<i class="fa fa-user-plus nav-icon"></i>-->
			  <i class="fa fa-cubes" aria-hidden="true"></i>
              <p>
                Categories
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('categories')}}" class="nav-link <?php if ($currentroute_name=="categories") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Categories List">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                 <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Categories List</p>
                </a>
              </li> 
             
            </ul>
			
          </li>
		<?php 	if ($currentroute_name=="users_payment_method" || $currentroute_name=="u_pay_method_detail" || $currentroute_name=="language" || $currentroute_name=="static_pages" ) 
				{	$setting_parnet='menu-open';	} 
			else {	$setting_parnet='';	}?> 
		  
		    
		 <li class="nav-item has-treeview <?php echo $setting_parnet; ?>">
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Settings">
              <!--<i class="nav-icon fa fa-pie-chart"></i>-->
			  <!--<i class="fa fa-user-plus nav-icon"></i>-->
			  <i class="fa fa-cogs" aria-hidden="true"></i>
              <p>
                Settings
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <!--User_Payment_Method-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('users_payment_method')}}" class="nav-link <?php if ($currentroute_name=="users_payment_method") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Payment Method">
                  <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Payment Method</p>
                </a>
              </li> 
             
            </ul>
			
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('u_pay_method_detail')}}" class="nav-link <?php if ($currentroute_name=="u_pay_method_detail") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Payment Method">
                  <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Payment Method Details</p>
                </a>
              </li> 
             
            </ul>
			
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('language')}}" class="nav-link <?php if ($currentroute_name=="language") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Language List">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Language List</p>
                </a>
              </li> 
             
            </ul>
			
			 <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('static_pages')}}" class="nav-link <?php if ($currentroute_name=="static_pages") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title="Static Pages List">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Static Pages List</p>
                </a>
              </li> 
             
            </ul>
			
          </li> 

		  
		  
		  
		   <!--Static pages-->
		<!-- <li class=" nav-item has-treeview">
            <a href="#" class="nav-link" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Manage Static Pages">
			  <i class="fa fa-columns" aria-hidden="true"></i>
              <p>
                 Static Pages
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('static_pages')}}" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Static Pages List">
                  <p><i class="fa fa-angle-double-right" aria-hidden="true"></i> Static Pages List</p>
                </a>
              </li> 
             
            </ul>
          </li>-->
		   <!--Langauge-->
		  <!--<li class="nav-item has-treeview">
            <a href="#" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Manage Language"
			  <i class="fa fa-language" aria-hidden="true"></i>
              <p>
                 Language
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('language')}}" class="nav-link" data-toggle="tooltip" data-placement="top"  title="Language List">
                  <p><i class="fa fa-angle-double-right" aria-hidden="true"></i> Language List</p>
                </a>
              </li> 
             
            </ul>
          </li>-->
		
		<?php 	if ($currentroute_name=="user" || $currentroute_name=="users_busi_rate" || $currentroute_name=="users_feedback") 
				{	$user_parnet='menu-open';	} 
			else {	$user_parnet='';	}?>


		
          <li class="nav-item has-treeview <?php echo $user_parnet; ?>">
            <a href="{{url('user')}}" class="nav-link" title="Manage User" data-toggle="tooltip" data-placement="top">
              <!--<i class="nav-icon fa fa-pie-chart"></i>-->
			  <!--<i class="fa fa-user-plus nav-icon"></i>-->
			  <i class="fa fa-users" aria-hidden="true"></i>
              <p>
                Manage User
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('user')}}" title=" Users List" id="parnet_<?php echo $currentroute_name; ?>" class="nav-link  <?php if ($currentroute_name=="user") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top">
					<p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Users List</p>
                </a>
              </li> 
             
            </ul>
			
			<!--User Business Rating-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('users_busi_rate')}}" id="parnet_<?php echo $currentroute_name; ?>" class="nav-link <?php if ($currentroute_name=="users_busi_rate") {echo "active"; } else  { }?>" data-toggle="tooltip" data-placement="top"  title=" Business Rating" >
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i>  Business Rating</p>
                </a>
              </li> 
             
            </ul>
			<!--User_Payment_Method-->
			<?php
			/*  <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('users_payment_method')}}" class="nav-link">
                  <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Payment Method</p>
                </a>
              </li> 
             
            </ul>
			<!--User_Payment_Method_Details-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('u_pay_method_detail')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Payment Method Details</p>
                </a>
              </li> 
             
            </ul> */
			?>
			<!--User_Saved_Advertisement-->
			<?php
			/* <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('user_saved_adv')}}" class="nav-link">
                   <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Saved Advertisement</p>
                </a>
              </li>  
			  </ul>*/
			  ?>
             
            
			<!--User_Followed_Business-->
			<?php
			/*<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('user_follow_business')}}" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p>Followed Business</p>
                </a>
              </li> 
			   </ul>*/
			  ?>
             
           
			
			<!--Users feedback-->
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('users_feedback')}}" id="parnet_<?php echo $currentroute_name; ?>" class="nav-link <?php if ($currentroute_name=="users_feedback") {echo "active"; } else  { }?> sub_menu_link" data-toggle="tooltip" data-placement="top"  title="Feedback" >
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                  <p class="submenu_content"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Feedback</p>
                </a>
              </li> 
             
            </ul>
          </li>
		
		  
		 
		 
		 
		 
		 
		 
		 
		 
		
		
		 
		  
		  
		
		
		  <script>
		   $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


document.addEventListener('DOMContentLoaded', function() {
	//console.log($('.nav-link').parents('li.nav-item').addClass('parent'));​
   
}, false);

		  </script>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>