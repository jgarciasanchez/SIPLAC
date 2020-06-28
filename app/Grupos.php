<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    protected $table = 'siplac_grupos';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'numero', 'nivel', 'estado'
    ];

    public function scopenumero($query, $numero)
    {
        if ($numero)
            return $query->where('numero', 'like', "%$numero%");
    }

    public function scopenivel($query, $nivel)
    {
        if ($nivel)
            return $query->where('nivel', 'like', "%$nivel%");
    }

    public function scopefiltro($query, $numero, $nivel)
    {
        if ($numero) {
            return $query->where('numero', 'like', "%$numero%");
        } elseif ($nivel) {
            return $query->where('nivel', 'like', "%$nivel%");
        }
    }

    public function scopejoinCursos($query){
        return $query->select('SIPLAC_grupos.numero', 'SIPLAC_grupos.nivel', 'SIPLAC_grupos_cursos.curso_id as cur_id', 'SIPLAC_grupos.id')
        ->leftJoin('SIPLAC_grupos_cursos', 'SIPLAC_grupos_cursos.grupos_id', '=', 'SIPLAC_grupos.id')
        ->where('SIPLAC_grupos.estado', '=', 'A');
    }

    public function scopeEqual($query, $id){
        return $query->select('SIPLAC_grupos.numero', 'SIPLAC_grupos.nivel', 'SIPLAC_grupos_cursos.curso_id as cur_id', 'SIPLAC_grupos.id as ori_id')
        ->Join('SIPLAC_grupos_cursos', 'SIPLAC_grupos_cursos.grupos_id', '=', 'SIPLAC_grupos.id')
        ->where('SIPLAC_grupos.estado', '=', 'A')
        ->where('SIPLAC_grupos_cursos.curso_id', '=', "$id");
    }
    
}
