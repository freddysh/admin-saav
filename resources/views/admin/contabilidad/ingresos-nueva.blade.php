@extends('layouts.admin.book')
@section('content')
    @php
        use App\Helpers\MisFunciones;
        $dato_cliente='';
        $tiempo_dias=5;

        $color='bg-danger-goto';

        function fecha_peru($fecha){
            $fecha=explode('-',$fecha);
            return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        }
    @endphp

<div class="row">
    <div class="col-12 mt-4 d-none">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-pagos-recientes-tab" data-toggle="tab" href="#nav-pagos-recientes" role="tab" aria-controls="nav-pagos-recientes" aria-selected="true">Pagos Recientes</a>
                <a class="nav-item nav-link" id="nav-pagos-pendientes-tab" data-toggle="tab" href="#nav-pagos-pendientes" role="tab" aria-controls="nav-pagos-pendientes" aria-selected="false">Pagos Pendientes</a>
                <a class="nav-item nav-link" id="nav-pagos-tab" data-toggle="tab" href="#nav-pagos" role="tab" aria-controls="nav-pagos" aria-selected="false">Buscar Pago</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-pagos-recientes" role="tabpanel" aria-labelledby="nav-pagos-recientes-tab">
                
            </div>
            <div class="tab-pane fade" id="nav-pagos-pendientes" role="tabpanel" aria-labelledby="nav-pagos-pendientes-tab">...</div>
            <div class="tab-pane fade" id="nav-pagos" role="tabpanel" aria-labelledby="nav-pagos-tab">...</div>
        </div>
    </div>
    <div class="col-12">
        <form id="frm_buscar_pagos_pendinetes" action="{{route('pagos.recientes.filtro')}}" method="POST">
            <div class="row mt-3 text-10">
                <div class="col-6 pr-0">
                    <div class="input-group mb-2">
                        <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-primary""><i class="fas fa-globe"></i></div>
                        </div>
                        <select class="form-control" name="web" id="pr_web">
                            <option value="">Todas las paginas</option>
                            @foreach ($webs->where('estado','1')->sortBy('pagina') as $item)
                                <option value="{{$item->pagina}}">{{$item->pagina}}</option> 
                            @endforeach
                        </select>
                        <div class="input-group-prepend">
                            <div class="input-group-text text-primary""><i class="fas fa-filter"></i></div>
                        </div>
                        <select class="form-control" name="filtro" id="pr_filtro" onchange="filtrar_($(this).val(),'pr')">
                            <option value="ULTIMOS 7 DIAS" @if($pr_filtro=='ULTIMOS 7 DIAS') 'selected' @endif>ULTIMOS 7 DIAS</option>
                            <option value="ULTIMOS 30 DIAS @if($pr_filtro=='ULTIMOS 30 DIAS') 'selected' @endif">ULTIMOS 30 DIAS</option>
                            <option value="ESTE MES" @if($pr_filtro=='ESTE MES') 'selected' @endif>ESTE MES</option>
                            <option value="ENTRE FECHAS" @if($pr_filtro=='ENTRE FECHAS') 'selected' @endif>ENTRE FECHAS</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div id="fechas_pr" class="col-5 d-none mx-0 pr-0">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar text-primary"></i></div>
                        </div>
                        <input class="form-control" type="date" name="pr_f1" id="pr_f1" value="{{$pr_f1}}">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar text-primary"></i></div>
                        </div>
                        <input class="form-control" type="date" name="pr_f2" id="pr_f2" value="{{$pr_f2}}">
                    </div>
                </div>
                <div class="col-6 pr-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        
                        {{-- <a href="{{route('pagos.recientes.filtro',["$('#pr_filtro').val()",'PAGADOS',$pr_f1,$pr_f2])}}" class="btn btn-primary ">PAGADOS</a>
                        <a href="{{route('pagos.recientes.filtro',["$('#pr_filtro').val()",'PROCESADOS',$pr_f1,$pr_f2])}}" class="btn  btn-outline-primary ">PROCESADOS</a> --}}
                        <button type="button" id="btn_pagados" class="btn @if($opcion=='PAGADOS') btn-primary @else btn-outline-primary @endif" onclick="buscar_pagos_pendinetes('frm_buscar_pagos_pendinetes','PAGADOS','0')"><i class="fas fa-search"></i> FECHA PAGO</button>
                        <button type="button" id="btn_procesados" class="btn  @if($opcion=='PROCESADOS') btn-primary @else btn-outline-primary @endif" onclick="buscar_pagos_pendinetes('frm_buscar_pagos_pendinetes','PROCESADOS','1')"><i class="fas fa-search"></i> PROCESADOS</button>
                        <button type="button" id="btn_cerrados" class="btn  @if($opcion=='CERRADOS') btn-primary @else btn-outline-primary @endif" onclick="buscar_pagos_pendinetes('frm_buscar_pagos_pendinetes','CERRADOS','2')"><i class="fas fa-search"></i> PAGADOS</button>
                        <button type="button" id="btn_pendientes" class="btn  @if($opcion=='PENDIENTES') btn-primary @else btn-outline-primary @endif" onclick="buscar_pagos_pendinetes('frm_buscar_pagos_pendinetes','PENDIENTES','3')"><i class="fas fa-search"></i> PENDIENTES</button>
                    </div>
                </div>
                <div class="col-2 d-none">
                    {{$pr_filtro}}<br>{{$pr_f1}}<br>{{$pr_f2}}<br>{{$opcion}}
                    {{-- <a href="{{route('pagos.recientes.filtro',[$pr_filtro,$opcion,$pr_f1,$pr_f2])}}" class="btn  btn-primary ">BUSCAR</a> --}}
                    {{-- <button class="btn btn-primary btn-outline-primary" onclick="pagos_recientes($('#pr_filtro').val(),$('#pr_f1').val(),$('#pr_f2').val(),'rpt_pr')"> <i class="fas fa-search"></i> Buscar</button> --}}
                    @csrf
                    <input type="hidden" name="opcion" id="opcion" value="{{$opcion}}"> 
                    
                    {{-- <button type="button" class="btn btn-outline-primary" onclick="buscar_pagos_pendinetes('frm_buscar_pagos_pendinetes',$('#opcion').val())">BUSCAR</button> --}}
                    {{-- <button type="submit" class="btn btn-primary btn-outline-primary"> <i class="fas fa-search"></i> Buscar</button> --}}
                </div>
            </div>
        </form>
        <div class="row">
            <div id="rpt_pr" class="col">
            </div>
        </div> 
    </div>
