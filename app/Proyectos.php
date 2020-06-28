<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Proyectos extends Model
{
	use Notifiable;
    protected $table = 'siplac_proyecto';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'nombre', 'codigo_sia', 'descripcion', 'fecha', 'fecha_inicio', 'fecha_final',
    ];

    public function scopeNombre($query, $nombre){
        if($nombre)
            return $query->where('siplac_proyecto.nombre', 'like', "%$nombre%");
    }

    public function scopeid($query, $id){
        if($id)
            return $query->where('siplac_proyecto.id', '=', "$id");
    }
}