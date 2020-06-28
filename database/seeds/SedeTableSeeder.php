<?php

use Illuminate\Database\Seeder;

class SedeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         DB::table('siplac_sede')->insert([
             [
             'nombre' => 'Sede Regional Chorotega'
             ],
             [
             'nombre' => 'Sede Región Brunca'
             ],
             [
             'nombre' => 'Sede Regional Huetar Norte y Caribe'
             ],
             [
             'nombre' => 'Región Huetar Atlántica'
             ],
             [
             'nombre' => 'Región Central'
             ]
     ]);
     }
}
