@extends('layouts.app')

@section('htmlheader_title')
	Elija su destino
@endsection

@section('contentheader_title')
    Elija su destino
@endsection 


@section('main-content')

<div>
	<div>
		<div>
			<img src="../public/Recursos/bus.png" class="logo-lg" alt="Image" height="60%" width="60%"/>
		</div>
		<div>
			<a href="{{ URL('listar_rutas','entrar') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Entrar a ESPOL</a>
		</div>
	
	</div>
	<div>
		<div>
			<img src="../public/Recursos/bus.png" class="logo-lg" alt="Image" height="60%" width="60%"/>
		</div>
		<div>
			<a href="{{ URL('listar_rutas/salir') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Salir de ESPOL</a>
		</div>
		
	</div>
</div>
@endsection