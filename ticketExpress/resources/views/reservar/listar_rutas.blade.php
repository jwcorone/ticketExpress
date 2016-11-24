@extends('layouts.app')



@section('contentheader_title')
    {{$titulo}} 
@endsection 


@section('main-content')

    <script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">



<script language="javascript">

$(document).ready(function(){

    $('.lgi1').on('click',function(){
     id = $(this).attr('id');
     $.get("../listar",{id:id}, function(data){
                $("#list2").html(data);
            }); 
});
});
</script>

<div class="container row">
	
    <div class="col-sm-4" >
        <h2>Rutas disponibles</h2>
        <div class="list-group">
            @foreach ($items as $key => $item)
                <a id="{{ $item->id }}" href="#" class="list-group-item lgi1">{{ $item->nombre }}</a>
            @endforeach
            
        </div>
    </div>

    <div class="col-sm-4" >
        <h2>Horarios disponibles</h2>
        <table class="table table-striped table-bordered table-hover" >
        <thead>
        <tr>
            <th>Salida del bus</th>
            <th>Asientos disponibles</th>
            
        </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
        <tr>
            <td><a href="../confirmar/11"><a>2016-11-05 12:36:50</td>
            <td>20</td>
        </tr>
        </tbody>
        </table>

    </div>

    
</div>
@endsection