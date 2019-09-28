@if (!isset($hotel_proveedor_id))
  @php
      $hotel_proveedor_id=0;
  @endphp
@endif
@if (!isset($id))
  @php
      $id=0;
  @endphp
@endif
@if (!isset($fecha_ini))
  @php
      $fecha_ini=date("Y-m-d");
  @endphp
@endif
@if (!isset($fecha_fin))
  @php
      $fecha_fin=date("Y-m-d");
  @endphp
@endif
@if (!isset($web))
  @php
      $web='ejemplo.com';
  @endphp
@endif
@if (!isset($filtro))
  @php
      $filtro='filtro';
  @endphp
@endif

@if (!isset($cotizaciones_id))
  @php
      $cotizaciones_id=0;
  @endphp
@endif
@if (!isset($itinerartio_cotis_id))
  @php
      $itinerartio_cotis_id=0;
  @endphp
@endif
@if (!isset($dia))
  @php
      $dia=0;
  @endphp
@endif
@if (!isset($grupo))
  @php
      $grupo=0;
  @endphp
@endif
@if (!isset($anio))
  @php
      $anio=date("Y");
  @endphp
@endif
@if (!isset($mes))
  @php
      $mes=date("m");
  @endphp
@endif
@if (!isset($page))
  @php
      $page='ejemplo.com';
  @endphp
@endif
@if (!isset($cotizacion_id))
  @php
      $cotizacion_id=0;
  @endphp
@endif
@if (!isset($tipo_filtro))
  @php
      $tipo_filtro='close-date';
  @endphp
@endif

