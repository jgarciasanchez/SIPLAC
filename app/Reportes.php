<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Reportes extends Model
{
	use Notifiable;
    protected $table = 'siplac_curso';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'nombre', 'codigo', 'nrc', 'creditos', 'horas_contacto',
    ];
     //query scope
    public function scopenombre($query,$nombre){
        if($nombre)
            return $query->where('nombre','like',"%$nombre%");
    }
    
    public function scopeid($query,$id){
        if($id)
            return $query->where('id','like',"%$id%");
    }


    // public function scopeprofesor($query, $nombre){
    //     if($nombre){
    //         return $query->join
    //     }
    // }
  
}
