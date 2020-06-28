<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cursosCarrera extends Model
{
    protected $table = 'siplac_carrera_curso';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'carrera_id', 'cursos_id',
    ];

    public function scopeEliminar($query, $idCurso, $idCarrera)
    {
        $query->where('siplac_carrera_curso.carrera_id', '=', "$idCarrera")
            ->where('siplac_carrera_curso.cursos_id', '=', "$idCurso")
            ->delete();
    }

    public function scopeinsertar($query, $idCurso, $idCarrera)
    {
        if ($idCarrera and $idCurso)
            return $query->insert(['cursos_id' => "$idCurso", 'carrera_id' => "$idCarrera"]);
    }

    public function scopebuscar($query, $idCurso, $idCarrera)
    {
        if ($idCarrera)
            return $query->where('siplac_carrera_curso.carrera_id', '=', "$idCarrera")
                ->where('siplac_carrera_curso.cursos_id', '=', "$idCurso");
    }
}
