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
        $id=DB::table('rutas')->max('id');
        $nelementos=4;
        $id=$id-$nelementos+1;


        Horarios::create(array(
    	'salida'=>'2016-11-05 12:36:50',
        'cuota'=>15,
        'disponibles' => 15,
        'rutas_id'=>$id++,

    ));

    Horarios::create(array(
        'salida'=>'2016-11-05 12:36:50',
        'cuota'=>20,
        'disponibles' => 20,
        'rutas_id'=>$id++,
     ));

    Horarios::create(array(
        'salida'=>'2016-11-05 12:36:50',
        'cuota'=>10,
        'disponibles' => 10,
        'rutas_id'=>$id++,
     ));

    Horarios::create(array(
        'salida'=>'2016-11-05 12:36:50',
        'cuota'=>10,
        'disponibles' => 10,
        'rutas_id'=>$id++,
     ));
    }
}