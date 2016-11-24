<?php

use Illuminate\Database\Seeder;
use App\Rutas;


class RutasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void   
     */
     public function run()
    {
        DB::table('rutas')->delete();

        Rutas::create(array(
    	'nombre'=>'Alban Borja',
        'tipo'=>'entrar',
    ));

    Rutas::create(array(
        'nombre'=>'Alban Borja',
        'tipo'=>'salir',
     ));

    Rutas::create(array(
        'nombre'=>'Duran',
        'tipo'=>'entrar',
     ));

    Rutas::create(array(
        'nombre'=>'Duran',
        'tipo'=>'salir',
     ));


    }
}