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

class User_Payment_Method_DetailsController extends Controller
{
     public function index()
	{
		$u_pay_method_detail = User_Payment_Method_Details::query()
										->select('*')
										->orderBy('updated_at','desc')
										->get();
					
				$u_pay_method = User_Payment_Method::query()
												->select('*')
												->get()->toarray();
												
												/* DB::enableQueryLog(); */
												 $u_pay_method_detail = User_Payment_Method_Details::query()
																->select('user_payment_method_details.detail_key','user_payment_method_details.detail_value','user_payment_method.*','users.name')
																->join('user_payment_method','user_payment_method_details.user_payment_method_id','=','user_payment_method.user_payment_method_id','Left')
																->join('users','user_payment_method.user_id','users.user_id','Left')
																->orderBy('user_payment_method_details.updated_at','desc')
																->get();
																
									/* 	$query = DB::getQueryLog(); */
				/* $query = end($query);
						print_r($query );exit; */ 						
			
					/* $a = array();							
				
				echo"<pre>";
				print_r($a);
			exit; */
				return view('adminpages.user_pay_method_detail.index',compact('u_pay_method_detail','u_pay_method'));
	}
	public function user_payment_method_detailadd(Request $request)
	{
		if(!empty($request->input()))
		{
			$rules = [
			'detail_key'=>'required',
			'detail_value'=>'required'
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$u_pay_method_detail = new User_Payment_Method_Details;
				$u_pay_method_detail->user_payment_method_id = $request->user_payment_method;
				$u_pay_method_detail->detail_key = $request->detail_key;
				$u_pay_method_detail->detail_value = $request->detail_value;
				$u_pay_method_detail->is_active = 1;
				$u_pay_method_detail->created_by = 1;
				$u_pay_method_detail->created_at = Carbon::now();
				$u_pay_method_detail->updated_by = 1;
				$u_pay_method_detail->updated_at = Carbon::now();
				$u_pay_method_detail->save();
				Session::flash('success',"Users Payment Method Details Added successfully");
				return redirect('u_pay_method_detail');
			}
		}
		 $u_pay_method = User_Payment_Method::query()
												->select('*')
												->get();
							
		return view('adminpages.user_pay_method_detail.user_payment_methodadd',compact('u_pay_method'));
	}
	public function user_payment_method_detailedit($id)
	{
		$uf_id = decrypt($id);
		$u_pay_method_detail = User_Payment_Method_Details::query()
										->select('*')
										->where('user_payment_method_details_id',$uf_id)
										->get();
		$u_pay_method = User_Payment_Method::query()
												->select('*')
												->get();
				return view('adminpages.user_pay_method_detail.user_payment_methodedit',compact('u_pay_method','u_pay_method_detail'));
		
	}
	public function user_payment_method_detailupdate(Request $request,$id)
	{
		$uf_id = decrypt($id);
		$u_pay_method = User_Payment_Method_Details::query()
										->where('user_payment_method_details_id',$uf_id)
										->update([
													'user_payment_method_id' => $request->user_payment_method,
													'detail_key' => $request->detail_key,
													'detail_value' => $request->detail_value,
													'updated_by' => 1,
													'updated_at' => Carbon::now()
												]);
					Session::flash('success',"Users Payment Method Details Updated successfully");
					return redirect('u_pay_method_detail');
	}
	public function user_payment_method_detaildelete($id)
	{
		$uf_id = decrypt($id);
		$u_pay_method = User_Payment_Method_Details::query()
										->where('user_payment_method_details_id',$uf_id)
										->delete();
					Session::flash('success',"Users Payment Method Deleted successfully");
					return redirect('u_pay_method_detail');
	}
	public function user_payment_method_detail_single(Request $request)
	{
		/* echo "dadfsad";exit; */
		$uf_id = $request->uid;
		/* echo $uf_id;exit; */
		$u_pay_method = User_Payment_Method_Details::query()
										->select('*')
										->where('user_payment_method_details_id',$uf_id)
										->get();
										/* print_r($u_pay_method);exit; */
		$u_pay_method_1 = User_Payment_Method::query()
												->select('*')
												->get();
						/* print_r($u_pay_method_1);exit; */
				$pay_method =""; 
				foreach($u_pay_method_1 as $pay)
				{
				if($u_pay_method[0]->user_payment_method_id == $pay->user_payment_method_id)
					{
						$pay_method = $pay->channel_code;
					}
					else
					{
						$pay_method = "";
					}
				}
		 /* echo $pay_method;exit; */
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>User Name:</label>".$pay_method."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Channel Code:</label>".$u_pay_method[0]->detail_key."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Account Holder Name:</label>".$u_pay_method[0]->detail_value."</div></div></div>";
	}
	public function user_payment_method_detail_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$u_pay_method = User_Payment_Method_Details::query()
							->where('user_payment_method_details_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
			$u_pay_method_status = User_Payment_Method_Details::query()
							->select('*')
							->where('user_payment_method_details_id',$id)
							->get();
				echo $u_pay_method_status[0]->is_active;
	}
}
