<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
	use Notifiable;
    protected $table = 'siplac_curso';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'nombre_cur', 'codigo', 'creditos','horas','estado','horas_contacto','color','are_id','carrera_id',
    ];
     //query scope
    public function scopenombre($query,$nombre){
        if($nombre)
            return $query->where('nombre_cur','like',"%$nombre%");
    }
    public function scopecodigo($query,$codigo){
        if($codigo)
            return $query->where('codigo','like',"%$codigo%");
    }

    public function scopearea($query,$area){
        if($area)
            return $query->join('siplac_area_academica', 'siplac_area_academica.id', '=', 'siplac_curso.are_id')
            ->where('siplac_area_academica.nombreArea', 'like', "%$area%");
    }

    public function scopeasignados($query){
         
        $cursos = $query->select("siplac_curso.nombre_cur","siplac_curso.color","siplac_curso.codigo","siplac_curso.creditos","siplac_curso.horas","siplac_curso.horas_contacto","siplac_curso.estado","siplac_curso.are_id","siplac_curso.carrera_id","siplac_grupos_cursos.nrc","siplac_grupos_cursos.id")
        ->join ('siplac_grupos_cursos', 'siplac_grupos_cursos.curso_id','=','siplac_curso.id')
        ->get();


        //dd($cursos);
        
        return $cursos;
    }

    public function scopecursoAll($query){
           return $query->select("siplac_curso.id as idCurso","siplac_curso.color","siplac_curso.nombre_cur","siplac_curso.codigo","siplac_curso.creditos","siplac_curso.horas","siplac_curso.horas_contacto","siplac_horarios.id as idHorario","siplac_horarios.startTime","siplac_horarios.endTime","siplac_horarios.grup_cursos_id","siplac_horarios.daysOfWeek","siplac_horarios.ciclo_id","siplac_horarios.aula_id")
                                 ->join ('siplac_grupos_cursos', 'siplac_grupos_cursos.curso_id','=','siplac_curso.id')
                                 ->leftjoin('siplac_horarios', 'siplac_horarios.grup_cursos_id', '=', 'siplac_grupos_cursos.curso_id')
                                 ->get();

            
            // ->join('siplac_grupos', 'siplac_grupos.id', '=', 'siplac_grupos_cursos.grupos_id') quiza lo de los grupos
    }

}
