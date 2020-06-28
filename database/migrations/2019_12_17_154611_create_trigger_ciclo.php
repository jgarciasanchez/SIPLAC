<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCiclo extends Migration
{
    public function up()
    {
        DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_ciclo AFTER DELETE ON siplac_ciclo FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_ciclo","ciclo",OLD.ciclo, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_ciclo","fecha_inicio",OLD.fecha_inicio, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_ciclo","fecha_fin",OLD.fecha_fin, null);
                    CALL pr_insertar_bitacora(OLD.id,"D","siplac_ciclo","estado",OLD.estado, null);
           END
           ');

           DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_ciclo AFTER UPDATE ON siplac_ciclo FOR EACH ROW
           BEGIN
                IF OLD.ciclo != NEW.ciclo THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_ciclo","ciclo",OLD.ciclo, NEW.ciclo);
                END IF;
                IF OLD.fecha_inicio != NEW.fecha_inicio THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_ciclo","fecha_inicio",OLD.fecha_inicio, NEW.fecha_inicio);
                END IF;
                IF OLD.fecha_fin != NEW.fecha_fin THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_ciclo","fecha_fin",OLD.fecha_fin, NEW.fecha_fin);
                END IF;
                IF OLD.estado != NEW.estado THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_ciclo","estado",OLD.estado, NEW.estado);
                END IF;
             END
            ');

            DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_ciclo AFTER INSERT ON siplac_ciclo FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_ciclo","ciclo",null, NEW.ciclo);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_ciclo","fecha_inicio",null, NEW.fecha_inicio);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_ciclo","fecha_fin",null, NEW.fecha_fin);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_ciclo","estado",null, NEW.estado);

            END
            ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_ciclo`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_ciclo`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_ciclo`');

    }

}
