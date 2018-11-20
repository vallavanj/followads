<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_method', function (Blueprint $table){
			 $table->increments('user_payment_method_id');
			 $table->integer('user_id');
			 $table->string('channel_code',100);
			 $table->string('account_holder_name',100)->nullable();
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
        Schema::drop('user_payment_method');
    }
}
