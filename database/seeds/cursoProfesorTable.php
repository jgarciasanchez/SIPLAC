<?php

use Illuminate\Database\Seeder;
use App\cursoProfesor; 
class cursoProfesorTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\cursoProfesor::class,50)->create();
    }
}
