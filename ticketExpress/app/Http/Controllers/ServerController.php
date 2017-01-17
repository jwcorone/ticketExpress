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
class ServerController extends Controller
{

// public function decryptqr2($clave)
//     {   
//         try{
//             $text= Crypt::decrypt($clave);
//             if($text==="clave secreta"){
//                 printf("valido");
//                 }
//             else
//                 printf("invalido");

//           }catch(\RuntimeException $e){
//                 printf("invalido");
//             }
//     }

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

            if($cadena[2]=='1'){
                $codigo=$user->reservaEntrada->horarios_id;
                if($codigo==$cadena[1])
                    printf("valido");
                else
                    printf("invalido");
            }
            if($cadena[2]=='2'){
                $codigo=$user->reservaSalida->horarios_id;
                if($codigo==$cadena[1])
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



}
