@extends('layouts.app')

@section('content')
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css" rel="stylesheet" />
<style>
	body { margin: 0; padding: 0; }
	#map { position: absolute; top: 0; bottom: 0; width: 100%; height: 500px;}
</style>
</head>
<body>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
type="text/css"
/>
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css"/>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
type="text/css"
/>
<div class="container" style="margin-top: 2rem">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // TO MAKE THE MAP APPEAR YOU MUST
    // ADD YOUR ACCESS TOKEN FROM
    // https://account.mapbox.com
    $(document).ready(function(){
        mapboxgl.accessToken = 'pk.eyJ1IjoicmFmYWVsZHRtIiwiYSI6ImNrbDJvN2txYjBiZWwybnBrd3NuYmhyeWsifQ.sDFeVOhqOGPqvPsE1u6-yA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-71.91613, 9.00238],
            zoom: 14
        });

        var origin = [];
        var destinaion = [];

        var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken
        });
        map.addControl(
            directions,
            'top-left'
        );

        var geolocate = new mapboxgl.GeolocateControl({
            accessToken: mapboxgl.accessToken,
        });

        map.addControl(geolocate);

        geolocate.on('geolocate', function(e) {
            var lon = e.coords.longitude;
            var lat = e.coords.latitude
            origin = [lon, lat];
            directions.setOrigin(origin);
        });

        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            marker: false
        });

        map.addControl(geocoder);
        geocoder.on('result', function(e) {
            destinaion = e.result.geometry.coordinates;
            directions.setDestination(destinaion);
        });


    });
</script>
@endsection
