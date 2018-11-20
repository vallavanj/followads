<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionSectionAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_section_advertisement', function (Blueprint $table){
		   $table->increments('promotion_section_advertisement_id');
		   $table->string('promotion_section_id',100)->nullable();
		   $table->string('advertisement_id',100)->nullable();
		   $table->integer('sequence_no');
		   $table->string('name',100)->nullable();
		   $table->string('caption',100)->nullable();
		   $table->string('url',200);
		   $table->string('width',100)->nullable();
		   $table->string('height',100)->nullable();
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
         Schema::drop('promotion_section_advertisement');
    }
}
