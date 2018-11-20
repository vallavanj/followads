<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Payment_Method_Details extends Model
{
    protected $table = "user_payment_method_details";
	protected $fillable = [
	'user_payment_method_details_id','user_payment_method_id','detail_key','detail_value','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
