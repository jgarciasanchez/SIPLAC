<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    use Notifiable;
    protected $table = 'siplac_profesores';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'nombre1', 'nombre2', 'cedula', 'apellido1', 'apellido2', 'fnacimiento', 'fsalida', 'fingreso', 'estado', 'categoria', 'email', 'telefono', 'area_academica_id'
    ];
    //query scope
    public function scopenombre($query, $nombre1)
    {
        if ($nombre1)
            return $query->where('nombre1', 'like', "%$nombre1%");
    }
    public function scopeapellidos($query, $apellido1)
    {
        if ($apellido1)
            return $query->where('apellido1', 'like', "%$apellido1%");
    }
    public function scopecedula($query, $cedula)
    {
        if ($cedula)
            return $query->where('cedula', 'like', "%$cedula%");
    }

    public function scopeced($query, $cedula)
    {
            return $query->select('siplac_profesores.id','siplac_profesores.nombre1', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_profesores.cedula')
            ->where('cedula', '=', "$cedula");
    }

    public function scopenombreC($query, $id)
    {
        return $query->select('siplac_profesores.id','siplac_profesores.nombre1', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_profesores.cedula')
            ->where('siplac_profesores.id', '=', "$id");
    }
    

    public function scopecurso($query, $nombre, $apellido)
    {
        return $query->select('siplac_profesores.id', 'siplac_profesores.estado', 'siplac_profesores.nombre1', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_profesores.cedula')
            ->distinct()
            ->join('siplac_curso_profesor', 'siplac_curso_profesor.profesor_id', '=', 'siplac_profesores.id')
            ->where('siplac_profesores.estado', '=', 'A');
    }

    public function scopecursoJoinID($query, $id)
    {
        return $query->select('siplac_profesores.id as prof_id', 'siplac_grupos_cursos.curso_id as cur_id')
            ->leftJoin('siplac_curso_profesor', 'siplac_curso_profesor.profesor_id', '=', 'siplac_profesores.id')
            ->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_curso_profesor.nrc_id')
            ->where('siplac_profesores.id', '=', "$id");
    }

    public function scopecursoJoinPID($query, $id)
    {
        return $query->select('siplac_profesores.id as prof_id', 'siplac_grupos_cursos.curso_id as cur_id')
            ->leftJoin('siplac_curso_profesor', 'siplac_curso_profesor.profesor_id', '=', 'siplac_profesores.id')
            ->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_curso_profesor.nrc_id')
            ->where('siplac_profesores.id', '=', "$id")
            ->where('siplac_curso_profesor.tipo_asingnacion', '=', 'P');
    }

    public function scopejoinProyectos($query)
    {
        return $query->select('siplac_profesores.id', 'siplac_profesores.estado', 'siplac_profesores.nombre1', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_profesores.cedula', 'siplac_proyectos_profesores.proyecto_id as proy_id')
            ->leftjoin('siplac_proyectos_profesores', 'siplac_proyectos_profesores.profesor_id', '=', 'siplac_profesores.id')
            ->where('siplac_profesores.estado', '=', 'A');
    }

    public function scopeproyectoJoin($query)
    {
        return $query->select('siplac_profesores.id', 'siplac_profesores.estado', 'siplac_profesores.nombre1', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_profesores.cedula')
            ->distinct()
            ->join('siplac_proyectos_profesores', 'siplac_proyectos_profesores.profesor_id', '=', 'siplac_profesores.id')
            ->where('siplac_profesores.estado', '=', 'A');
    }

    
    public function scopeproyectoJoinID($query, $id)
    {
        return $query->select('siplac_profesores.id as prof_id', 'siplac_proyectos_profesores.proyecto_id as proy_id')
            ->leftJoin('siplac_proyectos_profesores', 'siplac_proyectos_profesores.profesor_id', '=', 'siplac_profesores.id')
            ->where('siplac_profesores.id', '=', "$id");
    }

    
    public function scopeproyecto($query)
    {
        return $query->select('siplac_profesores.id', 'siplac_profesores.nombre1', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_proyectos_profesores.proyecto_id')
            ->distinct()
            ->leftjoin('siplac_proyectos_profesores', 'siplac_proyectos_profesores.profesor_id', '=', 'siplac_profesores.id')
            ->where('siplac_profesores.estado', '=', 'A');
    }
}
