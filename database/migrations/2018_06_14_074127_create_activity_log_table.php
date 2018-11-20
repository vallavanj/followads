<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('activity_log', function (Blueprint $table){
			$table->increments('user_Id');
			$table->string('activity_Code',25)->nullable();
			$table->longtext('detail')->nullable();
			$table->string('is_active');
			$table->string('created_by');
			$table->string('updated_by');
			$table->dateTime('created_at');
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
        Schema::dropIfExists('activity_log');
    }
}
