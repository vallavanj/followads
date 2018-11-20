<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_business_rating extends Model
{
    protected $table = "user_business_rating";
	protected $fillable = [
	'business_user_rating_id','business_id','advertisement_id','rating','feedback','user_id','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
