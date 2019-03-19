@php
    $arra_prov_pagos=[];
    function fecha_peru($fecha){
        $f1=explode('-',$fecha);
        return $f1[2].'-'.$f1[1].'-'.$f1[0];
    }
@endphp

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        {{-- <form action="{{route('list_fechas_hotel_show_path')}}" method="post"> --}}
                            {{-- {{csrf_field()}} --}}
                            <div class="row">
                                <div class="col-9">
                                    <table class="table table-condensed table-bordered margin-top-20 table-hover table-sm text-13">
                                        <thead>
                                        <tr>
                                            <th class="text-grey-goto text-center">Cotización</th>
                                            <th class="text-grey-goto text-center">Nro</th>
                                            <th class="text-grey-goto text-center">Servicio</th>
                                            <th class="text-grey-goto text-center">Proveedor</th>
                                            <th class="text-grey-goto text-center">Fecha de Servicio</th>
                                            <th class="text-grey-goto text-center">Fecha a Pagar</th>
                                            <th class="text-grey-goto text-center">Total</th>
                                            <th class="text-grey-goto text-center">Saldo</th>
                                            <th class="text-grey-goto text-center">Operaciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($array_pagos_pendientes as $key => $array_pagos_pendiente)
                                                <tr>
                                                    <td class="text-grey-goto text-left"> <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b></td>
                                                    <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                                    <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                                    <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                                    <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                                    <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                                    <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto']}}</b></td>
                                                    <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                                    <td class="text-grey-goto text-right">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','HOTELS','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}')">
                                                                    <i class="fas fa-edit"></i>
                                                        </button>    
                                                            <!-- Modal -->
                                                        <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">  
                                                                <form id="form_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST" >   
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div id="datos_{{$key}}" class="col">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer d-none">
                                                                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                                        </div>
                                                                    </div>   
                                                                </form>                                                                   
                                                            </div>
                                                        </div>    
                                                        <button class="btn btn-primary btn-sm"><i class="fas fa-book"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-3">
                                    <div class="card w-100">
                                        <div class="card-body text-center">
                                            <h2 class="text-40"><sup><small>$usd</small></sup><b id="s_total">Monto</b></h2>
                                            <button type="submit" class="btn btn-info display-block w-100">Seleccionar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}

                </div>
            </div>
        </div>
    </div>
    