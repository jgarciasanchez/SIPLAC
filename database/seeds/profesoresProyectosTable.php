<?php

use Illuminate\Database\Seeder;

class profesoresProyectosTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\profesoresProyectos::class,100)->create();
    }
}
