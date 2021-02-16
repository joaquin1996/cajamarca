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
</div>
@endsection
