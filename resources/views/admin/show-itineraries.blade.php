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
                    <option value="0">Escoja una opcion</option>
                    <option value="gotoperu.com">gotoperu.com</option>
                    <option value="llama.tours">llama.tours</option>
                    <option value="gotoperu.com.pe">gotoperu.com.pe</option>
                    <option value="andesviagens.com">andesviagens.com</option>
                    <option value="machupicchu-galapagos.com">machupicchu-galapagos.com</option>
                    <option value="gotolatinamerica.com">gotolatinamerica.com</option>
                    <option value="expedia.com">expedia.com</option>
                    <option value="viator.com">viator.com</option>
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