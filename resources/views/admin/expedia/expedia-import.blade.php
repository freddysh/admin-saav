@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
@stop
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Quotes</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Expedia</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    File
                </div>
                <div class="card-body">
                    <form action="{{route('expedia_import_path')}}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                {!! Session::has('msg') ? Session::get("msg") : '' !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txt_pagina" class="font-weight-bold text-secondary">Ingrese la pagina</label>
                                </div>
                                <select name="web" id="web" class="form-control">
                                    @foreach ($webs as $item)
                                        <option value="{{$item->pagina}}" @if($item->pagina==$page) selected @endif>{{$item->pagina}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txt_name" class="font-weight-bold text-secondary">Ingrese el archivo</label>
                                </div>
                                <input type="file" class="form-control" id="excel" name="import_file" placeholder="Archivo excel" value="{{old('import_file')}}">
                            </div>
                            <div class="col-4 mt-5">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-primary btn-lg">Subir archivo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop