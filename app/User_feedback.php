<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_feedback extends Model
{
    protected $table = "users_feedback";
	protected $fillable = [
	'users_feedback_id','users_id','feedback_subject','feedback_description','feedback_status_code','is_active','created_by','updated_by','created_at','updated_at'
	];
	
	public $timestamps = false;
}
