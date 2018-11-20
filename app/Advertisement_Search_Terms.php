<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement_Search_Terms extends Model
{
    protected $table = "advertisement_search_term";
	protected $fillable = [
	'advertisement_search_term_id','advertisement_id','search_term','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
