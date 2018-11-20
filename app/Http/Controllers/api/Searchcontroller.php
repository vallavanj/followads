<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
class Searchcontroller extends Controller
{
   
   public function  searchname(Request $request) {
	   
			$lat=$request->user_lat;
			$lon=$request->user_lng;
			$user_id=$request->user_id;
			$search_key=$request->search_key;
			//$limit=$request->limit;
			if(!empty($user_id)) {
					$array_lat=array(
				"lat"=>$lat,
				"lan"=>$lon,
				);
			$location_lat=json_encode($array_lat);
				$user_update_lat_long=DB::table('users')
				->where('user_id', $user_id)
				->update(['default_location' => $location_lat]);
			
			
				/*$user_updated_lat_long=DB::table('users')
				->where('user_id', $user_id)
				->select('*')
				->get();
					foreach($user_updated_lat_long as $values) {
						
						$data_lat=$values->default_location;
					}

					$location = json_decode($data_lat); */
					$lat_1=$request->user_lat;
					$lon_1=$request->user_lng;
					
				if(!empty($lat_1) && !empty($lon_1)) {
					$lat_long_distance=DB::select("select *,(((acos(sin((".$lat_1."*pi()/180)) * 
					sin((`latitude`*pi()/180))+cos((".$lat_1."*pi()/180)) * 
					cos((`latitude`*pi()/180)) * 
					cos(((".$lon_1."- `longitude`)*pi()/180))))*180/pi())*60*1.1515) 
					AS distance 
					from business_address having distance <= 10");
				}
				else 	{
							return response()->json(["error"=>"error","error_code"=>"500",'message'=>'server not responding']);
			
						}

				}
				else {
					
				$lat_long_distance=DB::select("select *,(((acos(sin((".$lat."*pi()/180)) * 
				sin((`latitude`*pi()/180))+cos((".$lat."*pi()/180)) * 
				cos((`latitude`*pi()/180)) * 
				cos(((".$lon."- `longitude`)*pi()/180))))*180/pi())*60*1.1515) 
				AS distance 
				from business_address having distance <= 10");
					
				}
				
				
				
				$bus_id=array();
			  foreach($lat_long_distance as $value) {
				  
				  $bus_id[]=array(
				  "business_id" =>$value->business_id
				  );
			  }
				
			$business_get_atlong=DB::table('business')->select('*')
								->whereIn('business_id',$bus_id)
								->where('is_active','=','1')
								//->take($limit)
								->get();
			$business_ids=array();					
			foreach($business_get_atlong as $value) {
				  
				  $business_ids[]=array(
				  "business_id" =>$value->business_id
				  );
			  }
			$ads_nerby_latlong=DB::table('advertisement')
								->select('*','advertisement.name as adsname','business.name as busname')
								->join('business','advertisement.business_id','=','business.business_id')
								->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
								->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id')
								->whereIn('advertisement.business_id',$business_ids)
								->where('advertisement.name','LIKE',"%{$search_key}%")
								->where('advertisement.is_active','=',1)
								->get();
			$nerby_ads_latlong=array();			
				foreach($ads_nerby_latlong as $val){
					  if(empty($val->name)) {
						  
					  } else {
						$value_split=explode(' ',$val->valid_from);
						$valid_from = date("d-m-Y", strtotime($value_split['0']));
						$value_split_to=explode(' ',$val->valid_to);
						$valid_to = date("d-m-Y", strtotime($value_split_to['0']));
					   $nerby_ads_latlong[]=array(
							"ads_id" =>$val->advertisement_id,
							'business_name'=>$val->busname,
							"ads_name" =>$val->adsname,
							'advertisement_caption'=>$val->caption,
							'advertisment_img'=>url('/').'/advertisement_images/uploads/doc/'.$val->advertisement_id.'/'.$val->image_url,
							'advertisement_desc' =>$val->description,
							'advertisement_valid_from'=>$valid_from,
								'advertisement_valid_to'=>$valid_to,
					   );
					  }
				   }
							
				
		  
		  
	   
		   $business=DB::table('business')->select('*')->get();
		   foreach($business as $val){
			   $busniess_name[]=$val->name;
		   }
		   
		   $advertisment=DB::table('advertisement')
		   ->select('*','advertisement.name as adsname','business.name as busname')
		   ->join('business','advertisement.business_id','=','business.business_id')
		   ->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
		   ->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id')
		   ->where('advertisement.is_active','=',1)
		   ->where('advertisement.name','LIKE',"%{$search_key}%")
		   //->take($limit)
		   ->get();
		   $ads_all=array();
			foreach($advertisment as $val){
			  if(empty($val->name)) {
				  
			  } else {
				$value_split=explode(' ',$val->valid_from);
				$valid_from = date("d-m-Y", strtotime($value_split['0']));
				$value_split_to=explode(' ',$val->valid_to);
				$valid_to = date("d-m-Y", strtotime($value_split_to['0']));
			   $ads_all[]=array(
			   "ads_id" =>$val->advertisement_id,
			   'business_name'=>$val->busname,
			   "ads_name" =>$val->adsname,
			   'advertisement_caption'=>$val->caption,
			   'advertisment_img'=>url('/').'/advertisement_images/uploads/doc/'.$val->advertisement_id.'/'.$val->image_url,
			   'advertisement_desc' =>$val->description,
			   'advertisement_valid_from'=>$valid_from,
								'advertisement_valid_to'=>$valid_to,
			   );
			  }
		   }
		   
		$today_date=date('Y-m-d');
	   
	   $expiring_ads=DB::table('advertisement')
						->select('*','advertisement.name as adsname','business.name as busname')
						->join('business','advertisement.business_id','=','business.business_id')
						->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
						->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id')
						->where('advertisement.name','LIKE',"%{$search_key}%")
						->where('advertisement.is_active','=',1)
						->where('advertisement.valid_to','<=',$today_date)
						//->take($limit)
						->orderby('advertisement.valid_to','DESC')
						->get();
				$expr_ads=array();
				foreach($expiring_ads as $val){
					  if(empty($val->name)) {
						  
					  } else {
						$value_split=explode(' ',$val->valid_from);
						$valid_from = date("d-m-Y", strtotime($value_split['0']));
						$value_split_to=explode(' ',$val->valid_to);
						$valid_to = date("d-m-Y", strtotime($value_split_to['0']));
					   $expr_ads[]=array(
						"ads_id" =>$val->advertisement_id,
						'business_name'=>$val->busname,
						"ads_name" =>$val->adsname,
						'advertisement_caption'=>$val->caption,
						'advertisment_img'=>url('/').'/advertisement_images/uploads/doc/'.$val->advertisement_id.'/'.$val->image_url,
						'advertisement_desc' =>$val->description,
						'advertisement_valid_from'=>$valid_from,
								'advertisement_valid_to'=>$valid_to,
					   );
					  }
				   }

			$Live=DB::table('advertisement')
							->select('*','advertisement.name as adsname','business.name as busname')
							->join('business','advertisement.business_id','=','business.business_id')
							->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
							->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id')
							->where('advertisement.name','LIKE',"%{$search_key}%")
							->where('advertisement.is_active','=',1)
						->where('advertisement.valid_to','=',$today_date)
							//->take($limit)
							->get();
				$live_ads=array();			
					foreach($Live as $val){
						  if(empty($val->name)) {
							  
						  } else {
							$value_split=explode(' ',$val->valid_from);
							$valid_from = date("d-m-Y", strtotime($value_split['0']));
							$value_split_to=explode(' ',$val->valid_to);
							$valid_to = date("d-m-Y", strtotime($value_split_to['0']));
						   $live_ads[]=array(
								"ads_id" =>$val->advertisement_id,
								'business_name'=>$val->busname,
								"ads_name" =>$val->adsname,
								'advertisement_caption'=>$val->caption,
								'advertisment_img'=>url('/').'/advertisement_images/uploads/doc/'.$val->advertisement_id.'/'.$val->image_url,
								'advertisement_desc' =>$val->description,
								'advertisement_valid_from'=>$valid_from,
								'advertisement_valid_to'=>$valid_to,
						   );
						  }
					   }
	
					$coming_ads=DB::table('advertisement')
									->select('*','advertisement.name as adsname','business.name as busname')
									->join('business','advertisement.business_id','=','business.business_id')
									->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
									->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id')
									->where('advertisement.name','LIKE',"%{$search_key}%")
									->where('advertisement.is_active','=',1)
									->where('advertisement.valid_to','>=',$today_date)
									//->take($limit)
									->get();
					$com_ads=array();			
					foreach($coming_ads as $val){
						  if(empty($val->name)) {
							  
						  } else {
							$value_split=explode(' ',$val->valid_from);
							$valid_from = date("d-m-Y", strtotime($value_split['0']));
							$value_split_to=explode(' ',$val->valid_to);
							$valid_to = date("d-m-Y", strtotime($value_split_to['0']));
						   $com_ads[]=array(
							"ads_id" =>$val->advertisement_id,
							'business_name'=>$val->busname,
							"ads_name" =>$val->adsname,
							'advertisement_caption'=>$val->caption,
							'advertisment_img'=>url('/').'/advertisement_images/uploads/doc/'.$val->advertisement_id.'/'.$val->image_url,
							'advertisement_desc' =>$val->description,
							'advertisement_valid_from'=>$valid_from,
								'advertisement_valid_to'=>$valid_to,
						   );
						  }
					   }
			

	
			return response()->json(["error"=>"sucess","All_ads"=> $ads_all,"Expiring"=>$expr_ads,"Live"=>$live_ads,"Coming"=>$com_ads,"Nearby"=>$nerby_ads_latlong ]);
	  
				
			/*else {
				return response()->json(["error"=>"error","error_code"=>"500",'message'=>'server not responding']);
			}*/
  
  }
   
   
   public function search_suggestion(Request $request) {
	   
			$lat=$request->user_lat;
			$lon=$request->user_lng;
			$user_id=$request->user_id;
			$list_data_search_for=DB::table('category')->select('*')->whereNotIn('parent_category_id', ['0']) ->groupBy('category_name')->get();
				$child_category=array();
			foreach($list_data_search_for as $values) {
				$child_category[]=array(
				"category_name"=>$values->category_name,
				);
				
			}

			return response()->json(["error"=>"sucess","searchname"=> $child_category]);
	  
	   
   }
   
   public function search_filter(Request $request) {
			$lat=$request->user_lat;
			$lon=$request->user_lng;
			$user_id=$request->user_id;
			
			if(!empty($user_id)) {
			
			$array_lat=array(
			"lat"=>$lat,
			"lan"=>$lon,
			);
			$location_lat=json_encode($array_lat);
			$user_update_lat_long=DB::table('users')
				->where('user_id', $user_id)
				->update(['default_location' => $location_lat]);
				
			$get_lat=DB::table('users')
								->select('*')
								->where('user_id', $user_id)
								->get();
								
			foreach($get_lat as $val) {
				$lat_data=$val->default_location;
			}
			
			$location = json_decode($lat_data);
			$lat=$location->lat;
			$lon=$location->lan;
			}
			if(empty($lat) || empty($lon)) {
			return response()->json(["error"=>"error","error_code"=>"500",'message'=>'server not responding']);
			
			}
			else {
			$lat_long_distance=DB::select("select *,(((acos(sin((".$lat."*pi()/180)) * 
				sin((`latitude`*pi()/180))+cos((".$lat."*pi()/180)) * 
				cos((`latitude`*pi()/180)) * 
				cos(((".$lon."- `longitude`)*pi()/180))))*180/pi())*60*1.1515) 
				AS distance 
				from business_address having distance <= 10");
				$bus_id=array();
			  foreach($lat_long_distance as $value) {
				  
				  $bus_id[]=array(
				  "business_id" =>$value->business_id
				  );
			  }
			  
			  
			 $business_get_atlong=DB::table('business')->select('*')
								->whereIn('business_id',$bus_id)
								->where('is_active','=','1')
								->get();
			$business_ids=array();					
			foreach($business_get_atlong as $value) {
				  
				  $business_ids[]=array(
				  "business_id" =>$value->business_id
				  );
			  }
			$ads_nerby_latlong=DB::table('advertisement')
								->join('advertisement_description','advertisement.advertisement_id','=','advertisement_description.advertisement_id')
								->whereIn('business_id',$business_ids)
								->get();
			$nerby_ads_latlong=array();			
				foreach($ads_nerby_latlong as $val){
					  if(empty($val->caption)) {
						  
					  } else {
					   $nerby_ads_latlong[]=array(
					   "ads_id" =>$val->advertisement_id,
					   "ads_caption" =>$val->caption,
					   );
					  }
				   } 
			  
			  
			  
		return response()->json(["error"=>"sucess","filter_list"=> $nerby_ads_latlong]);	
			}
					   
  }
   
   
   
   
}
