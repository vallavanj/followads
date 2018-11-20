<?php

namespace App\Http\Controllers;
use App\Wallettransaction;
use App\Wallet;
use App\User;
use App\Gift_Coupon;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Session;
use Validator;
use Image;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class WallettransactionController extends Controller
{
    public function index($id)
	{
		/* echo $id ;exit; */
		$w_t_id = decrypt($id);
		/* DB::enableQueryLog(); */
		$w_transaction = Wallettransaction::query()
												->select('wallet.*','users.name as user_name','wallet_transactions.*')
												->join('wallet','wallet_transactions.wallet_id','=','wallet.wallet_id','Left')
												->join('users','wallet.users_id','=','users.user_id','Left')
												->where('wallet_transactions.wallet_id',$w_t_id)
												->orderBy('wallet_transactions.updated_at','desc')
												->get();
												
												/* $query = DB::getQueryLog(); */

							/* $query = end($query);
							print_r($query );exit; */
												/* echo "<pre>";
												print_r($w_transaction);exit; */
		$coupons = Gift_Coupon::query()
									->select('*')
									->get();
				return view('adminpages.wallet_transaction.index',compact('w_transaction','coupons','w_t_id'));
	}
	public function wallet_transaction_create(Request $request,$id)
	{
		/* echo $id;exit; */
		if(!empty($request->input()))
		{
			$rules = [
			'transaction_type'=>'required',
			'transaction_amount'=>'required',
			'wallet'=>'required'
			];
			$attributeNames = array(
					'wallet' => 'Wallet',
					'transaction_amount' => 'Transaction Amount',
					'transaction_type' => 'Transaction Type',
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
				$w_transaction = new Wallettransaction;
				$w_transaction->wallet_id =$id;
				$w_transaction->transaction_type =$request->transaction_type;
				$w_transaction->transaction_amount =$request->transaction_amount;
				$w_transaction->is_active =1;
				$w_transaction->gift_coupon_id =$request->coupons;
				$w_transaction->created_by =1;
				$w_transaction->created_at = Carbon::now();
				$w_transaction->updated_by =1;
				$w_transaction->updated_at = Carbon::now();
				$w_transaction->save();
				
				$wallet_balance = Wallet::query()
											->select('*')
											->where('wallet_id',$id)
											->get();
											
				$balance = (int)$wallet_balance[0]->balance + (int)$request->transaction_amount;
				
				
				
				$wallet = Wallet::query()
									->where('wallet_id',$id)
									->update([
									'balance'=>$balance,
									'updated_at'=>Carbon::now()
										]);
				
				Session::flash('success',"Wallet Transaction Added successfully");
						return redirect('wallet');
			}
		}
		/* $wallet  = Wallet::query()
								->select('*')
								->get(); */
						 /* DB::enableQueryLog(); */
					$wallet  = Wallet::query()
										->select('users.name as user_name','wallet.*')
										/* ->join('wallet_transactions','wallet.wallet_id','=','wallet_transactions.wallet_id','Left') */
										->join('users','wallet.users_id','=','users.user_id','Left')
										->where('wallet.wallet_id',$id)
										->get();
								/* $query = DB::getQueryLog();

						$query = end($query);
							print_r($query );exit; */
		$coupons = Gift_Coupon::query()
									->select('*')
									->get();
		return view('adminpages.wallet_transaction.wallet_transactionadd',compact('wallet','coupons','id'));
	}
	public function wallet_transaction_edit($id)
	{
		$wid = decrypt($id);
		$w_transaction = Wallettransaction::query()
												->select('*')
												->where('wallet_transaction_id',$wid)
												->get();
				$wallet  = Wallet::query()
								->select('*')
								->get();
		$coupons = Gift_Coupon::query()
									->select('*')
									->get();
				return view('adminpages.wallet_transaction.wallet_transactionedit',compact('w_transaction','wallet','coupons'));
	}
	public function wallet_transaction_update(Request $request,$id)
	{
		$wid = decrypt($id);
		$rules = [
			'transaction_type'=>'required',
			'transaction_amount'=>'required',
			'wallet'=>'required'
			];
			$attributeNames = array(
					'wallet' => 'Wallet',
					'transaction_amount' => 'Transaction Amount',
					'transaction_type' => 'Transaction Type',
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
			$w_transaction = Wallettransaction::query()
													->where('wallet_transaction_id',$wid)
													->update([
															'transaction_type' => $request->transaction_type,
															'transaction_amount' => $request->transaction_amount,
															'gift_coupon_id' =>$request->coupons,
															'updated_by' =>1,
															'updated_at' => Carbon::now()
													]);
							Session::flash('success',"Wallet Transaction Updated successfully");
						return redirect('wallet_transaction');
			}
	}
	public function wallet_transaction_delete($id)
	{
		$wid = decrypt($id);
		$w_transaction = Wallettransaction::query()
												->where('wallet_transaction_id',$wid)
												->delete();
						Session::flash('success',"Wallet Transaction Deleted successfully");
						return redirect('wallet_transaction');
	}
	public function single_view(Request $request)
	{
		/* echo "fgghdgh";exit; */
		$wid = $request->uid;
		$w_transaction = Wallettransaction::query()
												->select('*')
												->where('wallet_transaction_id',$wid)
												->get();
			$coupons = Gift_Coupon::query()
									->select('*')
									->get();
				$coupon_1="";
			foreach($coupons as $coupon)
			{
				  if($w_transaction[0]->gift_coupon_id == $coupon->gift_coupon_id)
				  {
						$coupon_1 = $coupon->code;
				  }
			}
				
				  
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Wallet Id:</label>".$w_transaction[0]->wallet_id."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Transaction Type:</label>".$w_transaction[0]->transaction_type."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Transaction Amount:</label>".$w_transaction[0]->transaction_amount."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Gift Coupon:</label>".$coupon_1."</div></div></div>";
	}
	public function single_active(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$w_transaction = Wallettransaction::query()
								->where('wallet_transaction_id',$id)
								->update([
										'is_active'=>$status,
										'updated_at'=>Carbon::now()
									]);
		$w_transaction_status = Wallettransaction::query()
								->select('*')
								->where('wallet_transaction_id',$id)
								->get();
			echo $w_transaction_status[0]->is_active;
	} 
}
