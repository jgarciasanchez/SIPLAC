<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacCicloProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_ciclo_proyecto', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->unsignedBigInteger('cic_id');
         $table->foreign('cic_id')->references('id')->on('siplac_ciclo');
        $table->unsignedBigInteger('pro_id');
         $table->foreign('pro_id')->references('id')->on('siplac_proyecto');
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
        Schema::dropIfExists('siplac_ciclo_proyecto');
    }
}
