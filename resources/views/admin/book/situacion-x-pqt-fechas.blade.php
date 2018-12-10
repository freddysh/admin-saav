@php
    use Carbon\Carbon;
    // function fecha_peru($fecha){
    //     if(trim($fecha)!=''){
    //         $fecha=explode('-',$fecha);
    //         return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    //     }
    // }
    // function fecha_peru1($fecha_){
    //     $f1=explode(' ',$fecha_);
    //     $hora=$f1[1];
    //     $f2=explode('-',$f1[0]);
    //     $fecha1=$f2[2].'-'.$f2[1].'-'.$f2[0];
    //     return $fecha1.' a las '.$hora;
    // }
@endphp
<div class="card w-100">
    <div class="card-body">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item active"><a data-toggle="tab" href="#hotels" class="nav-link active rounded-0">HOTELS</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#tours" class="nav-link  rounded-0">TOURS</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#movilid" class="nav-link  rounded-0">MOVILID</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#represent" class="nav-link  rounded-0">REPRESENT</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#entrances" class="nav-link  rounded-0">ENTRANCES</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#food" class="nav-link  rounded-0">FOOD</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#trains" class="nav-link  rounded-0">TRAINS</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#flights" class="nav-link  rounded-0">FLIGHTS</a></li>
            <li class="nav-item "><a data-toggle="tab" href="#others" class="nav-link  rounded-0">OTHERS</a></li>
        </ul>
        <div class="tab-content">
            <div id="hotels" class="tab-pane fade show active">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                    <tr>
                        <th width="110px" class="text-center px-0">FECHA USO</th>
                        <th width="110px" class="text-center px-0">FECHA PAGO</th>
                        <th class="text-center px-0">PAX</th>
                        <th class="text-center px-0">PROVEEDOR</th>
                        <th width="150px" class="text-center px-0">HOTEL</th>
                        <th class="text-center px-0"><sup>$</sup>AD</th>
                        <th class="text-center px-0 alert-success">TOTAL</th>
                        <th class="text-center px-0">SITUACION</th>
                        {{--  <th>NRO OPERACION</th>  --}}
                        <th class="text-center px-0">PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="9"><b>TOURS</b></td></tr>
                    @php
                        $total_hotel=0;
                    @endphp
                    @foreach ($array_cotizaciones_hotel as $array_)
                        @php
                            $total_hotel+=round($array_['personas_s']*$array_['precio_s'],2)+round($array_['personas_d']*$array_['precio_d'],2)+round($array_['personas_m']*$array_['precio_m'],2)+round($array_['personas_t']*$array_['precio_t'],2);
                        @endphp
                        <tr>
                            <td>{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                            <td>{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                            <td><b class="text-dark">{{$array_['pax']}}</b></td>
                            <td><b class="text-dark">{{$array_['proveedor']}}</b></td>  
                            <td width="150px mx-0 px-0">
                                <div class="row mx-0 px-0">
                                    <div class="col-5 mx-0 px-0 text-center">
                                        <b>{{$array_['estrellas']}} <i class="fas fa-star"></i></b>
                                    </div>
                                    <div class="col-7 mx-0 px-0">
                                        @if ($array_['personas_s']!='0')
                                            <p>{{$array_['personas_s']}} <i class="fas fa-bed"></i></p>
                                        @endif
                                        @if ($array_['personas_d']!='0')
                                            <p>{{$array_['personas_d']}} <i class="fas fa-bed"></i><i class="fas fa-bed"></i></p>
                                        @endif
                                        @if ($array_['personas_m']!='0')
                                            <p>{{$array_['personas_m']}} <i class="fas fa-venus-mars"></i></p>
                                        @endif
                                        @if ($array_['personas_t']!='0')
                                            <p>{{$array_['personas_t']}} <i class="fas fa-bed"></i><i class="fas fa-bed"></i><i class="fas fa-bed"></i></p>
                                        @endif
                                    </div>
                                </div>
                            </td>  
                            <td class="text-right">
                                @if ($array_['personas_s']!='0')
                                    <p><b><sup>$</sup>{{number_format($array_['precio_s'],2)}}</b></p>
                                @endif
                                @if ($array_['personas_d']!='0')
                                    <p><b><sup>$</sup>{{number_format($array_['precio_d'],2)}}</b></p>
                                @endif
                                @if ($array_['personas_m']!='0')
                                    <p><b><sup>$</sup>{{number_format($array_['precio_m'],2)}}</b></p>
                                @endif
                                @if ($array_['personas_t']!='0')
                                    <p><b><sup>$</sup>{{number_format($array_['precio_t'],2)}}</b></p>
                                @endif
                            </td>    
                            <td class="text-right alert-success">
                                    @if ($array_['personas_s']!='0')
                                    <p><b><sup>$</sup>{{number_format($array_['personas_s']*$array_['precio_s'],2)}}</b></p>
                                @endif
                                @if ($array_['personas_d']!='0')
                                    <p><b><sup>$</sup>{{number_format($array_['personas_d']*$array_['precio_d'],2)}}</b></p>
                                @endif
                                @if ($array_['personas_m']!='0')
                                    <p><b><sup>$</sup>{{number_format($array_['personas_m']*$array_['precio_m'],2)}}</b></p>
                                @endif
                                @if ($array_['personas_t']!='0')
                                    <p><b><sup>$</sup>{{number_format($array_['personas_t']*$array_['precio_t'],2)}}</b></p>
                                @endif    
                            </td>    
                            <td>
                                <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                            </td>    
                            <td>
                                <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                            </td>
                        </tr>
                    @endforeach
                    <tr class="text-15">
                        <td colspan="6"><b>TOTAL</b></td>
                        <td class="text-dark"><b><sup>$</sup>{{number_format($total_hotel,2)}}</b></td>
                    </tr>
                    <tr class="d-none">
                        <td colspan="8"><b>GRAN TOTAL</b></td>
                        <td colspan="3" class=""><b><sup>$</sup>{{number_format($total_hotel,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="tours" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                    <tr>
                        <th width="80px" class="text-center px-0">FECHA USO</th>
                        <th width="80px" class="text-center px-0">FECHA PAGO</th>
                        <th class="text-center px-0">TOURS</th>
                        <th class="text-center px-0">CLASE</th>
                        <th class="text-center px-0">AD</th>
                        <th class="text-center px-0">PAX</th>
                        <th class="text-center px-0">PROVEEDOR</th>
                        <th class="text-center px-0"><sup>$</sup>AD</th>
                        <th class="text-center px-0 alert-success">TOTAL</th>
                        <th class="text-center px-0">SITUACION</th>
                        {{--  <th>NRO OPERACION</th>  --}}
                        <th class="text-center px-0">PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>TOURS</b></td></tr>
                    @php
                        $total_tours=0;
                    @endphp
                    @foreach ($array_cotizaciones_tours as $array_)
                        @php
                            $total_tours+=round($array_['total'],2);
                        @endphp
                        <tr>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                            <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                            <td class="px-0 text-left">{{$array_['clase']}}</td>
                        
                            <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                            <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                            <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                            <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                            <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                            </td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                            </td>      
                        </tr>
                    @endforeach
                    <tr class="text-15">
                        <td colspan="8"><b>TOTAL</b></td>
                        <td class="text-dark"><b><sup>$</sup>{{number_format($total_tours,2)}}</b></td>
                    </tr>
                    <tr class="d-none">
                        <td colspan="8"><b>GRAN TOTAL</b></td>
                        <td colspan="3" class=""><b><sup>$</sup>{{number_format($total_tours,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="movilid" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                    <tr>
                        <th width="80px" class="text-center px-0">FECHA USO</th>
                        <th width="80px" class="text-center px-0">FECHA PAGO</th>
                        <th class="text-center px-0">MOVILID</th>
                        <th class="text-center px-0">CLASE</th>
                        <th class="text-center px-0">AD</th>
                        <th class="text-center px-0">PAX</th>
                        <th class="text-center px-0">PROVEEDOR</th>
                        <th class="text-center px-0"><sup>$</sup>AD</th>
                        <th class="text-center px-0 alert-success">TOTAL</th>
                        <th class="text-center px-0">SITUACION</th>
                        {{--  <th>NRO OPERACION</th>  --}}
                        <th class="text-center px-0">PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>MOVILID</b></td></tr>
                    @php
                        $total_movilid=0;
                    @endphp
                    @foreach ($array_cotizaciones_movilid as $array_)
                        @php
                            $total_movilid+=round($array_['total'],2);
                        @endphp
                        <tr>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                            <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                            <td class="px-0 text-left">
                                @php
                                  $clase_dato=explode('_',$array_['clase']);
                                @endphp
                                {{$clase_dato[0]}} <span class="text-primary">[{{$clase_dato[1]}}]</span> 
                            </td>
                            <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                            <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                            <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                            <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                            <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                            </td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                            </td>      
                        </tr>
                    @endforeach
                    <tr class="text-15">
                        <td colspan="8"><b>TOTAL</b></td>
                        <td class="text-dark"><b><sup>$</sup>{{number_format($total_movilid,2)}}</b></td>
                    </tr>
                    <tr class="d-none">
                        <td colspan="8"><b>GRAN TOTAL</b></td>
                        <td class=""><b><sup>$</sup>{{number_format($total_movilid,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="represent" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                    <tr>
                        <th width="80px" class="text-center px-0">FECHA USO</th>
                        <th width="80px" class="text-center px-0">FECHA PAGO</th>
                        <th class="text-center px-0">FOOD</th>
                        <th class="text-center px-0">CLASE</th>
                        <th class="text-center px-0">AD</th>
                        <th class="text-center px-0">PAX</th>
                        <th class="text-center px-0">PROVEEDOR</th>
                        <th class="text-center px-0"><sup>$</sup>AD</th>
                        <th class="text-center px-0 alert-success">TOTAL</th>
                        <th class="text-center px-0">SITUACION</th>
                        {{--  <th>NRO OPERACION</th>  --}}
                        <th class="text-center px-0">PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>REPRESENT</b></td></tr>
                    @php
                        $total_represent=0;
                    @endphp
                    @foreach ($array_cotizaciones_represent as $array_)
                    @php
                    $total_represent+=round($array_['total'],2);
                    @endphp
                    <tr>
                        <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                        <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                        <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                        <td class="px-0 text-left">{{$array_['clase']}}</td>
                        <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                        <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                        <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                        <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                        <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                        <td class="px-0 text-center">
                            <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                        </td>    
                        <td class="px-0 text-center">
                            <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                        </td>
                    </tr>
                    @endforeach
                    <tr class="text-15">
                        <td colspan="8"><b>TOTAL</b></td>
                        <td colspan="3"  class="text-dark"><b><sup>$</sup>{{number_format($total_represent,2)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="8"><b>GRAN TOTAL</b></td>
                        <td colspan="3" class=""><b><sup>$</sup>{{number_format($total_represent,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="entrances" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                        <tr>
                            <th width="80px" class="text-center px-0">FECHA USO</th>
                            <th width="80px" class="text-center px-0">FECHA PAGO</th>
                            <th class="text-center px-0">ENTRADA</th>
                            <th class="text-center px-0">AD</th>
                            <th class="text-center px-0">PAX</th>
                            <th class="text-center px-0">PROVEEDOR</th>
                            <th class="text-center px-0"><sup>$</sup>AD</th>
                            <th class="text-center px-0 alert-success">TOTAL</th>
                            <th class="text-center px-0">SITUACION</th>
                            {{--  <th>NRO OPERACION</th>  --}}
                            <th class="text-center px-0">PRIORIDAD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>LIQUIDACION DE BOLETOS TURISTICOS</b></td></tr>
                        @php
                            $total_btg=0;
                        @endphp
                        @foreach ($array_cotizaciones_entrances as $array_)
                            @if($array_['clase']=='BTG')    
                                @php
                                    $total_btg+=round($array_['total'],2);
                                @endphp
                                <tr>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                                    <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                                    <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                                    <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                                    <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                                    <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                                    <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                                    </td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                                    </td>
                                </tr>
                            @endif         
                        @endforeach
                        <tr class="text-15">
                            <td colspan="7"><b>TOTAL</b></td>
                            <td class="text-dark text-right"><b><sup>$</sup>{{number_format($total_btg,2)}}</b></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>LIQUIDACION DE INGRESO A CATEDRAL</b></td></tr>
                        @php
                            $total_cat=0;
                        @endphp
                        @foreach ($array_cotizaciones_entrances as $array_)
                            @if($array_['clase']=='CAT')    
                                @php
                                    $total_cat+=round($array_['total'],2);
                                @endphp
                                <tr>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                                    <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                                    <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                                    <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                                    <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                                    <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                                    <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                                    </td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                                    </td>
                                </tr>
                            @endif         
                        @endforeach
                        <tr class="text-15">
                            <td colspan="7"><b>TOTAL</b></td>
                            <td class="text-dark text-right"><b><sup>$</sup>{{number_format($total_cat,2)}}</b></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>LIQUIDACION DE INGRESO AL KORICANCHA</b></td></tr>
                        @php
                            $total_kori=0;
                        @endphp
                        @foreach ($array_cotizaciones_entrances as $array_)
                            @if($array_['clase']=='KORI')    
                                @php
                                    $total_kori+=round($array_['total'],2);
                                @endphp
                                <tr>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                                    <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                                    <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                                    <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                                    <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                                    <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                                    <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                                    </td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                                    </td>    
                                </tr>
                            @endif         
                        @endforeach
                        <tr class="text-15">
                            <td colspan="7"><b>TOTAL</b></td>
                            <td class="text-dark text-right"><b><sup>$</sup>{{number_format($total_kori,2)}}</b></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>LIQUIDACION DE INGRESO A MACHUPICCHU</b></td></tr>
                        @php
                            $total_mapi=0;
                        @endphp
                        @foreach ($array_cotizaciones_entrances as $array_)
                            @if($array_['clase']=='MAPI')    
                                @php
                                    $total_mapi+=round($array_['total'],2);
                                @endphp
                                <tr>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                                    <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                                    <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                                    <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                                    <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                                    <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                                    <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                                    </td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                                    </td>          
                                </tr>
                            @endif         
                        @endforeach
                        <tr class="text-15">
                            <td colspan="7"><b>TOTAL</b></td>
                            <td class="text-dark text-right"><b><sup>$</sup>{{number_format($total_mapi,2)}}</b></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>ENTRADAS OTROS</b></td></tr>
                        @php
                            $total_otros=0;
                        @endphp
                        @foreach ($array_cotizaciones_entrances as $array_)
                            @if($array_['clase']=='OTROS')    
                                @php
                                    $total_otros+=round($array_['total'],2);
                                @endphp
                                <tr>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                                    <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                                    <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                                    <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                                    <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                                    <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                                    <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                                    </td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                                    </td>           
                                </tr>
                            @endif         
                        @endforeach
                        <tr class="text-15">
                            <td colspan="7"><b>TOTAL</b></td>
                            <td class="text-dark text-right"><b><sup>$</sup>{{number_format($total_otros,2)}}</b></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bg-dark text-white text-15" ><td colspan="10"><b>ENTRADAS BUSES</b></td></tr>
                        @php
                            $total_buses=0;
                        @endphp
                        @foreach ($array_cotizaciones_entrances as $array_)
                            @if($array_['clase']=='BOLETO')    
                                @php
                                    $total_buses+=round($array_['total'],2);
                                @endphp
                                <tr>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                                    <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                                    <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                                    <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                                    <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                                    <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                                    <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                                    <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                                    </td>    
                                    <td class="px-0 text-center">
                                        <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                                    </td>           
                                </tr>
                            @endif         
                        @endforeach
                        <tr class="text-15">
                            <td colspan="7"><b>TOTAL</b></td>
                            <td class="text-dark text-right"><b><sup>$</sup>{{number_format($total_buses,2)}}</b></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="text-15">
                            <td colspan="7"><b>GRAN TOTAL</b></td>
                            <td colspan="3" class=""><b><sup>$</sup>{{number_format($total_btg+$total_cat+$total_kori+$total_mapi+$total_otros+$total_buses,2)}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="food" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                    <tr>
                        <th width="80px" class="text-center px-0">FECHA USO</th>
                        <th width="80px" class="text-center px-0">FECHA PAGO</th>
                        <th class="text-center px-0">FOOD</th>
                        <th class="text-center px-0">CLASE</th>
                        <th class="text-center px-0">AD</th>
                        <th class="text-center px-0">PAX</th>
                        <th class="text-center px-0">PROVEEDOR</th>
                        <th class="text-center px-0"><sup>$</sup>AD</th>
                        <th class="text-center px-0 alert-success">TOTAL</th>
                        <th class="text-center px-0">SITUACION</th>
                        {{--  <th>NRO OPERACION</th>  --}}
                        <th class="text-center px-0">PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>FOOD</b></td></tr>
                    @php
                        $total_food=0;
                    @endphp
                    @foreach ($array_cotizaciones_food as $array_)
                        @php
                            $total_food+=round($array_['total'],2);
                        @endphp
                        <tr>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                            <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                            <td class="px-0 text-left">{{$array_['clase']}}</td>
                            <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                            <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                            <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                            <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                            <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                            </td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                            </td>             
                        </tr>
                    @endforeach
                    <tr class="text-15">
                        <td colspan="8"><b>TOTAL</b></td>
                        <td class="text-dark"><b><sup>$</sup>{{number_format($total_food,2)}}</b></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="d-none">
                        <td colspan="8"><b>GRAN TOTAL</b></td>
                        <td colspan="3" class=""><b><sup>$</sup>{{number_format($total_food,2)}}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="trains" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                    <tr>
                        <th width="80px" class="text-center px-0">FECHA USO</th>
                        <th width="80px" class="text-center px-0">FECHA PAGO</th>
                        <th class="text-center px-0">TREN</th>
                        <th class="text-center px-0">SAL - LLEG</th>
                        <th class="text-center px-0">AD</th>
                        <th class="text-center px-0">PAX</th>
                        <th class="text-center px-0">PROVEEDOR</th>
                        <th class="text-center px-0"><sup>$</sup>AD</th>
                        <th class="text-center px-0 alert-success">TOTAL</th>
                        <th class="text-center px-0">SITUACION</th>
                        {{--  <th>NRO OPERACION</th>  --}}
                        <th class="text-center px-0">PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>ENTRADAS DE TRENES</b></td></tr>
                    @php
                        $total_train=0;
                    @endphp
                    @foreach ($array_cotizaciones_trains as $array_)
                        @php
                            $total_train+=round($array_['total'],2);
                        @endphp
                        <tr>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                            <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                            <td class="px-0 text-left">{{$array_['horario']}}</td>
                            <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                            <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                            <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                            <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                            <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                            </td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                            </td>        
                        </tr>
                    @endforeach
                    <tr class="text-15">
                        <td colspan="8"><b>TOTAL</b></td>
                        <td class="text-dark"><b><sup>$</sup>{{number_format($total_train,2)}}</b></td>
                        <td colspan="2"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="flights" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                    <tr>
                        <th width="80px" class="text-center px-0">FECHA USO</th>
                        <th width="80px" class="text-center px-0">FECHA PAGO</th>
                        <th class="text-center px-0">FLIGHTS</th>
                        <th class="text-center px-0">CLASE</th>
                        <th class="text-center px-0">AD</th>
                        <th class="text-center px-0">PAX</th>
                        <th class="text-center px-0">PROVEEDOR</th>
                        <th class="text-center px-0"><sup>$</sup>AD</th>
                        <th class="text-center px-0 alert-success">TOTAL</th>
                        <th class="text-center px-0">SITUACION</th>
                        {{--  <th>NRO OPERACION</th>  --}}
                        <th class="text-center px-0">PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>FLIGHTS</b></td></tr>
                    @php
                        $total_flight=0;
                    @endphp
                    @foreach ($array_cotizaciones_flights as $array_)
                        @php
                            $total_flight+=round($array_['total'],2);
                        @endphp
                        <tr>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                            <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                            <td class="px-0 text-left">{{$array_['aerolinea']}}</td>
                            <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                            <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                            <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                            <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                            <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                            </td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                            </td>           
                        </tr>
                    @endforeach
                    <tr class="text-15">
                        <td colspan="8"><b>TOTAL</b></td>
                        <td class="text-dark"><b><sup>$</sup>{{number_format($total_flight,2)}}</b></td>
                        <td colspan="2"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="others" class="tab-pane fade show ">
                <table class="table table-striped table-hover table-bordered table-responsive table-condensed mt-2 text-12">
                    <thead>
                    <tr>
                        <th width="80px" class="text-center px-0">FECHA USO</th>
                        <th width="80px" class="text-center px-0">FECHA PAGO</th>
                        <th class="text-center px-0">SERVICIO</th>
                        <th class="text-center px-0">CLASE</th>
                        <th class="text-center px-0">AD</th>
                        <th class="text-center px-0">PAX</th>
                        <th class="text-center px-0">PROVEEDOR</th>
                        <th class="text-center px-0"><sup>$</sup>AD</th>
                        <th class="text-center px-0 alert-success">TOTAL</th>
                        <th class="text-center px-0">SITUACION</th>
                        {{--  <th>NRO OPERACION</th>  --}}
                        <th class="text-center px-0">PRIORIDAD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-dark text-white text-15" ><td colspan="11"><b>SERVICIO</b></td></tr>
                    @php
                        $total_others=0;
                    @endphp
                    @foreach ($array_cotizaciones_others as $array_)
                        @php
                            $total_others+=round($array_['total'],2);
                        @endphp
                        <tr>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_uso'])}}</td>
                            <td class="px-0 text-center">{{MisFunciones::fecha_peru($array_['fecha_venc'])}}</td>
                            <td class="px-0"><b class="text-dark">{{$array_['nombre']}}</b></td>
                            <td class="px-0 text-left">{{$array_['clase']}}</td>
                            <td class="px-0 text-center"><b>{{$array_['ad']}}</b></td>    
                            <td class="px-0 text-center"><b class="text-dark">{{$array_['pax']}}</b></td>
                            <td class="px-0 text-left"><b class="text-dark">{{$array_['proveedor']}}</b></td>    
                            <td class="px-1 text-right"><b><sup>$</sup>{{$array_['ads']}}</b></td>    
                            <td class="px-1 text-right alert-success"><b><sup>$</sup>{{$array_['total']}}</b></td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['situacion']=='NO ENVIADO') {{'badge-dark'}}@elseif($array_['situacion']=='PAGADO') {{'badge-success'}}) @elseif($array_['situacion']=='POR PAGAR') {{'badge-success'}} @endif">{{$array_['situacion']}}</span>
                            </td>    
                            <td class="px-0 text-center">
                                <span class="badge @if($array_['proridad']=='NORMAL') {{'badge-dark'}}@elseif($array_['proridad']=='URGENTE') {{'badge-danger'}}) @endif">{{$array_['proridad']}}</span>       
                            </td>        
                        </tr>
                    @endforeach
                    <tr class="text-15">
                        <td colspan="8"><b>TOTAL</b></td>
                        <td class="text-dark"><b><sup>$</sup>{{number_format($total_others,2)}}</b></td>
                        <td colspan="2"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>