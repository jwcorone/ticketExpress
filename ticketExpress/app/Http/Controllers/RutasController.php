<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Rutas;
use App\Horarios;
use DB;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class RutasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function listar_rutas($opcion)
    {   
        $items = DB::table('rutas')->where('tipo', '=', $opcion)->get();

        if($opcion='entrar')
            $titulo='Entrar a ESPOL';
        else
            $titulo='Salir de ESPOL';

        return view('reservar.listar_rutas',compact('items','titulo'));
    }

    public function listar2()
    {   
        $id = $_GET['id'];
        $items = Horarios::where('rutas_id', '=', $id)->get();
         foreach ($items as $item): 
           $html = "<a id=' ".$item->id." ' href='#' class='list-group-item'><div class='col-sm-6'>".$item->salida."</div><div class='col-sm-6'>".$item->disponibles ."</div></a>";
           echo $html;
        
        endforeach;
        
    }

    public function confirmar($id)
    {   
        $horario=Horarios::find($id);
        $ruta=Rutas::find($horario->rutas_id);

        return view('reservar.confirmar_reserva',compact('horario','ruta'));
    }




  
}