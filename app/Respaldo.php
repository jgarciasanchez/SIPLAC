<?php

namespace App;
use Illuminate\Notifications\Notifiable;

class Respaldo
{
	use Notifiable;

	public $nombre,$tamaño,$fecha,$direccion;

	public $attributes = [
			'nombre','tamaño','fecha','direccion'
	];

	function __construct($pNombre,$pTamaño,$pfecha,$pDireccion){

		$this->nombre= $pNombre;
   		$this->tamaño= $pTamaño;
		$this->fecha= $pfecha;
		$this->direccion = $pDireccion;

	}


}
