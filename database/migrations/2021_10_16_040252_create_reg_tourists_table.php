<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegTouristsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_tourists', function (Blueprint $table) {
            $table->id('rt_id');
            $table->string('rt_name');
            $table->string('rt_contact');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('c_package');

            //foreign key - relates to user table (provider)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_tourists');
    }
}
