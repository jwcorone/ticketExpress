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
use App\Reserva_entrada;
use App\Reserva_salida;
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

        if($opcion==='entrar'){
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
        if($opcion==='entrar'){
            $ren=new Reserva_entrada();
            $ren->users_id=$iduser;
            $ren->bus_id='1';
            $ren->horarios_id=$id;
            $ren->estado='reservado';
            $ren->save();

            $h=Horarios::find($id);
            $h->disponibles=$h->disponibles-1;
            $h->save();

        }
        else{
            $ren=new Reserva_salida();
            $ren->users_id=$iduser;
            $ren->bus_id='1';
            $ren->horarios_id=$id;
            $ren->estado='reservado';
            $ren->save();

             $h=Horarios::find($id);
            $h->disponibles=$h->disponibles-1;
            $h->save();
        }
        
        $user->save();

        return redirect()->action('HomeController@index');
    }

      public function cancelar($opcion)
    {   
        $iduser=Auth::user()->id;
        $user=User::find($iduser);
        if($opcion==='1'){
            $h=Horarios::find($user->reservaEntrada->horarios_id);
            $h->disponibles=$h->disponibles+1;
            $h->save();
            $user->reservaEntrada->delete();
        }
        if($opcion==='2'){

            $h=Horarios::find($user->reservaSalida->horarios_id);
            $h->disponibles=$h->disponibles+1;
            $h->save();
            $user->reservaSalida->delete();
        }
        $user->save();

        return redirect()->action('RutasController@misreservas');
    }

      public function qrcode($tipo)
    {   
        $iduser=Auth::user()->id;
        if($tipo==1){//reserva entrada
            $code=Auth::user()->reservaEntrada->horarios_id;
        }
        else{
            $code=Auth::user()->reservaSalida->horarios_id;
        }
        $clave=Crypt::encrypt($iduser.','.$code.','.$tipo);
        return view('reservar.qr',compact('clave'));
    }

    public function decryptqr($clave)
    {   
        $text= Crypt::decrypt($clave);
        printf($text);
    }

    public function decryptqr2($clave)
    {   
        

        try{
            $text= Crypt::decrypt($clave);
            $cadena=explode(',',$text);      //0.-id  1.-code 2.-tipo
            $user=User::find($cadena[0]);

            if($cadena[2]==='1'){
                $codigo=$user->reservaEntrada->horarios_id;
                if($codigo===$cadena[1])
                    printf("valido");
                else
                    printf("invalido");
            }
            if($cadena[2]==='2'){
                $codigo=$user->reservaSalida->horarios_id;
                if($codigo===$cadena[1])
                    printf("valido");
                else
                    printf("invalido");
            }

            

        }catch(\RuntimeException $e){
            printf("invalido");
        }

    }
     public function decryptqrvacio()
    { 
        printf("invalido");
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
            $idreserva=Auth::user()->reservaEntrada->horarios_id;          
        }
        if($opcion=='salir'){
            $titulo="Reservas para salir de ESPOL";
            $idreserva=Auth::user()->reservaSalida->horarios_id;  
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
        $reserva1=Auth::user()->reservaEntrada;
        $reserva2=Auth::user()->reservaSalida;
        $reserva_entrada=null;
        $reserva_salida=null;
        if($reserva1){
            $reserva_entrada=Horarios::find($reserva1->horarios_id);
        }
        if($reserva2){
            $reserva_salida=Horarios::find($reserva2->horarios_id);
        }


        return view('reservar.mis_reservas',compact('reserva_entrada','reserva_salida'));
    }

  





  
}