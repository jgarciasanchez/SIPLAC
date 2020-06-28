<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacCursosCicloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_cursos_ciclo', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('curso_id')->index();
            $table->foreign('curso_id')->references('id')->on('siplac_curso')->onDelete('cascade');

            $table->unsignedBigInteger('ciclo_id')->index();
            $table->foreign('ciclo_id')->references('id')->on('siplac_ciclo')->onDelete('cascade');
            
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
        Schema::dropIfExists('siplac_cursos_ciclo');
    }
}
