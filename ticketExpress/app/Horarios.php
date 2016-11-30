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
        'salida', 'cuota', 'disponible','rutas_id','estado'
    ];

    public function ruta()
    {
        return $this->belongsTo('App\Rutas','rutas_id');
    }
}