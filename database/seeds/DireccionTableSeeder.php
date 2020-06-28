<?php

use Illuminate\Database\Seeder;

class DireccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         DB::table('siplac_direccion')->insert([
             [
             'decripcion' => 'Barrio Sinaí, de la Escuela Pública Sinaí 1,5 km Norte, camino al Cerro Chirripó, diagonal al Hotel Palma Azul.'
             ],
             [
             'decripcion' => 'Coloradito Sur 5 km antes del Puesto Fronterizo en Paso Caso Canoas, sobre carretera Interamericana Sur.'
             ],
             [
             'decripcion' => 'Desamparados de Alajuela, 1,2 km al Este de la Iglesia Católica La Agonía, carretera a Santa Bárbara de Heredia; Centro Comercial Plaza del Este.'
             ],
             [
             'decripcion' => 'Del Cementerio Jardines del Recuerdo, 1,5 km al Oeste, Lagunilla, Ulloa, Heredia.'
             ],
             [
             'decripcion' => 'Calle 9 Avenidas 0 y 3'
             ],
             [
             'decripcion' => 'La Victoria de Horquetas, Sarapiquí, tomando la Ruta 32 desviándose en La Unión (Guápiles-Río Frío) siguiendo 15 km hacia el Norte carretera a Puerto Viejo y 3 km Este tomando la desviación al Centro de Río Frío.'
              ],
              [
             'decripcion' => ' Del plantel del MOPT 200 Suroeste, Carretera a Playa Sámara, Barrio La Granja.'
              ],
              [
             'decripcion' => ' Del Instituto de Guanacaste 600 mts. Sur, Barrio El Capulín'
              ]


     ]);
     }
}
