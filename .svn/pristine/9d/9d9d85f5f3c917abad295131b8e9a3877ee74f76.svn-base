<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('gift_coupon', function (Blueprint $table){
		   $table->increments('gift_coupon_id');
		   $table->string('code',200);
		   $table->float('value');
		   $table->dateTime('generated_on');
		   $table->integer('generated_by');
		   $table->dateTime('activated_on')->nullable();
		   $table->integer('activated_by');
		   $table->integer('business_id');
		   $table->integer('max_redemption_count');
		   $table->boolean('is_active');
		   $table->integer('created_by');
		   $table->dateTime('created_at');
		   $table->integer('updated_by');
		   $table->dateTime('updated_at');
	   });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gift_coupon');
    }
}
