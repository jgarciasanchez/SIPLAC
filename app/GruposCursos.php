<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class GruposCursos extends Model
{
	use Notifiable;
    protected $table = 'siplac_grupos_cursos';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'nrc', 'grupos_id', 'curso_id','ciclo_id',
    ];
     //query scope
    public function scopecurso($query,$curso_id){
        if($curso_id)
            return $query->where('nombre_cur','like',"%$curso_id%");
    }
    public function scopeciclo($query,$ciclo_id){
        if($ciclo_id)
            return $query->where('ciclo_id','like',"%$ciclo_id%");
    }

}