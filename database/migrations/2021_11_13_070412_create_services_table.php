<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('s_id');
            $table->string('s_type');
            $table->string('s_name');
            $table->integer('maxTourist');
            $table->integer('s_price');
            $table->string('s_overview');

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
        Schema::dropIfExists('services');
    }
}
