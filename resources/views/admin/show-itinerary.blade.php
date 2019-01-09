@extends('.layouts.admin.admin')
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Inventory</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Itineraries</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col-12">
            <form action="{{route('package_edit_path')}}" method="post" id="package_new_path_id">
                <input type="hidden" id="tipo_plantilla" value="no">
                <div class="row">
                    <div class="col-1">
                        <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">1</span>
                    </div>
                    <div class="col-5">
                        <div class="row">  
                            @foreach ($webs as $key => $item)
                                @php
                                    $existe=$paquete_paginas->where('p_paquete_id',$itinerary->id)->where('pagina',$item->pagina)->count('id');
                                @endphp
                                <div class="col-6">
                                    <label class="text-success">
                                        <input class="destinospack" type="checkbox" name="txt_pagina[]" value="{{$item->pagina}}" @if($existe>0) checked="checked" @endif>
                                        {{$item->pagina}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="txt_day" class="text-secondary font-weight-bold">Duracion</label>
                            <input type="number" class="form-control" id="txt_day" name="txt_day" placeholder="Days" min="0" onchange="calcular_resumen()"  value="{{$itinerary->duracion}}" >
                        </div>
                    </div>
                    {{-- <div class="col-2 @if($itinerary->pagina!='expedia.com') d-none @endif" id="txt_codigo_"> --}}
                    <div class="col-1" id="txt_codigo_">
                        <div class="form-group">
                            <label for="txt_code" class="text-secondary font-weight-bold">Code</label>
                            <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Code" value="{{$itinerary->codigo}}">
                        </div>
                    </div>

                    <div class="col-6 d-none">
                        <div class="form-group">
                            <label for="txt_title" class="text-secondary font-weight-bold">Title</label>
                            <input type="text" class="form-control" id="txt_title" name="txt_title" placeholder="Title"  value="{{$itinerary->titulo}}">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="txta_description" class="text-secondary font-weight-bold">Titulo</label>
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
                <div class="row mt-3">
                    <div class="col-1">
                        <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">2</span>
                    </div>
                    <div class="col-11">
                        <div class="row">
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
                                    <div class="col-3">

                                            <label class="text-primary">
                                                <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->id}}_{{$destino->destino}}" onchange="filtrar_itinerarios()" checked>
                                                {{$destino->destino}}
                                            </label>

                                    </div>
                                @else
                                    <div class="col-3">
                                            <label class="text-primary">
                                                <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->id}}_{{$destino->destino}}" onchange="filtrar_itinerarios()">
                                                {{$destino->destino}}
                                            </label>
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
                </div>
                <input type="hidden" id="desti" value="{{$deti}}">
                <hr>
                <div class="row">
                    <div class="col-12">
                        <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">3</span> <i>Itinerary</i>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class=''>
                            <li value="0" class="borar_stetica">
                                <ol id="Lista_itinerario_g" class='simple_with_animation caja_sort'>
                                    @php
                                        $iti_precio=0;
                                        $nroItinerario=0;
                                    @endphp
                                    @foreach($itinerary->itinerarios as $itinerario)
                                        @php
                                            $iti_id=$itinerario->id;
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

                                        <li class="content-list-book" id="content-list-{{$iti_id}}">
                                            <div class="content-list-book-s">
                                                <a href="#!">
                                                    <strong>
                                                        {{-- {{dd($itinerario)}} --}}
                                                        <input type="hidden" class="servicios_new" name="servicios_new_" value="{{$iti_id}}">
                                                        <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                                        <input type="hidden" name="itinerarios_1[]" value="{{$itinerario_total}}">
                                                        <input type="hidden" name="itinerarios_2[]" value="{{$itinerario->m_itinerario_id}}">
                                                        <span class="itinerarios_1 d-none">{{$itinerario_total}}</span>
                                                        <span class="txt_itinerarios d-none" name="itinerarios1">{{$iti_id}}</span>
                                                        <span class="dias_iti_c2" id="dias_{{$nroItinerario}}">Dia {{$itinerario->dias}}:</span>
                                                        <span id="titulo_{{$itinerario->id}}" class="font-weight-bold">{{$itinerario->titulo}}
                                                            @if($existextitle==0)
                                                                <span class="text-info text-12">Se cambio el titulo, <i class="text-primary puntero" onclick="actualizar_titulo('{{$itinerario->id}}','{{$itinerario->m_itinerario_id}}')">Actualizar</i>
                                                            </span>
                                                            @elseif($existexid==0)
                                                                <span class="text-danger text-12">Este "Day By day" no existe, cambiar por otro similar</span>
                                                            @elseif($existexservicios==0)
                                                                <span class="text-warning text-12">El "Day By day" tuvo cambios en sus servicios, revisar</span>
                                                            @endif
                                                            @if(trim($itinerario->m_itinerario_id)=='')
                                                            <span class="text-danger text-12">Vuelva a agregar este dia</span>    
                                                            @endif
                                                        </span>
                                                    </strong>
                                                    <small class="text-primary">
                                                        {{$itinerario_total}} $
                                                    </small>
                                                </a>
                                                <div class="icon1">
                                                     <a class="text-right" href="#!" onclick="eliminar_iti('{{$iti_id}}','{{$itinerario_total}}')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                    <div class="col">
                                                        <table class="table table-bordered table-condensed table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th>Servicio</th>
                                                                    <th>Precio</th>
                                                                    <th>Estado</th>
                                                                </tr>   
                                                            </thead>
                                                            <tbody>   
                                                            @foreach($itinerario->serivicios as $serivicios)
                                                                @php
                                                                    $existe_serv=$m_servicios->where('id',$serivicios->m_servicios_id)->count();    
                                                                @endphp
                                                                <tr>
                                                                    <td>{{$serivicios->nombre}}</td>
                                                                    <td>{{$serivicios->precio}}</td>
                                                                    <td>
                                                                        @if ($existe_serv==0)
                                                                            <span class="badge badge-danger">Se ha borrado</span>
                                                                        @else
                                                                        <span class="badge badge-success">Existe</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>    
                                                    </div>    
                                                </div>    
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <b class="font-montserrat">COST WITHOUT HOTELS $ <label  id="totalItinerario_front">{{$iti_precio}}</label> P.P</b>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <a href="#!" class="btn btn-primary" onclick="Pasar_datos()"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-5">
                        <select class="form-control" name="destinos_busqueda" id="destinos_busqueda" onclick="buscar_day_by_day_edit($(this).val())">
                            <option value="0">Escoja un destino</option>
                            @foreach($destinos as $destino)
                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                            @endforeach
                        </select>
                        <div class="text-center align-middle col-12 margin-top-5" id="resultado_busqueda" style="height: 500px; overflow-y: auto;">

                        </div>
                    </div>
                </div>

                <hr>
                <div class="row mt-3">
                    <div class="col-12">
                        <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">4</span> <i>Included & Not included</i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-none text-center alert alert-primary my-3">
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> Default
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Personalize
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="txta_include" class="font-weight-bold text-secondary">Include {{$itinerary->duracion}}</label>
                                    <textarea class="form-control animated" id="txta_include" name="txta_include" rows="5">{{$itinerary->incluye}}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-none text-center alert alert-primary my-3">
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions2" id="inlineRadio1" value="option1"> Default
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="option2" checked> Personalize
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="txta_notinclude" class="font-weight-bold text-secondary">Not Include</label>
                                    <textarea class="form-control" id="txta_notinclude" name="txta_notinclude" rows="5">@php echo $itinerary->noincluye; @endphp</textarea>
                                </div>
                            </div>
                        </div>
                        <div id="resumen_2_dia" class="row @if($itinerary->duracion==1){{'d-none'}}@endif">
                            <div class="col">
                                <div class="row margin-top-20 ">
                                    <div class="col-md-12">
                                        <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">5</span> <i>Hotels</i>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
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
                                        $profit_t2=0;
                                        $profit_m2=0;
                                        $profit_d2=0;
                                        $profit_s2=0;
                                        $profit_t3=0;
                                        $profit_m3=0;
                                        $profit_d3=0;
                                        $profit_s3=0;
                                        $profit_t4=0;
                                        $profit_m4=0;
                                        $profit_d4=0;
                                        $profit_s4=0;
                                        $profit_t5=0;
                                        $profit_m5=0;
                                        $profit_d5=0;
                                        $profit_s5=0;
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
                                                    $profit_t2=$precio->utilidad_t;
                                                    $profit_m2=$precio->utilidad_m;
                                                    $profit_d2=$precio->utilidad_d;
                                                    $profit_s2=$precio->utilidad_s;
                                                    ?>
                                                @endif
                                                @if($precio->estrellas=="3")
                                                    <?php
                                                    $amount_s3=$precio->precio_s;
                                                    $amount_d3=$precio->precio_d;
                                                    $amount_m3=$precio->precio_m;
                                                    $amount_t3=$precio->precio_t;
                                                    $hotel_id_3=$precio->hotel_id;
                                                    $profit_t3=$precio->utilidad_t;
                                                    $profit_m3=$precio->utilidad_m;
                                                    $profit_d3=$precio->utilidad_d;
                                                    $profit_s3=$precio->utilidad_s;
                                                    ?>
                                                @endif
                                                @if($precio->estrellas=="4")
                                                    <?php
                                                    $amount_s4=$precio->precio_s;
                                                    $amount_d4=$precio->precio_d;
                                                    $amount_m4=$precio->precio_m;
                                                    $amount_t4=$precio->precio_t;
                                                    $hotel_id_4=$precio->hotel_id;
                                                    $profit_t4=$precio->utilidad_t;
                                                    $profit_m4=$precio->utilidad_m;
                                                    $profit_d4=$precio->utilidad_d;
                                                    $profit_s4=$precio->utilidad_s;
                                                    ?>
                                                @endif
                                                @if($precio->estrellas=="5")
                                                    <?php
                                                    $amount_s5=$precio->precio_s;
                                                    $amount_d5=$precio->precio_d;
                                                    $amount_m5=$precio->precio_m;
                                                    $amount_t5=$precio->precio_t;
                                                    $hotel_id_5=$precio->hotel_id;
                                                    $profit_t5=$precio->utilidad_t;
                                                    $profit_m5=$precio->utilidad_m;
                                                    $profit_d5=$precio->utilidad_d;
                                                    $profit_s5=$precio->utilidad_s;
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
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td id="precio_t_2" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t2" name="amount_t2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t2}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="precio_t_3" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t3" name="amount_t3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t3}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="precio_t_4" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t4" name="amount_t4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t4}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="precio_t_5" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t5" name="amount_t5" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t5}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td id="precio_d_2" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d2" name="amount_d2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d2}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="precio_d_3" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d3" name="amount_d3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d3}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="precio_d_4" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d4" name="amount_d4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d4}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td  id="precio_d_5" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d5" name="amount_d5" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d5}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td id="precio_s_2" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s2" name="amount_s2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s2}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="precio_s_3" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s3" name="amount_s3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s3}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="precio_s_4" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s4" name="amount_s4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s4}}">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="precio_s_5" class="d-none">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
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
                                    <div class="col-12">
                                        <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">6</span> <i>Package Price</i>
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
                                                <td class="w-25">

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
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t2_c" name="amount_t2_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t3_c" name="amount_t3_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t4_c" name="amount_t4_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t5_c" name="amount_t5_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d2_c" name="amount_d2_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d3_c" name="amount_d3_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d4_c" name="amount_d4_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d5_c" name="amount_d5_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s2_c" name="amount_s2_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s3_c" name="amount_s3_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s4_c" name="amount_s4_c" placeholder="Amount" min="0" value="0">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
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
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td id="precio_2_v">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t2_v" name="amount_t2_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t3_v" name="amount_t3_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t4_v" name="amount_t4_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t5_v" name="amount_t5_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d2_v" name="amount_d2_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d3_v" name="amount_d3_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d4_v" name="amount_d4_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d5_v" name="amount_d5_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s2_v" name="amount_s2_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s3_v" name="amount_s3_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s4_v" name="amount_s4_v" placeholder="Amount" min="0" value="0">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
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
                                <hr>
                                <div class="row my-3">
                                    <div class="col-12">
                                        <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">6</span> <i>Resumen</i>
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
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td id="precio_2_v">
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t2_u" name="amount_t2_u" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="{{$amount_t2}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t3_u" name="amount_t3_u" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="{{$amount_t3}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t4_u" name="amount_t4_u" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="{{$amount_t4}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_t5_u" name="amount_t5_u" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="{{$amount_t5}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d2_u" name="amount_d2_u" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="{{$amount_d2}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d3_u" name="amount_d3_u" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="{{$amount_d3}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d4_u" name="amount_d4_u" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="{{$amount_d4}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_d5_u" name="amount_d5_u" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="{{$amount_d5}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="w-25">
                                                    <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s2_u" name="amount_s2_u" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="{{$amount_s2}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s3_u" name="amount_s3_u" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="{{$amount_s3}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
                                                            <input type="number" class="form-control text-right" id="amount_s4_u" name="amount_s4_u" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="{{$amount_s4}}" readonly="readonly">
                                                            {{--<div class="input-group-addon">.00</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group margin-bottom-0">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">$</div>
                                                            </div>
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

                                <div class="row">
                                    <div class="col">
                                        <div class="accordion" id="accordionExample">
                                            <div id="precio_2" class="card">
                                                <div class="card-header" id="headingOne">
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    Precio 2 <i class="fas fa-star"></i>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div class="col-1 d-none">
                                                            <div class="input-group has-success">
                                                                <input type="number" id="profitt_4" name="profitt_4" class="form-control input-porcent text-right text-13" value="{{$profit_2}}" onchange="calcular_resumen()">
                                                                <b class="input-group-addon input- text-success text-25" id="basic-addon2">%</b>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_t2_a_p" id="amount_t2_a_p" value="{{$profit_t2}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_t2_a_v" id="amount_t2_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'2','t',$(this).val())">
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
                                                                <td class="w-20 text-right">
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_m2_a_p" id="amount_m2_a_p" value="{{$profit_m2}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_m2_a_v" id="amount_m2_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'2','m',$(this).val())">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_d2_a_p" id="amount_d2_a_p" value="{{$profit_d2}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_d2_a_v" id="amount_d2_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'2','d',$(this).val())">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_s2_a_p" id="amount_s2_a_p" value="{{$profit_s2}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_s2_a_v" id="amount_s2_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'2','s',$(this).val())">
                                                                </td>
                                                            </tr>
                                                            <tr class="d-none">
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
                                            </div>
                                            <div id="precio_3" class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Precio 3 <i class="fas fa-star"></i>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div class="col-1 d-none">
                                                            <div class="input-group has-success">
                                                                <input type="number" id="profitt_3" name="profitt_3" class="form-control input-porcent text-right text-13" value="{{$profit_3}}" onchange="calcular_resumen()">
                                                                <b class="input-group-addon input- text-success text-25" id="basic-addon2">%</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                    <div class="card-body">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_t3_a_p" id="amount_t3_a_p" value="{{$profit_t3}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_t3_a_v" id="amount_t3_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'3','t',$(this).val())">
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
                                                                <td class="w-20 text-right">
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_m3_a_p" id="amount_m3_a_p" value="{{$profit_m3}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_m3_a_v" id="amount_m3_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'3','m',$(this).val())">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_m2_a_p" id="amount_d3_a_p" value="{{$profit_d3}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_d3_a_v" id="amount_d3_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'3','d',$(this).val())">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_s3_a_p" id="amount_s3_a_p" value="{{$profit_s3}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_s3_a_v" id="amount_s3_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'3','s',$(this).val())">
                                                                </td>
                                                            </tr>
                                                            <tr class="d-none">
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
                                            </div>
                                            <div id="precio_4" class="card">
                                                <div class="card-header" id="headingThree">
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    Precio 4 <i class="fas fa-star"></i>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div class="col-1 d-none">
                                                            <div class="input-group has-success">
                                                                <input type="number" id="profitt_4" name="profitt_4" class="form-control input-porcent text-right text-13" value="{{$profit_4}}" onchange="calcular_resumen()">
                                                                <b class="input-group-addon input- text-success text-25" id="basic-addon2">%</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                    <div class="card-body">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_t4_a_p" id="amount_t4_a_p" value="{{$profit_t4}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_t4_a_v" id="amount_t4_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'4','t',$(this).val())">
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
                                                                <td class="w-20 text-right">
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_m4_a_p" id="amount_m4_a_p" value="{{$profit_m4}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_m4_a_v" id="amount_m4_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'4','m',$(this).val())">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_d4_a_p" id="amount_d4_a_p" value="{{$profit_d4}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_d4_a_v" id="amount_d4_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'4','d',$(this).val())">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_s4_a_p" id="amount_s4_a_p" value="{{$profit_s4}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_s4_a_v" id="amount_s4_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'4','s',$(this).val())">
                                                                </td>
                                                            </tr>
                                                            <tr class="d-none">
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
                                            </div>
                                            <div id="precio_5" class="card">
                                                <div class="card-header" id="headingThree">
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                                                    Precio 5 <i class="fas fa-star"></i>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div class="col-1 d-none">
                                                            <div class="input-group has-success">
                                                                <input type="number" id="profitt_5" name="profitt_5" class="form-control input-porcent text-right text-13" value="{{$profit_5}}" onchange="calcular_resumen()">
                                                                <b class="input-group-addon input- text-success text-25" id="basic-addon2">%</b>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                    <div class="card-body">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_t5_a_p" id="amount_t5_a_p" value="{{$profit_t5}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_t5_a_v" id="amount_t5_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'5','t',$(this).val())">
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
                                                                <td class="w-20 text-right">
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_m5_a_p" id="amount_m5_a_p" value="{{$profit_m5}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_m5_a_v" id="amount_m5_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'5','m',$(this).val())">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_d5_a_p" id="amount_d5_a_p" value="{{$profit_d5}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_d5_a_v" id="amount_d5_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'5','d',$(this).val())">
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
                                                                    <b class="text-success">$ </b><input  style="width: 80px" type="number" name="amount_s5_a_p" id="amount_s5_a_p" value="{{$profit_s5}}" step="0.01" min="0" onchange="calcular_resumen()">
                                                                </td>
                                                                <td class="w-20 text-right">
                                                                    <b class="text-pink-goto">$ </b><input  style="width: 80px" type="number" name="amount_s5_a_v" id="amount_s5_a_v" value="0.00" step="0.01" min="0" onchange="calcular_resumen_venta($('#txt_day').val(),'5','s',$(this).val())">
                                                                </td>
                                                            </tr>
                                                            <tr class="d-none">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="resumen_1_dia" class="row @if($itinerary->duracion!=1){{'d-none'}}@endif">
                            <div class="col">
                                <div class="row my-3">
                                    <div class="col">
                                        <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">5</span> <i>Resumen</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="txt_day">Total costo(without hotel)</label>
                                            <input type="number" class="form-control" id="totalItinerario" name="totalItinerario" min="0" value="{{$iti_precio}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="txt_day">Utilidad</label>
                                            <input type="number" class="form-control" id="txt_utilidad" name="txt_utilidad" min="0" value="{{$itinerary->utilidad}}" step="0.01" onchange="calcular_total_1_dia()">
                                        </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group">
                                        <label for="txt_day">Total venta</label>
                                        <input type="number" class="form-control" id="totalItinerario_venta" name="totalItinerario_venta" min="0" value="{{$itinerary->precio_venta}}" step="0.01" onchange="calcular_total_1_dia_tventa()">
                                        <input type="hidden" class="form-control" id="nroItinerario" name="nroItinerario" min="0" value="{{$nroItinerario}}">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12 text-center">
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
        function mostrar_codigo_(page){
            if(page=='expedia.com')
                $('#txt_codigo_').removeClass('d-none');
            else
                $('#txt_codigo_').addClass('d-none');

        }

        $('.caja_sort').sortable({
            connectWith:'.caja_sort',
            // handle:'.title',
            // placeholder: ....,
            tolerance:'intersect',
            stop:function(){
                calcular_ancho($(this));
            },
        });
        function calcular_ancho(obj){
            console.log('se cojio el:'+$(obj).attr('id'));
            var titles =$(obj).children('.content-list-book').children('.content-list-book-s').children().children().children('.dias_iti_c2');
            $(titles).each(function(index, element){
                var elto=$(element).html();
                console.log('elto:'+elto);
                var pos=(index+1);
                $(element).html('Dia '+pos+':');
            });

        }
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