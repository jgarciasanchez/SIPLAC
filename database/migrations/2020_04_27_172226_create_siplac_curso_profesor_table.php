<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacCursoProfesorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_curso_profesor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo_asingnacion',50);
            $table->string('estado',1);
            $table->unsignedBigInteger('nrc_id');
            $table->foreign('nrc_id')->references('id')->on('siplac_grupos_cursos')->onDelete('no action');
            $table->unsignedBigInteger('profesor_id');
            $table->foreign('profesor_id')->references('id')->on('SIPLAC_profesores')->onDelete('no action');
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
        Schema::dropIfExists('siplac_curso_profesor');
    }
}
