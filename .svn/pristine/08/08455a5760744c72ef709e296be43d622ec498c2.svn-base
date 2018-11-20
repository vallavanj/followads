<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use App\Internaluser;
use App\Language;
use App\User_feedback;
use App\User_Payment_Method;
use App\User_Payment_Method_Details;
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

class User_Payment_MethodController extends Controller
{
    public function index()
	{
		$u_pay_method = User_Payment_Method::query()
										->select('*')
										->orderBy('updated_at','desc')
										->get();
										
		$users = User::query()
							->select('*')
							->get();
				return view('adminpages.user_payment_method.index',compact('u_pay_method','users'));
	}
	public function users_paymentadd(Request $request)
	{
		if(!empty($request->input()))
		{
			$rules = [
			'channel'=>'required'
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				if($request->channel == 'bt')
				{
				$u_pay_method = new User_Payment_Method;
				$u_pay_method->user_id = $request->user_name;
				$u_pay_method->channel_code = $request->channel;
				$u_pay_method->account_holder_name = $request->ac_holdeer_name;
				$u_pay_method->is_active = 1;
				$u_pay_method->created_by = Auth::user()->user_id;
				$u_pay_method->created_at = Carbon::now();
				$u_pay_method->updated_by = Auth::user()->user_id;
				$u_pay_method->updated_at = Carbon::now();
				if($u_pay_method->save())
				{
					$inserted_id = $u_pay_method->id;
					/* echo $inserted_id;exit; */
					
					
					$details =array(
					'Account No'=>'200050001255',
					'Ifsc Code'=>'SBIN200202255',
					'Bank Name'=>'SBT',
					'Branch'=>'TNagar',
					);
					/* print_r($details);exit; */
					foreach($details as $key=>$det)
					{
					$u_pay_method_details = new User_Payment_Method_Details;
					$u_pay_method_details->user_payment_method_id = $inserted_id;
					$u_pay_method_details->detail_key = $key;
					$u_pay_method_details->detail_value = $det;
					$u_pay_method_details->is_active = 1;
					$u_pay_method_details->created_by = Auth::user()->user_id;
					$u_pay_method_details->created_at = Carbon::now();
					$u_pay_method_details->updated_by = Auth::user()->user_id;
					$u_pay_method_details->updated_at = Carbon::now();
					$u_pay_method_details->save();
					
					}
					
				}
			}
			if($request->channel == 'paytm' )
			{
				$u_pay_method = new User_Payment_Method;
				$u_pay_method->user_id = $request->user_name;
				$u_pay_method->channel_code = $request->channel;
				$u_pay_method->account_holder_name = $request->ac_holdeer_name;
				$u_pay_method->is_active = 1;
				$u_pay_method->created_by = Auth::user()->user_id;
				$u_pay_method->created_at = Carbon::now();
				$u_pay_method->updated_by = Auth::user()->user_id;
				$u_pay_method->updated_at = Carbon::now();
				if($u_pay_method->save())
				{
					$inserted_id = $u_pay_method->id; 
					$u_pay_method_details = new User_Payment_Method_Details;
					
					$mobile = 'Mobile';
					$mobile_number = 9854123654;
					$u_pay_method_details = new User_Payment_Method_Details;
					$u_pay_method_details->user_payment_method_id = $inserted_id;
					$u_pay_method_details->detail_key = $mobile;
					$u_pay_method_details->detail_value = $mobile_number;
					$u_pay_method_details->is_active = 1;
					$u_pay_method_details->created_by = Auth::user()->user_id;
					$u_pay_method_details->created_at = Carbon::now();
					$u_pay_method_details->updated_by = Auth::user()->user_id;
					$u_pay_method_details->updated_at = Carbon::now();
					$u_pay_method_details->save();
					
				
				}
				
				
			}
			if($request->channel == 'mmid')
			{
				$u_pay_method = new User_Payment_Method;
				$u_pay_method->user_id = $request->user_name;
				$u_pay_method->channel_code = $request->channel;
				$u_pay_method->account_holder_name = $request->ac_holdeer_name;
				$u_pay_method->is_active = 1;
				$u_pay_method->created_by = Auth::user()->user_id;
				$u_pay_method->created_at = Carbon::now();
				$u_pay_method->updated_by = Auth::user()->user_id;
				$u_pay_method->updated_at = Carbon::now();
				if($u_pay_method->save())
				{
					$inserted_id = $u_pay_method->id; 
					$u_pay_method_details = new User_Payment_Method_Details;
					
					$mobile = 'Mobile';
					$mobile_number = 9854123654;
					$u_pay_method_details = new User_Payment_Method_Details;
					$u_pay_method_details->user_payment_method_id = $inserted_id;
					$u_pay_method_details->detail_key = $mobile;
					$u_pay_method_details->detail_value = $mobile_number;
					$u_pay_method_details->is_active = 1;
					$u_pay_method_details->created_by = Auth::user()->user_id;
					$u_pay_method_details->created_at = Carbon::now();
					$u_pay_method_details->updated_by = Auth::user()->user_id;
					$u_pay_method_details->updated_at = Carbon::now();
					$u_pay_method_details->save();
					
				
				}
				
				
			}
			
				Session::flash('success',"Users Payment Method Added successfully");
				return redirect('users_payment_method');
			}
		}
		
	$users = DB::table('users')
						->select('int_usr.user_type_code','int_usr.internal_user_id','users.*')
						->join('internal_user as int_usr','users.user_id','=','int_usr.user_id')
						->where('users.is_active','1')
						->where('int_usr.user_type_code','iu')
						->get();
		
		return view('adminpages.user_payment_method.user_payment_methodadd',compact('users'));
	}
	public function users_paymentedit($id)
	{
		$uf_id = decrypt($id);
		$u_pay_method = User_Payment_Method::query()
										->select('*')
										->where('user_payment_method_id',$uf_id)
										->get();
				return view('adminpages.user_payment_method.user_payment_methodedit',compact('u_pay_method'));
		
	}
	public function users_paymentupdate(Request $request,$id)
	{
		$uf_id = decrypt($id);
		$u_pay_method = User_Payment_Method::query()
										->where('user_payment_method_id',$uf_id)
										->update([
													'channel_code' => $request->channel,
													'account_holder_name' => $request->ac_holdeer_name,
													'updated_by' => Auth::user()->user_id,
													'updated_at' => Carbon::now()
												]);
					Session::flash('success',"Users Payment Method Updated successfully");
					return redirect('users_payment_method');
	}
	public function users_paymentdelete($id)
	{
		$uf_id = decrypt($id);
		$u_pay_method = User_Payment_Method::query()
										->where('user_payment_method_id',$uf_id)
										->delete();
					Session::flash('success',"Users Payment Method Deleted successfully");
					return redirect('users_payment_method');
	}
	public function users_payment_single(Request $request)
	{
		$uf_id = $request->uid;
		/* echo $uf_id;exit; */
		$u_pay_method = User_Payment_Method::query()
										->select('*')
										->where('user_payment_method_id',$uf_id)
										->get();
		$user = User::query()
						->select('*')
						->get();
						/* print_r($user);exit; */
				$user_name =""; 
				foreach($user as $users)
				{
					if($users->user_id == $u_pay_method[0]->users_id)
					{
						$user_name = $users->name;
					}
				}
				/* echo $user_name;exit; */
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>User Name:</label>".$user_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Channel:</label>".strtoupper($u_pay_method[0]->channel_code)."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Account Holder Name:</label>".$u_pay_method[0]->account_holder_name."</div></div></div>";
	}
	public function users_payment_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$u_pay_method = User_Payment_Method::query()
							->where('user_payment_method_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
			$u_pay_method_status = User_Payment_Method::query()
							->select('*')
							->where('user_payment_method_id',$id)
							->get();
				echo $u_pay_method_status[0]->is_active;
	}
}
