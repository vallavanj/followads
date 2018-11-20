<?php

namespace App\Http\Controllers;
use App\Wallet;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Session;
use Validator;
use Image;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WalletController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
    public function index()
	{
		
		$wallet = Wallet::query()
							->select('*')
							->orderBy('updated_at','desc')
							->get();
		$user = User::query()
							->select('*')
							->get();
		return view('adminpages.wallet.index',compact('wallet','user'));
	}
	public function wallet_add(Request $request)
	{
		if(!empty($request->input()))
		{
			$rules = [
			'balance'=>'required'
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$wallet = new Wallet;
				
				$wallet->users_id = Auth::user()->user_id;
				$wallet->balance = $request->balance;
				$wallet->is_active = 1;
				$wallet->created_by = 1;
				$wallet->created_at = Carbon::now();
				$wallet->updated_by = 1;
				$wallet->updated_at = Carbon::now();
				$wallet->save();
				Session::flash('success',"Wallet Added successfully");
				return redirect('wallet');
			}
		}
		return view('adminpages.wallet.wallet_add');
	}
	public function wallet_edit(Request $request,$id)
	{
		$wid = decrypt($id);
		/* echo $wid;exit; */
		
			$wallet = Wallet::query()
								->select('wallet.*','users.name')
								->join('users','users.user_id','=','wallet.users_id','Left')
								->where('wallet_id',$wid)
								->get();
								
				return view('adminpages.wallet.wallet_edit')->with('wallet',$wallet);
			
	}
	public function wallet_update(Request $request,$id)
	{
		$wid = decrypt($id);
		$rules = [
			'balance'=>'required'
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
		$wallet = Wallet::query()
							->where('wallet_id',$wid)
							->update([
										'balance'=>$request->balance,
										'updated_at'=>Carbon::now()
									]);
				Session::flash('success',"Wallet Updated successfully");
				return redirect('wallet');
			}
	}
	public function wallet_delete($id)
	{
		$wid = decrypt($id);
		$wallet = Wallet::query()
							->where('wallet_id',$wid)
							->delete();
				Session::flash('success',"Wallet Deleted successfully");
				return redirect('wallet');
	}
	public function single_view(Request $request)
	{
		/* echo "ddfgskl";exit; */
		$id = $request->uid;
		/* echo $id;exit; */
		$wallet = Wallet::query()
							->select('*')
							->where('wallet_id',$id)
							->get();
			/* $wallet[0]->balance; */
				$user = User::query()
							->select('*')
							->get();
					$user_name = "";
				foreach($user as $users)
				{
					if($users->user_id == $wallet[0]->users_id)
					{
						$user_name = $users->name;
					}
				}
			/* $user_name = $users->name; */
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>User Name:</label>".$user_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Balance:</label>".$wallet[0]->balance."</div></div></div>";
		
	}
	public function single_active(Request $request)
	{
		$id = $request->id;
		$status = $request->status;
		$wallet = Wallet::query()
							->where('wallet_id',$id)
							->update([
										'is_active'=>$status,
										'updated_at'=>Carbon::now()
									]);
		$wallet_status = Wallet::query()
							->select('*')
							->where('wallet_id',$id)
							->get();
			echo $wallet_status[0]->is_active;
	}
}
