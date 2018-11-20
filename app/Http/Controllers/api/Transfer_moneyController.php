<?php

/* namespace App\Http\Controllers; */
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\User_Payment_Method;
use App\User_Payment_Method_Details;
use DB;
use App\Activity_log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Transfer_moneyController extends Controller
{
    public function transfer_money(Request $request)
	{
		$user_id = $request->user_id;
		$bank_id = $request->bank_id;
		/* echo $bank_id;*/
			/* DB::enableQueryLog();  */
		$u_pay_method = User_Payment_Method::query()
													->select('*')
													->where('user_id','=',$user_id)
													->where('user_payment_method_id','=',$bank_id)
													->get();
		/* 	print_r($u_pay_method); */
		if($u_pay_method->isNotEmpty())
		{
			/* echo $u_pay->user_payment_method_id;exit; */
				$user_pay_detail = User_Payment_Method_Details::query()
									->select('*')
									->where('user_payment_method_id',$u_pay_method[0]->user_payment_method_id)
									->count();
				/* echo $user_pay_detail; */
				
				if(!empty($user_pay_detail))
				{
					
					$log = new Activity_log;
					$log->user_id = $request->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "User Transfer money";
					$log->is_active =1;
					$log->created_by =$request->user_id;
					$log->updated_by = $request->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					$log->save();
					
					return response()->json(["error"=>"success","error_code"=>"200",'wallet_amount'=>'0','message'=>'Bank Details Available']);
				}
				else
				{
					return response()->json(["error"=>"error","error_code"=>"500",'message'=>'Bank Details Not Available']);
				}
					
		}
		else
		{
			return response()->json(["error"=>"error","error_code"=>"500",'message'=>'Bank Details Not Available']);
		}
			
	}
}
