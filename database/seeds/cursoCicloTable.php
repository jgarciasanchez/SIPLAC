<?php

use Illuminate\Database\Seeder;
use App\cursoCiclo;
class cursoCicloTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\cursoCiclo::class,50)->create();
    }
}
