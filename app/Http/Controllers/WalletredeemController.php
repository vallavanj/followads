<?php

namespace App\Http\Controllers;
use App\Walletredeem;
use App\Wallettransaction;
use App\Wallet;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Session;
use Validator;
use Image;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class WalletredeemController extends Controller
{
    public function index()
	{
		$wallet_redeem = Walletredeem::query()
										->select('*')
										->orderBy('updated_at','desc')
										->get();
										/* DB::enableQueryLog();  */
						$wallet_request =DB::select('SELECT wallet_redeem_request.wallet_redeem_id,
						wallet.wallet_id,wallet.users_id,wallet_redeem_request.redeem_amount,
						wallet_redeem_request.created_at, users.name,wallet_redeem_request.is_active ,wallet_redeem_request.updated_at
						FROM 
						`wallet`,wallet_redeem_request,users 
						where   wallet.wallet_id = wallet_redeem_request.wallet_id and wallet.users_id=users.user_id order by (wallet_redeem_request.updated_at) desc');
						/* $query = DB::getQueryLog(); */

							/* $query = end($query);
							print_r($query );exit;  */
			
				foreach ($wallet_request as $val) {
					
					$account_details_fetch=DB::select("SELECT 
					users.user_id,user_payment_method_details.user_payment_method_id,
					users.name,(user_payment_method.channel_code) as 'channel_code',
					(user_payment_method.account_holder_name) as 'Account_holder_name',
					max(case when `detail_key` = 'Account No' then `detail_value` end) 'Account_Number', 
					max(case when `detail_key` = 'Ifsc Code' then `detail_value` end) 'IFSC_CODE', 
					max(case when `detail_key` = 'Bank Name' then `detail_value` end) 'Bank_Name', 
					max(case when `detail_key` = 'Branch' then `detail_value` end) 'Branch_Name',
					max(case when `detail_key` = 'Mobile' then `detail_value` end) 'MIMD'
					from 
					users,user_payment_method,user_payment_method_details
					where
					users.user_id=user_payment_method.user_id and
					user_payment_method.user_payment_method_id=user_payment_method_details.user_payment_method_id and  users.user_id ='".$val->users_id."' ");
				  
							foreach($account_details_fetch as $values) {
							
							$wallet_reedem_all_pay[]=array(
									"wallet_redeem_id"=>$val->wallet_redeem_id,
									"wallet_id" =>$val->wallet_id,
									"username" =>$val->name,
									"reedem_amount" =>$val->redeem_amount,
									"request_date" =>$val->created_at,
									"updated_at" =>$val->updated_at,
									"is_active" =>$val->is_active,
									"payment_channel" =>$values->channel_code,
									"Acccount_holder_name" =>$values->Account_holder_name,
									"Account_Number" =>$values->Account_Number,
									"IFSC_CODE" =>$values->IFSC_CODE,
									"Bank_Name" =>$values->Bank_Name,
									"Branch_Name" =>$values->Branch_Name,
									"MIMD" =>$values->MIMD,
							
							);
							
						 }
				}
				
				
				//print_r($wallet_reedem_all_pay);
 
		          
	
 
 
			return view('adminpages.wallet_redeem.index',compact('wallet_request','wallet_reedem_all_pay'));
			
			
			/* return view('adminpages.wallet_transaction.index')->with('w_transaction',$w_transaction); */
	}
	public function wallet_redeem_create(Request $request)
	{
		if(!empty($request->input()))
		{
			$rules = [
			'wallet'=>'required',
			'redeem_amount'=>'required'
			];
			$attributeNames = array(
					'wallet' => 'Wallet',
					'redeem_amount' => 'Redeem Amount',
						);
			$validate = Validator::make($request->all(),$rules);
			$validate->setAttributeNames($attributeNames);
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$wallet = Wallet::query()
									->select('balance')
									->where('wallet_id',$request->wallet)
									->get();
					if($wallet[0]->balance < $request->redeem_amount)
					{
						Session::flash('success',"No sufficient Amount");
								return redirect('wallet_redeem');
					}
					else
					{
						$walletredeem = new Walletredeem;
						
						$walletredeem->wallet_id = $request->wallet; 
						$walletredeem->redeem_amount = $request->redeem_amount; 
						$walletredeem->is_active = 1; 
						$walletredeem->created_by = 1; 
						$walletredeem->created_at = Carbon::now(); 
						$walletredeem->updated_by = 1; 
						$walletredeem->updated_at = Carbon::now(); 
						$walletredeem->save();
						$balance = ($wallet[0]->balance - $request->redeem_amount);
						
						
						$w_transaction = new Wallettransaction;
						$w_transaction->wallet_id =$request->wallet;
						$w_transaction->transaction_type = 'Debit';
						$w_transaction->transaction_amount =$request->redeem_amount;
						$w_transaction->is_active =1;
						$w_transaction->gift_coupon_id =0;
						$w_transaction->created_by =1;
						$w_transaction->created_at = Carbon::now();
						$w_transaction->updated_by =1;
						$w_transaction->updated_at = Carbon::now();
						$w_transaction->save();
						Session::flash('success',"Wallet Redeem Added successfully");
								return redirect('wallet_redeem');
					}
			}
		}
		
		
		$wallet // = Wallet::query()->select('*')->get();
				=DB::select("SELECT * FROM `wallet`,users WHERE wallet.users_id=users.user_id");
								
								
		return view('adminpages.wallet_redeem.wallet_redeemadd',compact('wallet'));
	}
	public function wallet_redeem_edit($id)
	{
		$wrid = decrypt($id);
		$wallet_redeem = Walletredeem::query()
										->select('*')
										->where('wallet_redeem_id',$wrid)
										->get();
		$wallet  = Wallet::query()
								->select('*')
								->get();
			return view('adminpages.wallet_redeem.wallet_redeemedit',compact('wallet_redeem','wallet'));
	}
	public function wallet_redeem_update(Request $request,$id)
	{
		$wrid = decrypt($id);
		$rules = [
			'wallet'=>'required',
			'redeem_amount'=>'required'
			];
			$attributeNames = array(
					'wallet' => 'Wallet',
					'redeem_amount' => 'Redeem Amount',
						);
			$validate = Validator::make($request->all(),$rules);
			$validate->setAttributeNames($attributeNames);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$walletredeem = Walletredeem::query()
												->where('wallet_redeem_id',$wrid)
												->update([
															'wallet_id' => $request->wallet,
															'redeem_amount'=>$request->redeem_amount,
															'updated_by' => 1,
															'updated_at' => Carbon::now()
														]);
				Session::flash('success',"Wallet Redeem Updated successfully");
				return redirect('wallet_redeem');
			}
	}
	public function wallet_redeem_delete($id)
	{
		$wrid = decrypt($id);
		$walletredeem = Walletredeem::query()
												->where('wallet_redeem_id',$wrid)
												->delete();
				Session::flash('success',"Wallet Redeem Deleted successfully");
				return redirect('wallet_redeem');
	}
	
	public function single_view(Request $request)
	{
		/* echo "fgghdgh";exit; */
		$wid = $request->uid;
		$w_transaction = Walletredeem::query()
												->select('*')
												->where('wallet_redeem_id',$wid)
												->get();
	
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Wallet Id:</label>".$w_transaction[0]->wallet_id."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Redeem:</label>".$w_transaction[0]->redeem_amount."</div></div></div>";
	}
	public function single_active(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$amount = $request->amount;
		$wid = $request->wid;
		/* echo $amount;
		echo $wid ;exit; */
		
			$wallet = Wallet::query()
								->select('balance')
								->where('wallet_id',$wid)
								->get();
								
			/* echo $wallet[0]->balance;exit; */
			$balance = ((int)$wallet[0]->balance - (int)$amount); 
			
			/* echo $balance;exit; */
		$wallet = Wallet::query()
								->where('wallet_id',$wid)
								->update([
								'balance'=>$balance
								]);
								
				$w_transaction = new Wallettransaction;
				$w_transaction->wallet_id =$id;
				$w_transaction->transaction_type = 0;
				$w_transaction->transaction_amount = $amount;
				$w_transaction->is_active =1;
				$w_transaction->gift_coupon_id =0;
				$w_transaction->created_by =1;
				$w_transaction->created_at = Carbon::now();
				$w_transaction->updated_by =1;
				$w_transaction->updated_at = Carbon::now();
				$w_transaction->save();
		
		$w_transaction = Walletredeem::query()
								->where('wallet_redeem_id',$id)
								->update([
										'is_active'=>$status,
										'updated_at'=>Carbon::now()
									]);
									
	
									
		$w_transaction_status = Walletredeem::query()
								->select('*')
								->where('wallet_redeem_id',$id)
								->get();
			echo $w_transaction_status[0]->is_active;
	}
	
	
}
