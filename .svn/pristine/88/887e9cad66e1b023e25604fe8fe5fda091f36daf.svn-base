<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFollowedBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('user_followed_business', function (Blueprint $table){
			 $table->increments('user_followed_business_id');
			 $table->integer('user_id');
			 $table->integer('business_id');
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
        Schema::drop('user_followed_business');
    }
}
