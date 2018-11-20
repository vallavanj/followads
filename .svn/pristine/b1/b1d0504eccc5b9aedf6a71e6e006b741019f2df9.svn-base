<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use App\Internaluser;
use App\Language;
use App\User_feedback;
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
use Illuminate\Support\Facades\Redirect;

class User_feedbackController extends Controller
{
   
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
	public function index()
	{
		$userfeedback = User_feedback::query()
										->select('*')
										->get();
										
		$users = User::query()
						->select('*')
						->get();
				return view('adminpages.userfeedback.index',compact('userfeedback','users'));
	}
	public function users_feedbackadd(Request $request)
	{
		if(!empty($request->input()))
		{
			$rules = [
			'feedback_subject'=>'required'
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$u_feedback = new User_feedback;
				$u_feedback->users_id = 1;
				$u_feedback->feedback_subject = $request->feedback_subject;
				$u_feedback->feedback_description = $request->feedback_description;
				$u_feedback->feedback_status_code = $request->feedback_status;
				$u_feedback->is_active = 1;
				$u_feedback->created_by = 1;
				$u_feedback->created_at = Carbon::now();
				$u_feedback->updated_by = 1;
				$u_feedback->updated_at = Carbon::now();
				$u_feedback->save();
				Session::flash('success',"Users Feedback Added successfully");
				return redirect('users_feedback');
			}
		}
		return view('adminpages.userfeedback.userfeedbackadd');
	}
	public function users_feedbackedit($id)
	{
		$uf_id = decrypt($id);
		$u_feedback = User_feedback::query()
										->select('*')
										->where('users_feedback_id',$uf_id)
										->get();
				return view('adminpages.userfeedback.userfeedbackedit')->with('userfeedback',$u_feedback);
		
	}
	public function users_feedbackupdate(Request $request,$id)
	{
		$uf_id = decrypt($id);
		$u_feedback = User_feedback::query()
										->where('users_feedback_id',$uf_id)
										->update([
													'feedback_subject' => $request->feedback_subject,
													'feedback_description' => $request->feedback_description,
													'feedback_status_code' => $request->feedback_status,
													'updated_by' => 1,
													'updated_at' => Carbon::now()
												]);
					Session::flash('success',"Users Feedback Updated successfully");
					return redirect('users_feedback');
	}
	public function users_feedbackdelete($id)
	{
		$uf_id = decrypt($id);
		$u_feedback = User_feedback::query()
										->where('users_feedback_id',$uf_id)
										->delete();
					Session::flash('success',"Users Feedback Updated successfully");
					return redirect('users_feedback');
	}
	public function userfeedback_single(Request $request)
	{
		$uf_id = $request->uid;
		/* echo $uf_id;exit; */
		$u_feedback = User_feedback::query()
										->select('*')
										->where('users_feedback_id',$uf_id)
										->get();
		$user = User::query()
						->select('*')
						->get();
						/* print_r($user);exit; */
				$user_name =""; 
				foreach($user as $users)
				{
					if($users->user_id == $u_feedback[0]->users_id)
					{
						$user_name = $users->name;
					}
				}
				/* echo $user_name;exit; */
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>User Name:</label>".$user_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Feedback Subject:</label>".$u_feedback[0]->feedback_subject."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Feedback Description:</label>".$u_feedback[0]->feedback_description."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Feedback Status Code:</label>".$u_feedback[0]->feedback_status_code."</div></div></div>";
	}
	public function userfeedback_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$user = User_feedback::query()
							->where('users_feedback_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
			$user_status = User_feedback::query()
							->select('*')
							->where('users_feedback_id',$id)
							->get();
				echo $user_status[0]->is_active;
	}
}
