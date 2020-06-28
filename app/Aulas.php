<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
	use Notifiable;
    protected $table = 'siplac_aulas';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'numero', 'capacidad', 'estado','cam_id',
    ];
     //query scope
    public function scopecodigo($query,$codigo){
        if($codigo)
            return $query->where('codigo','like',"%$codigo%");
    }
    public function scopecapacidad($query,$capacidad){
        if($capacidad)
            return $query->where('capacidad','like',"%$capacidad%");
    }

}
