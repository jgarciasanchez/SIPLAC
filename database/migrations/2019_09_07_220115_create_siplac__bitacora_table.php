<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiplacBitacoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siplac_bitacora', function (Blueprint $table) {
            $table->string('usu_nombre',30);
            $table->string('tabla',30);
            $table->string('id',20)->nullable();
            $table->string('accion',1);
            $table->string('columna',30);
            $table->string('old',500)->nullable();
            $table->string('new',500)->nullable();
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
        Schema::dropIfExists('siplac_bitacora');
    }
}
