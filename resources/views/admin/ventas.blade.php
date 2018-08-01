@extends('layouts.admin.ventas')
@section('content')
    <h1 class="page-header">Dashboard</h1>

    <div class="row">
        @php
            $fecha_pqt=date("Y");
             $fecha_m=date("m");
        @endphp
        <div class="col-lg-6 hide">
            <div class="input-group">
                <span class="input-group-addon"><a href="#" onclick="marcar_anio_desde('-','{{$fecha_pqt}}')"><i class="fa fa-step-backward" aria-hidden="true"></i></a></span>
                <span id="anio_desde" class="input-group-addon">{{$fecha_pqt}}</span>
                <span class="input-group-addon"><a href="#" onclick="marcar_anio_desde('+','{{$fecha_pqt}}')"><i class="fa fa-step-forward" aria-hidden="true"></i></a></span>
            </div>
            <table class="table">
                <tr>
                    <td id="mes_desde_01" class="col-lg-3 btn btn-warning" onclick="marcar_mes_desde('01')">01</td>
                    <td id="mes_desde_02" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('02')">02</td>
                    <td id="mes_desde_03" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('03')">03</td>
                    <td id="mes_desde_04" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('04')">04</td>
                </tr>
                <tr>
                    <td id="mes_desde_05" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('05')">05</td>
                    <td id="mes_desde_06" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('06')">06</td>
                    <td id="mes_desde_07" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('07')">07</td>
                    <td id="mes_desde_08" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('08')">08</td>
                </tr>
                <tr>
                    <td id="mes_desde_09" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('09')">09</td>
                    <td id="mes_desde_10" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('10')">10</td>
                    <td id="mes_desde_11" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('11')">11</td>
                    <td id="mes_desde_12" class="col-lg-3 btn btn-primary" onclick="marcar_mes_desde('12')">12</td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6 hide">
            <div class="input-group">
                <span class="input-group-addon"><a href="#" onclick="marcar_anio_hasta('-','{{$fecha_pqt}}')"><i class="fa fa-step-backward" aria-hidden="true"></i></a></span>
                <span id="anio_hasta" class="input-group-addon">{{$fecha_pqt}}</span>
                <span class="input-group-addon"><a href="#" onclick="marcar_anio_hasta('+','{{$fecha_pqt}}')"><i class="fa fa-step-forward" aria-hidden="true"></i></a></span>
            </div>
            <table class="table">
                <tr>
                    <td id="mes_hasta_01" class="col-lg-3 btn btn-warning" onclick="marcar_mes_hasta('01')">01</td>
                    <td id="mes_hasta_02" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('02')">02</td>
                    <td id="mes_hasta_03" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('03')">03</td>
                    <td id="mes_hasta_04" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('04')">04</td>
                </tr>
                <tr>
                    <td id="mes_hasta_05" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('05')">05</td>
                    <td id="mes_hasta_06" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('06')">06</td>
                    <td id="mes_hasta_07" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('07')">07</td>
                    <td id="mes_hasta_08" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('08')">08</td>
                </tr>
                <tr>
                    <td id="mes_hasta_09" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('09')">09</td>
                    <td id="mes_hasta_10" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('10')">10</td>
                    <td id="mes_hasta_11" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('11')">11</td>
                    <td id="mes_hasta_12" class="col-lg-3 btn btn-primary" onclick="marcar_mes_hasta('12')">12</td>
                </tr>
            </table>
         </div>
        <form class="hide" action="{{route('ventas_now_path')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="anio_desde" id="anio_desde_" value="{{$fecha_pqt}}">
            <input type="hidden" name="mes_desde" id="mes_desde_" value="01">
            <input type="hidden" name="anio_hasta" id="anio_hasta_" value="{{$fecha_pqt}}">
            <input type="hidden" name="mes_hasta" id="mes_hasta_" value="01">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-primary btn-lg" name="buscar">Buscar</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-1 margin-top-25">
                        <button class="btn btn-primary" name="custon" id="custon1" onclick="escojer_consulta()">Custon</button>
                    </div>
                    <form action="{{route('ventas_now_path')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="opcion" id="opcion" value="Lista">
                        <div id="custon" class="col-lg-6 hide">
                            <div class="col-lg-6">
                                <label for="">Desde</label>
                                <input class="form-control" type="date">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Hasta</label>
                                <input class="form-control" type="date">
                            </div>
                        </div>
                        <div id="lista" class="col-lg-6">
                            <label for="">Lista</label>
                            <select name="lista" id="" class="form-control">
                                <option value="1">Today</option>
                                <option value="2">Yesterday</option>
                                <option value="3">Last 7 days</option>
                                <option value="4">Las 14 days</option>
                                <option value="5">This month</option>
                                <option value="6">Last 30 days</option>
                             </select>
                        </div>
                        <div class="col-lg-1 margin-top-25">
                            <button type="submit" class="btn btn-primary" name="buscar">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-2 text-center bg-grey-goto-light1">
            {!! $chart->html() !!}
            <p><b class="text-20 text-green-goto">SALES</b></p>
        </div>
        <div class="col-lg-2 text-center bg-grey-goto-light1">
            {!! $chart1->html() !!}
            <p><b class="text-20 text-orange-goto">PROFIT</b></p>
        </div>
        <div class="col-lg-2 text-center bg-grey-goto-light2">
            {!! $chart2->html() !!}
            <p><b class="text-20 text-primary">INQUIRES</b></p>
        </div>
        <div class="col-lg-2 text-center bg-grey-goto-light2">
            {!! $chart3->html() !!}
            <p><b class="text-20 text-pink-goto">WON</b></p>
        </div>
        <div class="col-lg-2 text-center bg-grey-goto-light3">
            {!! $chart4->html() !!}
            <p><b class="text-20 text-danger">PAXS</b></p>
        </div>
        <div class="col-lg-1"></div>
        <!-- End Of Main Application -->
        {!! Charts::scripts() !!}
        {!! $chart->script() !!}
        {!! $chart1->script() !!}
        {!! $chart2->script() !!}
        {!! $chart3->script() !!}
        {!! $chart4->script() !!}
    </div>


@stop