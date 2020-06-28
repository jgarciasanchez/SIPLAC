<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_curso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_cur',100);
            $table->string('codigo',4);
            $table->integer('creditos');
            $table->integer('horas');
            $table->string('estado',1);//esta es nueva
            $table->integer('horas_contacto');//este es nueva
            $table->string('color'); 
            $table->unsignedBigInteger('are_id');
            $table->foreign('are_id')->references('id')->on('siplac_area_academica');
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('siplac_carrera');
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
        Schema::dropIfExists('siplac_curso');
    }
}
