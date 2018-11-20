<?php

namespace App\Http\Controllers;
use App\Language;
use App\Activity_log;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Session;
use Validator;
use Image;
use DB;
use Illuminate\Support\Facades\Input;
use App\Attempt;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
    public function index()
	{
		$lang = Language::query()
								->select('*')
								->get();
								/* print_r($lang);exit; */
		return view('adminpages.language.index')->with('deatils',$lang);
	}
	public function language_craete(Request $request)
	{
			if(!empty($request->input()))
			{
			$rules = [
			'name_in_eng'=>'required',
			'name_in_nat'=>'required',
			'language_code'=>'required'
			];
			$attributeNames = array(
					'name_in_eng' => 'Name In English',
					'name_in_nat' => 'Name In Native',
					'language_code'=>'Language Code'
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
			$lang = new Language;
			$lang->name_in_english =  $request->name_in_eng;
			$lang->name_in_native =  $request->name_in_nat;
			$lang->language_code =  $request->language_code;
			$lang->is_active = 1;
			$lang->created_by = Auth::user()->user_id;
			$lang->created_at = Carbon::now();
			$lang->updated_by = Auth::user()->user_id;
			$lang->updated_at = Carbon::now();
			$lang->save();
			
					$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Create Language";
					$log->is_active =1;
					$log->created_by = Auth::user()->user_id;
					$log->updated_by = Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
			
			
			Session::flash('success',"Language Created successfully");
			}
		return redirect('language');
		}
		return view('adminpages.language.languageadd');
	}
	public function language_edit($id)
	{
		$lid = decrypt($id);
		
		$lang = Language::query()
								->select('*')
								->where('language_id',$lid)
								->get();
			return view('adminpages.language.languageedit')->with('language',$lang);
	}
	public function language_update(Request $request,$id)
	{
		$lid = decrypt($id);
		$rules = [
			'name_in_eng'=>'required',
			'name_in_nat'=>'required',
			'language_code'=>'required'
			];
			$attributeNames = array(
					'name_in_eng' => 'Name In English',
					'name_in_nat' => 'Name In Native',
					'language_code'=>'Language Code'
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
		$lang = Language::query()
								->where('language_id',$lid)
								->update(['name_in_english'=>$request->name_in_eng,
										  'name_in_native'=>$request->name_in_nat,
										  'language_code'=>$request->language_code
											]);
											
											
											
					$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Updated Language";
					$log->is_active =1;
					$log->created_by = Auth::user()->user_id;
					$log->updated_by = Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
			}
		Session::flash('success',"Language Updated successfully");
		return redirect('language');
	}
	public function language_delete($id)
	{
		$lid = decrypt($id);
		
		$lang = Language::query()
								->where('language_id',$lid)
								->delete();
			Session::flash('success',"Language Deleted successfully");
			return redirect('language');
	}
	
	public function language_active(Request $request)
	{
		$lid = $request->id;
		$status = $request->status;
		
					$lang = Language::query()
								->where('language_id',$lid)
								->update([
											'is_active'=>$status,
											'updated_at'=>Carbon::now()
											]);
											
					$lang = Language::query()
								->select('*')
								->where('language_id',$lid)
								->get();
				echo $lang[0]->is_active;
	}
	public function lang_single(Request $request)
	{
		$lid = $request->lid;
		// echo $lid;exit;
		$lang = Language::query()
								->select('*')
								->where('language_id',$lid)
								->get();
								
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name In English:</label>".$lang[0]->name_in_english."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name in Native:</label>".$lang[0]->name_in_native."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Language Code:</label>".$lang[0]->	language_code."</div></div></div>";
	}
}
