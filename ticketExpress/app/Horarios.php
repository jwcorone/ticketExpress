<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salida', 'cuota', 'disponible','rutas_id'
    ];

    
}