<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Session;
use Image;
use Validator;
use App\Business_Category;
use App\Advertisment_Category;
use DB;
use App\Attempt;
use App\Activity_log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
     public function index()
   {
	 
		    $category = Categories::query()
							->select('*')
							->where('parent_category_id','=',0)
						 	->orderBy('updated_at','desc')  
							->get();
			
			$cat_id_val=array();
            foreach($category as $values) {
				
					$category_parent = Categories::query()
							->select('*')
							->where("category_id","=",$values->category_id)
							->orwhere("parent_category_id","=",$values->category_id)
							->get();
					foreach($category_parent as $val) {	
							
									$cat_id_val[]=array(
									"category_id"=>$val->category_id,
									"parent_category_id"=>$val->parent_category_id,
									"category_name"=>$val->category_name,
									"is_active"=>$val->is_active
									);	
						}
				
			}


								
			

								
	 
		return view('adminpages.categories.index',compact('cat_id_val'));
   }
   public function categories_create(Request $request)
   {
	   if(!empty($request->input()))
	   {
		   $rules = [
			'name'=>'required',
			];
			$attributeNames = array(
					'name' => 'Name',
						);
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$categories = new Categories;
				$categories->category_name = $request->name;
				/* echo $request->parent_cat; */
				if($request->parent_cat == 0)
				{
					/* echo "dfsafsra";exit; */
					$categories->parent_category_id = 0;
				}
				else
				{
					$categories->parent_category_id = $request->parent_cat;
				}
				$categories->is_active = 1;
				$categories->created_by = Auth::user()->user_id;
				$categories->created_at = Carbon::now();
				$categories->updated_by = Auth::user()->user_id;
				$categories->updated_at = Carbon::now();
				$categories->save();
				
				$log = new Activity_log;
			$log->user_id = Auth::user()->user_id;
			$log->activity_code = $request->activity_Code;
			$log->detail = "Created Category";
			$log->is_active =1;
			$log->created_by = Auth::user()->user_id;
			$log->updated_by = Auth::user()->user_id;
			$log->created_at = Carbon::now();
			$log->updated_at = Carbon::now();
					
					$log->save();
				
				
		   Session::flash('success',"Category Created successfully");
		   return redirect('categories');
			}
	   }
	   $categories = Categories::query()
										->select('*')
										->where('parent_category_id','=',0)
										->get();
	   return view('adminpages.categories.categoriesadd',compact('categories'));
   }
   
   public function categories_edit($id)
   {
	   $id = decrypt($id);
	   
	   $categories = Categories::query()
									->select('*')
									->where('category_id',$id)
									->get();
		$categ_parent =  Categories::query()
												->select('*')
												->where('parent_category_id','=',0)
												->get();
		return view('adminpages.categories.categoriesedit',compact('categories','categ_parent'));
   }
   public function categories_update(Request $request,$id)
   {
	   $id = decrypt($id);
	   
	   $rules = [
			'name'=>'required',
			];
			$validate = Validator::make($request->all(),$rules);
			
			if($validate->fails())
			{
				return redirect()->back()->withInput()->withErrors($validate);
				/* return view('form')->back->withErrors($rules); */
			}
			else
			{
				$categories = Categories::query()
									->where('category_id',$id)
									->update([
									'category_name'=>$request->name,
									'parent_category_id'=>$request->parent_cat
									]);
										
			$log = new Activity_log;
			$log->user_id = Auth::user()->user_id;
			$log->activity_code = $request->activity_Code;
			$log->detail = "Updated Category";
			$log->is_active =1;
			$log->created_by = Auth::user()->user_id;
			$log->updated_by = Auth::user()->user_id;
			$log->created_at = Carbon::now();
			$log->updated_at = Carbon::now();
					
					$log->save();
									
			Session::flash('success',"Category Updated successfully");
				return redirect('categories');
			}
   }
   public function categories_delete($id)
   {
	    $id = decrypt($id);
	
		$bus_cat = Business_Category::query()
										->select('*')
										->where('category_id',$id)
										->count();
										
		$ads_cat = Advertisment_Category::query()
												->select('*')
												->where('category_id',$id)
												->count();
		
		if(empty($bus_cat) && empty($ads_cat))
		{
			/* echo "hie";exit; */	
			$categories = Categories::query()
										->select('*')
										->where('parent_category_id',$id)
										->count();
			if(empty($categories))
			{
					/* echo "nhjk";exit;			 */
						
				$categories = Categories::query()
											->where('category_id',$id)
											->delete();
				Session::flash('success',"Deleted successfully");
				return redirect('categories');
			}
			else
			{
				Session::flash('success',"This Category Has Parent Category");
				return redirect('categories');
			}
		}
		else
		{
				Session::flash('success',"Some Business And Advertisement Has This Category");
				return redirect('categories');
		}
   }
   public function categories_single_view(Request $request)
	{
		$id = $request->uid;
		/* echo $id;exit; */
		
		$categories = Categories::query()
						->where('category_id',$id)
						->get();
						
			$categ_parent =  Categories::query()
												->select('*')
												->where('parent_category_id','=',0)
												/* ->where('category_id',$id) */
												->get();
				/* print_R($categ_parent);exit; */
				/* echo $categories[0]->parent_category_id;exit; */
												
			$parent_categ = "";
			foreach($categ_parent as $cat_par)
			{
			if($categories[0]->parent_category_id == $cat_par->category_id)
			{
				$parent_categ = $cat_par->category_name;
			}
			/* else
			{
				$parent_categ = 'No Parent Category';
			} */
			}
			/* echo $parent_categ;exit; */
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$categories[0]->category_name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Parent Category:</label>".$parent_categ."</div></div></div>";
	}
		public function categories_single_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		/* echo $status;exit; */
		$categories = Categories::query()
							->where('category_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
	
								
			$categories_status = Categories::query()
							->select('*')
							->where('category_id',$id)
							->get();
				echo $categories_status[0]->is_active;
	}
	public function categories_unique1(Request $request)
	{
		$category = trim($request->category);
		
		$categories = Categories::query()
							->select('*')
							->where('category_name',$category)
							->where('parent_category_id',0)
							->count();
							
		if(!empty($categories))
		{
			echo "Category already exists";
		}
		else
		{
			
			$parent_category = $request->parentcategory;
			$parent_categories = Categories::query()
							->select('*')
							->where('category_name',$category)
							->where('parent_category_id',$parent_category )
							->count();
				if(!empty($parent_categories))
				{
				echo "Category already exists";
				}
				else
				{
					echo"";
				}
		}
		exit;					
	}
	
	public function categories_unique2(Request $request)
	{
		$category = trim($request->category);
		$category_id = $request->category_id;
	/* 	echo $category_id; */
		$categories = Categories::query()
							->select('*')
							->where('category_name',$category)
							->where('category_id',$category_id)
							->where('parent_category_id',0)
							->count();
						/* 	echo $categories;exit; */
		if(empty($categories))
		{
			$categories = Categories::query()
							->select('*')
							->where('category_name',$category)
							->where('parent_category_id',0)
							->count();
							
			if(!empty($categories))
			{
			echo "Category already exists";
			}
			else
			{
			echo "";
			}
		}
		else
		{
			echo "";
		}
		exit;					
	}
	
	public function categories_unique3(Request $request)
	{
		$category = trim($request->category);
		$category_id = $request->category_id;
		$parent_id = $request->parentcategory;
		$parent_category = $categories = Categories::query()
							->select('*')
							->where('category_name',$category)
							->where('category_id',$category_id)
							->get();
							
		if($parent_category[0]->parent_category_id != $parent_id)
		{
			$parent_category1 = $categories = Categories::query()
							->select('*')
							->where('parent_category_id',$parent_id)
							->get()->toarray();
			$parent = array_column($parent_category1,'category_name');
			if(in_array($category,$parent))
			{
				echo "Category already exists";
			}
			else
			{
				echo "";
			}
			
		}
		else
		{
			echo"";
		}
	}
	
}