<div class="menu-list text-12">
        <ul id="menu-content" class="menu-content collapsed menu1">
            <li data-toggle="collapse" data-target="#ventas" class="collapsed active1">
              <a href="#!" class="bg-green-goto text-white"><i class="fas fa-handshake"></i> SALES </a>
            </li>
            <ul class="sub-menu collapse menu2 @if(
              (url()->current()==route('current_sales_type_page_path',[$anio,$mes,$page,$tipo_filtro])||url()->current()==route('cotizacion_id_show_path',[$cotizacion_id])||url()->current()==route('quotes_new1_expedia_path')||url()->current()==route('quotes_new1_pagina_path',$web))) show @endif" id="ventas">
              @foreach ($webs->sortBy('pagina')->where('estado',1) as $item)
                <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('current_sales_type_page_path',[$anio,$mes,$item->pagina,$tipo_filtro])||url()->current()==route('cotizacion_id_show_path',[$cotizacion_id])||url()->current()==route('quotes_new1_pagina_path',$item->pagina))) active @endif " href="{{route('current_sales_type_page_path',[$anio,$mes,$item->pagina,$tipo_filtro])}}">{{strtoupper($item->pagina)}}</a>
                </li>
              @endforeach
            </ul>

            <li data-toggle="collapse" data-target="#reservations" class="collapsed">
              <a href="#!" class="bg-orange-goto text-white"><i class="fas fa-book"></i> RESERVATIONS </a>
            </li>
            <ul class="sub-menu collapse menu2 @if(
              (url()->current()==route('book_path')||url()->current()==route('book_show_path',[$id])||url()->current()==route('servicios_add_path',[$cotizaciones_id,$itinerartio_cotis_id,$dia]))||
              (url()->current()==route('situacion_servicios_path')||url()->current()==route('provider_new_path')||url()->current()==route('provider_edit_path'))||
              (url()->current()==route('crear_liquidacion_path')||url()->current()==route('filtrar_liquidacion_reservas_path'))||
              (url()->current()==route('liquidaciones_hechas_path')||url()->current()==route('ver_liquidacion_path',[$fecha_ini,$fecha_fin]))) show @endif" id="reservations">

              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('book_path')||url()->current()==route('book_show_path',[$id])||url()->current()==route('servicios_add_path',[$cotizaciones_id,$itinerartio_cotis_id,$dia])) active @endif" href="{{route('book_path')}}">VIEW RESERVATIONS</a>
              </li>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('situacion_servicios_path')) active @endif" href="{{route('situacion_servicios_path')}}">RESERVATIONS STATE</a>
              </li>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('crear_liquidacion_path')) active @endif" href="{{route('crear_liquidacion_path')}}">CREATE SETTLEMENT</a>
              </li>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('liquidaciones_hechas_path')||url()->current()==route('ver_liquidacion_path',[$fecha_ini,$fecha_fin])) active @endif" href="{{route('liquidaciones_hechas_path')}}">SETTLEMENT</a>
              </li>
            </ul>

            <li data-toggle="collapse" data-target="#contabilidad" class="collapsed">
                <a href="#!" class="bg-grey-goto text-white"><i class="fas fa-cubes"></i> ACCOUNTING </a>
            </li>
            <ul class=" menu-content collapsed menu1 sub-menu collapse menu2 @if(
              (url()->current()==route('contabilidad.facturacion.path',[$anio,$mes,$page,$tipo_filtro]))||

              (url()->current()==route('contabilidad_index_path')||url()->current()==route('contabilidad_show_path',[$id]))||
              (url()->current()==route('pagos_pendientes_rango_fecha_path','HOTELS')||url()->current()==route('contabilidad.pagos_en_genral.filtrar')||url()->current()==route('contabilidad.revisar_requerimiento'))||
              (url()->current()==route('contabilidad.ingresos')||url()->current()==route('contabilidad.revisar_requerimiento_contabilidad_buscar'))||
              (url()->current()==route('contabilidad_lista_total_path'))
              ) show @endif" id="contabilidad">
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('contabilidad_lista_total_path')) active @endif" href="{{route('contabilidad_lista_total_path')}}">FILES RESERVADOS</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('contabilidad.pagos_en_genral.filtrar')) active @endif" href="{{route('contabilidad.pagos_en_genral.filtrar')}}">REQUERIMIENTOS</a>
                </li>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('contabilidad.revisar_requerimiento')||url()->current()==route('contabilidad.revisar_requerimiento_contabilidad_buscar')) active @endif" href="{{route('contabilidad.revisar_requerimiento')}}">LISTA REQUERIMIENTOS</a>
              </li>
              <br>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('contabilidad.ingresos')) active @endif" href="{{route('contabilidad.ingresos')}}">INGRESOS</a>
              </li>
              <li data-toggle="collapse" data-target="#facturacion" class="collapsed">
                  <a href="#!" class="bg-grey-goto text-white">FACTURACION </a>
              </li>
              <ul class="sub-menu collapse menu2" id="facturacion">
                  @foreach ($webs->sortBy('pagina')->where('estado',1) as $item)
                    <li data-toggle="collapse" class="active1">
                      <a class="@if(url()->current()==route('contabilidad.facturacion.path',[$anio,$mes,$item->pagina,$tipo_filtro]))) active @endif " href="{{route('contabilidad.facturacion.path',[$anio,$mes,$item->pagina,$tipo_filtro])}}">{{strtoupper($item->pagina)}}</a>
                    </li>
                  @endforeach
              </ul>



              {{-- <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('contabilidad_index_path')||url()->current()==route('contabilidad_show_path',[$id])) active @endif" href="{{route('contabilidad_index_path')}}">VIEW RESERVATIONS</a>
              </li>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('pagos_pendientes_rango_fecha_path','HOTELS')) active @endif" href="{{route('pagos_pendientes_rango_fecha_path','HOTELS')}}">PENDING PAYMENTS</a>
              </li>
               --}}

            </ul>

            <li data-toggle="collapse" data-target="#operaciones" class="collapsed">
                <a href="#!" class="bg-dark text-white"><i class="fas fa-list-alt"></i> OPERATIONS </a>
            </li>
            <ul class="sub-menu collapse menu2 @if(
              (url()->current()==route('operaciones_path')||url()->current()==route('operaciones_lista_path'))) show @endif" id="operaciones">
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('operaciones_path')||url()->current()==route('operaciones_lista_path')) active @endif" href="{{route('operaciones_path')}}">VIEW RESERVATIONS</a>
              </li>
            </ul>


            <li data-toggle="collapse" data-target="#administracion" class="collapsed">
                <a href="#!" class="bg-green-goto text-white"><i class="fas fa-chart-pie"></i> ADMINISTRACION </a>
            </li>
            <ul class="sub-menu collapse menu2 @if(
              (url()->current()==route('revisor.revisar_requerimiento')||url()->current()==route('contabilidad.revisar_requerimiento_revisor_buscar')) ||
              (url()->current()==route('administracion.ingresos'))
              ) show @endif" id="administracion">
              <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('revisor.revisar_requerimiento')||url()->current()==route('contabilidad.revisar_requerimiento_revisor_buscar')  ) active @endif" href="{{route('revisor.revisar_requerimiento')}}">REVISAR REQUERIMIENTOS</a>
              </li>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('administracion.ingresos')) active @endif" href="{{route('administracion.ingresos')}}">INGRESOS</a>
              </li>
            </ul>


            <li data-toggle="collapse" data-target="#reportes" class="collapsed">
                <a href="#!" class="bg-dange-goto-light text-white"><i class="fas fa-chart-pie"></i> REPORTS </a>
            </li>
            <ul class="sub-menu collapse menu2 @if(
              (url()->current()==route('reportes_path')||url()->current()==route('lista_de_cotizaciones_path',[$web,$fecha_ini,$fecha_fin,$filtro]))) show @endif" id="reportes">
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('reportes_path')||url()->current()==route('lista_de_cotizaciones_path',[$web,$fecha_ini,$fecha_fin,$filtro])) active @endif" href="{{route('reportes_path')}}">PROFIT</a>
              </li>
            </ul>
            <li data-toggle="collapse" data-target="#inventary" class="collapsed">
                <a href="#!"><i class="fas fa-database"></i> INVENTARY </a>
            </li>
            <ul class="sub-menu collapse menu2 @if(
            (url()->current()==route('profits_index_path',$anio))||
            (url()->current()==route('category_index_path')||url()->current()==route('category_save_path')||url()->current()==route('category_edit_path'))||
            (url()->current()==route('provider_index_path')||url()->current()==route('provider_new_path')||url()->current()==route('provider_edit_path'))||
            (url()->current()==route('service_index_path')||url()->current()==route('nuevo_producto_path')||url()->current()==route('hotel_edit_path'))||
            (url()->current()==route('costs_index_path')||url()->current()==route('mostrar_cost_new_path')||url()->current()==route('editar_hotel_proveedor_path',[$hotel_proveedor_id]))||
            (url()->current()==route('destination_index_path')||url()->current()==route('destination_save_path')||url()->current()==route('destination_edit_path'))||
            (url()->current()==route('itinerari_index_path')||url()->current()==route('daybyday_new_path')||url()->current()==route('daybyday_new_edit_path',[$id])||url()->current()==route('call_servicios_edit_path'))||
            (url()->current()==route('package_create_path')||url()->current()==route('show_itineraries_path')||url()->current()==route('show_itinerary_path',[$id])||url()->current()==route('duplicate_package_path',[$id])||url()->current()==route('package_duplicate_path'))) show @endif" id="inventary">
              <li data-toggle="collapse">
                  <a class="@if(url()->current()==route('profits_index_path',$anio)) active @endif" href="{{route('profits_index_path',date("Y"))}}">PROFIT</a>
                  </li>

              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('provider_index_path')||url()->current()==route('provider_new_path')||url()->current()==route('provider_edit_path')) active @endif" href="{{route('provider_index_path')}}">PROVIDERS</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('service_index_path')||url()->current()==route('nuevo_producto_path')||url()->current()==route('hotel_edit_path')) active @endif" href="{{route('service_index_path')}}">SERVICES</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('costs_index_path')||url()->current()==route('mostrar_cost_new_path')||url()->current()==route('editar_hotel_proveedor_path',[$hotel_proveedor_id])) active @endif" href="{{route('costs_index_path')}}">HOTELS</a>
              </li>
              <hr>
              <li data-toggle="collapse" class="active1">
                    <a class="@if(url()->current()==route('category_index_path')||url()->current()==route('category_save_path')||url()->current()==route('category_edit_path')) active @endif" href="{{route('category_index_path')}}">CATEGORIES</a>
                </li>
              <li data-toggle="collapse" class="active1">
                    <a class="@if(url()->current()==route('destination_index_path')||url()->current()==route('destination_save_path')||url()->current()==route('destination_edit_path')) active @endif" href="{{route('destination_index_path')}}">DESTINATIONS</a>
                </li>
              <li data-toggle="collapse" class="d-none">
                  <div class="row border-bottom">
                      <div class="col-6 pr-0">
                          <a class="@if(url()->current()==route('category_index_path')||url()->current()==route('category_save_path')||url()->current()==route('category_edit_path')) active @endif" href="{{route('category_index_path')}}">CATEGORIES</a>
                      </div>
                      <div class="col-6 px-0">
                          <a class="@if(url()->current()==route('destination_index_path')||url()->current()==route('destination_save_path')||url()->current()==route('destination_edit_path')) active @endif" href="{{route('destination_index_path')}}">DESTINATIONS</a>
                      </div>
                  </div>
              </li>
              <hr>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('itinerari_index_path')||url()->current()==route('daybyday_new_edit_path',[$id])||url()->current()==route('call_servicios_edit_path')) active @endif" href="{{route('itinerari_index_path')}}"><b class=" text-primary">LIST DAY BY DAY</b></a>
              </li>
              <hr>
              <li data-toggle="collapse" class="active1">
                    <a class="@if(url()->current()==route('package_create_path')) active @endif" href="{{route('package_create_path')}}"><b class=" text-primary">NEW PROGRAM</b></a>
                </li>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('show_itineraries_path')||url()->current()==route('show_itinerary_path',[$id])||url()->current()==route('duplicate_package_path',[$id])||url()->current()==route('package_duplicate_path')) active @endif" href="{{route('show_itineraries_path')}}"><b class=" text-primary">LIST PROGRAMS</b></a>
              </li>
              <li data-toggle="collapse" class="active1 d-none">
                <div class="row border-bottom">
                  <div class="col-6 pr-0">
                    <a class="" href="#!"><b class="text-warning">DAY BY DAY</b></a>
                  </div>
                  <div class="col-3 px-0 text-center">
                      <a class="@if(url()->current()==route('daybyday_new_path')) active @endif" href="{{route('daybyday_new_path')}}"><b class=" text-primary">NEW</b></a>
                  </div>
                  <div class="col-3 px-0 text-center">
                      <a class="@if(url()->current()==route('itinerari_index_path')||url()->current()==route('daybyday_new_edit_path',[$id])||url()->current()==route('call_servicios_edit_path')) active @endif" href="{{route('itinerari_index_path')}}"><b class=" text-primary">LIST</b></a>
                  </div>
                </div>
              </li>
              <li data-toggle="collapse" class="active1 d-none">
                <div class="row border-bottom">
                  <div class="col-6 pr-0">
                    <a class="" href="#!"><b class="text-warning">PROGRAMS</b></a>
                  </div>
                  <div class="col-3 px-0 text-center">
                    <a class="@if(url()->current()==route('package_create_path')) active @endif" href="{{route('package_create_path')}}"><b class=" text-primary">NEW</b></a>
                  </div>
                  <div class="col-3 px-0 text-center">
                    <a class="@if(url()->current()==route('show_itineraries_path')||url()->current()==route('show_itinerary_path',[$id])||url()->current()==route('duplicate_package_path',[$id])||url()->current()==route('package_duplicate_path')) active @endif" href="{{route('show_itineraries_path')}}"><b class=" text-primary">LIST</b></a>
                  </div>
                </div>
              </li>
            </ul>
        </ul>
 </div>
