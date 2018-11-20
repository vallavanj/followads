<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\User;
use App\Business_Address;
use App\Business_Category;
use App\Notification;
use App\Categories;
use App\Advertisment;
use App\Advertisment_Category;
use App\Advertisement_Description;
use App\Advertisement_Offer_Code;
use App\Advertisement_Image;
use App\Advertisement_Search_Terms;
use App\Language;
use App\Activity_log;
use Session;
use Image;
use Hash;
use Validator;
use DB;
use URL;
use App\Attempt;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdvertismentController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
    public function index()
	{
		$business = Business::query()
								->select('*')
								/* ->where('is_active','=',1) */
								->get();  
		/* DB::setFetchMode(PDO::FETCH_ASSOC); */
		/* DB::enableQueryLog(); */
		$ads = Advertisment::query()
								->select('advertisement.*','ad_desc.description','ad_desc.caption','ad_cat.category_id','adv_image.image_url','adv_image.language_id','adv_offer_code.offer_code','adv_offer_code.offer_type_code','adv_search_term.search_term','bus.business_id','bus.is_active as active')
								->join('advertisement_description as ad_desc','advertisement.advertisement_id','=','ad_desc.advertisement_id','Left')
								->join('advertisement_category as ad_cat','advertisement.advertisement_id','=','ad_cat.advertisement_id','Left')
								->join('advertisement_image as adv_image','advertisement.advertisement_id','=','adv_image.advertisement_id','Left')
								->join('advertisement_offer_code as adv_offer_code','advertisement.advertisement_id','=','adv_offer_code.advertisement_id','Left')
								->join('advertisement_search_term as adv_search_term','advertisement.advertisement_id','=','adv_search_term.advertisement_id','Left')
								->join('business as bus','advertisement.business_id','=','bus.business_id')
								/* ->where('bus.is_active','=',1) */
								->orderBy('updated_at','desc')
								->groupBY('advertisement.advertisement_id')
								->get();
								
							/* $query = DB::getQueryLog();
							$query = end($query);
							print_r($query); */
					/* echo "<pre>";
					print_r($ads);exit; */
					/* DB::enableQueryLog(); */
		$adv_desc = Advertisement_Description::query()
													->select('advertisement_id',DB::raw('group_concat(advertisement_description.description) as description'),DB::raw('group_concat(language.name_in_english) as language'),DB::raw('group_concat(advertisement_description.caption) as caption'))
													->join('language','advertisement_description.language_id','=','language.language_id','Left')
													->groupBy('advertisement_description.advertisement_id')
													->get();
					/* DB::enableQueryLog();
		$adv_desc = Advertisement_Description::query()
													->select(DB::raw('group_concat(description) as desc'))
													->groupBy('advertisement_id')
													->get(); */
					/* $query = DB::getQueryLog();
							$query = end($query);
							print_r($query); */
					
					
		$lang = Language::query()
								->select('*')
								->where('is_active','=',1)
								->get();
					
				return view('adminpages.ads.index',compact('ads','business','lang','adv_desc'));
	}
	public function advertisment_create(Request $request)
	{
		if(!empty($request->input()))
		{
			/* print_R($_POST); */
			$ads = new Advertisment;
			if($request->hasFile('ads_icon'))
			{
				// $date1 = strtr($request->valid_to, '/', '-');
				$from = strtr($request->valid_from, '/', '-');
				$to = strtr($request->valid_to, '/', '-');
				 $vaild_from = date("Y-m-d",strtotime($from));
				
				 $vaild_to = date("Y-m-d",strtotime($to));
				
			
				$ads->business_Id = $request->business_name;
				$ads->name = $request->ads_name;
				$ads->valid_from = $vaild_from;
				$ads->valid_to = $vaild_to;
				$ads->icon_image_url = 0;
				$ads->is_active = 1;
				$ads->created_by = 1;
				$ads->created_at = Carbon::now();
				$ads->updated_by = 1;
				$ads->updated_at = Carbon::now();
				if($ads->save())
				{
					$ads_inserted_id = $ads->id;
					  $path=public_path('ads1/uploads/doc/'.$ads_inserted_id);
										if (!is_dir($path)) {
														mkdir($path, 0777, TRUE);
														}
														
												$profile = $request->File('ads_icon');
												$filename = time().'.'.$profile->getClientOriginalExtension();
												$file = time().''.$profile->getClientOriginalName();
												$location_1 = $path;
												$profile->move($location_1,$file);
												//Image::make($profile)->save($location_1);
												$business_update = Advertisment::query()
																			->where('advertisement_id','=',$ads_inserted_id)
																			->update(['icon_image_url' =>$file,
																			]);
																			
						
					
					$path1=public_path('advertisement_images/uploads/doc/'.$ads_inserted_id);
													if (!is_dir($path1)) {
														mkdir($path1, 0777, TRUE);
														}
							$profile = $request->File('ads_image');
							$i =1;
							foreach($profile as $profiles)
							{
							$buss_img = new  Advertisement_Image;
							$buss_img->advertisement_id = $ads_inserted_id;
							$buss_img->sequence_no = /* rand(1000,10) */$i;
							$buss_img->is_active = 1;
							$buss_img->created_by = Auth::user()->user_id;
							$buss_img->created_at = Carbon::now();
							$buss_img->updated_by = Auth::user()->user_id;
							$buss_img->updated_at = Carbon::now();
							
							
						/* 	$buss_img->images_url = ""; */
							
							$filename = time().'.'.$profiles->getClientOriginalExtension();
							$file = time().''.$profiles->getClientOriginalName();
							$location_1 =$path1;
							$profiles->move($location_1,$file);
							//Image::make($profiles)->save($location_1);
							$buss_img->image_url = $file;
							$buss_img->save();
							
							$i++;
							}
					
					
					
					$adv_offer = new Advertisement_Offer_Code;
					$adv_offer->advertisement_id = $ads_inserted_id;
					   $adv_offer->offer_code = $request->offer_code;
					   $adv_offer->offer_type_code = $request->offer_type_code;
					   $adv_offer->is_active = 1;
					   $adv_offer->created_by = Auth::user()->user_id;
					   $adv_offer->created_at = Carbon::now();
					   $adv_offer->updated_by = Auth::user()->user_id;
					   $adv_offer->updated_at = Carbon::now();
						$adv_offer->save();
						
					   $adv_search = new Advertisement_Search_Terms;
					   $adv_search->advertisement_id = $ads_inserted_id;
					   $adv_search->search_term = $request->search_term;
					   $adv_search->is_active = 1;
					   $adv_search->created_by = Auth::user()->user_id;
					   $adv_search->created_at = Carbon::now();
					   $adv_search->updated_by = Auth::user()->user_id;
					   $adv_search->updated_at = Carbon::now();
			  
					  $adv_search->save();
					foreach($request->category_name as $categ)
					{
					$ads_categ = new Advertisment_Category;
					$ads_categ->advertisement_id = $ads_inserted_id;
					$ads_categ->category_id = $categ;
					$ads_categ->is_active = 1;
					$ads_categ->created_by = Auth::user()->user_id;
					$ads_categ->created_at = Carbon::now();
					$ads_categ->updated_by = Auth::user()->user_id;
					$ads_categ->updated_at = Carbon::now();
					$ads_categ->save();
					}
					foreach($request->language_name as $key=>$lang)
					{
					$adv_desc = new Advertisement_Description;
					$adv_desc->advertisement_id = $ads_inserted_id;
					$adv_desc->description = $request->desc[$key];
					$adv_desc->caption = $request->caption[$key];
					$adv_desc->language_id = $lang;
					$adv_desc->is_active = 1;
					$adv_desc->created_by = Auth::user()->user_id;
					$adv_desc->created_at = Carbon::now();
					$adv_desc->updated_by = Auth::user()->user_id;
					$adv_desc->updated_at = Carbon::now();
					$adv_desc->save();
					}
						/* Push Noticification */
						
						$ads1 = Advertisment::query()
												->select('name','business_id','valid_from','valid_to')
												->where('advertisement_id',$ads_inserted_id)
												->get();
						$ads_desc1 = Advertisement_Description::query()
																	->select('description','caption')
																	->where('advertisement_id',$ads_inserted_id)
																	->get();
						$ads_adv_off1  = Advertisement_Offer_Code::query()
																	->select('offer_code')
																	->where('advertisement_id',$ads_inserted_id)
																	->get();
						$adv_img1 = Advertisement_Image::query()
														->select('image_url')
														->where('advertisement_id',$ads_inserted_id)
														->where('sequence_no',1)
														->get();

						$bus1 = Business::query()
											->select('name')
											->where('business_id',$ads1[0]->business_id)
											->get();
						$bus_img1 = DB::table('business_image')
														->select('images_url')
														->where('business_id',$ads1[0]->business_id)
														->where('sequence_no',1)
														->get();
							$path_image = URL::to('/').'/business_images/uploads/doc/'.$ads1[0]->business_id;
							$path_ads_image=URL::to('/').'/advertisement_images/uploads/doc/'.$ads_inserted_id;
							$push_notification_details = array(
							'business_name'=>$bus1[0]->name,
							'business_id'=>$ads1[0]->business_id,
							'advertisement_id'=>$ads_inserted_id,
							'ads_valid_from'=>$ads1[0]->valid_from,
							'ads_valid_to'=>$ads1[0]->valid_to,
							'advertisement_name'=>$ads1[0]->name,
							'advertisement_caption'=>$ads_desc1[0]->caption,
							'business_img'=>$path_image.'/'.$bus_img1[0]->images_url,
							'advertisement_img'=>$path_ads_image.'/'.$adv_img1[0]->image_url,
							);
																
								$user = User::query()
											->select('device_id','device_name','user_id')
											->get();
								
							foreach($user as $us)
							{
								if($us->device_name == 'android')
								{
									$data = $this->sendNotificationAndroid($us->device_id,$us->device_name,$push_notification_details);
									if($data)
									{
										$notif = new Notification;
										
										$notif->business_id = $ads1[0]->business_id;
										$notif->advertisment_id = $ads_inserted_id;
										$notif->user_id = $us->user_id;
										$notif->type_of_message ="Offer Detail";
										$notif->message = "New offer is implemented";
										$notif->is_active = 1;
										$notif->created_by = Auth::user()->user_id;
										$notif->created_at = Carbon::now();
										$notif->updated_by = Auth::user()->user_id;
										$notif->updated_at = Carbon::now();
										$notif->save();
									}
								}
								else
								{
									$data = $this->sendNotificationIOS($us->device_id,$us->device_name,$push_notification_details);
									if($data)
									{
										$notif = new Notification;
										
										$notif->business_id = $ads1[0]->business_id;
										$notif->advertisment_id = $ads_inserted_id;
										$notif->user_id = $us->user_id;
										$notif->type_of_message ="Offer Detail";
										$notif->message = "New offer is implemented";
										$notif->is_active = 1;
										$notif->created_by = Auth::user()->user_id;
										$notif->created_at = Carbon::now();
										$notif->updated_by = Auth::user()->user_id;
										$notif->updated_at = Carbon::now();
										$notif->save();
									}
								}
								
							}
							/* exit; */
				}
			}
			else
			{
				$from = strtr($request->valid_from, '/', '-');
				$to = strtr($request->valid_to, '/', '-');
				 $vaild_from = date("Y-m-d",strtotime($from));
				
				 $vaild_to = date("Y-m-d",strtotime($to));
				
			
				$ads->business_Id = $request->business_name;
				$ads->name = $request->ads_name;
				$ads->valid_from = $vaild_from;
				$ads->valid_to = $vaild_to;
				$ads->icon_image_url = 0;
				$ads->is_active = 1;
				$ads->created_by = 1;
				$ads->created_at = Carbon::now();
				$ads->updated_by = 1;
				$ads->updated_at = Carbon::now();
					if($ads->save())
					{
						$ads_inserted_id = $ads->id;
						$path=public_path('advertisement_images/uploads/doc/'.$ads_inserted_id);
														if (!is_dir($path)) {
															mkdir($path, 0777, TRUE);
															}
								$profile = $request->File('ads_image');
								$i =1;
								foreach($profile as $profiles)
								{
								$buss_img = new  Advertisement_Image;
								$buss_img->advertisement_id = $ads_inserted_id;
								$buss_img->sequence_no = /* rand(1000,10) */$i;
								$buss_img->is_active = 1;
								$buss_img->created_by = Auth::user()->user_id;
								$buss_img->created_at = Carbon::now();
								$buss_img->updated_by = Auth::user()->user_id;
								$buss_img->updated_at = Carbon::now();
								
								
							/* 	$buss_img->images_url = ""; */
								
								$filename = time().'.'.$profiles->getClientOriginalExtension();
								$file = time().''.$profiles->getClientOriginalName();
								$location_1 =$path;
								$profiles->move($location_1,$file);
								//Image::make($profiles)->save($location_1);
								$buss_img->image_url = $file;
								$buss_img->save();
								
								$i++;
								}
						
						
						
						$adv_offer = new Advertisement_Offer_Code;
						$adv_offer->advertisement_id = $ads_inserted_id;
						   $adv_offer->offer_code = $request->offer_code;
						   $adv_offer->offer_type_code = $request->offer_type_code;
						   $adv_offer->is_active = 1;
						   $adv_offer->created_by = Auth::user()->user_id;
						   $adv_offer->created_at = Carbon::now();
						   $adv_offer->updated_by = Auth::user()->user_id;
						   $adv_offer->updated_at = Carbon::now();
							$adv_offer->save();
							
						   $adv_search = new Advertisement_Search_Terms;
						   $adv_search->advertisement_id = $ads_inserted_id;
						   $adv_search->search_term = $request->search_term;
						   $adv_search->is_active = 1;
						   $adv_search->created_by = Auth::user()->user_id;
						   $adv_search->created_at = Carbon::now();
						   $adv_search->updated_by = Auth::user()->user_id;
						   $adv_search->updated_at = Carbon::now();
				  
						  $adv_search->save();
						foreach($request->category_name as $categ)
						{
						$ads_categ = new Advertisment_Category;
						$ads_categ->advertisement_id = $ads_inserted_id;
						$ads_categ->category_id = $categ;
						$ads_categ->is_active = 1;
						$ads_categ->created_by = Auth::user()->user_id;
						$ads_categ->created_at = Carbon::now();
						$ads_categ->updated_by = Auth::user()->user_id;
						$ads_categ->updated_at = Carbon::now();
						$ads_categ->save();
						}
						foreach($request->language_name as $key=>$lang)
						{
						$adv_desc = new Advertisement_Description;
						$adv_desc->advertisement_id = $ads_inserted_id;
						$adv_desc->description = $request->desc[$key];
						$adv_desc->caption = $request->caption[$key];
						$adv_desc->language_id = $lang;
						$adv_desc->is_active = 1;
						$adv_desc->created_by = Auth::user()->user_id;
						$adv_desc->created_at = Carbon::now();
						$adv_desc->updated_by = Auth::user()->user_id;
						$adv_desc->updated_at = Carbon::now();
						$adv_desc->save();
						}
						
						/* Push Noticification */
						
						$ads1 = Advertisment::query()
												->select('name','business_id','valid_from','valid_to')
												->where('advertisement_id',$ads_inserted_id)
												->get();
						$ads_desc1 = Advertisement_Description::query()
																	->select('description','caption')
																	->where('advertisement_id',$ads_inserted_id)
																	->get();
						$ads_adv_off1  = Advertisement_Offer_Code::query()
																	->select('offer_code')
																	->where('advertisement_id',$ads_inserted_id)
																	->get();
						$adv_img1 = Advertisement_Image::query()
														->select('image_url')
														->where('advertisement_id',$ads_inserted_id)
														->where('sequence_no',1)
														->get();

						$bus1 = Business::query()
											->select('name')
											->where('business_id',$ads1[0]->business_id)
											->get();
						$bus_img1 = DB::table('business_image')
														->select('images_url')
														->where('business_id',$ads1[0]->business_id)
														->where('sequence_no',1)
														->get();
							$path_image = URL::to('/').'/business_images/uploads/doc/'.$ads1[0]->business_id;
							$path_ads_image=URL::to('/').'advertisement_images/uploads/doc/'.$ads_inserted_id;
							$push_notification_details = array(
							'business_name'=>$bus1[0]->name,
							'business_id'=>$ads1[0]->business_id,
							'advertisement_id'=>$ads_inserted_id,
							'ads_valid_from'=>$ads1[0]->valid_from,
							'ads_valid_to'=>$ads1[0]->valid_to,
							'advertisement_name'=>$ads1[0]->name,
							'advertisement_caption'=>$ads_desc1[0]->caption,
							'business_img'=>$path_image.'/'.$bus_img1[0]->image_url,
							'advertisement_img'=>$path_ads_image.'/'.$adv_img1[0]->image_url,
							);
																
								$user = User::query()
											->select('device_id','device_name','user_id')
											->get();
								
							foreach($user as $us)
							{
								if($us->device_name == 'android')
								{
									$data = $this->sendNotificationAndroid($us->device_id,$us->device_name,$push_notification_details);
									if($data)
									{
										$notif = new Notification;
										
										$notif->business_id = $ads1[0]->business_id;
										$notif->advertisment_id = $ads_inserted_id;
										$notif->user_id = $us->user_id;
										$notif->type_of_message ="Offer Detail";
										$notif->message = "New offer is implemented";
										$notif->is_active = 1;
										$notif->created_by = Auth::user()->user_id;
										$notif->created_at = Carbon::now();
										$notif->updated_by = Auth::user()->user_id;
										$notif->updated_at = Carbon::now();
										$notif->save();
									}
								}
								else
								{
									$data = $this->sendNotificationIOS($us->device_id,$us->device_name,$push_notification_details);
									if($data)
									{
										$notif = new Notification;
										
										$notif->business_id = $ads1[0]->business_id;
										$notif->advertisment_id = $ads_inserted_id;
										$notif->user_id = $us->user_id;
										$notif->type_of_message ="Offer Detail";
										$notif->message = "New offer is implemented";
										$notif->is_active = 1;
										$notif->created_by = Auth::user()->user_id;
										$notif->created_at = Carbon::now();
										$notif->updated_by = Auth::user()->user_id;
										$notif->updated_at = Carbon::now();
										$notif->save();
									}
								}
								
							}
							/* exit; */

															
					}	
			}
			
			
						$log = new Activity_log;
						$log->user_id = Auth::user()->user_id;
						$log->activity_code = $request->activity_Code;
						$log->detail = "Create Advertisment";
						$log->is_active =1;
						$log->created_by = Auth::user()->user_id;
						$log->updated_by = Auth::user()->user_id;
						$log->created_at = Carbon::now();
						$log->updated_at = Carbon::now();
						
						$log->save();
			
			/* Push notification code start */
			
				/* $ads1 = Advertisment::query('name','business_id')
											->where('advertisement_id',$ads_inserted_id)
											->get(); */
			
			
			
			Session::flash('success',"Advertisment Created successfully");
						return redirect('ads_list');
		}
	    $business = Business::query()
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
		
		
		
		$lang = Language::query()
								->select('*')
								->where('is_active','=',1)
								->get();
	return view('adminpages.ads.adsadd',compact('business','category','category_value','result_parent_id_group','lang'));
	}
	public function advertisment_view($id)
	{
		$id = decrypt($id);
	


		$ads = Advertisment::query()
								->select('advertisement.*','ad_desc.description','ad_desc.caption','ad_cat.category_id','adv_image.image_url','adv_image.advertisement_image_id','adv_image.language_id','adv_offer_code.offer_code','adv_offer_code.offer_type_code','adv_search_term.search_term')
								->join('advertisement_description as ad_desc','advertisement.advertisement_id','=','ad_desc.advertisement_id','Left')
								->join('advertisement_category as ad_cat','advertisement.advertisement_id','=','ad_cat.advertisement_id','Left')
								->join('advertisement_image as adv_image','advertisement.advertisement_id','=','adv_image.advertisement_id','Left')
								->join('advertisement_offer_code as adv_offer_code','advertisement.advertisement_id','=','adv_offer_code.advertisement_id','Left')
								->join('advertisement_search_term as adv_search_term','advertisement.advertisement_id','=','adv_search_term.advertisement_id','Left')
								->where('advertisement.advertisement_id','=',$id)
							
								->get();
				/* DB::enableQueryLog(); */
			$adv_desc = Advertisement_Description::query()
													->select('*')
													->where('advertisement_id',$id)
													->get();
													
			$adv_categ = Advertisment_Category::query()
													->select('*')
													->where('advertisement_id',$id)
													->get()->toarray();
													
													
													
			foreach($adv_categ as $categroy_selected) {
				$cat_sel_id[]=$categroy_selected['category_id'];
			}						
			$category_par_id = Categories::query()
					->select('*')
					->whereIn('category_id',$cat_sel_id)
					->get();
				 foreach($category_par_id  as $val){
					 
					 $cat_id_val_par[]=$val->category_id;
				 }					
				//print_r($parent_cat_id_val);
//print_r($cat_id_val);				
							
			
			/* DB::enableQueryLog(); */
			$adv_img =  Advertisement_Image::query()
													->select('*')
													->where('advertisement_id',$id)
													->get();
								
								/* $query = DB::getQueryLog();
							$query = end($query);
							print_r($query); */
			
					
		 $business = Business::query()
								->select('*')
								->where('is_active','=',1)
								->get();
		/*$category = Categories::query()
									->select('*')
									->where('is_active','=',1)
									->get();*/
				$category = Categories::query()
					->select('*')
					->where('is_active','=',1)
					->groupBY('category_name')
					->get();
				$category_list=Categories::query()
					->select('*')
					->where('is_active','=',1)
					->where('parent_category_id','=','0')
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
									
		$lang = Language::query()
								->select('*')
								->where('is_active','=',1)
								->get();
			return view('adminpages.ads.adsedit',compact('ads','business','category','category_list','cat_id_val_par','result_parent_id_group','lang','adv_desc','adv_img','adv_categ'));
	}
	public function advertisment_update(Request $request,$id)
	{
		$id = decrypt($id);
		if($request->hasFile('ads_icon'))
		{
			$from = strtr($request->valid_from, '/', '-');
			$to = strtr($request->valid_to, '/', '-');
			 $vaild_from = date("Y-m-d",strtotime($from));
			
			 $vaild_to = date("Y-m-d",strtotime($to));
			
			$path=public_path('ads1/uploads/doc/'.$id);
									if (!is_dir($path)) {
													mkdir($path, 0777, TRUE);
													}
									
										$profile = $request->File('ads_icon');
											$filename = time().'.'.$profile->getClientOriginalExtension();
											$file = time().''.$profile->getClientOriginalName();
											$location_1 = $path;
											$profile->move($location_1,$file);
											
											//Image::make($profile)->save($location_1);
											$business_update = Advertisment::query()
																		->where('advertisement_id','=',$id)
																		->update(
																		[
																		'icon_image_url' =>$file,
																		'business_id'=>$request->business_name,
																		'name' => $request->ads_name,
																		'valid_from'=>$vaild_from,
																		'valid_to'=>$vaild_to,
																		'updated_at'=>Carbon::now()
																		]);
			$adv_offer = Advertisement_Offer_Code::query()
													->select('*')
													->where('advertisement_id',$id)
													->update([
													'offer_code' => $request->offer_code,
													'offer_type_code' => $request->offer_type_code,
													'updated_at'=>Carbon::now()
													]);
						
		$adv_search = Advertisement_Search_Terms::query()
													->select('*')
													->where('advertisement_id',$id)
													->update([
													'search_term' => $request->search_term,
													'updated_at'=>Carbon::now()
													]); 

												
			$adv_cat = Advertisment_Category::query()
													->where('advertisement_id',$id)
													->delete();
																
				foreach($request->category_name as $categ)
				{
				$ads_categ = new Advertisment_Category;
				$ads_categ->advertisement_id = $id;
				$ads_categ->category_id = $categ;
				$ads_categ->is_active = 1;
				$ads_categ->created_by = Auth::user()->user_id;
				$ads_categ->created_at = Carbon::now();
				$ads_categ->updated_by = Auth::user()->user_id;
				$ads_categ->updated_at = Carbon::now();
				$ads_categ->save();
				}

		$adv_des = Advertisement_Description::query()
													->where('advertisement_id',$id)
													->delete();
										
																
		foreach($request->language_name as $key=>$lang)
				{
				$adv_desc = new Advertisement_Description;
				$adv_desc->advertisement_id = $id;
				$adv_desc->description = $request->desc[$key];
				$adv_desc->caption = $request->caption[$key];
				$adv_desc->language_id = $lang;
				$adv_desc->is_active = 1;
				$adv_desc->created_by = Auth::user()->user_id;
				$adv_desc->created_at = Carbon::now();
				$adv_desc->updated_by = Auth::user()->user_id;
				$adv_desc->updated_at = Carbon::now();
				$adv_desc->save();
				}
				
																		
				
		}
		
		if($request->hasFile('ads_image'))
	   {
			
				$path=public_path('advertisement_images/uploads/doc/'.$id);
												if (!is_dir($path)) {
													mkdir($path, 0777, TRUE);
													}
						$profile_1 = $request->File('ads_image');
						$images_get_seq=Advertisement_Image::query()->select('*')->where('advertisement_id',$id)->get();
						foreach($images_get_seq as $val){
							$seq_no=$val->sequence_no;
						}
						$i=$seq_no+1;
						foreach($profile_1 as $profiles)
						{
						$buss_img = new  Advertisement_Image;
						$buss_img->advertisement_id = $id;
						$buss_img->sequence_no = /* rand(1000,10) */$i;
						$buss_img->is_active = 1;
						$buss_img->created_by = Auth::user()->user_id;
						$buss_img->created_at = Carbon::now();
						$buss_img->updated_by = Auth::user()->user_id;
						$buss_img->updated_at = Carbon::now();
						
						
					/* 	$buss_img->images_url = ""; */
						
						$filename = time().'.'.$profiles->getClientOriginalExtension();
						$file = time().''.$profiles->getClientOriginalName();
						$location_1 = $path;
						$profiles->move($location_1,$file);
						//Image::make($profiles)->save($location_1);
						$buss_img->image_url = $file;
						$buss_img->save();
						$i++;
						}
																		
																		
																		
				  $adv_offer = Advertisement_Offer_Code::query()
													->select('*')
													->where('advertisement_id',$id)
													->update([
													'offer_code' => $request->offer_code,
													'offer_type_code' => $request->offer_type_code,
													'updated_at'=>Carbon::now()
													]);
						
				$adv_search = Advertisement_Search_Terms::query()
													->select('*')
													->where('advertisement_id',$id)
													->update([
													'search_term' => $request->search_term,
													'updated_at'=>Carbon::now()
													]); 

						$adv_cat = Advertisment_Category::query()
								->where('advertisement_id',$id)
								->delete();
																
				foreach($request->category_name as $categ)
				{
				$ads_categ = new Advertisment_Category;
				$ads_categ->advertisement_id = $id;
				$ads_categ->category_id = $categ;
				$ads_categ->is_active = 1;
				$ads_categ->created_by = Auth::user()->user_id;
				$ads_categ->created_at = Carbon::now();
				$ads_categ->updated_by = Auth::user()->user_id;
				$ads_categ->updated_at = Carbon::now();
				$ads_categ->save();
				}
				
		$adv_des = Advertisement_Description::query()
													->where('advertisement_id',$id)
													->delete();
																
		foreach($request->language_name as $key=>$lang)
				{
				$adv_desc = new Advertisement_Description;
				$adv_desc->advertisement_id = $id;
				$adv_desc->description = $request->desc[$key];
				$adv_desc->caption = $request->caption[$key];
				$adv_desc->language_id = $lang;
				$adv_desc->is_active = 1;
				$adv_desc->created_by = Auth::user()->user_id;
				$adv_desc->created_at = Carbon::now();
				$adv_desc->updated_by = Auth::user()->user_id;
				$adv_desc->updated_at = Carbon::now();
				$adv_desc->save();
				}
																
	   }
	   
			$from = strtr($request->valid_from, '/', '-');
			$to = strtr($request->valid_to, '/', '-');
			 $vaild_from = date("Y-m-d",strtotime($from));
			
			 $vaild_to = date("Y-m-d",strtotime($to));
				$business_update = Advertisment::query()
											->where('advertisement_id','=',$id)
											->update([
													'business_id'=>$request->business_name,
													'name' => $request->ads_name,
													'valid_from'=>$vaild_from,
													'valid_to'=>$vaild_to,
													'updated_at'=>Carbon::now()
													]);
	   
	     $adv_offer = Advertisement_Offer_Code::query()
													->select('*')
													->where('advertisement_id',$id)
													->update([
													'offer_code' => $request->offer_code,
													'offer_type_code' => $request->offer_type_code,
													'updated_at'=>Carbon::now()
													]);
						
		$adv_search = Advertisement_Search_Terms::query()
													->select('*')
													->where('advertisement_id',$id)
													->update([
													'search_term' => $request->search_term,
													'updated_at'=>Carbon::now()
													]); 
		$adv_cat = Advertisment_Category::query()->where('advertisement_id',$id)->delete();
																
				foreach($request->category_name as $categ)
				{
				$ads_categ = new Advertisment_Category;
				$ads_categ->advertisement_id = $id;
				$ads_categ->category_id = $categ;
				$ads_categ->is_active = 1;
				$ads_categ->created_by = Auth::user()->user_id;
				$ads_categ->created_at = Carbon::now();
				$ads_categ->updated_by = Auth::user()->user_id;
				$ads_categ->updated_at = Carbon::now();
				$ads_categ->save();
				}
																
																
			$adv_des = Advertisement_Description::query()
													->where('advertisement_id',$id)
													->delete();
																
																
																
			foreach($request->language_name as $key=>$lang)
				{
				$adv_desc = new Advertisement_Description;
				$adv_desc->advertisement_id = $id;
				$adv_desc->description = $request->desc[$key];
				$adv_desc->caption = $request->caption[$key];
				$adv_desc->language_id = $lang;
				$adv_desc->is_active = 1;
				$adv_desc->created_by = Auth::user()->user_id;
				$adv_desc->created_at = Carbon::now();
				$adv_desc->updated_by = Auth::user()->user_id;
				$adv_desc->updated_at = Carbon::now();
				$adv_desc->save();
				}
					$log = new Activity_log;
					$log->user_id = Auth::user()->user_id;
					$log->activity_code = $request->activity_Code;
					$log->detail = "Updated Advertisment";
					$log->is_active =1;
					$log->created_by = Auth::user()->user_id;
					$log->updated_by = Auth::user()->user_id;
					$log->created_at = Carbon::now();
					$log->updated_at = Carbon::now();
					
					$log->save();								
		
					Session::flash('success',"Advertisment Updated successfully");
					return redirect('ads_list');
	   }
			
	public function advertisment_single_view(Request $request)
	{
		/* echo "jfe";exit; */
		$id = $request->uid;
		/* echo $id;exit; */
		$ads = Advertisment::query()
								->select('*')
								->where('advertisement_id',$id)
								->get();
		$business = Business::query()
								->select('*')
								->get();
								
		$adv_desc = Advertisement_Description::query()
												->select('*')
												->where('advertisement_id',$id)
												->get();
				$buss_name = "";
				foreach($business as $buss)
				{
					if($ads[0]->business_id == $buss->business_id)
					{
						$buss_name = $buss->name;
					}
				}
		$adv_img = Advertisement_Image::query()
										->select('*')
										->where('advertisement_id',$id)
										->get();
										
	$adv_des = Advertisement_Description::query()
													->select(DB::raw('group_concat(language.name_in_english) as language'))
													->join('language','advertisement_description.language_id','=','language.language_id','Left')
													->where('advertisement_description.advertisement_id',$id)
													->groupBy('advertisement_description.advertisement_id')
													->get();
	 $adv_offer = Advertisement_Offer_Code::query()
												->select('*')
												->where('advertisement_id',$id)
												->get();
												
	$adv_search = Advertisement_Search_Terms::query()
												->select('*')
												->where('advertisement_id',$id)
												->get();
												
	$adv_categ	= Advertisment_Category::query()
											->select('category.category_name','advertisement_category.*')
											->join('category','advertisement_category.category_id','=','category.category_id','Left')
											->where('advertisement_id',$id)
											->get();
													
				$date_from = date('d-m-Y', strtotime($ads[0]->valid_from));
			$date_to = date('d-m-Y', strtotime($ads[0]->valid_to));
			
				
			 $path='ads1/uploads/doc/'.$ads[0]->advertisement_id.'/'.$ads[0]->icon_image_url;
			
			if(!($ads[0]->icon_image_url)) 
			{
				$icon_url = 'No image available';
			}
			else
			{
				if(file_exists($path))
				{
				$icon = url($path);
				$icon_url = "<img src=".$icon." width='50px' height='50px' class='img-circle'>";
				}
				else
				{
					$icon_url = 'No image available';
				}
			}
			$html="";
			
				$html.= "<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Business Name:</label><div class='col-md-6'>".$buss_name."</div></div><div class='box-body'><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Advertisement Name:</label><div class='col-md-6'>".$ads[0]->name."</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Valid From:</label><div class='col-md-6'>".$date_from."</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Valid To:</label><div class='col-md-6'>".$date_to ."</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Offer Code:</label><div class='col-md-6'>".$adv_offer[0]->offer_code."</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Offer Type Code:</label><div class='col-md-6'>".$adv_offer[0]->offer_type_code."</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Search Terms:</label><div class='col-md-6'>".$adv_search[0]->search_term."</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Advertisement Icon:</label><div class='col-md-6'>".$icon_url."</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Description:</label><div class='col-md-6'>";
				foreach($adv_desc as $adv_descr)
				{
				$html.="<div>".$adv_descr->description."</div>";
				}
				
				$html.="</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Caption:</label><div class='col-md-6'>";
				foreach($adv_desc as $adv_descr_1)
				{
				$html.= "<div>".$adv_descr_1->caption ."</div>";
				}
				$html.="</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Language:</label><div class='col-md-6'>";
				foreach($adv_des as $adv_desr)
				{
				$html.= "<div>".$adv_desr->language ."</div>";
				}
				
				$html.="</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Advertisement Image:</label><div class='col-md-6'>";
				$i=1;
				foreach($adv_img as $adv_im)
				{
				$path_1='advertisement_images/uploads/doc/'.$adv_im->advertisement_id .'/'.$adv_im->image_url ;
				$image_1 = url($path_1);
				$html.= "<img src=".$image_1." width='50px' height='50px' class='img-circle' onclick='openModal();currentSlide(".$i.")' >";
				$images[]=$adv_im->image_url;
				$i++;}
				$html.="</div></div><div class='px-3 row'><label class='col-md-5 control-label' for='inputEmail3'>Category Name:</label><div class='col-md-6'>";
				foreach($adv_categ as $cat)
				{
					$html.="<div>".$cat->category_name."</div>";
				}
				$html.="</div></div></div></div>";
				//print_r($images);
				$count_images_gallery= count($images);
				
				
				$html .="
					<div id='myModal' class='modal_gallery'>
						<span class='close_button_gallery cursor' onclick='closeModal()'>&times;</span>
							<div class='modal_content_gallery'>";
							$adv_img_1 = Advertisement_Image::query()
										->select('*')
										->where('advertisement_id',$id)
										->get();
					$j=1;
					foreach($adv_img_1 as $adv_im)
					{
						$path_image='advertisement_images/uploads/doc/'.$adv_im->advertisement_id .'/'.$adv_im->image_url;
						$images_value = url($path_image);
					
								$html.="<div class='mySlides'>
										<div class='numbertext'>".$j." / ".$count_images_gallery."</div>
											<img src=".$images_value." style='width:100%;height: 400px;' class='img-responsive'>
									</div>";
							
						$j++;
						}
				
							//echo $count_images_gallery;
						$html .="	<a class='prev_gallery' onclick='plusSlides(-1)'>&#10094;</a>
									<a class='next_gallery' onclick='plusSlides(1)'>&#10095;</a>
									
								</div>";
				
				
				$html.="<script>
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
				 
				 echo $html;
	}
	public function advertisment_delete(Request $request,$id)
	{
		$id = decrypt($id);
		$ads = Advertisment::query()
								->where('advertisement_id',$id)
								->delete();
								
		$adv_offer = Advertisement_Offer_Code::query()
													->select('*')
													->where('advertisement_id',$id)
													->delete();
						
		$adv_search = Advertisement_Search_Terms::query()
													
													->where('advertisement_id',$id)
													->delete(); 

		$ads = Advertisment_Category::query()
										->where('advertisement_id',$id)
										->delete();
	$adv_desc = Advertisement_Description::query()
													->where('advertisement_id',$id)
													->delete();
													
													
	$adv_img = Advertisement_Image::query()
										->where('advertisement_id','=',$id)
										->delete();
	$user_saved_adv = DB::table('user_saved_advertisement')
										->where('advertisement_id','=',$id)
										->delete();

			Session::flash('success',"Advertisment Deleted successfully");
			return redirect('ads_list');
	}
	public function single_active(Request $request)
	{
		/* echo Auth::user()->user_id;exit; */
		$status = $request->status;
		$id = $request->id;
		$ads = Advertisment::query()
								->where('advertisement_id',$id)
								->update([
								'is_active'=>$status,
								'updated_at'=>Carbon::now()
								 ]);
								 
		
								 
		$ads_get = Advertisment::query()
								->select('*')
								->where('advertisement_id',$id)
								->get();
			echo $ads_get[0]->is_active;
	}
	
	public function adv_img_remove(Request $request)
	{
		$ads_img_id = $request->id;
		$aid = $request->aid;
		$seq_no=$request->seq_no;
		
		$ads_del_get = Advertisement_Image::query()
								->where('advertisement_image_id',$ads_img_id)
								->delete();
		$ads_get_id = Advertisement_Image::query()
								->where('advertisement_id',$aid)
								->get();
		$ads_images_id=array();
		foreach($ads_get_id as $values){
			$ads_images_id[]=$values['advertisement_image_id'];
			
		}
		$i=1;
		foreach($ads_images_id as $values) {
			
		$ads_update_img=Advertisement_Image::query()
							->where('advertisement_image_id','=',$values)
							->where('advertisement_id','=',$aid)
							->update([
									'sequence_no' =>$i,
									'updated_at'=>Carbon::now()
									]);
		$i++;	
		}
		
		if($ads_del_get) {
			echo "1";
		}
		else {
			echo "0";
		}
		
	}
	public function ads_searchterm_unique(Request $request)
	{
			$search_term = $request->search_term;
		/* echo $email;exit; */
		$adv_s_term = Advertisement_Search_Terms::query()
											->select('*')
											->where('search_term',$search_term)
											->get();
			/* print_r($user);exit; */
		if($adv_s_term->isNotEmpty())
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	public function ads_offercode_unique(Request $request)
	{
		$offer_code = $request->offer_code;
		
		$adv_offer_code = Advertisement_Offer_Code::query()
											->select('*')
											->where('offer_code',$offer_code)
											->get();
			/* print_r($user);exit; */
		if($adv_offer_code->isNotEmpty())
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	
	public function ads_searchterm_unique2(Request $request)
	{
		$search_term = $request->search_term;
		$ads_id = $request->ads_id;
		/* echo $email;exit; */
		$adv_s_term_1 = Advertisement_Search_Terms::query()
											->select('*')
											->where('advertisement_id',$ads_id)
											->where('search_term',$search_term)
											->get();
											
		if($adv_s_term_1->isEmpty())
		{
			$adv_s_term = Advertisement_Search_Terms::query()
												->select('*')
												->where('search_term',$search_term)
												->get();
				/* print_r($user);exit; */
			if($adv_s_term->isNotEmpty())
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
	}
	public function ads_offercode_unique2(Request $request)
	{
		$offer_code = $request->offer_code;
		$ads_id = $request->ads_id;
		$adv_offer_code_1 = Advertisement_Offer_Code::query()
											->select('*')
											->where('advertisement_id',$ads_id)
											->where('offer_code',$offer_code)
											->get();
		if($adv_offer_code_1->isEmpty())
		{
			$adv_offer_code = Advertisement_Offer_Code::query()
											->select('*')
											->where('offer_code',$offer_code)
											->get();
			/* print_r($user);exit; */
			if($adv_offer_code->isNotEmpty())
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
	}
	
	
public function sendNotificationAndroid($device_id,$device_name,$push_notification_details)
{
	/* echo "fsagdf";exit; */
 $SERVER_KEY = 'AIzaSyDM2DZPXqvYVB1mwnvcyXjE01gA335GPv4';
/* $registrationIds = array('epBOOQC4TCA:APA91bF5rhrbv5V340l6ptIAVhRhVtJCSAylKFKhFXerKFcVuNHMgCf_1jBiBq4riHoU1HUNc70QmxrxGwfftyc1dtBpwoDolKkDcxfBVKYUjicp1emdeocboL5VM878y5sH2vX6H773'); */
$registrationIds = array($device_id);
// prep the bundle
/*$msg = array
 (
	'message' 	=> $push_notification_details,
	/* 'title'		=> 'This is a title. title',
	'subtitle'	=> 'This is a subtitle. subtitle',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
);  */
$msg =  $push_notification_details;
$fields = array
(
	 /* 'to' => $registrationIds, */ //for single user  
		/*(OR) */
	'registration_ids' => $registrationIds, //  for  multiple users
	'data'	=> $msg
);
	 
$headers = array
(
	'Authorization: key='.$SERVER_KEY,
	'Content-Type: application/json'
); 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
if ($result === FALSE) 
{
       die('FCM Send Error: ' . curl_error($ch));
}
curl_close( $ch );
 /* print_r($result); */
return $result;
}

/* Push notification for IOS */
public function sendNotificationIOS($deviceToken,$device_name,$push_notification_details)
{
	if(trim($deviceToken) != ' '){
		
				$path =public_path('/certificate_ios/dev.pem');
				$gateway = 'ssl://gateway.sandbox.push.apple.com:2195';
				$ctx = stream_context_create();
				stream_context_set_option($ctx, 'ssl', 'local_cert', $path);
				stream_context_set_option($ctx, 'ssl', 'passphrase', 'Open@123');

				$fp = stream_socket_client(
				$gateway, $err,
				$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

				if (!$fp) {
				die("Failed to connect: $err $errstr");
				}

				stream_set_blocking($fp, 0);
				$body['aps'] = array(
				'alert' =>$push_notification_details,
				'date' => date("yyyy-MM-dd HH:mm:ss"),
				'order_id' => 0,
				'servertime' => date("d-m-Y"),
				'sound' => 'default'
				);
				$payload = json_encode($body);
<<<<<<< .mine
				$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken). pack('n', strlen($payload)).$payload;
||||||| .r2735
				$msg = chr(0) . pack('n', 32). pack('H*', sprintf('%u', CRC32($deviceToken))). pack('n', strlen($payload)).$payload;
=======
				$msg = chr(0) . pack('n', 32). pack('H*', $deviceToken). pack('n', strlen($payload)).$payload;
>>>>>>> .r2737
				$result = fwrite($fp, $msg, strlen($msg));
				fclose($fp);
	}

 
	}
	
public function get_notify(Request $request)
{
		$path =public_path('/certificate_ios/dev.pem');
		$gateway = 'ssl://gateway.sandbox.push.apple.com:2195';
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', $path);
		stream_context_set_option($ctx, 'ssl', 'passphrase', 'Open@123');

		$fp = stream_socket_client(
		$gateway, $err,
		$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp) {
		die("Failed to connect: $err $errstr");
		}

		stream_set_blocking($fp, 0);
		$body['aps'] = array(
		'alert' =>'hello',
		'date' => date("yyyy-MM-dd HH:mm:ss"),
		'order_id' => 0,
		'servertime' => date("d-m-Y"),
		'sound' => 'default'
		);
		$payload = json_encode($body);
		$msg = chr(0) . pack('n', 32) . pack('H*', 'FE26D3BAD6407DA8E5FC92C396A2107A515E6D5C7974F827D3CEB892E3FCD9A4'). pack('n', strlen($payload)).$payload;
		$result = fwrite($fp, $msg, strlen($msg));
		fclose($fp);
		
	
}	
	
	
	
	
}