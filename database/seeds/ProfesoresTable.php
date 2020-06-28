<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProfesoresTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 factory(App\Profesores::class,100)->create();
  }

}
