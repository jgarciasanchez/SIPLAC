<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
    {
    	//permiso de usuarios
        Permission::create([
        	'name'       =>'Navegar usuarios',
        	'slug'		 =>'usuarios.index',
        	'description'=>'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
        	'name'       =>'Ver detalle de usuario',
        	'slug'		 =>'usuarios.show',
        	'description'=>'Ver en detalle cada usuario del sistema',
        ]);
        Permission::create([
        	'name'       =>'Edición de usuarios',
        	'slug'		 =>'usuarios.edit',
        	'description'=>'Editar cualquier dato de un usuario del sistema',
        ]);
        Permission::create([
        	'name'       =>'Crear usuarios',
        	'slug'		 =>'usuarios.create',
        	'description'=>'Crea los usuarios del sistema',
        ]);
        Permission::create([
        	'name'       =>'Eliminar usuario',
        	'slug'		 =>'usuarios.destroy',
        	'description'=>'Elimina los usuarios del sistema',
        ]);

        //Profesores permisos
        Permission::create([
        	'name'       =>'Navegar roles',
        	'slug'		 =>'roles.index',
        	'description'=>'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
        	'name'       =>'Ver detalle de rol',
        	'slug'		 =>'roles.show',
        	'description'=>'Ver en detalle cada rol del sistema',
        ]);
        Permission::create([
        	'name'       =>'Edición de roles',
        	'slug'		 =>'roles.edit',
        	'description'=>'Editar cualquier dato de un rol del sistema',
        ]);
        Permission::create([
        	'name'       =>'Crear roles',
        	'slug'		 =>'roles.create',
        	'description'=>'Crea los roles del sistema',
        ]);
        Permission::create([
        	'name'       =>'Eliminar rol',
        	'slug'		 =>'roles.destroy',
        	'description'=>'Elimina los roles del sistema',
        ]);
        
        //Permisos de cursos
        Permission::create([
        	'name'       =>'Navegar cursos',
        	'slug'		 =>'cursos.index',
        	'description'=>'Lista y navega todos los cursos del sistema',
        ]);
        Permission::create([
        	'name'       =>'Ver detalle de curso',
        	'slug'		 =>'cursos.show',
        	'description'=>'Ver en detalle cada curso del sistema',
        ]);
        Permission::create([
        	'name'       =>'Edición de cursos',
        	'slug'		 =>'cursos.edit',
        	'description'=>'Editar cualquier dato de un curso del sistema',
        ]);
        Permission::create([
        	'name'       =>'Crear cursos',
        	'slug'		 =>'cursos.create',
        	'description'=>'Crea los cursos del sistema',
        ]);
        Permission::create([
        	'name'       =>'Eliminar curso',
        	'slug'		 =>'cursos.destroy',
        	'description'=>'Elimina los cursos del sistema',
        ]);
    }
}
