<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacDireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_direccion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('decripcion',500);
            $table->string('latitud',10)->nullable();
            $table->string('longitud',10)->nullable();
            $table->string('codig_postal',20)->nullable();
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
        Schema::dropIfExists('siplac_direccion');
    }
}
