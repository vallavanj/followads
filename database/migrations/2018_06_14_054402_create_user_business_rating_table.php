<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBusinessRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_business_rating', function (Blueprint $table){
			$table->increments('business_user_rating_id');
			$table->integer('business_id');
			$table->integer('user_id');
			$table->integer('advertisement_id')->nullable();
			$table->float('rating');
			$table->longText('feedback')->nullable();
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
       Schema::drop('user_business_rating');
    }
}
