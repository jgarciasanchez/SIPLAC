<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use Notifiable;
    protected $table = 'siplac_carrera';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'nombre', 'are_id', 'fecha_apertura', 'fecha_cierre', 'estado','grado'
    ];
    //query scope
    public function scopenombre($query, $nombre)
    {
        if ($nombre)
            return $query->where('nombre', 'like', "%$nombre%");
    }

    public function scopearea($query, $area)
    {
        if ($area)
            return $query->join('SIPLAC_area_academica', 'SIPLAC_area_academica.id', '=', 'siplac_carrera.are_id')
                ->where('SIPLAC_area_academica.nombreArea', 'like', "%$area%");
    }

    public function scopejoinCursos($query)
    {
        return $query->select('SIPLAC_carrera.nombre', 'SIPLAC_carrera.id', 'siplac_carrera_curso.cursos_id as cur_id')
            ->leftjoin('siplac_carrera_curso', 'siplac_carrera_curso.carrera_id', '=', 'SIPLAC_carrera.id')
            ->where('SIPLAC_carrera.estado', '=', 'A');
    }
}
