<?php

namespace App\Http\Controllers;
use App\Advertisment;
use App\Advertisement_Description;
use App\Promotion_Section;
use App\Promotion_Section_Advertisement;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;


class Promotion_SectionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
     public function index()
	{
		
		 $ads = Advertisment::query()
								->select('advertisement.*','advertisement_description.description')
								->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id','Left')
								->get();
		$promotion = Promotion_Section::query()
											->select('*')
											->get();
											
		return view('adminpages.promotion_section.index',compact('ads','promotion'));
	}
	public function create_promotion(Request $request)
	{
		if(!empty($request->input()))
		{
			
		
		$promotion = new Promotion_Section;
		$promotion->name = $request->name;
		$promotion->caption = $request->caption;
		$promotion->sequence_no = rand(1000,10);
		$promotion->no_of_ads = $request->no_of_ads;
		$promotion->width = $request->width;
		$promotion->height = $request->height;
		$promotion->is_active = 1;
		$promotion->created_by = Auth::user()->user_id;
		$promotion->created_at = Carbon::now();
		$promotion->updated_by =  Auth::user()->user_id;
		$promotion->updated_at = Carbon::now();
		if($promotion->save())
		{
			$id = $promotion->id;
			 
			$count = $promotion->no_of_ads;
		$validfrom = $date_from = date('Y-m-d', strtotime($request->valid_from));
			$validto = $date_from = date('Y-m-d', strtotime($request->valid_to));
			for($i=1;$i<=$count;$i++)
			{
			$pro = new Promotion_Section_Advertisement;
			$pro->promotion_section_id = $id;
			$pro->advertisement_id = $request->advertisemnt_name;
			$pro->caption = $request->caption;
			$pro->name = $request->pro_name;
			$pro->sequence_no = 0;
			$pro->height = $request->height;
			$pro->width = $request->width;
			$pro->url = 0;
			$pro->valid_from = $validfrom;
			$pro->valid_to = $validto;
			$pro->save();
			}
		}
		Session::flash('success',"Promotion Created successfully");
					return redirect('promotion_section');
		}
		
		$ads = Advertisment::query()
								->select('advertisement.*','advertisement_description.description')
								->join('advertisement_description','advertisement_description.advertisement_id','=','advertisement.advertisement_id','Left')
								->get();
	return view('adminpages.promotion_section.promotionadd',compact('ads'));
	}
	
	public function view($id)
	{
		$pid = decrypt($id);
		$promotion = Promotion_Section::query()
											->select('*')
											->where('promotion_section_id',$pid)
											->get();
											/* print_r($promotion);exit; */
		return view('adminpages.promotion_section.promotionedit',compact('promotion'));
	}
	public function update(Request $request,$id)
	{
		$pid = decrypt($id);

		$promotion = Promotion_Section::query()
											->where('promotion_section_id',$pid)
											->update(['name' => $request->name,
											'caption' => $request->caption,
											'no_of_ads' => $request->no_of_ads,
											'width' => $request->width,
											'height' => $request->height,
											'updated_at' => Carbon::now()
											]);
											
		$pro_no_of_ads = Promotion_Section::query()
												->select('*')
												->where('promotion_section_id',$pid)
												->get();
			
		$pro_count = $pro_no_of_ads[0]->no_of_ads;
		/* echo $pro_count; */
		$pro_section  = Promotion_Section_Advertisement::query()
																->select('*')
																->where('promotion_section_id',$pid)
																->get()->toarray();
		
		$pro_section_1 = array_column($pro_section,'promotion_section_id');
		
		$t_img_1 = count($pro_section_1);
		
		if($pro_count > $t_img_1)
		{
			
			$p_sec_adv_count = (int)$pro_count - (int)$t_img_1;
			
			/* $count = $promotion[]->no_of_ads; */
			$validfrom = $date_from = date('Y-m-d', strtotime($request->valid_from));
			$validto = $date_from = date('Y-m-d', strtotime($request->valid_to));
			for($i=1;$i<=$p_sec_adv_count;$i++)
			{
			$pro = new Promotion_Section_Advertisement;
			$pro->promotion_section_id = $pid;
			$pro->advertisement_id = $request->advertisemnt_name;
			$pro->caption = $request->caption;
			$pro->name = $request->pro_name;
			$pro->sequence_no = 0;
			$pro->height = $request->height;
			$pro->width = $request->width;
			$pro->url = 0;
			$pro->valid_from = $validfrom;
			$pro->valid_to = $validto;
			$pro->save();
			}
		}
		
		if($pro_count < $t_img_1)
		{
			/* echo $p_cont = (int)$t_img_1-(int)$pro_count."<br>"; */
			
			$pro_section_1 = array_column($pro_section,'promotion_section_advertisement_id');
			
			
			/* $pro_active = array_slice($pro_section_1,- $t_img_1,$p_cont, true); */
			/* print_R($pro_section_1); */
			
			/* echo $pro_count; 
			echo $t_img_1; */ 
			$b = ($t_img_1 - $pro_count); 
			/* echo $b; */
			$pro_active = array_slice($pro_section_1,0,$b);
		/* 	print_r($pro_active);exit; */
			foreach($pro_active as $pro_sec_id)
			{
				
				$pro_sec = Promotion_Section_Advertisement::query()
																->where('promotion_section_advertisement_id','=',$pro_sec_id)
																->delete();
			}
			
		}
		
											/* print_r($promotion);exit; */
		Session::flash('success',"Promotion Updated successfully");
					return redirect('promotion_section');
	}
	public function promotion_delete($id)
	{
		$pid = decrypt($id);
		$promotion = Promotion_Section::query()
											->where('promotion_section_id',$pid)
											->delete();
											
			Session::flash('success',"Promotion Updated successfully");
					return redirect('promotion_section');
	}
	public function single_active(Request $request)
	{
		/* echo Auth::user()->user_id;exit; */
		$status = $request->status;
		$id = $request->id;
		$promotion = Promotion_Section::query()
								->where('promotion_section_id',$id)
								->update([
								'is_active'=>$status,
								'updated_at'=>Carbon::now()
								 ]);
								 
		
								 
		$promotion_get = Promotion_Section::query()
								->select('*')
								->where('promotion_section_id',$id)
								->get();
			echo $promotion_get[0]->is_active;
	}
	public function promotion_single_view(Request $request)
	{
		$id = $request->uid;
		$promotion_get = Promotion_Section::query()
								->select('*')
								->where('promotion_section_id',$id)
								->get();
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$promotion_get[0]->name."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Caption:</label>".$promotion_get[0]->caption."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Sequence No:</label>".$promotion_get[0]->sequence_no."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>No Of Ads:</label>".$promotion_get[0]->no_of_ads."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Width:</label>".$promotion_get[0]->width."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Height:</label>".$promotion_get[0]->height."</div></div></div>";
	}
	
	public function check_pro_no_of_ads(Request $request){
		
		$pid = $request->pro_id;
		$no_of_ads = $request->no_of_ads;
		
		$pro_section  = Promotion_Section_Advertisement::query()
																->select('*')
																->where('promotion_section_id',$pid)
																->get()->toarray();
		$pro_section_2 = array_column($pro_section,'promotion_section_id');
		
		
		$t_img_2 = count($pro_section_2);
		
		if($no_of_ads < $t_img_2)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	} 
}
