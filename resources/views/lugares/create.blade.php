@extends('layouts.app')

@section('content')
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/iconic/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css" rel="stylesheet" />
<link href="{{ asset('css/activities.css') }}" rel="stylesheet">
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
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nombre" aria-label="Username" id="activity-name" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Descripción" aria-label="Username" id="activity-description" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="activity-icon">
                        <label class="input-group-text" for="inputGroupFile02">Icon .png</label>
                    </div>
                    <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Dificultad</label>
                        <input type="number" class="form-control" id="activity-dificulty" placeholder="Password">
                      </div>
                    <select class="form-select" aria-label="Categories Select" id="categories-select">
                        <option value="" selected>Elija una categoria</option>
                    </select>
                </div>
            </div>
            <div class="card">

                <div id="map"></div>
                <ul id="buttons">
                    <li id="button-en" class="button">English</li>
                    <li id="button-ru" class="button">Russian</li>
                    <li id="button-es" class="button">Spanish</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- desplegar menu -->
    <nav  class="navbar">
        <!-- Brand -->
        <a id="save-activity" class="navbar-brand menu-boton save-activity" href="#">
          <i class="fa fa-save"></i>
        </a>
    </nav>
    <!-- end desplegar menu -->
</div>

<script>
    $(document).ready( async function(){
        mapboxgl.accessToken = 'pk.eyJ1IjoicmFmYWVsZHRtIiwiYSI6ImNrbDJvN2txYjBiZWwybnBrd3NuYmhyeWsifQ.sDFeVOhqOGPqvPsE1u6-yA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-71.91613, 9.00238],
            zoom: 14
        });
        document.getElementById('buttons').addEventListener('click', function (event) {
            var language = event.target.id.substr('button-'.length);
            map.setLayoutProperty('country-label', 'text-field', [
                'get',
                'name_' + language
            ]);
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
        var distance = 0;
        var duration = 0;
        var perfil = 0;
        var data_origin = [];
        var data_destination = [];
        var elevation = 0;
        var climate = [];
        var humanInfo = [];

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

                elevation = await getElevation(origin);
                for (const [key, value] of Object.entries(elevation)) {
                    data_origin[key]=value;
                }
                climate = await getClimate(origin);
                for (const [key, value] of Object.entries(climate)) {
                    data_origin[key]=value;
                }
                humanInfo = await getHumanInfo(origin);
                for (const [key, value] of Object.entries(humanInfo)) {
                    data_origin[key]=value;
                }
                data_destination = {
                    "lon": destination[0],
                    "lat": destination[1],
                }
                elevation = await getElevation(destination);
                for (const [key, value] of Object.entries(elevation)) {
                    data_destination[key]=value;
                }
                climate = await getClimate(destination);
                for (const [key, value] of Object.entries(climate)) {
                    data_destination[key]=value;
                }
                humanInfo = await getHumanInfo(origin);
                for (const [key, value] of Object.entries(humanInfo)) {
                    data_destination[key]=value;
                }
            }
        });

        await $('#save-activity').on('click', function(e){

            e.preventDefault();
            var name = $('#activity-name').val();
            var description = $('#activity-description').val();
            var file = $('#activity-icon')[0].files;
            var dificulty = $('#activity-dificulty').val();
            var category = $('#categories-select').val();
            var data = new FormData();
            if(name != '' && name != null && name != undefined) {
                if(description != '' && description != null && description != undefined) {
                    if(file != '' && file != null && file != undefined && file.length != 0) {
                        if(dificulty != '' && dificulty != null && dificulty != undefined) {
                            if(perfil != '' && perfil != null && perfil != undefined) {
                                if(duration != '' && duration != null && duration != undefined) {
                                    if(distance != '' && distance != null && distance != undefined) {
                                        if(category != '' && category != null && category != undefined) {
                                            if(data_origin.elevation != null && data_origin.elevation != undefined) {
                                                if(data_origin.name != null && data_origin.name != undefined) {
                                                    if(data_origin.temp != '' && data_origin.temp != null && data_origin.temp != undefined) {
                                                        if(data_destination.elevation != null && data_destination.elevation != undefined) {
                                                            if(data_origin.description != null && data_origin.description != undefined) {
                                                                if(data_destination.temp != '' && data_destination.temp != null && data_destination.temp != undefined) {
                                                                    jQuery.each(file, function(i, v) {
                                                                        data.append('file_'+i, v);
                                                                    });
                                                                    data.append('name',name);
                                                                    data.append('description',description);
                                                                    data.append('dificulty', dificulty);
                                                                    data.append('perfil', perfil);
                                                                    data.append('distance', distance);
                                                                    data.append('duration', duration);
                                                                    data.append('category', category);
                                                                    jQuery.each(data_origin, function(i, v) {
                                                                        data.append('data_origin_'+i, v);
                                                                    });
                                                                    jQuery.each(data_destination, function(i, v) {
                                                                        data.append('data_destination_'+i, v);
                                                                    });
                                                                    data.append('_token', "{{ csrf_token() }}");

                                                                    $.ajaxSetup({
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                        }
                                                                    });
                                                                    jQuery.ajax({
                                                                        url: "{{ route('save-activity') }}",
                                                                        data: data,
                                                                        cache: false,
                                                                        contentType: false,
                                                                        processData: false,
                                                                        method: 'POST',
                                                                        type: 'POST', // For jQuery < 1.9
                                                                        success: function(data){
                                                                            console.log(data);
                                                                        }
                                                                    });
                                                                } else {
                                                                    console.log('error');
                                                                }
                                                            } else {
                                                                console.log('error');
                                                            }
                                                        } else {
                                                            console.log('error');
                                                        }
                                                    }
                                                    else {
                                                        console.log('error');
                                                    }
                                                } else {
                                                    console.log('error');
                                            }
                                            } else {
                                                console.log('error');
                                            }
                                        } else {
                                            console.log('error');
                                        }
                                    } else {
                                        console.log('error');
                                    }
                                } else {
                                    console.log('error');
                                }
                            } else {
                                console.log('error');
                            }
                        } else {
                            console.log('error');
                        }
                    } else {
                        console.log('error');
                    }
                } else {
                    console.log('error');
                }
            } else {
                console.log('error');
            }
        });

        async function getClimate(latLon) {
            var climate = {};
            await jQuery.ajax( {
                type: 'GET',
                url: "https://api.openweathermap.org/data/2.5/weather?lat="+latLon[1]+"&lon="+latLon[0]+"&lang=es&units=metric&appid=d501d7588e367900e084418b8b24deab",
                success: function( data ) {
                    climate = {
                        "temp":data.main.temp,
                        "temp_max":data.main.temp_max,
                        "temp_min":data.main.temp_min
                    }
                },
                error: function( data ) {
                    getClimate(latLon);
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
                    getHumanInfo(latLon);
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
                    getElevation(latLon);
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
