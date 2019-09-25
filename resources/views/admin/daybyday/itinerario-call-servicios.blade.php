
    <ul class="nav nav-tabs nav-justified">
        @if($grupo=='TOURS')
            <li class="nav-item active">
                <a class="nav-link show active small rounded-0" href="#privado" data-toggle="tab">PRIVADO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link small rounded-0" href="#compartido" data-toggle="tab">COMPARTIDO</a>
            </li>
        @elseif($grupo=='MOVILID')
            <li class="nav-item active">
                <a class="nav-link show active small rounded-0" href="#auto" data-toggle="tab">AUTO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show  small rounded-0" href="#suv" data-toggle="tab">SUV</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show  small rounded-0" href="#van" data-toggle="tab">VAN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show  small rounded-0" href="#h1" data-toggle="tab">H1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show  small rounded-0" href="#sprinter" data-toggle="tab">SPRINTER</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show  small rounded-0" href="#bus" data-toggle="tab">BUS</a>
            </li>
        @elseif($grupo=='REPRESENT')
            <li class="nav-item active">
                <a class="nav-link show active  small rounded-0" href="#guide" data-toggle="tab">GUIDE</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#transfer" data-toggle="tab">TRANSFER</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#assistance" data-toggle="tab">ASSISTANCE</a>
            </li>
        @elseif($grupo=='ENTRANCES')
            <li class="nav-item active">
                <a class="nav-link show active  small rounded-0" href="#extranjero" data-toggle="tab">EXTRANJERO</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#national" data-toggle="tab">NATIONAL</a>
            </li>
        @elseif($grupo=='FOOD')
            <li class="nav-item active">
                <a class="nav-link show active  small rounded-0" href="#lunch" data-toggle="tab">LUNCH</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#dinner" data-toggle="tab">DINNER</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#box_lunch" data-toggle="tab">BOX LUNCH</a>
            </li>
        @elseif($grupo=='TRAINS')

        @foreach ($trenes->sortby('nombre_comercial') as $tren)
            @foreach ($tren->clases->sortby('clase')->where('estado','1') as $clase)
                <li>
                    <a class="nav-link show  small rounded-0" href="#clase_{{$clase->id}}" data-toggle="tab">{{strtoupper($clase->clase)}}</a>
                </li>
            @endforeach    
        @endforeach
            {{--  <li class="nav-item active">
                <a class="nav-link show active  small rounded-0" href="#expedition" data-toggle="tab">EXPEDITION</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#visitadome" data-toggle="tab">VISITADOME</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#ejecutivo" data-toggle="tab">EJECUTIVO</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#first_class" data-toggle="tab">FIRST CLASS</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#hiran_binghan" data-toggle="tab">HIRAN BINGHAN</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#presidential" data-toggle="tab">PRESIDENTIAL</a>
            </li>  --}}
        @elseif($grupo=='FLIGHTS')
            <li class="nav-item active">
                <a class="nav-link show active  small rounded-0" href="#national" data-toggle="tab">NATIONAL</a>
            </li>
            <li>
                <a class="nav-link show  small rounded-0" href="#international" data-toggle="tab">INTERNATIONAL</a>
            </li>
        @elseif($grupo=='OTHERS')
            <li class="nav-item active">
                <a class="nav-link show active  small rounded-0" href="#other" data-toggle="tab">OTHER</a>
            </li>
        @endif

    </ul>
    <div class="tab-content mt-3">
        @if($grupo=='TOURS')
            <div id="privado" class="tab-pane fade show active">
                @foreach($servicios->whereIn('tipoServicio',['PV','PRIVATE']) as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}}
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>                     
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="compartido" class="tab-pane fade">
                @foreach($servicios->whereIn('tipoServicio',['SIC','GROUP']) as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}}
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span> 
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='MOVILID')
            <div id="auto" class="tab-pane fade show active">
                @foreach($servicios->where('tipoServicio','AUTO') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div id="suv" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','SUV') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="van" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','VAN') as $servicio)

                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="h1" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','H1') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="sprinter" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','SPRINTER') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="bus" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','BUS') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='REPRESENT')
            <div id="guide" class="tab-pane fade show active">
                @foreach($servicios->where('tipoServicio','GUIDE') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="transfer" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','TRANSFER') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="assistance" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','ASSISTANCE') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">[{{ $servicio->min_personas }}-{{ $servicio->max_personas }}]</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='ENTRANCES')
            <div id="extranjero" class="tab-pane show fade active">
                @foreach($servicios->where('tipoServicio','EXTRANJERO') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}}
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="national" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','NATIONAL') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}}
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='FOOD')
            <div id="lunch" class="tab-pane show fade active">
                @foreach($servicios->where('tipoServicio','LUNCH') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ ucwords(strtolower($servicio->nombre))}}
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="dinner" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','DINNER') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}}
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="box_lunch" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','BOX LUNCH') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}}
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='TRAINS')
            @foreach ($trenes->sortby('nombre_comercial') as $tren)
                @foreach ($tren->clases->sortby('clase') as $clase)
                    <div id="clase_{{$clase->id}}" class="tab-pane fade">
                        @foreach($servicios->where('tipoServicio',$clase->clase)->where('estado','1') as $servicio)
                            <div class="row">
                                <div id="service_{{$servicio->id}}" class="col small">
                                    <div class="checkbox11">
                                        <label class="text-primary">
                                            @php
                                                $precio_p_p=0;
                                            @endphp
                                            @if($servicio->precio_grupo==1)
                                                @php
                                                    $precio_p_p=round($servicio->precio_venta/2,2);
                                                @endphp
                                            @else 
                                                @php
                                                    $precio_p_p=round($servicio->precio_venta,2);
                                                @endphp
                                            @endif
                                            <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                            {{ucwords(strtolower($servicio->nombre))}} | 
                                            <span class="text-success">{{ $servicio->salida }}-{{ $servicio->llegada }}</span>
                                            <span class="text-g-yellow font-weight-bold">
                                                <sup>$</sup>
                                                {{$precio_p_p}} p.p
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endforeach
        @elseif($grupo=='FLIGHTS')

            <div id="national" class="tab-pane fade show active">
                @foreach($servicios->where('tipoServicio','NATIONAL') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">{{ $servicio->salida }}-{{ $servicio->llegada }}</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div id="international" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','INTERNATIONAL') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col small">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}} | 
                                    <span class="text-success">{{ $servicio->salida }}-{{ $servicio->llegada }}</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='OTHERS')
            <div id="other" class="tab-pane fade show active">
                @foreach($servicios->sortBy('nombre') as $servicio)
                    <div class="row">
                        <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                            <div class="checkbox11">
                                <label class="text-primary">
                                    @php
                                        $precio_p_p=0;
                                    @endphp
                                    @if($servicio->precio_grupo==1)
                                        @php
                                            $precio_p_p=round($servicio->precio_venta/2,2);
                                        @endphp
                                    @else 
                                        @php
                                            $precio_p_p=round($servicio->precio_venta,2);
                                        @endphp
                                    @endif
                                    <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}_{{$servicio->tipoServicio}}_{{$precio_p_p}}">
                                    {{ucwords(strtolower($servicio->nombre))}} |
                                    <span class="text-success">{{ $servicio->salida }}-{{ $servicio->llegada }}</span> | 
                                    <span class="text-success">{{ $servicio->min_personas }}-{{ $servicio->max_personas }}</span>
                                    <span class="text-g-yellow font-weight-bold">
                                        <sup>$</sup>
                                        {{$precio_p_p}} p.p
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="row">

        <div class="col text-right">
            <a class="text-12 text-success" href="#destino" data-toggle="tab"><i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                <span class="d-none" id="destinos_escoj">{{$destino_id}}</span><span class="d-none" id="destinos_escoj_titulo">{{$destino}}</span>{{$destino}}</a>
        </div>
    </div>