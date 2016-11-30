<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Rutas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'tipo', 'archivo_KML','origen','destino'
    ];

    public function horarios() {

        return $this->hasMany('App\Horarios');
    }

    
}