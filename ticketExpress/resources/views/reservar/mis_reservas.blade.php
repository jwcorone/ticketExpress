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
			<h2>Reserva para entrar a ESPOL</h2>
			<div>Ruta: {{$reserva->ruta->nombre}}</div>
			<div>Hora de salida:{{$reserva->salida}}</div>
			<div>Paradero:{{$reserva->ruta->origen}}</div>
			<div>Destino:{{$reserva->ruta->destino}}</div>
			<div>Estado del bus: Rumbo al paradero</div>
			<div>Tiempo de llegada al paradero:<div id='output'></div></div>
			<div>Tiempo de llegada a su destino: </div>

		</div>
		<div>
			<a href="{{ URL('ubicar_bus','entrar') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Ubicar Bus</a>
		</div>
		<div>
			<a href="{{ URL('listar_rutas','entrar') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Cancelar reserva</a>
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
      
      distancia();
       
    }

   google.maps.event.addDomListener(window, 'load', initialize);

    setInterval(function() { 
        distancia();
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
						  var destinationA = new google.maps.LatLng({{$reserva->ruta->corigen}});
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

</script>
@endsection