<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Business;
use App\Business_Address;
use App\Business_Category;
use App\Business_image;
use App\Business_Video;
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

class Business_VideoController extends Controller
{
   public function index()
   {
	   $buss_vid = Business_Video::query()
										->select('*')
										->get();
		$buss = Business::query()
									->select('*')
									->get();
		return view('adminpages.business_video.index',compact('buss_vid','buss'));
   }
   public function business_video_create(Request $request)
   {
	   if(!empty($request->input()))
	   {
		   
		 $rules = [
			'business_name' => 'required',
			];
			$attributeNames = array(
					'business_name' => 'Name',
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
					   $buss_vid = new Business_Video;
					   $buss_vid->business_id = $request->business_name;
					   $buss_vid->business_video_url = 0;
					   $buss_vid->is_active = 1;
					   $buss_vid->created_by = 1;
					   $buss_vid->created_at = Carbon::now();
					   $buss_vid->updated_by = 1;
					   $buss_vid->updated_at = Carbon::now();
					   if($buss_vid->save())
					   {
						  $inserted_id = $buss_vid->id;
							$path='business_video/uploads/doc/'.$inserted_id;
								if (!is_dir($path)) {
																	mkdir($path, 0777, TRUE);
																	}
																	
														$profile = $request->File('business_video');
															$filename = time().'.'.$profile->getClientOriginalExtension();
															$file = time().''.$profile->getClientOriginalName();
															$location_1 = public_path($path);
															$profile->move($location_1,$file);
															$business_update = Business_Video::query()
																						->where('business_video_id','=',$inserted_id)
																						->update(['business_video_url' =>$file,
																						]);
																						
							
																						
																						
					   }
					   Session::flash('success',"Business Video Created successfully");
					   return redirect('buss_video');
					}
	   }
	    $business =  Business::query()
									->select('*')
									->get();
	   return view('adminpages.business_video.business_videoadd',compact('business'));
   }
   public function business_video_view($id)
   {
	     $id = decrypt($id);
	     $buss_vid =  Business_Video::query()
										->select('*')
										->where('business_video_id',$id)
										->get();
		$buss = Business::query()
									->select('*')
									->get();
		return view('adminpages.business_video.business_videoedit',compact('buss_vid','buss'));
   }
   public function business_video_update(Request $request,$id)
   {
	   $id = decrypt($id);
	  if($request->hasFile('business_video'))
	  {
		  $rules = [
			'business_name' => 'required',
			];
			$attributeNames = array(
					'business_name' => 'Name',
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
						   $path='business_video/uploads/doc/'.$id;
									if (!is_dir($path)) {
													mkdir($path, 0777, TRUE);
													}
													
										$profile = $request->File('business_video');
											$filename = time().'.'.$profile->getClientOriginalExtension();
											$file = time().''.$profile->getClientOriginalName();
											$location_1 = public_path($path);
											$profile->move($location_1,$file);
											$business_update = Business_Video::query()
																		->where('business_video_id','=',$id)
																		->update(['business_video_url' =>$file,
																		'business_id'=>$request->business_name
																		]);
						
																		
							Session::flash('success',"Business Video Updated successfully");
							return redirect('buss_video');
					}
	  }
	  else
	  {
			$rules = [
			'business_name' => 'required',
			];
			$attributeNames = array(
					'business_name' => 'Name',
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
					   $buss_vid =  Business_Video::query()
														->where('business_video_id',$id)
														->update([
														'business_id'=>$request->business_name,
														]);
														
							
														
														
							Session::flash('success',"Business Video Updated successfully");
											return redirect('buss_video');
					}
	}
   }
	public function business_video_delete(Request $request,$id)
	{
		$id = decrypt($id);
		$buss_vid =  Business_Video::query()
										->where('business_video_id',$id)
										->delete();
										
							
										
				Session::flash('success',"Business Video Deleted successfully");
							return redirect('buss_video');
	}
	public function buss_video_single_view(Request $request)
	{
		$id = $request->uid;
		/* echo $id;exit; */
	   $buss_img = Business_Video::query()
								->select('*')
								->where('business_video_id','=',$id)
								->get();
		$buss = Business::query()
								->select('*')
								->get();
			 $business = "";					
		 foreach($buss as $bussi)
		 {
			 if($bussi->business_id == $buss_img[0]->business_id )
			 {
				 $business = $bussi->name;
			 }
		 }
			$path='business_video/uploads/doc/'.$buss_img[0]->business_video_id .'/'.$buss_img[0]->business_video_url ;
			$image = url($path);
			$image_url = "<video width='320' height='240' controls>
							<source src=".$image." type='video/mp4' >
							<source src=".$image." type='video/ogg' >
						</video>";
					
			echo"<div class='form-horizontal view_popup_content'><div class='box-body'><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Name:</label>".$business."</div><div class='px-3'><label class='col-md-5 control-label<label class='col-md-5 control-label' for='inputEmail3'>Image:</label>".$image_url."</div></div></div>";
	}
	public function business_single_activestatus(Request $request)
	{
		$id = $request->id;
		/* echo $id;exit; */
		$status = $request->status;
		/* echo $status;exit; */
		$business = Business_Video::query()
							->where('business_video_id',$id)
							->update([
							'is_active'=>$status,
							'updated_at'=>Carbon::now()
							]);
								
			$business_status = Business_Video::query()
							->select('*')
							->where('business_video_id',$id)
							->get();
				echo $business_status[0]->is_active;
	}

}
