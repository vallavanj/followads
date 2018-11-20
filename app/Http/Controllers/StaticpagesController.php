<?php

namespace App\Http\Controllers;
use App\Staticpages;
use App\Activity_log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Session;
use Validator;
use Image;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class StaticpagesController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
    public function index()
	{
		$staticpages =  Staticpages::query()
										->select('*')
										->get();
					return view('adminpages.staticpages.index')->with('deatils',$staticpages);
	}
	public function static_pages_create(Request $request)
	{
		if(!empty($request->input()))
		{
			$staticpages =  new Staticpages;
			$staticpages->page_title = $request->page_title;
			$staticpages->page_content = strip_tags($request->content);
			$staticpages->is_active = 1;
			$staticpages->created_by = Auth::user()->user_id;
			$staticpages->created_at = Carbon::now();
			$staticpages->updated_by = Auth::user()->user_id;
			$staticpages->updated_at = Carbon::now();
			$staticpages->save();
			
			
			$log = new Activity_log;
			$log->user_id = Auth::user()->user_id;
			$log->activity_code = $request->activity_Code;
			$log->detail = "Created Static Pages";
			$log->is_active =1;
			$log->created_by = Auth::user()->user_id;
			$log->updated_by = Auth::user()->user_id;
			$log->created_at = Carbon::now();
			$log->updated_at = Carbon::now();
					
			$log->save();
			
			Session::flash('success',"Static Pages Created successfully");
					
			return redirect('static_pages');
		}
		return view('adminpages.staticpages.staticpagesadd');
	}
	public function static_pages_edit($id)
	{
		$s_pages_id = decrypt($id);
		$staticpages =  Staticpages::query()
										->select('*')
										->where('page_id',$s_pages_id)
										->get();
			return view('adminpages.staticpages.staticpagesedit')->with('deatils',$staticpages);
	}
	public function static_pages_update(Request $request,$id)
	{
		$s_pages_id = decrypt($id);
		$staticpages =  Staticpages::query()
										->where('page_id',$s_pages_id)
										->update([
													'page_title' => $request->page_title,
													'page_content' => strip_tags($request->content),
													'updated_by' => Auth::user()->user_id,
													'updated_at' => Carbon::now()
												]);
												
		$log = new Activity_log;
			$log->user_id = Auth::user()->user_id;
			$log->activity_code = $request->activity_Code;
			$log->detail = "Created Static Pages";
			$log->is_active =1;
			$log->created_by = Auth::user()->user_id;
			$log->updated_by = Auth::user()->user_id;
			$log->created_at = Carbon::now();
			$log->updated_at = Carbon::now();
					
			$log->save();
												
			Session::flash('success',"Static Pages Updated successfully");
					
			return redirect('static_pages');
	}
	public function static_pages_delete($id)
	{
		$s_pages_id = decrypt($id);
		$staticpages =  Staticpages::query()
										->where('page_id',$s_pages_id)
										->delete();
			Session::flash('success',"Static Pages Deleted successfully");
					
			return redirect('static_pages');
	}

	public function single_view(Request $request)
	{
		/* echo "fgghdgh";exit; */
		$wid = $request->uid;
		$staticpages = Staticpages::query()
												->select('*')
												->where('page_id',$wid)
												->get();
					$content = Str_limit($staticpages[0]->page_content, 25);
				
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Page Title:</label>".$staticpages[0]->page_title."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Page Content:</label>".$content."</div></div></div>";
	}
	public function single_active(Request $request)
	{
		/* echo "dfsr";exit; */
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$staticpages = Staticpages::query()
								->where('page_id',$id)
								->update([
										'is_active'=>$status,
										'updated_at'=>Carbon::now()
									]);
		$staticpages_status = Staticpages::query()
								->select('*')
								->where('page_id',$id)
								->get();
			echo $staticpages_status[0]->is_active;
	}
}
