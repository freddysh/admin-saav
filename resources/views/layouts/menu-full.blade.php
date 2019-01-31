<div class="menu-list">
        <ul id="menu-content" class="menu-content collapsed menu1">
            <li data-toggle="collapse" data-target="#inventary" class="collapsed">
              <a href="#"><i class="fas fa-database"></i> INVENTARY </a>
            </li>  
            <ul class="sub-menu collapse menu2 @if(
            (url()->current()==route('category_index_path')||url()->current()==route('category_save_path')||url()->current()==route('category_edit_path'))||
            (url()->current()==route('provider_index_path')||url()->current()==route('provider_new_path')||url()->current()==route('provider_edit_path'))||
            (url()->current()==route('service_index_path')||url()->current()==route('nuevo_producto_path'))||
            (url()->current()==route('costs_index_path')||url()->current()==route('mostrar_cost_new_path')||url()->current()==route('editar_hotel_proveedor_path',[$hotel_proveedor_id]))||
            (url()->current()==route('destination_index_path'))||
            (url()->current()==route('itinerari_index_path')||url()->current()==route('daybyday_new_path')||url()->current()==route('daybyday_new_edit_path',[$id])||url()->current()==route('call_servicios_edit_path'))||
            (url()->current()==route('show_itineraries_path')||url()->current()==route('show_itinerary_path',[$id]))) show @endif" id="inventary">
              <li data-toggle="collapse">
              <a class="@if(url()->current()==route('category_index_path')||url()->current()==route('category_save_path')||url()->current()==route('category_edit_path')) active @endif" href="{{route('category_index_path')}}">CATEGORIES</a>
              </li>
              <li data-toggle="collapse" class="active1">
                <a class="@if(url()->current()==route('provider_index_path')||url()->current()==route('provider_new_path')||url()->current()==route('provider_edit_path')) active @endif" href="{{route('provider_index_path')}}">PROVIDERS</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('service_index_path')||url()->current()==route('nuevo_producto_path')) active @endif" href="{{route('service_index_path')}}">SERVICES</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('costs_index_path')||url()->current()==route('mostrar_cost_new_path')||url()->current()==route('editar_hotel_proveedor_path',[$hotel_proveedor_id])) active @endif" href="{{route('costs_index_path')}}">HOTELS</a>
              </li>
              <hr>
              <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('destination_index_path')) active @endif" href="{{route('destination_index_path')}}">DESTINATIONS</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a class="@if(url()->current()==route('itinerari_index_path')||url()->current()==route('daybyday_new_path')||url()->current()==route('daybyday_new_edit_path',[$id])||url()->current()==route('call_servicios_edit_path')) active @endif" href="{{route('itinerari_index_path')}}">DAY BY DAY</a>
              </li>
              <li data-toggle="collapse" class="active1">
              <a class="@if(url()->current()==route('show_itineraries_path')||url()->current()==route('show_itinerary_path',[$id])) active @endif" href="{{route('show_itineraries_path')}}">PROGRAMS</a>
              </li>
            </ul>

            <li data-toggle="collapse" data-target="#ventas" class="collapsed active1">
              <a href="#" class="menu"><i class="fas fa-handshake"></i> SALES </a>
            </li>
            <ul class="sub-menu collapse menu2" id="ventas">
              @foreach ($webs->sortBy('pagina') as $item)
                <li data-toggle="collapse" class="active1"><a href="#">{{strtoupper($item->pagina)}}</a></li>
              @endforeach
            </ul>

            <li data-toggle="collapse" data-target="#reservations" class="collapsed">
              <a href="#"><i class="fas fa-book"></i> RESERVATIONS </a>
            </li>  
            <ul class="sub-menu collapse menu2" id="reservations">
              <li data-toggle="collapse" class="active1">
                <a href="#">VIEW RESERVATIONS</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a href="#">RESERVATIONS STATE</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a href="#">CREATE SETTLEMENT</a>
              </li>
              <li data-toggle="collapse" class="active1">
                  <a href="#">SETTLEMENTS</a>
              </li>
            </ul>

            <li data-toggle="collapse" data-target="#contabilidad" class="collapsed">
                <a href="#"><i class="fas fa-cubes"></i> ACCOUNTING </a>
            </li>  
            <ul class="sub-menu collapse menu2" id="contabilidad">
              <li data-toggle="collapse" class="active1">
                <a href="#">VIEW RESERVATIONS</a>
              </li>
            </ul>

            <li data-toggle="collapse" data-target="#operaciones" class="collapsed">
                <a href="#"><i class="fas fa-list-alt"></i> OPERATIONS </a>
            </li>  
            <ul class="sub-menu collapse menu2" id="operaciones">
              <li data-toggle="collapse" class="active1">
                <a href="#">VIEW RESERVATIONS</a>
              </li>
            </ul>
            <li data-toggle="collapse" data-target="#reportes" class="collapsed">
                <a href="#"><i class="fas fa-chart-pie"></i> REPORTS </a>
            </li>  
            <ul class="sub-menu collapse menu2" id="reportes">
              <li data-toggle="collapse" class="active1">
                <a href="#">PROFIT</a>
              </li>
            </ul>
        </ul>
 </div>