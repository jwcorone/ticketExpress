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
use App\User;
use DB;
use Auth;

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
        $count=0;
        foreach ($items as $item): 
            $html = 
            "<tr>
                <td><a href='../confirmar/".$item->id."'></a>".$item->salida."</td>
                <td>".$item->disponibles ."</td>
            </tr>
            ";

        

        echo $html;
        
        endforeach;
        
    }

    public function confirmar($id)
    {   
        $horario=Horarios::find($id);
        $ruta=Rutas::find($horario->rutas_id);

        return view('reservar.confirmar_reserva',compact('horario','ruta'));
    }

    public function exito($id)
    {   
        $iduser=Auth::user()->id;
        $user=User::find($iduser);
        $user->reserva=$id;
        $user->save();

        return redirect()->action('HomeController@index');
    }

      public function cancelar()
    {   
        $iduser=Auth::user()->id;
        $user=User::find($iduser);
        $user->reserva=null;
        $user->save();

        return redirect()->action('HomeController@index');
    }

      public function qrcode()
    {   
        
        return view('reservar.qr');
    }




  
}