<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRedemmedAdvertisementCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('user_redemmed_advertisement_code', function (Blueprint $table){
			 $table->increments('user_redeemed_advertisement_code_id');
			 $table->integer('user_id');
			 $table->integer('advertisement_offer_code_id');
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
        Schema::drop('user_redemmed_advertisement_code');
    }
}
