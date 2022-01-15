<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_services', function (Blueprint $table) {
            $table->id('ts_id');
            $table->string('ts_type');
            $table->string('ts_name');
            $table->integer('maxTourist');
            $table->integer('ts_price');
            $table->string('ts_overview');
            //image upload
            $table->string('name')->nullable();
            //optional
            $table->string('image_path')->nullable();
            $table->timestamps();
            //foreign key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_services');
    }
}
