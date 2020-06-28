<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerAreaAcademica extends Migration
{
    public function up()
    {
        DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_area_academica AFTER DELETE ON siplac_area_academica FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_area_academica","nombreArea",OLD.nombreArea, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_area_academica","descripcion",OLD.descripcion, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_area_academica","estado",OLD.estado, null);
           END
           ');

           DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_area_academica AFTER UPDATE ON siplac_area_academica FOR EACH ROW
           BEGIN
                IF OLD.nombreArea != NEW.nombreArea THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_area_academica","numero",OLD.nombreArea, NEW.nombreArea);
                END IF;
                IF OLD.estado != NEW.estado THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_area_academica","estado",OLD.estado, NEW.estado);
                END IF;
                IF OLD.descripcion != NEW.descripcion THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_area_academica","descripcion",OLD.descripcion, NEW.descripcion);
                END IF;
             END
            ');

            DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_area_academica AFTER INSERT ON siplac_area_academica FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_area_academica","nombreArea",null, NEW.nombreArea);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_area_academica","estado",null, NEW.estado);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_area_academica","descripcion",null, NEW.descripcion);
            END
            ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_area_academica`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_area_academica`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_area_academica`');

    }


}
