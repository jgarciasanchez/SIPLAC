<?php

use Illuminate\Database\Seeder;

class proyectosTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Proyectos::class,100)->create();
    }
}
