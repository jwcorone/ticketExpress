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
        'archivo_KML'=>'1Lhb8RAxe0Rl1R8TMdQrYAYWnLYg',
        'origen'=>'Alban Borja',
        'destino'=>'ESPOL',
        'corigen'=>'-2.17028, -79.91808',//alban borja
        'cdestino'=>'-2.14441, -79.96522',//espol
    ));

    Rutas::create(array(
        'nombre'=>'Duran',
        'tipo'=>'entrar',
        'archivo_KML'=>'1ac60zWDrQ7nH7iaVqeD0OOKJ5sg',
        'origen'=>'Duran',
        'destino'=>'ESPOL',
        'corigen'=>'-2.16668, -79.84301',
        'cdestino'=>'-2.14441, -79.96522',//espol  
     ));

    Rutas::create(array(
        'nombre'=>'Portete',
        'tipo'=>'entrar',
        'archivo_KML'=>'18enGvMcyP9_Fzy-oqk8usgMc9rg',
        'origen'=>'Portete',
        'destino'=>'ESPOL',
        'corigen'=>'-2.20718, -79.89615',
        'cdestino'=>'-2.14441, -79.96522',//espol  
     ));

    Rutas::create(array(
        'nombre'=>'Alban Borja',
        'tipo'=>'salir',
        'archivo_KML'=>'1wx0jAaGH2k9_6cxUw1eMIJplNCs',
        'origen'=>'ESPOL',
        'destino'=>'Alban Borja',
        'corigen'=>'-2.14441, -79.96522',//espol
        'cdestino'=>'-2.17028, -79.91808', //alban borja
     )); 

    Rutas::create(array(
        'nombre'=>'Norte',
        'tipo'=>'salir',
        'archivo_KML'=>'1-O08LFqFDVW-8x5CAnLe7vaiZnM',
        'origen'=>'ESPOL',
        'destino'=>'Norte',
        'corigen'=>'-2.14441, -79.96522',//espol  
        'cdestino'=>'-2.13317, -79.88822',
     ));

    Rutas::create(array(
        'nombre'=>'Suroeste',
        'tipo'=>'salir',
        'archivo_KML'=>'1TmDeo_iDjoZ_mEyS27eK2DB3qbg',
        'origen'=>'ESPOL',
        'destino'=>'Soroeste',
        'corigen'=>'-2.14441, -79.96522',//espol  
        'cdestino'=>'-2.21247, -79.8972',
     ));


    }
}