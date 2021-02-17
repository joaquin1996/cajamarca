@extends('layouts.app')

@section('content')
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/iconic/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
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
                <div class="card-head">
                    <h4>Registrar Actividad</h4>
                </div>
                <div class="card-body">
                    <!-- rduarte, formulario para registrar la actividad -->
                    <form method="POST" class="" action="{{ route('save-activity') }}" id="create_activity" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nombre" aria-label="Username" id="activity-name" name="name" aria-describedby="basic-addon1" value="" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Descripción" aria-label="Username" id="activity-description" name="description" aria-describedby="basic-addon1" value="" required>
                        </div>

                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="activity-icon" name="file_0" required>
                            <label class="input-group-text" for="inputGroupFile02" value="">Icon .png</label>
                        </div>

                        <div class="input-group mb-3">
                            <label for="inputPassword2" class="form-control">Dificultad</label>
                            <input type="number" class="form-control" id="activity-dificulty" name="dificulty" min="1" max="5" placeholder="Dificultad" value="1" required>
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select form-control" aria-label="Categories Select" id="categories-select" name="category" required>
                                <option value="" selected>Elija una categoria</option>
                            </select>
                        </div>
                        <!-- Campos ocultos -->
                        <input type="hidden" name="distance" id="distance" value=""/>
                        <input type="hidden" name="duration" id="duration" value=""/>
                        <input type="hidden" name="perfil" id="perfil" value=""/>
                        <!-- Datos del origin -->
                        <input type="hidden" name="data_origin_name" id="data_origin_name" value=""/>
                        <input type="hidden" name="data_origin_description" id="data_origin_description" value=""/>
                        <input type="hidden" name="data_origin_lon"  id="data_origin_lon" value=""/>
                        <input type="hidden" name="data_origin_lat" id="data_origin_lat" value=""/>
                        <div class="input-group mb-3">
                            <label for="data_origin_elevation" class="form-control">Elevación</label>
                            <input type="number" name="data_origin_elevation" id="data_origin_elevation" value="" min="0" step=".001" required/>
                        </div>
                        <div class="input-group mb-3">
                            <label for="data_origin_elevation" class="form-control">Temperatura</label>
                            <input type="number" name="data_origin_temp" id="data_origin_temp" value="" step=".001" required/>
                        </div>
                        <input type="hidden" name="data_origin_temp_min" id="data_origin_temp_min" value=""/>
                        <input type="hidden" name="data_origin_temp_max" id="data_origin_temp_max" value=""/>

                        <!-- Datos del destination -->
                        <input type="hidden" name="data_destination_name" id="data_destination_name" value=""/>
                        <input type="hidden" name="data_destination_description" id="data_destination_description" value=""/>
                        <input type="hidden" name="data_destination_lon" id="data_destination_lon" value=""/>
                        <input type="hidden" name="data_destination_lat" id="data_destination_lat" value=""/>
                        <input type="hidden" name="data_destination_elevation" id="data_destination_elevation" value="" min="0"/>
                        <input type="hidden" name="data_destination_temp" id="data_destination_temp" value=""/>
                        <input type="hidden" name="data_destination_temp_min" id="data_destination_temp_min" value=""/>
                        <input type="hidden" name="data_destination_temp_max" id="data_destination_temp_max" value=""/>
                        <div class="input-group mb-3">
                            <span>Para habilitar el boton de guardar tienes que completar el formulario y la ruta en el mapa</span>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-primary disabled" id="submit">
                                Guardar Actividad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<script>
    //espera a que l documento este listo
    $(document).ready( async function(){
        //asginacion del api key a mapbox
        mapboxgl.accessToken = 'pk.eyJ1IjoicmFmYWVsZHRtIiwiYSI6ImNrbDJvN2txYjBiZWwybnBrd3NuYmhyeWsifQ.sDFeVOhqOGPqvPsE1u6-yA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-71.91613, 9.00238],
            zoom: 14
        });
        //decalracion de variables
        var origin = [];
        var destinaion = [];
        var data_origin = [];
        var data_destination = [];
        var elevation = 0;
        var climate = [];
        var humanInfo = [];
        var distance = 0;
        var duration = 0;
        var perfil = 0;

        //adicion de la caracteristica de direcciones al mapa
        var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken,
            unit: "metric",
            language: "es"
        });
        map.addControl(
            directions,
            'top-left'
        );
        //adición de la caracteristica de geolocalizacion
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

        //generacion de rutas
        await directions.on('route', async function(e) {
            if(e != '' && e != null && e != undefined) {
                distance = e.route[0].distance;
                duration = e.route[0].duration;
                perfil = e.route[0].weight_name;
                origin = directions.getOrigin().geometry.coordinates;
                destination = directions.getDestination().geometry.coordinates;
                data_origin = {
                    "lon": origin[0],
                    "lat": origin[1],
                }
                //seteo de campos dinamicamente
                document.getElementById("distance").value = distance;
                document.getElementById("duration").value = duration;
                document.getElementById("perfil").value = perfil;
                document.getElementById("data_origin_lon").value = origin[0];
                document.getElementById("data_origin_lat").value = origin[1];

                elevation = await getElevation(origin);
                for (const [key, value] of Object.entries(elevation)) {
                    data_origin[key]=value;
                    document.getElementById("data_origin_"+key).value = value;
                }
                climate = await getClimate(origin);
                for (const [key, value] of Object.entries(climate)) {
                    data_origin[key]=value;
                    document.getElementById("data_origin_"+key).value = value;
                }
                humanInfo = await getHumanInfo(origin);
                for (const [key, value] of Object.entries(humanInfo)) {
                    data_origin[key]=value;
                    document.getElementById("data_origin_"+key).value = value;
                }
                data_destination = {
                    "lon": destination[0],
                    "lat": destination[1],
                }
                //seteo de campos dinamicamente
                document.getElementById("data_destination_lon").value = destination[0];
                document.getElementById("data_destination_lat").value = destination[1];

                elevation = await getElevation(destination);
                for (const [key, value] of Object.entries(elevation)) {
                    data_destination[key]=value;
                    document.getElementById("data_destination_"+key).value = value;
                }
                climate = await getClimate(destination);
                for (const [key, value] of Object.entries(climate)) {
                    data_destination[key]=value;
                    document.getElementById("data_destination_"+key).value = value;
                }
                humanInfo = await getHumanInfo(origin);
                for (const [key, value] of Object.entries(humanInfo)) {
                    data_destination[key]=value;
                    document.getElementById("data_destination_"+key).value = value;
                }
                $('#submit').removeClass('disabled');
            }
        });

        $('#create_activity').submit(function(event){
            if($('#data_destination_temp').val() == '') {
                document.getElementById("data_origin_temp_min").value = $("#data_origin_temp").val();
                document.getElementById("data_origin_temp_max").value = $("#data_origin_temp").val();
                document.getElementById("data_destination_temp").value = $("#data_origin_temp").val();
                document.getElementById("data_destination_temp_min").value = $("#data_origin_temp").val();
                document.getElementById("data_destination_temp_max").value = $("#data_origin_temp").val();
            }
        })

        async function getClimate(latLon) {
            var climate = {};
            var apiId = "70136aa43543e25de4d3e5d81b999cc7";
            await jQuery.ajax( {
                type: 'GET',
                //url: "https://api.openweathermap.org/data/2.5/weather?lat="+latLon[1]+"&lon="+latLon[0]+"&lang=es&units=metric&appid=d501d7588e367900e084418b8b24deab",
                url: "https://api.openweathermap.org/data/2.5/weather?lat="+latLon[1]+"&lon="+latLon[0]+"&lang=es&units=metric&appid="+apiId,
                success: function( data ) {
                    climate = {
                        "temp":data.main.temp,
                        "temp_max":data.main.temp_max,
                        "temp_min":data.main.temp_min
                    }
                },
                error: function( data ) {
                    console.log('Error obteniendo el clima...');
                    setTimeout(async function(){
                        await getClimate(latLon);
                    },10000);
                }
            } );

            return climate;
        }

        async function getHumanInfo(latLon) {
            var info = {};
            await jQuery.ajax( {
                type: 'GET',
                url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+latLon[0]+","+latLon[1]+".json?access_token=pk.eyJ1IjoicmFmYWVsZHRtIiwiYSI6ImNraHdkcGV1bDBvdmoycW1sbW15ajdiM2sifQ.VSwlVeiFcfhu-DvUzwfDTg",
                success: function( data ) {
                    info = {
                        "name":data.features[0].text,
                        "description":data.features[0].place_name,
                    }
                },
                error: function( data ) {
                    console.log('Error obteniendo la información de nombres...');
                    setTimeout(async function(){
                        await getHumanInfo(latLon);
                    },10000);
                }
            } );

            return info;
        }

        async function getElevation(latLon) {
            // make API request
            var query = 'https://api.mapbox.com/v4/mapbox.mapbox-terrain-v2/tilequery/' + latLon[0] + ',' + latLon[1] + '.json?layers=contour&limit=50&access_token=' + mapboxgl.accessToken;
            var elevation = {};
            await jQuery.ajax( {
                type: 'GET',
                url: query,
                success: function( data ) {
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
                    elevation["elevation"]=highestElevation
                },
                error: function( data ) {
                    console.log('Error obteniendo la elevación...');
                    setTimeout(async function(){
                        await getElevation(latLon);
                    },10000);
                }
            });
            return await elevation;
        }

    });

    async function categoriesList() {
        var url = "{{ route('categories-list') }}"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        await jQuery.ajax( {
            type: 'GET',
            url: url,
            "data": { "_token": "{{ csrf_token() }}" },
            "dataType": "JSON",
            success: function( data ) {
                data.forEach( function(value, index) {
                    var category = `<option value="`+data[index].id+`">`+data[index].name+`</option>`;
                    $("#categories-select").append(category);
                });
            }
        } );
    }

    function init(){
        categoriesList();
    }

    init();
</script>
@endsection
