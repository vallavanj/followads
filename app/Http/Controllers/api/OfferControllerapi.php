<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use App\User_Redemmed_Advertisement_Code;
use App\User_Saved_Advertisement;

class OfferControllerapi extends Controller
{
  
  
  public function offer_details(Request $request) {
	  
	
	  $advertisement_id=$request->advertisement_id;
	  $user_id=$request->user_id;
	  $user_lat=$request->user_lat;
	  $user_lng=$request->user_lng;
	  if($advertisement_id) 
			{
				//DB::connection()->enableQueryLog();
				
				
				
				
			/** remind me status **/	
				$user_remind_me_status=DB::table('user_saved_advertisement')
				->select('*','user_saved_advertisement.created_at as created_time','user_saved_advertisement.is_active as active_reminder')
				->join('advertisement','advertisement.advertisement_id','=','user_saved_advertisement.advertisement_id')
				->where('user_saved_advertisement.user_id','=',$user_id)
				->where('user_saved_advertisement.advertisement_id','=',$advertisement_id)
				->get();
				$get_remider_status = count($user_remind_me_status);
				foreach($user_remind_me_status as $value) {
					
					$remind_me_created_time=$value->created_time;
					$reminder_status_value=$value->active_reminder;
				}
				if(!empty($remind_me_created_time))
							{	$is_reminder_status_value=$reminder_status_value;	}
				else 		{	$is_reminder_status_value=''; }
				
				if(!empty($remind_me_created_time))
				{
						if($remind_me_created_time == '0000-00-00 00:00:00') 
						{	$reminder_time='';	}
						else
						{	$reminder_time=$remind_me_created_time;	}	
				}	
				else {		
						$reminder_time='';	
					}
				
			
				/** user rating count  */
						//	Sum of (weight * number of reviews at that weight) / total number of reviews
						//      (5*252 + 4*124 + 3*40 + 2*29 + 1*33) / 478 = 4.1
						
				$star5=DB::table('user_business_rating')
							->select('*')
							->where('rating','=','5.00')
							->where('advertisement_id','=',$advertisement_id)
							->count();
				$star4=DB::table('user_business_rating')
							->select('*')
							->where('rating','=','4.00')
							->where('advertisement_id','=',$advertisement_id)
							->count();
				$star3=DB::table('user_business_rating')
						->select('*')
						->where('rating','=','3.00')
						->where('advertisement_id','=',$advertisement_id)
						->count();
				$star2=DB::table('user_business_rating')
						->select('*')
						->where('rating','=','2.00')
						->where('advertisement_id','=',$advertisement_id)
						->count();
				$star1=DB::table('user_business_rating')
							->select('*')
							->where('rating','=','1.00')
							->where('advertisement_id','=',$advertisement_id)
							->count();
									
						$sum_rating_star=5*$star5+4*$star4 +3*$star3 + 2*$star2 + 1*$star1;
						$sum_count=$star5+$star4+$star3+$star2+$star1;
						if(!empty($sum_rating_star)){
						$rating_count=$sum_rating_star/$sum_count;
						}
						else {
						$rating_count='0';	
						}
						/*  */
						$ads_bus_id=DB::table('advertisement')
									->where('advertisement_id','=',$advertisement_id)
									->where('is_active','=',1)
									->select('*')
									->get();	
						foreach($ads_bus_id as $value) {
							$business_id=$value->business_id;
						}
									
				
				/** user_used_coupon **/
					$user_used_coupon = DB::table('advertisement')
					->join('advertisement_offer_code','advertisement.advertisement_id','=','advertisement_offer_code.advertisement_id')
					->join('advertisement_description','advertisement.advertisement_id','=','advertisement_description.advertisement_id')
					->join('user_redemmed_advertisement_code','advertisement_offer_code.advertisement_offer_code_id','=','user_redemmed_advertisement_code.advertisement_offer_code_id')
					->where('advertisement_offer_code.advertisement_id','=',$advertisement_id)
					->where('user_redemmed_advertisement_code.user_id','=',$user_id)
					->count();			
					//print_r(DB::getQuerylog());
					
				/** user saved advertisment count  **/	
					$User_Saved_Advertisement = DB::table('user_saved_advertisement')
					->where('user_id','=',$user_id)
					->where('advertisement_id','=',$advertisement_id)
					->count();			
				if($User_Saved_Advertisement > 0)
				{
					$user_liked_count = 1;
				}
				else
				{
					$user_liked_count = 0;
				}
				/***  Business Intreset Count  **/
				$Intreset_count = DB::table('user_followed_business')
				->where('business_id','=',$business_id)
				->count();
				
				/** Advertisment Feedback for  given Id **/	
				$feedback_rating=DB::table('user_business_rating')
				->select('*','user_business_rating.created_at as created_time')
				->join('users','users.user_id','=','user_business_rating.user_id')
				->where('user_business_rating.advertisement_id','=',$advertisement_id)
				->orderBy('business_user_rating_id', 'desc')
				->get();
									
				$feed_bac_rat=array();
				$date_now=Carbon::now()->toDateTimeString();
				
				foreach($feedback_rating as $value) {
							//$value_split=explode(' ',$value->created_by);
							//$posted_time= date("d-m-Y", strtotime($value_split['0']));
								
									$feed_bac_rat[]=array(
									'user_id'=>$value->user_id,
									'business_id'=>$value->business_id,
									'user_name'=>$value->name,
									'title'=>$value->title,
									'advertisement_id'=>$value->advertisement_id,
									'rating'=>$value->rating,
									'feedback'=>$value->feedback,
									'posted_time'=>$value->created_time,
									'current_server_time'=>$date_now,
								);
							}
						
					/**  Review count of given advertisment Id   **/
							
				
							$review_count=DB::table('user_business_rating')
							->where('business_id','=',$business_id)
							->count();
					/** Advertisment Image all **/	
						$ads_image=DB::table('advertisement')
						->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
						->where('advertisement.advertisement_id','=',$advertisement_id)
						->select('*')
						->get();
						$advertisement_img_all=array();
						foreach($ads_image as $value) {
								$advertisement_img_all[]=array(
								'advertisement_img'=>url('/').'/advertisement_images/uploads/doc/'.$value->advertisement_id.'/'.$value->image_url,
									);	
							}	
						$ads_bus_id=DB::table('advertisement')
									->where('advertisement_id','=',$advertisement_id)
									->where('is_active','=',1)
									->select('*')
									->get();	
						foreach($ads_bus_id as $value) {
							$business_id=$value->business_id;
						}
					$offer_details=DB::table('advertisement')
						->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
						->join('business','advertisement.business_id','=','business.business_id')
						->join('advertisement_business_address','advertisement_business_address.advertisement_id','=','advertisement.advertisement_id')
						->join('advertisement_offer_code','advertisement_offer_code.advertisement_id','=','advertisement.advertisement_id')
						->join('business_address','advertisement_business_address.business_address_id','=','business_address.business_address_id')
						->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id')
						->where('advertisement.advertisement_id','=',$advertisement_id)
						->where('advertisement_image.sequence_no','=',1)
						->select('*')
						->get();
						/* For Caption And Description As Per Language */
						$offer_details_description=DB::table('advertisement_description')
													->select('*')
													->where('advertisement_id','=',$advertisement_id)
													->where('language_id','=',$request->lang_id)
													->get();
																			/* print_r($offer_details_description);exit; */
								if($offer_details_description->isNotEmpty())
								{
									$description = $offer_details_description[0]->description; 
									$caption = $offer_details_description[0]->caption; 
								}
								else
								{
									$description = ""; 
									$caption = "";
								}
					$offer_details_all=array();
					/*$adsimages=trim($advertisement_img_all, "[]");
					print_r($adsimages);
					exit;*/
					
					
					foreach($offer_details as $val)
					{
							$value_split=explode(' ',$val->valid_from);
							$valid_from = date("d-m-Y", strtotime($value_split['0']));
							$value_split_to=explode(' ',$val->valid_to);
							$valid_to = date("d-m-Y", strtotime($value_split_to['0']));
							
							$latitudeFrom = $request->user_lat;
							$longitudeFrom = $request->user_lng;
							$latitudeTo = $val->latitude;
							$longitudeTo = $val->longitude;
							$theta = $longitudeFrom - $longitudeTo;
							$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
							$dist = acos($dist);
							$dist = rad2deg($dist);
							$miles = $dist * 60 * 1.1515;
							$distance = ($miles * 1.609344);
								//$location = json_decode($val->location);
								$offer_details_all=array(
								//'off_img' =>url('/').'/ads1/uploads/doc/'.$val->advertisement_id.'/'.$val->icon_image_url,
								//'advertisment_img'=>url('/').'advertisement_images/uploads/doc/'.$val->advertisement_id.'/'.$val->image_url,
								'advertisement_img'=>$advertisement_img_all,
								'advertisement_id'=>$val->advertisement_id,
								/* 'advertisement_desc' =>$val->description, */
								'advertisement_desc' =>$description,
								'advertisement_valid_from'=>$valid_from,
								'advertisement_valid_to'=>$valid_to,
								/* 'advertisement_caption'=>$val->caption, */
								'advertisement_caption'=>$caption,
								'advertisement_offer_code'=>$val->offer_code,
								'advertisement_offer_type'=>$val->offer_type_code,
								'business_id'=>$business_id,
								'business_name'=>$val->name,
								'business_img'=>url('/').'/business1/uploads/doc/'.$business_id.'/'.$val->logo_url,
								'business_addr'=>$val->address,
								'business_phone_num'=>$val->phone_number,
								'business_dist'=>round($distance,2).' m',
								'business_lat'=>$val->latitude,
								'business_lan'=>$val->longitude,
								'business_interest_count'=>$Intreset_count,
								'business_reviews_count'=>$review_count,
								'rating_count'=>round($rating_count),
								'is_liked'=>$user_liked_count,
								'user_used_coupon'=>$user_used_coupon,
								'ads_reminder_status'=>$is_reminder_status_value,
								'ads_reminder_time'=>$reminder_time,
								'advertisement_reviews'=>$feed_bac_rat,
								
								);
					}
				return response()->json(["error"=>"success","error_code"=>"200",'advertisement_detail'=>$offer_details_all]);  
			    
			
			
			}
		else 
			{
				return response()->json(["error"=>"error","error_code"=>"500",'message'=>'Offer Details Not available']); 
			}
							
							
	  
  }
  
  
public function  User_used_offer_code(Request $request) {
	
	$advertisement_id=$request->advertisement_id;
	$user_id=$request->user_id;
	$business_id=$request->business_id;
	$offer_code=$request->offer_code;
	if($advertisement_id){
		
		
		$get_advertisement_offer_code_id=DB::table('advertisement_offer_code')
										->where('offer_code','=',$offer_code)
										->get();
		foreach($get_advertisement_offer_code_id as $id_val){
			$ads_offer_id=$id_val->advertisement_offer_code_id;
		}
		
				$user_save_ads=new User_Redemmed_Advertisement_Code;
				$user_save_ads->user_id = $request->user_id;
				$user_save_ads->advertisement_offer_code_id =$ads_offer_id;
				$user_save_ads->is_active = 1;
				$user_save_ads->created_by = $request->user_id;
				$user_save_ads->created_at = Carbon::now();
				$user_save_ads->updated_by = $request->user_id;
				$user_save_ads->updated_at = Carbon::now();
				if($user_save_ads->save())
				{
					
					$saved_count=DB::table('user_redemmed_advertisement_code')
										->where('user_id','=',$request->user_id)
										->count();
				
					return response()->json(["error"=>"success","error_code"=>"200",'message'=>'Offer code used successfully','user_ads_save_count'=>$saved_count]);  
			   	
				}
		
		
	}
	else {
		return response()->json(["error"=>"error","error_code"=>"500",'message'=>'Offer code not used']); 
	}
	
	
	
}

public function User_used_offer_code_list(Request $request) {
	
	$user_id=$request->user_id;
	if($user_id){
		
			$user_list_data=DB::table('advertisement')
					->join('advertisement_offer_code','advertisement.advertisement_id','=','advertisement_offer_code.advertisement_id')
					->join('advertisement_description','advertisement.advertisement_id','=','advertisement_description.advertisement_id')
					->join('user_redemmed_advertisement_code','advertisement_offer_code.advertisement_offer_code_id','=','user_redemmed_advertisement_code.advertisement_offer_code_id')
					->where('user_redemmed_advertisement_code.user_id','=',$user_id)
					->get();
			$user_used_coupon_list=array();
			foreach($user_list_data as $id_val){
			
			
						$value_split=explode(' ',$id_val->valid_from);
						$valid_from = date("d-m-Y", strtotime($value_split['0']));
						$value_split_to=explode(' ',$id_val->valid_to);
						$valid_to = date("d-m-Y", strtotime($value_split_to['0']));
						$used_coupon=explode(' ',$id_val->created_at);
						$used_coupon_date = date("d-m-Y", strtotime($used_coupon['0']));
				
				$user_used_coupon_list[]=array(
							"user_id"=>$id_val->user_id,
							"advertisement_id"=>$id_val->advertisement_id,
							"advertisement_name"=>$id_val->name,
							"business_id"=>$id_val->business_id,
							"advertisement_valid_from"=>$valid_from,
							"advertisement_valid_to"=>$valid_to,
							"used_coupon_date"=>$used_coupon_date,
							"offer_code"=>$id_val->offer_code,
							"offer_type_code"=>$id_val->offer_type_code,
							"ads_description"=>$id_val->description,
							"user_redeemed_advertisement_code_id"=>$id_val->user_redeemed_advertisement_code_id,
					);
		
			}
	
		return response()->json(["error"=>"success","error_code"=>"200",'user_used_coupon_list'=>$user_used_coupon_list]);  
			   	
	
	}
	else {
		return response()->json(["error"=>"error","error_code"=>"500",'message'=>'Used coupon list pramas not responding properly']); 
	
	}
	
	
}



/*** User save  offer code in reminder **/

public function user_saved_ads_reminder(Request $request) {
	
	$user_id=$request->user_id;
	$advertisement_id=$request->advertisement_id;
	$created_at=$request->remind_time;
	$status_reminder=$request->remind_status;
	
		$userdata=DB::table('user_saved_advertisement')
			->where('advertisement_id','=',$advertisement_id)
			->where('user_id','=',$user_id)
			->get();
			$values_count=count($userdata);
			if($values_count){
				$user_update_lat_long=DB::table('user_saved_advertisement')
				->where('advertisement_id','=',$advertisement_id)
				->where('user_id','=',$user_id)
				->update([
				'is_active'=>$status_reminder,
				'created_at' => $created_at,]);
				$user_ads_save_count=DB::table('user_saved_advertisement')
									->where('user_id','=',$user_id)
									->where('is_active','=',1)
									->get()->count();
				return response()->json(["error"=>"success","error_code"=>"200","user_ads_save_count"=>$user_ads_save_count,'message'=>'advertisement offer updated reminder']);  
			
			} else {
	
				if(!empty($user_id) && !empty($advertisement_id) && !empty($created_at) ) {
				
							$user_save_ads_reminder=new User_Saved_Advertisement;
							$user_save_ads_reminder->user_id = $request->user_id;
							$user_save_ads_reminder->advertisement_id =$advertisement_id;
							$user_save_ads_reminder->advertisement_id =$advertisement_id;
							$user_save_ads_reminder->is_active = $status_reminder;
							$user_save_ads_reminder->created_by = $request->user_id;
							$user_save_ads_reminder->created_at = $created_at;
							$user_save_ads_reminder->updated_by = $request->user_id;
							$user_save_ads_reminder->updated_at = Carbon::now();
							if($user_save_ads_reminder->save())
							{
								$user_ads_save_count=DB::table('user_saved_advertisement')
									->where('user_id','=',$user_id)
									->where('is_active','=',1)
									->get()->count();
								return response()->json(["error"=>"success","error_code"=>"200","user_ads_save_count"=>$user_ads_save_count,'message'=>'advertisement offer code saved in reminder']);  
							
							}
				}
					else {
						
						return response()->json(["error"=>"error","error_code"=>"500",'message'=>'advertisement offer code  not saved successfully']); 
				
					}
		}
	
}  
  
public function user_saved_reminder_list(Request  $request) {
	
			$user_id=$request->user_id;
			if($user_id) {
			$user_list_data=DB::table('user_saved_advertisement')
					->join('advertisement','advertisement.advertisement_id','=','user_saved_advertisement.advertisement_id')
					->join('business','business.business_id','=','advertisement.business_id','')
					->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id')
					->where('user_saved_advertisement.user_id','=',$user_id)
					->where('user_saved_advertisement.is_active','=',1)
					->select('*','business.name as business_name','user_saved_advertisement.created_at as created_time')
					->get();
				$remined_saved_data=array();
				foreach($user_list_data as $val) {
					$remined_saved_data[]= array(
					'advertisement_id'=>$val->advertisement_id,
					'business_name'=>$val->business_name,
					'advertisement_name'=>$val->name,
					'business_id'=>$val->business_id,
					'created_at'=>$val->created_at,
					'ads_image_icon'=>url('/').'/ads1/uploads/doc/'.$val->advertisement_id.'/'.$val->icon_image_url,
					'reminder_status'=>$val->is_active,
					'advertisement_caption'=>$val->caption, 
					"ads_description"=>$val->description,
					'reminder_time'=>$val->created_time
					);
				}
				return response()->json(["error"=>"success","error_code"=>"200",'user_reminder_ads'=>$remined_saved_data]);
			
			}
			else {
			   
			   return response()->json(["error"=>"error","error_code"=>"500",'message'=>'pramas  not send  properly']); 
			
			}
	
}


  
  
  
}
