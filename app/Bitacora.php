<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Bitacora extends Model
{
    use Notifiable;
    protected $table = 'siplac_bitacora';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'fecha','hora','accion','descripcion','usu_nombre','usu_id',
    ];
      //query scope
    public function scopenombre($query,$nombre){
        if($nombre)
            return $query->where('usu_nombre','like',"%$nombre%");
    }
    public function scopeaccion($query,$accion){
        if($accion)
            return $query->where('accion','like',"%$accion%");
    }
    public function scopefecha($query,$fecha){
        if($fecha)
            return $query->where('fecha','like',"%$fecha%");
    }
}
