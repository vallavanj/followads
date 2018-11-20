<?php

/* namespace App\Http\Controllers; */
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\User_feedback;
use App\User_Payment_Method;
use App\User_Payment_Method_Details;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Save_Bank_AccController extends Controller
{
    public function save_bank_details(Request $request)
	{
		$user_id=$request->user_id;
		$bank_details=$request->bank_details;
				
			if($user_id){	
				
				
				$data_values=json_decode($bank_details);
				
				foreach($data_values as $bank_details) {
					
					$holder_name =$bank_details['1']->detail_value;
						
				}
				
				
				$u_pay_method = new User_Payment_Method;
				$u_pay_method->user_id = $request->user_id;
				$u_pay_method->channel_code = 'bt';
				$u_pay_method->account_holder_name = $holder_name;
				$u_pay_method->is_active = 1;
				$u_pay_method->created_by = $request->user_id;
				$u_pay_method->created_at = Carbon::now();
				$u_pay_method->updated_by = $request->user_id;
				$u_pay_method->updated_at = Carbon::now();
				if($u_pay_method->save())
				{
					
					$inserted_id = $u_pay_method->id;
				}
				
				
				
				
				
			$save_bank_details=array();
				
			$u_pay_method_details1=array();
			foreach($data_values as $bank_details) {
					$count_length=count($bank_details);
					for($i=0;$i<$count_length;$i++) {
						/*$save_bank_details[]=array(
							$bank_details[$i]->detail_key =>$bank_details[$i]->detail_value,
							);*/
							$u_pay_method_details = new User_Payment_Method_Details;
							$u_pay_method_details->user_payment_method_id = $inserted_id;
							$u_pay_method_details->detail_key = $bank_details[$i]->detail_key;
							$u_pay_method_details->detail_value = $bank_details[$i]->detail_value;
							$u_pay_method_details->is_active = 1;
							$u_pay_method_details->created_by =$request->user_id;
							$u_pay_method_details->created_at = Carbon::now();
							$u_pay_method_details->updated_by = $request->user_id;
							$u_pay_method_details->updated_at = Carbon::now();
							if($u_pay_method_details->save())
							{
							
									$u_pay_method_details1 =DB::select( DB::raw("SELECT user_payment_method_id,
										max(case when `detail_key` = 'Account No' then `detail_value` end) 'Account_Number', 
										max(case when `detail_key` = 'Ifsc Code' then `detail_value` end) 'IFSC_CODE', 
										max(case when `detail_key` = 'Bank Name' then `detail_value` end) 'Bank_Name' ,
										max(case when `detail_key` = 'Account Name' then `detail_value` end) 'Account_holder_Name' 
										FROM `user_payment_method_details` 
									WHERE `user_payment_method_id`='".$inserted_id."'"));
							}
						
					}
				
				}
				
				foreach($u_pay_method_details1 as $u_pay)
				{
					$deatails[] = array(
					'bank_id'=>$u_pay->user_payment_method_id,
					'bank_name'=>$u_pay->Bank_Name,
					'acc_no'=>$u_pay->Account_Number,
					'ifsc_code'=>$u_pay->IFSC_CODE,
					'acc_name'=>$u_pay->Account_holder_Name,
					);
				}
				
			/*	$u_pay_method = new User_Payment_Method;
				$u_pay_method->user_id = $request->user_id;
				$u_pay_method->channel_code = 'bt';
				$u_pay_method->account_holder_name = $request->ac_holdeer_name;
				$u_pay_method->is_active = 1;
				$u_pay_method->created_by = $request->user_id;
				$u_pay_method->created_at = Carbon::now();
				$u_pay_method->updated_by = $request->user_id;
				$u_pay_method->updated_at = Carbon::now();
				if($u_pay_method->save())
				{
					
					$inserted_id = $u_pay_method->id;
					
					
					$details =array(
					'Account No'=>$request->acc_no,
					'Account Name'=>$request->acc_name,
					'Ifsc Code'=>$request->ifsc_code,
					'Bank Name'=>$request->bank_name,
					);
				foreach($details as $key=>$det)
				{
							$u_pay_method_details = new User_Payment_Method_Details;
							$u_pay_method_details->user_payment_method_id = $inserted_id;
							$u_pay_method_details->detail_key = $key;
							$u_pay_method_details->detail_value = $det;
							$u_pay_method_details->is_active = 1;
							$u_pay_method_details->created_by =$request->user_id;
							$u_pay_method_details->created_at = Carbon::now();
							$u_pay_method_details->updated_by = $request->user_id;
							$u_pay_method_details->updated_at = Carbon::now();
							if($u_pay_method_details->save())
							{
							
									$u_pay_method_details1 =DB::select( DB::raw("SELECT user_payment_method_id,
										max(case when `detail_key` = 'Account No' then `detail_value` end) 'Account_Number', 
										max(case when `detail_key` = 'Ifsc Code' then `detail_value` end) 'IFSC_CODE', 
										max(case when `detail_key` = 'Bank Name' then `detail_value` end) 'Bank_Name' ,
										max(case when `detail_key` = 'Account Name' then `detail_value` end) 'Account_holder_Name' 
										FROM `user_payment_method_details` 
									WHERE `user_payment_method_id`='".$inserted_id."'"));
							}
					
				}
				foreach($u_pay_method_details1 as $u_pay)
				{
					$deatails[] = array(
					'bank_id'=>$u_pay->user_payment_method_id,
					'bank_name'=>$u_pay->Bank_Name,
					'acc_no'=>$u_pay->Account_Number,
					'ifsc_code'=>$u_pay->IFSC_CODE,
					'acc_name'=>$u_pay->Account_holder_Name,
					);
				}*/
				
					
				return response()->json(["error_code"=>"200","error"=>"sucess",'message'=>'Bank Details Has Been Saved','bank_detail'=>$deatails]);
				
				}
				else
				{
					$deatails[] = "";
				return response()->json(["error_code"=>"500","error"=>"error",'message'=>'Bank Details Not Saved','bank_detail'=>$deatails]);
				}  
			
	}
	public function bank_list(Request $request)
	{
			$u_pay_method = User_Payment_Method::query()
													->select('*')
													->where('user_id',$request->user_id)
													->get();
		foreach($u_pay_method as $u_meth)
		{
		$u_pay_method_details1 =DB::select( DB::raw("SELECT user_payment_method_id,
					max(case when `detail_key` = 'Account No' then `detail_value` end) 'Account_Number', 
				max(case when `detail_key` = 'Ifsc Code' then `detail_value` end) 'IFSC_CODE', 
				max(case when `detail_key` = 'Bank Name' then `detail_value` end) 'Bank_Name' ,
				max(case when `detail_key` = 'Account Name' then `detail_value` end) 'Account_holder_Name' 

				FROM `user_payment_method_details` 
					WHERE `user_payment_method_id`='".$u_meth->user_payment_method_id."'"));
					
					foreach($u_pay_method_details1 as $u_pay)
					{
					$deatails[] = array(
					'bank_id'=>$u_pay->user_payment_method_id,
					'bank_name'=>$u_pay->Bank_Name,
					'acc_no'=>$u_pay->Account_Number,
					'ifsc_code'=>$u_pay->IFSC_CODE,
					'acc_name'=>$u_pay->Account_holder_Name,
					);
					}
		}
					
			
			if(!empty($deatails))
			{
			return response()->json(["error"=>"OWCE00",'message'=>'Bank Details Has Been Saved','bank_detail'=>$deatails,REST_Controller::HTTP_OK]);
			}
			else
			{
				//print_r($deatails);
				//$deatails[] = array();
				return response()->json(["error"=>"OWCE00",'message'=>'Bank Details Has Not Saved','bank_detail'=>[],REST_Controller::HTTP_OK]);
			}
	}
	
	public function bank_account_edit(Request $request)
	{
		
		$user_id=$request->user_id;
		$bank_details=$request->bank_details;
		$data_values=json_decode($bank_details);
		$payment_method_id =$data_values->bank_details['0']->detail_value;
		$account_key_name =$data_values->bank_details['1']->detail_key;
		$account_holder_name =$data_values->bank_details['1']->detail_value;
		$user_bank_get_id=User_Payment_Method::query()
							->select('*')
							->where('user_id',$request->user_id)
							->where('user_payment_method_id',$payment_method_id)
							->get();
			foreach($user_bank_get_id  as $value) {
				$payment_id=$value->user_payment_method_id;
				}
					
			$user_bank_account=User_Payment_Method::query()
					->where('user_payment_method_id','=',$payment_id)
					->update([
								'channel_code' => 'bt',
								'account_holder_name'=>$account_holder_name,
								"created_by"=>$request->user_id,
								"created_at"=>Carbon::now(),
								"updated_by"=>$request->user_id,
								"updated_at"=>Carbon::now(),
								]);
			$payement_delete_ids=User_Payment_Method_Details::query()->where('user_payment_method_id', $payment_id)->delete();
			$u_pay_method_details1=array();
			foreach($data_values as $bank_details) {
					$count_length=count($bank_details);
					for($i=1;$i<$count_length;$i++) {
						
							$u_pay_method_details = new User_Payment_Method_Details;
							$u_pay_method_details->user_payment_method_id = $payment_id;
							$u_pay_method_details->detail_key = $bank_details[$i]->detail_key;
							$u_pay_method_details->detail_value = $bank_details[$i]->detail_value;
							$u_pay_method_details->is_active = 1;
							$u_pay_method_details->created_by =$request->user_id;
							$u_pay_method_details->created_at = Carbon::now();
							$u_pay_method_details->updated_by = $request->user_id;
							$u_pay_method_details->updated_at = Carbon::now();
							if($u_pay_method_details->save())
							{
							
									$u_pay_method_details1 =DB::select( DB::raw("SELECT user_payment_method_id,
										max(case when `detail_key` = 'Account No' then `detail_value` end) 'Account_Number', 
										max(case when `detail_key` = 'Ifsc Code' then `detail_value` end) 'IFSC_CODE', 
										max(case when `detail_key` = 'Bank Name' then `detail_value` end) 'Bank_Name' ,
										max(case when `detail_key` = 'Account Name' then `detail_value` end) 'Account_holder_Name' 
										FROM `user_payment_method_details` 
									WHERE `user_payment_method_id`='".$payment_id."'"));
							}
						
					}
				
				}
		foreach($u_pay_method_details1 as $u_pay)
				{
					$deatails[] = array(
					'bank_id'=>$u_pay->user_payment_method_id,
					'bank_name'=>$u_pay->Bank_Name,
					'acc_no'=>$u_pay->Account_Number,
					'ifsc_code'=>$u_pay->IFSC_CODE,
					'acc_name'=>$u_pay->Account_holder_Name,
					);
				}	
		return response()->json(["error_code"=>"200","error"=>"sucess",'message'=>'Bank Details Has Been  Successfully Updated','bank_detail'=>$deatails]);
		
	}
	
}
