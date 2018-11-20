<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\Business_Address;
use App\Business_Category;
use App\Categories;
use App\Advertisment;
use App\Advertisment_Category;
use App\Advertisement_Description;
use App\Advertisement_Image;
use App\Advertisement_Search_Terms;
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

class Advertisment_CategoryController extends Controller
{
    public function index()
	{
		$ads = Advertisment_Category::query()
								->select('*')
								->orderBy('created_at','desc')
								->get();
		$advertisement = Advertisment::query()
								->select('*')
								->get();
		$adv_desc = Advertisement_Description::query()
												->select('*')
												->orderBy('updated_at','desc')
												->get();
								
		$category = Categories::query()
									->select('*')
									->get();
				return view('adminpages.advertisement_categ.index',compact('ads','advertisement','category','adv_desc'));
	}
	public function advertisment_categ_create(Request $request)
	{
		if(!empty($request->input()))
		{
			$rules = [
			'ads_name' => 'required',
			'category_name' => 'required',
			];
			$attributeNames = array(
					'ads_name' => ' Advertisement Name',
					'category_name' => 'Category Name',
						);
					$validate = Validator::make($request->all(),$rules);
					$validate->setAttributeNames($attributeNames);
					if($validate->fails())
					{
						return redirect()->back()->withInput()->withErrors($validate);
						/* return view('form')->back->withErrors($rules); */
					}
					else
					{
						$ads_categ = new Advertisment_Category;
						$ads_categ->advertisement_id = $request->ads_name;
						$ads_categ->category_id = $request->category_name;
						$ads_categ->is_active = 1;
						$ads_categ->created_by = 1;
						$ads_categ->created_at = Carbon::now();
						$ads_categ->updated_by = 1;
						$ads_categ->updated_at = Carbon::now();
						$ads_categ->save();
						
						
						
						
						Session::flash('success',"Advertisment Category Created successfully");
								return redirect('ads_ctaeg');
					}
		}
		$advertisement = Advertisment::query()
								->select('*')
								->get();
		$category = Categories::query()
									->select('*')
									->get();
		return view('adminpages.advertisement_categ.adsaacategadd',compact('advertisement','category'));
	}
	public function advertisment_categ_view($id)
	{
		$id = decrypt($id);
		$ads = Advertisment_Category::query()
								->select('*')
								->where('advertisement_category_id',$id)
								->get();
		$advertisement = Advertisment::query()
								->select('*')
								->get();
		$category = Categories::query()
									->select('*')
									->get();
			return view('adminpages.advertisement_categ.adscategedit',compact('ads','advertisement','category'));
	}
	public function advertisment_categ_update(Request $request,$id)
	{
		$id = decrypt($id);
		$rules = [
			'ads_name' => 'required',
			'category_name' => 'required',
			];
			$attributeNames = array(
					'ads_name' => ' Advertisement Name',
					'category_name' => 'Category Name',
						);
					$validate = Validator::make($request->all(),$rules);
					$validate->setAttributeNames($attributeNames);
					if($validate->fails())
					{
						return redirect()->back()->withInput()->withErrors($validate);
						/* return view('form')->back->withErrors($rules); */
					}
					else
					{
						$ads = Advertisment_Category::query()
												->where('advertisement_category_id',$id)
												->update(
												[
												'advertisement_id'=>$request->ads_name,
												'category_id'=>$request->category_name,
												'updated_at'=>Carbon::now()
												]
												);
												
						
												
							Session::flash('success',"Advertisment Category Updated successfully");
									return redirect('ads_ctaeg');
					}
	}
	public function advertisment_categ_delete(Request $request,$id)
	{
		$id = decrypt($id);
		$ads = Advertisment_Category::query()
								->where('advertisement_category_id',$id)
								->delete();
								
						
								
				Session::flash('success',"Advertisment Category Deleted successfully");
					return redirect('ads_ctaeg');
	}
	public function advertisment_categ_single_view(Request $request)
	{
		/* echo "fhsdgk";exit; */
		 $id = $request->uid;
		$ads = Advertisment_Category::query()
								->select('*')
								->where('advertisement_category_id',$id)
								->get();
		$category = Categories::query()
									->select('*')
									->get();
			$categ_name = "";
		foreach($category as $categ)
		{
			if($categ->category_id == $ads[0]->category_id )
			{ 
				$categ_name = $categ->category_name;
			}
		}
		/* echo $categ_name;exit; */
		echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Advertisment Name:</label>".$ads[0]->advertisement_id."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Category:</label>".$categ_name."</div></div></div>";
		
		exit;
	}
	
	public function advertisment_categ_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		 $status = $request->status;
		 /* echo $status;exit; */
		 $ads = Advertisment_Category::query()
								->where('advertisement_category_id',$id)
								->update([
								'is_active'=>$status,
								'updated_at'=>Carbon::now()
								]);
								
		
								
		$ads_get = Advertisment_Category::query()
												->select('*')
												->where('advertisement_category_id',$id)
												->get();
					echo $ads_get[0]->is_active;
			
	}
}
