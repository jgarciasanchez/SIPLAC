<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerGrupo extends Migration
{

                public function up()
                {
                    DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_grupo AFTER DELETE ON siplac_grupos FOR EACH ROW
                        BEGIN
                               CALL pr_insertar_bitacora(OLD.id,"D","siplac_grupo","numero",OLD.numero, null);
                               CALL pr_insertar_bitacora(OLD.id,"D", "siplac_grupo","estado",OLD.estado, null);
                               CALL pr_insertar_bitacora(OLD.id,"D","siplac_grupo","nivel",OLD.nivel, null);

                       END
                       ');

                       DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_grupo AFTER UPDATE ON siplac_grupos FOR EACH ROW
                       BEGIN
                            IF OLD.numero != NEW.numero THEN
                              CALL pr_insertar_bitacora(OLD.id,"U","siplac_grupo","numero",OLD.numero, NEW.numero);
                            END IF;
                            IF OLD.estado != NEW.estado THEN
                              CALL pr_insertar_bitacora(OLD.id,"U","siplac_grupo","estado",OLD.estado, NEW.estado);
                            END IF;
                            IF OLD.nivel != NEW.nivel THEN
                              CALL pr_insertar_bitacora(OLD.id,"U","siplac_grupo","nivel",OLD.nivel, NEW.nivel);
                            END IF;

                         END
                        ');

                        DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_grupo AFTER INSERT ON siplac_grupos FOR EACH ROW
                        BEGIN
                               CALL pr_insertar_bitacora(NEW.id,"I","siplac_grupo","numero",null, NEW.numero);
                               CALL pr_insertar_bitacora(NEW.id,"I","siplac_grupo","estado",null, NEW.estado);
                               CALL pr_insertar_bitacora(NEW.id,"I","siplac_grupo","nivel",null, NEW.nivel);

                        END
                        ');
                }

                public function down()
                {
                    DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_grupo`');
                    DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_grupo`');
                    DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_grupo`');

                }
}
