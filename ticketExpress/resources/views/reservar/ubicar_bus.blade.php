@extends('layouts.app')

@section('htmlheader_title')
  {{$titulo}}
@endsection

@section('contentheader_title')
    <h2>{{$titulo}}</h2>
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

     function setMarkers2(map) {

      $.getJSON('http://api.thingspeak.com/channels/357/feed/last.json', function(data) {
          console.log(data);
          lt=data.field1;
          lg=data.field2;
          lat=-1*(Math.floor(lt/100)+((lt/100-Math.floor(lt/100))*100)/60);
          lon=-1*(Math.floor(lg/100)+((lg/100-Math.floor(lg/100))*100)/60);
console.log(lat,lon);
            var myLatLng = new google.maps.LatLng(lat, lon);
            var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: "../Recursos/icono-bus.png",
            title: "bus"
        });

        arrMarkers.push(marker);
      });
    
       
      
    }

    function ubicacion() {
      navigator.geolocation.getCurrentPosition( fn_ok ,fn_mal);
            function fn_mal(){}
            function fn_ok(rta){
                var lon=rta.coords.longitude;
                var lat=rta.coords.latitude;
                var gLatLon=new google.maps.LatLng(lat,lon);
                
                var mapOptions = {
                  zoom: 16,
                  center: gLatLon,
                }
                var map = new google.maps.Map(document.getElementById('map-canvas'),
                                              mapOptions);

                myMapsId = '{{$reserva->ruta->archivo_KML}}';
                new google.maps
                  .KmlLayer({
                    map: map,
                    url: 'https://www.google.com/maps/d/kml?mid=' + myMapsId,
                    preserveViewport:true

                  });

                //updateTheMarkers(map,gLatLon);
                setMarkers2(map);
                var objConfigMarker={
                    position:gLatLon,
                    map:map,
                    title:"usted esta aqui"
                }

                var gMarker = new google.maps.Marker(objConfigMarker);

                setInterval(function() { 
                    //updateTheMarkers(map,gLatLon);
                    setMarkers2(map);
                    distancia2();
                 },  2*60000);

      }
    }

    function initialize() {
      ubicacion(); 
      distancia2();      
    }

    function removeMarkers(){
     var i;
     for(i=0;i<arrMarkers.length;i++){
       arrMarkers[i].setMap(null);
     }
     arrMarkers = [];

    }

    google.maps.event.addDomListener(window, 'load', initialize);

     

    function updateTheMarkers(map,gLatLon){
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
                  setMarkers(map, beaches);

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

        function distancia2(){
           $.getJSON('http://api.thingspeak.com/channels/357/fields/3/last.json', function(data) {
                  console.log(data);
                  lt=208.753601;
                  lg=7956.908203;
                  lat=-1*(Math.floor(lt/100)+((lt/100-Math.floor(lt/100))*100)/60);
                  lon=-1*(Math.floor(lg/100)+((lg/100-Math.floor(lg/100))*100)/60);
                  console.log(lat,lon);

                 var origin1 = new google.maps.LatLng(lat, lon);
                      var destinationA = new google.maps.LatLng({{$reserva->ruta->corigen}});
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

</script>

<div class="row">
  <div class="col-sm-6">
    <div style="margin-left:20%; margin-top:5%;">
      <div><strong>Ruta: </strong></div><div> {{$reserva->ruta->nombre}}</div></br>
      <div><strong>Hora de salida: </strong></div><div>{{$reserva->salida}}</div></br>
      <div><strong>Paradero: </strong></div><div>{{$reserva->ruta->origen}}</div></br>
      <div><strong>Destino: </strong></div><div>{{$reserva->ruta->destino}}</div></br>
      <div><strong>Estado del bus: </strong></div><div>Rumbo al paradero</div></br>
      <div><strong>Tiempo de llegada al paradero:</strong></div><div id='output' style="color: red;"></div></br>
    </div>
  </div>

  <div class="col-sm-6">
    <div id="map-canvas" style="width:500px; height:500px;">
    </div>  
  </div>
</div>

@endsection