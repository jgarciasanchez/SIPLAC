<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class cursoProfesor extends Model
{
    use Notifiable;
    protected $table = 'siplac_curso_profesor';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'tipo_asingnacion', 'estado', 'nrc_id', 'profesor_id',
    ];

    public function scopeprofesor($query, $nombre, $apellido)
    {
        if ($nombre or $apellido)
            return $query->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
                ->select('siplac_profesores.nombre1', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_profesores.cedula')
                ->where('siplac_profesores.nombre1', 'like', "%$nombre%")
                ->where('siplac_profesores.apellido1', 'like', "%$apellido%");
    }

    public function scopeProfesorxCurso($query)
    {
        return $query->select('siplac_profesores.nombre1', 'siplac_profesores.nombre2', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_curso.nombre_cur', 'siplac_curso.codigo', 'siplac_grupos_cursos.nrc', 'siplac_curso.creditos')
            ->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
            ->join('siplac_grupos_cursos', 'siplac_curso_profesor.nrc_id', '=', 'siplac_grupos_cursos.id')
            ->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
            ->where('siplac_profesores.estado', '=', 'A');
    }

    public function scopeProfesorxCursoxGrupo($query)
    {
        return $query->select('siplac_profesores.nombre1', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_curso.nombre_cur', 'siplac_curso.codigo', 'siplac_grupos_cursos.nrc', 'siplac_grupos.numero')
            ->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
            ->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_curso_profesor.nrc_id')
            ->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
            ->join('siplac_grupos', 'siplac_grupos.id', '=', 'siplac_grupos_cursos.grupos_id')
            ->where('siplac_profesores.estado', '=', 'A');
    }

    public function scopecursos($query, $nombre, $apellido)
    {
        if ($nombre or $apellido)
            return $query->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
                ->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_curso_profesor.curso_id')
                ->select('siplac_profesores.nombre1', 'siplac_profesores.nombre2', 'siplac_profesores.apellido1', 'siplac_profesores.apellido2', 'siplac_curso.nombre_cur', 'siplac_curso.codigo', 'siplac_curso.nrc', 'siplac_curso.creditos', 'siplac_curso.horas_contacto', 'siplac_curso_profesor.tipo_asignacion')
                ->where('siplac_profesores.nombre1', 'like', "%$nombre%")
                ->where('siplac_profesores.apellido1', 'like', "%$apellido%");
    }

    public function scopeid($query, $id)
    {
        if ($id)
            return $query->select('siplac_curso.nombre_cur', 'siplac_curso.codigo', 'siplac_curso.creditos', 'siplac_curso.horas_contacto', 'siplac_curso_profesor.tipo_asingnacion', 'siplac_grupos.numero', 'siplac_grupos_cursos.nrc')
                ->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_curso_profesor.profesor_id')
                ->join('siplac_grupos_cursos', 'siplac_grupos_cursos.id', '=', 'siplac_curso_profesor.nrc_id') //enlazo con grupoxcurso acceso=> nrc ciclo grupo
                ->join('siplac_curso', 'siplac_curso.id', '=', 'siplac_grupos_cursos.curso_id')
                ->join('siplac_grupos', 'siplac_grupos.id', '=', 'siplac_grupos_cursos.grupos_id')
                ->join('siplac_ciclo', 'siplac_ciclo.id', '=', 'siplac_grupos_cursos.ciclo_id')
                
                ->where('siplac_profesores.id', '=', "$id");
    }
}
