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

class Advertisement_ImageController extends Controller
{
   public function index()
   {
	   $adv_img = Advertisement_Image::query()
										->select('*')
										->orderBy('updated_at','desc')
										->get();
		$lang = Language::query()
							->select('*')
							->get();
		return view('adminpages.advertisment_image.index',compact('adv_img','lang'));
   }
   public function adv_image_create(Request $request)
   {
	   if(!empty($request->input()))
	   {
		   
		   $adv_img = new Advertisement_Image;
		   $rules = [
			'ads_name' => 'required',
			'language_name' => 'required',
			];
			$attributeNames = array(
					'ads_name' => 'Advertisement Name',
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
				   $adv_img->advertisement_id = $request->ads_name;
				   $adv_img->sequence_no = rand(1000,10);
				   $adv_img->language_id = $request->language_name;
				   $adv_img->image_url = 0;
				   $adv_img->is_active = 1;
				   $adv_img->created_by = 1;
				   $adv_img->created_at = Carbon::now();
				   $adv_img->updated_by = 1;
				   $adv_img->updated_at = Carbon::now();
		  
				if($adv_img->save())
				{
					$inserted_id = $adv_img->id;
					
					$path='advertisement_images/uploads/doc/'.$inserted_id;
													if (!is_dir($path)) {
														mkdir($path, 0777, TRUE);
														}
					$profile = $request->File('ads_image');
												$filename = time().'.'.$profile->getClientOriginalExtension();
												$file = time().''.$profile->getClientOriginalName();
												$location_1 = public_path($path.'/'.$file);
												Image::make($profile)->save($location_1);
												$business_update = Advertisement_Image::query()
																			->where('advertisement_image_id','=',$inserted_id)
																			->update(['image_url' =>$file,
																			]);
																			
						
					
							Session::flash('success',"Advertisement Image Created successfully");
								return redirect('ads_image');
				}
			} 
	   }
	     $ads =  Advertisment::query()
									->select('*')
									->get();
	   $lang = Language::query()
							->select('*')
							->get();
	   return view('adminpages.advertisment_image.adv_imgadd',compact('lang','ads'));
   }
   public function adv_image_view($id)
   {
	    $id = decrypt($id);
	   $adv_img = Advertisement_Image::query()
										->select('*')
										->where('advertisement_image_id',$id)
										->get();
										
		$lang = Language::query()
							->select('*')
							->get();
		 $ads =  Advertisment::query()
									->select('*')
									->get();
			return view('adminpages.advertisment_image.adv_imgedit',compact('adv_img','lang','ads'));
   }
   public function adv_image_update(Request $request,$id)
   {
	    $id = decrypt($id);
	   if($request->hasFile('ads_image'))
	   {
	   $path='advertisement_images/uploads/doc/'.$id;
												if (!is_dir($path)) {
													mkdir($path, 0777, TRUE);
													}
				$profile = $request->File('ads_image');
											$filename = time().'.'.$profile->getClientOriginalExtension();
											$file = time().''.$profile->getClientOriginalName();
											$location_1 = public_path($path.'/'.$file);
											Image::make($profile)->save($location_1);
											$adv_img = Advertisement_Image::query()
																		->where('advertisement_image_id','=',$id)
																		->update([
																		'image_url' =>$file,
																		'advertisement_id'=>$request->ads_name,
																		'language_id'=>$request->language_name,
																		'updated_at'=>Carbon::now()
																		]);
																		
						
																		
		
						Session::flash('success',"Advertisement Image Updated successfully");
							return redirect('ads_image');
	   }
	   else
	   {
		    $adv_img = Advertisement_Image::query()
										->select('*')
										->where('advertisement_image_id',$id)
										->update([
										'advertisement_id'=>$request->ads_name,
										'language_id'=>$request->language_name,
										'updated_at'=>Carbon::now()
										]); 
							
						
						
				Session::flash('success',"Advertisement Image Updated successfully");
							return redirect('ads_image');
	   }
   }
   public function adv_image_delete($id)
   {
	   $id = decrypt($id);
	    $adv_img = Advertisement_Image::query()
										->where('advertisement_image_id',$id)
										->delete();
										
						
										
			Session::flash('success',"Advertisement Image Deleted successfully");
							return redirect('ads_image');
   }
   public function adv_image_single(Request $request)
   {
	   $id = $request->uid;
	   /* echo $id;exit; */
	    $adv_img = Advertisement_Image::query()
										->select('*')
										->where('advertisement_image_id',$id)
										->get();
			$lang = Language::query()
							->select('*')
							->get();
				$lang_name = "";
				foreach($lang as $lan)
				{
					if($lan->language_id == $adv_img[0]->language_id)
					{
						$lang_name = $lan->	name_in_english;
					}						
				}
			$path='advertisement_images/uploads/doc/'.$adv_img[0]->advertisement_image_id .'/'.$adv_img[0]->image_url ;
			$image = url($path);
			$image_url = "<img src=".$image." width='50px' height='50px' class='img-circle'>";
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Advertisment Name:</label>".$adv_img[0]->advertisement_id."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Description:</label>".$image_url."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Caption:</label>".$adv_img[0]->sequence_no."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Language:</label>".$lang_name."</div></div></div>";
   }
   public function adv_image_activestatus(Request $request)
   {
	   $id = $request->id;
	   $status = $request->status;
	  /*  echo $status; */
	    $adv_img = Advertisement_Image::query()
										->where('advertisement_image_id',$id)
										->update([
										'is_active'=>$status,
										'updated_at'=>Carbon::now()
										]);
										
										
	    $adv_img_1 = Advertisement_Image::query()
										->select('*')
										->where('advertisement_image_id',$id)
										->get();
			echo  $adv_img_1[0]->is_active;
   }
}
