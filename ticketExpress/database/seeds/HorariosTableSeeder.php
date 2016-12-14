<?php

use Illuminate\Database\Seeder;
use App\Horarios;


class HorariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void   
     */
     public function run()
    {
        DB::table('horarios')->delete();
        


    Horarios::create(array(
    	'salida'=>'2016-11-30 07:00:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>1,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 07:10:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>1,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 07:15:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>1,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 07:00:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>2,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 07:15:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>2,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 07:00:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>3,

    ));

     Horarios::create(array(
        'salida'=>'2016-11-30 07:15:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>3,

    ));

     //SALIDAS

      Horarios::create(array(
        'salida'=>'2016-11-30 18:00:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>4,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 18:30:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>4,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 19:00:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>4,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 18:00:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>5,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 18:15:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>5,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-30 18:00:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>6,

    ));

     Horarios::create(array(
        'salida'=>'2016-11-30 18:15:00',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>6,

    ));

    
    }
}