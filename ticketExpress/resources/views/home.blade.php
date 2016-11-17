@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzp4ZqXQC0xsYh93Dzyu6OJeLOPU3v2Uo&callback=initMap">
</script>
    <div >
        <div id="mapa" class="google-maps" >
        	cargando mapa
        </div>
         <div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte_lang::message.buttonsign') }}</button>
        </div><!-- /.col -->
    </div>
    <div>

    </div>
        <style>
            .google-maps {
            position: relative;
            padding-bottom: 85%; // This is the aspect ratio
            height: 0;
            overflow: hidden;
            }
            .google-maps iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
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

                
            }

        </script>
@endsection
