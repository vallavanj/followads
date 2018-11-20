<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use DB;
use Carbon\Carbon;

class NearbyController extends Controller
{
	function unique_multidim_array($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
	//$array = array_diff($key_array, );
    return $temp_array; 
}
	
	
   public function nearby_business_list(Request $request)
   {
			$user_lat=$request->user_lat;
			$user_lng=$request->user_lng;
			$user_id=$request->user_id;
			$adsid =json_decode($request->ads_ids, TRUE);
			$ads = count($adsid);
			if($ads > 0)
			{
				
				
				
						$bus_deatails = array();  
						$advertisement = DB::table('advertisement')->select('*')
													->whereIN('advertisement_id',$adsid)
													->get();
						
							$bus_id = array();
						
							foreach($advertisement as $ads)
							{
							$business = DB::table('business')
															->select('*')
															->where('business_id',$ads->business_id)
															->get();
															
							$bus_address = DB::table('business_address')
																->select('*')
																->where('business_id',$ads->business_id)
																->get();
							$business_image = DB::table('business_image')
																->select('*')
																->where('sequence_no',1)
																->where('business_id',$ads->business_id)
																->get();
																
								$buss_get_id = " ";
								$bus_address_get_name = " ";
								foreach($business as $bus_val)
								{
									$buss_get_id = $bus_val->business_id;
									$bus_address_get_name = $bus_val->name;
								}
								$bus_add_lat = " ";
								$bus_add_long = " ";
								foreach($bus_address as $bus_address_val)
								{
									$bus_add_lat = $bus_address_val->latitude;
									$bus_add_long = $bus_address_val->longitude;
								}
								$bus_get_img = " ";
								foreach($business_image as $bus_img)
								{
									$bus_get_img = $bus_img->images_url;
								}
																
									$bus_deatails[] = array(
										'business_id' => $buss_get_id,
										'business_name' => $bus_address_get_name,
										'business_lat' => $bus_add_lat,
										'business_lng' => $bus_add_long,
										'business_img' => URL::to('/').'/business_images/uploads/doc/'.$buss_get_id.'/'.$bus_get_img,
									);
							}
					
						$out=array();
						foreach($bus_deatails as $x){
							$out[$x['business_id']]['business_id']=$x['business_id'];
							$out[$x['business_id']]['business_name']=$x['business_name'];
							$out[$x['business_id']]['business_all'][]=array(
									'business_id' => $x['business_id'],
									'business_name' =>$x['business_name'],
									'business_lat'=>$x['business_lat'],
									'business_lng' => $x['business_lng'],
									'business_img' => $x['business_img'],
							);
						}
						$bussiness_detail=array();
						foreach($out  as $value){
									$bussiness_detail[] = array(
										'business_id' => $value['business_id'],
										'business_name' => $value['business_name'],
										'business_lat' => $value['business_all'][0]["business_lat"],
										'business_lng' => $value['business_all'][0]["business_lng"],
										'business_img' => $value['business_all'][0]["business_img"],
									);
						}
					return response()->json(["error"=>"sucess","business_list"=>$bussiness_detail]);
			}
			else
			{
				
						$user_lat=$request->user_lat;
						$user_lng=$request->user_lng;
						$user_id=$request->user_id;
						
						$array_lat=array(
						"lat"=>$user_lat,
						"lan"=>$user_lng,
						);
						$location_lat=json_encode($array_lat);
						if(!empty($request->user_id))
						{
						$user_update_lat_long=DB::table('users')
							->where('user_id', $user_id)
							->update(['default_location' => $location_lat]);
						
							$get_lat=DB::table('users')
												->select('*')
												->where('user_id', $user_id)
												->get();
						}
						

						$lat_long_distance=DB::select("select *,(((acos(sin((".$user_lat."*pi()/180)) * 
							sin((`latitude`*pi()/180))+cos((".$user_lat."*pi()/180)) * 
							cos((`latitude`*pi()/180)) * 
							cos(((".$user_lng."- `longitude`)*pi()/180))))*180/pi())*60*1.1515) 
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
											
						foreach($business_ids as $bus_id)
						{
							$business = DB::table('business')
															->join('advertisement','business.business_id','=','advertisement.business_id')
															->where('business.business_id',$bus_id)
															->get();
															
							$bus_address = DB::table('business_address')
																->select('*')
																->whereIn('business_id',$bus_id)
																->get();
							$business_image = DB::table('business_image')
																->select('*')
																->where('sequence_no',1)
																->whereIn('business_id',$bus_id)
																->get();
							
								
								$buss_get_id = " ";
								$bus_address_get_name = " ";
								foreach($business as $bus_val)
								{
									$buss_get_id = $bus_val->business_id;
									$bus_address_get_name = $bus_val->name;
								}
								$bus_add_lat = " ";
								$bus_add_long = " ";
								foreach($bus_address as $bus_address_val)
								{
									$bus_add_lat = $bus_address_val->latitude;
									$bus_add_long = $bus_address_val->longitude;
								}
								$bus_get_img = " ";
								foreach($business_image as $bus_img)
								{
									$bus_get_img = $bus_img->images_url;
								}
							  if($business->IsnotEmpty())
							  {  
									
										$nerby_ads_latlong[] = array(
									'business_id' => $buss_get_id,
									'business_name' => $bus_address_get_name,
									'business_lat' => $bus_add_lat,
									'business_lng' => $bus_add_long,
									'business_img' => URL::to('/').'/business_images/uploads/doc/'.$buss_get_id.'/'.$bus_get_img,
									
							 );  
							 
									}
						} 
						
						$b = $this->unique_multidim_array($nerby_ads_latlong,'business_id');
						  
						  
					return response()->json(["error"=>"sucess","business_list"=> $nerby_ads_latlong]);
			}
					
						
	}
}

