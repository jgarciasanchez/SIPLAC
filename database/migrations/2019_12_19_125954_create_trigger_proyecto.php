<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerProyecto extends Migration
{

    public function up()
    {
        DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_proyecto AFTER DELETE ON siplac_proyecto FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_proyecto","nombre",OLD.nombre, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_proyecto","descripcion",OLD.descripcion, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_proyecto","codigo_sia",OLD.codigo_sia, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_proyecto","fecha",OLD.fecha, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_proyecto","fecha_inicio",OLD.fecha_inicio, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_proyecto","fecha_final",OLD.fecha_final, null);

           END
           ');

           DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_proyecto AFTER UPDATE ON siplac_proyecto FOR EACH ROW
           BEGIN
                IF OLD.nombre != NEW.nombre THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_proyecto","numero",OLD.nombre, NEW.nombre);
                END IF;
                IF OLD.descripcion != NEW.descripcion THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_proyecto","descripcion",OLD.descripcion, NEW.descripcion);
                END IF;
                IF OLD.codigo_sia != NEW.codigo_sia THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_proyecto","codigo_sia",OLD.codigo_sia, NEW.codigo_sia);
                END IF;
                IF OLD.fecha != NEW.fecha THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_proyecto","fecha",OLD.fecha, NEW.fecha);
                END IF;
                IF OLD.fecha_inicio != NEW.fecha_inicio THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_proyecto","fecha_inicio",OLD.fecha_inicio, NEW.fecha_inicio);
                END IF;
                IF OLD.fecha_final != NEW.fecha_final THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_proyecto","fecha_final",OLD.fecha_final, NEW.fecha_final);
                END IF;
             END
            ');

            DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_proyecto AFTER INSERT ON siplac_proyecto FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_proyecto","nombre",null, NEW.nombre);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_proyecto","descripcion",null, NEW.descripcion);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_proyecto","codigo_sia",null, NEW.codigo_sia);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_proyecto","fecha",null, NEW.fecha);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_proyecto","fecha_inicio",null, NEW.fecha_inicio);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_proyecto","fecha_final",null, NEW.fecha_final);
            END
            ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_proyecto`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_proyecto`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_proyecto`');

    }

}
