<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity_log extends Model
{
     protected $table = "activity_log";
	protected $fillable = [
	'user_Id','activity_Code','detail','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
