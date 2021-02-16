@extends('layouts.app')

@section('content')
<link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css" rel="stylesheet" />
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
type="text/css"
/>

<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
type="text/css"
/>

<div class="container" style="margin-top: 2rem">
    <div class="justify-content-center">
        <div class="row details">
            <div class="row col-md-6 info">
                <img src="{{ asset('img/icons/user.png') }}" alt="">
                <div class="d-flex align-items-center name">
                    <div class="title">
                        Cajamarca
                    </div>
                </div>
                <div class="description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima suscipit consequatur recusandae, quaerat ducimus laboriosam nam aut odio repellendus labore doloremque impedit neque perspiciatis. Necessitatibus rem laborum autem! Odit, animi!
                </div>
            </div>

            <div id="demo" class="col-md-6 carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                    <li data-target="#demo" data-slide-to="3"></li>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/icons/user.png') }}" alt="...">
                        <h3>Perfil</h3>
                        <strong>Pedestry</strong>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/icons/user.png') }}" alt="...">
                        <h3>Distancia</h3>
                        <strong>1237.51000</strong>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/icons/user.png') }}" alt="...">
                        <h3>Duraci&oacute;n</h3>
                        <strong>880.48600</strong>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/icons/user.png') }}" alt="...">
                        <h3>Clima</h3>
                        <strong>24.00</strong>
                    </div>
                </div>

                <!-- Left and right controls -->
                {{-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a> --}}

            </div>
        </div>


        <div class="col-md-12" id="map"></div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
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

        map.on('load', async function() {
            var origin = ["{{$point_a->lon}}", "{{$point_a->lat}}"];
            var destination = ["{{$point_b->lon}}", "{{$point_b->lat}}"];
            await directions.setOrigin(origin);
            await directions.setDestination(destination);
        });

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