</div> 

<div class="row mt-2 no-gutters d-none">
    <div class="col-12 border border-dark">
        <div class="row bg-dark mx-0 py-1 ">
            <div class="col-12">
                <div class="row px-0">
                    <div class="col-2">
                        <b class="text-16 text-white">TODOS LOS FILES</b>
                    </div>
                    <div class="col-3">
                        <input form="nuevo_buscar_codigo" name="todos_codigo" id="todos_codigo" class="form-control" type="text" placeholder="Codigo o Nombre">
                    </div>
                    <div class="col-1">
                        {{csrf_field()}}
                        <a href="#!" name="buscar" onclick="buscar_pagos($('#todos_codigo').val(),'','TODOS','CODIGO/NOMBRE','')"><i class="fas fa-search fa-2x text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="TODOS" class="row mt-1 no-gutters">
            <div class="col-6 border border-danger">
                <div class="row bg-danger mx-0">
                    <div class="col-12 ">
                        <div class="row p-1">
                            <div class="col-3 px-0">
                                <b class="text-14 text-white">NEW</b>
                            </div>
                            <div class="col-4">
                                @php
                                    $mostrado=0;
                                @endphp
                                <select class="form-control" name="pagina" id="pagina_nuevo">
                                    @foreach ($webs->where('estado','1') as $item)
                                        <option value="{{$item->pagina}}" @if($mostrado==0) selected @endif>{{$item->pagina}}</option>  
                                        @php
                                            $mostrado++;
                                        @endphp
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="tipo_filtro" id="tipo_filtro" onchange="mostrar_filtro_reservas($(this).val(),'nuevo')">
                                    <option value="show-codigo-nuevo">Código</option>
                                    <option value="show-nombre-nuevo">Nombre</option>
                                    <option value="show-fechas-nuevo">Entre fechas</option>
                                    <option value="show-anio-mes-nuevo">Año-mes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-danger mx-0 pb-1">                    
                    <div id="show-codigo-nuevo" class="col-12">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_codigo" name="nuevo_codigo" id="nuevo_codigo" class="form-control" type="text" placeholder="Codigo">
                            </div>
                            <div class="col-2">
                                {{csrf_field()}}
                                <a href="#!" name="buscar" onclick="buscar_pagos($('#nuevo_codigo').val(),'','NUEVO','CODIGO',$('#pagina_nuevo').val())"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-nombre-nuevo" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <input form="nuevo_buscar_nombre" name="nombre_nuevo" id="nombre_nuevo" class="form-control" type="text" placeholder="Nombre">
                            </div>
                            <div class="col-2">
                                <a href="#!" name="buscar" onclick="buscar_pagos($('#nombre_nuevo').val(),'','NUEVO','NOMBRE',$('#pagina_nuevo').val())"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-fechas-nuevo" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-6 mr-0 pr-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_ini" id="f_ini_nuevo">
                                    </div>
                                    <div class="col-6 ml-0 pl-0">
                                        <input form="nuevo_buscar_fecha" class="form-control" type="date" name="f_fin" id="f_fin_nuevo">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_pagos($('#f_ini_nuevo').val(),$('#f_fin_nuevo').val(),'NUEVO','FECHAS',$('#pagina_nuevo').val())"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="show-anio-mes-nuevo" class="col-12 d-none">
                        <div class="row px-0">
                            <div class="col-10 px-0">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <input form="nuevo_buscar_anio_mes" name="anio_nuevo" id="anio_nuevo" class="form-control" type="text" value="{{date("Y")}}">
                                    </div>
                                    <div class="col-8 pl-0">
                                        <select form="nuevo_buscar_anio_mes" name="mes_nuevo" id="mes_nuevo" class="form-control">
                                            <option value="01">ENERO</option>
                                            <option value="02">FEBRERO</option>
                                            <option value="03">MARZO</option>
                                            <option value="04">ABRIL</option>
                                            <option value="05">MAYO</option>
                                            <option value="06">JUNIO</option>
                                            <option value="07">JULIO</option>
                                            <option value="08">AGOSTO</option>
                                            <option value="09">SEPTIEMBRE</option>
                                            <option value="10">OCTUBRE</option>
                                            <option value="11">NOVIEMBRE</option>
                                            <option value="12">DICIEMBRE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#!"  name="buscar" onclick="buscar_pagos($('#anio_nuevo').val(),$('#mes_nuevo').val(),'NUEVO','ANIO-MES',$('#pagina_nuevo').val())"><i class="fas fa-search fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="NUEVO">
                        <table class="table table-bordered table-striped table-responsive table-hover text-12">
                            <thead>
                                <tr>
                                    <th>PAX. <span class="text-success">(GOTOPERU.COM)</span></th>
                                    <th>TOTAL</th>
                                    <th>PAGADO</th>
                                    <th>SALDO</th>
                                    <th style="width:230px;">PROX. PAGO</th>
                                    <th>OPER.</th>
                                </tr>    
                            </thead>
                            <tbody></tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                html : true,
            });
        });
    </script>
@stop
