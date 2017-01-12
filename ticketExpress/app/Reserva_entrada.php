<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva_entrada extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "reserva_entrada";
    protected $fillable = [
        'users_id', 'horarios_id', 'bus_id','estado'
    ];

    public function usuario()
    {
        return $this->belongsTo('App\User','users_id');
    }

   
}