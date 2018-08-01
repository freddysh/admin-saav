
    <ul class="nav nav-tabs">
        @if($grupo=='TOURS')
            <li class="active"><a class="text-11" href="#private" data-toggle="tab">PRIVATE</a></li>
            <li><a class="text-11" href="#group" data-toggle="tab">GROUP</a></li>
        @elseif($grupo=='MOVILID')
            <li class="active"><a class="text-11" href="#auto" data-toggle="tab">AUTO</a></li>
            <li><a class="text-11" href="#suv" data-toggle="tab">SUV</a></li>
            <li><a class="text-11" href="#van" data-toggle="tab">VAN</a></li>
            <li><a class="text-11" href="#h1" data-toggle="tab">H1</a></li>
            <li><a class="text-11" href="#sprinter" data-toggle="tab">SPRINTER</a></li>
            <li><a class="text-11" href="#bus" data-toggle="tab">BUS</a></li>
        @elseif($grupo=='REPRESENT')
            <li class="active"><a class="text-11" href="#guide" data-toggle="tab">GUIDE</a></li>
            <li><a class="text-11" href="#transfer" data-toggle="tab">TRANSFER</a></li>
            <li><a class="text-11" href="#assistance" data-toggle="tab">ASSISTANCE</a></li>
        @elseif($grupo=='ENTRANCES')
            <li class="active"><a class="text-11" href="#extranjero" data-toggle="tab">EXTRANJERO</a></li>
            <li><a class="text-11" href="#national" data-toggle="tab">NATIONAL</a></li>
        @elseif($grupo=='FOOD')
            <li class="active"><a class="text-11" href="#lunch" data-toggle="tab">LUNCH</a></li>
            <li><a class="text-11" href="#dinner" data-toggle="tab">DINNER</a></li>
            <li><a class="text-11" href="#box_lunch" data-toggle="tab">BOX LUNCH</a></li>
        @elseif($grupo=='TRAINS')
            <li class="active"><a class="text-11" href="#expedition" data-toggle="tab">EXPEDITION</a></li>
            <li><a class="text-11" href="#visitadome" data-toggle="tab">VISITADOME</a></li>
            <li><a class="text-11" href="#ejecutivo" data-toggle="tab">EJECUTIVO</a></li>
            <li><a class="text-11" href="#first_class" data-toggle="tab">FIRST CLASS</a></li>
            <li><a class="text-11" href="#hiran_binghan" data-toggle="tab">HIRAN BINGHAN</a></li>
            <li><a class="text-11" href="#presidential" data-toggle="tab">PRESIDENTIAL</a></li>
        @elseif($grupo=='FLIGHTS')
            <li class="active"><a class="text-11" href="#national" data-toggle="tab">NATIONAL</a></li>
            <li><a class="text-11" href="#international" data-toggle="tab">INTERNATIONAL</a></li>
        @elseif($grupo=='OTHERS')
            <li class="active"><a class="text-11" href="#other" data-toggle="tab">OTHER</a></li>
        @endif

    </ul>
    <div class="tab-content height-300">
        @if($grupo=='TOURS')
            <div id="private" class="tab-pane fade in active">
                @foreach($servicios->where('tipoServicio','PRIVATE') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="group" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','GROUP') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='MOVILID')
            <div id="auto" class="tab-pane fade in active">
                @foreach($servicios->where('tipoServicio','AUTO') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="suv" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','SUV') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="van" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','VAN') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="h1" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','H1') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="sprinter" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','SPRINTER') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="bus" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','BUS') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='REPRESENT')
            <div id="guide" class="tab-pane fade in active">
                @foreach($servicios->where('tipoServicio','GUIDE') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="transfer" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','TRANSFER') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="assistance" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','ASSISTANCE') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='ENTRANCES')
            <div id="extranjero" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','EXTRANJERO') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="national" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','NATIONAL') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='FOOD')
            <div id="lunch" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','LUNCH') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="dinner" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','DINNER') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="box_lunch" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','BOX LUNCH') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='TRAINS')
            <div id="expedition" class="tab-pane fade in active">
                @foreach($servicios->where('tipoServicio','EXPEDITION') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="visitadome" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','VISITADOME') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="ejecutivo" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','EJECUTIVO') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="first_class" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','FIRST CLASS') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="hiran_binghan" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','HIRAN BINGHAN') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="presidential" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','PRESIDENTIAL') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='FLIGHTS')
            <div id="national" class="tab-pane fade in active">
                @foreach($servicios->where('tipoServicio','NATIONAL') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="international" class="tab-pane fade">
                @foreach($servicios->where('tipoServicio','INTERNATIONAL') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($grupo=='OTHERS')
            <div id="other" class="tab-pane fade in active">
                @foreach($servicios->sortBy('nombre') as $servicio)
                    <div id="service_{{$servicio->id}}" class="col-md-12 text-11">
                        <div class="checkbox11">
                            <label>
                                <input type="checkbox" class="servicios1" name="servicios[]" value="0_11_{{$servicio->id}}_AREQUIPA_{{$servicio->nombre}}_{{$grupo}}_{{$servicio->clase}}">
                                {{$servicio->nombre}} <span class="text-10 bg-primary"></span>  <span class="text-12 text-orange-goto">@if($servicio->precio_grupo==1){{$servicio->precio_venta/2}} @else {{$servicio->precio_venta}}@endif$ p.p</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-12 text-right">
            <a class="text-12 text-success" href="#destino" data-toggle="tab"><i class="fa fa-map-marker" aria-hidden="true"></i>
                <span class="hide" id="destinos_escoj">{{$destino_id}}</span><span class="hide" id="destinos_escoj_titulo">{{$destino}}</span>{{$destino}}</a>
        </div>
    </div>
