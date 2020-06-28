<?php

use Illuminate\Database\Seeder;
use App\AreasAcademicas;
class areaAcademicaTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AreasAcademicas::class,50)->create();
    }
}
