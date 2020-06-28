<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCarrera extends Migration
{

    public function up()
    {
        DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_carrera AFTER DELETE ON siplac_carrera FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_carrera","nombre",OLD.nombre, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_carrera","fecha_apertura",OLD.fecha_apertura, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_carrera","estado",OLD.estado, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_carrera","fecha_cierre",OLD.fecha_cierre, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_carrera","are_id",OLD.are_id, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_carrera","grado",OLD.grado, null);
           END
           ');

           DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_carrera AFTER UPDATE ON siplac_carrera FOR EACH ROW
           BEGIN
                IF OLD.nombre != NEW.nombre THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_carrera","nombre",OLD.nombre, NEW.nombre);
                END IF;
                IF OLD.fecha_apertura != NEW.fecha_apertura THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_carrera","fecha_apertura",OLD.fecha_apertura, NEW.fecha_apertura);
                END IF;
                IF OLD.estado != NEW.estado THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_carrera","estado",OLD.estado, NEW.estado);
                END IF;
                IF OLD.fecha_cierre != NEW.fecha_cierre THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_carrera","fecha_cierre",OLD.fecha_cierre, NEW.fecha_cierre);
                END IF;
                IF OLD.are_id!= NEW.are_id THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_carrera","are_id",OLD.are_id, NEW.are_id);
                END IF;
                IF OLD.grado != NEW.grado THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_carrera","grado",OLD.grado, NEW.grado);
                END IF;
             END
            ');

            DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_carrera AFTER INSERT ON siplac_carrera FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_carrera","nombre",null, NEW.nombre);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_carrera","fecha_apertura",null, NEW.fecha_apertura);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_carrera","estado",null, NEW.estado);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_carrera","fecha_cierre",null, NEW.fecha_cierre);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_carrera","are_id",null, NEW.are_id);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_carrera","grado",null, NEW.grado);
            END
            ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_carrera`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_carrera`');
        DB::unprepared('DROP TRIGGER IF EXISTS  `tr_bitacora_insertar_carrera`');

    }
}
