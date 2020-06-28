<?php
//Kevin Gutierrez Castro
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerProfesores extends Migration
{

    public function up()
    {
        DB::unprepared('CREATE TRIGGER tr_bitacora_eliminar_profesores AFTER DELETE ON siplac_profesores FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_profesores",    "nombre1",OLD.nombre1, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "nombre2",OLD.nombre2, null);
                   CALL pr_insertar_bitacora(OLD.id,"D","siplac_profesores",   "cedula",OLD.cedula, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "apellido1",OLD.apellido1, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "apellido2",OLD.apellido2, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "fnacimiento",OLD.fnacimiento, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "fsalida",OLD.fsalida, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "estado",OLD.estado, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "categoria",OLD.categoria, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",  "email",OLD.email, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "telefono",OLD.telefono, null);
                   CALL pr_insertar_bitacora(OLD.id,"D", "siplac_profesores",   "area_academica_id",OLD.area_academica_id, null);
           END
           ');

           DB::unprepared('CREATE TRIGGER tr_bitacora_actualizar_profesores AFTER UPDATE ON siplac_profesores FOR EACH ROW
           BEGIN
                IF OLD.nombre1 != NEW.nombre1 THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_profesores",     "nombre1",OLD.nombre1, NEW.nombre1);
                END IF;
                IF OLD.nombre2 != NEW.nombre2 THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "nombre2",OLD.nombre2, NEW.nombre2);
                END IF;
                IF OLD.cedula != NEW.cedula THEN
                  CALL pr_insertar_bitacora(OLD.id,"U","siplac_profesores",     "estado",OLD.estado, NEW.estado);
                END IF;
                IF OLD.cedula != NEW.cedula THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "cedula",OLD.cedula, NEW.cedula);
                END IF;
                IF OLD.apellido1 != NEW.apellido1 THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "apellido1",OLD.apellido1, NEW.apellido1);
                END IF;
                IF OLD.apellido2 != NEW.apellido2 THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "apellido2",OLD.apellido2, NEW.apellido2);
                END IF;
                IF OLD.fnacimiento != NEW.fnacimiento THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "fnacimiento",OLD.fnacimiento, NEW.fnacimiento);
                END IF;
                IF OLD.fsalida != NEW.fsalida THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "fsalida",OLD.fsalida, NEW.fsalida);
                END IF;
                IF OLD.fingreso != NEW.fingreso THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "fingreso",OLD.fingreso, NEW.fingreso);
                END IF;
                IF OLD.estado != NEW.estado THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "estado",OLD.estado, NEW.estado);
                END IF;
                IF OLD.categoria != NEW.categoria THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "categoria",OLD.categoria, NEW.categoria);
                END IF;
                IF OLD.email!= NEW.email THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "email",OLD.email, NEW.email);
                END IF;
                IF OLD.telefono != NEW.telefono THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "telefono",OLD.telefono, NEW.telefono);
                END IF;
                IF OLD.area_academica_id != NEW.area_academica_id THEN
                  CALL pr_insertar_bitacora(OLD.id,"U", "siplac_profesores",    "area_academica_id",OLD.area_academica_id, NEW.area_academica_id);
                END IF;
             END
            ');

            DB::unprepared('CREATE TRIGGER tr_bitacora_insertar_profesores AFTER INSERT ON siplac_profesores FOR EACH ROW
            BEGIN
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_profesores",     "nombre1",null, NEW.nombre1);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "nombre2",null, NEW.nombre2);
                   CALL pr_insertar_bitacora(NEW.id,"I","siplac_profesores",     "cedula",null, NEW.cedula);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "apellido1",null, NEW.apellido1);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "apellido2",null, NEW.apellido2);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "fnacimiento",null, NEW.fsalida);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "fingreso",null, NEW.fingreso);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "estado",null, NEW.estado);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "categoria",null, NEW.categoria);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "email",null, NEW.email);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "telefono",null, NEW.telefono);
                   CALL pr_insertar_bitacora(NEW.id,"I", "siplac_profesores",    "area_academica_id",null, NEW.area_academica_id);
            END
            ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_eliminar_profesores`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_actualizar_profesores`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bitacora_insertar_aulas`');

    }


}
