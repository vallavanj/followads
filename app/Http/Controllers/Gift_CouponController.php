<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\User;
use App\Business_Address;
use App\Gift_Coupon;
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

class Gift_CouponController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
    public function index()
	{ 
		 $deatils = Gift_Coupon::query()
							->select('gift_coupon.*','bus.name','bus.business_id','bus.is_active as active')
							->join('business as bus','gift_coupon.business_id','=','bus.business_id')
							/* ->where('bus.is_active','=',1) */
							->orderBy('updated_at','desc')
							->get();
		$business = Business::query()
									->select('*')
									->get();
		$user = User::query()
							->select('*')
							->get();
			return view('adminpages.coupons.index',compact('deatils','business','user'));
	}
	public function coupons_create(Request $request)
	{
		if(!empty($request->input()))
		{
			$coupons = new Gift_Coupon;
			
			$coupons->code = $request->code;
			$coupons->value = $request->value;
			$coupons->generated_on = Carbon::now();
			$coupons->generated_by = Auth::user()->user_id;
			$coupons->activated_on = Carbon::now();
			$coupons->activated_by = Auth::user()->user_id;
			$coupons->business_id = $request->business_name;
			$coupons->max_redemption_count = $request->max_redemption_count;
			$coupons->is_active = 1;
			$coupons->created_by = Auth::user()->user_id;
			$coupons->created_at = Carbon::now();
			$coupons->updated_by = Auth::user()->user_id;
			$coupons->updated_at = Carbon::now();
			
			$coupons->save();
			
			$log = new Activity_log;
			$log->user_id = Auth::user()->user_id;
			$log->activity_code = $request->activity_Code;
			$log->detail = "Created Coupons";
			$log->is_active =1;
			$log->created_by = Auth::user()->user_id;
			$log->updated_by = Auth::user()->user_id;
			$log->created_at = Carbon::now();
			$log->updated_at = Carbon::now();
					
					$log->save();
			
			Session::flash('success',"Coupon Created successfully");
			return redirect('coupons');
		}
		$business = Business::query()
									->select('*')
									->where('is_active','=',1)
									->get();
		return view('adminpages.coupons.couponsadd',compact('business'));
	}
	public function coupons_edit($id)
	{
		$cid = decrypt($id);
		
		$coupons = Gift_Coupon::query()
								->select('*')
								->where('gift_coupon_id',$cid)
								->get();
								
		$business = Business::query()
									->select('*')
									->where('is_active','=',1)
									->get();
				/* print_r($coupons);exit; */
		return view('adminpages.coupons.couponsedit',compact('coupons','business'));
		
	}
	public function coupons_update(Request $request,$id)
	{
		$cid = decrypt($id);
		
		$coupons = Gift_Coupon::query()
								->where('gift_coupon_id',$cid)
								->update([
								'business_id' => $request->business_name,
								'max_redemption_count' => $request->max_redemption_count,
								'code' => $request->code,
								'value' => $request->value,
								'updated_at' => Carbon::now(),
								]);
								
								
			$log = new Activity_log;
			$log->user_id = Auth::user()->user_id;
			$log->activity_code = $request->activity_Code;
			$log->detail = "Created Coupons";
			$log->is_active =1;
			$log->created_by = Auth::user()->user_id;
			$log->updated_by = Auth::user()->user_id;
			$log->created_at = Carbon::now();
			$log->updated_at = Carbon::now();
					
					$log->save();
								
		Session::flash('success',"Coupon Updated successfully");
			return redirect('coupons');
	}
	public function coupons_delete($id)
	{
		$cid = decrypt($id);
		
		$coupons = Gift_Coupon::query()
								->where('gift_coupon_id',$cid)
								->delete();
				Session::flash('success',"Coupon Deleted successfully");
				return redirect('coupons');
	}
	public function coupons_single_view(Request $request)
	{
		/* echo "dfdafsda";exit; */
		$cid = $request->uid;
		// echo $cid;exit;
		$coupons = Gift_Coupon::query()
								->select('*')
								->where('gift_coupon_id',$cid)
								->get();
		$business = Business::query()
									->select('*')
									->get();
			$bus_name = "";
			foreach($business as $buss)
			{
				if($buss->business_id == $coupons[0]->business_id)
				{
					$bus_name = $buss->name;
				}
			}
								
			/* echo "<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$bus_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Code:</label>".$coupons[0]['code']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Value:</label>".$coupons[0]['value']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Generated On:</label>".$coupons[0]['generated_on']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Generated By:</label>".$coupons[0]['generated_by']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>	Activated On:</label>".$coupons[0]['activated_on']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Activated By:</label>".$coupons[0]['activated_by']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Max Redemption Count:</label>".$coupons[0]['max_redemption_count']."</div></div></div>"; */
			
			echo "<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Business Name:</label>".$bus_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Code:</label>".$coupons[0]['code']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Value:</label>".$coupons[0]['value']."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Max Redemption Count:</label>".$coupons[0]['max_redemption_count']."</div></div></div>";
	}
	public function coupons_single_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$coupons = Gift_Coupon::query()
							->where('gift_coupon_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
	
								
			$coupons_status = Gift_Coupon::query()
							->select('*')
							->where('gift_coupon_id',$id)
							->get();
				echo $coupons_status[0]->is_active;
	}
	
	public function coupon_code_unique(Request $request)
	{
		$code = $request->coupon_code;
		
		$coupons = Gift_Coupon::query()
									->select('*')
									->where('code',$code)
									->get();
			/* print_r($user);exit; */
		if($coupons->isNotEmpty())
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	public function coupon_code_unique1(Request $request)
	{
		$code = $request->coupon_code;
		$code_id = $request->coupon_id;
		
		/* echo $code.",".$code_id; */
		
		$coupons = Gift_Coupon::query()
									->select('*')
									->where('code',$code)
									->where('gift_coupon_id',$code_id)
									->get();
		if($coupons->isEmpty())
		{
			$coupons1 = Gift_Coupon::query()
									->select('*')
									->where('code',$code)
									->get();
			/* print_r($user);exit; */
			if($coupons1->isNotEmpty())
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
	
	}
	
}


