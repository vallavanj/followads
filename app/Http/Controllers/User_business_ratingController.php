<?php

namespace App\Http\Controllers;
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

class User_business_ratingController extends Controller
{
   public function index()
   {
	   $usr_bus_rat = User_business_rating::query()
												->select('bus.name as business_name','user_business_rating.*','usr.*')
												->join('business as bus','user_business_rating.business_id','=','bus.business_id')
												->join('users as usr','user_business_rating.user_id','=','usr.user_id')
												->orderBy('user_business_rating.updated_at','desc')
												->get();
												
			return view('adminpages.user_bus_rating.index',compact('usr_bus_rat'));
   }
}
