<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class CreateTriggerProcedimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE OR REPLACE PROCEDURE pr_insertar_bitacora (pId VARCHAR(20), pAccion VARCHAR(1), pTabla VARCHAR(30), pCol VARCHAR(30), pOld VARCHAR(500), pNew VARCHAR(500))

            INSERT INTO siplac_bitacora(
                                usu_nombre,
                                tabla,
                                id,
                                accion,
                                columna,
                                old,
                                new,
                                created_at
                            )
                            VALUES(
                                CURRENT_USER,
                                pTabla,
                                pId,
                                pAccion,
                                pCol,
                                pOld,
                                pNew,
                                CURRENT_TIMESTAMP
                            );

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                DB::unprepared('DROP TRIGGER IF EXISTS `pr_insertar_bitacora`');
    }
}
