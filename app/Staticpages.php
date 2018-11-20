<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staticpages extends Model
{
      protected $table = "staticpages"; 
	protected $fillable = [
	'page_title','page_content','is_active','created_by','updated_by','created_at','updated_at'
	];
	public $timestamps = false;
}
