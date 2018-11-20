<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPaymentMethodDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('user_payment_method_details', function (Blueprint $table){
			 $table->increments('user_payment_method_details_id');
			 $table->integer('user_payment_method_id');
			 $table->string('detail_key',100);
			 $table->string('detail_value',100);
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
        Schema::drop('user_payment_method_details');
    }
}
