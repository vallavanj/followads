<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift_Coupon extends Model
{
     protected $table = "gift_coupon";
	
	protected $fillable = ['gift_coupon_id','code','value','generated_on','generated_by','activated_on','activated_by','business_id','max_redemption_count','is_active','created_by','created_at','updated_by','updated_at'];
	
	public $timestamps = false;
}
