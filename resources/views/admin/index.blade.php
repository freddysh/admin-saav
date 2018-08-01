@extends('layouts.admin.admin')
@section('content')
    <div class="row pt-3">
        <div class="col">
            <h1 class="text-g-dark">Dashboards</h1>
        </div>
    </div>
    <div class="row">
        @php
            $fecha_pqt=date("Y");
             $fecha_m=date("m");
        @endphp
        <div class="col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_pqt-1])}}"><i class="fa fa-step-backward fa-2x" aria-hidden="true"></i></a></span>
                <span id="anio_s" class="input-group-addon">{{$fecha_pqt}}</span>
                <span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_pqt+1])}}"><i class="fa fa-step-forward fa-2x" aria-hidden="true"></i></a></span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_m-1])}}"><i class="fa fa-step-backward fa-2x" aria-hidden="true"></i></a></span>
                <span id="anio_s" class="input-group-addon">{{$fecha_m}}</span>
                <span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_m+1])}}"><i class="fa fa-step-forward fa-2x" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>
    {{--<div class="row">--}}
        {{--<div class="col-lg-1"></div>--}}
        {{--<div class="col-lg-2 text-center bg-grey-goto-light1">--}}
                {{--{!! $chart->html() !!}--}}
            {{--<p><b class="text-20 text-green-goto">SALES</b></p>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 text-center bg-grey-goto-light1">--}}
            {{--{!! $chart1->html() !!}--}}
            {{--<p><b class="text-20 text-orange-goto">PROFIT</b></p>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 text-center bg-grey-goto-light2">--}}
            {{--{!! $chart2->html() !!}--}}
            {{--<p><b class="text-20 text-primary">INQUIRES</b></p>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 text-center bg-grey-goto-light2">--}}
            {{--{!! $chart3->html() !!}--}}
            {{--<p><b class="text-20 text-pink-goto">WON</b></p>--}}
        {{--</div>--}}
        {{--<div class="col-lg-2 text-center bg-grey-goto-light3">--}}
            {{--{!! $chart4->html() !!}--}}
            {{--<p><b class="text-20 text-danger">PAXS</b></p>--}}
        {{--</div>--}}
        {{--<div class="col-lg-1"></div>--}}
        {{--<!-- End Of Main Application -->--}}
        {{--{!! Charts::scripts() !!}--}}
        {{--{!! $chart->script() !!}--}}
        {{--{!! $chart1->script() !!}--}}
        {{--{!! $chart2->script() !!}--}}
        {{--{!! $chart3->script() !!}--}}
        {{--{!! $chart4->script() !!}--}}
    {{--</div>--}}


@stop