<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class HorarioN extends Model
{
     protected $table = 'siplac_horarios';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'id','startTime','endTime','daysOfWeek','cur_id','ciclo_id','aula_id','hora_inicio','hora_fin',
    ];
//startTime endTime cur_id daysOfWeek ciclo_id aula_id id
    public function scopefiltro($query,$aul,$cur,$ciclo,$grup,$carr,$niv){
        if($aul!="Ninguno"){
        	return $query->select("siplac_horarios.id as idHorario","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.cur_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
                         ->join('siplac_aulas', 'siplac_aulas.id', '=', 'siplac_horarios.aula_id')
            			 ->where('siplac_aulas.id', '=', "$aul")->get();
        }
        else{
        	if($cur!="Ninguno"){

        		return $query->select("siplac_horarios.id as idHorario","siplac_horarios.cur_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
                ->join('SIPLAC_curso', 'SIPLAC_curso.id', '=', 'siplac_horarios.cur_id')
            	->where('siplac_curso.id', '=', "$cur")->get();
        	}
        	else{
        		if($ciclo!="Ninguno"){
	        		return $query->select("siplac_horarios.id as idHorario","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.cur_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
                    ->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_horarios.ciclo_id')
	            	->where('siplac_ciclo.id', '=', "$ciclo")->get();
	            }
	            else{
	             	if($grup!="Ninguno") {
	            		return $query->select("siplac_horarios.id as idHorario","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.cur_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
                                ->join('SIPLAC_curso', 'SIPLAC_curso.id', '=', 'SIPLAC_horarios.cur_id')
	            			    ->join('siplac_grupos_cursos', 'siplac_grupos_cursos.curso_id', '=', 'SIPLAC_curso.id')
	            			    ->join('SIPLAC_grupos', 'SIPLAC_grupos.id', '=', 'siplac_grupos_cursos.grupos_id')
	            			    ->where('SIPLAC_grupos.id', '=', "$grup")->get();
	            	}
	            	else{
	            		if ($carr!="Ninguno") {
		            		return $query->select("siplac_horarios.id as idHorario","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.cur_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
                                    ->join('SIPLAC_curso', 'SIPLAC_curso.id', '=', 'SIPLAC_horarios.cur_id')
		            			    ->join('siplac_carrera_curso', 'siplac_carrera_curso.cursos_id', '=', 'SIPLAC_curso.id')
		            			    ->join('SIPLAC_carrera', 'SIPLAC_carrera.id', '=', 'siplac_carrera_curso.carrera_id')
		            			    ->where('SIPLAC_carrera.id', '=', "$carr")->get();
		            	}elseif ($niv!="Ninguno") {
		            		return $query->select("siplac_horarios.id as idHorario","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.cur_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
                                 ->join('SIPLAC_curso', 'SIPLAC_curso.id', '=', 'SIPLAC_horarios.cur_id')
	            			     ->join('siplac_grupos_cursos', 'siplac_grupos_cursos.curso_id', '=', 'SIPLAC_curso.id')
	            			     ->join('SIPLAC_grupos', 'SIPLAC_grupos.id', '=', 'siplac_grupos_cursos.grupos_id')
	            			     ->where('SIPLAC_grupos.nivel', '=', "$niv")->get();
		            	}
		            }
	            }
        	}
        }
    }
    public function scopebusca($query,$id){
        if($id)
            if($id)
            return $query->select("siplac_horarios.id","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.cur_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
        ->where('id','=',"%$id%");
    }

    /*

    public function scopeaula($query,$id){
        if($id)
        	//dd($nombre);
            return $query->join('siplac_aulas', 'siplac_aulas.id', '=', 'siplac_horarios.aula_id')
            ->where('siplac_aulas.id', '=', "$id")->get();
    }

    public function scopeciclo($query,$id){
        if($id)
        	//dd($nombre);
            return $query->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_horarios.ciclo_id')
            ->where('siplac_ciclo.id', '=', "$id")->get();
    }

    */

}
