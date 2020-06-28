<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerDireccion extends Migration
{



    public function up()
    {

        DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_direccion AFTER DELETE ON siplac_direccion FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_direccion","decripcion",OLD.decripcion, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_direccion","latitud",OLD.latitud, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_direccion","longitud",OLD.longitud, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_direccion","codig_postal",OLD.codig_postal, null);
           END
           ');

           DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_direccion AFTER UPDATE ON siplac_direccion FOR EACH ROW
           BEGIN
                IF OLD.decripcion != NEW.decripcion THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_direccion","descripcion",OLD.decripcion, NEW.decripcion);
                END IF;
                IF OLD.latitud != NEW.longitud THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_direccion","latitud",OLD.latitud, NEW.latitud);
                END IF;
                IF OLD.longitud != NEW.longitud THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_direccion","longitud",OLD.longitud, NEW.longitud);
                END IF;
                IF OLD.codig_postal != NEW.codig_postal THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_direccion","codig_postal",OLD.codig_postal, NEW.codig_postal);
                END IF;
             END
            ');

            DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_direccion AFTER INSERT ON siplac_direccion FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_direccion","decripcion",null, NEW.decripcion);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_direccion","latitud",null, NEW.latitud);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_direccion","longitud",null, NEW.longitud);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_direccion","codig_postal",null, NEW.codig_postal);
            END
            ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_direccion`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_direccion`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_direccion`');

    }


}
