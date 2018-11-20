<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('staticpages', function (Blueprint $table){
			$table->increments('page_id');
			$table->string('page_title',200)->nullable();
			$table->longtext('page_content')->nullable();
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
			Schema::dropIfExists('staticpages');
    }
}
