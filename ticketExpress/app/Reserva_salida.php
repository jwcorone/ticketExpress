<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva_salida extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "reserva_salida";
    protected $fillable = [
        'users_id', 'horarios_id', 'bus_id','estado'
    ];

   public function usuario()
    {
        return $this->belongsTo('App\User','users_id');
    }
}