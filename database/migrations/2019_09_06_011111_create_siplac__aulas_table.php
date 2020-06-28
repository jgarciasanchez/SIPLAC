<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_aulas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero',4);
            $table->string('capacidad',5);
            $table->string('estado',1);
            $table->unsignedBigInteger('cam_id');
            $table->foreign('cam_id')->references('id')->on('siplac_campus');
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
        Schema::dropIfExists('siplac_aulas');
    }
}
