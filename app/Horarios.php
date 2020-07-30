<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ciclo;
use DB;

class Horarios extends Model
{
	protected $table = 'siplac_horarios';
	protected $primaryKey  = 'id';

	protected $fillable = [
		'id', 'startTime', 'endTime', 'daysOfWeek', 'grup_cursos_id', 'ciclo_id', 'aula_id', 'hora_inicio', 'hora_fin',
	];

	public function scopefiltro($query, $aul, $cur, $ciclo, $grup, $carr, $niv)
	{
		if ($aul != "Ninguno") {
			return $query->select("siplac_horarios.id as idHorario","siplac_horarios.id as id", "siplac_horarios.startTime", "siplac_horarios.endTime", "siplac_horarios.grup_cursos_id", "siplac_horarios.daysOfWeek", "siplac_horarios.ciclo_id", "siplac_horarios.aula_id")
				->join('siplac_aulas', 'siplac_aulas.id', '=', 'siplac_horarios.aula_id')
				->where('siplac_aulas.id', '=', "$aul")->get();
		} else {
			if ($cur != "Ninguno") {
				return $query->select("siplac_horarios.id as idHorario","siplac_horarios.id as id", "siplac_horarios.startTime", "siplac_horarios.endTime", "siplac_horarios.grup_cursos_id", "siplac_horarios.daysOfWeek", "siplac_horarios.ciclo_id", "siplac_horarios.aula_id")
					->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_horarios.grup_cursos_id')
					->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
					->where('siplac_grupos_cursos.id', '=', "$cur")->get();
			} else {
				if ($ciclo != "Ninguno") {
					return $query->select("siplac_horarios.id as idHorario","siplac_horarios.id as id", "siplac_horarios.startTime", "siplac_horarios.endTime", "siplac_horarios.grup_cursos_id", "siplac_horarios.daysOfWeek", "siplac_horarios.ciclo_id", "siplac_horarios.aula_id")
						->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_horarios.ciclo_id')
						->where('siplac_ciclo.id', '=', "$ciclo")->get();
				} else {
					if ($grup != "Ninguno") {
						return $query->select("siplac_horarios.id as idHorario","siplac_horarios.id as id", "siplac_horarios.startTime", "siplac_horarios.endTime", "siplac_horarios.grup_cursos_id", "siplac_horarios.daysOfWeek", "siplac_horarios.ciclo_id", "siplac_horarios.aula_id")
							->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_horarios.grup_cursos_id')
							->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
							->where('siplac_grupos_cursos.grupo', '=', "$grup")->get();
					} else {
						/*if ($carr!="Ninguno") {
		            		return $query->select("siplac_horarios.id as idHorario","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.grup_cursos_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
		            			    ->where('siplac_carrera.id', '=', "$carr")->get();
		            	}elseif ($niv!="Ninguno") {
		            		return $query->select("siplac_horarios.id as idHorario","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.grup_cursos_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
	            			     ->where('siplac_grupos.nivel', '=', "$niv")->get();
		            	}*/
					}
				}
			}
		}
	}

