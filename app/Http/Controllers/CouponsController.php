<?php

namespace App\Http\Controllers;
use App\Coupons;
use Carbon\Carbon;
use Session;
use Image;
use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class CouponsController extends Controller
{
    public function index()
	{
		 $coupons = Coupons::query()
							->select('*')
							->get();
							
			return view('adminpages.coupons.index')->with('deatils',$coupons);
	}
	public function coupons_create(Request $request)
	{
		if(!empty($request->input()))
		{
			$coupons = new Coupons;
			
			$coupons->store_id = 1;
			$coupons->coupons_name = $request->name;
			$coupons->coupons_description = $request->description;
			$coupons->offers_caption = $request->offers_caption;
			$coupons->valid_from = $request->valid_from;
			$coupons->valid_to = $request->valid_to;
			$coupons->language_id = 1;
			$coupons->is_active = 1;
			$coupons->created_by = 1;
			$coupons->created_at = Carbon::now();
			$coupons->updated_by = 1;
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
		return view('adminpages.coupons.couponsadd');
	}
	public function coupons_edit($id)
	{
		$cid = decrypt($id);
		
		$coupons = Coupons::query()
								->select('*')
								->where('coupons_id',$cid)
								->get();
		return view('adminpages.coupons.couponsedit')->with('coupons',$coupons);
		
	}
	public function coupons_update(Request $request,$id)
	{
		$cid = decrypt($id);
		
		$coupons = Coupons::query()
								->where('coupons_id',$cid)
								->update([
								'store_id' => 1,
								'coupons_name' => $request->name,
								'coupons_description' => $request->description,
								'offers_caption' => $request->offers_caption,
								'valid_from' => $request->valid_from,
								'valid_to' => $request->valid_to,
								'language_id' => 1,
								'is_active' => 1,
								'updated_by' => 1,
								'updated_at' => Carbon::now(),
								]);
		Session::flash('success',"Coupon Updated successfully");
			return redirect('coupons');
	}
	public function coupons_delete($id)
	{
		$cid = decrypt($id);
		
		$coupons = Coupons::query()
								->where('coupons_id',$cid)
								->delete();
				Session::flash('success',"Coupon Deleted successfully");
				return redirect('coupons');
	}
}
