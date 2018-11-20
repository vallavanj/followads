<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class offersimage extends Model
{
    protected $table = "offers_images";
	protected $fillable =[
	'offers _id','offers _images_url','is_active','created_by','created_at','updated_by','updated_at'
	];
	public $timestamps = false;
}
