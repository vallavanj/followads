<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Business;
use App\Business_Address;
use App\Business_Category;
use App\Business_image;
use App\Business_Video;
use App\Categories;
use App\Advertisment;
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
class BusinessController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
    public function index()
	{
				
					$buss_cat = Business_Category::query()
					->select('business_id',DB::raw('group_concat(category.category_name) as category'))
					->join('category','business_category.category_id','=','category.category_id',"Left")
					->groupBy('business_category.business_id')
					->get();

					$business = DB::table('business')
					->select('business.*','business_image.*', 'business_category.business_id as bus_id','business.is_active')
					->join('business_image','business.business_id','=','business_image.business_id','Left')
					/* ->join('business_video','business.business_id','=','business_video.business_id','Left') */
					->join('business_category','business.business_id','=','business_category.business_id','Left')
					//->join('business','business.business_id','=','business_category.business_id','Left')

					->orderBy('business.updated_at','desc')
					->groupBy('business_image.business_id')
					/* ->groupBy('business_category.business_id') */
					->get();



					/* DB::enableQueryLog(); */
				
					/* $query = DB::getQueryLog(); */
					$categ  = Categories::query()
					->select('*')
					->get();
					$cat_business_value=DB::table('business')->select('*')->get();



			return view('adminpages.business.index',compact('business','categ','cat_business_value','buss_cat'));
	}
	public function create_business(Request $request)
	{
		/* print_R($request->category_name);exit;	 */
		if(!empty($request->input()))
		{
						$business = new Business;
						$business->name = $request->name;
						$business->is_active = 1;
						$business->logo_url = 0;
						$business->created_by = Auth::user()->user_id;
						$business->created_at = Carbon::now();
						$business->updated_by = 1;
						$business->updated_at = Carbon::now();
						if($business->save())
						{
							
						$last_inserted_id = $business->id;
						$path_2=public_path('business1/uploads/doc/'.$last_inserted_id);
						
						if (!is_dir($path_2)) {
								mkdir($path_2, 0777,TRUE);
								//chmod($path_2,0777,TRUE); 
						} 
									
						$profile = $request->File('business_logo');
						$filename = time().'.'.$profile->getClientOriginalExtension();
						$file = time().''.$profile->getClientOriginalName();
						$destinationPath = $path_2;
						$imagePath = $destinationPath. "/".  $file;
						$profile->move($destinationPath, $file);
						
						
						
						$business_update = Business::query()
											->where('business_id','=',$last_inserted_id)
											->update(['logo_url' =>$file]);
						$category = $request->input('category_name');
						foreach($category as $key=>$categ)
						{
						$buss_cat = new Business_Category;
						$buss_cat->business_id = $last_inserted_id;
						$buss_cat->category_id = $categ;
						$buss_cat->is_active = 1;
						$buss_cat->created_by = Auth::user()->user_id;
						$buss_cat->created_at = Carbon::now();
						$buss_cat->updated_by = Auth::user()->user_id;
						$buss_cat->updated_at = Carbon::now();
						$buss_cat->save();
						}
						
					
						//$path='business_images/uploads/doc/'.$last_inserted_id;
						$path=public_path('business_images/uploads/doc/'.$last_inserted_id);
						
							if (!is_dir($path)) {
								mkdir($path, 0777, TRUE);
								}
						$bus_images = $request->File('business_image');
						$i=1;
						foreach($bus_images as $profiles)
						{
						$buss_img = new  Business_image;
						$buss_img->business_id = $last_inserted_id;
						$buss_img->sequence_no = /* rand(1000,10) */ $i;
						$buss_img->is_active = 1;
						$buss_img->created_by = Auth::user()->user_id;
						$buss_img->created_at = Carbon::now();
						$buss_img->updated_by = Auth::user()->user_id;
						$buss_img->updated_at = Carbon::now();
						
						
						
						$filename = time().'.'.$profiles->getClientOriginalExtension();
						$file = time().''.$profiles->getClientOriginalName();
						
						/* $location_1 = public_path($path.'/'.$file);
						Image::make($profiles)->save($location_1);  */
						
						$destinationPath = $path;
						$imagePath = $destinationPath."/".$file;
						$profiles->move($destinationPath, $file);
						
						//$bus_images->move($destinationPath, end($file));
						$buss_img->images_url = $file;
						$buss_img->save();
						$i++;
						}
						
						
						$path_1=public_path('business_video/uploads/doc/'.$last_inserted_id);
						 //$path_1='business_video/uploads/doc/'.$last_inserted_id;
												if (!is_dir($path_1)) {
													mkdir($path_1, 0777, TRUE);
													}
						$profile_1 = $request->File('business_video');
						
						if(empty($profile_1)) {  } else { 
									foreach($profile_1 as $prof)
									{
									$buss_vid = new Business_Video;
									$buss_vid->business_id = $last_inserted_id;
									$buss_vid->business_video_url = 0;
									$buss_vid->is_active = 1;
									$buss_vid->created_by = Auth::user()->user_id;
									$buss_vid->created_at = Carbon::now();
									$buss_vid->updated_by = Auth::user()->user_id;
									$buss_vid->updated_at = Carbon::now();
									
									
								/* 	$buss_img->images_url = ""; */
									
									$filename = time().'.'.$prof->getClientOriginalExtension();
									$file = time().''.$prof->getClientOriginalName();
									$location_1 = $path_1."/".$file;
									$prof->move($location_1,$file);
									
									$buss_vid->business_video_url = $file;
									$buss_vid->save();
									
									}
						}
					
					
					$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Create Business";
					$log->is_active =1;
					$log->created_by = Auth::user()->user_id;
					$log->updated_by = Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
			
														
				Session::flash('success',"Business Created successfully");
				return redirect('bussiness');
						}
		}
		$category = Categories::query()
							->select('*')
							->where('is_active','=',1)
							->where('parent_category_id','=',0)
							->groupBY('category_name')
							->get();
			$category_1 = Categories::query()
							->select('*')
							->where('is_active','=',1)
							->groupBY('category_name')
							->get();
											
					foreach($category_1  as $values) {

					$parent_category = Categories::query()
											->select('*')
											->where('is_active','=',1)
											->where('parent_category_id',$values->category_id)
											->whereNotIn('parent_category_id',['0'])
											->get();
							foreach($parent_category as $val) {
								
								$value_cat_pat[]=array(
								 "parent_cat" =>$values->category_name,
								 "children_value"=>$val->category_name,
								 "parent_category_id"=>$val->category_id,
								);
								
							}
					}
		   $result = [];	
		    foreach($value_cat_pat as $values) {
				if(!isset($result[$values["parent_cat"]])) {
					$result[$values["parent_cat"]]["parent_cat"] = $values["parent_cat"];
					$result[$values["parent_cat"]]["parent_category_id"] = $values["parent_category_id"];
					$result[$values["parent_cat"]]["children_value"] = $values["children_value"];
					
				} else {
					
					 $result[$values["parent_cat"]]["children_value"] .= "," . $values["children_value"];
					 $result[$values["parent_cat"]]["parent_category_id"] .= "," . $values["parent_category_id"];
				}
			}
			
				$result_parent_id_group = array_values($result);
				
			
				
				
		return view('adminpages.business.businessadd',compact('category','result_parent_id_group'));
	}
	public function view_business($id)
	{
		$id = decrypt($id);
		/* echo $id;exit; */
			$business = Business::query()
								->select('*')
								->where('business_id',$id)
								->get();
			/* $categ  = Categories::query()
									->select('*')
									->get(); */
				/*  DB::enableQueryLog();  */
					$buss_cat = Business_Category::query()
								->select('category_id')
								->where('business_id','=',$id)
								->get()->toarray();
					$buss_image = Business_image::query()
						->select('*')
						->where('business_id',$id)
						->get();
						
						
					$buss_video = Business_Video::query()
								->select('*')
								->where('business_id',$id)
								->get();
						
						/*  DB::enableQueryLog(); 								
			$business = DB::table('business') */
			/* ->select('business.*','business_image.images_url','business_image.business_images_id','business_video.business_video_url',	'business_video.business_video_id', 'business_category.*') */
			
						/* 			->select( 'business.*','business_image.*','business_video.*', 'business_category.*')
									->join('business_image','business.business_id','=','business_image.business_id','Left')
									->join('business_video','business.business_id','=','business_video.business_id','Left')
									->join('business_category','business.business_id','=','business_category.business_id','Left')
									->where('business.business_id','31')
										->groupby('business_image.business_id')
									->groupby('business_video.business_id')
							
									->get();
									$query = DB::getQueryLog();

							$query = end($query);
							print_r($query );exit; */
									/* echo"<pre>";
									print_r($business); */
									
									
									
		/* Category Show */
			  
			  

			
			$categ  = Categories::query()
									->select('*')
									->where('is_active','=',1)
									
									->get();
									
			$category = Categories::query()
							->select('*')
							->where('is_active','=',1)
							->where('parent_category_id','=',0)
							->get();
				$category_1 = Categories::query()
							->select('*')
							->where('is_active','=',1)
							->groupBY('category_name')
							->get();
											
					foreach($category_1  as $values) {

					$parent_category = Categories::query()
											->select('*')
											->where('is_active','=',1)
											->where('parent_category_id',$values->category_id)
											->whereNotIn('parent_category_id',['0'])
											->get();
							foreach($parent_category as $val) {
								
								$value_cat_pat[]=array(
								 "parent_cat" =>$values->category_name,
								 "children_value"=>$val->category_name,
								 "parent_category_id"=>$val->category_id,
								);
								
							}
					}
		   $result = [];	
		    foreach($value_cat_pat as $values) {
				if(!isset($result[$values["parent_cat"]])) {
					$result[$values["parent_cat"]]["parent_cat"] = $values["parent_cat"];
					$result[$values["parent_cat"]]["parent_category_id"] = $values["parent_category_id"];
					$result[$values["parent_cat"]]["children_value"] = $values["children_value"];
					
				} else {
					
					 $result[$values["parent_cat"]]["children_value"] .= "," . $values["children_value"];
					 $result[$values["parent_cat"]]["parent_category_id"] .= "," . $values["parent_category_id"];
				}
			}
			
				$result_parent_id_group = array_values($result);
					
					
						
			return view('adminpages.business.businessedit',compact('business','categ','buss_video','result_parent_id_group','category','buss_image','buss_cat'));
	}
	public function update_business(Request $request,$id)
	{
		/* print_R($request->input());exit; */
		$id = decrypt($id);
		/* print_r($_FILES);exit; */
		if($request->hasFile('business_logo'))
		{
				$path_2=public_path('business1/uploads/doc/'.$id);	
						//$path_2='business1/uploads/doc/'.$id;
								if (!is_dir($path_2)) {
									mkdir($path_2, 0777, TRUE);
									}
									
							/*$profile = $request->File('business_logo');
							$filename = time().'.'.$profile->getClientOriginalExtension();
							$file = time().''.$profile->getClientOriginalName();
							$location_1 = public_path($path_2.'/'.$file);
							Image::make($profile)->save($location_1);  */
							
							
						$profile = $request->File('business_logo');
						$filename = time().'.'.$profile->getClientOriginalExtension();
						$file = time().''.$profile->getClientOriginalName();
						$destinationPath = $path_2;
						$imagePath = $destinationPath."/".$file;
						$profile->move($destinationPath, $file);
							
							
							
							$business_update = Business::query()
														->where('business_id','=',$id)
														->update(['logo_url' =>$file,
																	'name' => $request->name,
																	'updated_at'=>Carbon::now()
														]);
														
						/* $buss_cat = Business_Category::query()
															->where('business_id','=',$id)
															->update([
															'category_id' => $request->category_name,
															'updated_at'=>Carbon::now()
															]); */
															
				$buss_cat = Business_Category::query()
										->where('business_id','=',$id)
										->delete();
						/* print_R($category);die; */
						$category = $request->input('category_name');
						foreach($category as $key=>$categ)
						{
						$buss_cat = new Business_Category;
						$buss_cat->business_id = $id;
						$buss_cat->category_id = $categ;
						$buss_cat->is_active = 1;
						$buss_cat->created_by = Auth::user()->user_id;
						$buss_cat->created_at = Carbon::now();
						$buss_cat->updated_by = Auth::user()->user_id;
						$buss_cat->updated_at = Carbon::now();
						$buss_cat->save();
						}
					
				
		}
		if($request->hasFile('business_image'))
		{
			/* $path='business_images/uploads/doc/'.$id ;
												if (!is_dir($path)) {
													mkdir($path, 0777, TRUE);
													}
													
			$profile = $request->File('business_image');

			$filename = time().'.'.$profile->getClientOriginalExtension();
			$file = time().''.$profile->getClientOriginalName();
			$location_1 = public_path($path.'/'.$file);
			Image::make($profile)->save($location_1);
			
			$business_update = Business_image::query()
												->where('business_id','=',$id)
												->update(['images_url' =>$file,
														'updated_at' => Carbon::now(),
																]); */
																
				$path=public_path('business_images/uploads/doc/'.$id);												
				//$path='business_images/uploads/doc/'.$id;
												if (!is_dir($path)) {
													mkdir($path, 0777, TRUE);
													}
						$profile = $request->File('business_image');
						$images_get_seq=Business_image::query()->select('*')->where('business_id',$id)->get();
						foreach($images_get_seq as $val){
							$seq_no=$val->sequence_no;
						}
						$i=$seq_no+1;
						foreach($profile as $profiles)
						{
						$buss_img = new  Business_image;
						$buss_img->business_id = $id;
						$buss_img->sequence_no = /* rand(1000,10) */$i;
						$buss_img->is_active = 1;
						$buss_img->created_by = Auth::user()->user_id;
						$buss_img->created_at = Carbon::now();
						$buss_img->updated_by = Auth::user()->user_id;
						$buss_img->updated_at = Carbon::now();
						
						
					/* 	$buss_img->images_url = ""; */
						
						$filename = time().'.'.$profiles->getClientOriginalExtension();
						$file = time().''.$profiles->getClientOriginalName();
						/*$location_1 = public_path($path.'/'.$file);
						Image::make($profiles)->save($location_1); */
						
						$destinationPath = $path;
						$imagePath = $destinationPath."/".$file;
						$profiles->move($destinationPath, $file);
						
						$buss_img->images_url = $file;
						$buss_img->save();
						$i++;
						}
				$business_update = Business::query()
														->where('business_id','=',$id)
														->update([
																	'name' => $request->name,
																	'updated_at'=>Carbon::now()
														]);
				$business_update_1 = Business::query()
										->where('business_id','=',$id)
										->update([
												'name' => $request->name,
												'updated_at'=>Carbon::now()
												]);
					$buss_cat = Business_Category::query()
										->where('business_id','=',$id)
										->delete();
						/* print_R($category);die; */
						$category = $request->input('category_name');
						foreach($category as $key=>$categ)
						{
						$buss_cat = new Business_Category;
						$buss_cat->business_id = $id;
						$buss_cat->category_id = $categ;
						$buss_cat->is_active = 1;
						$buss_cat->created_by = Auth::user()->user_id;
						$buss_cat->created_at = Carbon::now();
						$buss_cat->updated_by = Auth::user()->user_id;
						$buss_cat->updated_at = Carbon::now();
						$buss_cat->save();
						}
						
					
																
		}
		if($request->hasFile('business_video'))
		{
			 /* $path='business_video/uploads/doc/'.$id;
				if (!is_dir($path)) {
					mkdir($path, 0777, TRUE);
					}

				$profile = $request->File('business_video');
				$filename = time().'.'.$profile->getClientOriginalExtension();
				$file = time().''.$profile->getClientOriginalName();
				$location_1 = public_path($path);
				$profile->move($location_1,$file);
				$business_update = Business_Video::query()
													->where('business_id','=',$id)
													->update([
													'business_video_url' =>$file,
													'updated_at'=>Carbon::now()
													]); */
						
						
						$path_1=public_path('business_video/uploads/doc/'.$id);
						// $path_1='business_video/uploads/doc/'.$id;
												if (!is_dir($path_1)) {
													mkdir($path_1, 0777, TRUE);
													}
						$profile_1 = $request->File('business_video');
						
						foreach($profile_1 as $prof)
						{
						$buss_vid = new Business_Video;
						$buss_vid->business_id = $id;
						$buss_vid->business_video_url = 0;
						$buss_vid->is_active = 1;
						$buss_vid->created_by = Auth::user()->user_id;
						$buss_vid->created_at = Carbon::now();
						$buss_vid->updated_by = Auth::user()->user_id;
						$buss_vid->updated_at = Carbon::now();
						
						
					/* 	$buss_img->images_url = ""; */
						
						$filename = time().'.'.$prof->getClientOriginalExtension();
						$file = time().''.$prof->getClientOriginalName();
						$location_1 = $path_1."/".$file;
						$prof->move($location_1,$file);
						
						$buss_vid->business_video_url = $file;
						$buss_vid->save();
						
						}
						
				$business_update = Business::query()
														->where('business_id','=',$id)
														->update([
																	'name' => $request->name,
																	'updated_at'=>Carbon::now()
														]);
													
				$business_update = Business::query()
										->where('business_id','=',$id)
														->update([
																	'name' => $request->name,
																	'updated_at'=>Carbon::now()
														]);
					$buss_cat = Business_Category::query()
										->where('business_id','=',$id)
										->delete();
						/* print_R($category);die; */
						$category = $request->input('category_name');
						foreach($category as $key=>$categ)
						{
						$buss_cat = new Business_Category;
						$buss_cat->business_id = $id;
						$buss_cat->category_id = $categ;
						$buss_cat->is_active = 1;
						$buss_cat->created_by = Auth::user()->user_id;
						$buss_cat->created_at = Carbon::now();
						$buss_cat->updated_by = Auth::user()->user_id;
						$buss_cat->updated_at = Carbon::now();
						$buss_cat->save();
						}
						
						
				
		}
		
			$business_update = Business::query()
										->where('business_id','=',$id)
														->update([
																	'name' => $request->name,
																	'updated_at'=>Carbon::now()
														]);
					$buss_cat = Business_Category::query()
										->where('business_id','=',$id)
										->delete();
						/* print_R($category);die; */
						$category = $request->input('category_name');
						foreach($category as $key=>$categ)
						{
						$buss_cat = new Business_Category;
						$buss_cat->business_id = $id;
						$buss_cat->category_id = $categ;
						$buss_cat->is_active = 1;
						$buss_cat->created_by = Auth::user()->user_id;
						$buss_cat->created_at = Carbon::now();
						$buss_cat->updated_by = Auth::user()->user_id;
						$buss_cat->updated_at = Carbon::now();
						$buss_cat->save();
						}
														
						$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Update Business";
					$log->is_active =1;
					$log->created_by = Auth::user()->user_id;
					$log->updated_by = Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();
		
		Session::flash('success',"Business Updated successfully");
								return redirect('bussiness');
	}
	public function delete_business(Request $request,$id)
	{
		$id = decrypt($id);
		$ads_check = Advertisment::query()
										->select('*')
										->where('business_id',$id)
										->count();
			/* print_r($ads_check);exit; */
		if(empty($ads_check))
		{

		$business = Business::query()
								->where('business_id',$id)
								->delete();
		$buss_cat = Business_Category::query()
								->where('business_id',$id)
								->delete();
				
		$buss_image = Business_image::query()
										->where('business_id',$id)
										->delete();
		
		
		$buss_video = Business_Video::query()
										->where('business_id',$id)
										->delete();
					
		$user_follow_bus = DB::table('user_followed_business')
										->where('business_id',$id)
										->delete();
		
				Session::flash('success',"Business Deleted successfully");
								return redirect('bussiness');
		}
		else
		{
			/* echo "jjj";exit; */
			Session::flash('success',"Business Has a advertisement Cannot Deleted");
			return redirect('bussiness');
		}
	}
	public function business_single_view(Request $request)
	{
		
		
		$id = $request->uid;
		$business = Business::query()
								->select('*')
								->where('business_id',$id)
								->get();
		$buss_img = Business_image::query()
								->select('*')
								->where('business_id',$id)
								->get();
								
		$buss_vid = Business_Video::query()
								->select('*')
								->where('business_id','=',$id)
								->get();
								
								
		$categ  = Categories::query()
									->select('*')
									->get();
									
			/* $buss_cat = Business_Category::query()
													->select('*')
													->where('business_id',$id)
													->get(); */
													
			$buss_cat = Business_Category::query()
								->select('business_id',DB::raw('group_concat(category.category_name) as category'))
									->join('category','business_category.category_id','=','category.category_id',"Left")
									->where('business_category.business_id',$id)
									->groupBy('business_category.business_id')
									->get();
							
			
				
			
			
			
			
			
			
				$html = "";
				foreach($business as $rows)
				{
					$path='business1/uploads/doc/'.$rows['business_id'].'/'.$rows['logo_url'];
					$logo = url($path);
					$logo_url = "<img src=".$logo." width='50px' height='50px' class='img-circle'>";
					
				$html.= "<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3 row'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$rows['name']."</div><div class='px-3 row'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Logo:</label>".$logo_url."</div><div class='px-3 row'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Category:</label>";
				
				foreach($buss_cat as $bus)
						{
							if($bus->business_id == $business[0]->business_id)
							{
								$html.= $bus->category;
							}
						}
				$html.="</div><div class='px-3 row mb-10'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Images:</label>";
				
				
			/* Image gallery set  up     */ 
			
			    $i=1;
				$images=array();
				foreach($buss_img as $bus_im)
				{
				$path_image='business_images/uploads/doc/'.$bus_im->business_id.'/'.$bus_im->images_url ;
				$image = url($path_image);
				$html.= " <img src=".$image." width='50px' height='50px' class='img-circle' onclick='openModal();currentSlide(".$i.")'> &nbsp; ";
				$images[]=$bus_im->images_url;
				$i++;}
					$count_images_gallery= count($images);
				
				$html .="
					<div id='myModal' class='modal_gallery'>
						<span class='close_button_gallery cursor' onclick='closeModal()'>&times;</span>
							<div class='modal_content_gallery'>";
						$i=1;
						//print_r($buss_img);
						$images=array();
					foreach($buss_img as $bus_im)
					{
						$path_image='business_images/uploads/doc/'.$bus_im->business_id.'/'.$bus_im->images_url;
						$image = url($path_image);
						$html.="<div class='mySlides'>
								<div class='numbertext'>".$i." / ".$count_images_gallery."</div>
									<img src=".$image." style='width:100%;height:500px;'>
							</div>";
							
							
							
					$i++;}
				
							//echo $count_images_gallery;
						$html .="	<a class='prev_gallery' onclick='plusSlides(-1)'>&#10094;</a>
									<a class='next_gallery' onclick='plusSlides(1)'>&#10095;</a>
									<div class='caption-container'>
										<p id='caption'></p>
										</div>
									</div>
								</div>";
				
				
				
				
			/* End the statemet   */	
				
				$html.="</div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Video:</label><div class='col-md-6'>";
				$video_url ="";			
				foreach($buss_vid as $bus_v)
				{
			    $path_video='business_video/uploads/doc/'.$bus_v->business_id .'/'.$bus_v->business_video_url ;
			   $video = url($path_video);
			   $html.= "<video width='100%' height='160' controls><source src=".$video."type='video/mp4'><source src=".$video." type='video/ogg'></video>";
						// echo $video_url;exit;
				}
				$html.="</div></div></div></div>";
				$html.="<script>var videos = document.querySelectorAll('video');
			for(var i=0; i<videos.length; i++)
			videos[i].addEventListener('play', function(){pauseAll(this)}, true);


			function pauseAll(elem){
			for(var i=0; i<videos.length; i++){
			//Is this the one we want to play?
			if(videos[i] == elem) continue;
			//Have we already played it && is it already paused?
			if(videos[i].played.length > 0 && !videos[i].paused){
			// Then pause it now
			videos[i].pause();
					} 	}   }
					
					
				function openModal() {  document.getElementById('myModal').style.display = 'block';  }
				function closeModal() {  document.getElementById('myModal').style.display = 'none'; }
				var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName('mySlides');
  var dots = document.getElementsByClassName('demo');
  var captionText = document.getElementById('caption');
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(' active', '');
  }
  slides[slideIndex-1].style.display = 'block';
  dots[slideIndex-1].className += ' active';
  captionText.innerHTML = dots[slideIndex-1].alt;
}
				
				
				</script>";
				
				}
			echo $html;
	}
	public function business_single_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$business = Business::query()
							->where('business_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
			$business_status = Business::query()
							->select('*')
							->where('business_id',$id)
							->get();
				echo $business_status[0]->is_active;
	}
	public function business_img_remove(Request $request)
	{
		$id = $request->id;
		$bid = $request->bid;
		$seq_no=$request->seq_no;
		
		$business_update = Business_image::query()
							->where('business_images_id','=',$id)
							->delete(); 
		$business_image = Business_image::query()
						->select('*')
						->where('business_id',$bid)
						->get();
		$business_images_id=array();
		foreach($business_image as $values){
			$business_images_id[]=$values['business_images_id'];
			
		}
		$i=1;
		foreach($business_images_id as $values) {
			
		$business_update_img=Business_image::query()
							->where('business_images_id','=',$values)
							->where('business_id','=',$bid)
							->update([
									'sequence_no' =>$i,
									'updated_at'=>Carbon::now()
									]);
		$i++;	
		}
		if($business_update) {
			echo "1";
		}
		else {
			echo "0";
		}
		
	
	}
	
	public function business_vid_remove(Request $request)
	{
		$id = $request->id;
		 $bid = $request->bid;
		
						$bus_vid = Business_Video::query()
												->select('*')
												->where('business_id','=',$bid)
												->get()->toarray();
				$bus_id = array_column($bus_vid,'business_id');
				 $v_img_1 = count($bus_id);
				 
				 
		if($v_img_1 > 1)
		{
		
		$business_update = Business_Video::query()
												->where('business_video_id','=',$id)
												->delete();
			if($business_update)
			{
				echo "Video Deleted Sucessfully";
				
			}
			else
			{
				echo "Video Does Not Deleted";
				
			}
			exit;
		}
		else
		{
			echo"Video Cannot Be Deleted";
		}
		
	}
	
/**  Ads Show in business view **/  

   public function business_ads_show(Request $request) {
	   $id = $request->uid;
	   
		$business_name = Business::query()
				->select('*')
				->where('business_id',$id)
				->get();
		$ads_view_business=DB::table('advertisement')
							->select('*')
							->where('business_id',$id)
							->get();
	   
	   
	   return view('adminpages.business.business_ads_show',compact('business_name','ads_view_business'));
	   
   }	
	
	
	
	
	
	
}
