@extends('.layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Inventory</li>
            <li class="breadcrumb-item">Itinerary</li>
            <li class="breadcrumb-item active">List</li>
        </ol>
    </nav>
    <hr>

    <div class="row mt-3">
        <div class="col">
            <div class="form-group">
                <label for="txt_pagina" class="font-weight-bold text-secondary">filtrar por pagina</label>
                <select class="form-control" id="txt_pagina" name="txt_pagina" onchange="mostrar_pqts($('#txt_pagina').val())">
                    <option value="-1">Escoja una opcion</option>
                    <option value="0">Todos</option>
                    @foreach ($webs as $item)
                        <option value="{{$item->pagina}}">{{$item->pagina}}</option> 
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12" id="lista_pqts">

        </div>
        {{csrf_field()}}
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@stop