<?php

use Illuminate\Database\Seeder;
use App\Cursos;

class GrupoCursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GrupoCurso::class,25)->create();
    }
}
