<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Internaluser;
use App\Wallet;
use App\Language;
use App\Activity_log;
use Session;
use Image;
use Hash;
use Validator;
use DB;
use App\Attempt;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class UserController extends Controller
{
    public function __construct()
	{
		/* echo "dfhskj";exit; */
		/* dd(Auth::check());exit; */
		
				$this->middleware('auth');
	}
	
	public function index(Request $request)
	{
		$deatils = DB::table('users')
						->select('int_usr.user_type_code','int_usr.internal_user_id','users.*')
						->join('internal_user as int_usr','users.user_id','=','int_usr.user_id')
						->where('int_usr.user_type_code','!=',"") //its showing only admin users.
						->orderBy('users.updated_at','desc')
						->get();
		$language =  Language::query()
									->select('*')
									->where('is_active','=',1)
									->get();
		return view('adminpages.user.index',compact('deatils','language'));
	}
	
    public function createuser(Request $request)
	{
		/* print_r($_POST);exit; */
		if(!empty($request->input()))
		{
				$user = new User;
				if($request->hasFile('profile'))
				{
						$location = array(
						'lat'=>$request->lat,
						'lan'=>$request->longt,
						);
						
						 $location1 = json_encode($location);
						if(empty($request->email))
						{
							$email = rand();
						}
						else
						{
							$email = $request->email;
						}
						$user->name = $request->name;
						$user->email = $email;
						$user->default_location = $location1;
						$user->default_language_id = $request->default_language;
						$user->mobile_number = $request->mobile;
						$user->phone_verified = 0;
						$user->is_active = 1;
						$user->created_by =  Auth::user()->user_id;
						$user->created_at = Carbon::now();
						$user->updated_by =  Auth::user()->user_id;
						$user->updated_at = Carbon::now();
						$user->remember_token =$request->_token;
					
						if($user->save())
						{
							$inserted_id = $user->user_id;
							/* echo $inserted_id;exit; */
							$path='profile/uploads/doc/'.$inserted_id;
								if (!is_dir($path)) {
									mkdir($path, 0777, TRUE);
									}
							$profile = $request->File('profile');
							$filename = time().'.'.$profile->getClientOriginalExtension();
							$file = time().''.$profile->getClientOriginalName();
							$location_1 = public_path($path.'/'.$file);
							Image::make($profile)->save($location_1);
							$user_update = User::query()
														->where('user_id','=',$inserted_id)
														->update(['profile_img_url' =>$file]);
							/* Internal users */
							$i_user = new Internaluser;
							$i_user->password =  Hash::make(Input::get('password'));
							$i_user->user_id = $inserted_id;
							/* $i_user->user_type_code = 'ad'; */
							$i_user->user_type_code = $request->user_type_code; 
							$i_user->display_name = $request->name;
							$i_user->is_active = 1;
							$i_user->created_by =  Auth::user()->user_id;
							$i_user->created_at = Carbon::now();
							$i_user->updated_by =  Auth::user()->user_id;
							$i_user->updated_at = Carbon::now();
							$i_user->save();
							
						/* Wallet */
						$wallet = new Wallet;
						$wallet->balance = 0; 
						$wallet->users_id = $inserted_id; 
						$wallet->is_active = 1; 
						$wallet->created_at = Carbon::now(); 
						$wallet->updated_at = Carbon::now(); 
						$wallet->updated_at =  Auth::user()->user_id; 
						$wallet->created_by =  Auth::user()->user_id; 
						$wallet->save(); 
							
					$log = new Activity_log;
					$log->user_id = $inserted_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "User Register";
					$log->is_active =1;
					$log->created_by =  Auth::user()->user_id;
					$log->updated_by =  Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					$log->save();
						Session::flash('success',"Registered successfully");
						return redirect('user');
						}
					
				}
				else
				{
					
						
						$location = array(
						'lat'=>$request->lat,
						'lan'=>$request->longt,
						);
						
						 $location1 = json_encode($location);
						if(empty($request->email))
						{
							$email = rand();
						}
						else
						{
							$email = $request->email;
						}
						
						$user->name = $request->name;
						$user->email = $email;
						$user->default_location = $location1;
						$user->default_language_id = $request->default_language;
						$user->mobile_number = $request->mobile;
						/* $user->user_type = 2; */
						/* $user->store_id  = 2; */
						$user->phone_verified = 0;
						$user->is_active = 1;
						$user->created_by = Auth::user()->user_id;
						$user->created_at = Carbon::now();
						$user->updated_by =  Auth::user()->user_id;
						$user->updated_at = Carbon::now();
						/* $user->password = Hash::make($request->password); */
						/* $user->password = Hash::make(Input::get('password')); */
						$user->remember_token =$request->_token;
					
						if($user->save());
						{
							$inserted_id = $user->user_id;
						/* Internal users */
							$i_user = new Internaluser;
							$i_user->password =  Hash::make(Input::get('password'));
							$i_user->user_id = $inserted_id;
							/* $i_user->user_type_code = 'ad'; */
							$i_user->user_type_code = $request->user_type_code; 
							$i_user->display_name = $request->name;
							$i_user->is_active = 1;
							$i_user->created_by =  Auth::user()->user_id;
							$i_user->created_at = Carbon::now();
							$i_user->updated_by =  Auth::user()->user_id;
							$i_user->updated_at = Carbon::now();
							$i_user->save();
							
							$wallet = new Wallet;
							$wallet->balance = 0;
							$wallet->users_id = $inserted_id;
							$wallet->is_active = 1; 
							$wallet->created_at = Carbon::now(); 
							$wallet->updated_at = Carbon::now(); 
							$wallet->updated_by = Auth::user()->user_id; 
							$wallet->created_by = Auth::user()->user_id; 
							$wallet->save(); 
							
							
							$log = new Activity_log;
							$log->user_id =$inserted_id;
							$log->activity_code = $request->activity_Code;
							$log->detail = "User Register";
							$log->is_active =1;
							$log->created_by = Auth::user()->user_id;
							$log->updated_by =  Auth::user()->user_id;
							$log->created_at = Carbon::now();
							$log->updated_at = Carbon::now();
							
							$log->save();
						}
						Session::flash('success',"Registered successfully");
						return redirect('user');
					
				}
		
		}
		$language =  Language::query()
									->select('*')
									->where('is_active','=',1)
									->get();
							/* echo"<pre>";
							print_r($language);exit; */
		
		return view('adminpages.user.useradd')->with('language',$language);
	}
	
	public function edituser($id)
	{
		$id = decrypt($id);
		/* echo $id;exit; */
		$users = DB::table('users')
						->select('*')
						->where('user_id',$id)
						->get();
		$inter_user = DB::table('internal_user')
												->select('*')
												->where('user_id',$id)
												->get();
			$language =  Language::query()
									->select('*')
									->where('is_active','=',1)
									->get();
		return view('adminpages.user.useredit',compact('users','language','inter_user'));
		
	}
	
	public function updateuser(Request $request,$id)
	{
		/* print_r($_POST);exit; */
		$id = decrypt($id); 
		/* echo $id;exit; */
		/* print_r($_POST);exit; */
		if($request->hasFile('profile'))
		{
			 $rules = [
			'name'=>'required',
			/* 'email'=>'required|email', */
			'mobile'=>'required',
			/* 'password' =>'required|min:8' */
			];
			$attributeNames = array(
					'name' => 'Name',
					/* 'email' => 'Email', */
					'mobile'=>'Mobile Number',
						);
			$validate = Validator::make($request->all(),$rules);
			$validate->setAttributeNames($attributeNames);
			if($validate->fails())
			{
		/* 	echo $id;exit; */
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
			/* echo $id;exit; */
			$location = array(
						'lat'=>$request->lat,
						'lan'=>$request->longt,
						);
						
			 $location1 = json_encode($location);
			 
			 if(empty($request->email))
				{
					$email = rand();
				}
				else
				{
					$email = $request->email;
				}
			 
			$path='profile/uploads/doc/'.$id;
					if (!is_dir($path)) {
						mkdir($path, 0777, TRUE);
						}
				$profile = $request->File('profile');
				$filename = time().'.'.$profile->getClientOriginalExtension();
				$file = time().''.$profile->getClientOriginalName();
				$location_1 = public_path($path.'/'.$file);
				Image::make($profile)->save($location_1);
				$user_update = User::query()
											->where('user_id','=',$id)
											->update([
											'name'=>$request->name,
											'email'=>$email,
											'default_location'=>$location1,
											'default_language_id'=>$request->default_language,
											'mobile_number'=>$request->mobile,
											'updated_at' => Carbon::now(),
											'profile_img_url' =>$file
											]);
											
				$user_internal = Internaluser::query()
													->where('user_id','=',$id)
													->update(['user_type_code'=>$request->user_type_code]);
											
					$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Update User";
					$log->is_active =1;
					$log->created_by = 1;
					$log->updated_by = 1;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
			}
		}
		else
		{
			/* print_r($_POST);exit; */
			 $rules = [
			'name'=>'required',
			/* 'email'=>'required|email', */
			'mobile'=>'required',
			/* 'password' =>'required|min:8', */
			];
			$attributeNames = array(
					'name' => 'Name',
					/* 'email' => 'Email', */
					'mobile'=>'Mobile Number',
						);
			$validate = Validator::make($request->all(),$rules);
			$validate->setAttributeNames($attributeNames);
			if($validate->fails())
			{
				/* echo $id;exit; */
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$location = array(
						'lat'=>$request->lat,
						'lan'=>$request->longt,
						);
						
			 $location1 = json_encode($location);
				
				if(empty($request->email))
				{
					$email = rand();
				}
				else
				{
					$email = $request->email;
				}
				
				
		$user = DB::table('users')
						->where('user_id',$id)
						->update([
						'name'=>$request->name,
						'email'=>$email,
						'default_location'=>$location1,
						'default_language_id'=>$request->default_language,
						'mobile_number'=>$request->mobile,
						'updated_at' => Carbon::now()
						]);
						
		$user_internal = Internaluser::query()
											->where('user_id','=',$id)
											->update(['user_type_code'=>$request->user_type_code]);
						
			$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Update User";
					$log->is_active =1;
					$log->created_by = 1;
					$log->updated_by = 1;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
			}
		}
		Session::flash('success',"Updated successfully");
		return redirect('user');
	}
	
	public function user_delete(Request $request,$id)
	{
		$id = decrypt($id);
		$user = DB::table('users')
						->where('user_id',$id)
						->delete();
		$i_user = Internaluser::query()
						->where('user_id',$id)
						->delete();
						
			$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Deleted User";
					$log->is_active =1;
					$log->created_by = 1;
					$log->updated_by = 1;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
			Session::flash('success',"Deleted successfully");
			return redirect('user');
	}
	
	public function user_single_view(Request $request)
	{
		$id = $request->uid;
		
		$user = DB::table('users')
						->select('users.*',DB::raw('group_concat(language.name_in_english) as language'))
						->join('language','language.language_id','=','users.default_language_id')
						->where('user_id',$id)
						->get();
						
		$i_user = Internaluser::query()
								->select('*')
								->where('user_id',$id)
								->get();
						/* echo $request->uid;
						print_r($user);exit; */
			$path='profile/uploads/doc/'.$user[0]->user_id.'/'.$user[0]->profile_img_url;
			if(!($user[0]->profile_img_url)) 
			{
				$image_url = 'No image available';
			}
			else
			{
				if(file_exists($path))
				{
				$image = url($path);
				$image_url = "<img src=".$image." width='50px' height='50px' class='img-circle'>";
				}
				else
				{
					$image_url = 'No image available';
				}
			}
			if(is_numeric($user[0]->email))
			{
				$email = "";
			}
			else
			{
				$email = $user[0]->email;
			}
			
			if($i_user[0]->user_type_code == 'sa')
			{
				$user_type = 'Super Admin';
			}
			else if($i_user[0]->user_type_code == 'ad')
			{
				$user_type = 'Admin';
			}
			else if($i_user[0]->user_type_code == 'iu')
			{
				$user_type = 'Internal User';
			}
			else
			{
				$user_type = '';
			}
	
			$location = json_decode($user[0]->default_location,true);
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$user[0]->name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Email:</label>".$email."</div><!--<div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Location:</label>Latitude:".round($location['lat'],3)." , Longitude:". round($location['lan'],3)."</div> --><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Language:</label>".$user[0]->language."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>User Type:</label>".$user_type."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Mobile:</label>".$user[0]->mobile_number."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Profile:</label>".$image_url."</div></div></div>";
	}
	public function user_single_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$user = User::query()
							->where('user_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
		$i_user = Internaluser::query()
								->where('user_id',$id)
								->update([
								'is_active'=>$status,
								'updated_at'=>Carbon::now()
								]);
								
			$user_status = User::query()
							->select('*')
							->where('user_id',$id)
							->get();
				echo $user_status[0]->is_active;
	}
	
	public function user_email_unique(Request $request)
	{
		$email = $request->email;
		/* echo $email;exit; */
		if(!empty($email))
		{
			$user = User::query()
								->select('*')
								->where('email',$email)
								->get();
				/* print_r($user);exit; */
			if($user->isNotEmpty())
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "0";
		}
	}
	
	public function user_mobile_unique(Request $request)
	{
		
		$mobile = $request->mobile;
		/* echo $email;exit; */
		
		if(!empty($mobile))
		{
		$user = User::query()
							->select('*')
							->where('mobile_number',$mobile)
							->get();
			/* print_r($user);exit; */
		if($user->isNotEmpty())
		{
			echo "1";
		}
		else
		{
			echo "0";
		}				
							
		}
		else
		{
			echo "0";
		}
	}
	
	public function user_email_unique2(Request $request)
	{
		$email = $request->email;
		$user_id = $request->user_id;
		/*  echo $user_id;exit; */
		/* DB::enableQueryLog(); */ 
		if(!empty($email))
		{
			$user = User::query()
								->select('*')
								->where('email',$email)
								->where('user_id',$user_id)
								->get();
									/* $query = DB::getQueryLog();

								$query = end($query);
								print_r($query );exit; */ 
			if($user->isEmpty())
			{
				$user = User::query()
								->select('*')
								->where('email',$email)
								->get();
				if($user->isNotEmpty())
				{
				echo "1";
				}
				else
				{
				echo "0";
				}
			}
		}
		echo "0";
	}
		
	
	public function user_mobile_unique2(Request $request)
	{
		$mobile = $request->mobile;
		$user_id = $request->user_id;
		if(!empty($mobile))
		{
			$user = User::query()
								->select('*')
								->where('mobile_number',$mobile)
								->where('user_id',$user_id)
								->get();
				/* print_r($user);exit; */
			if($user->isEmpty())
			{
				$mobile = $request->mobile;
			/* echo $email;exit; */
				$user = User::query()
									->select('*')
									->where('mobile_number',$mobile)
									->get();
					/* print_r($user);exit; */
					if($user->isNotEmpty())
					{
						echo "1";
					}
					else
					{
						echo "0";
					}
			}
		}
		else
		{
			echo "0";
		}
	
	}
	
}
