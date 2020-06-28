<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacCampusCarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_campus_carrera', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cam_id');
            $table->foreign('cam_id')->references('id')->on('siplac_campus');
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('siplac_carrera');
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
        Schema::dropIfExists('siplac_campus_carrera');
    }
}
