<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "bus";
    protected $fillable = [
        'color', 'modelo', 'placa','capacidad','cuota','codigo'
    ];

   
}