<?php

namespace App\Http\Controllers;
use App\Couponscode;
use App\Activity_log;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Session;
use Validator;
use Image;
use DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

use Illuminate\Http\Request;

class CouponscodeController extends Controller
{
     public function index()
	{
		$coupons_code = Couponscode::query()
										->select('*')
										->get();
				return view('adminpages.couponscode.index')->with('coupons_code',$coupons_code);
	}
	public function coupons_codesadd(Request $request)
	{
		if(!empty($request->input()))
		{
			$rules = [
			'codes'=>'required',
			];
			
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$coupons_code = new Couponscode;
				$coupons_code->coupons_id = 1;
				$coupons_code->coupons_codes = $request->codes;
				$coupons_code->is_active = 1;
				$coupons_code->created_by = Auth::user()->user_id;
				$coupons_code->created_at = Carbon::now();
				$coupons_code->updated_by = Auth::user()->user_id;
				$coupons_code->updated_at = Carbon::now();
				$coupons_code->save();
				
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
				
				
				Session::flash('success',"Coupon Codes Added successfully");
				return redirect('coupons_code');
			}
			
		}
		return view('adminpages.couponscode.coupons_codeadd');
	}
	public function coupons_codesedit($id)
	{
		$ccid = decrypt($id);
		
		$coupons_code = Couponscode::query()
										->select('*')
										->where('coupons_codes_id',$ccid)
										->get();
			return view('adminpages.couponscode.coupons_codeedit')->with('coupons_code',$coupons_code);
	}
	public function coupons_codesupdate(Request $request,$id)
	{
		$ccid = decrypt($id);
		$rules = [
			'codes'=>'required',
			];
			
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$coupons_code = Couponscode::query()
												->where('coupons_codes_id',$ccid)
												->update([
													'coupons_codes' => $request->codes,
													'updated_by' => 1,
													'updated_at' => Carbon::now()
												]);
												
				$log = new Activity_log;
				$log->user_id = Auth::user()->user_id;
				$log->activity_code = $request->activity_Code;
				$log->detail = "Updated Coupons";
				$log->is_active =1;
				$log->created_by = Auth::user()->user_id;
				$log->updated_by = Auth::user()->user_id;
				$log->created_at = Carbon::now();
				$log->updated_at = Carbon::now();
					
				$log->save();
											
												
				Session::flash('success',"Coupon Codes Updated successfully");
				return redirect('coupons_code');
			}
	}
	public function coupons_codesdelete($id)
	{
		$ccid = decrypt($id);
		$coupons_code = Couponscode::query()
										->where('coupons_codes_id',$ccid)
										->delete();
			Session::flash('success',"Coupon Codes Deleted successfully");
				return redirect('coupons_code');
	}
}
