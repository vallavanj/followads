<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Notification;

class Mobilehome extends Controller
{
      
   public function mobile_home(Request $request) {
	   
			DB::connection()->enableQueryLog();
			
			$device_token=$request->device_token;
			$device_name=$request->device_name;
			$user_lat=$request->user_lat;
			$user_lng=$request->user_lng;
			$user_id=$request->user_id;
			$lang_id=$request->lang_id;
			
			/**  notification count for user  **/
		$notification_count = Notification::query()
					->select('*')
					->where('user_id',$request->user_id)
					->where('is_active','=',1)
					->count();

			$array_lat=array(
			"lat"=>$user_lat,
			"lan"=>$user_lng,
			);
			$location_lat=json_encode($array_lat);
			$user_update_lat_long=DB::table('users')
				->where('user_id', $user_id)
				->update(['default_location' => $location_lat]);
			
			
				$wallet = DB::table('wallet')
						->select('*')
						->where('users_id',trim($request->user_id))
						->get();
			
			foreach($wallet as $val) {
				$wallet_balance=$val->balance;
			}
			if(!empty($wallet_balance))	{	$wallet_amount=$wallet_balance;	}
									else {		$wallet_amount='';	}
			
			
			$query_get_ids =DB::table('promotion_section_advertisement')
            ->join('promotion_section', 'promotion_section.promotion_section_id', '=', 'promotion_section_advertisement.promotion_section_id')
			->where('promotion_section.promotion_section_id','=', '1')
            ->select('*')
            ->get();
			
			$advertistement_id=array();
			foreach($query_get_ids as $value) 
			{
				$advertistement_id[]=$value->advertisement_id;
				
			}
			
			$banner_image=DB::table('advertisement')
						->join('advertisement_offer_code','advertisement.advertisement_id','=','advertisement_offer_code.advertisement_id')
						->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
						->where('advertisement_image.sequence_no','=',1)
						->whereIn('advertisement.advertisement_id', $advertistement_id)
						->get();
			$banner_image_values=array();
			foreach($banner_image as $value) {
				
				$banner_image_values[]=array(
				  'banner_img'=>url('/').'/advertisement_images/uploads/doc/'.$value->advertisement_id.'/'.$value->image_url,
				  'off_id'=>$value->advertisement_id
				);
				
			}   
			
			
			$promotion_section_table=DB::table('promotion_section')
			->whereNotIn('promotion_section_id', ['1'])
			->where('is_active','=','1')
			->get();
			//print_r($promotion_section_table);
			$promotion_section_all=array();
			foreach($promotion_section_table as $values)
			{
				
				
				$advertistement_id_gets =DB::table('promotion_section_advertisement')
				->join('promotion_section', 'promotion_section.promotion_section_id', '=', 'promotion_section_advertisement.promotion_section_id')
				->where('promotion_section.promotion_section_id','=', $values->promotion_section_id)
				->select('*')
				->get();
				//print_r($advertistement_id_gets);
			 	foreach($advertistement_id_gets as $val) {
							
						$banner_image_id=DB::table('advertisement')
							//->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
							->join('business','advertisement.business_id','=','business.business_id','left')
							->join('advertisement_business_address','advertisement_business_address.advertisement_id','=','advertisement.advertisement_id','left')
							->join('business_address','advertisement_business_address.business_address_id','=','business_address.business_address_id','left')
							->where('advertisement.advertisement_id','=',$val->advertisement_id)
							//->whereNull('advertisement.advertisement_id')
							//->where('advertisement_image.sequence_no','=',1)
							->select('*')
							->get();
							
						//print_r(DB::getQuerylog());	
					
					foreach($banner_image_id as $value) {
						//$location = json_decode($value->location);
						
						$promotion_section_all[]=array(
							'promotion_id'=>$values->promotion_section_id,
							'promotion_name'=>$values->name,
							'business_id'=>$value->business_id,
							'business_name'=>$value->name,
							'business_addr'=>$value->address,
							'business_dist'=>$value->city,
							'business_lat'=>$value->latitude,
							'business_lan'=>$value->longitude,
							'advertisment_img'=>url('/').'/ads1/uploads/doc/'.$value->advertisement_id.'/'.$value->icon_image_url,
							//'advertisment_img'=>url('/').'/advertisement_images/uploads/doc/'.$value->advertisement_id.'/'.$value->image_url,
							'advertisement_id'=>$value->advertisement_id,
							'advertisement_name'=>$value->name
						);
						
					}		
				}  
				
			}
			
			//print_r($promotion_section_all);
			
					$out=array();
					foreach($promotion_section_all as $x){
						//$out[$x['promotion_id']]['wallet_balance']=$x['wallet_balance'];
						$out[$x['promotion_id']]['promotion_id']=$x['promotion_id'];
						$out[$x['promotion_id']]['promotion_name']=$x['promotion_name'];
						$out[$x['promotion_id']]['promotion_all'][]=array(
										'promotion_id'=>$x['promotion_id'],
										'promotion_name'=>$x['promotion_name'],
										'business_id'=>$x['business_id'],
										'business_name'=>$x['business_name'],
										'business_addr'=>$x['business_addr'],
										'business_lat'=>$x['business_lat'],
										'business_lan'=>$x['business_lan'],
										'advertisment_img'=>$x['advertisment_img'],
										'advertisement_id'=>$x['advertisement_id'],
										);
						}
			
					 $result_array=array();
					 $i=1;
					 foreach($out as $valu) {
						// print_r($valu['promotion_all']); 
							$result_array["promotion".$i]=$valu['promotion_all'];
							$i++; 
					 } 
					//print_r($result_array);
				return response()->json(["error_code"=>"200","error"=>"sucess",'banner'=>$banner_image_values,'wallet_balance'=>$wallet_amount,'notification'=>$notification_count,'promotions'=>$result_array]);  
			 
			
			
	}
	
  
	
}
