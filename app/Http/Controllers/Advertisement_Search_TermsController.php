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
use App\Advertisement_Image;
use App\Advertisement_Search_Terms;
use App\Activity_log;
use App\Language;
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

class Advertisement_Search_TermsController extends Controller
{
    public function index()
   {
	   $adv_img = Advertisement_Search_Terms::query()
										->select('*')
										->orderBy('updated_at','desc')
										->get();
		$lang = Language::query()
							->select('*')
							->get();
		return view('adminpages.advertisment_search.index',compact('adv_img','lang'));
   }
   public function ad_search_create(Request $request)
   {
	   if(!empty($request->input()))
	   {
		   
		   $adv_img = new Advertisement_Search_Terms;
		   $rules = [
			'ads_name' => 'required',
			'search_term' => 'required',
			];
			$attributeNames = array(
					'ads_name' => 'Advertisement Name',
					'search_term' => 'Search Term',
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
				   $adv_img->advertisement_id = $request->ads_name;
				   $adv_img->search_term = $request->search_term;
				   $adv_img->is_active = 1;
				   $adv_img->created_by = 1;
				   $adv_img->created_at = Carbon::now();
				   $adv_img->updated_by = 1;
				   $adv_img->updated_at = Carbon::now();
		  
				  $adv_img->save();
					
						
					
					
					
			Session::flash('success',"Advertisement Search Created successfully");
							return redirect('ads_search');
			} 
	   }
	     $adv =  Advertisment::query()
									->select('*')
									->get();
	   return view('adminpages.advertisment_search.adv_searchadd',compact('adv'));
   }
   public function ad_search_view($id)
   {
	    $id = decrypt($id);
	   $adv_img = Advertisement_Search_Terms::query()
										->select('*')
										->where('advertisement_search_term_id',$id)
										->get();
										
		
		 $adv =  Advertisment::query()
									->select('*')
									->get();
			return view('adminpages.advertisment_search.adv_searchedit',compact('adv_img','adv'));
   }
   public function ad_search_update(Request $request,$id)
   {
	    $id = decrypt($id);
	   $rules = [
			'ads_name' => 'required',
			'search_term' => 'required',
			];
			$attributeNames = array(
					'ads_name' => 'Advertisement Name',
					'search_term' => 'Search Term',
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
						$adv_img = Advertisement_Search_Terms::query()
													->select('*')
													->where('advertisement_search_term_id',$id)
													->update([
													'advertisement_id'=>$request->ads_name,
													'search_term' => $request->search_term,
													'updated_at'=>Carbon::now()
													]); 
													
						
													
							Session::flash('success',"Advertisement Search  Updated successfully");
										return redirect('ads_search');
					}
	   
   }
   public function ad_search_delete(Request $request,$id)
   {
	   $id = decrypt($id);
	    $adv_img = Advertisement_Search_Terms::query()
										->where('advertisement_search_term_id',$id)
										->delete();
										
						
										
			Session::flash('success',"Advertisement Search  Deleted successfully");
							return redirect('ads_search');
   }
   public function ad_search_single(Request $request)
   {
	   $id = $request->uid;
	   /* echo $id;exit; */
	    $adv_img = Advertisement_Search_Terms::query()
										->select('*')
										->where('advertisement_search_term_id',$id)
										->get();
			
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Advertisment Name:</label>".$adv_img[0]->advertisement_id."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Search:</label>".$adv_img[0]->search_term."</div></div></div>";
   }
   public function ad_search_activestatus(Request $request)
   {
	   $id = $request->id;
	   $status = $request->status;
	  /*  echo $status; */
	    $adv_img = Advertisement_Search_Terms::query()
										->where('advertisement_search_term_id',$id)
										->update([
										'is_active'=>$status,
										'updated_at'=>Carbon::now()
										]);
								
		
								
	    $adv_img_1 = Advertisement_Search_Terms::query()
										->select('*')
										->where('advertisement_search_term_id',$id)
										->get();
			echo  $adv_img_1[0]->is_active;
   }
}
