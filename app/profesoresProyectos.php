<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class profesoresProyectos extends Model
{
    use Notifiable;
    protected $table = 'siplac_proyectos_profesores';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'proyecto_id', 'profesor_id',
    ];
    //query scope

    public function scopeEliminar($query, $idProfesor, $idProyecto)
    {
        $query->where('siplac_proyectos_profesores.proyecto_id', '=', "$idProyecto")
            ->where('siplac_proyectos_profesores.profesor_id', '=', "$idProfesor")
            ->delete();
    }

    public function scopeinsertar($query, $idProfesor, $idProyecto)
    {
        if ($idProyecto and $idProfesor)
            return $query->insert(['profesor_id' => "$idProfesor", 'proyecto_id' => "$idProyecto"]);
    }

    public function scopebuscar($query, $idProfesor, $idProyecto)
    {
        if ($idProyecto)
            return $query->where('siplac_proyectos_profesores.proyecto_id', '=', "$idProyecto")
                ->where('siplac_proyectos_profesores.profesor_id', '=', "$idProfesor");
    }

    public function scopeid($query, $id)
    {
        if($id)
        return $query->join('siplac_profesores', 'siplac_profesores.id', '=', 'siplac_proyectos_profesores.profesor_id')
            ->join('siplac_proyecto', 'siplac_proyecto.id', '=', 'siplac_proyectos_profesores.proyecto_id')
            ->select('siplac_proyecto.nombre', 'siplac_proyecto.descripcion', 'siplac_proyecto.codigo_sia')
            ->where('siplac_profesores.id', '=', "$id");
    }
}
