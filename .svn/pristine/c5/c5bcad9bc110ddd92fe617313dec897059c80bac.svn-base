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
use App\User_Redemmed_Advertisement_Code;
use App\Advertisement_Offer_Code;
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

class User_Redemmed_Advertisement_CodeController extends Controller
{
   public function index()
	{
		$u_r_adv_code = User_Redemmed_Advertisement_Code::query()
										->select('*')
										->orderBy('updated_at','desc')
										->get();
			
									
			$user = User::query()
								->select('*')
								->get();
								
			$adv_off_code = Advertisement_Offer_Code::query()
														->select('*')
														->get();
				return view('adminpages.user_redeem_adv_code.index',compact('u_r_adv_code','user','adv_off_code'));
	}
	public function user_redemmed_advertisement_codecreate(Request $request)
	{
		
		if(!empty($request->input()))
		{
			/* echo $request->adv_name;exit; */
			$rules = [
			'adv_off_code'=>'required',
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				
				$u_saved_adv = new User_Redemmed_Advertisement_Code;
				$u_saved_adv->user_id = 19;
				$u_saved_adv->advertisement_offer_code_id = $request->adv_off_code;
				$u_saved_adv->is_active = 1;
				$u_saved_adv->created_by = 1;
				$u_saved_adv->created_at = Carbon::now();
				$u_saved_adv->updated_by = 1;
				$u_saved_adv->updated_at = Carbon::now();
				$u_saved_adv->save();
				Session::flash('success',"User Redemmed Advertisement Code Added successfully");
				return redirect('user_red_adv_code');
			}
		}
		 $adv_off_code = Advertisement_Offer_Code::query()
									->select('*')
									->get();
							
		return view('adminpages.user_redeem_adv_code.user_red_adv_codeadd',compact('adv_off_code'));
	}
	public function user_redemmed_advertisement_codeview($id)
	{
		/* echo "dfeafsad";exit; */
		$uf_id = decrypt($id);
		/* echo $uf_id;exit; */
		$u_r_adv_code = User_Redemmed_Advertisement_Code::query()
										->select('*')
										->where('user_redeemed_advertisement_code_id',$uf_id)
										->get();
						
		 $adv_off_code = Advertisement_Offer_Code::query()
								->select('*')
								->get();
								/* echo "<pre>";print_r($ads);exit; */
			return view('adminpages.user_redeem_adv_code.user_red_adv_codeedit',compact('u_r_adv_code','adv_off_code'));
		
	}
	public function user_redemmed_advertisement_codeupdate(Request $request,$id)
	{
		$uf_id = decrypt($id);
		$u_f_business = User_Redemmed_Advertisement_Code::query()
										->where('user_redeemed_advertisement_code_id',$uf_id)
										->update([
													'advertisement_offer_code_id' => $request->adv_off_code,
													'updated_at' => Carbon::now()
												]);
					Session::flash('success',"User Redemmed Advertisement Code Updated successfully");
					return redirect('user_red_adv_code');
	}
	public function user_redemmed_advertisement_codedelete($id)
	{
		$uf_id = decrypt($id);
		$u_f_business = User_Redemmed_Advertisement_Code::query()
										->where('user_redeemed_advertisement_code_id',$uf_id)
										->delete();
					Session::flash('success',"User Redemmed Advertisement Code Deleted successfully");
					return redirect('user_red_adv_code');
	}
	public function user_redemmed_advertisement_code_single(Request $request)
	{
		/* echo "dadfsad";exit; */
		$uf_id = $request->uid;
		/* echo $uf_id;exit; */
		$u_r_adv_code = User_Redemmed_Advertisement_Code::query()
										->select('*')
										->where('user_redeemed_advertisement_code_id',$uf_id)
										->get();
										/* print_r($u_pay_method);exit; */
		 $adv_off_code = Advertisement_Offer_Code::query()
													->select('*')
													->get();
								
		$user = User::query()
								->select('*')
								->get();
						/* print_r($u_pay_method_1);exit; */
				$adv_off_code_1 =""; 
				foreach($adv_off_code as $adv_off)
				{
				if($u_r_adv_code[0]->advertisement_offer_code_id == $adv_off->advertisement_offer_code_id)
					{
						$adv_off_code_1 = $adv_off->offer_code;
					}
					
				}
				
				
				$user_name =""; 
				foreach($user as $usr)
				{
				if($u_r_adv_code[0]->user_id == $usr->user_id)
					{
						$user_name = $usr->name;
					}
					
				}
		 /* echo $user_name;exit; */
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>User Name:</label>".$user_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Advertisement Offer Code:</label>".$adv_off_code_1."</div></div></div>";
	}
	public function user_redemmed_advertisement_code_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$u_f_business = User_Redemmed_Advertisement_Code::query()
							->where('user_redeemed_advertisement_code_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
		$u_f_business_status = User_Redemmed_Advertisement_Code::query()
							->select('*')
							->where('user_redeemed_advertisement_code_id',$id)
							->get();
				echo $u_f_business_status[0]->is_active;
	}
}
