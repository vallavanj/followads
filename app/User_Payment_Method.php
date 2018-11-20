<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Payment_Method extends Model
{
     protected $table = "user_payment_method";
	protected $fillable = [
	'user_payment_method_id','users_id','channel_code','account_holder_name','feedback_status_code','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
