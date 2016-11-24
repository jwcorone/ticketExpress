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
    ));

    Rutas::create(array(
        'nombre'=>'Duran',
        'tipo'=>'entrar',
        'archivo_KML'=>'1ac60zWDrQ7nH7iaVqeD0OOKJ5sg',
     ));

    Rutas::create(array(
        'nombre'=>'Portete',
        'tipo'=>'entrar',
        'archivo_KML'=>'18enGvMcyP9_Fzy-oqk8usgMc9rg',
     ));

    Rutas::create(array(
        'nombre'=>'Alban Borja',
        'tipo'=>'salir',
        'archivo_KML'=>'1wx0jAaGH2k9_6cxUw1eMIJplNCs',
     )); 

    Rutas::create(array(
        'nombre'=>'Norte',
        'tipo'=>'salir',
        'archivo_KML'=>'1-O08LFqFDVW-8x5CAnLe7vaiZnM',
     ));

    Rutas::create(array(
        'nombre'=>'Suroeste',
        'tipo'=>'salir',
        'archivo_KML'=>'1TmDeo_iDjoZ_mEyS27eK2DB3qbg',
     ));


    }
}