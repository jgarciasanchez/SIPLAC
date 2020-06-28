<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCampus extends Migration
{

        public function up()
        {
            DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_campus AFTER DELETE ON siplac_campus FOR EACH ROW
                BEGIN
                       CALL pr_insertar_bitacora(OLD.id,"D","siplac_campus","nombre",OLD.nombre, null);
                       CALL pr_insertar_bitacora(OLD.id,"D", "siplac_campus","dir_id",OLD.dir_id, null);
                       CALL pr_insertar_bitacora(OLD.id,"D","siplac_campus","sed_id",OLD.sed_id, null);
               END
               ');

               DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_campus AFTER UPDATE ON siplac_campus FOR EACH ROW
               BEGIN
                    IF OLD.nombre != NEW.nombre THEN
                      CALL pr_insertar_bitacora(OLD.id,"U","siplac_campus","nombre",OLD.nombre, NEW.nombre);
                    END IF;
                    IF OLD.dir_id != NEW.dir_id THEN
                      CALL pr_insertar_bitacora(OLD.id,"U", "siplac_campus","dir_id",OLD.dir_id, NEW.dir_id);
                    END IF;
                    IF OLD.sed_id != NEW.sed_id THEN
                      CALL pr_insertar_bitacora(OLD.id,"U","siplac_campus","sed_id",OLD.sed_id, NEW.sed_id);
                    END IF;
                 END
                ');

                DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_campus AFTER INSERT ON siplac_campus FOR EACH ROW
                BEGIN
                       CALL pr_insertar_bitacora(NEW.id,"I","siplac_campus","nombre",null, NEW.nombre);
                       CALL pr_insertar_bitacora(NEW.id,"I", "siplac_campus","dir_id",null, NEW.dir_id);
                       CALL pr_insertar_bitacora(NEW.id,"I","siplac_campus","sed_id",null, NEW.sed_id);
                END
                ');
        }

        public function down()
        {
            DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_campus`');
            DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_campus`');
            DB::unprepared('DROP TRIGGER IF EXISTS  `tr_bitacora_insertar_campus`');

        }

}
