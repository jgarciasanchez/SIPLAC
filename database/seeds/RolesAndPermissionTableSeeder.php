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
            'description'       =>'Ver informacion de reporte',
            'second_name'       =>'Informacion',]);
        Permission::create(
            ['name'      =>'excel.excel',
            'description'       =>'Genera reporte',
            'second_name'       =>'Crear',]);
        Permission::create(
            ['name'      =>'reportes.index',
            'description'       =>'Navegar por los reportes',
            'second_name'       =>'Navegar',]);


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
        $visita = Role::create(['name' => 'visita']);
        $visita->givePermissionTo([
            'profesores.index',
            'profesores.show',
            
            'cursos.index',
            'cursos.show',
            
            'aulas.index',
            'aulas.show',

            'reportes.index',

            'carrera.index',
            'carrera.show',

            'areaacademica.index',
            'areaacademica.show',
        ]);
        //rol de edicion 
        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'profesores.index',
            'profesores.show',
            'profesores.edit',
            
            'cursos.index',
            'cursos.show',
            'cursos.edit',
            
            'aulas.index',
            'aulas.show',
            'aulas.edit',


            'carrera.index',
            'carrera.show',
            'carrera.edit',
            'listaCarreras',

       		'reportes.index',

            'areaacademica.index',
            'areaacademica.show',
            'areaacademica.edit',
        ]);
        $creador = Role::create(['name' => 'creador']);
        $creador->givePermissionTo([
            'profesores.index',
            'profesores.show',
            'profesores.edit',
            'profesores.create',
            
            'cursos.index',
            'cursos.show',
            'cursos.create',
            'cursos.edit',
            
            'aulas.index',
            'aulas.show',
            'aulas.edit',
            'aulas.create',

            'carrera.index',
            'carrera.show',
            'carrera.edit',
            'listaCarreras',
            'carrera.create',

            'areaacademica.index',
            'areaacademica.show',
            'areaacademica.edit',
            'areaacademica.create',

            'reporte1.reporte1',
       		'reporte.reporte' ,
       		'infoReporte.infoReporte',
       		'excel.excel',
       		'reportes.index',
        ]);
        //un segundo administrador de todo menos los mismos usuarios
        $admin2 = Role::create(
            ['name' => 'Admin2',
            'description' => 'El administrador secuntadio',]);
        $admin2->givePermissionTo([
            'profesores.index',
            'profesores.show',
            'profesores.edit',
            'profesores.destroy',
            
            'cursos.create',
            'cursos.index',
            'cursos.show',
            'cursos.create',
            'cursos.edit',
            'cursos.destroy',

            'proyectos.create',
            'proyectos.index',
            'proyectos.show',
            'proyectos.create',
            'proyectos.edit',
            'proyectos.destroy',
            'proyecto_busqueda',
            'estadoProfesor',

            'aulas.index',
            'aulas.show',
            'aulas.edit',
            'aulas.create',
            'aulas.destroy',

            'bitacora.index',

            'backups.index',
        	'backups.show' ,

            'carrera.index',
            'carrera.show',
            'carrera.edit',
            'listaCarreras',
            'carrera.create',
            'carrera.destroy',

            'areaacademica.index',
            'areaacademica.show',
            'areaacademica.edit',
            'areaacademica.create',
            'areaacademica.destroy',

			'reporte1.reporte1',
       		'reporte.reporte' ,
       		'infoReporte.infoReporte',
       		'excel.excel',
       		'reportes.index',
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
