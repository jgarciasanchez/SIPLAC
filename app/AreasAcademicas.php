<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AreasAcademicas extends Model
{
	use Notifiable;
    protected $table = 'siplac_area_academica';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'nombreArea', 'descripcion','estado',
    ];
     //query scope
    public function scopenombre($query,$nombre){
        if($nombre)
            return $query->where('nombreArea','like',"%$nombre%");
    }

    public function scopeid($query,$id){
        if($id)
            return $query->where('id','like',"%$id%");
    }

}