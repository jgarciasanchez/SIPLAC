<?php

use Illuminate\Database\Seeder;
use App\Ciclo;



class cicloTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siplac_ciclo')->insert([
            [
            'ciclo' => 1,
            'fecha_inicio' => '2019-02-03',
            'fecha_fin' => '2019-06-11',
            'estado' => 'A'
            ],
            [
            'ciclo' => 2,
            'fecha_inicio' => '2019-07-20',
            'fecha_fin' => '2019-12-11',
            'estado' => 'A'
            ],
            [
            'ciclo' => 1,
            'fecha_inicio' => '2020-02-06',
            'fecha_fin' => '2020-06-10',
            'estado' => 'A'
            ],
            [
            'ciclo' => 2,
            'fecha_inicio' => '2020-07-18',
            'fecha_fin' => '2020-12-07',
            'estado' => 'A'
            ]
    ]);
    }
}
