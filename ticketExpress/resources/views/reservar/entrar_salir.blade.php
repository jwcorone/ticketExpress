@extends('layouts.app')

@section('htmlheader_title')
	Elija su destino
@endsection

@section('contentheader_title')
    Elija su destino
@endsection 


@section('main-content')

<div class="row">
	<div class="col-sm-6">
		<div>
			<img src="../public/Recursos/bus.png" class="logo-lg" alt="Image" height="60%" width="60%" style="margin-left: 15%; margin-right: 15%; margin-bottom: 3%;"/>
		</div>
		<div>
			<a href="{{ URL('listar_rutas','entrar') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Entrar a ESPOL</a>
		</div>
	
	</div>
	<div class="col-sm-6">
		<div>
			<img src="../public/Recursos/bus.png" class="logo-lg" alt="Image" height="60%" width="60%" style="margin-left: 15%; margin-right: 15%; margin-bottom: 3%;"/>
		</div>
		<div>
			<a href="{{ URL('listar_rutas/salir') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Salir de ESPOL</a>
		</div>
		
	</div>
</div>
@endsection