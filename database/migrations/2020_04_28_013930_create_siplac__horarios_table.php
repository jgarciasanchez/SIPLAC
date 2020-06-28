<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_horarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('startTime',6);
            $table->time('endTime',6);
            $table->string('daysOfWeek',3);
            $table->unsignedBigInteger('ciclo_id');
            $table->foreign('ciclo_id')->references('id')->on('siplac_ciclo')->nullable();;
            $table->unsignedBigInteger('aula_id');
            $table->foreign('aula_id')->references('id')->on('siplac_aulas')->nullable();
            $table->unsignedBigInteger('grup_cursos_id');
            $table->foreign('grup_cursos_id')->references('id')->on('siplac_grupos_cursos')->nullable();
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
        Schema::dropIfExists('siplac_horarios');
    }
}
