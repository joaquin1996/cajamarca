@extends('layouts.app')

@section('content')
<!-- breadcumb -->
<div class="row breadcumb">
    <div class="d-flex align-items-center">
        Lugares <img src="{{ asset('img/icons/lugares-w.png') }}" style="padding: 10px" alt="">
    </div>
    <div class="d-flex align-items-center agregar">
        <a id="create-activity" class="create-activity" href="{{ route('create-category') }}">
            Agregar
        <i class="fa fa-plus"></i>
      </a>
    </div>
</div>
<!-- end breadcumb -->

<div class="container" style="margin-top: 2rem">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="input-group buscador">
                <input type="text" class="form-control">
                <button class="input-group-text"><i class="fa fa-search"></i></button>
            </div>

            <div class="col-md-12 activities">
                <ul>
                    @foreach ($categories as $item)
                        <li>
                            <div class="row">
                                <a class="d-flex align-items-center icon" href="{{ route('category',$item->id)}}">
                                    <img src="{{ asset('img/icons/user.png') }}" alt="">
                                </a>
                                <a class="d-flex align-items-center name" href="{{ route('category',$item->id)}}">
                                    {{$item->name}}
                                </a>
                                <div class="d-flex align-items-center botones">
                                    <a href="/home/edit-category/{{$item->id}}" class="boton">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <i onclick="eliminar({{$item->id}})" class="fa fa-trash boton"
                                    style="position: relative; top: -1.5px;"></i>
                                    <a href="{{ route('category',$item->id)}}" class="boton">
                                        <i class='ion ion-ios-arrow-forward'></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

const edit_env = (id) => {
    this.preventDefault();
}

    function eliminar( id ) {

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
                            url: "{{ route('delete-category') }}",
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
</script>
@endsection
