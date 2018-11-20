<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_address', function (Blueprint $table){
			$table->increments('business_address_id');
			$table->integer('business_id');
			$table->string('address',200);
			$table->string('area',50);
			$table->string('city',50);
			$table->string('state',50);
			$table->string('location',200);
			$table->string('phone_number',100)->nullable();
			$table->string('map_url',200);
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
        Schema::drop('business_address');
    }
}
