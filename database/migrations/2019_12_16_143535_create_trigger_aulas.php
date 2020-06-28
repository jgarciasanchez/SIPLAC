<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerAulas extends Migration
{

    public function up()
    {
        DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_aulas AFTER DELETE ON siplac_aulas FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_aulas","numero",OLD.numero, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_aulas","capacidad",OLD.capacidad, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_aulas","estado",OLD.estado, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_aulas","cam_id",OLD.cam_id, null);
           END
           ');

           DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_aulas AFTER UPDATE ON siplac_aulas FOR EACH ROW
           BEGIN
                IF OLD.numero != NEW.numero THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_aulas","numero",OLD.numero, NEW.numero);
                END IF;
                IF OLD.capacidad != NEW.capacidad THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_aulas","capacidad",OLD.capacidad, NEW.capacidad);
                END IF;
                IF OLD.estado != NEW.estado THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_aulas","estado",OLD.estado, NEW.estado);
                END IF;
                IF OLD.cam_id != NEW.cam_id THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_aulas","cam_id",OLD.cam_id, NEW.cam_id);
                END IF;
             END
            ');

            DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_aulas AFTER INSERT ON siplac_aulas FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_aulas","numero",null, NEW.numero);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_aulas","capacidad",null, NEW.capacidad);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_aulas","estado",null, NEW.estado);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_aulas","cam_id",null, NEW.cam_id);
            END
            ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_aulas`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_aulas`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_aulas`');

    }


}
