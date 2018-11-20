<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\Business_Address;
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

class Business_AddressController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
    public function index($id)
	{
		$id = decrypt($id);
		$buss_addr = Business_Address::query()
											->select('*')
											->where('business_id',$id)
											->get();
		$business = Business::query()
									->select('*')
									->where('business_id',$id)
									->get();
						return view('adminpages.business_address.index',compact('buss_addr','business','id'));
	}
	public function business_addr_create(Request $request,$id)
	{
		/* echo $id;exit; */
		if(!empty($request->input()))
		{
			$rules = [
			'business_name' => 'required',
			'address' => 'required',
			'area' => 'required',
			'city' => 'required',
			'state' => 'required',
		/* 	'location' => 'required', */
			'map_url' => 'required',
			];
			$attributeNames = array(
					'business_name' => 'Name',
					'address' => 'Address',
					'area' => 'Area',
					'city' => 'City',
					'state' => 'State',
					/* 'location' => 'Location', */
					'map_url' => 'Map Url',
					
						);
					$validate = Validator::make($request->all(),$rules);
					$validate->setAttributeNames($attributeNames);
					if($validate->fails())
					{
						return redirect()->back()->withInput()->withErrors($validate);
						/* return view('form')->back->withErrors($rules); */
					}
					else
					{
						
					 $location = array(
						'lat'=>$request->lat,
						'lan'=>$request->longt,
						);
						echo $location1 = json_encode($location);
						/* 
						exit; */
						
						$buss_addr = new Business_Address;
						$buss_addr->business_id = $request->business_name;
						$buss_addr->address = $request->address;
						$buss_addr->area = $request->area;
						$buss_addr->city = $request->city;
						$buss_addr->state = $request->state;
						$buss_addr->location = $location1;
						$buss_addr->latitude = $request->lat;
						$buss_addr->longitude = $request->longt;
						$buss_addr->phone_number = $request->phone_number;
						$buss_addr->map_url = $request->map_url;
						$buss_addr->is_active = 1;
						$buss_addr->created_by = Auth::user()->user_id;
						$buss_addr->created_at = Carbon::now();
						$buss_addr->updated_by = Auth::user()->user_id;
						$buss_addr->updated_at = Carbon::now();
						$buss_addr->save();
						
					$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Create Business Address";
					$log->is_active =1;
					$log->created_by = Auth::user()->user_id;
					$log->updated_by = Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
						
						Session::flash('success',"Address Created successfully");
						return redirect('bussiness');
					}
		}
		$business = Business::query()
									->select('*')
									->where('business_id',$id)
									->get();
		return view('adminpages.business_address.bussiness_addradd',compact('business'));
	}
	public function business_addr_view($id)
	{
		$id = decrypt($id);
		/* echo $id;exit; */
		$buss_addr = Business_Address::query()
											->select('*')
											->where('business_address_id',$id)
											->get();
						$business = Business::query()
									->select('*')
									->where('business_id',$buss_addr[0]->business_id)
									->get();
						return view('adminpages.business_address.business_addredit',compact('buss_addr','business'));
	}
	public function business_addr_update(Request $request,$id)
	{
		$id = decrypt($id);
		 $location = array(
						'lat'=>$request->lat,
						'lan'=>$request->longt,
						);
						echo $location1 = json_encode($location);
						$buss_addr = Business_Address::query()
													->where('business_address_id',$id)
													->update([
													'business_id' => $request->business_name,
													'address' => $request->address,
													'area' => $request->area,
													'city' => $request->city,
													'state' => $request->state,
													'location' => $location1 ,
													'latitude' => $request->lat,
													'longitude' => $request->longt,
													'phone_number' => $request->phone_number,
													'map_url' => $request->map_url,
													'is_active' => 1,
													'updated_at' => Carbon::now()
													]);
						$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Updated Business Address";
					$log->is_active =1;
					$log->created_by = Auth::user()->user_id;
					$log->updated_by = Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
													
							Session::flash('success',"Address Updated successfully");
						return redirect('bussiness');
				
	}
	public function business_addr_delete(Request $request,$id)
	{
		$id = decrypt($id);
		$buss_addr = Business_Address::query()
									->where('business_address_id',$id)
									->delete();
									
					
									
					Session::flash('success',"Address Deleted successfully");
						return redirect('bussiness');
	}
	public function business_single_view(Request $request)
	{
		$id = $request->uid;
		/* echo $id;exit; */
		$business = Business_Address::query()
								->select('*')
								->where('business_address_id',$id)
								->get();
				$buss = Business::query()
									->select('*')
									
									->get();
			 $location = json_decode($business[0]->location,true);
				$bus_name = "";
				foreach($buss as $row)
				{
					if($row->business_id == $business[0]['business_id'])
					{
						$bus_name = $row->name;
					}
				}
				/* echo $bus_name;exit */;
				echo "<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$bus_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>address:</label>".$business[0]['address']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Area:</label>".$business[0]['area']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>City:</label>".$business[0]['city']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>State:</label>".$business[0]['state']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Location:</label>Latitude:". $location['lat']." , Longitude:". $location['lan']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Phone Number:</label>".$business[0]['phone_number']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Map Url:</label>".$business[0]['map_url']."</div></div></div>";
				
			
	}
	public function business_single_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$business = Business_Address::query()
							->where('business_address_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
								
			$business_status = Business_Address::query()
							->select('*')
							->where('business_address_id',$id)
							->get();
				echo $business_status[0]->is_active;
	}
	
}