	public function scopefiltrar($query, $aul, $cur, $grup,$prof){   //Guti: Nueva Funcion de filtrar 

		$cic = Ciclo::where('estado','=','A')->first(); //Busqueda por ciclo
		$carr = session('carrera');                     //Busqueda pr carrera

		$horarios = 
		$query->select("siplac_horarios.id as idHorario","siplac_horarios.id as id", "siplac_horarios.startTime", "siplac_horarios.endTime", "siplac_horarios.grup_cursos_id", "siplac_horarios.daysOfWeek", "siplac_horarios.ciclo_id", "siplac_horarios.aula_id","siplac_curso.carrera_id",
		DB::raw("(select cp_1.profesor_id from siplac_curso_profesor as cp_1 where cp_1.tipo_asingnacion = 'P' and cp_1.nrc_id = gc.id) as prof1_id"),
		DB::raw("(select cp_2.profesor_id from siplac_curso_profesor as cp_2 where cp_2.tipo_asingnacion = 'P2' and cp_2.nrc_id = gc.id) as prof2_id"))
		->join('siplac_grupos_cursos as gc', 'gc.id', '=', 'siplac_horarios.grup_cursos_id')		
		->join('siplac_curso', 'siplac_curso.id', '=', 'gc.curso_id')
		->join('siplac_aulas', 'siplac_aulas.id', '=', 'siplac_horarios.aula_id')
		->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_horarios.ciclo_id')
		->groupBy('siplac_horarios.id','siplac_horarios.startTime','siplac_horarios.endTime',"siplac_horarios.grup_cursos_id", "siplac_horarios.daysOfWeek", "siplac_horarios.ciclo_id", "siplac_horarios.aula_id","siplac_curso.carrera_id","gc.id")
		->get(); 

		
		if($prof!="Ninguno"){
			//$horarios = $horarios->where('prof1_id or prof2_id','=',$prof);
			$counter = 0;
			foreach($horarios as $horario){
				if(($horario['prof1_id'] != $prof) && ($horario['prof2_id'] != $prof)){
					$horarios->forget($counter);
				}
				$counter += 1;
			}
		}

		if($cic!="Ninguno"){
			$horarios = $horarios->where('ciclo_id','=',$cic->id);
		}

		if($carr!=null){
			if($carr!="T"){
				$horarios = $horarios->where('carrera_id','=',$carr);
			}
		}	

		if($aul!="Ninguno"){
			$horarios = $horarios->where('aula_id','=',$aul);
		}	

		return $horarios;
	}


	

	public function scopeSemanal($query, $ciclo, $ano)
	{
		return $query->select("siplac_horarios.startTime", "siplac_horarios.startTime", "siplac_horarios.daysOfWeek")
			->join("siplac_grupos_cursos", "siplac_grupos_cursos.id", "=", "siplac_horarios.grup_cursos_id")
			->join("siplac_ciclo", "siplac_ciclo.id", "=", "siplac_horarios.ciclo_id")
			->where("siplac_ciclo.ciclo", "=", $ciclo)
			->where("siplac_ciclo.fecha_inicio", "like", "$ano%");
	}

