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
		@if($reserva_entrada)
		<div>		
			<div>
				<h2>Reserva para entrar a ESPOL</h2>
				<div>Ruta: {{$reserva_entrada->ruta->nombre}}</div>
				<div>Hora de salida:{{$reserva_entrada->salida}}</div>
				<div>Paradero:{{$reserva_entrada->ruta->origen}}</div>
				<div>Destino:{{$reserva_entrada->ruta->destino}}</div>
				<div>Estado del bus: Rumbo al paradero</div>
				<div>Tiempo de llegada al paradero:<div id='output'></div></div>
				<div>Tiempo de llegada a su destino: </div>
			</div>
		</div>
		<div>
			<a href="{{ URL('ubicar_bus','entrar') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Ubicar Bus</a>
		</div>
		<div>
			<a href="{{ url('cancelar','entrar') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Cancelar reserva</a>
		</div>
		@else
		<div>No hay reservas</div>
		@endif
	</div>
	<div class="col-sm-6">
		@if($reserva_salida)
		<div>
			<h2>Reserva para salir de la ESPOL</h2>
			<div>Ruta: {{$reserva_salida->ruta->nombre}}</div>
			<div>Hora de salida:{{$reserva_salida->salida}}</div>
			<div>Paradero:{{$reserva_salida->ruta->origen}}</div>
			<div>Destino:{{$reserva_salida->ruta->destino}}</div>
			<div>Estado del bus: Rumbo al paradero</div>
			<div>Tiempo de llegada al paradero:<div id='output2'></div></div>
			<div>Tiempo de llegada a su destino: </div>

		</div>
		<div>
			<a href="{{ URL('ubicar_bus','salir') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Ubicar Bus</a>
		</div>
		<div>
			<a href="{{ url('cancelar','salir') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Cancelar reserva</a>
		</div>
		@else
		<div>No hay reservas</div>
		@endif
		
	</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzp4ZqXQC0xsYh93Dzyu6OJeLOPU3v2Uo&callback=initMap">
</script>
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>

  <script>

  
    
    function initialize() {

      @if($reserva_entrada)
      	distancia();
      @endif
      @if($reserva_salida)
      	distancia2();
      @endif
       
    }

   google.maps.event.addDomListener(window, 'load', initialize);

    setInterval(function() { 
        distancia();
        distancia2();
    },  2*60000);

    function updateTheMarkers(){
      $.ajax({
      type: "GET",
      url: "http://localhost/ticketExpress/ticketExpress/public/speak",
              success: function (data) {
                  //We remove the old markers
                  var jsonObj = $.parseJSON(data),
                      i;

                  coordenadas =[];//Erasing the coordenadas array

                  //Adding the new ones
                  for(i=0;i < jsonObj.beaches.length; i++) {
                    coordenadas.push(jsonObj.beaches[i]);
                  }                  
                              
              }
         });
    }
    @if($reserva_entrada)
    function distancia(){
		$.ajax({
		      type: "GET",
		      url: "http://localhost/ticketExpress/ticketExpress/public/speak",
		              success: function (data) {
		                  //We remove the old markers
		                  var jsonObj = $.parseJSON(data),
		                      i;

		                  coordenadas =[];//Erasing the coordenadas array

		                  //Adding the new ones
		                  for(i=0;i < jsonObj.beaches.length; i++) {
		                    coordenadas.push(jsonObj.beaches[i]);
		                  }  
		                  var beach = coordenadas[0];
				          var origin1 = new google.maps.LatLng(beach[1], beach[2]);
						  var destinationA = new google.maps.LatLng({{$reserva_entrada->ruta->corigen}});
						  var service = new google.maps.DistanceMatrixService();
						  service.getDistanceMatrix(
						    {
						      origins: [origin1],
						      destinations: [destinationA],
						      travelMode: google.maps.TravelMode.DRIVING,
						     
						    }, callback);                
		                              
		              }	
		         });    		
			

		 }
		 function callback(response, status) {
		  if (status == google.maps.DistanceMatrixStatus.OK) {
		    var origins = response.originAddresses;
		    var destinations = response.destinationAddresses;
		    var outputDiv = document.getElementById('output');
		      outputDiv.innerHTML = '';

		    for (var i = 0; i < origins.length; i++) {
		      var results = response.rows[i].elements;
		      for (var j = 0; j < results.length; j++) {
		        var element = results[j];
		        var distance = element.distance.text;
		        var duration = element.duration.text;
		        var from = origins[i];
		        var to = destinations[j];
		        outputDiv.innerHTML += results[j].distance.text + ' en ' +
		              results[j].duration.text + '<br>';
		      }
		    }
		  }
		}
		@endif
		 @if($reserva_salida)
		  function distancia2(){
		$.ajax({
		      type: "GET",
		      url: "http://localhost/ticketExpress/ticketExpress/public/speak",
		              success: function (data) {
		                  //We remove the old markers
		                  var jsonObj = $.parseJSON(data),
		                      i;

		                  coordenadas =[];//Erasing the coordenadas array

		                  //Adding the new ones
		                  for(i=0;i < jsonObj.beaches.length; i++) {
		                    coordenadas.push(jsonObj.beaches[i]);
		                  }  
		                  var beach = coordenadas[0];
				          var origin1 = new google.maps.LatLng(beach[1], beach[2]);
						  var destinationA = new google.maps.LatLng({{$reserva_salida->ruta->corigen}});
						  var service = new google.maps.DistanceMatrixService();
						  service.getDistanceMatrix(
						    {
						      origins: [origin1],
						      destinations: [destinationA],
						      travelMode: google.maps.TravelMode.DRIVING,
						     
						    }, callback2);                
		                              
		              }	
		         });    		
			

		 }

		function callback2(response, status) {
		  if (status == google.maps.DistanceMatrixStatus.OK) {
		    var origins = response.originAddresses;
		    var destinations = response.destinationAddresses;
		    var outputDiv = document.getElementById('output2');
		      outputDiv.innerHTML = '';

		    for (var i = 0; i < origins.length; i++) {
		      var results = response.rows[i].elements;
		      for (var j = 0; j < results.length; j++) {
		        var element = results[j];
		        var distance = element.distance.text;
		        var duration = element.duration.text;
		        var from = origins[i];
		        var to = destinations[j];
		        outputDiv.innerHTML += results[j].distance.text + ' en ' +
		              results[j].duration.text + '<br>';
		      }
		    }
		  }
		}
		@endif

</script>
@endsection