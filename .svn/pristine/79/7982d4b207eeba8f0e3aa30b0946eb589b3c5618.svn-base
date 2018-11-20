<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PromotionsController extends Controller
{
    
public function limit_get_proms(Request $request) {
	
					DB::connection()->enableQueryLog();
					$user_id =$request->input('user_id');
					$promotion_id=$request->input('promotion_id');
					$limit=$request->input('limit');
					
						if( !empty($user_id) && !empty($promotion_id) &&  !empty($limit) ) {
							
							$promotion_section_table=DB::table('promotion_section')
							->whereNotIn('promotion_section_id', ['2'])
							->where('promotion_section_id','=',$promotion_id)
							->get();
							
							foreach($promotion_section_table as $values)
									{
										
										$advertistement_id_gets =DB::table('promotion_section_advertisement')
										->join('promotion_section', 'promotion_section.promotion_section_id', '=', 'promotion_section_advertisement.promotion_section_id')
										->where('promotion_section.promotion_section_id','=', $values->promotion_section_id)
										->take($limit)
										->select('*')
										->get();
										
										
										
										foreach($advertistement_id_gets as $val) {
													
												$ads_id=DB::table('advertisement')
													->join('advertisement_offer_code','advertisement.advertisement_id','=','advertisement_offer_code.advertisement_id')
													->join('business','advertisement.business_id','=','business.business_id')
													->join('business_address','business_address.business_id','=','business.business_id')
													->where('advertisement.advertisement_id','=',$val->advertisement_id)
													->select('*')
													->get();
										
										
											
											foreach($ads_id as $value) {
												$location = json_decode($value->location);
												
												$promotion_section_limit[]=array(
													'promotion_id'=>$values->promotion_section_id,
													'promotion_name'=>$values->name,
													'store_id'=>$value->business_id,
													'store_name'=>$value->name,
													'store_addr'=>$value->address,
													'store_dist'=>$value->city,
													'store_lat'=>$location->lat,
													'store_lan'=>$location->lan,
													'off_img'=>url('/').'/ads1/uploads/doc/'.$value->advertisement_id.'/'.$value->icon_image_url,
													'off_id'=>$value->advertisement_offer_code_id
												);
												
											}		
										}
												
									}
								
						 if(empty($promotion_section_limit)) {
								return response()->json(["error"=>"error",'promotions'=>'No data Found',REST_Controller::HTTP_OK]);
							}
							else {
								return response()->json(["error"=>"sucess",'promotions'=>$promotion_section_limit,REST_Controller::HTTP_OK]);
							} 
							
						}
					else {
							return response()->json(["error"=>"error",'message'=>'Data params not sent properly',REST_Controller::HTTP_OK]);
						
						}
					
						
}	
	

	
	
	
	
	
		
	
}
