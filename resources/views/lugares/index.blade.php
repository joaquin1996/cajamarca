@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2rem">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="owl-carousel testimonials-carousel">
                @foreach ($categories as $item)
                    <div class="testimonial-item" data-aos="fade-up">
                        <div class="category">
                            <div class="icon">
                                <img src="{{ asset('img/icons/user.png') }}" alt="">
                            </div>
                            <div class="name">
                                <p>{{$item->name}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach                
            </div>

            <div class="input-group buscador">
                <input type="text" class="form-control">
                <button class="input-group-text"><i class="fa fa-search"></i></button>
            </div>

            <div class="col-md-12 activities">
                <ul>
                    @foreach ($activities as $item)
                        <li>
                            <a href="{{ route('activity',$item->id)}}" class="row">
                                <div class="d-flex align-items-center icon">
                                    <img src="{{ asset('img/icons/user.png') }}" alt="">
                                </div>
                                <div class="d-flex align-items-center name">
                                    {{$item->name}}
                                </div>
                                <div class="d-flex align-items-center flecha">
                                    <i class='ion ion-ios-arrow-forward'></i>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    
                </ul>
            </div>
        </div>
    </div>
    <!-- desplegar menu -->
    <nav  class="navbar">
        <!-- Brand -->
        <a id="create-activity" class="navbar-brand menu-boton create-activity" href="{{ route('create-activity') }}">
          <i class="fa fa-plus"></i>
        </a>

    </nav>
    <!-- end desplegar menu -->
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
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
                    var urlEdit = "{{ route('edit-activity',1)}}";
                    url = url.substr(0, url.length -1);
                    url = url + id;
                    urlEdit = urlEdit.substr(0, urlEdit.length -1);
                    urlEdit = urlEdit + id;
                    var activity = `<a href="`+url+`"><li class="activity card">
                        <div class="icon columns1-4">
                            <i class="fa `+data[index].icon+`"></i>
                        </div>
                        <div class="name columns3-4">
                            <p>`+data[index].name+`</p>
                        </div>
                        <div class="name columns3-4">
                            <a href="`+urlEdit+`"><button><i class="fa fa-edit"></i></button></a>
                            <button onclick="eliminar(`+id+`)"><i class="fa fa-trash"></i></button>
                        </div>
                    </li></a>`;
                    $("#activities").append(activity);
                });
            }
        } );
    }

    async function eliminar( id ) {
        Swal.fire({
            title: 'Eliminar barco ',
            icon: 'question',
            text: '¿Esta seguro que deseas eliminar barco?',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonColor: '#1b8eb7',
            confirmButtonColor: '#f64846',
            confirmButtonText: "<i class='fa fa-trash'></i>  Eliminar",
            cancelButtonText: "<i class='fa fa-times'></i> Cancelar",
        }).then( async (result) => {
            if ( result.value ) {

                /*-- Comienzo de la segunda alerta --*/

                await Swal.fire({
                    title: '¿Estas seguro?',
                    icon: 'question',
                    html: "<p style='color: red;'><strong>¿Esta seguro que desea elimiar este barco?</strong></p>",
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#f64846',
                    confirmButtonText: "<i class='fa fa-trash'></i> Sí, !Estoy seguro!",
                    cancelButtonColor: '#1b8eb7',
                    cancelButtonText: "<i class='fa fa-times'></i> Cancelar",
                }).then( async (result) => {
                    if ( result.value ) {
                       /*-- Comienzo de la función eliminar --*/
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        await $.ajax({
                            url: "{{ route('delete-activity') }}",
                            type: 'POST',
                            data: { id: id },
                            success:function ( data ) {
                                if ( data ) {
                                    Swal.fire({
                                        title: 'Se elimino el barco',
                                        icon: 'success',
                                        showClass: {
                                            popup: 'animated fadeInDown faster'
                                        },
                                        hideClass: {
                                            popup: 'animated fadeOutUp faster'
                                        },
                                        html: "<p class='text-success'>Se elimino el barco</p>",
                                        showConfirmButton: false,
                                        timer:3000,
                                    });
                                   /*  setTimeout( function() {
                                        window.location='/buques';
                                    }, 3000 ); */
                                }
                            }
                        })
                    }
                } );

                /*-- Fin de la segunda alerta --*/
            }
        });
    }

    init();
</script>
@endsection
