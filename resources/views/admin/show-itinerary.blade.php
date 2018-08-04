@extends('.layouts.admin.admin')
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Inventory</li>
                    <li>Itineraries</li>
                    <li class="active "><i class="fa fa-pencil-square-o text-warning" aria-hidden="true"></i> Edit</li>
                </ol>
            </div>
            <form action="{{route('package_edit_path')}}" method="post" id="package_new_path_id">
                <input type="hidden" id="tipo_plantilla" value="no">
                <div class="row">
                    <div class="col-md-1">
                        <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span></h4>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="txt_day">Duracion</label>
                            <input type="number" class="form-control" id="txt_day" name="txt_day" placeholder="Days" min="0" onchange="calcular_resumen_edit()"  value="{{$itinerary->duracion}}" readonly="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="txt_code">Code</label>
                            <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Code" value="{{$itinerary->codigo}}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6 d-none">
                        <div class="form-group">
                            <label for="txt_title">Title</label>
                            <input type="text" class="form-control" id="txt_title" name="txt_title" placeholder="Title"  value="{{$itinerary->titulo}}">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="txta_description">Titulo</label>
                        <input type="text" class="form-control" id="txta_description" name="txta_description" placeholder="Descripcion"  value="{{$itinerary->descripcion}}">
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-green-goto">
                                <input class="destinospack" type="checkbox" name="strellas_2" id="strellas_2" value="2" onchange="filtrar_estrellas()" checked>
                                2 STARS
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-green-goto">
                                <input class="destinospack" type="checkbox" name="strellas_3" id="strellas_3" value="3" onchange="filtrar_estrellas()" checked>
                                3 STARS
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-green-goto">
                                <input class="destinospack" type="checkbox" name="strellas_4" id="strellas_4" value="4" onchange="filtrar_estrellas()" checked>
                                4 STARS
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-green-goto">
                                <input class="destinospack" type="checkbox" name="strellas_5" id="strellas_5" value="5" onchange="filtrar_estrellas()" checked>
                                5 STARS
                            </label>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col-md-1">
                        <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">2</span></h4>

                    </div>
                    <div class="col-sm-11">
                        {{csrf_field()}}
                        @php
                            $arra_destinos=array();
                            $deti='';
                        @endphp
                        @foreach($itinerary->itinerarios as $itinerario)
                            @foreach($itinerario->destinos as $destino)
                                @php
                                    $arra_destinos[$destino->id]=$destino->destino;
                                @endphp
                            @endforeach
                        @endforeach

                        @foreach($destinos as $destino)
                                @if(in_array($destino->destino,$arra_destinos))
                                    <div class="col-md-3">
                                        <div class="checkbox1">
                                            <label class=" text-green-goto">
                                                <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->id}}_{{$destino->destino}}" onchange="filtrar_itinerarios()" checked>
                                                {{$destino->destino}}
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                        <div class="checkbox1">
                                            <label class=" text-green-goto">
                                                <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->id}}_{{$destino->destino}}" onchange="filtrar_itinerarios()">
                                                {{$destino->destino}}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                    @php
                                        $deti.=$destino->id.'/';
                                    @endphp
                        @endforeach
                        @php
                            $deti=substr($deti,0,strlen($deti)-1);
                        @endphp
                    </div>
                </div>
                <input type="hidden" id="desti" value="{{$deti}}">
                <div class="divider"></div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">3</span> Itinerary</h4>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class='col-md-12 box-list-book2'>
                            <li value="0" class="borar_stetica">
                                <ol id="Lista_itinerario_g" class='simple_with_animation vertical no-padding no-margin'>
                                    @php
                                        $iti_precio=0;
                                        $nroItinerario=0;
                                    @endphp
                                    @foreach($itinerary->itinerarios as $itinerario)
                                        @php
                                            $iti_id=0;
                                            $existextitle=-1;
                                            $existexid=-1;
                                            $existexservicios=-1;
                                            $titulo='';
                                            $mensaje='';
                                        @endphp
                                        @if(strlen(trim($itinerario->titulo))>0)
                                            @php
                                                $searchByTitle=$itinerarios->where('titulo',$itinerario->titulo)->count();
                                            @endphp
                                            @if($searchByTitle>0)
                                                @php
                                                    $existextitle=1;
                                                @endphp
                                            @elseif($searchByTitle==0)
                                                @php
                                                    $existextitle=0;
                                                    $searchById=$itinerarios->where('id',$itinerario->m_itinerario_id)->count();
                                                @endphp
                                                @if($searchById>0)
                                                    @php
                                                        $existexid=1;
                                                    @endphp
                                                    {{--buscar que todos los servicios esten presentes--}}
                                                    @php
                                                        $lista_servicios=$itinerarios->where('id',$itinerario->m_itinerario_id)->get();
                                                    @endphp
                                                    @foreach($lista_servicios->serivicios->where('m_servicios_id',$m_servicios->id) as $servicio)

                                                    @endforeach
                                                @elseif($searchById==0)
                                                    @php
                                                        $existexid=0;
                                                        $existexservicios=1;
                                                    @endphp
                                                @endif
                                            @endif

                                        @endif
                                                {{--@foreach($itinerarios->where('titulo',$itinerario->titulo)->take(1) as $itinerario_)--}}
                                                    {{--@if(strlen(trim($itinerario->titulo))>0)--}}
                                                        {{--@if(trim(strtoupper($itinerario->titulo))==trim(strtoupper($itinerario_->titulo)))--}}
                                                            {{--@php--}}
                                                                {{--$iti_id=$itinerario_->id;--}}
                                                            {{--@endphp--}}
                                                    {{--@break--}}
                                                {{--@endif--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                        @php
                                            $itinerario_total=0;
                                            $nroItinerario++;
                                        @endphp
                                        @foreach($itinerario->serivicios as $serivicios)
                                            @php
                                                $itinerario_total+=$serivicios->precio;
                                            @endphp
                                        @endforeach
                                        @php
                                            $iti_precio+=$itinerario_total;
                                        @endphp

                                        <li class="content-list-book" id="content-list-{{$iti_id}}" value="{{$iti_id}}">
                                            <div class="content-list-book-s">
                                                    <strong>
                                                        <input type="hidden" class="servicios_new" name="servicios_new_" value="{{$iti_id}}">
                                                        <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                                        <input type="hidden" name="itinerarios_1[]" value="{{$itinerario_total}}">
                                                        <input type="hidden" name="itinerarios_2[]" value="{{$itinerario->m_itinerario_id}}">
                                                        <span class="itinerarios_1 d-none">{{$itinerario_total}}</span>
                                                        <span class="txt_itinerarios d-none" name="itinerarios1">{{$iti_id}}</span>
                                                        <b class="dias_iti_c2" id="dias_' + total_Itinerarios + '">Dia {{$itinerario->dias}}:</b>
                                                        <b id="titulo_{{$itinerario->id}}">{{$itinerario->titulo}}
                                                        @if($existextitle==0)
                                                            <span class="text-info text-12">Se cambio el titulo, <i class="text-primary puntero" onclick="actualizar_titulo('{{$itinerario->id}}','{{$itinerario->m_itinerario_id}}')">Actualizar</i>
                                                            </span>
                                                        @elseif($existexid==0)
                                                            <span class="text-danger text-12">Este "Day By day" no existe, cambiar por otro similar</span>
                                                        @elseif($existexservicios==0)
                                                            <span class="text-warning text-12">El "Day By day" tuvo cambios en sus servicios, revisar</span>
                                                        @endif
                                                        </b>
                                                    </strong>
                                                    <small>
                                                        {{$itinerario_total}} $
                                                    </small>

                                                <div class="icon">
                                                     <a class="text-right" href="#!" onclick="eliminar_iti('{{$iti_id}}','{{$itinerario_total}}')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <b class="font-montserrat">COST WITHOUT HOTELS $ <label  id="totalItinerario_front">{{$iti_precio}}</label> P.P</b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a href="#!" class="btn btn-primary" onclick="Pasar_datos()"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-md-5" style="height: 500px; overflow-y: auto;">
                        <div id="lista_itinerarios">
                            @php
                                $pos_itinerario=0;
                                $mostrar_servi='';
                            @endphp
                            @foreach($destinos->sortBy('destino') as $destino)
                                @php
                                    $mostrar_servi='d-none';
                                @endphp
                                @if(in_array($destino->destino,$arra_destinos))
                                    @php
                                        $mostrar_servi='';
                                    @endphp
                                @endif
                                <div id="group_destino_{{$destino->id}}" class="{{$mostrar_servi}}">
                                    <div class="row">
                                        <b class="font-montserrat text-orange-goto text-20">{{$destino->destino}}</b>
                                    </div>
                                    @foreach($itinerarios_d->where('destino', $destino->destino) as $iti)
                                        @foreach($itinerarios->where('id',$iti->m_itinerario_id) as $itinerario)
                                            <div id="itinerario{{$itinerario->id}}" class="row margin-bottom-0">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <?php
                                                            $servicios1='';
                                                            $precio_iti=0;
                                                            $destinos_iti='';
                                                            ?>
                                                            @foreach($itinerario->itinerario_itinerario_servicios as $servicios)
                                                                <?php
                                                                if($servicios->itinerario_servicios_servicio->grupo!='HOTELS'){
                                                                    if($servicios->itinerario_servicios_servicio->precio_grupo==1){
                                                                        $precio_iti+=ceil($servicios->itinerario_servicios_servicio->precio_venta/2);
                                                                        $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.ceil($servicios->itinerario_servicios_servicio->precio_venta/2).'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';
                                                                    }
                                                                    else{
                                                                        $precio_iti+=$servicios->itinerario_servicios_servicio->precio_venta;
                                                                        $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.$servicios->itinerario_servicios_servicio->precio_venta.'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';

                                                                    }
                                                                }
                                                                ?>
                                                            @endforeach
                                                            @foreach($itinerario->destinos as $destino)
                                                                <?php
                                                                $destinos_iti.=$destino->destino.'*';
                                                                ?>
                                                            @endforeach
                                                            <?php
                                                            $destinos_iti=substr($destinos_iti,0,strlen($destinos_iti)-1);
                                                            $servicios1=substr($servicios1,0,strlen($servicios1)-1);
                                                            ?>
                                                            <input class="itinerario" type="checkbox" aria-label="..." name="itinerarios[]" value="{{$itinerario->id}}_{{$destinos_iti}}_{{$itinerario->titulo}}_a_{{$precio_iti}}_s">
                                                        </span>
                                                        <input type="text" class="form-control" aria-label="..." value="{{$itinerario->titulo}}" readonly>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse_{{$itinerario->id}}"><b>${{$precio_iti}}</b> <i class="fa fa-arrows-v" aria-hidden="true"></i></button>
                                                        </span>
                                                    </div>
                                                    <div class="collapse clearfix" id="collapse_{{$itinerario->id}}">
                                                        <div class="col-md-12 well margin-top-5">
                                                            {{$itinerario->descripcion}}
                                                            <h5><b>Services</b></h5>
                                                            <table class="table table-condensed table-striped">
                                                                <thead>
                                                                    <tr class="bg-grey-goto text-white">
                                                                        <th colspan="2">Concepts</th>
                                                                        <th>Prices</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($itinerario->itinerario_itinerario_servicios as $servicios)
                                                                    <tr>
                                                                        <td>{{$servicios->itinerario_servicios_servicio->nombre}}</td>
                                                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                                                        <td>
                                                                            @if($servicios->itinerario_servicios_servicio->precio_grupo==1)
                                                                                {{ceil($servicios->itinerario_servicios_servicio->precio_venta/2)}}
                                                                            @else
                                                                                {{$servicios->itinerario_servicios_servicio->precio_venta}}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row margin-top-20">
                            <div class="col-md-12">
                                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">4</span> Include & Not include</h4>
                                <div class="divider margin-bottom-20"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> Default
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Personalize
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="txta_include">Include</label>
                                    <textarea class="form-control animated" id="txta_include" name="txta_include" rows="5">{{$itinerary->incluye}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center">
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions2" id="inlineRadio1" value="option1"> Default
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="option2" checked> Personalize
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="txta_notinclude">Not Include</label>
                                    <textarea class="form-control" id="txta_notinclude" name="txta_notinclude" rows="5">{{$itinerary->noincluye}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-20 ">
                            <div class="col-md-12">
                                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">5</span> Hotels</h4>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <?php
                                $amount_s2=0;
                                $amount_d2=0;
                                $amount_m2=0;
                                $amount_t2=0;
                                $amount_s3=0;
                                $amount_d3=0;
                                $amount_m3=0;
                                $amount_t3=0;
                                $amount_s4=0;
                                $amount_d4=0;
                                $amount_m4=0;
                                $amount_t4=0;
                                $amount_s5=0;
                                $amount_d5=0;
                                $amount_m5=0;
                                $amount_t5=0;
                                $hotel_id_2=0;
                                $hotel_id_3=0;
                                $hotel_id_4=0;
                                $hotel_id_5=0;
                                ?>
                                @foreach($itinerary as $$itinerary)
                                    @foreach($itinerary->precios as $precio)
                                        @if($precio->estrellas=="2")
                                            <?php
                                            $amount_s2=$precio->precio_s;
                                            $amount_d2=$precio->precio_d;
                                            $amount_m2=$precio->precio_m;
                                            $amount_t2=$precio->precio_t;
                                            $hotel_id_2=$precio->hotel_id;
                                            ?>
                                        @endif
                                        @if($precio->estrellas=="3")
                                            <?php
                                            $amount_s3=$precio->precio_s;
                                            $amount_d3=$precio->precio_d;
                                            $amount_m3=$precio->precio_m;
                                            $amount_t3=$precio->precio_t;
                                            $hotel_id_3=$precio->hotel_id;
                                            ?>
                                        @endif
                                        @if($precio->estrellas=="4")
                                            <?php
                                            $amount_s4=$precio->precio_s;
                                            $amount_d4=$precio->precio_d;
                                            $amount_m4=$precio->precio_m;
                                            $amount_t4=$precio->precio_t;
                                            $hotel_id_4=$precio->hotel_id;
                                            ?>
                                        @endif
                                        @if($precio->estrellas=="5")
                                            <?php
                                            $amount_s5=$precio->precio_s;
                                            $amount_d5=$precio->precio_d;
                                            $amount_m5=$precio->precio_m;
                                            $amount_t5=$precio->precio_t;
                                            $hotel_id_5=$precio->hotel_id;
                                            ?>
                                        @endif
                                    @endforeach
                                @endforeach
                                <table class="table table-condensed table-bordered font-montserrat">
                                    <caption class="text-right"><b>Price per night</b></caption>
                                    <thead>
                                    <tr class="bg-grey-goto-light text-white">
                                        <th class="text-center">Hotels</th>
                                        <th id="precio_2_t" class="text-center d-none">2 Stars</th>
                                        <th id="precio_3_t" class="text-center d-none">3 Stars</th>
                                        <th id="precio_4_t" class="text-center d-none">4 Stars</th>
                                        <th id="precio_5_t" class="text-center d-none">5 Stars</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td id="precio_t_2" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t2" name="amount_t2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t2}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td id="precio_t_3" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t3" name="amount_t3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t3}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td id="precio_t_4" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t4" name="amount_t4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t4}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td id="precio_t_5" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t5" name="amount_t5" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t5}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td id="precio_d_2" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d2" name="amount_d2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d2}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td id="precio_d_3" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d3" name="amount_d3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d3}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td id="precio_d_4" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d4" name="amount_d4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d4}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td  id="precio_d_5" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d5" name="amount_d5" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d5}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td id="precio_s_2" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s2" name="amount_s2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s2}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td id="precio_s_3" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s3" name="amount_s3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s3}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td id="precio_s_4" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s4" name="amount_s4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s4}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td id="precio_s_5" class="d-none">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s5" name="amount_s5" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s5}}">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row margin-top-20 d-none">
                            <div class="col-md-12">
                                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">6</span> Package Price</h4>
                                <div class="divider margin-bottom-20"></div>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col-md-3 ">
                                <div class="form-group margin-bottom-0">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">Profit</div>
                                        <input type="number" class="form-control text-right" id="profit_0" placeholder="Percent" onchange="cambiar_profit(0)" value="40" min="0">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-condensed table-bordered font-montserrat">
                                    <caption class="text-right"><b>Categories for stars</b></caption>
                                    <thead>
                                    <tr class="bg-grey-goto text-white">
                                        <th class="text-center"></th>
                                        <th class="text-center">2 Stars</th>
                                        <th class="text-center">3 Stars</th>
                                        <th class="text-center">4 Stars</th>
                                        <th class="text-center">5 Stars</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2">

                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">Profit</div>
                                                    <input type="number" class="form-control text-right" id="profit_2" name="profit_2" placeholder="Percent" onchange="calcular_resumen()" value="40" min="0">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">Profit</div>
                                                    <input type="number" class="form-control text-right" id="profit_3" name="profit_3" placeholder="Percent" onchange="calcular_resumen()" value="40" min="0">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">Profit</div>
                                                    <input type="number" class="form-control text-right" id="profit_4" name="profit_4" placeholder="Percent" onchange="calcular_resumen()" value="40" min="0">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">Profit</div>
                                                    <input type="number" class="form-control text-right" id="profit_5" name="profit_5" placeholder="Percent" onchange="calcular_resumen()" value="40" min="0">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-condensed table-bordered font-montserrat">
                                    <caption class="text-right"><b>Total price for Packages</b></caption>
                                    <thead>
                                    <tr class="bg-grey-goto text-white">
                                        <th class="text-center">Price Cost</th>
                                        <th class="text-center">2 Starss</th>
                                        <th class="text-center">3 Stars</th>
                                        <th class="text-center">4 Stars</th>
                                        <th class="text-center">5 Stars</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t2_c" name="amount_t2_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t3_c" name="amount_t3_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t4_c" name="amount_t4_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t5_c" name="amount_t5_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d2_c" name="amount_d2_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d3_c" name="amount_d3_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d4_c" name="amount_d4_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d5_c" name="amount_d5_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s2_c" name="amount_s2_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s3_c" name="amount_s3_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s4_c" name="amount_s4_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s5_c" name="amount_s5_c" placeholder="Amount" min="0" value="0">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-condensed table-bordered font-montserrat">
                                    <caption class="text-right"><b>Total price for Packages</b></caption>
                                    <thead>
                                    <tr class="bg-grey-goto text-white">
                                        <th class="text-center">Price Venta</th>
                                        <th  class="text-center">2 Stars</th>
                                        <th  class="text-center">3 Stars</th>
                                        <th  class="text-center">4 Stars</th>
                                        <th  class="text-center">5 Stars</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td id="precio_2_v">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t2_v" name="amount_t2_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t3_v" name="amount_t3_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t4_v" name="amount_t4_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t5_v" name="amount_t5_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d2_v" name="amount_d2_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d3_v" name="amount_d3_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d4_v" name="amount_d4_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d5_v" name="amount_d5_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s2_v" name="amount_s2_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s3_v" name="amount_s3_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s4_v" name="amount_s4_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s5_v" name="amount_s5_v" placeholder="Amount" min="0" value="0">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row margin-top-20">
                            <div class="col-md-12">
                                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">6</span> Resumen</h4>
                                <div class="divider margin-bottom-20"></div>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col-md-12">
                                <table class="table table-condensed table-bordered font-montserrat">
                                    <caption class="text-right"><b>Todos los precios tienen un 40% de utilidad y son para dos personas</b></caption>
                                    <thead>
                                    <tr class="bg-grey-goto-light text-white">
                                        <th class="text-center">Hotels</th>
                                        <th  class="text-center">2 Stars</th>
                                        <th  class="text-center">3 Stars</th>
                                        <th class="text-center">4 Stars</th>
                                        <th  class="text-center">5 Stars</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td id="precio_2_v">
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t2_u" name="amount_t2_u" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="{{$amount_t2}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t3_u" name="amount_t3_u" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="{{$amount_t3}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t4_u" name="amount_t4_u" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="{{$amount_t4}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_t5_u" name="amount_t5_u" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="{{$amount_t5}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d2_u" name="amount_d2_u" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="{{$amount_d2}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d3_u" name="amount_d3_u" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="{{$amount_d3}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d4_u" name="amount_d4_u" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="{{$amount_d4}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_d5_u" name="amount_d5_u" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="{{$amount_d5}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="col-md-2">
                                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s2_u" name="amount_s2_u" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="{{$amount_s2}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s3_u" name="amount_s3_u" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="{{$amount_s3}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s4_u" name="amount_s4_u" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="{{$amount_s4}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group margin-bottom-0">
                                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input type="number" class="form-control text-right" id="amount_s5_u" name="amount_s5_u" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="{{$amount_s5}}" readonly="readonly">
                                                    {{--<div class="input-group-addon">.00</div>--}}
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @php
                        $profit_2=40;
                        $profit_3=40;
                        $profit_4=40;
                        $profit_5=40;
                        @endphp
                        @foreach($itinerary->precios as $precio)
                            @if($precio->estrellas==2)
                                @php
                                    $profit_2=$precio->utilidad;
                                @endphp
                            @endif
                            @if($precio->estrellas==3)
                                @php
                                    $profit_3=$precio->utilidad;
                                @endphp
                            @endif
                            @if($precio->estrellas==4)
                                @php
                                    $profit_4=$precio->utilidad;
                                @endphp
                            @endif
                            @if($precio->estrellas==5)
                                @php
                                    $profit_5=$precio->utilidad;
                                @endphp
                            @endif
                        @endforeach

                        <div id="precio_2" class="row d-none">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-10">
                                        <b class="font-montserrat text-pink-goto">Precio 2 estrellas</b>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group has-success">
                                            <input type="number" id="profitt_4" name="profitt_4" class="form-control input-porcent text-right text-13" value="{{$profit_2}}" onchange="calcular_resumen()">
                                            <b class="input-group-addon input- text-success" id="basic-addon2">%</b>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-condensed font-montserrat">
                                    {{--<caption>table title and/or explanatory text</caption>--}}
                                    <thead>
                                    <tr>
                                        <th class="w-5"><b class="text-grey-goto-light">Per Person</b></th>
                                        <th class="w-25"></th>
                                        <th class="w-20 text-right"><b class="text-danger text-20">Cost</b></th>
                                        <th class="w-20 text-right"><b class="text-success text-20">Profit</b></th>
                                        <th class="w-20 text-right"><b class="text-pink-goto text-20">Price</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="w-5">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 text-left">
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t2_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t2_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t2_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr class="d-none">
                                        <td>
                                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m2_a"></span>.00</b>
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m2_a_p"></span>.00</b>
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m2_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 text-left">
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d2_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d2_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d2_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 ">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 ">
                                            <i class="fa fa-bed  text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s2_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s2_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s2_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 ">

                                        </td>
                                        <td class="w-25 ">

                                        </td>
                                        <td class="w-20  text-right text-13">
                                            <b class=" text-danger"><span id="porc_cost_4">60</span>%</b>
                                        </td>
                                        <td class="w-20 text-right text-13">
                                            <b class=" text-danger"><span id="porc_cost_4_copi">{{$profit_2}}</span>%</b>
                                        </td>
                                        <td class="w-20 text-right text-13">
                                            <b class="text-20 text-pink-goto">100%</b>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="precio_3" class="row d-none">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-10">
                                        <b class="font-montserrat text-pink-goto">Precio 3 estrellas</b>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group has-success">
                                            <input type="number" id="profitt_3" name="profitt_3" class="form-control input-porcent text-right text-13" value="{{$profit_3}}" onchange="calcular_resumen()">
                                            <b class="input-group-addon input- text-success" id="basic-addon2">%</b>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-condensed font-montserrat">
                                    {{--<caption>table title and/or explanatory text</caption>--}}
                                    <thead>
                                    <tr>
                                        <th class="w-5"><b class="text-grey-goto-light">Per Person</b></th>
                                        <th class="w-25"></th>
                                        <th class="w-20 text-right"><b class="text-danger text-20">Cost</b></th>
                                        <th class="w-20 text-right"><b class="text-success text-20">Profit</b></th>
                                        <th class="w-20 text-right"><b class="text-pink-goto text-20">Price</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="w-5">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 text-left">
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t3_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t3_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t3_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr class="d-none">
                                        <td>
                                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m3_a"></span>.00</b>
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m3_a_p"></span>.00</b>
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m3_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 text-left">
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d3_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d3_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d3_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 ">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 ">
                                            <i class="fa fa-bed  text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s3_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s3_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s3_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 ">

                                        </td>
                                        <td class="w-25 ">

                                        </td>
                                        <td class="w-20  text-right text-13">
                                            <b class=" text-danger"><span id="porc_cost_3">60</span>%</b>
                                        </td>
                                        <td class="w-20 text-right text-13">
                                            <b class=" text-danger"><span id="porc_cost_3_copi">{{$profit_3}}</span>%</b>
                                        </td>
                                        <td class="w-20 text-right text-13">
                                            <b class="text-20 text-pink-goto">100%</b>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="precio_4" class="row d-none">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-10">
                                        <b class="font-montserrat text-pink-goto">Precio 4 estrellas</b>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group has-success">
                                            <input type="number" id="profitt_4" name="profitt_4" class="form-control input-porcent text-right text-13" value="{{$profit_4}}" onchange="calcular_resumen()">
                                            <b class="input-group-addon input- text-success" id="basic-addon2">%</b>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-condensed font-montserrat">
                                    {{--<caption>table title and/or explanatory text</caption>--}}
                                    <thead>
                                    <tr>
                                        <th class="w-5"><b class="text-grey-goto-light">Per Person</b></th>
                                        <th class="w-25"></th>
                                        <th class="w-20 text-right"><b class="text-danger text-20">Cost</b></th>
                                        <th class="w-20 text-right"><b class="text-success text-20">Profit</b></th>
                                        <th class="w-20 text-right"><b class="text-pink-goto text-20">Price</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="w-5">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 text-left">
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t4_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t4_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t4_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr class="d-none">
                                        <td>
                                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m4_a"></span>.00</b>
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m4_a_p"></span>.00</b>
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m4_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 text-left">
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d4_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d4_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d4_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 ">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 ">
                                            <i class="fa fa-bed  text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s4_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s4_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s4_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 ">

                                        </td>
                                        <td class="w-25 ">

                                        </td>
                                        <td class="w-20  text-right text-13">
                                            <b class=" text-danger"><span id="porc_cost_4">60</span>%</b>
                                        </td>
                                        <td class="w-20 text-right text-13">
                                            <b class=" text-danger"><span id="porc_cost_4_copi">{{$profit_4}}</span>%</b>
                                        </td>
                                        <td class="w-20 text-right text-13">
                                            <b class="text-20 text-pink-goto">100%</b>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="precio_5" class="row d-none">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-10">
                                        <b class="font-montserrat text-pink-goto">Precio 5 estrellas</b>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group has-success">
                                            <input type="number" id="profitt_5" name="profitt_5" class="form-control input-porcent text-right text-13" value="{{$profit_5}}" onchange="calcular_resumen()">
                                            <b class="input-group-addon input- text-success" id="basic-addon2">%</b>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-condensed font-montserrat">
                                    {{--<caption>table title and/or explanatory text</caption>--}}
                                    <thead>
                                    <tr>
                                        <th class="w-5"><b class="text-grey-goto-light">Per Person</b></th>
                                        <th class="w-25"></th>
                                        <th class="w-20 text-right"><b class="text-danger text-20">Cost</b></th>
                                        <th class="w-20 text-right"><b class="text-success text-20">Profit</b></th>
                                        <th class="w-20 text-right"><b class="text-pink-goto text-20">Price</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="w-5">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 text-left">
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t5_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t5_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_t5_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr class="d-none">
                                        <td>
                                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m5_a"></span>.00</b>
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m5_a_p"></span>.00</b>
                                        </td>
                                        <td class="text-right">
                                            <b class="text-16">$ <span id="amount_m5_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 text-left">
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                            <i class="fa fa-bed text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d5_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d5_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_d5_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 ">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-25 ">
                                            <i class="fa fa-bed  text-green-goto" aria-hidden="true"></i>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s5_a"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s5_a_p"></span>.00</b>
                                        </td>
                                        <td class="w-20 text-right">
                                            <b class="text-12">$ <span id="amount_s5_a_v"></span>.00</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-5 ">

                                        </td>
                                        <td class="w-25 ">

                                        </td>
                                        <td class="w-20  text-right text-13">
                                            <b class=" text-danger"><span id="porc_cost_5">60</span>%</b>
                                        </td>
                                        <td class="w-20 text-right text-13">
                                            <b class=" text-danger"><span id="porc_cost_5_copi">{{$profit_5}}</span>%</b>
                                        </td>
                                        <td class="w-20 text-right text-13">
                                            <b class="text-20 text-pink-goto">100%</b>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col-md-12">
                                <div class="text-center">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txt_day">Total costo(without hotel)</label>
                                        <input type="number" class="form-control" id="totalItinerario" name="totalItinerario" min="0" value="{{$iti_precio}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 d-none">
                                    <div class="form-group">
                                        <label for="txt_day">Utilidad</label>
                                        <input type="number" class="form-control" id="txt_utilidad" name="txt_utilidad" min="0" value="0" onchange="calcular_utilidad()">
                                    </div>
                                </div>
                                <div class="col-md-3 d-none">
                                    <div class="form-group">
                                        <label for="txt_day">Total venta</label>
                                        <input type="number" class="form-control" id="totalItinerario_venta" name="totalItinerario_venta" min="0" value="0">
                                        <input type="number" class="form-control" id="nroItinerario" name="nroItinerario" min="0" value="{{$nroItinerario}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-20">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="paquete_id" id="paquete_id" value="{{$paquete_id}}">
                                <input type="hidden" name="hotel_id_2" value="{{$hotel_id_2}}">
                                <input type="hidden" name="hotel_id_3" value="{{$hotel_id_3}}">
                                <input type="hidden" name="hotel_id_4" value="{{$hotel_id_4}}">
                                <input type="hidden" name="hotel_id_5" value="{{$hotel_id_5}}">
                                <button type="submit" class="btn btn-lg btn-warning">Edit <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            filtrar_estrellas();
            calcular_resumen();
        } );
    </script>
    <script>
        var adjustment;
        $("ol.simple_with_animation").sortable({
            group: 'simple_with_animation',
            pullPlaceholder: false,
            tolerance: 6,
            // animation on drop
            onDrop: function  ($item, container, _super) {

                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                var s_cotizacion = $item.val();
                var s_porcentaje = $item.parent().parent().val();

                $item.animate($clonedItem.position(), function  () {
                    $clonedItem.detach();
                    _super($item, container);
                });

                var datos = {
                    "txt_cotizacion" : s_cotizacion,
                    "txt_porcentaje" : s_porcentaje
                };
                var cont=1;
                $(".dias_iti_c2").each(function (index) {
                    $(this).html('Dia '+cont+':');
                    cont++;
                });
            },

            // set $item relative to cursor position
            onDragStart: function ($item, container, _super) {

                var offset = $item.offset(),
                    pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                };

                _super($item, container);

            },
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                });

            }
        });
        CKEDITOR.replace('txta_include');
        CKEDITOR.replace('txta_notinclude');
    </script>
@stop