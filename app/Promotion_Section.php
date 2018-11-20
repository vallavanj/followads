<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion_Section extends Model
{
   protected $table = "promotion_section";
	protected $fillable = ['name','caption','sequence_no','no_of_ads','height','width','is_active','created_by','created_at','updated_by','updated_at'];
	
	public $timestamps = false;
}
