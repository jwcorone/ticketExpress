<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_id', 'avatar','reserva','reserva_entrada','reserva_salida'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reservaSalida() {

        return $this->hasOne('App\Reserva_salida','users_id');
    }

    public function reservaEntrada() {

        return $this->hasOne('App\Reserva_entrada','users_id');
    }

    


}
