<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
     protected $table = "coupons";
	
	protected $fillable = ['store_id','coupons_name','coupons _description','offers_caption','valid_from','valid_to','language_id','is_active','created_by','created_at','updated_by','updated_at'];
	
	public $timestamps = false;
}
