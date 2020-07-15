<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
	protected $table = 'siplac_actividad';
	protected $primaryKey  = 'id';

	protected $fillable = [
		'id', 'startTime', 'endTime', 'daysOfWeek', 'encargado', 'nombre',
	];

	public function scopefiltro($acti, $encargado)
	{
		if ($acti != "Ninguno") {
			return $query->select("siplac_actividad.id as id", "siplac_actividad.startTime", "siplac_actividad.endTime", "siplac_actividad.encargado", "siplac_actividad.nombre")
				->where('siplac_actividad.nombre', '=', "$acti")->get();
		} else {
			if ($encargado != "Ninguno") {
				return $query->select("siplac_actividad.id as id", "siplac_actividad.startTime", "siplac_actividad.endTime", "siplac_actividad.encargado", "siplac_actividad.nombre")
					->where('siplac_actividad.encargado', '=', "$encargado")->get();
			} 
		}
	}
}
