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
use App\Advertisement_Offer_Code;
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

class Advertisement_Offer_CodeController  extends Controller
{
    public function index()
   {
	   $adv_img = Advertisement_Offer_Code::query()
										->select('*')
										->orderBy('updated_at','desc')
										->get();
		$lang = Language::query()
							->select('*')
							->get();
		return view('adminpages.advertisement_offer_code.index',compact('adv_img','lang'));
   }
   public function ads_offer_create(Request $request)
   {
	   if(!empty($request->input()))
	   {
		   
		   $adv_img = new Advertisement_Offer_Code;
		   $rules = [
			'ads_name' => 'required',
			'offer_code' => 'required',
			'offer_type_code' => 'required',
			];
			$attributeNames = array(
					'ads_name' => 'Advertisement Name',
					'offer_code' => 'Offer Code',
					'offer_type_code' => 'Offer Type Code',
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
				   $adv_img->offer_code = $request->offer_code;
				   $adv_img->offer_type_code = $request->offer_type_code;
				   $adv_img->is_active = 1;
				   $adv_img->created_by = 1;
				   $adv_img->created_at = Carbon::now();
				   $adv_img->updated_by = 1;
				   $adv_img->updated_at = Carbon::now();
		  
				    $adv_img->save(); 
					
						
					
					
			Session::flash('success',"Advertisement Offer Code Created successfully");
							return redirect('ads_offer');
			} 
	   }
	     $adv =  Advertisment::query()
									->select('*')
									->get();
	   return view('adminpages.advertisement_offer_code.adv_offeradd',compact('adv'));
   }
   public function ads_offer_view($id)
   {
	    $id = decrypt($id);
	   $adv_img = Advertisement_Offer_Code::query()
										->select('*')
										->where('advertisement_offer_code_id',$id)
										->get();
										
		
		 $adv =  Advertisment::query()
									->select('*')
									->get();
			return view('adminpages.advertisement_offer_code.adv_offeredit',compact('adv_img','adv'));
   }
   public function ads_offer_update(Request $request,$id)
   {
	    $id = decrypt($id);
	   $rules = [
			'ads_name' => 'required',
			'offer_code' => 'required',
			'offer_type_code' => 'required',
			];
			$attributeNames = array(
					'ads_name' => 'Advertisement Name',
					'offer_code' => 'Offer Code',
					'offer_type_code' => 'Offer Type Code',
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
							$adv_img = Advertisement_Offer_Code::query()
														->select('*')
														->where('advertisement_offer_code_id',$id)
														->update([
														'advertisement_id'=>$request->ads_name,
														'offer_code' => $request->offer_code,
														'offer_type_code' => $request->offer_type_code,
														'updated_at'=>Carbon::now()
														]);
													
													
						
													
						Session::flash('success',"Advertisement Offer Code  Updated successfully");
						return redirect('ads_offer');
					}
	   
   }
   public function ads_offer_delete(Request $request,$id)
   {
	   $id = decrypt($id);
	    $adv_img = Advertisement_Offer_Code::query()
										->where('advertisement_offer_code_id',$id)
										->delete();
						
										
			Session::flash('success',"Advertisement Offer Code Deleted successfully");
							return redirect('ads_offer');
   }
   public function ads_offer_single(Request $request)
   {
	   $id = $request->uid;
	   /* echo $id;exit; */
	    $adv_img = Advertisement_Offer_Code::query()
										->select('*')
										->where('advertisement_offer_code_id',$id)
										->get();
			
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Advertisment Name:</label>".$adv_img[0]->advertisement_id."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Offer Code:</label>".$adv_img[0]->offer_code."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Offer Type Code:</label>".$adv_img[0]->offer_type_code."</div></div></div>";
   }
   public function ads_offer_activestatus(Request $request)
   {
	   $id = $request->id;
	   $status = $request->status;
	  /*  echo $status; */
	    $adv_img = Advertisement_Offer_Code::query()
										->where('advertisement_offer_code_id',$id)
										->update([
										'is_active'=>$status,
										'updated_at'=>Carbon::now()
										]);
										
		
		
	    $adv_img_1 = Advertisement_Offer_Code::query()
										->select('*')
										->where('advertisement_offer_code_id',$id)
										->get();
			echo  $adv_img_1[0]->is_active;
   }
}
?>