<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSIPLACProfesores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_profesores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre1',20);
            $table->string('nombre2',20)->nullable();
            $table->string('cedula',20)->unique();
            $table->string('apellido1',30);
            $table->string('apellido2',30)->nullable();
            $table->string('fnacimiento');
            $table->string('fsalida')->nullable();
            $table->string('fingreso');
            $table->string('estado',1);
            $table->string('categoria');
            $table->string('email',50);
            $table->string('telefono',20);
            $table->unsignedBigInteger('area_academica_id');
            $table->foreign('area_academica_id')->references('id')->on('siplac_area_academica');
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
        Schema::dropIfExists('siplac_profesores');
    }
}
