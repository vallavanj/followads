<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use Mail;
use App\Internaluser;
use App\Language;
use App\Activity_log;
use Session;
use Image;
use Hash;
use Validator;
use Redirect;
use DB;
use App\Attempt;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function login(Request $request)
	{
		
		 
		if(!empty($request->input()))
		{     
	
			 $credentials = array('email' => $request->input('name'), 'password' => $request->input('password'));
				$remember = $request->_token;
			 if(Auth::guard('web')->attempt($credentials))
			 {
				 if(Auth::user()->is_active == 1)
				 {
					$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "login";
					$log->is_active =1;
					$log->created_by = Auth::user()->user_id;
					$log->updated_by = Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
					$user_id = Auth::user()->user_id;
					$user = User::query()
										->where('user_id',$user_id)
										->update(['updated_at'=>date("Y-m-d h:i:sa")]);
										
					$user_1 = User::query()
										->select('*')
										->where('user_id',$user_id)
										->get();
					
					
					/* $date_time = date("Y-m-d h:i:sa"); */
					$date_time = $user_1[0]->updated_at;
					Session::put('login_time',$date_time);
					
					$internal_user = Internaluser::query()
														->select('*')
														->where('user_id',Auth::user()->user_id)
														->get();
														
						if($internal_user[0]->user_type_code == 'sa')
						{
						Session::put('user_role',1);
						}
						else if($internal_user[0]->user_type_code == 'ad')
						{
							Session::put('user_role',2);
						}
						else if($internal_user[0]->user_type_code == 'iu')
						{
							Session::put('user_role',3);
						}
						else
						{
							Session::put('user_role',"");
						}
					
					
						return Redirect::to('dashboard')->with('success', 'User Logged in successful');
				 }
				 else
				 {
					 Auth::logout();
					return Redirect::to('login')->with('error', 'User has been Blocked');
				 }
			 }
			else
			{

				return Redirect::back()->with('error', 'Username or Password Wrong'); 
				
			}
		}
		
			return view('adminpages.login');
		
	}
	
	
	public function admin_logout()
	{
		Auth::logout();
		Session::flush();
		return redirect('login');
	}
public function adminlogin()
	{
		
		return redirect('login');
	} 

public function forgot_password(Request $request)
{
	if(!empty($request->input()))
	{
		$users = User::query()
						->select('*')
						->where('email',$request->email)
						->get();
		if(!empty($users))
		{
			$users_forg_token = rand();
			$users_forgot_token = User::query()
										->where('user_id',$users[0]->user_id)
										->update(['forgot_password_token'=>$users_forg_token]);
			
			
			$user_forgot = User::query()
										->select('*')
										->where('user_id',$users[0]->user_id)
										->get();
			
			$user = array(
			/* 'name'=>$user_forgot[0]->name, */
			'name'=>'Admin',
			'email' =>$user_forgot[0]->email,
			'url'=>url('change_password/'.encrypt($users[0]->user_id).'/'.$user_forgot[0]->forgot_password_token)
			);
			Mail::send('emails.forgot', ['user' => $user], function ($m) use ($user) {
					$m->from('testopen01@gmail.com', 'Follow Ads');

					$m->to($user['email'], $user['name'])->subject('Follow Ads - Reset Password');
						});
						Session::flash('success',"Mail Has Been Sent Please Check your Mail");
						return redirect('login');
						/* return Redirect::to('forgot')->with('Mail Has Been Sent Please Check your Mail'); */
		}
		else
		{
			Session::flash('success',"Please Check your Email Id");
		}
		
	}
	
	return view('adminpages.forgot_password');
	
}

public function change_password(Request $request,$id,$forgot_token)
{
	$uid = decrypt($id);
	if(!empty($request->input()))
	{
		$users = User::query()
						->select('*')
						->where('user_id',$uid)
						->where('forgot_password_token',$forgot_token)
						->get();
		/* $i_u = Internaluser::query()
								->select('*')
								->where('user_id',$uid)
								->get(); */
				/* 		echo"<pre>";
		print_R($users);exit; */
	/* 	$hashed = $i_u[0]->password;
		 $password = $request->old_password; */
		/*  echo $hashed; */
		
			/* echo "yes"; */
			if(!empty($users))
			{
			$i_u_1 = Internaluser::query()
										->where('user_id',$uid)
										->update(['password'=>Hash::make(Input::get('new_password'))]);
										
			Session::flash('success',"Password Changed Successfully");
			return redirect('login');
			
			}
	}
	
	return view('adminpages.change_password');
}
public function aboutus() {
	return view('mobile.aboutus');
}

}
