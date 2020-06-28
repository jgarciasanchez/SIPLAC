<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class cursosCiclo extends Model
{
	use Notifiable;
    protected $table = 'siplac_cursos_ciclo';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'curso_id', 'ciclo_id',
    ];
     //query scope
    public function scopenombre($query,$nombre){
        if($nombre)
            return $query->where('nombre','like',"%$nombre%");
    }

    public function scopearea($query,$area){
        if($area)
            return $query->join('SIPLAC_area_academica', 'SIPLAC_area_academica.id', '=', 'siplac_carrera.are_id')
            ->where('SIPLAC_area_academica.nombre', 'like', "%$area%");
    }


}
