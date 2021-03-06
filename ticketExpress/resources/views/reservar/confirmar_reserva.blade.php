@extends('layouts.app')



@section('contentheader_title')
   Confirme su reserva
@endsection 


@section('main-content')

<div>
	<h2>Datos de la reserva</h2>

	<strong>Ruta:  </strong>{{$ruta->nombre}}<br/>
	<strong>Horario:  </strong>{{$horario->salida}}<br/>
	<h3>Vista previa del recorrido</h3>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzp4ZqXQC0xsYh93Dzyu6OJeLOPU3v2Uo&callback=initMap">
</script>
<div class="container">

    <div >
        <div >

            <div >
                <div id="mapa"  class="embed-container" style="width:90%;">       cargando mapa
                </div>
            </div>
        </div>
         <div>
            <a href="{{ url('/exito',[$opcion,$horario->id]) }}" style="width:90%" class="btn btn-primary btn-block btn-flat">Reservar ahora</a>
        </div><!-- /.col -->
    </div>
</div>
    <div>

    </div>
        <style>
/* CSS general */
.embed-container {
    position: relative;
    padding-bottom: 120%;
    height: 0;
    overflow: hidden;
}
.embed-container iframe {
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* CSS pantallas de 320px o superior */
@media (min-width: 520px) {

  .embed-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}
.embed-container iframe {
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
}

}

/* CSS pantalla 768px o superior */
@media (min-width: 768px) {

  .embed-container {
    position: relative;
    padding-bottom: 40.25%;
    height: 0;
    overflow: hidden;
}
.embed-container iframe {
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
}

}



           
        </style>
        <script >
            var divmapa= document.getElementById('mapa');
            navigator.geolocation.getCurrentPosition( fn_ok ,fn_mal);
            function fn_mal(){}
            function fn_ok(rta){
                var lon=rta.coords.longitude;
                var lat=rta.coords.latitude;

                var gLatLon=new google.maps.LatLng(lat,lon);
                var objConfig={
                    zoom:17,
                    center:gLatLon
                }
                var gMapa = new google.maps.Map(divmapa,objConfig);

                var objConfigMarker={
                    position:gLatLon,
                    map:gMapa,
                    title:"usted esta aqui"
                }

                var gMarker = new google.maps.Marker(objConfigMarker);

                 myMapsId = '{{$ruta->archivo_KML}}';
                  new google.maps
                    .KmlLayer({
                      map: gMapa,
                      url: 'https://www.google.com/maps/d/kml?mid=' + myMapsId
                    });

                
            }

            

         

        </script>
</div>

@endsection