	public function scopefiltro2($query, $car, $ciclo, $grup)   
	{
		//dd($ciclo);
		if ($grup != "Ninguno" and $ciclo != "Ninguno") {
			return $query->select("siplac_horarios.id as idHorario", 
			"siplac_horarios.startTime", "siplac_horarios.endTime", 
			"siplac_horarios.grup_cursos_id", 
			"siplac_horarios.daysOfWeek", 
			"siplac_horarios.ciclo_id", 
			"siplac_horarios.aula_id", 
			'siplac_carrera.nombre', 
			'siplac_grupos_cursos.nrc',
			'siplac_grupos_cursos.grupo as numero',
			'siplac_curso.codigo',
			'siplac_curso.nombre_cur',
			'siplac_aulas.numero as aula_num',
			'siplac_profesores.nombre1',
			'siplac_profesores.apellido1',
			'siplac_profesores.apellido2')
				->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_horarios.grup_cursos_id')
				->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
				->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_horarios.ciclo_id')
				->join('siplac_curso_profesor', 'siplac_curso_profesor.nrc_id', '=', 'siplac_grupos_cursos.id')
				->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
				->join('siplac_carrera', 'siplac_carrera.id', '=', 'siplac_curso.carrera_id')
				->join('siplac_aulas', 'siplac_aulas.id', '=', 'siplac_horarios.aula_id')
				->where('siplac_ciclo.id', '=', "$ciclo")
				->where('siplac_curso_profesor.tipo_asingnacion', '=', 'P')
				->where('siplac_grupos_cursos.grupo', '=', "$grup")->get();
		} else {
			if ($car != "Ninguno") {
				return $query->select("siplac_horarios.id as idHorario", 
                "siplac_horarios.startTime", "siplac_horarios.endTime", 
                "siplac_horarios.grup_cursos_id", 
                "siplac_horarios.daysOfWeek", 
                "siplac_horarios.ciclo_id", 
                "siplac_horarios.aula_id", 
                'siplac_carrera.nombre', 
                'siplac_grupos_cursos.nrc',
                'siplac_grupos_cursos.grupo as numero',
                'siplac_curso.codigo',
                'siplac_curso.nombre_cur',
                'siplac_aulas.numero as aula_num',
                'siplac_profesores.nombre1',
                'siplac_profesores.apellido1',
                'siplac_profesores.apellido2')
                    ->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_horarios.grup_cursos_id')
                    ->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
                    ->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_horarios.ciclo_id')
                    ->join('siplac_curso_profesor', 'siplac_curso_profesor.nrc_id', '=', 'siplac_grupos_cursos.id')
                    ->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
                    ->join('siplac_carrera', 'siplac_carrera.id', '=', 'siplac_curso.carrera_id')
                    ->join('siplac_aulas', 'siplac_aulas.id', '=', 'siplac_horarios.aula_id')
                    ->where('siplac_curso_profesor.tipo_asingnacion', '=', 'P')
                    ->where('siplac_grupos_cursos.id', '=', "$car")->get();

			} else {
				if ($grup != "Ninguno") {
					return $query->select("siplac_horarios.id as idHorario", 
                "siplac_horarios.startTime", "siplac_horarios.endTime", 
                "siplac_horarios.grup_cursos_id", 
                "siplac_horarios.daysOfWeek", 
                "siplac_horarios.ciclo_id", 
                "siplac_horarios.aula_id", 
                'siplac_carrera.nombre', 
                'siplac_grupos_cursos.nrc',
                'siplac_grupos_cursos.grupo as numero',
                'siplac_curso.codigo',
                'siplac_curso.nombre_cur',
                'siplac_aulas.numero as aula_num',
                'siplac_profesores.nombre1',
                'siplac_profesores.apellido1',
                'siplac_profesores.apellido2')
                    ->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_horarios.grup_cursos_id')
                    ->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
                    ->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_horarios.ciclo_id')
                    ->join('siplac_curso_profesor', 'siplac_curso_profesor.nrc_id', '=', 'siplac_grupos_cursos.id')
                    ->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
                    ->join('siplac_carrera', 'siplac_carrera.id', '=', 'siplac_curso.carrera_id')
                    ->join('siplac_aulas', 'siplac_aulas.id', '=', 'siplac_horarios.aula_id')
                    ->where('siplac_curso_profesor.tipo_asingnacion', '=', 'P')
					->where('siplac_grupos_cursos.grupo', '=', "$grup")->get();

				} else {
					if ($ciclo != "Ninguno") {
						return $query->select("siplac_horarios.id as idHorario", 
						"siplac_horarios.startTime", 
						"siplac_horarios.endTime", 
						"siplac_horarios.grup_cursos_id", 
						"siplac_horarios.daysOfWeek", 
						"siplac_horarios.ciclo_id", 
						"siplac_horarios.aula_id", 
						'siplac_carrera.nombre', 
						'siplac_grupos_cursos.nrc',
						'siplac_grupos_cursos.grupo as numero',
						'siplac_curso.codigo',
						'siplac_curso.nombre_cur',
						'siplac_aulas.numero as aula_num',
						'siplac_profesores.nombre1',
						'siplac_profesores.apellido1',
						'siplac_profesores.apellido2')
							->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_horarios.grup_cursos_id')
							->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
							->join('siplac_carrera', 'siplac_carrera.id', '=', 'siplac_curso.carrera_id')
							->join('siplac_aulas', 'siplac_aulas.id', '=', 'siplac_horarios.aula_id')
							->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_horarios.ciclo_id')
							->join('siplac_curso_profesor', 'siplac_curso_profesor.nrc_id', '=', 'siplac_grupos_cursos.id')
							->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
							->where('siplac_curso_profesor.tipo_asingnacion', '=', 'P')
							->where('siplac_ciclo.id', '=', "$ciclo")->get();
					}
				}
			}
		}
	}
}
