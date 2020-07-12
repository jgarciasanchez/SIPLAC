<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuarioTable::class);
        $this->call(RolesAndPermissionTableSeeder::class);
        //$this->call(areaAcademicaTable::class);
        //$this->call(ProfesoresTable::class);
        //$this->call(carrerasTable::class);
        //$this->call(cicloTable::class);
        //$this->call(cursosTable::class);
        //$this->call(cursoCicloTable::class);
        //$this->call(cursosCarreraTable::class);
        $this->call(SedeTableSeeder::class);
        $this->call(DireccionTableSeeder::class);
        $this->call(CampusTableSeeder::class);
        //$this->call(AulasTableSeeder::class);
        //$this->call(gruposTableSeeder::class);
        //$this->call(GrupoCursoTableSeeder::class);
    }
}
