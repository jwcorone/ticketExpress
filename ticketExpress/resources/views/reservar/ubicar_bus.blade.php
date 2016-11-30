@extends('layouts.app')

@section('htmlheader_title')
  Elija su destino
@endsection

@section('contentheader_title')
    Elija su destino
@endsection 


@section('main-content')


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzp4ZqXQC0xsYh93Dzyu6OJeLOPU3v2Uo&callback=initMap">
</script>
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>


<script>
    var arrMarkers = [];

    var beaches = [
      ['Bondi Beach', -2.210370, -79.907234],
      ['Coogee Beach', -2.212225,-79.903389]
      
    ];

    function setMarkers(map, locations) {
      for (var i = 0; i < locations.length; i++) {
        var beach = locations[i];
        var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: "../Recursos/icono-bus.png",
            title: beach[0]
        });

        arrMarkers.push(marker);
      }
    }

    function ubicacion(map) {
      navigator.geolocation.getCurrentPosition( fn_ok ,fn_mal);
            function fn_mal(){}
            function fn_ok(rta){
                var lon=rta.coords.longitude;
                var lat=rta.coords.latitude;
                var gLatLon=new google.maps.LatLng(lat,lon);
                var objConfigMarker={
                    position:gLatLon,
                    map:map,
                    title:"usted esta aqui"
                }

                var gMarker = new google.maps.Marker(objConfigMarker);
      }
    }

    function initialize() {
      var mapOptions = {
        zoom: 16,
        center: new google.maps.LatLng(-2.211342, -79.903819),
      }
      var map = new google.maps.Map(document.getElementById('map-canvas'),
                                    mapOptions);
      setMarkers(map, beaches);
      ubicacion(map);
      distancia();
       
    }

    function removeMarkers(){
     var i;
     for(i=0;i<arrMarkers.length;i++){
       arrMarkers[i].setMap(null);
     }
     arrMarkers = [];

    }

    google.maps.event.addDomListener(window, 'load', initialize);

     setInterval(function() { 
        updateTheMarkers();
     },  2*60000);

    function updateTheMarkers(){
      $.ajax({
      type: "GET",
      url: "http://localhost/ticketExpress/ticketExpress/public/speak",
              success: function (data) {
                  //We remove the old markers
                  removeMarkers();
                  var jsonObj = $.parseJSON(data),
                      i;

                  beaches =[];//Erasing the beaches array

                  //Adding the new ones
                  for(i=0;i < jsonObj.beaches.length; i++) {
                    beaches.push(jsonObj.beaches[i]);
                  }

                  //Adding them to the map
                  var mapOptions = {
                    zoom: 16,
                    center: new google.maps.LatLng(-2.211342, -79.903819),
                  }
                  var map = new google.maps.Map(document.getElementById('map-canvas'),
                                                mapOptions);
                              
                  ubicacion(map);
                  setMarkers(map, beaches);
                  distancia();
              }
         });
    }

    function distancia(){
    var origin1 = new google.maps.LatLng(-2.210370, -79.907234);
  var destinationA = new google.maps.LatLng(-2.212225, -79.903389);
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix(
    {
      origins: [origin1],
      destinations: [destinationA],
      travelMode: google.maps.TravelMode.DRIVING,
     
    }, callback);

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
        outputDiv.innerHTML += origins[i] + ' to ' + destinations[j] +
              ': ' + results[j].distance.text + ' in ' +
              results[j].duration.text + '<br>';
      }
    }
  }
}

</script>

<div>
  <h2>Reserva para entrar a ESPOL</h2>
  <div>Ruta: {{$reserva->ruta->nombre}}</div>
  <div>Hora de salida:{{$reserva->salida}}</div>
  <div>Paradero:{{$reserva->ruta->origen}}</div>
  <div>Destino:{{$reserva->ruta->destino}}</div>
  <div>Estado del bus: Rumbo al paradero</div>
  <div>Tiempo de llegada al paradero:<div id='output'></div></div>

</div>

<div id="map-canvas" style="width:500px; height:500px;">
</div>


@endsection