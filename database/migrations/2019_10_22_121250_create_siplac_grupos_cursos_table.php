<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacGruposCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_grupos_cursos', function (Blueprint $table) { 
            $table->bigIncrements('id');
            $table->string('nrc',20);
            $table->integer('grupo');
            //$table->foreign('grupos_id')->references('id')->on('siplac_grupos')->onDelete('no action');
             $table->unsignedBigInteger('curso_id')->index();
            $table->foreign('curso_id')->references('id')->on('siplac_curso')->onDelete('no action');
            $table->unsignedBigInteger('ciclo_id')->index();
            $table->foreign('ciclo_id')->references('id')->on('siplac_ciclo')->onDelete('no action');;
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
        Schema::dropIfExists('siplac_grupos_cursos');
    }
}
