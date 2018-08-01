<div class="content-pax">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="pull-left">
                <a href="#">
                    <img class="media-object img-circle" src="https://lut.im/7JCpw12uUT/mY0Mb78SvSIcjvkf.png" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">
                </a>
            </div>

            <h4><a href="#" style="text-decoration:none;"><strong>Grupo</strong></a> – <small><small><a href="#" style="text-decoration:none; color:grey;"><i><i class="fa fa-clock-o" aria-hidden="true"></i> ghg</i></a></small></small></h4>

            <span>
                        <div class="navbar-right">
                            <div class="dropdown">
                                <button class="btn btn-link btn-xs dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dd1" style="float: right;">
                                    <li><a href="#"><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> Report</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-ban" aria-hidden="true"></i> Ignore</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-bell" aria-hidden="true"></i> Enable notifications for this post</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-eye-slash" aria-hidden="true"></i> Hide</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-fw fa-trash" aria-hidden="true"></i> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </span>
            <hr>
            <div class="post-content">
                <div class="row">
{{--                    @foreach($cotizacion as $cotizaciones)--}}
                        @foreach($paquete as $paquetes)
                            <div class="col-md-12 text-center">
                                <h1 class="text-warning"><b>Package: {{$paquetes->titulo}} {{$paquetes->duracion}} days</b></h1>
                                {{--<h2 class="text-25">GETP500 | </h2>--}}
                            </div>

                            <div class="col-md-12">
                                <div class="alert alert-info text-center" role="alert">
                                    <a href="" class="text-20">Itinerario</a> |
                                    <a href="" class="text-20">Precios</a>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h3><b>Itinerario</b></h3>
                                <hr>
                                @foreach($paquetes->itinerario_cotizaciones  as $itinerario)
                                    <h4><b>Day {{$itinerario->dias}}: {{ucwords(strtolower($itinerario->titulo))}}</b></h4>
                                    @php echo $itinerario->descripcion; @endphp
                                @endforeach
                            </div>
                            <div class="col-md-12">
                                <h3><b>Incluye</b></h3>
                                <hr>
                                @php echo $paquetes->incluye; @endphp
                            </div>
                            <div class="col-md-12">
                                <h3><b>No Incluye</b></h3>
                                <hr>
                                @php echo $paquetes->noincluye; @endphp
                            </div>
                            <div class="col-md-12">
                                <h3><b>Opcional</b></h3>
                                <hr>
                                @php echo $paquetes->opcional; @endphp
                            </div>
                            <div class="col-md-12">
                                <h3><b>Precios</b></h3>
                                <hr>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        @php $s=0;$d=0;$m=0;$t=0; @endphp
                                        @foreach($paquetes->paquete_precios as $estado)
                                            @php
                                                $s = $s + $estado->personas_s;
                                                $d = $d + $estado->personas_d;
                                                $m = $m + $estado->personas_m;
                                                $t = $t + $estado->personas_t;
                                            @endphp
                                        @endforeach

                                        <th>Hotel Category</th>
                                        <th class="text-center @php if ($s==0) echo 'hide'; @endphp">Simple</th>
                                        <th class="text-center @php if ($d==0) echo 'hide'; @endphp">Double</th>
                                        <th class="text-center @php if ($m==0) echo 'hide'; @endphp">Matrimonial</th>
                                        <th class="text-center @php if ($t==0) echo 'hide'; @endphp">Triple</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($paquetes->paquete_precios->where('estado', 1) as $precio)
                                    <tr>
                                        <td class="text-20"><b>{{$precio->estrellas}} <i class="fa fa-star text-warning"></i></b></td>
                                        <td class="text-right @php if ($s==0) echo 'hide'; @endphp"><sup><small>$USD</small></sup> <b class="text-20">{{$precio->precio_s}}</b> <span class="label label-primary text-center display-block">{{$precio->personas_s}} <i class="fa fa-male"></i></span></td>
                                        <td class="text-right @php if ($d==0) echo 'hide'; @endphp"><sup><small>$USD</small></sup> <b class="text-20">{{$precio->precio_d}}</b> <span class="label label-primary text-center display-block">{{$precio->personas_t}} <i class="fa fa-male"></i></span></td>
                                        <td class="text-right @php if ($m==0) echo 'hide'; @endphp"><sup><small>$USD</small></sup> <b class="text-20">{{$precio->precio_m}}</b> <span class="label label-primary text-center display-block">{{$precio->personas_m}} <i class="fa fa-male"></i></span></td>
                                        <td class="text-right @php if ($t==0) echo 'hide'; @endphp"><sup><small>$USD</small></sup> <b class="text-20">{{$precio->precio_t}}</b> <span class="label label-primary text-center display-block">{{$precio->personas_t}} <i class="fa fa-male"></i></span></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        @endforeach
                    {{--@endforeach--}}
                </div>

            </div>

        </div>
    </div>
</div>
