<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('promotion_section', function (Blueprint $table){
		   $table->increments('promotion_section_id');
		   $table->string('name',100)->nullable();
		   $table->string('caption',200)->nullable();
		   $table->integer('sequence_no');
		   $table->integer('no_of_ads');
		   $table->string('width',100)->nullable();
		   $table->string('height',100)->nullable();
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
        Schema::drop('promotion_section');
    }
}
