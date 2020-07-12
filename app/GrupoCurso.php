<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class GrupoCurso extends Model
{
    use Notifiable;
    protected $table = 'siplac_grupos_cursos';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'grupo','nrc','curso_id','ciclo_id'
    ];

    public function scopeEliminar($query, $idCurso, $idGrupo)
    {
        $query->where('SIPLAC_grupos_cursos.grupos_id', '=', "$idGrupo")
            ->where('SIPLAC_grupos_cursos.curso_id', '=', "$idCurso")
            ->delete();
    }

    public function scopeinsertar($query, $idCurso, $idGrupo)
    {
        if ($idGrupo and $idCurso)
            return $query->insert(['curso_id' => "$idCurso", 'grupos_id' => "$idGrupo"]);
    }

    public function scopebuscar($query, $idCurso, $idGrupo)
    {
        if ($idGrupo)
            return $query->where('SIPLAC_grupos_cursos.grupos_id', '=', "$idGrupo")
                ->where('SIPLAC_grupos_cursos.curso_id', '=', "$idCurso");
    }
    
}
