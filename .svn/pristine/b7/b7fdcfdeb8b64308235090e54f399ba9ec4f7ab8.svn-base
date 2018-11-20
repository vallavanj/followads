<?php

/* namespace App\Http\Controllers; */
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Business;
use App\Business_Address;
use App\Business_Category;
use App\Business_image;
use App\Business_Video;
use App\User_business_rating;
use Carbon\Carbon;
use DB;
use App\Activity_log;
use URL;
use Illuminate\Http\Request;

class Write_Offer_ReviewController extends Controller
{
    public function write_offer_review(Request $request)
	{
	
		$user_bus_rating = new User_business_rating;
		$user_bus_rating->user_id = $request->user_id;
		$user_bus_rating->business_id = $request->business_id;
		$user_bus_rating->feedback = $request->comments;
		$user_bus_rating->advertisement_id = $request->advertisement_id;
		$user_bus_rating->title = $request->title;
		$user_bus_rating->rating = $request->rating;
		$user_bus_rating->is_active =1;
		$user_bus_rating->created_by = $request->user_id;
		$user_bus_rating->updated_by = $request->user_id;
		$user_bus_rating->created_at = Carbon::now()->toDateTimeString();
		$user_bus_rating->updated_at = Carbon::now()->toDateTimeString();
		if($user_bus_rating->save())
		{
		
		$log = new Activity_log;
		$log->user_id = $request->user_id;
		$log->activity_code = $request->activity_Code;
		$log->detail = "User Business Rating";
		$log->is_active =1;
		$log->created_by =$request->user_id;
		$log->updated_by = $request->user_id;
		$log->created_at = Carbon::now()->toDateTimeString();;
		$log->updated_at = Carbon::now()->toDateTimeString();;
		$log->save();
		
	
		$usr_bus_rate = User_business_rating::query()
						->select('*')
						->where('business_id',$request->business_id)
						->count('user_id');
													
		$usr_bus_rate_id = User_business_rating::query()
							->select('*')
							->sum('rating');
				/* echo $usr_bus_rate."<br>";
				echo $usr_bus_rate_id."<br>"; */
			$avg_offer_rating_counts = ($usr_bus_rate_id/$usr_bus_rate);
			/* $avg_offer_rating_counts = ($avg_offer_rating_count * 0.05); */
			return response()->json(["error"=>"success","error_code"=>"200",'message'=>'User rated successfully','avg_advertisement_rating_counts'=>$avg_offer_rating_counts]);
		}
		else
		{
			$avg_offer_rating_counts = "";
			return response()->json(["error"=>"error","error_code"=>"500",'message'=>'User rated successfully','avg_advertisement_rating_counts'=>$avg_offer_rating_counts]);
		}
	}
}
