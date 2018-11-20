<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Promotion extends Controller
{
   
 public function   promotion_section_data(Request $request) {
	 
	 $promotion_id=$request->promotion_id;
	 $user_id=$request->user_id;
	 DB::connection()->enableQueryLog();
	 if($promotion_id) {
			$promotion_section_table=DB::table('promotion_section')
			->where('promotion_section_id','=',$promotion_id)
			->where('is_active','=','1')
			->get();
			
			$promotion_section_all=array();
			foreach($promotion_section_table as $values)
			{
				
				
				$advertistement_id_gets =DB::table('promotion_section_advertisement')
				->join('promotion_section', 'promotion_section.promotion_section_id', '=', 'promotion_section_advertisement.promotion_section_id')
				->where('promotion_section.promotion_section_id','=', $values->promotion_section_id)
				->select('*')
				->get();
				
				foreach($advertistement_id_gets as $val) {
							
						$banner_image_id=DB::table('advertisement')
							//->join('advertisement_image','advertisement.advertisement_id','=','advertisement_image.advertisement_id')
							->join('business','advertisement.business_id','=','business.business_id')
							->join('advertisement_business_address','advertisement_business_address.advertisement_id','=','advertisement.advertisement_id')
							->join('business_address','advertisement_business_address.business_address_id','=','business_address.business_address_id')
							->where('advertisement.advertisement_id','=',$val->advertisement_id)
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
							//'business_lat'=>$location->lat,
							//'business_lan'=>$location->lan,
							'advertisment_img'=>url('/').'/ads1/uploads/doc/'.$value->advertisement_id.'/'.$value->icon_image_url,
							//'advertisment_img'=>url('/').'/advertisement_images/uploads/doc/'.$value->advertisement_id.'/'.$value->image_url,
							'advertisement_id'=>$value->advertisement_id,
							'advertisement_name'=>$value->name
						);
						
					}		
				}
				
			}
			
					
	 
			return response()->json(["error"=>"sucess",'promotions'=>$promotion_section_all,REST_Controller::HTTP_OK]);
	 
	}
	else {
		
		return response()->json(["error"=>"error",'promotion_id'=>"promotion Id is empty",'message'=>'Data params not sent properly',REST_Controller::HTTP_OK]);
	}
   
 } 
   
   
}
