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
use Crypt;

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

        if($opcion=='entrar'){
            $titulo='Entrar a ESPOL';
            }
        else{
            $titulo='Salir de ESPOL';
            }
        return view('reservar.listar_rutas',compact('items','titulo','opcion'));
    }

    public function listar2()
    {   
        $id = $_GET['id'];
        $opcion= $_GET['op'];
        $items = Horarios::where('rutas_id', '=', $id)->get();
        $count=0;
        foreach ($items as $item): 
            $html = 
            "<tr>
                <td><a href='../confirmar/".$opcion."/".$item->id."'></a>".$item->salida."</td>
                <td>".$item->disponibles ."</td>
            </tr>
            ";

        

        echo $html;
        
        endforeach;
        
    }

    public function confirmar($opcion,$id)
    {   
        $horario=Horarios::find($id);
        $ruta=Rutas::find($horario->rutas_id);

        return view('reservar.confirmar_reserva',compact('horario','ruta','opcion'));
    }

    public function exito($opcion,$id)
    {   
        $iduser=Auth::user()->id;
        $user=User::find($iduser);
        if($opcion=='entrar'){
            $user->reserva_entrada=$id;
        }
        else{
            $user->reserva_salida=$id;
        }
        
        $user->save();

        return redirect()->action('HomeController@index');
    }

      public function cancelar($opcion)
    {   
        $iduser=Auth::user()->id;
        $user=User::find($iduser);
        if($opcion=='1'){
            $user->reserva_entrada=null;
        }
        if($opcion=='2'){
            $user->reserva_salida=null;
        }
        $user->save();

        return redirect()->action('RutasController@misreservas');
    }

      public function qrcode()
    {   
        $texto="clave secreta";
        $clave=Crypt::encrypt($texto);
        return view('reservar.qr',compact('clave'));
    }

    public function decryptqr($clave)
    {   
        $text= Crypt::decrypt($clave);
        printf($text);
    }

    
      public function ubicar_bus()
    {   
        
        return view('reservar.ubicar_bus');
    }

      public function ubicar_bus1($opcion)
    {   
        $titulo="";
        if($opcion=='entrar'){
            $titulo="Reservas para entrar a ESPOL";
            $idreserva=Auth::user()->reserva_entrada;          
        }
        if($opcion=='salir'){
            $titulo="Reservas para salir de ESPOL";
            $idreserva=Auth::user()->reserva_salida;  
        }
        $reserva=Horarios::find($idreserva);
        
        return view('reservar.ubicar_bus',compact('reserva','titulo','opcion'));
    }
      
    public function speak()
    {   

        $array = array('beaches' => array(array("BUS","-2.17246", "-79.94069"),  ) ); 

        echo json_encode($array);

    }

     public function misreservas()
    {   
        $idreserva1=Auth::user()->reserva_entrada;
        $idreserva2=Auth::user()->reserva_salida;
        $reserva_entrada=null;
        $reserva_salida=null;
        if($idreserva1){
            $reserva_entrada=Horarios::find($idreserva1);
        }
        if($idreserva2){
            $reserva_salida=Horarios::find($idreserva2);
        }


        return view('reservar.mis_reservas',compact('reserva_entrada','reserva_salida'));
    }

  





  
}