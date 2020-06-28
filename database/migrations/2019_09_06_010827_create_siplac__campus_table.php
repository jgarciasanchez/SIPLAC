<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacCampusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_campus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->unsignedBigInteger('dir_id');
            $table->foreign('dir_id')->references('id')->on('siplac_direccion');
            $table->unsignedBigInteger('sed_id');
            $table->foreign('sed_id')->references('id')->on('siplac_sede');
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
        Schema::dropIfExists('siplac_campus');
    }
}
