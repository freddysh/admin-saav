<div class="row">
    <div class="col-12">
        <!-- PARA TOURS -->
        @if($grupo=='TOURS')
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item active">
                    <a class="small nav-link show active" href="#private_{{$servicios_id}}" data-toggle="tab">PRIVATE</a>
                </li>
                <li class="nav-item">
                    <a class="small nav-link show" href="#group_{{$servicios_id}}" data-toggle="tab">COMPARTIDO</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="private_{{$servicios_id}}" class="tab-pane fade show active">
                    <div class="row mt-3">
                        @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                            @if($m_servicio->tipoServicio=='PRIVATE' || $m_servicio->tipoServicio=='PV')
                                <div class="col-4 estilo_form mx-0">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> ${{$m_servicio->precio_venta}} </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="group_{{$servicios_id}}" class="tab-pane fade">
                    <div class="row mt-3">
                        @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                            @if($m_servicio->tipoServicio=='GROUP' || $m_servicio->tipoServicio=='SIC')
                                <div class="col-4 estilo_form mx-0">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> ${{$m_servicio->precio_venta}} </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    <!-- PARA MOVILID -->
        @if($grupo=='MOVILID')
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item active">
                    <a class="small nav-link show active" href="#auto_{{$servicios_id}}" data-toggle="tab">AUTO</a>
                </li>
                <li><a class="small nav-link" href="#suv_{{$servicios_id}}" data-toggle="tab">SUV</a></li>
                <li><a class="small nav-link" href="#van_{{$servicios_id}}" data-toggle="tab">VAN</a></li>
                <li><a class="small nav-link" href="#h1_{{$servicios_id}}" data-toggle="tab">H1</a></li>
                <li><a class="small nav-link" href="#sprinter_{{$servicios_id}}" data-toggle="tab">SPRINTER</a></li>
                <li><a class="small nav-link" href="#bus_{{$servicios_id}}" data-toggle="tab">BUS</a></li>
            </ul>
            <div class="tab-content">
                <div id="auto_{{$servicios_id}}" class="tab-pane fade show active">
                    <div class="row">
                        @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                            @if($m_servicio->tipoServicio=='AUTO')
                                <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="suv_{{$servicios_id}}" class="tab-pane fade">
                    <div class="row">
                        @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                            @if($m_servicio->tipoServicio=='SUV')
                                <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="van_{{$servicios_id}}" class="tab-pane fade">
                    <div class="row">
                        @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                            @if($m_servicio->tipoServicio=='VAN')
                                <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="h1_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='H1')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
                <div id="sprinter_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='SPRINTER')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
                <div id="bus_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='BUS')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    <!-- PARA REPRESENT -->
        @if($grupo=='REPRESENT')
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a class="small" href="#guide_{{$servicios_id}}" data-toggle="tab">GUIDE</a></li>
                <li><a class="small" href="#tranfer_{{$servicios_id}}" data-toggle="tab">TRANSFER</a></li>
                <li><a class="small" href="#assistance_{{$servicios_id}}" data-toggle="tab">ASSISTANCE</a></li>
            </ul>
            <div class="tab-content">
                <div id="guide_{{$servicios_id}}" class="tab-pane fade show active">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='GUIDE')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
                <div id="tranfer_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='TRANSFER')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
                <div id="assistance_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='ASSISTANCE')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    <!-- PARA ENTRANCES -->
        @if($grupo=='ENTRANCES')
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a class="small" href="#extranjero_{{$servicios_id}}" data-toggle="tab">EXTRANJERO</a></li>
                <li><a class="small" href="#national_{{$servicios_id}}" data-toggle="tab">NATIONAL</a></li>
            </ul>
            <div class="tab-content">
                <div id="extranjero_{{$servicios_id}}" class="tab-pane fade show active">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='EXTRANJERO')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
                <div id="national_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='NATIONAL')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    <!-- PARA FOOD -->
        @if($grupo=='FOOD')
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a class="small" href="#lunch_{{$servicios_id}}" data-toggle="tab">LUNCH</a></li>
                <li><a class="small" href="#dinner_{{$servicios_id}}" data-toggle="tab">DINNER</a></li>
                <li><a class="small" href="#box_lunch_{{$servicios_id}}" data-toggle="tab">BOX LUNCH</a></li>
            </ul>
            <div class="tab-content">
                <div id="lunch_{{$servicios_id}}" class="tab-pane fade show active">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='LUNCH')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
                <div id="dinner_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='DINNER')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
                <div id="box_lunch_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='BOX LUNCH')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    <!-- PARA TRAINS -->
        @if($grupo=='TRAINS')
            <ul class="nav nav-tabs nav-justified">
                @php
                    $activo='active';
                @endphp
                @foreach($clases as $clase)
                    <li class="{{$activo}}"><a class="small" href="#{{str_replace(' ','_',$clase->clase)}}_{{$servicios_id}}" data-toggle="tab">{{$clase->clase}}</a></li>
                    @php
                        $activo='';
                    @endphp
                @endforeach
            </ul>
            <div class="tab-content">
                @php
                    $activo='active';
                @endphp
                @foreach($clases as $clase)
                    <div id="{{str_replace(' ','_',$clase->clase)}}_{{$servicios_id}}" class="tab-pane fade show {{$activo}}">
                        @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                            @if($m_servicio->tipoServicio==$clase->clase)
                                <div class="col-4 no-padding" mx-0>
                                    <div class="estilo_form clearfix small">
                                        <label class="">
                                            <input type="radio" name="op_services" id="servicio_cambiar_{{$itinerario_id}}_{{$grupo}}_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                            {{$m_servicio->nombre}}
                                        </label>
                                        <label class="text-right"> -> {{$m_servicio->precio_venta}}$ </label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @php
                        $activo='';
                    @endphp
                @endforeach
            </div>
        @endif
    <!-- PARA FLIGHTS -->
        @if($grupo=='FLIGHTS')
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a class="small" href="#national_{{$servicios_id}}" data-toggle="tab">NATIONAL</a></li>
                <li><a class="small" href="#international_{{$servicios_id}}" data-toggle="tab">INTERNATIONAL</a></li>
            </ul>
            <div class="tab-content">
                <div id="national_{{$servicios_id}}" class="tab-pane fade show active">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='NATIONAL')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
                <div id="international_{{$servicios_id}}" class="tab-pane fade">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        @if($m_servicio->tipoServicio=='INTERNATIONAL')
                            <div class="col-4 estilo_form mx-0 ">
                                    <label class="small">
                                        <input type="radio" name="op_services" id="serv_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                        {{$m_servicio->nombre}}
                                    </label>
                                    <label class="text-right"> -> <sup>$</sup>{{$m_servicio->precio_venta}} </label>
                                </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    <!-- PARA FLIGHTS -->
        @if($grupo=='OTHERS')
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a class="small" href="#others_{{$servicios_id}}" data-toggle="tab">OTHERS</a></li>
            </ul>
            <div class="tab-content">
                <div id="others_{{$servicios_id}}" class="tab-pane fade show active">
                    @foreach($m_servicios->sortBy('nombre') as $m_servicio)
                        <div class="col-4 no-padding">
                            <div class="estilo_form clear mx-0fix small">
                                <label class="">
                                    <input type="radio" name="op_services" id="servicio_cambiar_{{$itinerario_id}}_{{$grupo}}_{{$m_servicio->id}}" value="{{$m_servicio->id}}">
                                    {{$m_servicio->nombre}} {{$m_servicio->precio_venta}}$)
                                </label>
                                <label class="text-right"> -> {{$m_servicio->precio_venta}}$ </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>