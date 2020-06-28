<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacCarrerastable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_carrera', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100);
            $table->string('fecha_apertura');
            $table->string('estado',1);
            $table->string('fecha_cierre')->nullable();
            $table->unsignedBigInteger('are_id');
            $table->foreign('are_id')->references('id')->on('siplac_area_academica');
            $table->string('grado',3);
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
        Schema::dropIfExists('siplac_carrera');
    }
}
