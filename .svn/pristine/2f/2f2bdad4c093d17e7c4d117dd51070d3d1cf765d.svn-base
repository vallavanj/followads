<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\Business_Address;
use App\Business_Category;
use App\Business_image;
use App\Categories;
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

class Business_imageController extends Controller
{
   public function index()
   {
	   $buss_img = Business_image::query()
										->select('*')
										->orderBy('updated_at','desc')
										->get();
										
		$buss = Business::query()
									->select('*')
									->get();
				return view('adminpages.business_image.index',compact('buss_img','buss'));
   }
   public function business_image_create(Request $request)
   {
	   if(!empty($request->input()))
	   {
		   $rules = [
			'business_name' => 'required',
			];
			$attributeNames = array(
					'business_name' => 'Name',
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
						$buss_img = new  Business_image;
						
						$buss_img->business_id = $request->business_name;
						$buss_img->images_url = 0;
						$buss_img->sequence_no = rand(1000,10);
						$buss_img->is_active = 1;
						$buss_img->created_by = 1;
						$buss_img->created_at = Carbon::now();
						$buss_img->updated_by = 1;
						$buss_img->updated_at = Carbon::now();
						if($buss_img->save())
						{
							$inserted_id = $buss_img->id;
							$path='business_images/uploads/doc/'.$inserted_id;
												if (!is_dir($path)) {
													mkdir($path, 0777, TRUE);
													}
													
										$profile = $request->File('business_image');
											$filename = time().'.'.$profile->getClientOriginalExtension();
											$file = time().''.$profile->getClientOriginalName();
											$location_1 = public_path($path.'/'.$file);
											Image::make($profile)->save($location_1);
											$business_update = Business_image::query()
																		->where('business_images_id','=',$inserted_id)
																		->update(['images_url' =>$file,
																		]);
																		
																		
					
		
					
						Session::flash('success',"Business Image Created successfully");
							return redirect('buss_image');
						}
					}
	   }
	   $business = Business::query()
									->select('*')
									->get();
	   return view('adminpages.business_image.business_imgadd',compact('business'));
   }
   public function business_image_view($id)
   {
	   $id = decrypt($id);
	   $buss_img = Business_image::query()
										->select('*')
										->where('business_images_id',$id)
										->get();
		$buss = Business::query()
									->select('*')
									->get();
			return view('adminpages.business_image.business_imgedit',compact('buss_img','buss'));
   }
   public function business_image_update(Request $request,$id)
   {
	   $id = decrypt($id);
	   if($request->hasFile('business_image'))
	   {
		   $rules = [
			'business_name' => 'required',
			];
			$attributeNames = array(
					'business_name' => 'Name',
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
						   $path='business_images/uploads/doc/'.$id ;
												if (!is_dir($path)) {
													mkdir($path, 0777, TRUE);
													}
													
										$profile = $request->File('business_image');
											$filename = time().'.'.$profile->getClientOriginalExtension();
											$file = time().''.$profile->getClientOriginalName();
											$location_1 = public_path($path.'/'.$file);
											Image::make($profile)->save($location_1);
											$business_update = Business_image::query()
														->where('business_images_id','=',$id)
														->update(['images_url' =>$file,
																	'business_id' => $request->business_name,
																'updated_at' => Carbon::now(),
																]);
																
							
																
							Session::flash('success',"Business Image Updated successfully");
							return redirect('buss_image');
					}
	   }
	   else
	   {
		    $rules = [
			'business_name' => 'required',
			];
			$attributeNames = array(
					'business_name' => 'Name',
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
					   $business_update = Business_image::query()
													->where('business_images_id','=',$id)
													->update([
															'business_id' => $request->business_name,
															'updated_at' => Carbon::now(),
															]);
															
							
															
						Session::flash('success',"Business Image Updated successfully");
						return redirect('buss_image');
					}
	   }
   }
   public function buss_categ_delete(Request $request,$id)
   {
	    $id = decrypt($id);
		$buss = Business_image::query()
								->where('business_images_id','=',$id)
								->delete();
								
							
								
			Session::flash('success',"Business Image Deleted successfully");
			return redirect('buss_image');
   } 
   
   public function buss_cat_single_view(Request $request)
   {
	   $id = $request->uid;
	   $buss_img = Business_image::query()
								->select('*')
								->where('business_images_id','=',$id)
								->get();
		$buss = Business::query()
								->select('*')
								->get();
			 $business = "";					
		 foreach($buss as $bussi)
		 {
			 if($bussi->business_id == $buss_img[0]->business_id )
			 {
				 $business = $bussi->name;
			 }
		 }
			$path='business_images/uploads/doc/'.$buss_img[0]->business_images_id .'/'.$buss_img[0]->images_url ;
			$image = url($path);
			$image_url = "<img src=".$image." width='50px' height='50px' class='img-circle'>";
			
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$business."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Image:</label>".$image_url."</div></div></div>";
			
   }
   
   public function business_single_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$business = Business_image::query()
							->where('business_images_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
								
			$business_status = Business_image::query()
							->select('*')
							->where('business_images_id',$id)
							->get();
				echo $business_status[0]->is_active;
	}
}
