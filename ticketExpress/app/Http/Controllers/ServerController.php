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

public function decryptqr2($clave)
    {   
        try{
            $text= Crypt::decrypt($clave);
            if($text==="clave secreta"){
                printf("valido");
                }
            else
                printf("invalido");

    }catch(\RuntimeException $e){
        printf("invalido");
    }
    }
}