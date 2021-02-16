@extends('layouts.app')

@section('content')
<div class="row col-md-12 mt-5">
    <div class="panel panel-primary col-md-12">
        <div class="panel-heading">
        <span style="color:green">Zona de cargar imagenes </span>
        </div>
        <div class="panel-body">
            <form action="/home/save_image" method="post" id="my-dropzone" class="dropzone" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="1">
                <div class="dz-message" style="height:100px;">
                    Arrastrar y soltar archivos 
                </div>
                <div class="dropzone-previews"></div>
                <button type="submit" class="btn btn-success" id="submit" style="display:none">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
///////////////////////////////////////////////////////////////////////
// codigo para añadir una imagen a la base de datos mediante ajax
///////////////////////////////////////////////////////////////////////

// logica necesaria para el dropzone
Dropzone.options.myDropzone = {
    autoProcessQueue: true,
    uploadMultiple: true,
    //maxFilezise: 10,
    //maxFiles: 2,

    init: function () {
        var submitBtn = document.querySelector("#submit");
        myDropzone = this;

        submitBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            myDropzone.processQueue();
        });
        this.on("addedfile", function (file) {
            console.log(file);
        });

        this.on("complete", function (file) {
            //myDropzone.removeFile(file);
        });

        this.on("success", function (file, response) {
            console.log(response);            
        });
    },
};
// end dropzone

</script>


@endsection
