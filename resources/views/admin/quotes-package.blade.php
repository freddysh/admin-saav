@extends('layouts.admin.admin')
@section('content')
    <?php
    $cotizacion_;
    ?>
    @foreach($cotizacion as $cotizacion1)
        <?php
        $cotizacion_=$cotizacion1;
        ?>
    @endforeach
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li>New</li>
            <li class="active">Package</li>
        </ol>
    </div>
    <form action="{{route('cotizacion_package_save_path')}}" method="post" id="package_new_path_id">

        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span> Package</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row hide">
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-green-goto">
                        <input class="destinospack" type="checkbox" name="strellas_2" id="strellas_2" value="2" @if($cotizacion_->star_2==2) checked="checked"@endif>
                        2 STARS
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-green-goto">
                        <input class="destinospack" type="checkbox" name="strellas_3" id="strellas_3" value="3"  @if($cotizacion_->star_3==3) checked="checked"@endif>
                        3 STARS
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-green-goto">
                        <input class="destinospack" type="checkbox" name="strellas_4" id="strellas_4" value="4"  @if($cotizacion_->star_4==4) checked="checked"@endif>
                        4 STARS
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-green-goto">
                        <input class="destinospack" type="checkbox" name="strellas_5" id="strellas_5" value="5"  @if($cotizacion_->star_5==5) checked="checked"@endif>
                        5 STARS
                    </label>
                </div>
            </div>
        </div>

        <div class="row margin-top-20">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="txt_code">Code{{$cotizacion_->nropersonas}}</label>
                    <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Code">
                </div>
            </div>
            <div class="col-md-2 hide">
                <div class="form-group">
                    <label for="txt_day">Duracion</label>
                    <input type="number" class="form-control" id="txt_day" name="txt_day" placeholder="Days" min="0" value="{{$cotizacion_->duracion}}" onchange="calcular_resumen()">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txt_title">Title</label>
                    <input type="text" class="form-control" id="txt_title" name="txt_title" placeholder="Title">
                </div>
            </div>
            <div class="col-md-12">
                <label for="txta_description">Description</label>
                <textarea class="form-control" id="txta_description" name="txta_description" rows="3"></textarea>
            </div>
        </div>
        <div class="row margin-top-20">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">2</span> Destinations</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            {{csrf_field()}}
            @foreach($destinos as $destino)
                @foreach($destinos1 as $destino_)
                    @if($destino->destino==$destino_)
                        <div class="col-md-3">
                            <div class="checkbox1">
                                <label class=" text-green-goto">
                                <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->destino}}" checked="checked">
                                    {{$destino->destino}}
                                </label>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
        <div class="row margin-top-20">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">3</span> Itinerary</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="grid" id="Lista_itinerario_g" onmouseup="ordenar_itinerarios()">

                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <b class="font-montserrat">COST WITHOUT HOTELS $ <label  id="totalItinerario_front">0</label>.00 P.P</b>
                    </div>
                </div>
            </div>
            <div class="col-md-1 ">
                <a href="#!" class="btn btn-primary" onclick="Pasar_datos()"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            </div>
            <div class="col-md-5">
                <div id="lista_itinerarios">
                    @foreach ($itinerarios as $itinerario)
                        <?php
                        $encontrado=0;
                        ?>
                        @foreach($itinerario->destinos as $destino)
                            @foreach($destinos1 as $destino_)
                                @if($destino->destino==$destino_)
                                    <?php
                                    $encontrado=1;
                                    ?>
                                @endif
                            @endforeach
                        @endforeach
                        @if($encontrado==1)
                            <div id="itinerario{{$itinerario->id}}" class="row margin-bottom-5">
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
                                            $precio_iti+=round($servicios->itinerario_servicios_servicio->precio_venta/intval($cotizacion_->nropersonas),2);
                                            $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.round($servicios->itinerario_servicios_servicio->precio_venta/intval($cotizacion_->nropersonas),2).'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';
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
                                                        {{round($servicios->itinerario_servicios_servicio->precio_venta/2,2)}}
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
                        <?php
                            $encontrado=0;
                        ?>
                    @endforeach



                    <div class="row hide">
                        <b class="font-montserrat text-orange-goto">LIMA</b>
                    </div>
                    <div class="hide row margin-bottom-5">
                        <div class="input-group">
                      <span class="input-group-addon">
                          <input type="checkbox" aria-label="...">
                      </span>

                            <input type="text" class="form-control" aria-label="..." value="Lima City Tours" readonly>

                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample3"><b>$1299.00</b> <i class="fa fa-arrows-v" aria-hidden="true"></i></button>
                        </span>
                        </div><!-- /input-group -->
                        <div class="collapse clearfix" id="collapseExample3">
                            <div class="col-md-12 well margin-top-5">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!
                                <h5><b>Services</b></h5>
                                <table class="table table-condensed table-striped">
                                    <thead>
                                    <tr class="bg-grey-goto text-white">
                                        <th colspan="2">Concepts</th>
                                        <th>Prices</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Transfer</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                        <td>1299.00</td>

                                    </tr>
                                    <tr>
                                        <td>Transfer</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                        <td>1299.00</td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    <textarea class="form-control animated" id="txta_include" name="txta_include" rows="5">5 nights in Peru high quality Hotels
    All tours stated in the itinerary with English-speaking guides
    All transfers and entrance fees
    All breakfasts
    Private Airport Shuttle in & out
    24/7 Assistance
    Trains and buses
    A prepaid cellphone for extended Programs</textarea>
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
                    <textarea class="form-control" id="txta_notinclude" name="txta_notinclude" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="row margin-top-20 ">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">5</span> Hotels</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                {{--@foreach($m_servicios as $serviciop)--}}
                {{--{{$serviciop}}--}}
                {{--@endforeach--}}
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
                @foreach($hotel as $servicio)
                    @if($servicio->localizacion=="CUSCO")
                        {{--@php--}}
                            {{--$hotel_id_2=$servicio->id;--}}
                        {{--@endphp--}}
                        @if($servicio->estrellas=="2")
                            @php
                                $hotel_id_2=$servicio->id;
                                $amount_s2=$servicio->single;
                                $amount_d2=$servicio->doble;
                                $amount_m2=$servicio->matrimonial;
                                $amount_t2=$servicio->triple;
                            @endphp
                        @endif
                        @if($servicio->estrellas=="3")
                            @php
                                $hotel_id_3=$servicio->id;
                                $amount_s3=$servicio->single;
                                $amount_d3=$servicio->doble;
                                $amount_m3=$servicio->matrimonial;
                                $amount_t3=$servicio->triple;
                            @endphp
                        @endif
                        @if($servicio->estrellas=="4")
                            @php
                                $hotel_id_4=$servicio->id;
                                $amount_s4=$servicio->single;
                                $amount_d4=$servicio->doble;
                                $amount_m4=$servicio->matrimonial;
                                $amount_t4=$servicio->triple;
                            @endphp
                        @endif
                        @if($servicio->estrellas=="5")
                            @php
                                $hotel_id_5=$servicio->id;
                                $amount_s5=$servicio->single;
                                $amount_d5=$servicio->doble;
                                $amount_m5=$servicio->matrimonial;
                                $amount_t5=$servicio->triple;
                            @endphp
                        @endif
                    @endif
                @endforeach
                <?php
                $acomodacion=explode('_',$acomodacion_);
                ?>
                <table class="table table-condensed table-bordered font-montserrat">
                    <caption class="text-right"><b>Price per night</b></caption>
                    <thead>
                    <tr class="bg-grey-goto-light text-white">

                        <th class="text-center">Hotels</th>
                        <th id="precio_2_t" class="text-center @if($cotizacion_->star_2!=2) hide @endif">2 Stars</th>
                        <th id="precio_3_t" class="text-center @if($cotizacion_->star_3!=3) hide @endif">3 Stars</th>
                        <th id="precio_4_t" class="text-center @if($cotizacion_->star_4!=4) hide @endif">4 Stars</th>
                        <th id="precio_5_t" class="text-center @if($cotizacion_->star_5!=5) hide @endif">5 Stars</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr class="@if($acomodacion[2]!=3) hide @endif">
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td id="precio_t_2" class="@if($cotizacion_->star_2!=2) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t2" name="amount_t2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t2}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_t_3" class="@if($cotizacion_->star_3!=3) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t3" name="amount_t3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t3}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_t_4" class="@if($cotizacion_->star_4!=4) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t4" name="amount_t4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_t4}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_t_5" class="@if($cotizacion_->star_5!=5) hide @endif">
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
                    <tr class="@if($acomodacion[3]!=2) hide @endif">
                        <td class="col-md-2">
                            <i class="fa fa-venus-mars fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td id="precio_d_2" class="@if($cotizacion_->star_2!=2) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_m2" name="amount_m2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_m2}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_d_3" class="@if($cotizacion_->star_3!=3) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_m3" name="amount_m3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_m3}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_d_4" class="@if($cotizacion_->star_4!=4) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_m4" name="amount_m4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_m4}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td  id="precio_d_5" class="@if($cotizacion_->star_5!=5) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_m5" name="amount_m5" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_m5}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[1]!=2) hide @endif">
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td id="precio_d_2" class="@if($cotizacion_->star_2!=2) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d2" name="amount_d2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d2}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_d_3" class="@if($cotizacion_->star_3!=3) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d3" name="amount_d3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d3}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_d_4" class="@if($cotizacion_->star_4!=4) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d4" name="amount_d4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_d4}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td  id="precio_d_5" class="@if($cotizacion_->star_5!=5) hide @endif">
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
                    <tr class="@if($acomodacion[0]!=1) hide @endif">
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td id="precio_s_2" class="@if($cotizacion_->star_2!=2) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s2" name="amount_s2" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s2}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_s_3" class="@if($cotizacion_->star_3!=3) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s3" name="amount_s3" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s3}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_s_4" class="@if($cotizacion_->star_4!=4) hide @endif">
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s4" name="amount_s4" placeholder="Amount" onchange="calcular_resumen()" min="0" value="{{$amount_s4}}">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td id="precio_s_5" class="@if($cotizacion_->star_5!=5) hide @endif">
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
        <div class="row margin-top-20 hide">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">6</span> Package Price</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row hide">
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
                        <th class="text-center">2 Stars</th>
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
        <div class="row hide">
            <div class="col-md-12">
                <table class="table table-condensed table-bordered font-montserrat">
                    <caption class="text-right"><b>Todos los precios tienen un 40% de utilidad y son para dos personas</b></caption>
                    <thead>
                    <tr class="bg-grey-goto-light text-white">
                        <th class="text-center">Hotels</th>
                        <th class="text-center">2 Stars</th>
                        <th class="text-center">3 Stars</th>
                        <th class="text-center">4 Stars</th>
                        <th class="text-center">5 Stars</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="@if($acomodacion[2]!=3) hide @endif">
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
                    {{--<tr class="@if($acomodacion[3]!=2) hide @endif">--}}
                        {{--<td class="col-md-2">--}}
                            {{--<i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>--}}
                            {{--<i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<div class="form-group margin-bottom-0">--}}
                                {{--<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-addon">$</div>--}}
                                    {{--<input type="number" class="form-control text-right" id="amount_d2_u" name="amount_d2_u" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="{{$amount_d2}}" readonly="readonly">--}}
                                    {{--<div class="input-group-addon">.00</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<div class="form-group margin-bottom-0">--}}
                                {{--<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-addon">$</div>--}}
                                    {{--<input type="number" class="form-control text-right" id="amount_d3_u" name="amount_d3_u" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="{{$amount_d3}}" readonly="readonly">--}}
                                    {{--<div class="input-group-addon">.00</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<div class="form-group margin-bottom-0">--}}
                                {{--<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-addon">$</div>--}}
                                    {{--<input type="number" class="form-control text-right" id="amount_d4_u" name="amount_d4_u" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="{{$amount_d4}}" readonly="readonly">--}}
                                    {{--<div class="input-group-addon">.00</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<div class="form-group margin-bottom-0">--}}
                                {{--<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-addon">$</div>--}}
                                    {{--<input type="number" class="form-control text-right" id="amount_d5_u" name="amount_d5_u" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="{{$amount_d5}}" readonly="readonly">--}}
                                    {{--<div class="input-group-addon">.00</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</td>--}}

                    {{--</tr>--}}
                    <tr class="@if($acomodacion[1]!=2) hide @endif">
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
                    <tr class="@if($acomodacion[0]!=1) hide @endif">
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
        <div id="precio_2" class="row @if($cotizacion_->star_2!=2) hide @endif">
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
                    <tr class="@if($acomodacion[2]!=3) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t2_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t2_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t2_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[3]!=2) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
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
                    <tr class="@if($acomodacion[1]!=2) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d2_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d2_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d2_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[0]!=1) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>

                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s2_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s2_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s2_a_v"></span>.00</b>
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
                                <input type="number" id="profitt_2" name="profitt_2" class="form-control input-porcent text-right" value="40" onchange="calcular_resumen()">
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
        <div id="precio_3" class="row @if($cotizacion_->star_3!=3) hide @endif">
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
                    <tr class="@if($acomodacion[2]!=3) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t3_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t3_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t3_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[3]!=2) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
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
                    <tr class="@if($acomodacion[1]!=2) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d3_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d3_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d3_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[0]!=1) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>

                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s3_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s3_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s3_a_v"></span>.00</b>
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
                                <input type="number" id="profitt_3" name="profitt_3" class="form-control input-porcent text-right" value="40" onchange="calcular_resumen()">
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
        <div id="precio_4" class="row @if($cotizacion_->star_4!=4) hide @endif">
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
                    <tr class="@if($acomodacion[2]!=3) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t4_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t4_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t4_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[3]!=2) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
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
                    <tr class="@if($acomodacion[1]!=2) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30"> /
                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d4_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d4_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d4_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[0]!=1) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>

                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s4_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s4_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s4_a_v"></span>.00</b>
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
                                <input type="number" id="profitt_4" name="profitt_4" class="form-control input-porcent text-right" value="40" onchange="calcular_resumen()">
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
        <div id="precio_5" class="row @if($cotizacion_->star_5!=5) hide @endif">
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
                    <tr class="@if($acomodacion[2]!=3) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t5_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t5_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_t5_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[3]!=2) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
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
                    <tr class="@if($acomodacion[1]!=2) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x hide" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30"> /
                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d5_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d5_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_d5_a_v"></span>.00</b>
                        </td>
                    </tr>
                    <tr class="@if($acomodacion[0]!=1) hide @endif">
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>

                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s5_a"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s5_a_p"></span>.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$ <span id="amount_s5_a_v"></span>.00</b>
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
                                <input type="number" id="profitt_5" name="profitt_5" class="form-control input-porcent text-right" value="40" onchange="calcular_resumen()">
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


        <div class="row hide">
            <div class="col-md-12">
                <div class="text-center">

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="txt_day">Total costo(without hotel)</label>
                        <input type="number" class="form-control" id="totalItinerario" name="totalItinerario" min="0" value="0" readonly>
                    </div>
                </div>
                <div class="col-md-3 hide">
                    <div class="form-group">
                        <label for="txt_day">Utilidad</label>
                        <input type="number" class="form-control" id="txt_utilidad" name="txt_utilidad" min="0" value="0" onchange="calcular_utilidad()">
                    </div>
                </div>
                <div class="col-md-3 hide">
                    <div class="form-group">
                        <label for="txt_day">Total venta</label>
                        <input type="number" class="form-control" id="totalItinerario_venta" name="totalItinerario_venta" min="0" value="0" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="row margin-top-20">
            <div class="col-md-12 text-center">
                <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="{{$cotizacion_->id}}">
                <input type="hidden" name="nro_personitas" id="nro_personitas" value="{{$cotizacion_->nropersonas}}">
                <?php
                $cliente_id=0;
                ?>
                @foreach($cotizacion_->cotizaciones_cliente as $cotizaciones_cliente1)
                    @if($cotizaciones_cliente1->estado==1)
                        <?php
                        $cliente_id=$cotizaciones_cliente1->clientes_id;
                        ?>
                    @endif
                @endforeach
                <input type="hidden" name="cliente_id" id="cliente_id" value="{{$cliente_id}}">
                <input type="text" name="acomodacion" value="{{$acomodacion_}}">
                <input type="text" name="hotel_id_2" value="{{$hotel_id_2}}">
                <input type="text" name="hotel_id_3" value="{{$hotel_id_3}}">
                <input type="text" name="hotel_id_4" value="{{$hotel_id_4}}">
                <input type="text" name="hotel_id_5" value="{{$hotel_id_5}}">

                <button type="submit" class="btn btn-lg btn-primary">Generar plan <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
    </script>
@stop