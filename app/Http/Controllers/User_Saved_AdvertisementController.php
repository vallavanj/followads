<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use App\Internaluser;
use App\Language;
use App\User_feedback;
use App\User_Payment_Method;
use App\User_Payment_Method_Details;
use App\User_Saved_Advertisement;
use App\Advertisement_Description;
use App\Advertisment;
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

class User_Saved_AdvertisementController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
	
   public function index(Request $request,$id)
	{
		$u_s_ad = User_Saved_Advertisement::query()
										->select('*')
										->where('user_id',$id)
										->orderBy('updated_at','desc')
										->get();
			$ads = Advertisment::query()
									->select('*')
									->get();
									
		$adv_desc = Advertisement_Description::query()
												->select('*')
												->get();
									
			$user = User::query()
								->select('*')
								->get();
				return view('adminpages.user_saved_advertisement.index',compact('u_s_ad','ads','user','adv_desc'));
	}
	public function user_saved_ad_add(Request $request)
	{
		
		if(!empty($request->input()))
		{
			/* echo $request->adv_name;exit; */
			$rules = [
			'adv_name'=>'required',
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				
				$u_saved_adv = new User_Saved_Advertisement;
				$u_saved_adv->user_id = 19;
				$u_saved_adv->advertisement_id = $request->adv_name;
				$u_saved_adv->is_active = 1;
				$u_saved_adv->created_by = 1;
				$u_saved_adv->created_at = Carbon::now();
				$u_saved_adv->updated_by = 1;
				$u_saved_adv->updated_at = Carbon::now();
				$u_saved_adv->save();
				Session::flash('success',"Users Saved Advertisement Added successfully");
				return redirect('user_saved_adv');
			}
		}
		 $ads = Advertisment::query()
									->select('*')
									->get();
							
		return view('adminpages.user_saved_advertisement.user_saved_advadd',compact('ads'));
	}
	public function user_saved_adedit($id)
	{
		/* echo "dfeafsad";exit; */
		$uf_id = decrypt($id);
		/* echo $uf_id;exit; */
		$u_saved_adv = User_Saved_Advertisement::query()
										->select('*')
										->where('user_saved_advertisement_id',$uf_id)
										->get();
						
		$ads = Advertisment::query()
								->select('*')
								->get();
								/* echo "<pre>";print_r($ads);exit; */
			return view('adminpages.user_saved_advertisement.user_saved_advedit',compact('u_saved_adv','ads'));
		
	}
	public function user_saved_adupdate(Request $request,$id)
	{
		$uf_id = decrypt($id);
		$u_pay_method = User_Saved_Advertisement::query()
										->where('user_saved_advertisement_id',$uf_id)
										->update([
													'advertisement_id' => $request->adv_name,
													'updated_at' => Carbon::now()
												]);
					Session::flash('success',"Users Saved Advertisement Updated successfully");
					return redirect('user_saved_adv');
	}
	public function user_saved_addelete($id)
	{
		$uf_id = decrypt($id);
		$u_pay_method = User_Saved_Advertisement::query()
										->where('user_saved_advertisement_id',$uf_id)
										->delete();
					Session::flash('success',"Users Saved Advertisement Deleted successfully");
					return redirect('user_saved_adv');
	}
	public function user_saved_ad_single(Request $request)
	{
		/* echo "dadfsad";exit; */
		$uf_id = $request->uid;
		/* echo $uf_id;exit; */
		$u_pay_method = User_Saved_Advertisement::query()
										->select('*')
										->where('user_saved_advertisement_id',$uf_id)
										->get();
										/* print_r($u_pay_method);exit; */
		$user = User::query()
								->select('*')
								->get();
						/* print_r($u_pay_method_1);exit; */
				$user_name =""; 
				foreach($user as $users)
				{
				if($u_pay_method[0]->user_id == $users->user_id)
					{
						$user_name = $users->name;
					}
					
				}
		 /* echo $pay_method;exit; */
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>User Name:</label>".$user_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Advertisement Id:</label>".$u_pay_method[0]->	advertisement_id."</div></div></div>";
	}
	public function user_saved_ad_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$u_pay_method = User_Saved_Advertisement::query()
							->where('user_saved_advertisement_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
		$u_pay_method_status = User_Saved_Advertisement::query()
							->select('*')
							->where('user_saved_advertisement_id',$id)
							->get();
				echo $u_pay_method_status[0]->is_active;
	}
}
