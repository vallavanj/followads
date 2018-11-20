<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Saved_Advertisement extends Model
{
    protected $table = "user_saved_advertisement";
	protected $fillable = [
	'user_saved_advertisement_id','user_id','advertisement_id','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
