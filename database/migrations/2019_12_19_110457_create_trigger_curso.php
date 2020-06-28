<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCurso extends Migration
{


public function up()
{
    DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_cursos AFTER DELETE ON siplac_curso FOR EACH ROW
        BEGIN
               CALL pr_insertar_bitacora(OLD.id,"D","siplac_curso","nombre_cur",OLD.nombre_cur, null);
               CALL pr_insertar_bitacora(OLD.id,"D", "siplac_curso","codigo",OLD.codigo, null);
               CALL pr_insertar_bitacora(OLD.id,"D","siplac_curso","creditos",OLD.creditos, null);
               CALL pr_insertar_bitacora(OLD.id,"D", "siplac_curso","horas",OLD.horas, null);
               CALL pr_insertar_bitacora(OLD.id,"D", "siplac_curso","estado",OLD.estado, null);
               CALL pr_insertar_bitacora(OLD.id,"D", "siplac_curso","horas_contacto",OLD.horas_contacto, null);
       END
       ');

       DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_cursos AFTER UPDATE ON siplac_curso FOR EACH ROW
       BEGIN
            IF OLD.nombre_cur != NEW.nombre_cur THEN
              CALL pr_insertar_bitacora(OLD.id,"U","siplac_curso","nombre_cur",OLD.nombre_cur, NEW.nombre_cur);
            END IF;
            IF OLD.codigo != NEW.codigo THEN
              CALL pr_insertar_bitacora(OLD.id,"U", "siplac_curso","codigo",OLD.codigo, NEW.codigo);
            END IF;
            IF OLD.estado != NEW.estado THEN
              CALL pr_insertar_bitacora(OLD.id,"U","siplac_curso","estado",OLD.estado, NEW.estado);
            END IF;
            IF OLD.creditos != NEW.creditos THEN
              CALL pr_insertar_bitacora(OLD.id,"U", "siplac_curso","creditos",OLD.creditos, NEW.creditos);
            END IF;
            IF OLD.horas != NEW.horas THEN
              CALL pr_insertar_bitacora(OLD.id,"U", "siplac_curso","horas",OLD.horas, NEW.horas);
            END IF;
            IF OLD.horas_contacto != NEW.horas_contacto THEN
              CALL pr_insertar_bitacora(OLD.id,"U", "siplac_curso","horas_contacto",OLD.horas_contacto, NEW.horas_contacto);
            END IF;
         END
        ');

        DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_cursos AFTER INSERT ON siplac_curso FOR EACH ROW
        BEGIN
               CALL pr_insertar_bitacora(NEW.id,"I","siplac_curso","nombre_cur",null, NEW.nombre_cur);
               CALL pr_insertar_bitacora(NEW.id,"I", "siplac_curso","codigo",null, NEW.codigo);
               CALL pr_insertar_bitacora(NEW.id,"I","siplac_curso","estado",null, NEW.estado);
               CALL pr_insertar_bitacora(NEW.id,"I", "siplac_curso","creditos",null, NEW.creditos);
               CALL pr_insertar_bitacora(NEW.id,"I", "siplac_curso","horas",null, NEW.horas);
              CALL pr_insertar_bitacora(NEW.id,"I", "siplac_curso","horas_contacto",null, NEW.horas_contacto);
        END
        ');
}

public function down()
{
    DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_curso`');
    DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_curso`');
    DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_curso`');

}

}
