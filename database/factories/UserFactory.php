<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Profesores;
use App\AreasAcademicas;
use App\Carreras;
use App\Ciclo;
use App\Cursos;
use App\cursoCiclo;
use App\cursoProfesor;
use App\cursosCarrera;
use App\profesoresProyectos;
use App\Proyectos;
use App\Grupos;
use App\GrupoCurso;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Faker\Provider\DateTime as time;
use Faker\Provider\Barcode;
use Faker\Provider\en_US\Company;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\PhoneNumber;
use Faker\Provider\DateTime;
use Faker\Provider\en_US\Address;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
/**
 * Creacion de usuarios para pruebas
 */

$factory->define(User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'usuario' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'estado' => 'A',
        'remember_token' => Str::random(10)
   		 ];
});

/**
 * Creacion de profesores para pruebas
 */
$factory->define(Profesores::class, function (Faker $faker) {
    return [
            'nombre1' => $faker->firstName,
	        'nombre2' => $faker->firstName,
	        'cedula' => $faker->unique()->ean13,
	        'apellido1' => $faker->lastName,
	        'apellido2' => $faker->lastName,
            'fnacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'fsalida' => '',
            'fingreso' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'estado' => $faker->randomElement(['I', 'A']),
            'categoria' => $faker->randomElement(['Categoria 1', 'Categoria 2','Categoria 3', 'Categoria 4']),
            'email' => $faker->unique()->freeEmail,
            'telefono' => $faker->tollFreePhoneNumber ,
            'area_academica_id' => AreasAcademicas::inRandomOrder()->value('id') ?: factory(AreasAcademicas::class)
   		 ];
});
/**
 * Creacion de Areas academicas para pruebas
 */

 $factory->define(Carreras::class, function (Faker $faker) {
     return [
             'nombre' => $faker->jobTitle,
             'are_id' => AreasAcademicas::inRandomOrder()->value('id') ?: factory(AreasAcademicas::class),
             'fecha_apertura' => $faker->date($format = 'Y-m-d', $max = 'now'),
             'fecha_cierre' => $faker->date($format = 'Y-m-d', $max = 'now'),
             'grado' => "I",
             'estado' => 'A'
          ];
 });

$factory->define(AreasAcademicas::class, function (Faker $faker) {
    return [
            'nombreArea' => $faker->jobTitle,
            'descripcion' => $faker->realText($maxNbChars = 20, $indexSize = 2),
            'estado'=>'A'
         ];
});



$factory->define(Ciclo::class, function (Faker $faker) {
    return [
            'ciclo' => rand(1,3),
            'fecha_inicio' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'fecha_fin' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'estado'=>'A'
         ];
});

$factory->define(Cursos::class, function (Faker $faker) {
    return [
            'nombre_cur' => $faker->jobTitle,
            'codigo' => rand(4000,5000),
            'creditos' => rand(1,5),
            'horas' => rand(1,6),
            'estado' => 'A',
            'horas_contacto' => rand(1,7),
            'color' => $faker->hexcolor,
            'are_id' => Cursos::inRandomOrder()->value('id') ?: factory(AreasAcademicas::class),
            'carrera_id' => Carreras::inRandomOrder()->value('id') ?: factory(Carreras::class)
         ];
});

$factory->define(Proyectos::class, function (Faker $faker) {
    return [
            'nombre' => $faker->jobTitle,
            'codigo_sia' => $faker->ean8,
            'descripcion' => $faker->realText($maxNbChars = 200, $indexSize = 1),
            'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'fecha_inicio' => $faker->date($format = 'Y-m-d', $max = '2015-11-11'),
            'fecha_fin' => $faker->date($format = 'Y-m-d', $min = '2015-12-12'),
         ];
});


$factory->define(cursoCiclo::class, function (Faker $faker) {
    return [
            'curso_id' => Cursos::inRandomOrder()->value('id') ?: factory(Cursos::class),
            'ciclo_id' => Ciclo::inRandomOrder()->value('id') ?: factory(Ciclo::class)
         ];
});

$factory->define(cursosCarrera::class, function (Faker $faker) {
    return [
            'carrera_id' => Cursos::inRandomOrder()->value('id') ?: factory(Cursos::class),
            'cursos_id' => Carreras::inRandomOrder()->value('id') ?: factory(Carreras::class)
         ];
});

$factory->define(profesoresProyectos::class, function (Faker $faker) {
    return [
            'profesor_id' => Profesores::inRandomOrder()->value('id') ?: factory(Profesores::class),
            'proyecto_id' => Proyectos::inRandomOrder()->value('id') ?: factory(Proyectos::class)
         ];
});

$factory->define(Grupos::class, function (Faker $faker) {
    return [
            'numero' => $faker->buildingNumber,
            'estado' => 'A',
            'nivel' => $faker->randomElement(['I','II','III','IV','V'])
         ];
});

$factory->define(GrupoCurso::class, function (Faker $faker) {
    return [
            'nrc'  => $faker->buildingNumber,
            'ciclo_id' => Ciclo::inRandomOrder()->value('id') ?: factory(Ciclo::class),
            'grupo' => $faker->buildingNumber,
            'curso_id' => Cursos::inRandomOrder()->value('id') ?: factory(Cursos::class)
         ];
});
