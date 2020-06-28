<?php

use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         DB::table('siplac_campus')->insert([
             'nombre' => 'Campus Perez Zeledon',
             'dir_id' => 1,
             'sed_id' => 2
         ]);

         DB::table('siplac_campus')->insert([
             'nombre' => 'Campus Coto',
             'dir_id' => 2,
             'sed_id' => 2
         ]);


          DB::table('siplac_campus')->insert([
             'nombre' => 'Campus Omar Dengo',
             'dir_id' =>5,
             'sed_id' =>5
          ]);

          DB::table('siplac_campus')->insert([
             'nombre' => 'Campus Benjamín Núñez',
             'dir_id' =>4,
             'sed_id' =>5
          ]);

           DB::table('siplac_campus')->insert([
             'nombre' => 'Interuniversitaria Alajuela',
             'dir_id' =>3,
             'sed_id' =>5
         ]);

            DB::table('siplac_campus')->insert([
             'nombre' => 'Campus Sarapiquí',
             'dir_id' =>6,
             'sed_id' =>3
         ]);

          DB::table('siplac_campus')->insert([
             'nombre' => 'Campus Liberia',
             'dir_id' =>8,
             'sed_id' =>1
          ]);

           DB::table('siplac_campus')->insert([
             'nombre' => 'Campus Nicoya',
             'dir_id' =>7,
             'sed_id' =>1
         ]);
     }
}
