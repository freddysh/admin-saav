@if(session()->has('menu'))
    @if(session()->get('menu')=='ventas')
        <li>
            <a href="{{route('inventory_path')}}">Inventory</a>
        </li>
        <li>
            <a href="{{route('current_quote_page_path', 'gotoperu.com')}}">Leads</a>
        </li>
        <li>
            <a href="{{route('current_quote_page_expedia_path', [date("Y"),date("m"),'expedia.com'])}}">Expedia</a>
        </li>
        <li>
            <a href="{{route('sales_quote_page_path', 'gotoperu.com')}}">Sales</a>
        </li>
        {{--menu lateral para ventas--}}
        {{--<div class="menu-titulo text-center"><a href="!#"  class="link text-grey-goto">QUOTES</a></div>--}}
        {{--<div class="menu-lista text-center @if(session()->get('menu-lateral')=='quotes/new'){{'menu-lista-activo'}}@endif"><a href="{{route("quotes_new1_path")}}" class="link text-grey-goto">New</a></div>--}}
        {{--<div class="menu-lista text-center  @if(session()->get('menu-lateral')=='quotes/current'){{'menu-lista-activo'}}@endif"><a href="{{route('current_quote_page_path', 'gotoperu.com')}}" class="link text-grey-goto">Current</a></div>--}}
        {{--<div class="menu-titulo text-center"><a href="!#" class="link text-grey-goto">SALES</a></div>--}}
        {{--<div class="menu-lista text-center"><a class="link text-grey-goto"><b>ITIN</b></a></div>--}}
        {{--<div class="menu-lista text-center @if(session()->get('menu-lateral')=='sales/iti/destinations'){{'menu-lista-activo'}}@endif"><a href="{{route('destination_index_path')}}" class="link text-grey-goto">Destination</a></div>--}}
        {{--<div class="menu-lista text-center @if(session()->get('menu-lateral')=='sales/iti/daybyday'){{'menu-lista-activo'}}@endif"><a href="{{route("itinerari_index_path")}}" class="link text-grey-goto">Day by day</a></div>--}}
        {{--<div class="menu-lista text-center @if(session()->get('menu-lateral')=='sales/iti/new'){{'menu-lista-activo'}}@endif"><a href="{{route("package_create_path")}}" class="link text-grey-goto">Itineraries->New</a></div>--}}
        {{--<div class="menu-lista text-center @if(session()->get('menu-lateral')=='sales/iti/list'){{'menu-lista-activo'}}@endif"><a href="{{route("show_itineraries_path")}}" class="link text-grey-goto">Itineraries->List</a></div>--}}
        {{--<div class="menu-lista text-center"><a class="link text-grey-goto"><b>$</b></a></div>--}}
        {{--<div class="menu-lista  @if(session()->get('menu-lateral')=='Scategories'){{'menu-lista-activo'}}@endif"><a href="{{route('category_index_path')}}" class="link text-grey-goto">Categories</a></div>--}}
        {{--<div class="menu-lista  @if(session()->get('menu-lateral')=='Sproducts'){{'menu-lista-activo'}}@endif"><a href="{{route('service_index_path')}}" class="link text-grey-goto">Products</a></div>--}}
        {{--<div class="menu-lista  @if(session()->get('menu-lateral')=='Sproviders'){{'menu-lista-activo'}}@endif"><a href="{{route('provider_index_path')}}" class="link text-grey-goto">Providers</a></div>--}}
        {{--<div class="menu-lista  @if(session()->get('menu-lateral')=='Scosts'){{'menu-lista-activo'}}@endif"><a href="{{route('costs_index_path')}}" class="link text-grey-goto">Costs</a></div>--}}
    @endif
    @if(session()->get('menu')=='reservas')
        {{--menu lateral para operaciones--}}
        <li>
            <a href="{{route('situacion_servicios_path')}}">Situacion de servicios</a>
        </li>
        <li>
            <a href="{{route('crear_liquidacion_path')}}">Crear Liquidacion</a>
        </li>
        <li>
            <a href="{{route('liquidaciones_hechas_path')}}">Liquidaciones hechas</a>

        </li>

    @endif

    @if(session()->get('menu')=='contabilidad')
            <li><b class="">Operaciones</b></li>
            <li><a href="{{route('pagos_pendientes_rango_fecha_path','HOTELS')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Pagos pendientes</a></li>
            <li><a href="#!"><i class="fa fa-angle-right" aria-hidden="true"></i> Pagados</a></li>

            <li><b class="">Administrativo</b></li>
            <li><a href="{{route('pagos_pendientes_rango_fecha_path','HOTELS')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Planillas</a></li>
            <li><a href="#!"><i class="fa fa-angle-right" aria-hidden="true"></i> Servicios</a></li>

            <li class=""><b>Database</b></li>
            <li><a href="{{route('costs_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Costs</a></li>

    @endif
    @if(session()->get('menu')=='operaciones')
        <li class="active">
            <a href="{{route('inventory_path')}}">Inventory</a>
        </li>
        <li>
            <a href="{{route('current_quote_page_path', 'gotoperu.com')}}">Leads</a>

        </li>
        <li>
            <a href="#">Sales</a>
        </li>
        {{--<div class="menu-titulo text-center"><a href="#!"  class="link text-grey-goto">QUOTES</a></div>--}}
        {{--<ul class="nav nav-sidebar margin-bottom-0 hide">--}}
            {{--<li class="padding-side-20 bg-green-goto text-white text-20">Sales</li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Inventory</b></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li ><a href="{{route("itinerari_index_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Day by Day</a></li>--}}
            {{--<li class="bg-sub-title-aside"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Itineraries</a>--}}
                {{--<ul class="padding-side-20 nav nav-sidebar margin-bottom-0">--}}
                    {{--<li class="padding-left-30 text-unset"><a href="{{route("package_create_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>--}}
                    {{--<li class="padding-left-30 text-unset"><a href="{{route("show_itineraries_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> List</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="hide"><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Catalog</a></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Quotes</b></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li><a href="{{route("quotes_new1_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>--}}
            {{--<li><a href="{{route("current-quote_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Current</a></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Sales</b></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li><a href="{{route("pax_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Paxs</a></li>--}}
          {{--</ul>--}}
    @endif
    @if(session()->get('menu')=='reportes')
        {{--menu lateral para reportes--}}
        <li class="active">
            <a href="!#">QUOTES</a>
        </li>
        @endif
@endif
