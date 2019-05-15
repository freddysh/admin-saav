@extends('errors::layout')

@section('title','50')
@section('message')
<div class="row">
    <div class="col-12">
    <img src="{{asset('img/logos/503.jpg')}}" alt="" srcset="">
    </div>
    <div class="col-12">
        <a href="{{route('index_path')}}">
            <img src="{{asset('img/logos/regresar.png')}}" alt="" srcset="">
        </a>
    </div>
</div>    
@endsection