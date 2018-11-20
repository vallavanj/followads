<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementOfferCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_offer_code', function (Blueprint $table){
		   $table->increments('advertisement_offer_code_id');
		   $table->integer('advertisement_id');
		   $table->string('offer_code',100)->unique();
		   $table->string('offer_type_code',10);
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
         Schema::drop('advertisement_offer_code');
    }
}
