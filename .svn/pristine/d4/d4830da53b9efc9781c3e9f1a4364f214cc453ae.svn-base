<?php

namespace App\Http\Controllers;
use App\Advertisment;
use App\Business;
use App\Promotion_Section_Advertisement;
use App\Advertisement_business_address;
use App\Advertisement_Description;
use App\Advertisement_Image;
use App\Promotion_Section;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use URL;
use Image;
use Redirect;

class Promotion_Section_AdvertisementController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
	 
		 $proms = Promotion_Section::query()
										->select('*')
										->where('is_active',1)
										->get()->toarray();
	
		
		foreach ($proms as $secid){ 
		$pro_sec_ads[$secid['promotion_section_id']]= Promotion_Section::query()
										->select('promotion_section.*','promotion_section_advertisement.sequence_no as seq','promotion_section_advertisement.promotion_section_advertisement_id as sec_adv_id','promotion_section_advertisement.promotion_section_id as pro_id','promotion_section_advertisement.advertisement_id')
										->join('promotion_section_advertisement','promotion_section.promotion_section_id','=','promotion_section_advertisement.promotion_section_id','Left')
										 /*->join('advertisement as ads','promotion_section_advertisement.advertisement_id','=','ads.advertisement_id','Left')  */
										/* ->join('business as bus','ads.business_id','=','bus.business_id')  */
										->where('promotion_section_advertisement.promotion_section_id',$secid['promotion_section_id']) 
										//->orderBy('seq','DESC')				
										->get()->toarray();
	
		 		
		}
		
		
		
		
		/* $prom = Promotion_Section_Advertisement::query()
													->select('*')
													->get();*/
													
		/* $prom = Promotion_Section::query()
										->select('*')
										->get();
		 */
		/* $pro_sec_ads = Promotion_Section_Advertisement::query()
															->select('pro_sec_adv.*','ads.*','bus.name')
															->join('advertisement as ads','promotion_section_advertisement.advertisement_id','=','ads.advertisement_id','Left')
															->join('business as bus','ads.business_id','=','bus.business_id')
															->get();
										echo"<pre>";
										print_r($pro_sec_ads);exit;  */
										//print_r($pro_sec_ads);
		return view('adminpages.prom_sec_advertisement.ads_save',compact('proms','pro_sec_ads'));
	}
	public function prom_ads_create(Request $request)
	{
		$seq = $request->seq;
		$pro_id = $request->pro_id;
		$promotion=$request->promotion_id;
		
		 if(empty($request->pro_id))
		{
			
			$from = strtr($request->valid_from, '/', '-');
			$to = strtr($request->valid_to, '/', '-');
			$vaild_from = date("Y-m-d",strtotime($from));
			$vaild_to = date("Y-m-d",strtotime($to));
			
			
			 $ads_id=$request->advertisemnt_name;
			 $promotion_sec_id=$request->promotion_id;
			 
			 DB::connection()->enableQueryLog();
			 $Promotion_section_exisit_get=Promotion_Section_Advertisement::query()
			 ->where('promotion_section_id','=',$promotion_sec_id)
			 ->where('advertisement_id','=',$ads_id)
			 ->select('*')
			  ->count();
			
			if($Promotion_section_exisit_get) {
					
					return Redirect::to('promotion_section_ads')->with('error', 'Promtion Section Advertistment Already Created');
				}
			else {
				
					$pro_sec = Promotion_Section_Advertisement::query()
									->where('promotion_section_advertisement_id',$request->promotion_section_id)
									->update([
									'advertisement_id' => $request->advertisemnt_name,
									'caption' => $request->caption,
									'name' => $request->pro_name,
									'sequence_no' => $request->sequence,
									'height' => $request->height,
									'width' => $request->width,
									'url' => $request->url,
									'valid_from' => $vaild_from,
									'valid_to' => $vaild_to,
									'created_by'=>Auth::user()->user_id,
									'updated_by'=>Auth::user()->user_id,
									'created_at' => Carbon::now(),
									'updated_at'=>Carbon::now()
								]);
					Session::flash('success',"Promtion Section Advertisement  Created successfully");
					return redirect('promotion_section_ads');
				
				}
			
		
		}
				$business = Business::query()
				->select('*')
				->where('is_active','=',1)
				->get();
		return view('adminpages.prom_sec_advertisement.promotion_add',compact('pro_id','seq','business','promotion'));
	}
	public function get_bus_ad(Request $request)
	{
		$bid = $request->bid;
		
		
		$ads = Advertisment::query()
									->select('*')
									->where('business_id',$bid)
									->where('valid_to', '>=', date("Y/m/d"))
									->where('is_active','=',1)
									->get();
									
				$html = "";
				$html.="<div class='form-group'><label>Advertisement Name</label> <span class='mandatory'>*</span><br/><select name='advertisemnt_name' class='form-control' id='get_advertisement_name' required=''><option value=''>--Select Advertisement--</option>";
				foreach($ads as $ad)
				{
					$adv_count = Advertisement_business_address::query()
																	->select('*')
																	->where('advertisement_id',$ad->advertisement_id)
																	->count();
						/* echo $adv_count; */
					if(!empty($adv_count))
					{
						$html.="<option value='$ad->advertisement_id'>$ad->name</option>";
					}
				}
				$html.="</select></div>";
				$html.="<div class='form-group' id='preview'></div>";
				$html.="<div class='form-group'><label>Name</label><span class='mandatory'>*</span><br><input type='text' name='pro_name' class='form-control' placeholder='Name' required=''></div>";
				$html.="<div class='form-group'><label>Caption</label><br><input type='text' name='caption' class='form-control' placeholder='Caption'></div>";
				$html.="<div class='form-group'><label>URL</label><br><input type='text' name='url' class='form-control' placeholder='URL'></div>";
				$html.="<div class='form-group'><label>Width</label><br><input type='text' name='width' class='form-control' placeholder='Width'></div>";
				$html.="<div class='form-group'><label>Height</label><br><input type='text' name='height' class='form-control' placeholder='Height'></div>";
				$html.="<div class='form-group'><label>Valid From</label><br><input type='text' name='valid_from' class='form-control' placeholder='Valid From' id='validfrom'></div>";
				$html.="<div class='form-group'><label>Valid To</label><br><input type='text' name='valid_to' class='form-control' placeholder='Valid To' id='validto'></div>";
				
				$html.="<div class='form-group' id='show_image'></div>";
				
				$html.="<script>
									$('#validfrom').datepicker({mode: 'date',
							format: 'dd-mm-yyyy',
							autoclose: true,
					}).on('changeDate', function (selected) {
						var startDate = new Date(selected.date.valueOf());
						$('#validto').datepicker('setStartDate', startDate);
					}).on('clearDate', function (selected) {
						$('#validto').datepicker('setStartDate', null);
					});

					$('#validto').datepicker({
						  mode: 'date',
					  format: 'dd-mm-yyyy',
					   autoclose: true,
					  
					}).on('changeDate', function (selected) {
					   var endDate = new Date(selected.date.valueOf());
					   $('#validfrom').datepicker('setEndDate', endDate);
					}).on('clearDate', function (selected) {
					   $('#validfrom').datepicker('setEndDate', null);
					});

					$('#get_advertisement_name').change(function(){
					var id = $(this).val();
						$.ajax({
							type:'POST',
							url:'get_ad_image',
							data:{
								ads_id:id,
								_token:'IzmhlxiaKDQvugrs2iMHy0b5wBIPpwC2ANxEQrTX'
							},success:function(response)
							{
								$('#img_preview').remove();
								$('#preview').html(response);
							}
						});
					});
				</script>";
				
		echo $html;
		
	}
	public function get_bus()
	{ 
	
	/* echo "dfdfgg";exit; */
	
	/* $pro_sec_ads = Promotion_Section_Advertisement::query()
															->select('promotion_section_advertisement.*','ads.*','bus.name')
															->join('advertisement as ads','promotion_section_advertisement.advertisement_id','=','ads.advertisement_id','Left')
															->join('business as bus','ads.business_id','=','bus.business_id')
															->get(); */
						/* 	echo"<pre>";
							print_r($pro_sec_ads);exit; */
	}
	
	public function prom_ads_delete(Request $request)
	{
		/* $pro_id = $request->pro_id; */
		$pro_sec_id = $request->pro_id;
		/* $seq = $request->seq; */
		/* echo $pro_id."<br>";
		echo $seq; */
		
		/* $pro_sec_ads = Promotion_Section_Advertisement::query()
												->select('*')
												->where('promotion_section_id',$pro_id )
												->where('sequence_no',$seq)
												->get(); */
										/* print_r($pro_sec_ads);exit; */
										
			/* $pro_sec_id = $pro_sec_ads[0]->promotion_section_advertisement_id; */
			
			
			/* $pro_sec_ads = Promotion_Section_Advertisement::query()
															->where('promotion_section_advertisement_id',$pro_sec_id)
															->delete(); */
															
			$validfrom = $date_from = date('Y-m-d', strtotime($request->valid_from));
		 $validto = $date_from = date('Y-m-d', strtotime($request->valid_to));
				$pro_sec_ads = Promotion_Section_Advertisement::query()
															->where('promotion_section_advertisement_id',$pro_sec_id)
															->update([
															'advertisement_id' => $request->advertisemnt_name,
															'caption' => $request->caption,
															'name' => $request->pro_name,
															'sequence_no' => $request->sequence,
															'height' => $request->height,
															'width' => $request->width,
															'url' => $request->url,
															'valid_from' => $validfrom,
															'valid_to' => $validto,
															'created_by'=>Auth::user()->user_id,
															'updated_by'=>Auth::user()->user_id,
															'created_at' => Carbon::now(),
															'updated_at'=>Carbon::now()
															]);
				if($pro_sec_ads)
				{
					echo 1;
				}
				else
				{
					echo 0;
				}
		
	}
	public  static function get_adv_after_promotion($pro_id,$adv_id)
	{
		$pro_sec_ads = Promotion_Section_Advertisement::query()
															->select('promotion_section_advertisement.*','ads.*','bus.name as business_name')
															->join('advertisement as ads','promotion_section_advertisement.advertisement_id','=','ads.advertisement_id','Left')
															->join('business as bus','ads.business_id','=','bus.business_id')
															->where('promotion_section_advertisement.advertisement_id',$adv_id)
															->where('promotion_section_advertisement.promotion_section_advertisement_id',$pro_id)
															->get(); 
															
			return $pro_sec_ads;
	}
	
	public static function get_adv_image($adv_id)
	{
		$ads_img  =  DB::table('advertisement_image')
													->select('*')
													->where('advertisement_id',$adv_id)
													->where('sequence_no',1)
													->get();
													
		return $ads_img;
	}
	
	public function get_ad_image(Request $request)
	{
		/* echo "dfafsda";exit; */
		/* echo $request->ads_id; */
		$ads_image = Advertisement_Image::query()
								->select('*')
								->where('advertisement_id',$request->ads_id)
								->where('sequence_no',1)
								->get();
			$html = "";
			foreach($ads_image as $data)
			{
				$path_image = URL::to('/').'/advertisement_images/uploads/doc/'.$request->ads_id.'/'.$data->image_url;
				$width = Image::make($path_image)->width();
				/* echo $width;exit; */
				if($width > 350)
				{
					$html="<img src='".$path_image ."' width='350px' id='img_preview'>"; 
				}
				else
				{
					$html="<img src='".$path_image ."'  id='img_preview'>";
				}
			}
		
		echo $html;
	}
}
