<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\Business_Address;
use App\Business_Category;
use App\Categories;
use App\Advertisment;
use App\Advertisment_Category;
use App\Advertisement_Description;
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
use Illuminate\Http\Request;

class Adevertisement_DescriptionController extends Controller
{
    public function index()
	{
		$adv_desc = Advertisement_Description::query()
												->select('*')
												->orderBy('updated_at','desc')
												->get();
		$lang = Language::query()
							->select('*')
							->get();
				return view('adminpages.advertisment_desc.index',compact('adv_desc','lang'));
	}
	public function adv_desc_create(Request $request)
	{
		if(!empty($request->input()))
		{
			$rules = [
			'ads_name' => 'required',
			'desc' => 'required',
			'language_name' => 'required',
			];
			$attributeNames = array(
					'ads_name' => 'Advertisement Name',
					'desc' => 'Description',
					'language_name' => 'Language Name',
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
						$adv_desc = new Advertisement_Description;
						$adv_desc->advertisement_id = $request->ads_name;
						$adv_desc->description = $request->desc;
						$adv_desc->caption = $request->caption;
						$adv_desc->language_id = $request->language_name;
						$adv_desc->is_active = 1;
						$adv_desc->created_by = 1;
						$adv_desc->created_at = Carbon::now();
						$adv_desc->updated_by = 1;
						$adv_desc->updated_at = Carbon::now();
						$adv_desc->save();
						
						
						
						Session::flash('success',"Advertisment Description Created successfully");
											return redirect('adv_desc');
					}
		}
		$lang = Language::query()
							->select('*')
							->get();
							
	  $adv = Advertisment::query()
								->select('*')
								->get();
		return view('adminpages.advertisment_desc.adv_descadd',compact('lang','adv'));
	}
	public function adv_desc_view($id)
	{
		$id = decrypt($id);
		$adv_desc = Advertisement_Description::query()
												->select('*')
												->where('advertisement_descriptions_id',$id)
												->get();
		$lang = Language::query()
							->select('*')
							->get();
		 $adv = Advertisment::query()
								->select('*')
								->get();
		return view('adminpages.advertisment_desc.adv_descedit',compact('lang','adv_desc','adv'));
	}
	public function adv_desc_update(Request $request,$id)
	{
		$id = decrypt($id);
		$rules = [
			'ads_name' => 'required',
			'desc' => 'required',
			'language_name' => 'required',
			];
			$attributeNames = array(
					'ads_name' => 'Advertisement Name',
					'desc' => 'Description',
					'language_name' => 'Language Name',
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
						$adv_desc = Advertisement_Description::query()
																->where('advertisement_descriptions_id',$id)
																->update([
																'advertisement_id'=>$request->ads_name,
																'description' => $request->desc,
																'caption' => $request->caption,
																'language_id' => $request->language_name,
																'updated_at' => Carbon::now()
																]);
																
						
														
							Session::flash('success',"Advertisment Description Updated successfully");
												return redirect('adv_desc');
					}
	}
	public function adv_desc_delete(Request $request,$id)
	{
		$id = decrypt($id);
		$adv_desc = Advertisement_Description::query()
												->where('advertisement_descriptions_id',$id)
												->delete();
						
			Session::flash('success',"Advertisment Description Deleted successfully");
								return redirect('adv_desc');
		
	}
	public function adv_desc_single(Request $request)
	{
		$id = $request->uid;
		/* echo $id;exit; */
		$adv_desc = Advertisement_Description::query()
												->select('*')
												->where('advertisement_descriptions_id',$id)
												->get();
		$lang = Language::query()
							->select('*')
							->get();
				$lang_name = "";
				foreach($lang as $lan)
				{
					if($lan->language_id == $adv_desc[0]->language_id)
					{
						$lang_name = $lan->	name_in_english;
					}						
				}
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Advertisment Name:</label>".$adv_desc[0]->advertisement_id."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Description:</label>".$adv_desc[0]->description."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Caption:</label>".$adv_desc[0]->caption."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Language:</label>".$lang_name."</div></div></div>";
	}
	public function adv_desc_activestatus(Request $request)
	{
		$id = $request->id;
		$status = $request->status;
		$adv_desc = Advertisement_Description::query()
												->where('advertisement_descriptions_id',$id)
												->update([
												'is_active'=>$status,
												'updated_at'=>Carbon::now()
												]);
												
		
												
												
		$adv_desc_1 = Advertisement_Description::query()
												->select('*')
												->where('advertisement_descriptions_id',$id)
												->get();
			echo $adv_desc_1[0]->is_active;
			
			
	}
}
