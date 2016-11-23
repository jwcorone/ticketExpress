@extends('layouts.app')



@section('contentheader_title')
    {{$titulo}} 
@endsection 


@section('main-content')

<div>
	
    <table class="table table-bordered" style="width : 80%; margin : 0 auto;">
        <tr>
            <th>Rutas disponibles</th>
                     
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ $item->nombre }}</td>
           
    </tr>
    @endforeach
    </table>
</div>
@endsection