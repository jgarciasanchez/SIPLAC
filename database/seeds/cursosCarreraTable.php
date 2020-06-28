<?php

use Illuminate\Database\Seeder;
use App\cursosCarrera; 
class cursosCarreraTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\cursosCarrera::class,50)->create();
    }
}
