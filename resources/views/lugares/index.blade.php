@extends('layouts.app')

@section('content')
<link href="{{ asset('css/categories.css') }}" rel="stylesheet">
<link href="{{ asset('css/activities.css') }}" rel="stylesheet">
<div class="container" style="margin-top: 2rem">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="categories" id="categories"></div>
            <div class="input-group">
                <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
              </div>
            <div class="">
                <ul class="activities" id="activities"></ul>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script>

    function init(){
        categoriesList();
        activitiesList();
    }

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
                    var category = `<div class="category">
                        <div class="icon">
                            <i class="fa `+data[index].icon+`"></i>
                        </div>
                        <div class="name">
                            <p>`+data[index].name+`</p>
                        </div>
                    </div>`;
                    $("#categories").append(category);
                });
            }
        } );
    }

    async function activitiesList() {
        var url = "{{ route('activities-list') }}"
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
                    var id = data[index].id;
                    var url = "{{ route('activity',1)}}";
                    url = url.substr(0, url.length -1);
                    url = url + id;
                    var activity = `<a href="`+url+`"><li class="activity card">
                        <div class="icon columns1-4">
                            <i class="fa `+data[index].icon+`"></i>
                        </div>
                        <div class="name columns3-4">
                            <p>`+data[index].name+`</p>
                        </div>
                    </li></a>`;
                    $("#activities").append(activity);
                });
            }
        } );
    }

    init();
</script>
@endsection
