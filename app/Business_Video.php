<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_Video extends Model
{
     protected $table = "business_video";
	protected $fillable = [
	'business_video_id','business_id','business_video_url','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
