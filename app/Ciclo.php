<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
	use Notifiable;
    protected $table = 'siplac_ciclo';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'ciclo','fecha_inicio','fecha_fin','estado'
    ];

    public function scopeciclo($query,$ciclo){
        if($ciclo)
            return $query->where('ciclo','like',"%$ciclo%");
    }
    public function scopefecha_inicio($query,$fecha_inicio,$fecha_fin){
        if($fecha_inicio and $fecha_fin==null)
            return $query->where('fecha_inicio','=',$fecha_inicio);

    }
    public function scopefecha_fin($query,$fecha_fin,$fecha_inicio){
            if($fecha_fin and $fecha_inicio){
                return $query ->where('fecha_inicio','>=',$fecha_inicio)
                               ->where('fecha_fin','<=',$fecha_fin);
            }
            else{
                if($fecha_fin)
                    return $query ->where('fecha_fin','=',$fecha_fin);
            }
    }

    public function scopeciclosActuales($query,$año){
        if($año)
            return $query->whereYear('fecha_inicio', '=', $año);
    }

}
