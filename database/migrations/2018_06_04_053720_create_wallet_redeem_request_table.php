<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletRedeemRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_redeem_request', function (Blueprint $table){
			 $table->increments('wallet_redeem_id');
			 $table->integer('wallet_id');
			 $table->integer('redeem_amount');
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
        Schema::drop('wallet_redeem_request');
    }
}
