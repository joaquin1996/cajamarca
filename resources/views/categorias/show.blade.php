@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2rem">
    <div class="justify-content-center">
        <div class="row details">
            <div class="row col-md-6 info">
                <img src="{{ asset('img/icons/user.png') }}" alt="">
                <div class="d-flex align-items-center name">
                    <div class="title">
                        Nombre: {{$category->name}}
                    </div>
                </div>
                <div class="description">
                    {{$category->description}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
