<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\Business_Address;
use App\Business_Category;
use App\Categories;
use App\Advertisment;
use App\Advertisment_Category;
use App\Advertisement_business_address;
use App\Advertisement_Description;
use App\Activity_log;
use Session;
use Image;
use Hash;
use Validator;
use DB;
use App\Attempt;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Advertisement_business_addressController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
   public function index($id,$bid)
   {
	   $id=decrypt($id);
		$bid = decrypt($bid);
	  $ads_bus_addr =  Advertisement_business_address::query()
														->select('advertisement_business_address.*','advertisement_description.description','busi_add.address')
														->join('advertisement_description', 'advertisement_business_address.advertisement_id','=','advertisement_description.advertisement_id','Left')
														->join('business_address as busi_add','advertisement_business_address.business_address_id','=','busi_add.business_address_id','Left')
														->where('advertisement_business_address.advertisement_id',$id)
														->groupBy('busi_add.business_address_id')
														->get();
		$bus_addr = Business_Address::query()
											->select('*')
											->get();
											
											
		$business = Business::query()
									->select('*')
									->where('business_id',$bid)
									->get();
		/* $ads  =  Advertisment::query()
								->select('advertisement.*','advertisement_description.description')
								->join('advertisement_description', 'advertisement.advertisement_id','=','advertisement_description.advertisement_id','Left')
								->join('business_address as busi_add','advertisement.advertisement_id','=','busi_add.advertisement_id')
								->get(); */
			return view('adminpages.ads_bus_addr.index',compact('ads_bus_addr','bus_addr','ads','id','business'));
		
   }
   public function ads_bus_addr_create(Request $request,$id,$bid)
   {
	   $id = decrypt($id);
	   $bid = decrypt($bid);
	 /*   echo $bid;exit; */
	   if(!empty($request->input()))
	   {
		   
					   $ads_bus_addr =  new Advertisement_business_address;
					   $ads_bus_addr->advertisement_id = $request->ads_name;
					   $ads_bus_addr->business_address_id = $request->business_address;
					   $ads_bus_addr->is_active = 1;
					   $ads_bus_addr->created_by = 1;
					   $ads_bus_addr->created_at = Carbon::now();
					   $ads_bus_addr->updated_by = 1;
					   $ads_bus_addr->updated_at = Carbon::now();
					   $ads_bus_addr->save();
					   
					  
					   
					  Session::flash('success',"Advertisment Business Address  Created successfully");
								return redirect('ads_list');
	   }
	   $bus_addr = Business_Address::query()
											->select('business_address.*','bus.name')
											->join('business as bus','business_address.business_id','=','bus.business_id','Left')
											->where('business_address.business_id',$bid)
											->get();
		$ads  =  Advertisment::query()
								->select('advertisement.*','advertisement_description.description')
								->join('advertisement_description', 'advertisement.advertisement_id','=','advertisement_description.advertisement_id','Left')
								->where('advertisement.advertisement_id','=',$id)
								->get();
		if($bus_addr->isNotEmpty())
		{
			/* echo "fsdgsf"; */
	   return view('adminpages.ads_bus_addr.ads_bus_addradd',compact('bus_addr','ads'));
		}
		else
		{
			echo "<div class='text-center alert alert-warning'><b>Business Address Not Available</b></div>";
		}
   }
   public function ads_bus_addr_view($id,$bus_id)
   {
	   $id = decrypt($id); 
	   $bid = decrypt($bus_id);
	    $ads_bus_addr =  Advertisement_business_address::query()
														->select('advertisement.*','advertisement_business_address.*','advertisement_description.description')
														->join('advertisement_description', 'advertisement_business_address.advertisement_id','=','advertisement_description.advertisement_id','Left')
														->join('advertisement', 'advertisement_business_address.advertisement_id','=','advertisement.advertisement_id','Left')
														->where('advertisement_business_address.advertisement_business_address_id',$id)
														->get();
														
		/* $adv_desc = Advertisement_Description::query()
												->select('*')
												->get(); */
														
		/* $bus_addr = Business_Address::query()
											->select('*')
											->get(); */
		$bus_addr = Business_Address::query()
											->select('business_address.*','bus.name')
											->join('business as bus','business_address.business_id','=','bus.business_id','Left')
											->where('business_address.business_id',$bid)
											->get();
											
		$ads  =  Advertisment::query()
								->select('*')
								->get();
		 return view('adminpages.ads_bus_addr.ads_bus_addredit',compact('bus_addr','ads','ads_bus_addr','adv_desc'));
   }
   public function ads_bus_addr_update(Request $request,$id)
   {
	    $id = decrypt($id); 
	   $ads_bus_addr =  Advertisement_business_address::query()
														->where('advertisement_business_address_id',$id)
														->update([
														'advertisement_id' => $request->ads_name,
														'business_address_id' => $request->business_address,
														'updated_at' => Carbon::now()
														]);
														
						
										
				 Session::flash('success',"Advertisment Business Address  Updated successfully");
								return redirect('ads_list');
   }
   public function ads_bus_addr_delete(Request $request,$id)
   {
	    $id = decrypt($id); 
		 $ads_bus_addr =  Advertisement_business_address::query()
														->where('advertisement_business_address_id',$id)
														->delete();
														
			
														
				 Session::flash('success',"Advertisment Business Address  Deleted successfully");
								return redirect('ads_list');
   }
   public function ads_bus_addr_single(Request $request)
   {
	   $id = $request->uid;
	   $ads_bus_addr =  Advertisement_business_address::query()
														->select('*')
														->where('advertisement_business_address_id',$id)
														->get();
		$bus_addr = Business_Address::query()
											->select('*')
											->get();
											
		$adv_desc = Advertisement_Description::query()
													->select('*')
													->get();
		$description = "";
		foreach($adv_desc as $desc)
		{
			if($desc->advertisement_id == $ads_bus_addr[0]->advertisement_id)
			{
					$description = $desc->description;
			}
		}
		
			$buss_addr_name = "";					
		foreach($bus_addr as $bus_add)
		{
			if($bus_add->business_address_id == $ads_bus_addr[0]->business_address_id)
			{
				$buss_addr_name = $bus_add->address;
			}
		}
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Advertisment Description:</label>".$description."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Business Address:</label>".$buss_addr_name."</div></div></div>";
   }
   public function ads_bus_addr_activestatus(Request $request)
   {
	  $id = $request->id; 
	  $status = $request->status;
	  /* echo $status;exit; */
	  $ads_bus_addr =  Advertisement_business_address::query()
														->where('advertisement_business_address_id',$id)
														->update([
														'is_active'=>$status,
														'updated_at' => Carbon::now()
														]);
														
	
														
	  $ads_bus_addr_1 =  Advertisement_business_address::query()
														->select('*')
														->where('advertisement_business_address_id',$id)
														->get();
			echo  $ads_bus_addr_1[0]->is_active;
   }
   
   public function ads_address_check(Request $request){
	    
		 $ads_id = $request->ads_id;
		 $address_id = $request->address_id;
		/*  echo $address_id.",".$ads_id; */
		$ads_bus_addr =  Advertisement_business_address::query()
														->where('advertisement_id',$ads_id)
														->where('business_address_id',$address_id)
														->count();
		if(!empty($ads_bus_addr))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
   }
   
   public function ads_address_check2(Request $request){
	    
		 $ads_id = $request->ads_id;
		 $address_id = $request->address_id;
		 $ads_bus_id = $request->ads_bus_id;
		/*  echo $address_id.",".$ads_id; */
		$ads_bus_addr =  Advertisement_business_address::query()
														->where('advertisement_id',$ads_id)
														->where('advertisement_business_address_id',$ads_bus_id)
														->where('business_address_id',$address_id)
														->count();
		if(empty($ads_bus_addr))
		{
			$ads_bus_addr2 =  Advertisement_business_address::query()
														->where('advertisement_id',$ads_id)
														->where('business_address_id',$address_id)
														->count();
			if(!empty($ads_bus_addr2))
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "0";
		}
   }
}
