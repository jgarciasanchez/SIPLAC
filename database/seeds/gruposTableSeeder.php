<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Grupos;
class gruposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Grupos::class,50)->create();
    }
}