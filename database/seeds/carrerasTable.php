<?php

use Illuminate\Database\Seeder;
use App\Carreras;
class carrerasTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Carreras::class,50)->create();
    }
}
