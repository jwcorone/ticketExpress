@extends('layouts.app')



@section('contentheader_title')
    Su codigo QR
@endsection 


@section('main-content')

<div>
{!! 
QrCode::size(250)->generate($clave); !!}
</div>
@endsection