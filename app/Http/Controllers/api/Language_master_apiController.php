<?php

/* namespace App\Http\Controllers; */
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Http\Request;

class Language_master_apiController extends Controller
{
   public function master_lang()
   {
	   /* echo 1;exit; */
	   $lang = Language::query()
							->select('language_id','name_in_english','name_in_native')
							->get();
							
		
							
		return response()->json(["error_code"=>"200",'error'=>'success','information'=>$lang]);
   }
}
