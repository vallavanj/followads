<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Couponscode extends Model
{
   protected $table = "coupons_codes";
   protected $fillable = [
   'coupons_id','coupons_codes','is_active','created_by','created_at','updated_by','updated_at'
   ];
   public $timestamps = false;
}
