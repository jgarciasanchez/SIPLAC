<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $table = 'siplac_usuarios';
    protected $primaryKey  = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'usuario', 'password','estado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    public function getAuthPassword()
    {
        return $this->password;
    }
    //query scope
    public function scopenombre($query,$nombre){
        if($nombre)
            return $query->where('nombre','like',"%$nombre%");
    }
    public function scopeusuario($query,$usuario){
        if($usuario)
            return $query->where('usuario','like',"%$usuario%");
    }
}
