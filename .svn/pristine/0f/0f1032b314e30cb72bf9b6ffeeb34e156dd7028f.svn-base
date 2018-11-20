<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_description', function (Blueprint $table){
		   $table->increments('advertisement_descriptions_id');
		   $table->integer('advertisement_id');
		   $table->longText('description');
		   $table->string('caption',200)->nullable();
		   $table->integer('language_id')->nullable();
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
        Schema::drop('advertisement_description');
    }
}
