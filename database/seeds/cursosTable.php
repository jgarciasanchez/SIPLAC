<?php

use Illuminate\Database\Seeder;
use App\Cursos;
class cursosTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cursos::class,50)->create();
    }
}
