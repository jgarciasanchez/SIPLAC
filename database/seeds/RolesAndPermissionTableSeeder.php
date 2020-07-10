<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class RolesAndPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permiso de usuarios################################################################
        Permission::create(
            ['name'      =>'usuarios.index',
            'description'=>'Se puede navegar por los usuarios',
            'second_name'=>'Navegar',]);
        Permission::create(
            ['name'		 =>'usuarios.show',
            'description'        =>'Ver los datos de los usuarios',
            'second_name'        =>'Ver']);
        Permission::create(
            ['name'		 =>'usuarios.edit',
            'description'       =>'Puede editar los datos de los usuarios',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'		 =>'usuarios.create',
            'description'       =>'Puede crear nuevos usuarios',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'		 =>'usuarios.destroy',
            'description'       =>'Puede desactivar los usuarios',
            'second_name'       =>'desactivar',]);

       //permiso de profesores###################################################################
        Permission::create(
            ['name'		 =>'profesores.index',
            'description'      =>'Navegar por los profesores',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'		 =>'profesores.show' ,
            'description'      =>'Mostrar datos de profesores' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'		 =>'profesores.edit',
            'description'       =>'Editar datos de los profesores',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'		 =>'profesores.create',
            'description'       =>'Puede crear nuevos profesores',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'		 =>'profesores.destroy',
            'description'       =>'Puede desactivar profesores',
            'second_name'       =>'Desactivar',]);

        //permiso de cursos##################################################################
        Permission::create(
            ['name'      =>'cursos.index',
            'description'      =>'Navegar por los cursos',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'cursos.show' ,
            'description'      =>'Mostrar datos de cursos' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'cursos.edit',
            'description'       =>'Editar datos de los cursos',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'cursos.create',
            'description'       =>'Puede crear nuevos cursos',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'cursos.destroy',
            'description'       =>'Puede desactivar cursos',
            'second_name'       =>'Desactivar',]);
        Permission::create(
            ['name'      =>'gruposData',
            'description'       =>'Agrupar los datos del curso',
            'second_name'       =>'Agrupar',]);
      
        Permission::create(
            ['name'      =>'listaCursos',
            'description'      =>'Navegar por los cursos',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'estadoGrupo' ,
            'description'      =>'Mostrar estado' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'editRelations',
            'description'       =>'Editar datos de los cursos',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'estadoCarrera',
            'description'       =>'Estado de carrera',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'next',
            'description'       =>'Puede siguiente cursos',
            'second_name'       =>'Siguiente',]);
        Permission::create(
            ['name'      =>'carrerasData',
            'description'       =>'Ver datos de carreras',
            'second_name'       =>'Ver carreras',]);




        //permiso de aulas############################################################

        Permission::create(
            ['name'      =>'aulas.index',
            'description'      =>'Navegar por los aulas',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'aulas.show' ,
            'description'      =>'Mostrar datos de aulas' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'aulas.edit',
            'description'       =>'Editar datos de los aulas',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'aulas.create',
            'description'       =>'Puede crear nuevos aulas',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'aulas.destroy',
            'description'       =>'Puede desactivar aulas',
            'second_name'       =>'Desactivar',]);

        //permiso de bitacora########################################################
        Permission::create(
            ['name'      =>'bitacora.index',
            'description'      =>'Navegar por la bitacora',
            'second_name'      =>'Navegar',]);

        //permiso de backups##########################################################

        Permission::create(
            ['name'      =>'backups.index',
            'description'      =>'Navegar por los backups',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'backups.show' ,
            'description'      =>'Mostrar datos de backups' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'backups.edit',
            'description'       =>'Editar datos de los backups',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'backups.create',
            'description'       =>'Puede crear nuevos backups',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'backups.destroy',
            'description'       =>'Puede desactivar backups',
            'second_name'       =>'Eliminar',]);
          Permission::create(
            ['name'      =>'backups.download',
            'description'       =>'Puede Descargar los backups',
            'second_name'       =>'Descargar',]);

        //permiso de carrera##########################################################

        Permission::create(
            ['name'      =>'carrera.index',
            'description'      =>'Navegar por las carreras',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'carrera.show' ,
            'description'      =>'Mostrar datos de las carreras' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'carrera.edit',
            'description'       =>'Editar datos de las carreras',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'carrera.create',
            'description'       =>'Puede crear nuevas carreras',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'carrera.destroy',
            'description'       =>'Puede desactivar las carreras',
            'second_name'       =>'Desactivar',]);
        Permission::create(
            ['name'      =>'listaCarreras',
            'description'      =>'Ver la lista de las carreras',
            'second_name'      =>'Listar',]);

        //permiso de reportes#########################################################

        Permission::create(
            ['name'      =>'reporte1.reporte1',
            'description'      =>'Genera reportes',
            'second_name'      =>'Reporte 1',]);
        Permission::create(
            ['name'      =>'reporte.reporte' ,
            'description'      =>'Genera reportes' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'infoReporte.infoReporte',
            'description'       =>'Generar el reporte con su información y puede descargar.',
            'second_name'       =>'Informacion',]);
        Permission::create(
            ['name'      =>'excel.excel',
            'description'       =>'Genera reporte',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'reportes.index',
            'description'       =>'Navegar por los reportes',
            'second_name'       =>'Navegar',]);


        Permission::create(
            ['name'      =>'updateReporte2.updateReporte2',
            'description'       =>'Actualizar los reportes.',
            'second_name'       =>'Actualizar',]);
        Permission::create(
            ['name'      =>'semanal.semanal',
            'description'       =>'Descargar el horario',
            'second_name'       =>'Horario descargar',]);



        //permiso de roles#####################################################

        Permission::create(
            ['name'       =>'roles.index',
            'description'       =>'Navegar por los roles',
            'second_name'       =>'Navegar',]);
        Permission::create(
            ['name'       =>'roles.show' ,
            'description'       =>'Ver los datos de los roles' ,
            'second_name'       =>'Ver' ,]);
        Permission::create(
            ['name'       =>'roles.edit',
            'description'       =>'Editar los roles',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'       =>'roles.create',
            'description'       =>'Crear nuevos roles',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'       =>'roles.destroy',
            'description'       =>'Eliminar los roles',
            'second_name'       =>'Eliminar',]);
        
        //permiso de areaacademica###################################################

        Permission::create(
            ['name'      =>'areaacademica.index',
            'description'      =>'Navegar por las areas academicas',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'areaacademica.show' ,
            'description'      =>'Mostrar datos de las areas academicas' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'areaacademica.edit',
            'description'       =>'Editar datos de las areas academicas',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'areaacademica.create',
            'description'       =>'Puede crear nuevas areas academicas',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'areaacademica.destroy',
            'description'       =>'Puede desactivar las areas academicas',
            'second_name'       =>'Desactivar',]);

        //permiso de ciclo##############################################################
         Permission::create(
            ['name'      =>'listaCiclo',
            'description'      =>'Listar los ciclo',
            'second_name'      =>'Listar',]);
        Permission::create(
            ['name'      =>'ciclo.index',
            'description'      =>'Navegar por los ciclos',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'ciclo.show' ,
            'description'      =>'Mostrar datos de los ciclos' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'ciclo.edit',
            'description'       =>'Editar datos de los ciclos',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'ciclo.create',
            'description'       =>'Puede crear nuevos ciclos',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'ciclo.destroy',
            'description'       =>'Puede desactivar los ciclos',
            'second_name'       =>'Desactivar',]);

       //permiso de grupo############################################################
         Permission::create(
            ['name'      =>'listaGrupos',
            'description'      =>'Listar los ciclo',
            'second_name'      =>'Listar',]);
        Permission::create(
            ['name'      =>'grupos.index',
            'description'      =>'Navegar por los grupos',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'grupos.show' ,
            'description'      =>'Mostrar datos de los grupos' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'grupos.edit',
            'description'       =>'Editar datos de los grupos',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'grupos.create',
            'description'       =>'Puede crear nuevos grupos',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'grupos.destroy',
            'description'       =>'Puede desactivar los grupos',
            'second_name'       =>'Desactivar',]);

        //permiso de cursosCarrera#####################################################
        Permission::create(
            ['name'      =>'cursosCarrera.index',
            'description'      =>'Navegar por los cursos por carrera',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'cursosCarrera.show' ,
            'description'      =>'Mostrar datos de los cursos por carrera' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'cursosCarrera.edit',
            'description'       =>'Editar datos de los cursos por carrera',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'cursosCarrera.create',
            'description'       =>'Puede crear nuevos cursos por carrera',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'cursosCarrera.destroy',
            'description'       =>'Puede desactivar los cursos por carrera',
            'second_name'       =>'Desactivar',]);

        //permiso de proyectos#####################################################
         Permission::create(
            ['name'      =>'proyecto_busqueda',
            'description'      =>'Listar realiza la busqueda',
            'second_name'      =>'Buscar',]);
         Permission::create(
            ['name'      =>'estadoProfesor',
            'description'      =>'Estado del profesor',
            'second_name'      =>'Estado profesore',]);
        Permission::create(
            ['name'      =>'proyectos.index',
            'description'      =>'Navegar por los proyectos',
            'second_name'      =>'Navegar',]);
        Permission::create(
            ['name'      =>'proyectos.show' ,
            'description'      =>'Mostrar datos de los proyectos' ,
            'second_name'      =>'Ver' ,]);
        Permission::create(
            ['name'      =>'proyectos.edit',
            'description'       =>'Editar datos de los proyectos',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'proyectos.create',
            'description'       =>'Puede crear nuevos proyectos',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'proyectos.destroy',
            'description'       =>'Puede desactivar los proyectos',
            'second_name'       =>'Desactivar',]);
       
        //permiso de asignar Curso################################################################
        Permission::create(
            ['name'      =>'asignacioncursos.index',
            'description'=>'Se puede navegar por la pantalla de asignacion de cursos',
            'second_name'=>'Navegar',]);
        Permission::create(
            ['name'      =>'asignacioncursos.show',
            'description'        =>'Ver los datos de asignacion de cursos',
            'second_name'        =>'Ver']);
        Permission::create(
            ['name'      =>'asignacioncursos.edit',
            'description'       =>'Puede editar los datos de asignacion de cursos',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'asignacioncursos.create',
            'description'       =>'Puede asignar cursos ',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'asignacioncursos.destroy',
            'description'       =>'Puede desactivar algun curso asignado',
            'second_name'       =>'desactivar',]);

        //permiso deListar Horarios#

        Permission::create(
            ['name'      =>'horario.index',
            'description'=>'Se puede navegar por los horarios',
            'second_name'=>'Navegar',]);
        Permission::create(
            ['name'      =>'horario.show',
            'description'        =>'Ver los datos de los horarios',
            'second_name'        =>'Ver']);
        Permission::create(
            ['name'      =>'horario.edit',
            'description'       =>'Puede editar los datos de los horarios',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'horario.create',
            'description'       =>'Puede crear nuevos horarios',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'horario.destroy',
            'description'       =>'Puede desactivar los horarios',
            'second_name'       =>'desactivar',]);
        Permission::create(
            ['name'      =>'listaHorarios.listaHorarios',
            'description'      =>'Listar los horarios',
            'second_name'      =>'Listar Horarios',]);

        //permiso deListar Horarios 2#

        Permission::create(
            ['name'      =>'horario2.index',
            'description'=>'Se puede navegar por los horario reporte',
            'second_name'=>'Navegar',]);
        Permission::create(
            ['name'      =>'horario2.show',
            'description'        =>'Ver los datos de los horario reporte',
            'second_name'        =>'Ver']);
        Permission::create(
            ['name'      =>'horario2.edit',
            'description'       =>'Puede editar los datos de los horario reporte',
            'second_name'       =>'Editar',]);
        Permission::create(
            ['name'      =>'horario2.create',
            'description'       =>'Puede crear nuevos horario reporte',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'horario2.destroy',
            'description'       =>'Puede desactivar los horario reporte',
            'second_name'       =>'desactivar',]);
        Permission::create(
            ['name'      =>'listaHorarios.listaHorarios2',
            'description'      =>'Listar los horario reporte',
            'second_name'      =>'Listar Horarios',]);


        //Administrador rol
        $admin = Role::create(
            ['name' => 'Admin',
            'description' => 'El superadministrador',]);

        $admin->givePermissionTo([
            'usuarios.index',
            'usuarios.edit',
            'usuarios.show',
            'usuarios.create',
            'usuarios.destroy',

            'horario2.index',
            'horario2.edit',
            'horario2.show',
            'horario2.create',
            'horario2.destroy',
            'listaHorarios.listaHorarios2',


            'horario.index',
            'horario.edit',
            'horario.show',
            'horario.create',
            'horario.destroy',
            'listaHorarios.listaHorarios',

            'asignacioncursos.index',
            'asignacioncursos.edit',
            'asignacioncursos.show',
            'asignacioncursos.create',
            'asignacioncursos.destroy',

            'proyectos.create',
            'proyectos.index',
            'proyectos.show',
            'proyectos.create',
            'proyectos.edit',
            'proyectos.destroy',
            'proyecto_busqueda',
            'estadoProfesor',

            'grupos.index',
            'grupos.edit',
            'grupos.show',
            'grupos.create',
            'grupos.destroy',
            'listaGrupos',

            'cursosCarrera.index',
            'cursosCarrera.edit',
            'cursosCarrera.show',
            'cursosCarrera.create',
            'cursosCarrera.destroy',

            'carrera.index',
            'carrera.show',
            'carrera.edit',
            'listaCarreras',
            'carrera.create',
            'carrera.destroy',

            'roles.index',
            'roles.show' ,
            'roles.edit',
            'roles.create',
            'roles.destroy',

            'profesores.index',
            'profesores.edit',
            'profesores.show',
            'profesores.create',
            'profesores.destroy',

            'cursos.index',
            'cursos.edit',
            'cursos.show',
            'cursos.create',
            'cursos.destroy',
            'gruposData',
            'listaCursos',
            'estadoGrupo',
            'editRelations',
            'estadoCarrera',
            'next',
            'carrerasData',

            'aulas.index',
            'aulas.show',
            'aulas.edit',
            'aulas.create',
            'aulas.destroy',

            'bitacora.index',

            'backups.index',
        	'backups.show' ,
        	'backups.edit',
        	'backups.create',
        	'backups.destroy',
            'backups.download',

        	'reporte1.reporte1',
       		'reporte.reporte' ,
       		'infoReporte.infoReporte',
       		'excel.excel',
       		'reportes.index',
            'updateReporte2.updateReporte2',
            'semanal.semanal',

            'areaacademica.index',
            'areaacademica.show',
            'areaacademica.edit',
            'areaacademica.create',
            'areaacademica.destroy',

            'ciclo.index',
            'ciclo.edit',
            'ciclo.show',
            'ciclo.create',
            'ciclo.destroy',
            'listaCiclo',

        ]);
         //visita es solo para visualizar contenido
        $visita = Role::create(['name' => 'visita','description' => 'Solo puede visualizar el contenido']);
        $visita->givePermissionTo([
            'horario2.index',
            'horario2.show',
            'listaHorarios.listaHorarios2',


            'horario.index',
            'horario.show',
            'listaHorarios.listaHorarios',

            'asignacioncursos.index',
            'asignacioncursos.show',

            'proyectos.create',
            'proyectos.index',
            'proyectos.show',
            'proyecto_busqueda',
            'estadoProfesor',

            'grupos.index',
            'grupos.show',

            'listaGrupos',

            'cursosCarrera.index',


            'carrera.index',
            'carrera.show',
            'listaCarreras',


            'roles.index',
            'roles.show' ,


            'profesores.index',
            'profesores.edit',

            'cursos.index',
            'gruposData',
            'listaCursos',
            'estadoGrupo',
            'editRelations',
            'estadoCarrera',
            'next',
            'carrerasData',

            'aulas.index',
            'aulas.show',


            'bitacora.index',

            'backups.index',
            'backups.show' ,

            'reporte1.reporte1',
            'reporte.reporte' ,
            'infoReporte.infoReporte',
            'excel.excel',
            'reportes.index',

            'areaacademica.index',
            'areaacademica.show',


            'ciclo.index',
            'ciclo.edit',
            'ciclo.show',
            'listaCiclo',
        ]);
        //rol de edicion 
        $editor = Role::create(['name' => 'editor','description' => 'Puede editar contenido mas no puede crearlo',]);
        $editor->givePermissionTo([

            
            'horario2.index',
            'horario2.edit',
            'horario2.show',
            'horario2.destroy',
            'listaHorarios.listaHorarios2',


            'horario.index',
            'horario.edit',
            'horario.show',
            'horario.destroy',
            'listaHorarios.listaHorarios',

            'asignacioncursos.index',
            'asignacioncursos.edit',
            'asignacioncursos.show',
            'asignacioncursos.destroy',

            'proyectos.create',
            'proyectos.index',
            'proyectos.show',
            'proyectos.edit',
            'proyectos.destroy',
            'proyecto_busqueda',
            'estadoProfesor',

            'grupos.index',
            'grupos.edit',
            'grupos.show',
            'grupos.destroy',
            'listaGrupos',

            'cursosCarrera.index',
            'cursosCarrera.edit',
            'cursosCarrera.show',
            'cursosCarrera.destroy',

            'carrera.index',
            'carrera.show',
            'carrera.edit',
            'listaCarreras',
            'carrera.destroy',

            'roles.index',
            'roles.show' ,
            'roles.edit',
            'roles.destroy',

            'profesores.index',
            'profesores.edit',
            'profesores.show',
            'profesores.destroy',

            'cursos.index',
            'cursos.edit',
            'cursos.show',
            'cursos.destroy',
            'gruposData',
            'listaCursos',
            'estadoGrupo',
            'editRelations',
            'estadoCarrera',
            'next',
            'carrerasData',

            'aulas.index',
            'aulas.show',
            'aulas.edit',
            'aulas.destroy',

            'bitacora.index',

            'backups.index',
            'backups.show' ,
            'backups.edit',
            'backups.destroy',
            'backups.download',

            'reporte1.reporte1',
            'reporte.reporte' ,
            'infoReporte.infoReporte',
            'excel.excel',
            'reportes.index',
            'updateReporte2.updateReporte2',
            'semanal.semanal',

            'areaacademica.index',
            'areaacademica.show',
            'areaacademica.edit',
            'areaacademica.destroy',

            'ciclo.index',
            'ciclo.edit',
            'ciclo.show',
            'ciclo.destroy',
            'listaCiclo',
        ]);
        $creador = Role::create(['name' => 'creador','description' => 'Puede crear contenido mas no puede modificarlo.']);
        $creador->givePermissionTo([

            'horario2.index',
            'horario2.show',
            'horario2.create',
            'horario2.destroy',
            'listaHorarios.listaHorarios2',


            'horario.index',
            'horario.show',
            'horario.create',
            'horario.destroy',
            'listaHorarios.listaHorarios',

            'asignacioncursos.index',
            'asignacioncursos.show',
            'asignacioncursos.create',
            'asignacioncursos.destroy',

            'proyectos.create',
            'proyectos.index',
            'proyectos.show',
            'proyectos.create',
            'proyectos.destroy',
            'proyecto_busqueda',
            'estadoProfesor',

            'grupos.index',
            'grupos.show',
            'grupos.create',
            'grupos.destroy',
            'listaGrupos',

            'cursosCarrera.index',
            'cursosCarrera.show',
            'cursosCarrera.create',
            'cursosCarrera.destroy',

            'carrera.index',
            'carrera.show',
            'listaCarreras',
            'carrera.create',
            'carrera.destroy',

            'roles.index',
            'roles.show' ,
            'roles.create',
            'roles.destroy',

            'profesores.index',
            'profesores.show',
            'profesores.create',
            'profesores.destroy',

            'cursos.index',
            'cursos.show',
            'cursos.create',
            'cursos.destroy',
            'gruposData',
            'listaCursos',
            'estadoGrupo',
            'editRelations',
            'estadoCarrera',
            'next',
            'carrerasData',

            'aulas.index',
            'aulas.show',
            'aulas.create',
            'aulas.destroy',

            'bitacora.index',

            'backups.index',
            'backups.show' ,
            'backups.create',
            'backups.destroy',
            'backups.download',

            'reporte1.reporte1',
            'reporte.reporte' ,
            'infoReporte.infoReporte',
            'excel.excel',
            'reportes.index',
            'updateReporte2.updateReporte2',
            'semanal.semanal',

            'areaacademica.index',
            'areaacademica.show',
            'areaacademica.create',
            'areaacademica.destroy',

            'ciclo.index',
            'ciclo.show',
            'ciclo.create',
            'ciclo.destroy',
            'listaCiclo',
        ]);
        //un segundo administrador de todo menos los mismos usuarios
        $admin2 = Role::create(
            ['name' => 'Admin2',
            'description' => 'El administrador secundario, tiene acceso a todo menos la parte de administración de usuarios.',]);
        $admin2->givePermissionTo([

            'horario2.index',
            'horario2.edit',
            'horario2.show',
            'horario2.create',
            'horario2.destroy',
            'listaHorarios.listaHorarios2',


            'horario.index',
            'horario.edit',
            'horario.show',
            'horario.create',
            'horario.destroy',
            'listaHorarios.listaHorarios',

            'asignacioncursos.index',
            'asignacioncursos.edit',
            'asignacioncursos.show',
            'asignacioncursos.create',
            'asignacioncursos.destroy',

            'proyectos.create',
            'proyectos.index',
            'proyectos.show',
            'proyectos.create',
            'proyectos.edit',
            'proyectos.destroy',
            'proyecto_busqueda',
            'estadoProfesor',

            'grupos.index',
            'grupos.edit',
            'grupos.show',
            'grupos.create',
            'grupos.destroy',
            'listaGrupos',

            'cursosCarrera.index',
            'cursosCarrera.edit',
            'cursosCarrera.show',
            'cursosCarrera.create',
            'cursosCarrera.destroy',

            'carrera.index',
            'carrera.show',
            'carrera.edit',
            'listaCarreras',
            'carrera.create',
            'carrera.destroy',

            'roles.index',
            'roles.show' ,
            'roles.edit',
            'roles.create',
            'roles.destroy',

            'profesores.index',
            'profesores.edit',
            'profesores.show',
            'profesores.create',
            'profesores.destroy',

            'cursos.index',
            'cursos.edit',
            'cursos.show',
            'cursos.create',
            'cursos.destroy',
            'gruposData',
            'listaCursos',
            'estadoGrupo',
            'editRelations',
            'estadoCarrera',
            'next',
            'carrerasData',

            'aulas.index',
            'aulas.show',
            'aulas.edit',
            'aulas.create',
            'aulas.destroy',

            'bitacora.index',

            'backups.index',
            'backups.show' ,
            'backups.edit',
            'backups.create',
            'backups.destroy',
            'backups.download',

            'reporte1.reporte1',
            'reporte.reporte' ,
            'infoReporte.infoReporte',
            'excel.excel',
            'reportes.index',
            'updateReporte2.updateReporte2',
            'semanal.semanal',

            'areaacademica.index',
            'areaacademica.show',
            'areaacademica.edit',
            'areaacademica.create',
            'areaacademica.destroy',

            'ciclo.index',
            'ciclo.edit',
            'ciclo.show',
            'ciclo.create',
            'ciclo.destroy',
            'listaCiclo',
        ]);
        //rol administrador a el usuario por defecto
        //User Admin
        $user = User::find(1);
        $user->assignRole('Admin');

        $user = User::find(2);
        $user->assignRole('admin2');

         $user = User::find(3);
        $user->assignRole('creador');

         $user = User::find(4);
        $user->assignRole('editor');

        $user = User::find(5);
        $user->assignRole('visita');
    }
}
