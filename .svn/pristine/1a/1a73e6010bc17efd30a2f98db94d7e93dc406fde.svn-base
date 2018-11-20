<?php

/* namespace App\Http\Controllers; */
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notification;
use App\Advertisment;
use URL;
use DB;
use App\Business;
use App\Business_image;

class Notificationcontroller extends Controller
{
    public function notification_list(Request $request)
	{
		/* DB::enableQueryLog(); */
		$notification = Notification::query()
											->select('*')
											->where('user_id','=',$request->user_id)
											->get();
											
											/* $query = DB::getQueryLog(); */
							/* $query = end($query);
							print_r($query); exit; */ 

		$notification_count_update = Notification::query()
											->where('user_id','=',$request->user_id)
											->update(['is_active'=>0]);

		$notification_count = Notification::query()
											->select('*')
											->where('user_id',$request->user_id)
											->where('is_active','=',1)
											->count();
											/* echo "<pre>";
									print_R($notification);	exit; */	
			$b = array();
		foreach($notification as $noti)
		{
			$bus_name = Business::query()
									->select('name')
									->where('business_id',$noti->business_id)
									->get();
			$ads = Advertisment::query()
									->select('name','valid_from','valid_to','created_at')
									->where('advertisement_id',$noti->advertisment_id)
									->get();
									
			$bus_img = Business_image::query()
											->select('images_url')
											->where('business_id',$noti->business_id)
											->where('sequence_no',1)
											->get();
					/* echo"<pre>";						
				print_R($bus_img);
				print_R($bus_name);
				print_R($ads);
				exit; */
			if($noti->is_active == 0)
			{
				$read = 1;
			}
			else
			{
				$read = 0;
			}
				if($bus_name->isNotEmpty() && $ads->isNotEmpty() && $bus_img->isNotEmpty())
				{
					$b[] = array(
					'business_id' =>$noti->business_id,
					'business_name'=>$bus_name[0]->name,
					'business_img' => URL::to('/').'/business_images/uploads/doc/'.$noti->business_id.'/'.$bus_img[0]->images_url,
					'advertisement_id' =>$noti->advertisment_id,
					'advertisement_name' =>$ads[0]->name,
					'advertisement_valid_from' =>$ads[0]->valid_from,
					'advertisement_valid_to' =>$ads[0]->valid_to,
					'is_read' =>$read,
					'notification_count' =>$notification_count,
					'notification_id' =>$noti->notification_id 
					);
				}
		}
		
		return response()->json(["error_code"=>"200","error"=>"success",'information'=>$b]);
	}
}
