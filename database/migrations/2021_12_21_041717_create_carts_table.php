<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('s_name');
            $table->integer('no_tourist');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('tourist_id');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('tourist_id')->references('id')->on('users'); 
            $table->foreign('provider_id')->references('id')->on('providers'); 
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
