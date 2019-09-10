@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
@stop
@section('archivos-js')
    {{--<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>--}}
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white mt-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/">Qoutes</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </nav>
    <hr>
    <div class="row m-0 p-0">
        <div class="col-9">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_name" class="font-weight-bold text-secondary">Name</label>
                                        <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Ingrese el nombre" onkeypress="return runScript(event)" value="{{$nombres}}" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_email" class="font-weight-bold text-secondary">Email</label>
                                        <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email" value="{{$email}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_country" class="font-weight-bold text-secondary">Country</label>
                                        <input type="text" class="form-control" id="txt_country" name="txt_country" placeholder="Country" value="{{$nacionalidad}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_phone" class="font-weight-bold text-secondary">Phone</label>
                                        <input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="Phone" value="{{$telefono}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="txt_notas" class="font-weight-bold text-secondary">Notas</label>
                                        <textarea  class="form-control" name="txt_notas" id="txt_notas" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        {{csrf_field()}}
                                        <label for="web" class="font-weight-bold text-secondary">Pagina de origen</label>
                                        <select name="web" id="web" class="form-control" onchange="generar_codigo_pagina($(this).val())">
                                            @foreach ($webs->where('estado','1')->sortBy('pagina') as $item)
                                                <option value="{{$item->pagina}}" @if($item->pagina==$web) selected @endif>{{$item->pagina}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_codigo" class="font-weight-bold text-secondary">Codigo</label>
                                        <input class="form-control" type="text" id="txt_codigo" name="txt_codigo" value="{{$codigo}}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_idioma_pasajeros" class="font-weight-bold text-secondary">Idioma</label>
                                        <select class="form-control" id="txt_idioma_pasajeros" name="txt_idioma_pasajeros">
                                            <option value="SIN IDIOMA">Escoja un idioma</option>
                                            <option value="INGLES" @if($idioma_pasajeros=='INGLES') {{'selected'}} @endif>INGLES</option>
                                            <option value="PORTUGUES" @if($idioma_pasajeros=='PORTUGUES') {{'selected'}} @endif>PORTUGUES</option>
                                            <option value="ESPAÑOL" @if($idioma_pasajeros=='ESPAÑOL') {{'selected'}} @endif>ESPAÑOL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="txt_travellers" class="font-weight-bold text-secondary">Travelers</label>
                                        <input type="number" class="form-control" id="txt_travellers" name="txt_travellers" min="1" onchange="calcular_sumar_servicios($('#txt_travellers').val())" value="{{$travelers}}">
                                    </div>
                                </div>
                                <div class="col-3 d-none">
                                    <span id="human"></span>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="txt_days" class="font-weight-bold text-secondary">Days</label>
                                        <input type="number" class="form-control" id="txt_days" name="txt_days" placeholder="Days" min="1" onchange="poner_dias($('#web').val(),$(this).val())" value="{{$days}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_travel_date" class="font-weight-bold text-secondary">Travel date</label>
                                        <input type="date" class="form-control" id="txt_travel_date" name="txt_travel_date" placeholder="Travel date" value="{{$fecha}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="hotel" class="font-weight-bold text-secondary">Hotel</label>
                                        <select class="form-control" name="hotel" id="hotel" onchange="mostrar_acomodacion($(this).val())">
                                            <option value="0">Sin hotel</option>
                                            <option value="2">2 Stars</option>
                                            <option value="3">3 Stars</option>
                                            <option value="4">4 Stars</option>
                                            <option value="5">5 Stars</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div id="acomodacion" class="row d-none">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="font-weight-bold text-secondary" for="a_s_1">
                                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                                </label>
                                                <input type="number" class="form-control" name="a_s_1" id="a_s_1" value="0" min="0" onchange="aumentar_acom('s')">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="font-weight-bold text-secondary" for="a_d_1">
                                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                                </label>
                                                <input type="number" class="form-control" name="a_d_1" id="a_d_1" value="0" min="0" onchange="aumentar_acom('d')">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="font-weight-bold text-secondary" for="exampleInputEmail1">
                                                    <i class="fa fa-venus-mars" aria-hidden="true"></i>
                                                </label>
                                                <input type="number" class="form-control" name="a_m_1" id="a_m_1" min="0" value="0" onchange="aumentar_acom('m')">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="font-weight-bold text-secondary" for="a_t_1">
                                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                                </label>
                                                <input type="number" class="form-control" name="a_t_1" id="a_t_1" min="0" value="0" onchange="aumentar_acom('t')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="txt_movilid" class="font-weight-bold text-secondary">Vehicle</label>
                                        <select class="form-control" id="txt_movilid" name="txt_movilid">
                                            <option value="0">Escoja un vehiculo</option>
                                            <option value="AUTO" >AUTO</Option>
                                            <option value="VAN">VAN</option>
                                            <option value="H1">H1</option>
                                            <option value="SPRINTER">SPRINTER</option>
                                            <option value="BUS">BUS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $h2_s=0;
                        $h2_d=0;
                        $h2_m=0;
                        $h2_t=0;

                        $h3_s=0;
                        $h3_d=0;
                        $h3_m=0;
                        $h3_t=0;

                        $h4_s=0;
                        $h4_d=0;
                        $h4_m=0;
                        $h4_t=0;

                        $h5_s=0;
                        $h5_d=0;
                        $h5_m=0;
                        $h5_t=0;
                        $hotel_id_2=0;
                        $hotel_id_3=0;
                        $hotel_id_4=0;
                        $hotel_id_5=0;
                    @endphp
                    @foreach($hotel->where('localizacion','CUSCO')->take(4) as $hotels)
                        @if($hotels->estrellas=='2')
                            @php
                                $h2_s=$hotels->single;
                                $h2_d=$hotels->doble;
                                $h2_m=$hotels->matrimonial;
                                $h2_t=$hotels->triple;
                                $hotel_id_2=$hotels->id;
                            @endphp
                        @endif
                        @if($hotels->estrellas=='3')
                            @php
                                $h3_s=$hotels->single;
                                $h3_d=$hotels->doble;
                                $h3_m=$hotels->matrimonial;
                                $h3_t=$hotels->triple;
                                $hotel_id_3=$hotels->id;
                            @endphp
                        @endif
                        @if($hotels->estrellas=='4')
                            @php
                                $h4_s=$hotels->single;
                                $h4_d=$hotels->doble;
                                $h4_m=$hotels->matrimonial;
                                $h4_t=$hotels->triple;
                                $hotel_id_4=$hotels->id;
                            @endphp
                        @endif
                        @if($hotels->estrellas=='5')
                            @php
                                $h5_s=$hotels->single;
                                $h5_d=$hotels->doble;
                                $h5_m=$hotels->matrimonial;
                                $h5_t=$hotels->triple;
                                $hotel_id_5=$hotels->id;
                            @endphp
                        @endif
                    @endforeach
                    <input type="hidden" name="h2_s" id="h2_s" value="{{$h2_s}}">
                    <input type="hidden" name="h2_d" id="h2_d" value="{{$h2_d}}">
                    <input type="hidden" name="h2_m" id="h2_m" value="{{$h2_m}}">
                    <input type="hidden" name="h2_t" id="h2_t" value="{{$h2_t}}">

                    <input type="hidden" name="h3_s" id="h3_s" value="{{$h3_s}}">
                    <input type="hidden" name="h3_d" id="h3_d" value="{{$h3_d}}">
                    <input type="hidden" name="h3_m" id="h3_m" value="{{$h3_m}}">
                    <input type="hidden" name="h3_t" id="h3_t" value="{{$h3_t}}">

                    <input type="hidden" name="h4_s" id="h4_s" value="{{$h4_s}}">
                    <input type="hidden" name="h4_d" id="h4_d" value="{{$h4_d}}">
                    <input type="hidden" name="h4_m" id="h4_m" value="{{$h4_m}}">
                    <input type="hidden" name="h4_t" id="h4_t" value="{{$h4_t}}">

                    <input type="hidden" name="h5_s" id="h5_s" value="{{$h5_s}}">
                    <input type="hidden" name="h5_d" id="h5_d" value="{{$h5_d}}">
                    <input type="hidden" name="h5_m" id="h5_m" value="{{$h5_m}}">
                    <input type="hidden" name="h5_t" id="h5_t" value="{{$h5_t}}">
                </div>
                <div class="col-lg-4 d-none">
                    <b class="text-center text-30">ITINERARIES</b>
                    <div class="col-lg-12 hide">
                        <div class="row text-center">
                            <div class="col-lg-1"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                            <div class="col-lg-3">
                                <div class="checkbox1">
                                    <label class=" text-unset text-danger text-12">
                                        <input class="destinospack3" type="radio" name="pos_dias[]" value="0">
                                        <b><span id="dia_l">5</span>DAYS</b>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="checkbox1">
                                    <label class=" text-unset text-danger text-12">
                                        <input class="destinospack3" type="radio" name="pos_dias[]" value="0">
                                        <b><span id="dia_c">5</span>DAYS</b>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="checkbox1">
                                    <label class=" text-unset text-danger text-12">
                                        <input class="destinospack3" type="radio" name="pos_dias[]" value="0">
                                        <b><span id="dia_r">5</span>DAYS</b>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-1"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                        </div>
                    </div>

                </div>
                <div class="d-none">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="font-montserrat text-primary"><span class="label bg-primary">1</span> Client</h4>
                            <div class="divider margin-bottom-20"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="txt_name2">Name</label>
                                <input type="text" class="form-control" id="txt_name2" name="txt_name2" placeholder="Name" >
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="txt_email">Email</label>
                                <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="txt_country">Country</label>
                                <input type="text" class="form-control" id="txt_country" name="txt_country" placeholder="Country">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="txt_phone">Phone</label>
                                <input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="font-montserrat text-primary"><span class="label bg-primary">2</span> Details</h4>
                            <div class="divider margin-bottom-20"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="txt_travellers">Travellers</label>
                                <input type="number" class="form-control" id="txt_travellers" name="txt_travellers" placeholder="Travellers" min="1">
                            </div>
                        </div>
                        <div class="col-2 ">
                            <div class="form-group">
                                <label for="txt_days">Days</label>
                                <input type="number" class="form-control" id="txt_days" name="txt_days" placeholder="Days" min="1" onchange="pasar_dias()">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="txt_travel_date">Travel date</label>
                                <input type="date" class="form-control" id="txt_travel_date" name="txt_travel_date" placeholder="Travel date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="font-montserrat text-primary"><span class="label bg-primary">3</span> Categories</h4>
                            <div class="divider margin-bottom-20"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="checkbox1">
                                <label class=" text-orange-goto">
                                    <input class="destinospack4" type="checkbox" name="strellas_2" id="strellas_2" value="2" onchange="filtrar_estrellas1(2)">
                                    2 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="checkbox1">
                                <label class=" text-orange-goto">
                                    <input class="destinospack4" type="checkbox" name="strellas_3" id="strellas_3" value="3" onchange="filtrar_estrellas1(3)">
                                    3 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="checkbox1">
                                <label class=" text-orange-goto">
                                    <input class="destinospack4" type="checkbox" name="strellas_4" id="strellas_4" value="4" onchange="filtrar_estrellas1(4)">
                                    4 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="checkbox1">
                                <label class=" text-orange-goto">
                                    <input class="destinospack4" type="checkbox" name="strellas_5" id="strellas_5" value="5" onchange="filtrar_estrellas1(5)">
                                    5 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4 class="font-montserrat text-primary"><span class="label bg-primary">4</span> Acomodacion</h4>
                            <div class="divider margin-bottom-20"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="checkbox1">
                                <label class=" text-unset">
                                    <input class="destinospack5" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">
                                    <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                                </label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="checkbox1">
                                <label class=" text-unset">
                                    <input class="destinospack5" type="checkbox" name="acomodacion_d" id="acomodacion_d" value="2">
                                    <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                                </label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="checkbox1">
                                <label class=" text-unset">
                                    <input class="destinospack5" type="checkbox" name="acomodacion_m" id="acomodacion_m" value="2">
                                    <b class="text-20px"><i class="fa fa-venus-mars fa-2x" aria-hidden="true"></i></b>
                                </label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="checkbox1">
                                <label class=" text-unset">
                                    <input class="destinospack5" type="checkbox" name="acomodacion_t" id="acomodacion_t" value="3">
                                    <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="list-package"  class="row hide">
                        <div class="col-3">
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/new-proposal.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload">
                                    <b class="margin-top-5"><i class="fa fa-newspaper-o text-green-goto" aria-hidden="true"></i> New Package</b>
                                    <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                </div>
                                <div class="box-letter-proposal text-center">
                                    NEW
                                </div>
                            </div>
                        </div>
                        <div class="col-3 hide">
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload">
                                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-B.jpg</b>
                                    <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                </div>
                                <div class="box-letter-proposal text-center">
                                    B
                                </div>
                            </div>
                        </div>
                        <div class="col-3 hide">
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload">
                                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-C.jpg</b>
                                    <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                </div>
                                <div class="box-letter-proposal text-center">
                                    C
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top-20">
                        <div class="col-lg-12">
                            <h4 class="font-montserrat text-primary"><span class="label bg-primary">5</span> Destinations</h4>
                            <div class="divider margin-bottom-20"></div>
                        </div>
                    </div>
                    <div class="row">
                        {{csrf_field()}}
                        @foreach($destinos as $destino)
                            <div class="col-3">
                                <div class="checkbox1">
                                    <label class=" text-unset">
                                        <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->destino}}">
                                        {{$destino->destino}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row margin-top-20">
                        <div class="col-lg-12 text-center">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-lg btn-primary">Create package <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <label class="font-weight-bold text-g-dark d-block pb-1">Destinations</label>
            <div class="swiper-container-1">
                <div class="swiper-wrapper p-2">
                    <div class="swiper-slide">
                        @php
                            $deti='';
                        @endphp
                        @foreach($destinos->where('estado','1')->sortBy('destino') as $destino)
                            <div class="">
                                <div class="text-13">
                                    <label class="m-0">
                                        <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->id.'_'.$destino->destino}}" onchange="poner_dias($('#web').val(),$('#txt_days').val())">
                                        {{ucwords(strtolower($destino->destino))}}
                                    </label>
                                </div>
                            </div>
                            @php
                                $deti.=$destino->id.'/';
                            @endphp
                        @endforeach
                        @php
                            $deti=substr($deti,0,strlen($deti)-1);
                        @endphp


                        {{--@php--}}
                            {{--$deti='';--}}
                        {{--@endphp--}}
                        {{--@foreach($destinos as $destino)--}}

                                {{--<div class="checkbox1">--}}
                                    {{--<label class=" text-unset">--}}
                                        {{--<input class="" type="checkbox" name="destinos[]" value="{{$destino->id.'_'.$destino->destino}}" onchange="filtrar_itinerarios1()">--}}
                                        {{--{{$destino->destino}}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--<div class="custom-control custom-checkbox">--}}
                                {{--<input type="checkbox" class="custom-control-input" id="{{$destino->id}}-des" name="destinos[]" value="{{$destino->id.'_'.$destino->destino}}" onchange="filtrar_itinerarios1()">--}}
                                {{--<label class="custom-control-label" for="{{$destino->id}}-des" onchange="filtrar_itinerarios1()">{{ucwords(strtolower($destino->destino))}}</label>--}}
                            {{--</div>--}}

                            {{--@php--}}
                                {{--$deti.=$destino->id.'/';--}}
                            {{--@endphp--}}
                        {{--@endforeach--}}
                        {{--@php--}}
                            {{--$deti=substr($deti,0,strlen($deti)-1);--}}
                        {{--@endphp--}}
                    </div>
                </div>
                <div class="swiper-scrollbar"></div>
                <input type="hidden" id="desti" value="{{$deti}}">
            </div>
        </div>
    </div>
    <div class="row m-0 p-0">
        <div class="col">
            <div class="row justify-content-start">
                <div class="col">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li role="presentation" class="nav-item active"><a href="#database" class="nav-link active" aria-controls="database" role="tab" data-toggle="tab">PACKAGES</a></li>
                        <li role="presentation" class="nav-item"><a href="#new" class="nav-link" aria-controls="new" role="tab" data-toggle="tab">NEW</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="database">
                    <div class="row">
                        <div class="col-9">
                            <div class="row" id="pqts">
                            </div>
                        </div>
                        <div class="col-3">
                            <form action="{{route('nuevo_paquete_plantilla_path')}}" method="post" id="form_nuevo_pqt_" name="form_nuevo_pqt_" class="sticky-top pt-1">
                                <div class="card bg-light mt-3 p-3">
                                    <div class="row">
                                        <div class="col">
                                            <p class="h5 text-secondary">
                                                <b  id="estrellas_" class="">2 STARS</b> |
                                                <b id="dias_html_0">{{$days}} d</b>
                                            </p>
                                            {{csrf_field()}}
                                            <input type="hidden" id="estrellas_from_" name="estrellas_from_" value="2">
                                            <input type="hidden" id="a_s_" name="a_s_" value="0">
                                            <input type="hidden" id="a_d_" name="a_d_" value="0">
                                            <input type="hidden" id="a_m_" name="a_m_" value="0">
                                            <input type="hidden" id="a_t_" name="a_t_" value="0">
                                            <input type="hidden" name="txt_country1_" id="txt_country1_">
                                            <input type="hidden" name="txt_name1_" id="txt_name1_">
                                            <input type="hidden" name="txt_email1_" id="txt_email1_">
                                            <input type="hidden" name="txt_phone1_" id="txt_phone1_">
                                            <input type="hidden" name="txt_travelers1_" id="txt_travelers1_">
                                            <input type="hidden" name="txt_days1_" id="txt_days1_">
                                            <input type="hidden" name="txt_date1_" id="txt_date1_">
                                            <input type="hidden" name="txt_destinos1_" id="txt_destinos1_">
                                            <input type="hidden" name="pqt_id" id="pqt_id" value="0">
                                            <input type="hidden" name="plan" id="plan" value="{{$plan}}">
                                            <input type="hidden" name="cotizacion_id_" id="cotizacion_id_" value="{{$coti_id}}">
                                            <input type="hidden" name="cliente_id_" id="cliente_id_" value="{{$cliente_id}}">
                                            <input type="hidden" name="web_" id="web_" value="gotoperu.com">
                                            <input type="hidden" name="codigo_" id="codigo_" value="{{$codigo}}">
                                            <input type="hidden" name="notas_" id="notas_" value="">
                                            <input type="hidden" name="txt_idioma2" id="txt_idioma2" value="{{$idioma_pasajeros}}">
                                            <input type="hidden" name="txt_movilid2" id="txt_movilid2" value="0">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            {{--<div class="col-lg-3"><b class="text-20">New</b></div>--}}
                                            {{--<div class="col-lg-3"><b class="text-20" id="dias_html_0">{{$days}} days</b></div>--}}
                                            <p class="h1 text-g-yellow"><sup>$</sup><b id="precio_plantilla">0</b></p>
                                            <div class="col-lg-12 margin-top-5 margin-bottom-5">
                                                <button type="submit" class="btn btn-green btn-block" onclick="enviar_form2()">GO</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="new">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col margin-top-25">
                                    <div class="row">
                                        <div class="col-12">
                                            <select class="form-control" name="destinos_busqueda" id="destinos_busqueda" onclick="buscar_day_by_day_quotes($(this).val())">
                                            <option value="0">Escoja un destino</option>
                                            @foreach($destinos as $destino)
                                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="sr-only" for="txt_buscar">Buscar</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="txt_buscar" name="txt_buscar" placeholder="Buscar" onkeyup="buscar_destino_day_by_day($(this).val())">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-left align-middle col-12 margin-top-5" id="resultado_busqueda" style="height: 500px; overflow-y: auto;">
                                            </div>
                                        </div>
                                    </div>
                                    

                                    
                                </div>
                                <div class="col-1 margin-top-40">
                                    <a href="#!" class="btn btn-primary" onclick="Pasar_datos1()"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                    <input type="hidden" name="nroItinerario" id="nroItinerario" value="0">
                                </div>
                                <div class="col margin-top-25">
                                    <div class="row">
                                        <form action="{{route('nuevo_paquete_path')}}" method="post" id="form_nuevo_pqt" name="form_nuevo_pqt" class="w-100 col">
                                            <div class="card bg-light mt-3 p-3 sticky-top pt-1 w-100">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="h5 text-secondary">
                                                            <b  id="estrellas" class="">2 STARS</b> |
                                                            <b id="dias_html">{{$days}} d</b>
                                                        </p>
                                                        {{csrf_field()}}
                                                        <input type="hidden" id="estrellas_from" name="estrellas_from" value="2">
                                                        <input type="hidden" id="a_s" name="a_s" value="0">
                                                        <input type="hidden" id="a_d" name="a_d" value="0">
                                                        <input type="hidden" id="a_m" name="a_m" value="0">
                                                        <input type="hidden" id="a_t" name="a_t" value="0">
                                                        <input type="hidden" name="txt_country1" id="txt_country1">
                                                        <input type="hidden" name="txt_name1" id="txt_name1">
                                                        <input type="hidden" name="txt_email1" id="txt_email1">
                                                        <input type="hidden" name="txt_phone1" id="txt_phone1">
                                                        <input type="hidden" name="txt_travelers1" id="txt_travelers1">
                                                        <input type="hidden" name="txt_days1" id="txt_days1">
                                                        <input type="hidden" name="txt_date1" id="txt_date1">
                                                        <input type="hidden" name="txt_destinos1" id="txt_destinos1">
                                                        <input type="hidden" name="lista_itinerarios1" id="lista_itinerarios1">
                                                        <input type="hidden" name="totalItinerario" id="totalItinerario" value="0">
                                                        <input type="hidden" name="plan1" id="plan1" value="{{$plan}}">
                                                        <input type="hidden" name="cotizacion_id_1" id="cotizacion_id_1" value="{{$coti_id}}">
                                                        <input type="hidden" name="cliente_id_1" id="cliente_id_1" value="{{$cliente_id}}">
                                                        <input type="hidden" name="web1" id="web1" value="gotoperu.com">
                                                        <input type="hidden" name="txt_codigo1" id="txt_codigo1" value="{{$codigo}}">
                                                        <input type="hidden" name="notas1" id="notas1" value="">
                                                        <input type="hidden" name="txt_idioma1" id="txt_idioma1" value="{{$idioma_pasajeros}}">
                                                        <input type="hidden" name="h2_s_" id="h2_s_" value="{{$h2_s}}">
                                                        <input type="hidden" name="h2_d_" id="h2_d_" value="{{$h2_d}}">
                                                        <input type="hidden" name="h2_m_" id="h2_m_" value="{{$h2_m}}">
                                                        <input type="hidden" name="h2_t_" id="h2_t_" value="{{$h2_t}}">

                                                        <input type="hidden" name="h3_s_" id="h3_s_" value="{{$h3_s}}">
                                                        <input type="hidden" name="h3_d_" id="h3_d_" value="{{$h3_d}}">
                                                        <input type="hidden" name="h3_m_" id="h3_m_" value="{{$h3_m}}">
                                                        <input type="hidden" name="h3_t_" id="h3_t_" value="{{$h3_t}}">

                                                        <input type="hidden" name="h4_s_" id="h4_s_" value="{{$h4_s}}">
                                                        <input type="hidden" name="h4_d_" id="h4_d_" value="{{$h4_d}}">
                                                        <input type="hidden" name="h4_m_" id="h4_m_" value="{{$h4_m}}">
                                                        <input type="hidden" name="h4_t_" id="h4_t_" value="{{$h4_t}}">

                                                        <input type="hidden" name="h5_s_" id="h5_s_" value="{{$h5_s}}">
                                                        <input type="hidden" name="h5_d_" id="h5_d_" value="{{$h5_d}}">
                                                        <input type="hidden" name="h5_m_" id="h5_m_" value="{{$h5_m}}">
                                                        <input type="hidden" name="h5_t_" id="h5_t_" value="{{$h5_t}}">

                                                        <input type="hidden" name="hotel_id_2" id="hotel_id_2" value="{{$hotel_id_2}}">
                                                        <input type="hidden" name="hotel_id_3" id="hotel_id_3" value="{{$hotel_id_3}}">
                                                        <input type="hidden" name="hotel_id_4" id="hotel_id_4" value="{{$hotel_id_4}}">
                                                        <input type="hidden" name="hotel_id_5" id="hotel_id_5" value="{{$hotel_id_5}}">
                                                        <input type="hidden" name="txt_movilid1" id="txt_movilid1" value="0">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <p class="h1 text-g-yellow"><sup>$</sup><b id="st_new">0</b></p>
                                                        <div class="col-lg-12 text-right margin-top-5 margin-bottom-5">
                                                            <button type="submit" class="btn btn-green btn-block" onclick="enviar_form1()">GO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class='col-lg-12 box-list-book2'>
                                                    <li value="0" class="borar_stetica">
                                                        <ol id="Lista_itinerario_g" class='simple_with_animation vertical no-padding no-margin caja_sort'>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        calcular_resumen();
        $(function()
        {
            $( "#txt_name" ).autocomplete({
                source: "../../../quotes/autocomplete",
                minLength: 2,
                select: function(event, ui) {
                    $('#txt_name').val(ui.item.value);
                }
            });
        });
    
        var adjustment;
        $('.caja_sort').sortable({
            connectWith:'.caja_sort',
            tolerance:'intersect',
            stop:function(){
                calcular_ancho($(this));
            },
        });
        function calcular_ancho(obj){
            var titles =$(obj).children('.content-list-book').children('.content-list-book-s').children().children().children('.dias_iti_c2');
            $(titles).each(function(index, element){
                var elto=$(element).html();
                console.log('elto:'+elto);
                var pos=(index+1);
                $(element).html('Dia '+pos+':');
            });
        }
    </script>
@stop