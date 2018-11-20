<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use App\Internaluser;
use App\Language;
use App\Business;
use App\User_feedback;
use App\User_Payment_Method;
use App\User_Payment_Method_Details;
use App\User_Saved_Advertisement;
use App\Advertisment;
use App\User_Followed_Business;
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

class User_Followed_BusinessController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
    public function index($id)
	{
		$u_f_business = User_Followed_Business::query()
										->select('*')
										->where('user_id',$id)
										->orderBy('updated_at','desc')
										->get();
			$business = Business::query()
									->select('*')
									->get();
									
			$user = User::query()
								->select('*')
								->get();
				return view('adminpages.user_followed_business.index',compact('u_f_business','business','user'));
	}
	public function user_follow_business_add(Request $request)
	{
		
		if(!empty($request->input()))
		{
			/* echo $request->adv_name;exit; */
			$rules = [
			'business_name'=>'required',
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				
				$u_saved_adv = new User_Followed_Business;
				$u_saved_adv->user_id = 19;
				$u_saved_adv->business_id = $request->business_name;
				$u_saved_adv->is_active = 1;
				$u_saved_adv->created_by = 1;
				$u_saved_adv->created_at = Carbon::now();
				$u_saved_adv->updated_by = 1;
				$u_saved_adv->updated_at = Carbon::now();
				$u_saved_adv->save();
				Session::flash('success',"Users Saved Advertisement Added successfully");
				return redirect('user_follow_business');
			}
		}
		 $business = Business::query()
									->select('*')
									->get();
							
		return view('adminpages.user_followed_business.user_f_busiadd',compact('business'));
	}
	public function user_follow_businessedit($id)
	{
		/* echo "dfeafsad";exit; */
		$uf_id = decrypt($id);
		/* echo $uf_id;exit; */
		$u_f_business = User_Followed_Business::query()
										->select('*')
										->where('user_followed_business_id',$uf_id)
										->get();
						
		$business = Business::query()
								->select('*')
								->get();
								/* echo "<pre>";print_r($ads);exit; */
			return view('adminpages.user_followed_business.user_f_busiedit',compact('u_f_business','business'));
		
	}
	public function user_follow_businessupdate(Request $request,$id)
	{
		$uf_id = decrypt($id);
		$u_f_business = User_Followed_Business::query()
										->where('user_followed_business_id',$uf_id)
										->update([
													'business_id' => $request->business_name,
													'updated_at' => Carbon::now()
												]);
					Session::flash('success',"Users Saved Advertisement Updated successfully");
					return redirect('user_follow_business');
	}
	public function user_follow_businessdelete($id)
	{
		$uf_id = decrypt($id);
		$u_f_business = User_Followed_Business::query()
										->where('user_followed_business_id',$uf_id)
										->delete();
					Session::flash('success',"Users Saved Advertisement Deleted successfully");
					return redirect('user_follow_business');
	}
	public function user_follow_business_single(Request $request)
	{
		/* echo "dadfsad";exit; */
		$uf_id = $request->uid;
		/* echo $uf_id;exit; */
		$u_f_business = User_Followed_Business::query()
										->select('*')
										->where('user_followed_business_id',$uf_id)
										->get();
										/* print_r($u_pay_method);exit; */
		$business = Business::query()
								->select('*')
								->get();
								
		$user = User::query()
								->select('*')
								->get();
						/* print_r($u_pay_method_1);exit; */
				$business_name =""; 
				foreach($business as $busi)
				{
				if($u_f_business[0]->business_id == $busi->business_id)
					{
						$business_name = $busi->name;
					}
					
				}
				
				
				$user_name =""; 
				foreach($user as $usr)
				{
				if($u_f_business[0]->user_id == $usr->user_id)
					{
						$user_name = $usr->name;
					}
					
				}
		 /* echo $pay_method;exit; */
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>User Name:</label>".$user_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Business Name:</label>".$business_name."</div></div></div>";
	}
	public function user_follow_business_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$u_f_business = User_Followed_Business::query()
							->where('user_followed_business_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
		$u_f_business_status = User_Followed_Business::query()
							->select('*')
							->where('user_followed_business_id',$id)
							->get();
				echo $u_f_business_status[0]->is_active;
	}
}
