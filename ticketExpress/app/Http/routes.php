<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/








/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {




	Route::get('/', array('as' => '/', 'uses' => function(){
	  return view('auth/login');
	}));

	Route::get('home', array('as' => 'home', 'uses' => function(){
	  return view('home');
	}));
    


    Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

	Route::get('destino', array('as' => 'destino', 'uses' => function(){
		  return view('reservar.entrar_salir');
		}));


	Route::get('listar_rutas/{opcion}', 'RutasController@listar_rutas');

	Route::get('listar/{id}', 'RutasController@listar');

	Route::get('listar', 'RutasController@listar2');

	Route::get('confirmar/{id}', 'RutasController@confirmar');





});







