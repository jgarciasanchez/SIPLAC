<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerSede extends Migration
{

            public function up()
            {
                DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_sede AFTER DELETE ON siplac_sede FOR EACH ROW
                    BEGIN
                           CALL pr_insertar_bitacora(OLD.id,"D","siplac_sede","nombre",OLD.nombre, null);

                   END
                   ');

                   DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_sede AFTER UPDATE ON siplac_sede FOR EACH ROW
                   BEGIN
                        IF OLD.nombre != NEW.nombre THEN
                          CALL pr_insertar_bitacora(OLD.id,"U","siplac_sede","nombre",OLD.nombre, NEW.nombre);
                        END IF;

                     END
                    ');

                    DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_sede AFTER INSERT ON siplac_sede FOR EACH ROW
                    BEGIN
                           CALL pr_insertar_bitacora(NEW.id,"I","siplac_sede","nombre",null, NEW.nombre);

                    END
                    ');
            }

            public function down()
            {
                DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_sede`');
                DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_sede`');
                DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_sede`');

            }
}
