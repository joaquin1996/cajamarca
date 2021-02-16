@extends('layouts.app')

@section('content')
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css" rel="stylesheet" />
<style>
	body { margin: 0; padding: 0; }
	#map { position: absolute; top: 0; bottom: 0; width: 100%; height: 500px;}
    #buttons {
        width: 90%;
        margin: 0 auto;
        display: inline-flex;
        justify-content: center;
    }
    .button {
        display: block;
        position: relative;
        cursor: pointer;
        padding: 8px;
        border-radius: 3px;
        margin-top: 10px;
        margin-left: 1px;
        margin-right: 1px;
        font-size: 12px;
        text-align: center;
        color: #fff;
        background: #ee8a65;
        font-family: sans-serif;
        font-weight: bold;
    }
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
                <div>
                    <i class="fa fa-man"></i>
                </div>
                <div>
                    <p>Titulo</p>
                    <p>Categoria</p>
                    <p>Descripcion</p>
                </div>
            </div>
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
            accessToken: mapboxgl.accessToken,
            unit: "metric",
            language: "es"
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

        directions.on('route', async function(e) {
            console.log(e);
            origin = directions.getOrigin().geometry.coordinates;
            destination = directions.getDestination().geometry.coordinates;
            await console.log('Origin');
            await console.log(origin);
            await getClimate(origin);
            await console.log('Origin');
            await getElevation(origin);
            await console.log('Destination');
            await console.log(destination);
            await getClimate(destination);
            await console.log('Destination');
            await getElevation(destination);
        });

        async function getClimate(latLon) {
            await jQuery.ajax( {
                type: 'GET',
                url: "https://api.openweathermap.org/data/2.5/weather?lat="+latLon[1]+"&lon="+latLon[0]+"&lang=es&units=metric&appid=d501d7588e367900e084418b8b24deab",
                success: function( data ) {
                    console.log(data);
                }
            } );
        }



        async function getElevation(latLon) {
            // make API request
            var query = 'https://api.mapbox.com/v4/mapbox.mapbox-terrain-v2/tilequery/' + latLon[0] + ',' + latLon[1] + '.json?layers=contour&limit=50&access_token=' + mapboxgl.accessToken;
            await $.ajax({
                method: 'GET',
                url: query,
            }).done(function(data) {
                var allFeatures = data.features;
                // Create an empty array to add elevation data to
                var elevations = [];
                // For each returned feature, add elevation data to the elevations array
                for (i = 0; i < allFeatures.length; i++) {
                    elevations.push(allFeatures[i].properties.ele);
                }
                // In the elevations array, find the largest value
                var highestElevation = Math.max(...elevations);
                // Display the largest elevation value
                console.log(highestElevation + ' meters');
            });
        }

    });
</script>
@endsection
