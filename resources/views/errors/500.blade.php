@extends('errors::layout')

@section('title','500')
@section('message')
<div class="row">
    <div class="col-12">
        <img src="{{asset('img/logos/500.jpg')}}" alt="" srcset="">
    </div>
    <div class="col-6">
        <b>Comunicate con soporte del sistema</b>
    </div>
    <div class="col-6">
        <a href="{{route('index_path')}}">
            <img src="{{asset('img/logos/regresar.png')}}" alt="" srcset="">
        </a>
    </div>
</div>    
@endsection