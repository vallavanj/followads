<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Followed_Business extends Model
{
    protected $table = "user_followed_business";
	protected $fillable = [
	'user_followed_business_id','user_id','business_id','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
