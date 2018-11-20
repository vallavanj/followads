<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\Business_Address;
use App\Business_Category;
use App\Categories;
use App\Activity_log;
use Session;
use Image;
use Hash;
use Validator;
use DB;
use App\Attempt;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Business_CategoryController extends Controller
{
    public function index()
	{
		$buss_cat = Business_Category::query()
											->select('*')
											->orderBy('updated_at','desc')
											->get();
		$buss = Business::query()
								->select('*')
								->get();
		$categ  = Categories::query()
									->select('*')
									->get();
			return view('adminpages.business_category.index',compact('buss_cat','buss','categ')); 
	}
	public function buss_categ_create(Request $request)
	{
		if(!empty($request->input()))
		{
			$buss_cat = new Business_Category;
			$buss_cat->business_id = $request->business_name;
			$buss_cat->category_id = $request->category_name;
			$buss_cat->is_active = 1;
			$buss_cat->created_by = 1;
			$buss_cat->created_at = Carbon::now();
			$buss_cat->updated_by = 1;
			$buss_cat->updated_at = Carbon::now();
			$buss_cat->save();
			
			
			
			
			Session::flash('success',"Business Category Created successfully");
			return redirect('buss_cat');
		}
		$buss = Business::query()
								->select('*')
								->get();
		$categ  = Categories::query()
									->select('*')
									->get();
		return view('adminpages.business_category.business_catadd',compact('buss','categ'));
	}
	public function buss_categ_view($id)
	{
		$id = decrypt($id);
		$buss_cat = Business_Category::query()
											->select('*')
											->where('business_category_id',$id)
											->get();
											
		$buss = Business::query()
								->select('*')
								->get();
		$categ  = Categories::query()
									->select('*')
									->get();
			return view('adminpages.business_category.business_catedit',compact('buss_cat','buss','categ'));
	}
	public function buss_categ_update(Request $request,$id)
	{
		$id = decrypt($id);
		$buss_cat = Business_Category::query()
											->where('business_category_id',$id)
											->update([
											'business_id' => $request->business_name,
											'category_id' => $request->category_name,
											'is_active' => 1,
											'updated_at' => Carbon::now()
											]);
											
		
											
		Session::flash('success',"Business Category Update successfully");
			return redirect('buss_cat');
	}
	
	public function buss_categ_delete(Request $request,$id)
	{
		$id = decrypt($id);
		$buss_cat = Business_Category::query()
											->where('business_category_id',$id)
											->delete();
											
			
											
				Session::flash('success',"Business Category Deleted successfully");
					return redirect('buss_cat');
	}
	public function buss_cat_single_view(Request $request)
	{
		$id = $request->uid;
		$buss_cat = Business_Category::query()
											->select('*')
											->where('business_category_id',$id)
											->get();
											
		/* print_r($buss_cat) */
								
		$buss = Business::query()
								->select('*')
								->get();
			 $business = "";					
		 foreach($buss as $bussi)
		 {
			 if($bussi->business_id == $buss_cat[0]->business_id )
			 {
				 $business = $bussi->name;
			 }
		 }
		 
		$categ  = Categories::query()
									->select('*')
									->get();
				$category = "";					
			 foreach($categ as $categr)
			{
			 if($categr->category_id == $buss_cat[0]->category_id )
			 {
				 $category = $categr->category_name;
			 }
			}
		/* 	echo $business;exit; */
				/* echo $category;exit; */
				echo "<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$business."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Category:</label>".$category."</div></div></div>";
			
			
	}
	public function business_single_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		$business = Business_Category::query()
							->where('business_category_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
								
			$business_status = Business_Category::query()
							->select('*')
							->where('business_category_id',$id)
							->get();
				echo $business_status[0]->is_active;
	}
}
