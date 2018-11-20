<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Redemmed_Advertisement_Code extends Model
{
     protected $table = "user_redemmed_advertisement_code";
	protected $fillable = [
	'user_redeemed_advertisement_code_id','user_id','advertisement_offer_code_id','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
