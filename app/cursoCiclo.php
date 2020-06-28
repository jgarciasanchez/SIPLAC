<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class cursoCiclo extends Model
{
    use Notifiable;
    protected $table = 'siplac_cursos_ciclo';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'curso_id', 'ciclo_id',
    ];
}
