<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_feedback', function (Blueprint $table){
			$table->increments('users_feedback_id');
			$table->integer('users_id');
			$table->string('feedback_subject',100);
			$table->longText('feedback_description')->nullable();
			$table->string('feedback_status_code',100)->nullable();
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
         Schema::drop('users_feedback');
    }
}
