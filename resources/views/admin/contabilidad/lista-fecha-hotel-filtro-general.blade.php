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
                <div class="row">
                    <div class="col-12">
                        <b>
                        <i class="fas fa-filter"></i> {{$tipo_pago}} | 
                            @if($opcion=='ENTRE DOS FECHAS'||$opcion=='ENTRE DOS FECHAS URGENTES')
                                <i class="fas fa-calendar"></i> {{$opcion}} [{{MisFunciones::fecha_peru($ini)}} al {{MisFunciones::fecha_peru($fin)}}]
                            @else
                            <i class="fas fa-filter"></i> {{$opcion}} | <i class="fas fa-filter"></i>{{$cod_nom}}
                            @endif
                        </b>
                    </div>
                    <div class="col-10  col-lg-offset-10">
                        <table class="table table-condensed table-bordered  table-hover table-sm text-12">
                            <thead>
                            <tr>
                                <th class="text-grey-goto text-center">Cotización</th>
                                <th class="text-grey-goto text-center">Nro</th>
                                <th class="text-grey-goto text-center"style="width:150px">Servicio</th>
                                <th class="text-grey-goto text-center">Proveedor</th>
                                <th class="text-grey-goto text-center" style="width:100px">Fecha de Servicio</th>
                                <th class="text-grey-goto text-center" style="width:100px">Fecha a Pagar</th>
                                <th class="text-grey-goto text-center">Total Venta</th>
                                <th class="text-grey-goto text-center">Total Reserva</th>
                                <th class="text-grey-goto text-center">Total Conta</th>
                                <th class="text-grey-goto text-center d-none">Saldo</th>
                                <th class="text-grey-goto text-center">Ope</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-g-dark text-white">
                                <td colspan="11">
                                <b> HOTELES</b>
                                    <div class="form-check d-none">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="HOTELS" onclick="marcar_checked('HOTELS')">
                                        <label class="form-check-label" for="exampleCheck1"><b> HOTELES</b></label>
                                    </div>
                                </td>
                                </tr>
                                @foreach($array_pagos_pendientes as $key => $array_pagos_pendiente)
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input HOTELS" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos[]" id="chb_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST" >   
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                                
                                                {{-- <!-- Modal -->
                                            <button type="button" class="btn btn-primary btn-sm d-none" data-toggle="modal" data-target="#modal_{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_nota_{{$key}}">
                                                <i class="fas fa-edit"></i>
                                            </button>    
                                            <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_nota_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                <form id="form_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST" >   
                                                    <div class="modal-content  modal-lg">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div id="datos_nota_{{$key}}" class="col">
                                                                    <div class="form-control">
                                                                        <label for="nota_{{$key}}">Nota</label>
                                                                        <textarea class="form-control" name="nota" id="nota_{{$key}}" cols="30" rows="10"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary d-none">Save changes</button>
                                                        </div>
                                                    </div>   
                                                </form>                                                                   
                                            </div>
                                        </div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- servicios tours --}}
                                <tr class="bg-g-dark text-white"><td colspan="11"><b>TOURS</b></td></tr>
                                @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                    @if($array_pagos_pendiente['grupo']=='TOURS')
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos_s[]" id="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- servicios movilid --}}
                                <tr class="bg-g-dark text-white"><td colspan="11"><b>MOVILID</b></td></tr>
                                @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                    @if($array_pagos_pendiente['grupo']=='MOVILID' &&$array_pagos_pendiente['clase']=='DEFAULT' )
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos_s[]" id="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- servicios REPRESENT --}}
                                <tr class="bg-g-dark text-white"><td colspan="11"><b>REPRESENT</b></td></tr>
                                @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                    @if($array_pagos_pendiente['grupo']=='REPRESENT')
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos_s[]" id="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                                
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- servicios ENTRANCES --}}
                                <tr class="bg-g-dark text-white"><td colspan="11"><b>ENTRANCES</b></td></tr>
                                @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                    @if($array_pagos_pendiente['grupo']=='ENTRANCES' || ($array_pagos_pendiente['grupo']=='MOVILID'&&$array_pagos_pendiente['clase']=='BOLETO'))
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos_s[]" id="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                                
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- servicios FOOD --}}
                                <tr class="bg-g-dark text-white"><td colspan="11"><b>FOOD</b></td></tr>
                                @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                    @if($array_pagos_pendiente['grupo']=='FOOD')
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos_s[]" id="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                                
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- servicios TRAINS --}}
                                <tr class="bg-g-dark text-white"><td colspan="11"><b>TRAINS</b></td></tr>
                                @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                    @if($array_pagos_pendiente['grupo']=='TRAINS')
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos_s[]" id="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- servicios FLIGHTS --}}
                                <tr class="bg-g-dark text-white"><td colspan="11"><b>FLIGHTS</b></td></tr>
                                @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                    @if($array_pagos_pendiente['grupo']=='FLIGHTS')
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos_s[]" id="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                                
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- servicios OTHERS --}}
                                <tr class="bg-g-dark text-white"><td colspan="11"><b>OTHERS</b></td></tr>
                                @foreach($array_pagos_pendientes_tours as $key => $array_pagos_pendiente)
                                    @if($array_pagos_pendiente['grupo']=='OTHERS')
                                    <tr>
                                        <td class="text-grey-goto text-left">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" form="preparar_requerimiento" value="{{$key}}" name="chb_h_pagos_s[]" id="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}" onclick="if(this.checked) sumar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html()); else restar($('#monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}').html());" @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) disabled @endif>
                                                <label class="form-check-label" for="chb_{{$array_pagos_pendiente['grupo']}}_{{$key}}">
                                                    <b class="text-success">{{$array_pagos_pendiente['codigo']}}</b> | <b>{{$array_pagos_pendiente['pax']}}</b><br>
                                                @if($array_pagos_pendiente['monto_r']>0 && $array_pagos_pendiente['monto_c']<=0) <span id="warning_{{$key}}" class="text-10 text-danger">Ingresar montos a pagar</span> @endif
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-grey-goto text-center">{{$array_pagos_pendiente['nro']}}<b><i class="fas fa-user text-primary"></i></b></td>
                                        <td class="text-grey-goto text-left">{!!$array_pagos_pendiente['titulo']!!}</td>
                                        <td class="text-grey-goto text-left">{{$array_pagos_pendiente['proveedor']}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_servicio'])}}</td>
                                        <td class="text-grey-goto text-center"><i class="fas fa-calendar"></i> {{MisFunciones::fecha_peru($array_pagos_pendiente['fecha_pago'])}}</td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_v']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> {{$array_pagos_pendiente['monto_r']}}</b></td>
                                        <td class="text-grey-goto text-right"><b><sup>$</sup> <span id="monto_{{$array_pagos_pendiente['grupo']}}_c_{{$key}}">{{$array_pagos_pendiente['monto_c']}}</span></b></td>
                                        <td class="text-grey-goto text-right">{{$array_pagos_pendiente['saldo']}}</td>
                                        <td class="text-grey-goto text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_{{$key}}" onclick="traer_datos('{{$key}}','{{$array_pagos_pendiente['grupo']}}','{{$array_pagos_pendiente['clase']}}','{{$array_pagos_pendiente['items']}}','{{$array_pagos_pendiente['nro']}}','2')">
                                                        <i class="fas fa-edit"></i>
                                            </button>    
                                                <!-- Modal -->
                                            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">  
                                                    <form id="form_{{$array_pagos_pendiente['grupo']}}_{{$key}}" action="{{route('contabilidad.hotel.store')}}" method="POST">
                                                        <div class="modal-content  modal-lg">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Costos</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                <div id="{{$array_pagos_pendiente['grupo']}}_{{$array_pagos_pendiente['clase']}}_datos_{{$key}}" class="col">

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
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-2 fixed">
                        <div class="card w-100">
                            <div class="card-body text-center">
                                <h2 class="text-40"><sup><small>$usd</small></sup><b id="s_total">0</b></h2>
                                <form id="preparar_requerimiento" action="{{route('contabilidad.preparar_requerimiento')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="tipo_pago" value='{{$tipo_pago}}'>
                                    <input type="hidden" name="tipo_filtro" value='{{$opcion}}'>
                                    <input type="hidden" name="txt_ini" value='{{$ini}}'>
                                    <input type="hidden" name="txt_fin" value='{{$fin}}'>
                                    <input type="hidden" name="cod_nom" value='{{$cod_nom}}'>
                                    <button type="submit" class="btn btn-info display-block w-100">Seleccionar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
    