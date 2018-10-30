@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp

@extends('layouts.admin.operaciones')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home1</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Operaciones</a></li>
            <li class="breadcrumb-item active">List</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{route('operaciones_lista_path')}}" method="post">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="txt_desde" class="font-weight-bold text-secondary">Desde</label>
                                    <input type="date" class="form-control" id="txt_desde" name="txt_desde" required="required" value="{{$desde}}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="txt_hasta" class="font-weight-bold text-secondary">Hasta</label>
                                    <input type="date" class="form-control" id="txt_hasta" name="txt_hasta" required="required" value="{{$hasta}}">
                                </div>
                            </div>
                            <div class="col-2 mt-4">
                                {{csrf_field()}}
                                <input type="submit" class="btn btn-primary btn-lg" name="Buscar">
                            </div>


                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card w-100">
            <!-- Default panel contents -->
            <div class="card-header">
                Lista de operaciones de <span class="badge badge-primary">{{fecha_peru($desde)}}</span> a <span class="badge badge-primary">{{fecha_peru($hasta)}}</span>
                <a href="{{route('imprimir_operaciones_path',[$desde,$hasta])}}" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf"></i>
                </a>
            </div>
            <!-- Table -->
            <table class="table table-striped table-responsive table-bordered table-hover small">
                <thead>
                    <tr class="bg-primary text-white">
                        <td>FECHA</td>
                        <td>N°</td>
                        <td>NOMBRE</td>
                        <td>CTA</td>
                        <td>S/P</td>
                        <td>ID</td>
                        <td>DESTINO</td>
                        <td>HORA</td>
                        <td>TOUR</td>
                        <td>REPRESENT</td>
                        <td>HOTEL</td>
                        <td>MOVILIDAD</td>
                        {{--<td>ENTRANCES</td>--}}
                        <td>FOOD</td>
                        <td>TRAIN</td>
                        <td>FLIGHT</td>
                        <td>OBSERVACIONES</td>
                    </tr>
                </thead>
                <tbody>
                {{--@foreach($cotizaciones->where('confirmado_r','ok')->sortby('fecha') as $cotizacion)--}}
                @foreach($cotizaciones->sortby('fecha') as $cotizacion)
                    @php
                        $clientes_=array();
                    @endphp
                    @foreach($cotizacion->cotizaciones_cliente as $cotizacion_cliente)
                        @foreach($clientes2->where('id',$cotizacion_cliente->clientes_id) as $cliente)
                            @php
                               $clientes_[]=$cliente->nombres." ".$cliente->apellidos;
                            @endphp
                        @endforeach
                    @endforeach
                    @foreach($cotizacion->paquete_cotizaciones->where('estado','2') as $pqts)
                        @foreach($pqts->itinerario_cotizaciones->sortby('fecha') as $itinerario)
                            @php
                                $pre_hora='';
                            @endphp
                            @foreach($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio)
                                <tr>
                                    <td>{{fecha_peru($itinerario->fecha)}}</td>
                                    <td>{{$cotizacion->nropersonas}}</td>
                                    <td>
                                        @foreach($clientes_ as $cli)
                                        {{$cli}}</br>
                                        @endforeach
                                    </td>
                                    <td>{{$cotizacion->web}}</td>
                                    <td>{{$servicio->s_p}}</td>
                                    <td>{{$cotizacion->idioma_pasajeros}}</td>
                                @php
                                    $serv_txt='';
                                    $valor='';
                                @endphp
                                @foreach($m_servicios->where('id',$servicio->m_servicios_id) as $serv)
                                    @php
                                        $serv_txt=$serv->localizacion;
                                    @endphp
                                    <td>{{$serv_txt}}</td>
                                    <td><b class="text-success">{{$servicio->hora_llegada}}</b></td>
                                    @php
                                        $prov_rs='';
                                        $prov_celular='';
                                    @endphp
                                    @foreach($proveedores->where('id',$servicio->proveedor_id) as $prov)
                                        @php
                                            $prov_rs=$prov->razon_social;
                                            $prov_celular=$prov->celular;
                                        @endphp
                                    @endforeach
                                        @if($serv->grupo=='TOURS')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                @if($servicio->segunda_confirmada==1)
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="0">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-success" onclick="segunda_confirmada('{{$servicio->id}}','0')"><i class="fas fa-clock fa-3x"></i></a>
                                                @else
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="1">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-grey-goto" onclick="segunda_confirmada('{{$servicio->id}}','1')"><i class="fas fa-clock fa-3x"></i></a>
                                                @endif
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='REPRESENT' && $serv->tipoServicio=='TRANSFER')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                @if($servicio->segunda_confirmada==1)
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="0">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-success" onclick="segunda_confirmada('{{$servicio->id}}','0')"><i class="fas fa-clock fa-3x"></i></a>
                                                @else
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="1">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-grey-goto" onclick="segunda_confirmada('{{$servicio->id}}','1')"><i class="fas fa-clock fa-3x"></i></a>
                                                @endif
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            @php
                                                $prov_hotel_rs='';
                                                $prov_hotel_celular='';
                                            @endphp
                                            @foreach($itinerario->hotel as $hotel)
                                                @foreach($proveedores->where('id',$hotel->proveedor_id) as $prov_hotel)
                                                    @php
                                                        $prov_hotel_rs=$prov_hotel->razon_social;
                                                        $prov_hotel_celular=$prov_hotel->celular;
                                                    @endphp
                                                @endforeach
                                                @if($hotel->personas_s>0)
                                                    <p>{{$hotel->personas_s}} Single</p>
                                                @endif
                                                @if($hotel->personas_d>0)
                                                    <p>{{$hotel->personas_d}} Double</p>
                                                @endif
                                                @if($hotel->personas_m>0)
                                                    <p>{{$hotel->personas_m}} Matrimonial</p>
                                                @endif
                                                @if($hotel->personas_t>0)
                                                    <p>{{$hotel->personas_t}} Triple</p>
                                                @endif
                                                <p class="text-primary">{{$prov_hotel_rs}}<br>{{$prov_hotel_celular}}</p>
                                                    @if($hotel->segunda_confirmada==1)
                                                        <input type="hidden" id="confi2_v_h_{{$hotel->id}}" value="0">
                                                        <a id="confi2_h_{{$hotel->id}}" href="#!" class="text-success" onclick="segunda_confirmada_hotel('{{$hotel->id}}','0')"><i class="fas fa-clock fa-3x"></i></a>
                                                    @else
                                                        <input type="hidden" id="confi2_v_h_{{$hotel->id}}" value="1">
                                                        <a id="confi2_h_{{$hotel->id}}" href="#!" class="text-grey-goto" onclick="segunda_confirmada_hotel('{{$hotel->id}}','1')"><i class="fas fa-clock fa-3x"></i></a>
                                                    @endif
                                            @endforeach
                                        </td>
                                        @if($serv->grupo=='MOVILID')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                @if($servicio->segunda_confirmada==1)
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="0">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-success" onclick="segunda_confirmada('{{$servicio->id}}','0')"><i class="fas fa-clock fa-3x"></i></a>
                                                @else
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="1">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-grey-goto" onclick="segunda_confirmada('{{$servicio->id}}','1')"><i class="fas fa-clock fa-3x"></i></a>
                                                @endif
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='FOOD')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                @if($servicio->segunda_confirmada==1)
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="0">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-success" onclick="segunda_confirmada('{{$servicio->id}}','0')"><i class="fas fa-clock fa-3x"></i></a>
                                                @else
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="1">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-grey-goto" onclick="segunda_confirmada('{{$servicio->id}}','1')"><i class="fas fa-clock fa-3x"></i></a>
                                                @endif
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='TRAINS')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                @if($servicio->segunda_confirmada==1)
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="0">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-success" onclick="segunda_confirmada('{{$servicio->id}}','0')"><i class="fas fa-clock fa-3x"></i></a>
                                                @else
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="1">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-grey-goto" onclick="segunda_confirmada('{{$servicio->id}}','1')"><i class="fas fa-clock fa-3x"></i></a>
                                                @endif
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='FLIGHTS')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p>{{$servicio->aerolinea}} / {{$servicio->nro_vuelo}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                @if($servicio->segunda_confirmada==1)
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="0">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-success" onclick="segunda_confirmada('{{$servicio->id}}','0')"><i class="fas fa-clock fa-3x"></i></a>
                                                @else
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="1">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-grey-goto" onclick="segunda_confirmada('{{$servicio->id}}','1')"><i class="fas fa-clock fa-3x"></i></a>
                                                @endif
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='OTHERS')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                @if($servicio->segunda_confirmada==1)
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="0">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-success" onclick="segunda_confirmada('{{$servicio->id}}','0')"><i class="fas fa-clock fa-3x"></i></a>
                                                @else
                                                    <input type="hidden" id="confi2_v_{{$servicio->id}}" value="1">
                                                    <a id="confi2_{{$servicio->id}}" href="#!" class="text-grey-goto" onclick="segunda_confirmada('{{$servicio->id}}','1')"><i class="fas fa-clock fa-3x"></i></a>
                                                @endif
                                            </td>
                                            @endif
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal_serv{{$servicio->id}}">
                                                Obs.
                                            </button>
                                            <div class="modal fade" id="myModal_serv{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
{{--                                                        <form action="{{route('asignar_observacion_servicio_path')}}" method="post">--}}
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list-alt" aria-hidden="true"></i> Observaciones</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body clearfix">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label for="obs" class="text-secondary font-weight-bold">Ingrese las observaciones</label>
                                                                        <textarea class="form-control" name="obs" id="obs_{{$servicio->id}}" cols="30" rows="10">{{$servicio->obs_operaciones}}</textarea>
                                                                        <span id="rpt_{{$servicio->id}}" class="h5 text-success"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{csrf_field()}}
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <button type="button" class="btn btn-primary" onclick="guardar_obs_servicio({{$servicio->id}})">Guardar cambios</button>
                                                            </div>
                                                        {{--</form>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                @endforeach
                                </tr>
                            @endforeach

                        @endforeach
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

@stop
