<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class staticpages extends Controller
{
   
  public function static_data() {
	  
	  $static_data=DB::table('staticpages')->select('*')->get();
	  $static_pages=array();
	  foreach($static_data as $val) {
		  $static_pages[]=array(
		  'page_title'=>$val->page_title,
		  'page_content'=>$val->page_content
		  );
		  
	  }
	  return response()->json(["error_code"=>"200","error"=>"sucess",'static_pages'=>$static_pages]);
	
	  
  } 
   
   
   
   
}
