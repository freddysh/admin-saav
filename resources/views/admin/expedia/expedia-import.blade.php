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
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="txt_name" class="font-weight-bold text-secondary">Ingrese el archivo</label>
                    </div>
                    <input type="text" class="form-control" id="txt_excel" name="txt_excel" placeholder="Archivo excel" required>
                    <button class="btn btn-primary ">Subir</button>
                </div>
            </div>
        </div>
    </div>

@stop