@extends('layouts.app')

@section('htmlheader_title')
	Elija su destino
@endsection

@section('contentheader_title')
    Mis reservas
@endsection 


@section('main-content')

<div class="row">
	<div class="col-sm-6">
		@if($reserva_entrada)
		<div>		
			<h2 style="text-align: center; margin-bottom: 4%;">Reserva para entrar a ESPOL</h2>
			<div style="margin-left:10%; margin-right:10%; display: inline-block;">				
				<div class="col-sm-6"><strong>Ruta: </strong></div><div class="col-sm-6">{{$reserva_entrada->ruta->nombre}}</div>
				<div class="col-sm-6"><strong>Hora de salida: </strong></div><div class="col-sm-6">{{$reserva_entrada->salida}}</div>
				<div class="col-sm-6"><strong>Paradero: </strong></div><div class="col-sm-6">{{$reserva_entrada->ruta->origen}}</div>
				<div class="col-sm-6"><strong>Destino:</strong></div><div class="col-sm-6">{{$reserva_entrada->ruta->destino}}</div>
				<div class="col-sm-6"><strong>Estado del bus:</strong></div><div class="col-sm-6"> Rumbo al paradero</div>
				<div class="col-sm-10"><strong>Tiempo de llegada al paradero:</strong></div><div id='output' class="col-sm-10" style="color: red; text-align: center; font-size: 20px;"></div>
				<div class="col-sm-10"><strong>Tiempo de llegada a su destino: </strong></div><div class="col-sm-10"></div>
			</br>
			</div>
		</div>
		<div style="margin: 2%;">
			<a href="{{ URL('ubicar_bus','entrar') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Ubicar Bus</a>
		</div>
		<div style="margin: 2%;">
			<a href="{{ URL('qrcode') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Ver codigo QR</a>
		</div>
		<div style="margin: 2%;">
			<a href="{{ url('cancelar','1') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Cancelar reserva</a>
		</div>
		@else
		<div>
					
			<h2 style="text-align: center; margin-bottom: 4%;">Reserva para entrar a ESPOL</h2>
			<div style="margin-left:10%; margin-right:10%; display: inline-block;">				
				
				<div style="text-align: center; font-size: 20px;"><strong>Usted no tiene reservas </strong></div>
				<div style="text-align: center; margin-top: 4%;"><img src="../public/Recursos/bus.png" class="logo-lg" alt="Image" height="60%" width="60%"/></div>
			</br>
			</div>
			
		</div>
		<div style="margin: 2%;">
			<a href="{{ URL('listar_rutas','entrar') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Reservar Bus</a>
		</div>
		
		@endif
	</div>
	<div class="col-sm-6">

		@if($reserva_salida)
		<h2 style="text-align: center; margin-bottom: 4%;">Reserva para salir de la ESPOL</h2>
		<div style="margin-left:10%; margin-right:10%; display: inline-block;">
			
			<div class="col-sm-6"><strong>Ruta: </strong></div><div class="col-sm-6">{{$reserva_salida->ruta->nombre}}</div>
			<div class="col-sm-6"><strong>Hora de salida: </strong></div><div class="col-sm-6">{{$reserva_salida->salida}}</div>
			<div class="col-sm-6"><strong>Paradero: </strong></div><div class="col-sm-6">{{$reserva_salida->ruta->origen}}</div>
			<div class="col-sm-6"><strong>Destino:</strong></div><div class="col-sm-6">{{$reserva_salida->ruta->destino}}</div>
			<div class="col-sm-6"><strong>Estado del bus: </strong></div><div class="col-sm-6">Rumbo al paradero</div>
			<div class="col-sm-10"><strong>Tiempo de llegada al paradero:</strong></div><div id='output2' class="col-sm-10" style="color: red; text-align: center; font-size: 20px;"></div>
			<div class="col-sm-10"><strong>Tiempo de llegada a su destino: </strong></div><div class="col-sm-6"></div>

		</div>
		<div style="margin: 2%;">
			<a href="{{ URL('ubicar_bus','salir') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Ubicar Bus</a>
		</div>
		<div style="margin: 2%;">
			<a href="{{ URL('qrcode') }}"  style="width:90%" class="btn btn-primary btn-block btn-flat">Ver codigo QR</a>
		</div>
		<div style="margin: 2%;">
			<a href="{{ url('cancelar','2') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Cancelar reserva</a>
		</div>
		@else
		<div>
					
			<h2 style="text-align: center; margin-bottom: 4%;">Reserva para salir de la ESPOL</h2>
			<div style="margin-left:10%; margin-right:10%; display: inline-block;">				
				
				<div style="text-align: center; font-size: 20px;"><strong>Usted no tiene reservas </strong></div>
				<div style="text-align: center; margin-top: 4%;"><img src="../public/Recursos/bus.png" class="logo-lg" alt="Image" height="60%" width="60%"/></div>
			</br>
			</div>
			
		</div>
		<div style="margin: 2%;">
			<a href="{{ URL('listar_rutas','salir') }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Reservar Bus</a>
		</div>
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
    },  2*30000);

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
		 $.getJSON('http://api.thingspeak.com/channels/196276/feed/last.json', function(data) {
                  console.log(data);
                  lt=data.field1;
                  lg=data.field2;
                  lat=-1*(Math.floor(lt/100)+((lt/100-Math.floor(lt/100))*100)/60);
                  lon=-1*(Math.floor(lg/100)+((lg/100-Math.floor(lg/100))*100)/60);
                  console.log(lat,lon);

                 var origin1 = new google.maps.LatLng(lat, lon);
                      var destinationA = new google.maps.LatLng({{$reserva_entrada->ruta->corigen}});
                      var service = new google.maps.DistanceMatrixService();
                      service.getDistanceMatrix(
                      {
                        origins: [origin1],
                        destinations: [destinationA],
                        travelMode: google.maps.TravelMode.DRIVING,
                       
                      }, callback);           
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
		   $.getJSON('http://api.thingspeak.com/channels/196276/feed/last.json', function(data) {
                  console.log(data);
                  lt=data.field1;
                  lg=data.field2;
                  lat=-1*(Math.floor(lt/100)+((lt/100-Math.floor(lt/100))*100)/60);
                  lon=-1*(Math.floor(lg/100)+((lg/100-Math.floor(lg/100))*100)/60);
                  console.log(lat,lon);

                 var origin1 = new google.maps.LatLng(lat, lon);
                      var destinationA = new google.maps.LatLng({{$reserva_salida->ruta->corigen}});
                      var service = new google.maps.DistanceMatrixService();
                      service.getDistanceMatrix(
                      {
                        origins: [origin1],
                        destinations: [destinationA],
                        travelMode: google.maps.TravelMode.DRIVING,
                       
                      }, callback2);           
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