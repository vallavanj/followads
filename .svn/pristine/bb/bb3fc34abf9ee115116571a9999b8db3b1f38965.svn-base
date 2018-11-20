<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement', function (Blueprint $table){
		   $table->increments('advertisement_id');
		   $table->integer('business_id');
		   $table->string('icon_image_url',100)->nullable();
		   $table->dateTime('valid_from')->nullable();
		   $table->dateTime('valid_to')->nullable();
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
         Schema::drop('advertisement');
    }
}
