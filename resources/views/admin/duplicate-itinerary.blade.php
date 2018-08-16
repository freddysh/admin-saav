@extends('.layouts.admin.admin')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Inventory</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Itineraries</a></li>
            <li class="breadcrumb-item active">Duplicate</li>
        </ol>
    </nav>
    <hr>
    <form action="{{route('package_duplicate_path')}}" method="post" id="package_new_path_id">
        <div class="row mt-3">
            <div class="col-12">
                <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">1</span> <i>Package</i>
            </div>
        </div>
        <div class="row d-none">
            <div class="col-3">
                <div class="checkbox1">
                    <label class=" text-green-goto">
                        <input class="destinospack" type="checkbox" name="strellas_2" id="strellas_2" value="2" onchange="filtrar_estrellas()" checked>
                        2 STARS
                    </label>
                </div>
            </div>
            <div class="col-3">
                <div class="checkbox1">
                    <label class=" text-green-goto">
                        <input class="destinospack" type="checkbox" name="strellas_3" id="strellas_3" value="3" onchange="filtrar_estrellas()" checked>
                        3 STARS
                    </label>
                </div>
            </div>
            <div class="col-3">
                <div class="checkbox1">
                    <label class=" text-green-goto">
                        <input class="destinospack" type="checkbox" name="strellas_4" id="strellas_4" value="4" onchange="filtrar_estrellas()" checked>
                        4 STARS
                    </label>
                </div>
            </div>
            <div class="col-3">
                <div class="checkbox1">
                    <label class=" text-green-goto">
                        <input class="destinospack" type="checkbox" name="strellas_5" id="strellas_5" value="5" onchange="filtrar_estrellas()" checked>
                        5 STARS
                    </label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2">
                <div class="form-group">
                    <label for="txt_pagina" class="text-secondary font-weight-bold">Pagina</label>
                    <select class="form-control" id="txt_pagina" name="txt_pagina">
                        <option value="0">Escoja una opcion</option>
                        <option value="gotoperu.com.pe" @if($itinerary->pagina=='gotoperu.com.pe') {{'selected'}} @endif>gotoperu.com.pe</option>
                        <option value="expedia.com" @if($itinerary->pagina=='expedia.com') {{'selected'}} @endif>expedia.com</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="txt_code" class="font-weight-bold text-secondary">Code</label>
                    <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Old: {{$itinerary->codigo}}" required>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="txt_day" class="font-weight-bold text-secondary">Duracion</label>
                    <input type="number" class="form-control" id="txt_day" name="txt_day" placeholder="Days" min="0" onchange="calcular_resumen()"  value="{{$itinerary->duracion}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="txt_title" class="font-weight-bold text-secondary">Title</label>
                    <input type="text" class="form-control" id="txt_title" name="txt_title"  placeholder="Old: {{$itinerary->titulo}}" required>
                </div>
            </div>
            <div class="col-12 d-none">
                <label for="txta_description" class="font-weight-bold text-secondary">Description</label>
                <textarea class="form-control" id="txta_description" name="txta_description" rows="3">{{$itinerary->descripcion}}</textarea>
            </div>
        </div>
        <hr>
        <div class="row mt-3">
            <div class="col-12">
                <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">2</span> <i>Destinations</i>
            </div>
        </div>
        <div class="row mt-3">
            {{csrf_field()}}
            @php
                $arra_destinos=array();
            @endphp
            @foreach($itinerary->itinerarios as $itinerario)
                @foreach($itinerario->destinos as $destino)
                    @php
                        $arra_destinos[$destino->destino]=$destino->destino;
                    @endphp
                @endforeach
            @endforeach

            @foreach($destinos as $destino)
                @foreach($arra_destinos as $destino_)
                    @if($destino_==$destino->destino)
                        <div class="col-3">
                                <label class="text-primary">
                                    <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->destino}}" onchange="filtrar_itinerarios()" checked>
                                    {{ucwords(strtolower($destino->destino))}}
                                </label>
                            </div>
                    @else
                        <div class="col-3">
                                <label class="text-primary">
                                    <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->destino}}" onchange="filtrar_itinerarios()">
                                    {{ucwords(strtolower($destino->destino))}}
                                </label>
                            </div>
                    @endif
                @endforeach
            @endforeach
        </div>
        <hr>
        <div class="row mt-3">
            <div class="col-12">
                <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">3</span> <i>Itinerary</i>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <div class="grid" id="Lista_itinerario_g" >
                    @php
                        $iti_precio=0;
                        $nroItinerario=0;
                    @endphp
                    @foreach($itinerary->itinerarios as $itinerario)
                        @php
                            $iti_id=0;
                        @endphp
                        @foreach($itinerarios as $itinerario_)
                            @if($itinerario->titulo==$itinerario_->titulo)
                                @php
                                    $iti_id=$itinerario_->id;
                                @endphp
                                @break
                            @endif
                        @endforeach
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
                        <div id="itis_{{$itinerario->id}}" class="box-sortable margin-bottom-10" onmouseleave="ordenar_itinerarios()" >
                            <input type="hidden" name="itinerarios_[]" id="itinerarios_{{$iti_id}}" value="{{$iti_id}}">
                            <a class="btn btn-link" data-toggle="collapse" href="#collapseExample_{{$iti_id}}" aria-expanded="false" aria-controls="collapseExample">
                                <b class="lista_dias">Dia {{$itinerario->dias}}:</b> {{ucwords(strtolower($itinerario->titulo))}}
                            </a>
                            <span class="float-right m-2">
                                <a href="#!" class="float-right text-danger" onclick="eliminar_iti('{{$iti_id}}','{{$itinerario->precio}}')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </span>
                            <span class="badge badge-g-dark"><sup>$</sup>{{$itinerario_total}}</span>
                            <div class="collapse clearfix" id="collapseExample_{{$iti_id}}">
                                <div class="row">
                                <div class="col-12"><input type="hidden" name="itinerario" value="{{$iti_id}}">
                                    @php echo $itinerario->descripcion; @endphp
                                    <h5><b>Services</b></h5>
                                    <table class="table table-sm table-striped">
                                        <thead>
                                        <tr class="bg-grey-goto text-white">
                                            <th colspan="2">Concepts</th>
                                            <th>Prices</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($itinerario->serivicios as $serivicios)
                                            @php
                                                $valu=$serivicios->nombre.'//'.$serivicios->precio.'//'.$serivicios->precio_grupo;
                                            @endphp
                                            <tr>
                                                <td><input type="hidden" name="iti_servicios_{{$iti_id}}" value="{{$valu}}">{{$serivicios->nombre}}</td>
                                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                                <td>{{$serivicios->precio}}</td>
                                                <td><a href="#!" class=" text-danger" onclick="eliminar_iti_servicio()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td class="" colspan="4">
                                                <a class="d-none" href="#add-services{{$iti_id}}" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="txta_description">Sugerencias para los servicios</label>
                                                        <textarea class="form-control" id="txt_sugerencia_{{$iti_id}}" name="txt_sugerencia[]" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="collapse" id="add-services{{$iti_id}}">
                                                    <div class="row mt-3">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Services">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 row">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Price">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="form-group">
                                                                <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>



                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <b class="font-montserrat">COST WITHOUT HOTELS $ <label  id="totalItinerario_front">{{$iti_precio}}</label> P.P</b>
                    </div>
                </div>
            </div>
            <div class="col-1 text-center">
                <a href="#!" class="btn btn-primary" onclick="Pasar_datos()"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            </div>
            <div class="col-5" style="height: 595px; overflow-y: auto;">
                <div id="lista_itinerarios">
                    @foreach ($itinerarios as $itinerario)
                        @php
                            $tiene_dest=0;
                        @endphp
                        @foreach ($itinerario->destinos as $destino_)
                            @if(in_array($destino_->destino,$arra_destinos))
                                @php
                                    $tiene_dest++;
                                @endphp
                            @endif
                        @endforeach
                        @if($tiene_dest>0)
                            <div id="itinerario{{$itinerario->id}}" class="mb-2 ">
                                <div class="input-group">
                                    <span class="input-group-prepend">
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
                                            <div class="input-group-text">
                                        <input class="itinerario" type="checkbox" aria-label="..." name="itinerarios" value="{{$itinerario->id}}_{{$destinos_iti}}_{{$itinerario->titulo}}_{{$itinerario->descripcion}}_{{$precio_iti}}_{{$servicios1}}">
                                                </div>
                                    </span>
                                    <input type="text" class="form-control" aria-label="..." value="{{$itinerario->titulo}}" readonly>
                                    <span class="input-group-append">
                                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse_{{$itinerario->id}}"><b>${{$precio_iti}}</b> <i class="fas fa-angle-down"></i></button>
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
                        @else
                            <div id="itinerario{{$itinerario->id}}" class="row margin-bottom-5 d-none">
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
                                        <input class="itinerario" type="checkbox" aria-label="..." name="itinerarios" value="{{$itinerario->id}}_{{$destinos_iti}}_{{$itinerario->titulo}}_{{$itinerario->descripcion}}_{{$precio_iti}}_{{$servicios1}}">
                                    </span>
                                    <input type="text" class="form-control" aria-label="..." value="{{$itinerario->titulo}}" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse_{{$itinerario->id}}"><b>${{$precio_iti}}</b> <i class="fas fa-angle-down"></i></button>
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
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-3">
                <div class="col-12">
                    <span class="font-weight-bold rounded-circle py-2 px-3 bg-g-yellow text-white">4</span> <i>Included & Not included</i>
                </div>
            </div>
        <div class="row mt-3">
            <div class="col-6">
                <div class="text-center alert alert-primary">
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> Default
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Personalize
                    </label>
                </div>
                <div class="form-group">
                    <label for="txta_include" class="font-weight-bold text-secondary">Include</label>
                    <textarea class="form-control animated" id="txta_include" name="txta_include" rows="5">{{$itinerary->incluye}}</textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center alert alert-primary">
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions2" id="inlineRadio1" value="option1"> Default
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="option2" checked> Personalize
                    </label>
                </div>
                <div class="form-group">
                    <label for="txta_notinclude" class="font-weight-bold text-secondary">Not Include</label>
                    <textarea class="form-control" id="txta_notinclude" name="txta_notinclude" rows="5">{{$itinerary->noincluye}}</textarea>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
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
                ?>
                @foreach($itinerary as $$itinerary)
                    @foreach($itinerary->precios as $precio)
                        @if($precio->estrellas=="2")
                            <?php
                            $amount_s2=$precio->precio_s;
                            $amount_d2=$precio->precio_d;
                            $amount_m2=$precio->precio_m;
                            $amount_t2=$precio->precio_t;
                            ?>
                        @endif
                        @if($precio->estrellas=="3")
                            <?php
                            $amount_s3=$precio->precio_s;
                            $amount_d3=$precio->precio_d;
                            $amount_m3=$precio->precio_m;
                            $amount_t3=$precio->precio_t;
                            ?>
                        @endif
                        @if($precio->estrellas=="4")
                            <?php
                            $amount_s4=$precio->precio_s;
                            $amount_d4=$precio->precio_d;
                            $amount_m4=$precio->precio_m;
                            $amount_t4=$precio->precio_t;
                            ?>
                        @endif
                        @if($precio->estrellas=="5")
                            <?php
                            $amount_s5=$precio->precio_s;
                            $amount_d5=$precio->precio_d;
                            $amount_m5=$precio->precio_m;
                            $amount_t5=$precio->precio_t;
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
                                        <div class="input-group-text">
                                            $
                                        </div>
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
        <div id="precio_2" class="row d-none">
            <div class="col-md-12">
                <b class="font-montserrat text-pink-goto">
                    {{--<span class="label bg-orange-goto">1</span>--}}
                    Precio 2 estrellas</b>
                <table class="table table-condensed font-montserrat">
                    {{--<caption>table title and/or explanatory text</caption>--}}
                    <thead>
                    <tr>
                        <th><b class="text-grey-goto-light">Per Person</b></th>
                        <th></th>
                        <th class="text-right col-md-2"><b class="text-danger text-20">Cost</b></th>
                        <th class="text-right col-md-2"><b class="text-success text-20">Profit</b></th>
                        <th class="text-right col-md-2"><b class="text-pink-goto text-20">Price</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t2_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t2_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t2_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="d-none">
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m2_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m2_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m2_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d2_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d2_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d2_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>

                        <td class="text-right">
                            <b class="">$ <span id="amount_s2_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_s2_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_s2_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td class="text-right">
                            <b class="text-20 text-danger"><span id="porc_cost_2">60</span>%</b>
                        </td>
                        <td class="text-right">
                            {{--<div>--}}
                            {{--<input type="number" class="form-control text-right" min="0" max="99" step="1">--}}
                            {{--</div>--}}
                            <div class="input-group has-success">
                                <input type="number" id="profitt_2" name="profitt_2" class="form-control input-porcent text-right" value="{{$profit_2}}" onchange="calcular_resumen()">
                                <span class="input-group-addon input-" id="basic-addon2">%</span>
                            </div>
                        </td>
                        <td class="text-right">
                            <b class="text-20 text-pink-goto">100%</b>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="precio_3" class="row d-none">
            <div class="col-md-12">
                <b class="font-montserrat text-pink-goto">
                    {{--<span class="label bg-orange-goto">1</span>--}}
                    Precio 3 estrellas</b>
                <table class="table table-condensed font-montserrat">
                    {{--<caption>table title and/or explanatory text</caption>--}}
                    <thead>
                    <tr>
                        <th><b class="text-grey-goto-light">Per Person</b></th>
                        <th></th>
                        <th class="text-right col-md-2"><b class="text-danger text-20">Cost</b></th>
                        <th class="text-right col-md-2"><b class="text-success text-20">Profit</b></th>
                        <th class="text-right col-md-2"><b class="text-pink-goto text-20">Price</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t3_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t3_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t3_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="d-none">
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m3_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m3_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m3_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d3_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d3_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d3_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>

                        <td class="text-right">
                            <b class="">$ <span id="amount_s3_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_s3_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_s3_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>

                        <td class="text-right">
                            <b class="text-20 text-danger"><span id="porc_cost_3">60</span>%</b>
                        </td>
                        <td class="text-right">
                            {{--<div>--}}
                            {{--<input type="number" class="form-control text-right" min="0" max="99" step="1">--}}
                            {{--</div>--}}
                            <div class="input-group has-success">
                                <input type="number" id="profitt_3" name="profitt_3" class="form-control input-porcent text-right" value="{{$profit_3}}" onchange="calcular_resumen()">
                                <span class="input-group-addon input-" id="basic-addon2">%</span>
                            </div>
                        </td>
                        <td class="text-right">
                            <b class="text-20 text-pink-goto">100%</b>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="precio_4" class="row d-none">
            <div class="col-md-12">
                <b class="font-montserrat text-pink-goto">
                    {{--<span class="label bg-orange-goto">1</span>--}}
                    Precio 4 estrellas</b>
                <table class="table table-condensed font-montserrat">
                    {{--<caption>table title and/or explanatory text</caption>--}}
                    <thead>
                    <tr>
                        <th><b class="text-grey-goto-light">Per Person</b></th>
                        <th></th>
                        <th class="text-right col-md-2"><b class="text-danger text-20">Cost</b></th>
                        <th class="text-right col-md-2"><b class="text-success text-20">Profit</b></th>
                        <th class="text-right col-md-2"><b class="text-pink-goto text-20">Price</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t4_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t4_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t4_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="d-none">
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m4_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m4_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m4_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d4_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d4_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d4_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>

                        <td class="text-right">
                            <b class="">$ <span id="amount_s4_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_s4_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_s4_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>

                        <td class="text-right">
                            <b class="text-20 text-danger"><span id="porc_cost_4">60</span>%</b>
                        </td>
                        <td class="text-right">
                            {{--<div>--}}
                            {{--<input type="number" class="form-control text-right" min="0" max="99" step="1">--}}
                            {{--</div>--}}
                            <div class="input-group has-success">
                                <input type="number" id="profitt_4" name="profitt_4" class="form-control input-porcent text-right" value="{{$profit_4}}" onchange="calcular_resumen()">
                                <span class="input-group-addon input-" id="basic-addon2">%</span>
                            </div>
                        </td>
                        <td class="text-right">
                            <b class="text-20 text-pink-goto">100%</b>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="precio_5" class="row d-none">
            <div class="col-md-12">
                <b class="font-montserrat text-pink-goto">
                    {{--<span class="label bg-orange-goto">1</span>--}}
                    Precio 5 estrellas</b>
                <table class="table table-condensed font-montserrat">
                    {{--<caption>table title and/or explanatory text</caption>--}}
                    <thead>
                    <tr>
                        <th><b class="text-grey-goto-light">Per Person</b></th>
                        <th></th>
                        <th class="text-right col-md-2"><b class="text-danger text-20">Cost</b></th>
                        <th class="text-right col-md-2"><b class="text-success text-20">Profit</b></th>
                        <th class="text-right col-md-2"><b class="text-pink-goto text-20">Price</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t5_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t5_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_t5_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="d-none">
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m5_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m5_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_m5_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x d-none" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d5_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d5_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_d5_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>

                        <td class="text-right">
                            <b class="">$ <span id="amount_s5_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_s5_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="">$ <span id="amount_s5_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>

                        <td class="text-right">
                            <b class="text-20 text-danger"><span id="porc_cost_5">60</span>%</b>
                        </td>
                        <td class="text-right">
                            {{--<div>--}}
                            {{--<input type="number" class="form-control text-right" min="0" max="99" step="1">--}}
                            {{--</div>--}}
                            <div class="input-group has-success">
                                <input type="number" id="profitt_5" name="profitt_5" class="form-control input-porcent text-right" value="{{$profit_5}}" onchange="calcular_resumen()">
                                <span class="input-group-addon input-" id="basic-addon2">%</span>
                            </div>
                        </td>
                        <td class="text-right">
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
        <div class="row my-3">
            <div class="col-12 text-center">
                <input type="hidden" name="paquete_id" id="paquete_id" value="{{$paquete_id}}">
                <button type="submit" class="btn btn-lg btn-primary">Duplicate <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            filtrar_estrellas();
            calcular_resumen();
        } );
    </script>
@stop