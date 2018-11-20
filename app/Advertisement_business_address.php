<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement_business_address extends Model
{
    protected $table = "advertisement_business_address";
	protected $fillable = [
	'	advertisement_business_address_id','advertisement_id','business_address_id','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
