<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UsuarioTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
       public function run()
    {
      //sona de creacion de usuarios por defecto
      App\User::create([
          'nombre' => 'UnaAdmin2020',
          'usuario' => 'UnaAdmin2020',
          'password' => bcrypt('7155admin'), // password
          'estado' => 'A',
          'remember_token' => Str::random(10)
        ]);
        App\User::create([
          'nombre' => 'UnaAdmin2_2020',
          'usuario' => 'UnaAdmin2_2020',
          'password' => bcrypt('adMinR2D2'), // password
          'estado' => 'A',
          'remember_token' => Str::random(10)
        ]);

        App\User::create([
          'nombre' => 'UnaCreador2020',
          'usuario' => 'UnaCreador2020',
          'password' => bcrypt('4268ted23'), // password
          'estado' => 'A',
          'remember_token' => Str::random(10)
        ]);

         App\User::create([
          'nombre' => 'UnaEditor2020',
          'usuario' => 'UnaEditor2020',
          'password' => bcrypt('edit5692'), // password
          'estado' => 'A',
          'remember_token' => Str::random(10)
        ]);

        App\User::create([
          'nombre' => 'UnaVisita2020',
          'usuario' => 'UnaVisita2020',
          'password' => bcrypt('45visor_34'), // password
          'estado' => 'A',
          'remember_token' => Str::random(10)
        ]);
    //Generar usuarios radom
	   // factory(App\User::class,50)->create();

  	}
}