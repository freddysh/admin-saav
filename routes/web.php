<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/crear',[
    'uses' => 'IndexController@crear',
    'as' => 'crear_path',
]);
Route::post('/crearp',[
    'uses' => 'IndexController@crearp',
    'as' => 'crear_p_path',
]);

Route::get('/',[
    'uses' => 'IndexController@inicio',
    'as' => 'inicio_path',
]);
Route::get('/atras',[
    'uses' => 'IndexController@atras',
    'as' => 'atras_path',
]);

Route::get('/menu',[
    'uses' => 'IndexController@menu',
    'as' => 'menu_path',
]);
Route::post('/login',[
    'uses' => 'UserAuthController@store',
    'as' => 'login_path',
]);

Route::get('/logout',[
    'uses' => 'UserAuthController@destroy',
    'as' => 'logout_path',
]);
//Route::get('/ventas',[
//    'uses' => 'IndexController@ventas',
//    'as' => 'ventas_path',
//]);
Route::get('/ventas/{id}',[
    'uses' => 'IndexController@index',
    'as' => 'ventas_path',
]);
Route::get('/contabilidad', [
    'uses' => 'IndexController@contabilidad',
    'as' => 'contabilidad1_path',
]);
Route::get('/reservas', [
    'uses' => 'IndexController@reservas',
    'as' => 'reservas_path',
]);
//Route::get('/reservas', [
//    'uses' => 'IndexController@index',
//    'as' => 'reservas_path',
//]);


Route::post('ventas/vista/',[
    'uses' => 'IndexController@ventas_now',
    'as' => 'ventas_now_path',
]);

Route::get('admin/',[
    'uses' => 'IndexController@index',
    'as' => 'index_path',
]);
Route::get('admin/package', [
    'uses' => 'PackageController@create',
    'as' => 'package_create_path',
]);
Route::post('admin/new-package', [
    'uses' => 'PackageController@new',
    'as' => 'package_new_path',
]);
Route::post('/admin/mostrar_itinerario', [
    'uses' => 'ItinerariController@show_Itineraries',
    'as' => 'package_new_path',
]);
Route::post('/admin/itinerario/nuevo', [
    'uses' => 'PackageController@store',
    'as' => 'package_save_new_path',
]);
Route::get('/admin/destination', [
    'uses' => 'DestinationController@index',
    'as' => 'destination_index_path',
]);
Route::post('/admin/destination', [
    'uses' => 'DestinationController@store',
    'as' => 'destination_save_path',
]);
Route::post('/admin/destination/delete', [
    'uses' => 'DestinationController@delete',
    'as' => 'destination_delete_path',
]);
Route::post('/admin/destination/edit', [
    'uses' => 'DestinationController@edit',
    'as' => 'destination_edit_path',
]);
Route::get('storage/destination/{filename}', [
    'uses' => 'DestinationController@getDestinarionImageName',
    'as' => 'destination_image_path'
]);
Route::get('admin/catalog', [
    'uses' => 'PackageController@catalog',
    'as' => 'catalog_show_path',
]);
Route::get('admin/qoute', [
    'uses' => 'QouteController@index',
    'as' => 'qoute_show_path',
]);
Route::get('admin/qoute/proposal/{id}', [
    'uses' => 'QouteController@proposal',
    'as' => 'qoute_proposal_path',
]);
Route::get('admin/qoute/proposal/options/{id}', [
    'uses' => 'QouteController@options',
    'as' => 'qoute_options_path',
]);
/*== routes for services*/
Route::get('/admin/products', [
    'uses' => 'ServicesController@index',
    'as' => 'service_index_path',
]);
Route::post('/admin/products', [
    'uses' => 'ServicesController@store',
    'as' => 'service_save_path',
]);
Route::post('/admin/products/edit', [
    'uses' => 'ServicesController@edit',
    'as' => 'service_edit_path',
]);
Route::post('/admin/services/delete', [
    'uses' => 'ServicesController@delete',
    'as' => 'service_delete_path',
]);
/*== routes for costs*/
Route::get('/admin/costs', [
    'uses' => 'CostController@index',
    'as' => 'costs_index_path',
]);
Route::get('/admin/costs/new', [
    'uses' => 'CostController@new_',
    'as' => 'mostrar_cost_new_path',
]);
Route::post('/admin/costs', [
    'uses' => 'CostController@store',
    'as' => 'costs_save_path',
]);
Route::post('/admin/costs/edit', [
    'uses' => 'CostController@edit',
    'as' => 'costs_edit_path',
]);
Route::post('/admin/costs/delete', [
    'uses' => 'CostController@delete',
    'as' => 'costs_delete_path',
]);
/*== rutas para proveedores*/
Route::any('admin/buscar-proveedor/', [
    'uses' => 'ProveedorController@autocomplete',
    'as' => 'buscar_proveedor_path',
]);
Route::post('/admin/provider', [
    'uses' => 'ProveedorController@store',
    'as' => 'provider_new_path',
]);
Route::get('/admin/provider',[
    'uses' => 'ProveedorController@index',
    'as' => 'provider_index_path',
]);
Route::post('/admin/provider/new', [
    'uses' => 'ProveedorController@store_new',
    'as' => 'provider_new_path',
]);
Route::post('/admin/provider/edit',[
    'uses' => 'ProveedorController@edit',
    'as' => 'provider_edit_path',
]);
Route::post('/admin/provider/delete', [
    'uses' => 'ProveedorController@delete',
    'as' => 'provider_delete_path',
]);
/*== rutas para itinerarios*/
Route::get('/admin/itinerary',[
    'uses' => 'ItinerariController@index',
    'as' => 'itinerari_index_path',
]);
Route::post('/admin/itinerary',[
    'uses' => 'ItinerariController@store',
    'as' => 'itinerary_save_path',
]);
Route::post('/admin/itinerary/edit',[
    'uses' => 'ItinerariController@edit',
    'as' => 'itinerary_edit_path',
]);
Route::post('/admin/itinerary/delete',[
    'uses' => 'ItinerariController@delete',
    'as' => 'itinerary_delete_path',
]);
Route::get('/admin/categories',[
    'uses' => 'CategoryController@show',
    'as' => 'category_index_path',
]);
Route::post('/admin/categories/new',[
    'uses' => 'CategoryController@store',
    'as' => 'category_save_path',
]);
Route::post('/admin/categories/edit',[
    'uses' => 'CategoryController@edit',
    'as' => 'category_edit_path',
]);
Route::post('/admin/categories/delete',[
    'uses' => 'CategoryController@delete',
    'as' => 'Category_delete_path',
]);
Route::get('admin/buscar-product/', [
    'uses' => 'ServicesController@autocomplete',
    'as' => 'buscar_service_path',
]);
Route::get('admin/quotes/new/', [
    'uses' => 'QouteController@nuevo',
    'as' => 'quotes_new_path',
]);
Route::get('admin/quotes/new/profile',[
    'uses' => 'QouteController@nuevo1',
    'as' => 'quotes_new1_path',
]);
Route::get('admin/quotes/new/profile/{pagina}',[
    'uses' => 'QouteController@nuevo1_pagina',
    'as' => 'quotes_new1_pagina_path',
]);
Route::get('admin/quotes/expedia/new/profile',[
    'uses' => 'QouteController@expedia',
    'as' => 'quotes_new1_expedia_path',
]);
Route::post('/admin/quotes/store', [
    'uses' => 'PackageCotizacionController@store',
    'as' => 'package_cotizacion_save_path',
]);
Route::any('/admin/quotes/proposal/{id}/{id2}/{id3}', [
    'uses' => 'PackageCotizacionController@options',
    'as' => 'new_plan_path',
]);
Route::post('/admin/guardar-cotizacion-paquete', [
    'uses' => 'PackageCotizacionController@store_package',
    'as' => 'cotizacion_package_save_path',
]);
Route::post('/admin/send-cotizacion', [
    'uses' => 'PackageCotizacionController@save_cotizacion',
    'as' => 'package_cotizacion_send_path',
]);
Route::get('/admin/current-quote', [
    'uses' => 'PackageCotizacionController@current_cotizacion',
    'as' => 'current-quote_path',
]);


//

Route::get('/admin/current-quoadmin/quotes/new/step2/{page}', [
    'uses' => 'PackageCotizacionController@current_cotizacion_page',
    'as' => 'current_quote_page_path',
]);
Route::get('/admin/current-quote/expedia/{anio}/{mes}/{page}', [
    'uses' => 'PackageCotizacionController@current_cotizacion_page_expedia',
    'as' => 'current_quote_page_expedia_path',
]);
Route::get('/admin/current-quote/expedia/{anio}/{mes}/{page}/{tipo_filtro}', [
    'uses' => 'PackageCotizacionController@current_cotizacion_page_',
    'as' => 'current_sales_type_page_path',
]);
Route::post('/admin/current-quote/expedia', [
    'uses' => 'PackageCotizacionController@current_cotizacion_page_expedia_',
    'as' => 'current_quote_page_expedia_post_path',
]);

Route::get('/admin/sales-quote/{page}', [
    'uses' => 'PackageCotizacionController@sales_cotizacion_page',
    'as' => 'sales_quote_page_path',
]);

//


Route::get('admin/buscar-cotizacion/', [
    'uses' => 'PackageCotizacionController@autocomplete',
    'as' => 'buscar_cotizacion_path',
]);
Route::post('admin/show-cotization/', [
    'uses' => 'PackageCotizacionController@show_cotizacion',
    'as' => 'cotizacion_show_path',
]);
//hidalgo

//INVENTORY
Route::get('admin/inventory/', [
    'uses' => 'IndexController@inventory',
    'as' => 'inventory_path',
]);
Route::get('admin/pax/', [
    'uses' => 'QouteController@pax',
    'as' => 'pax_path',
]);
Route::get('admin/pax/{id}', [
    'uses' => 'QouteController@paxshow',
    'as' => 'pax_show_path',
]);
Route::post('admin/pax/payment', [
    'uses' => 'PaymentController@store',
    'as' => 'payment_store_path',
]);
Route::post('admin/pax/payment/update/{id}', [
    'uses' => 'PaymentController@update',
    'as' => 'payment_update_path',
]);
//RESERVAS
Route::get('admin/book', [
    'uses' => 'BookController@index',
    'as' => 'book_path',
]);
Route::get('admin/book/{id}', [
    'uses' => 'BookController@show',
    'as' => 'book_show_path',
]);
Route::get('admin/show-cotization/{id}', [
    'uses' => 'PackageCotizacionController@show_cotizacion_id',
    'as' => 'cotizacion_id_show_path',
]);
Route::get('admin/sales_paxs_path/', [
    'uses' => 'PackageCotizacionController@show_paxs',
    'as' => 'sales_paxs_path',
]);
Route::post('admin/activar-package', [
    'uses' => 'PackageCotizacionController@activar_package',
    'as' => 'activar_package_path',
]);
Route::get('admin/quotes/{id}/pdf', [
    'uses' => 'PackageCotizacionController@pdf',
    'as' => 'quotes_pdf_path',
]);
//Route::get('storage/package-itinerary/{filename}', [
//    'uses' => 'PackageCotizacionController@getItineraryImageName',
//    'as' => 'package_itinerary_image_path'
//]);
Route::get('storage/itinerary/{filename}', [
    'uses' => 'ItinerariController@getItineraryImageName',
    'as' => 'itinerary_image_path'
]);
Route::post('admin/current-quotes/probabilidad', [
    'uses' => 'PackageCotizacionController@probabilidad',
    'as' => 'agregar_probabilidad_path'
]);
Route::get('admin/current-quotes/plan/{id}', [
    'uses' => 'PackageCotizacionController@plan',
    'as' => 'mostar_planes_path'
]);
Route::post('admin/current-quotes/plan/elegido', [
    'uses' => 'PackageCotizacionController@escojer_precio_paquete',
    'as' => 'escojer_precio_paquete_path'
]);
Route::post('admin/current-quotes/enlatados', [
    'uses' => 'PackageCotizacionController@cargar_paquete_enlatados',
    'as' => 'crear_paquete_enlatados_path'
]);
Route::get('admin/current-quotes/new-plan/{id}', [
    'uses' => 'PackageCotizacionController@plan_newpackage',
    'as' => 'mostar_newpackage_path'
]);
Route::get('admin/itineraries', [
    'uses' => 'PackageController@itineraries',
    'as' => 'show_itineraries_path'
]);
Route::get('admin/itinerary/show/{id}', [
    'uses' => 'PackageController@show_itinerary',
    'as' => 'show_itinerary_path'
]);
Route::post('admin/package/edit/', [
    'uses' => 'PackageController@itinerary_edit',
    'as' => 'package_edit_path'
]);
Route::get('admin/itinerary/duplicate/{id}', [
    'uses' => 'PackageController@duplicate_itinerary',
    'as' => 'duplicate_package_path'
]);
Route::post('admin/itinerary/duplicate/', [
    'uses' => 'PackageController@itinerary_duplicate',
    'as' => 'package_duplicate_path'
]);
Route::post('/admin/package/delete', [
    'uses' => 'PackageController@delete',
    'as' => 'package_delete_path',
]);
Route::get('admin/package/{id}/pdf', [
    'uses' => 'PackageController@pdf',
    'as' => 'package_pdf_path',
]);
Route::get('admin/contabilidad/{anio}', [
    'uses' => 'PackageCotizacionController@contabilidad',
    'as' => 'contabilidad_path',
]);
Route::post('/admin/book/id', [
    'uses' => 'BookController@asignar_proveedor',
    'as' => 'asignar_proveedor_path',
]);
Route::post('/admin/book-costo/id', [
    'uses' => 'BookController@asignar_proveedor_costo',
    'as' => 'asignar_proveedor_costo_path',
]);
Route::post('/admin/venta/categorizar', [
    'uses' => 'PackageCotizacionController@categorizar',
    'as' => 'categorizar_path',
]);
Route::get('admin/contabilidad', [
    'uses' => 'ContabilidadController@index',
    'as' => 'contabilidad_index_path',
]);

Route::get('admin/contabilidad/listar/proveedores', [
    'uses' => 'ContabilidadController@list_proveedores',
    'as' => 'list_proveedores_path',
]);
Route::get('admin/contabilidad/listar/fechas', [
    'uses' => 'ContabilidadController@rango_fecha',
    'as' => 'rango_fecha_path',
]);
Route::get('admin/contabilidad/listar/fechas/{fecha_i}/{fecha_f}', [
    'uses' => 'ContabilidadController@list_fechas',
    'as' => 'list_fechas_path',
]);

Route::post('admin/contabilidad/listar/fechas/show', [
    'uses' => 'ContabilidadController@list_fechas_show',
    'as' => 'list_fechas_show_path',
]);

Route::post('admin/contabilidad/listar/fechas/rango', [
    'uses' => 'ContabilidadController@list_fechas_rango',
    'as' => 'list_fechas_rango_path',
]);

Route::get('/admin/contabilidad/show/{id}', [
    'uses' => 'ContabilidadController@show',
    'as' => 'contabilidad_show_path',
]);

Route::post('/admin/contabilidad/update_price_conta', [
    'uses' => 'ContabilidadController@update_price_conta',
    'as' => 'update_price_conta_path',
]);

Route::get('/admin/contabilidad/show/{idcotizacion}/{idservicio}', [
    'uses' => 'ContabilidadController@pagar_servicios_conta',
    'as' => 'pagar_servicios_conta_path',
]);

Route::post('/admin/contabilidad/pay_price_conta', [
    'uses' => 'ContabilidadController@pay_price_conta',
    'as' => 'pay_price_conta_path',
]);

Route::post('/admin/contabilidad/pay_a_cuenta', [
    'uses' => 'ContabilidadController@pay_a_cuenta',
    'as' => 'pay_a_cuenta_path',
]);

Route::post('/admin/contabilidad/listar/consulta', [
    'uses' => 'ContabilidadController@consulta_save',
    'as' => 'consulta_save_path',
]);

Route::post('/admin/contabilidad/listar/consulta/delete', [
    'uses' => 'ContabilidadController@consulta_delete',
    'as' => 'consulta_delete_path',
])->where('id', '[0-9]+');

Route::post('/admin/contabilidad/pagar_consulta', [
    'uses' => 'ContabilidadController@pagar_consulta',
    'as' => 'pagar_consulta_path',
]);





Route::post('admin/contabilidad/conciliar-venta', [
    'uses' => 'ContabilidadController@confirmar',
    'as' => 'contabilidad_confirmar_path',
]);
Route::post('admin/contabilidad/conciliar-venta-h', [
    'uses' => 'ContabilidadController@confirmar_h',
    'as' => 'contabilidad_confirmar_h_path',
]);
Route::post('/admin/contabilidad/pagar', [
    'uses' => 'ContabilidadController@pagar',
    'as' => 'pagar_proveedor_path',
]);
//Route::get('/admin/contabilidad/buscar/fechas/{desde}/{hasta}', [
//    'uses' => 'ContabilidadController@listar',
//    'as' => 'contabilidad_fechas_path',
//]);
Route::post('/admin/contabilidad/buscar/fechas/', [
    'uses' => 'ContabilidadController@listar_post',
    'as' => 'contabilidad_fechas_post_path',
]);
Route::post('/admin/reservas/confirmar', [
    'uses' => 'BookController@confirmar',
    'as' => 'confirmar_reserva_path',
]);
Route::post('/admin/book/hotel', [
    'uses' => 'BookController@asignar_proveedor_hotel',
    'as' => 'asignar_proveedor_hotel_path',
]);
Route::post('/admin/ventas/hotel/traer-precios', [
    'uses' => 'CostController@mostrar_hotel',
    'as' => 'mostrar_precio_hotel_path',
]);
Route::post('/admin/products-edit', [
    'uses' => 'ServicesController@edit_hotel',
    'as' => 'hotel_edit_path',
]);
// Route::post('/admin/services/delete', [
//     'uses' => 'ServicesController@delete',
//     'as' => 'service_delete_path',
// ]);
Route::post('/admin/costs/edit-hotel', [
    'uses' => 'CostController@edit_hotel',
    'as' => 'costs_edit_hotel_path',
]);
Route::post('/admin/cotizacion/delete', [
    'uses' => 'PackageCotizacionController@delete',
    'as' => 'cotizacion_delete_path',
]);
Route::post('/admin/contabilidad/pagar-hotel', [
    'uses' => 'ContabilidadController@pagar',
    'as' => 'pagar_proveedor_h_path',
]);
Route::post('/ventas/nuevo-paquete', [
    'uses' => 'PackageCotizacionController@nuevo_paquete',
    'as' => 'nuevo_paquete_path',
]);
Route::post('/ventas/new-cotizacion', [
    'uses' => 'PackageCotizacionController@editar_cotizacion1',
    'as' => 'editar_cotizacion1_path',
]);
Route::post('/ventas/save-new-package',[
    'uses' => 'PackageCotizacionController@guardar_paquete',
    'as' => 'save_new_package_path',
]);
Route::post('/ventas/nuevo-plantilla', [
    'uses' => 'PackageCotizacionController@nuevo_paquete_',
    'as' => 'nuevo_paquete_plantilla_path',
]);
Route::post('/admin/quotes/servicio/delete', [
    'uses' => 'PackageCotizacionController@delete_servicio_quotes_paso1',
    'as' => 'quotes_servicio_delete_path',
]);
Route::get('admin/current-quotes/plan/excel/{id}', [
    'uses' => 'PackageCotizacionController@plan_excel',
    'as' => 'mostar_planes_excel_path'
]);
Route::get('quotes/autocomplete', [
    'uses' => 'PackageCotizacionController@cotizacion_cliente_autocomplete',
    'as' => 'quotes_auto_path'
]);
Route::post('/admin/cliente/mostrar', [
    'uses' => 'PackageCotizacionController@mostrar_datos_cliente',
    'as' => 'quotes_cliente_mostrar_path'
]);
Route::get('/admin/quotes/new/{id}', [
    'uses' => 'PackageCotizacionController@nuevo_plan_cotizacion',
    'as' => 'new_plan_cotizacion_path'
]);
Route::get('/admin/quotes/new/step1/{cliente}/{coti_id}/{pqt_id}/{msj}', [
    'uses' => 'PackageCotizacionController@show_step1',
    'as' => 'show_step1_path'
]);
Route::get('/admin/quotes/new/step1/{cliente}/{coti_id}/{pqt_id}/{id_serv}/{msj}', [
    'uses' => 'PackageCotizacionController@show_step1_ser',
    'as' => 'show_step1_ser_path'
]);
Route::get('/admin/quotes/edit/step1/{cliente}/{coti_id}/{pqt_id}/{id_serv}', [
    'uses' => 'PackageCotizacionController@show_step1_ser_edit',
    'as' => 'show_step1_ser_edit_path'
]);
Route::get('/admin/quotes/new/step2/{coti_id}/{pqt_id}/{imprimir}', [
    'uses' => 'PackageCotizacionController@show_step2',
    'as' => 'show_step2_path'
]);
Route::post('/admin/quotes/new/step2/', [
    'uses' => 'PackageCotizacionController@show_step2_post',
    'as' => 'show_step2_post_path'
]);
Route::get('/admin/quotes/edit/step2/{coti_id}/{pqt_id}/{imprimir}', [
    'uses' => 'PackageCotizacionController@show_step2_edit',
    'as' => 'show_step2_edit_path'
]);
//
Route::post('/admin/quotes/new/step1/step1_edit', [
    'uses' => 'PackageCotizacionController@step1_edit',
    'as' => 'step1_edit_path'
]);

Route::patch('/admin/quotes/edit/step1/step1_edit/{id}', [
    'uses' => 'PackageCotizacionController@step1_edit_edit',
    'as' => 'step1_edit_edit_path'
])->where('id', '[0-9]+');

Route::post('/admin/quotes/hotel/delete', [
    'uses' => 'PackageCotizacionController@delete_hotel_quotes_paso1',
    'as' => 'quotes_hotel_delete_path',
]);
Route::post('/admin/pqt/escojer', [
    'uses' => 'PackageCotizacionController@escojer_pqt',
    'as' => 'escojer_pqt_plan',
]);
Route::post('/admin/reservas/add-code', [
    'uses' => 'PackageCotizacionController@add_cod_verif',
    'as' => 'add_cod_verif_path',
]);
Route::post('/admin/reservas/add-hora', [
    'uses' => 'PackageCotizacionController@add_time',
    'as' => 'add_time_path',
]);
Route::post('/admin/reservas/hotel/add-code', [
    'uses' => 'PackageCotizacionController@add_cod_hotel_verif',
    'as' => 'add_cod_verif_hotel_path',
]);
Route::post('/admin/reservas/hotel/add-hora', [
    'uses' => 'PackageCotizacionController@add_hora_hotel_verif',
    'as' => 'add_hora_hotel_path',
]);
Route::get('/admin/curret/clonarr/{id}/{id1}', [
    'uses' => 'PackageCotizacionController@clonar_plan',
    'as' => 'generar_pantilla1_path',
]);
Route::get('/admin/curret/clonar/{id}/{id1}', [
    'uses' => 'PackageCotizacionController@clonar_plan_id',
    'as' => 'generar_pantilla_id_path',
]);
Route::post('admin/plantilla/crear/', [
    'uses' => 'PackageController@itinerary_plantilla_crear',
    'as' => 'package_plantilla_crear_path'
]);

Route::post('/admin/quotes/new/step1/step1_edit_hotel', [
    'uses' => 'PackageCotizacionController@step1_edit_hotel',
    'as' => 'step1_edit_hotel_path'
]);
Route::get('/admin/daybyday/edit/{id}', [
    'uses' => 'PackageCotizacionController@editar_daybyday',
    'as' => 'editar_dadybyday_parh',
]);
Route::get('admin/operaciones', [
    'uses' => 'OperacionesController@index_uno',
    'as' => 'operaciones_path',
]);
Route::post('admin/operaciones/fechas', [
    'uses' => 'OperacionesController@Lista_fechas_uno',
    'as' => 'operaciones_lista_path',
]);
Route::get('admin/operaciones/s_p/{id1}/{id2}/{id3}', [
    'uses' => 'OperacionesController@sp',
    'as' => 'sp_path',
]);
Route::get('admin/operaciones/pdf/{id1}/{id2}', [
    'uses' => 'OperacionesController@pdf',
    'as' => 'imprimir_operaciones_path',
]);
Route::get('admin/operaciones/pdf-uno/{id1}/{id2}', [
    'uses' => 'OperacionesController@pdf_uno',
    'as' => 'imprimir_operaciones_uno_path',
]);
Route::get('admin/operaciones/excel/{id1}/{id2}', [
    'uses' => 'OperacionesController@excel',
    'as' => 'imprimir_operaciones_excel_path',
]);
Route::post('admin/operaciones/observacion', [
    'uses' => 'OperacionesController@asignar_observacion',
    'as' => 'asignar_observacion_servicio_path',
]);

Route::post('admin/operaciones/segunda-confirmada', [
    'uses' => 'OperacionesController@segunda_confirmada',
    'as' => 'confirmar2_reserva_path',
]);
Route::post('admin/operaciones/segunda-confirmada-hotel', [
    'uses' => 'OperacionesController@segunda_confirmada_hotel',
    'as' => 'confirmar2_reserva_hotel_path',
]);
Route::post('admin/contabilidad/listar-fechas-subir-imagen', [
    'uses' => 'ContabilidadController@guardar_imagen_pago',
    'as' => 'guardar_imagen_pago_path',
]);
Route::get('storage/contabilidad/{filename}', [
    'uses' => 'ContabilidadController@getImageName',
    'as' => 'pago_servicio_image_path'
]);
Route::post('/admin/contabilidad/update_price_conta_hotel', [
    'uses' => 'ContabilidadController@update_price_conta_hotel',
    'as' => 'update_price_conta_hotel_path',
]);
Route::get('/admin/contabilidad/show-hotel/{idcotizacion}/{idhotel}/{iditinerario}/{idproveedor}', [
    'uses' => 'ContabilidadController@pagar_servicios_conta_hotel',
    'as' => 'pagar_servicios_conta_hotel_path',
]);

Route::post('/admin/contabilidad/pay_price_hotel_conta', [
    'uses' => 'ContabilidadController@pay_price_hotel_conta',
    'as' => 'pay_price_hotel_conta_path',
]);
Route::post('/admin/contabilidad/pay_a_cuenta_hotel', [
    'uses' => 'ContabilidadController@pay_a_cuenta_hotel',
    'as' => 'pay_a_cuenta_hotel_path',
]);
Route::get('admin/contabilidad/listar-hotel/fechas', [
    'uses' => 'ContabilidadController@rango_fecha_hotel',
    'as' => 'rango_fecha_hotel_path',
]);
Route::post('admin/contabilidad/listar/fechas/rango/hotel', [
    'uses' => 'ContabilidadController@list_fechas_rango_hotel',
    'as' => 'list_fechas_rango_hotel_path',
]);
Route::get('admin/contabilidad/listar/fechas/hotel/{fecha_i}/{fecha_f}', [
    'uses' => 'ContabilidadController@list_fechas_hotel',
    'as' => 'list_fechas_hotel_path',
]);
//Route::post('admin/contabilidad/listar/fechas-hotel/show', [
//    'uses' => 'ContabilidadController@list_fechas_hotel_show',
//    'as' => 'list_fechas_hotel_show_path',
//]);
Route::get('storage/contabilidad/hotel/{filename}', [
    'uses' => 'ContabilidadController@getImageName_hotel',
    'as' => 'pago_hotel_image_path'
]);
Route::post('/admin/contabilidad/listar/hotel/consulta', [
    'uses' => 'ContabilidadController@consulta_hotel_save',
    'as' => 'consulta_hotel_save_path',
]);
Route::post('/admin/contabilidad/hotel/pagar_consulta', [
    'uses' => 'ContabilidadController@pagar_consulta_hotel',
    'as' => 'pagar_consulta_hotel_path',
]);
Route::post('admin/contabilidad/listar-fechas-hotel-subir-imagen', [
    'uses' => 'ContabilidadController@guardar_imagen_pago_hotel',
    'as' => 'guardar_imagen_pago_hotel_path',
]);
Route::post('admin/contabilidad/hotel/listar/fechas/show', [
    'uses' => 'ContabilidadController@list_fechas_show_hotel',
    'as' => 'list_fechas_hotel_show_path',
]);
Route::post('admin/package/gererar-codigo', [
    'uses' => 'PackageController@generar_codigo_plantilla',
    'as' => 'generar_codigo_plantilla_path',
]);
Route::get('admin/current-quotes/plan/total/{id}', [
    'uses' => 'PackageCotizacionController@plan_total',
    'as' => 'mostar_planes_total_path'
]);
Route::post('admin/productos/lista', [
    'uses' => 'ServicesController@listarServicios_destino',
    'as' => 'generar_codigo_plantillaq_path',
]);
Route::post('admin/hotel/delete', [
    'uses' => 'ServicesController@eliminar_servicio_hotel',
    'as' => 'eliminar_hotel_producto_path',
]);
Route::get('admin/hotel/proveedor/edit/{id}', [
    'uses' => 'HotelProveedorController@editar_hotel_proveedor',
    'as' => 'editar_hotel_proveedor_path',
]);
Route::post('admin/hotel/proveedor/edit', [
    'uses' => 'HotelProveedorController@update_hotel_proveedor',
    'as' => 'hotel_proveedor_edit_path',
]);
Route::post('/admin/cost/hotel/proveedor/delete', [
    'uses' => 'HotelProveedorController@delete',
    'as' => 'hotel_proveedor_delete_path',
]);
Route::get('admin/reportes',[
    'uses' => 'ReportesController@index',
    'as' => 'reportes_path',
]);
Route::get('admin/reportes/view/{id}',[
    'uses' => 'ReportesController@view',
    'as' => 'ver_cotizacion_path',
]);

Route::post('/contabilidad/servicios/guardar-total',[
    'uses' => 'ContabilidadController@servicios_guardar',
    'as' => 'contabilidad_servicios_guardar_path',
]);
Route::get('/admin/contabilidad/show/servicios/pagos/{idcotizacion}/{idservicio}/{proveedor_id}', [
    'uses' => 'ContabilidadController@pagar_servicios_conta_pagos',
    'as' => 'pagar_servicios_conta_pagos_path',
]);
Route::post('/admin/contabilidad/pagar_a_cuenta', [
    'uses' => 'ContabilidadController@pagar_a_cuenta',
    'as' => 'pagar_a_cuenta_path',
]);
Route::post('/admin/contabilidad/pagar_a_cuenta_1', [
    'uses' => 'ContabilidadController@pagar_a_cuenta_1',
    'as' => 'pagar_a_cuenta_1_path',
]);


Route::post('/contabilidad/hotels/guardar-total',[
    'uses' => 'ContabilidadController@hotels_guardar',
    'as' => 'contabilidad_hotels_guardar_path',
]);
Route::get('/admin/contabilidad/show/hotels/pagos/{idcotizacion}/{idservicio}/{proveedor_id}', [
    'uses' => 'ContabilidadController@pagar_hotels_conta_pagos',
    'as' => 'pagar_hotels_conta_pagos_path',
]);
Route::post('/admin/contabilidad/hotel/pagar_a_cuenta', [
    'uses' => 'ContabilidadController@pagar_a_cuenta_hotel',
    'as' => 'pagar_a_cuenta_hotel_path',
]);
Route::post('/admin/contabilidad/hotel/pagar_a_cuenta_1', [
    'uses' => 'ContabilidadController@pagar_a_cuenta_hotel_1',
    'as' => 'pagar_a_cuenta_hotel_1_path',
]);
Route::get('/admin/reservas/crear-liquidacion', [
    'uses' => 'BookController@crear_liquidacion',
    'as' => 'crear_liquidacion_path',
]);
Route::post('/admin/reservas/crear-liquidacion', [
    'uses' => 'BookController@crear_liquidacion_storage',
    'as' => 'filtrar_liquidacion_reservas_path',
]);

Route::post('/admin/reservas/guardar-liquidacion', [
    'uses' => 'BookController@guardar_liquidacion_storage',
    'as' => 'guardar_liquidacion_reservas_path',
]);
Route::get('/admin/reservas/liquidaciones', [
    'uses' => 'BookController@liquidaciones',
    'as' => 'liquidaciones_hechas_path',
]);
Route::get('/admin/reservas/liquidaciones/show/{desde}/{hasta}', [
    'uses' => 'BookController@ver_liquidaciones',
    'as' => 'ver_liquidacion_path',
]);

Route::get('/admin/contabilidad/liquidaciones/semana', [
    'uses' => 'ContabilidadController@liquidaciones',
    'as' => 'liquidaciones_hechas_conta_path',
]);
Route::get('/admin/contabilidad/liquidaciones/show/{id}/{s}/{c}/{desde}/{hasta}/{tipo}', [
    'uses' => 'ContabilidadController@ver_liquidaciones',
    'as' => 'contabilidad_ver_liquidacion_path',
]);

Route::post('/admin/contabilidad/entradas/pagar',[
    'uses' => 'ContabilidadController@entrada_pagar',
    'as' => 'contabilidad_entrada_guardar_path',
]);

Route::get('/admin/contabilidad/show-back/{id}', [
    'uses' => 'ContabilidadController@show_back',
    'as' => 'contabilidad_resumen_back_path',
]);

Route::get('/cotizacion/current/paquete/edit/{id}', [
    'uses' => 'PackageCotizacionController@show_current_paquete_edit',
    'as' => 'show_current_paquete_edit_path',
]);

Route::get('/admin/quotes/editar/step1/{cliente}/{coti_id}/{pqt_id}/{msj}', [
    'uses' => 'PackageCotizacionController@show_step1_editar',
    'as' => 'show_step1_editar_path'
]);
Route::post('/admin/contabilidad/cerrar-balance',[
    'uses' => 'ContabilidadController@cerrar_balance',
    'as' => 'cerrar_balance_conta_path',
]);
Route::post('/admin/contabilidad/hotel/cerrar-balance',[
    'uses' => 'ContabilidadController@cerrar_balance_hotel',
    'as' => 'cerrar_balance_hotel_conta_path',
]);
Route::get('/admin/ventas/service/new',[
    'uses' => 'ServicesController@nuevo_producto',
    'as' => 'nuevo_producto_path',
]);
Route::post('/admin/ventas/service/listar-proveedores',[
    'uses' => 'ServicesController@listar_proveedores_service',
    'as' => 'listar_proveedores_path',
]);
Route::post('/admin/ventas/service/eliminar-proveedor',[
    'uses' => 'ServicesController@eliminar_proveedores_service',
    'as' => 'emilinar_service_proveedores_path',
]);

Route::post('/contabilidad/servicios/guardar-total/ticket',[
    'uses' => 'ContabilidadController@servicios_guardar_ticket',
    'as' => 'contabilidad_servicios_ticket_guardar_path',
]);
Route::get('/admin/book/nuevo-servicio/{id1}/{id}/{dia}',[
    'uses' => 'BookController@nuevo_servicio',
    'as' => 'nuevo_servicio_show_add_path',
]);
Route::get('/admin/book/servicios/add/{id1}/{id2}/{id3}',[
    'uses' => 'BookController@nuevo_servicio',
    'as' => 'servicios_add_path',
]);
Route::post('/admin/book/nuevo-servicio/nuevo',[
    'uses' => 'BookController@nuevo_servicio_add',
    'as' => 'nuevo_servicio_add_path',
]);
Route::post('/admin/contabilidad/confirmar-precio-c',[
    'uses' => 'ContabilidadController@precio_c_add',
    'as' => 'precio_c_add_path',
]);
Route::post('/admin/contabilidad/confirmar-precio-c-hotel',[
    'uses' => 'ContabilidadController@precio_c_hotel_add',
    'as' => 'precio_c_hotel_add_path',
]);
Route::get('admin/contabilidad/pagos/pendientes/{grupo}', [
    'uses' => 'ContabilidadController@pagos_pendientes',
    'as' => 'pagos_pendientes_rango_fecha_path',
]);
Route::post('/admin/contabilidad/pagos/pendientes/filtrar', [
    'uses' => 'ContabilidadController@pagos_pendientes_filtro_datos',
    'as' => 'pagos_pendientes_rango_fecha_filtro_path',
]);
Route::post('admin/book/servicio/delete', [
    'uses' => 'BookController@eliminar_servicio_reservas',
    'as' => 'eliminar_reservas_servicio_path',
]);
Route::post('/admin/book-observaciones/id', [
    'uses' => 'BookController@asignar_proveedor_observacion',
    'as' => 'asignar_proveedor_observaciones_path',
]);
Route::post('admin/book/servicio/envio', [
    'uses' => 'BookController@envio_servicio_reservas',
    'as' => 'envio_reservas_servicio_path',
]);
Route::post('admin/contabilidad/entradadas/pagos-full', [
    'uses' => 'ContabilidadController@pagos_entradas_full',
    'as' => 'contabilidad_entradas_pagar_todo_path',
]);
Route::post('/admin/contabilidad/entradas/revertir',[
    'uses' => 'ContabilidadController@entrada_revertir',
    'as' => 'contabilidad_entrada_revertir_path',
]);
Route::post('/admin/contabilidad/entradas/codigo', [
    'uses' => 'ContabilidadController@guardar_codigo',
    'as' => 'contabilidad_liquidacion_guardar_codigo_path',
]);
Route::post('/admin/contabilidad/operaciones/pagos-pendientes/delete', [
    'uses' => 'ContabilidadController@pagos_pendientes_delete',
    'as' => 'pagos_pendientes_delete_path',
]);
Route::post('/admin/ventas/call/servicios/grupo',[
    'uses' => 'ItinerariController@call_servicios_grupo_get',
    'as' => 'call_servicios_grupo_get_path',
]);
Route::get('/admin/itinerary/new',[
    'uses' => 'ItinerariController@call_servicios_grupo',
    'as' => 'daybyday_new_path',
]);
Route::get('/admin/itinerary/new/edit/{id}',[
    'uses' => 'ItinerariController@call_servicios_grupo_edit',
    'as' => 'daybyday_new_edit_path',
]);
Route::post('/admin/itinerary/new/edit/',[
    'uses' => 'ItinerariController@call_servicios_edit',
    'as' => 'call_servicios_edit_path',
]);
Route::post('/admin/provider/filtro/localizacion',[
    'uses' => 'ProveedorController@call_providers_localizacion',
    'as' => 'call_providers_localizacion_path',
]);
Route::post('/admin/provider/filtro/localizacion/estrellas',[
    'uses' => 'ProveedorController@call_providers_localizacion_estrellas',
    'as' => 'call_providers_localizacion_estrellas_path',
]);

Route::post('/admin/cost-provider/filtro/localizacion',[
    'uses' => 'CostController@call_cost_providers_localizacion',
    'as' => 'call_cost_providers_localizacion_path',
]);
Route::post('/admin/cost-provider/filtro/localizacion/estrellas',[
    'uses' => 'CostController@call_cost_providers_localizacion_estrellas',
    'as' => 'call_cost_providers_localizacion_estrellas_path',
]);
Route::post('/admin/hotel-provider/delete', [
    'uses' => 'HotelProveedorController@delete',
    'as' => 'provider_delete_path',
]);
Route::post('/admin/service/change', [
    'uses' => 'BookController@change_service',
    'as' => 'cambiar_servicio_path',
]);
Route::post('/admin/contabilidad/confirmar-fecha',[
    'uses' => 'ContabilidadController@precio_fecha_add',
    'as' => 'contabilidad_add_fecha_path',
]);
Route::post('/admin/contabilidad/actualizar-titulo',[
    'uses' => 'ContabilidadController@actualizar_daybyday',
    'as' => 'contabilidad_day_by_day_actualizar_titulo_path',
]);
Route::post('/admin/contabilidad/confirmar-fecha-hotel',[
    'uses' => 'ContabilidadController@precio_fecha_hotel_add',
    'as' => 'contabilidad_add_fecha_hotel_path',
]);

Route::post('/admin/contabilidad/pagar_a_cuenta',[
    'uses' => 'ContabilidadController@pagar_a_cuenta_c',
    'as' => 'pagar_a_cuenta_c_path',
]);
Route::post('/admin/contabilidad/pagar_a_cuenta_editar',[
    'uses' => 'ContabilidadController@pagar_a_cuenta_c_editar',
    'as' => 'pagar_a_cuenta_c_editar_path',
]);
Route::post('/admin/contabilidad/pagos/servicios/pendientes/filtrar', [
    'uses' => 'ContabilidadController@pagos_pendientes_filtro_datos_servicios',
    'as' => 'pagos_pendientes_rango_fecha_filtro_servicios_path',
]);
Route::post('admin/contabilidad/servicios/listar/fechas/show', [
    'uses' => 'ContabilidadController@list_fechas_show_servicios',
    'as' => 'list_fechas_servivios_show_path',
]);
Route::post('/admin/contabilidad/pagar_a_cuenta/serv',[
    'uses' => 'ContabilidadController@pagar_a_cuenta_c_serv',
    'as' => 'pagar_a_cuenta_c_serv_path',
]);
Route::post('/admin/contabilidad/serv/pagar_a_cuenta_editar',[
    'uses' => 'ContabilidadController@pagar_a_cuenta_c_serv_editar',
    'as' => 'pagar_a_cuenta_c_serv_editar_path',
]);
Route::post('admin/contabilidad/listar-fechas-serv-subir-imagen', [
    'uses' => 'ContabilidadController@guardar_imagen_pago_serv',
    'as' => 'guardar_imagen_pago_serv_path',
]);
Route::post('/admin/contabilidad/listar/serv/consulta', [
    'uses' => 'ContabilidadController@consulta_serv_save',
    'as' => 'consulta_serv_save_path',
]);
Route::post('admin/contabilidad/listar/serv/fechas/show', [
    'uses' => 'ContabilidadController@list_fechas_serv_show',
    'as' => 'list_fechas_serv_show_path',
]);
Route::post('admin/productos/lista/empresa', [
    'uses' => 'ServicesController@listarServicios_destino_empresa',
    'as' => 'listar_productos_empresa_path',
]);
Route::post('admin/productos/lista/empresa/mostrar-clases', [
    'uses' => 'ServicesController@mostrar_clases',
    'as' => 'listar_productos_empresa_clase_path',
]);
Route::post('/admin/ventas/service/listar-movilidad',[
    'uses' => 'ServicesController@listar_rutas_movilidad',
    'as' => 'listar_movilidad_path',
]);
Route::post('admin/productos/lista/rutas', [
    'uses' => 'ServicesController@listarServicios_destino_show_rutas',
    'as' => 'lista_rutas_categoria_path',
]);
Route::post('admin/productos/lista/por-ruta', [
    'uses' => 'ServicesController@listarServicios_destino_por_rutas',
    'as' => 'generar_codigo_por_rutas_plantilla_path',
]);
Route::post('admin/productos/lista/por-ruta/cargar-tipos', [
    'uses' => 'ServicesController@listarServicios_destino_por_rutas_tipos',
    'as' => 'generar_codigo_por_rutas_tipos_plantilla_path',
]);
Route::post('admin/productos/lista/por-ruta/tipo', [
    'uses' => 'ServicesController@listarServicios_destino_rutas_tipos',
    'as' => 'generar_codigo_rutas_tipos_plantilla_path',
]);
Route::post('admin/ventas/service/listar-train/salida',[
    'uses' => 'ServicesController@listar_rutas_train_salida',
    'as' => 'listar_train_salida_path',
]);
Route::post('admin/ventas/service/listar-train/llegada',[
    'uses' => 'ServicesController@listar_rutas_train_llegada',
    'as' => 'listar_train_llegada_path',
]);
Route::get('/admin/book/nuevo-servicio/{id1}/{id}/{dia}',[
    'uses' => 'BookController@nuevo_servicio_ventas',
    'as' => 'nuevo_servicio_ventas_path',
]);
//Route::get('/admin/book/hotel/costo/edit',[
//    'uses' => 'BookController@nuevo_servicio_ventas',
//    'as' => 'asignar_proveedor_hotel_costo_path',
//]);
Route::post('/admin/book/hotel/costo/edit',[
    'uses' => 'BookController@asignar_proveedor_costo_hotel',
    'as' => 'asignar_proveedor_costo_hotel',
]);
Route::post('admin/book/listar-servicios',[
    'uses' => 'ServicesController@listar_servicios',
    'as' => 'reservas_listar_servicios_path',
]);
Route::post('admin/book/listar-servicios/localizacion',[
    'uses' => 'ServicesController@listar_servicios_localizacion',
    'as' => 'reservas_localizacion_listar_servicios_path',
]);
Route::post('admin/package/buscar-day-by-day/ajax',[
    'uses' => 'PackageController@buscar_day_by_day_ajax',
    'as' => 'package_buscar_day_by_day_ajax_path',
]);
Route::post('admin/package/buscar-day-by-day/ajax/dia',[
    'uses' => 'PackageController@buscar_day_by_day_ajax_dia',
    'as' => 'package_buscar_day_by_day_ajax_path',
]);
Route::post('admin/book/guardar-datos',[
    'uses' => 'BookController@guardar_datos',
    'as' => 'guardar_datos_flights_path',
]);
Route::post('admin/quotes/ordenar-servios-db',[
    'uses' => 'QouteController@ordenar_servios_db',
    'as' => 'ordenar_servicios_db_path',
]);
Route::post('admin/book/listar-servicios-paso1',[
    'uses' => 'ServicesController@listar_servicios_paso1',
    'as' => 'reservas_listar_servicios_paso1_path',
]);
Route::post('admin/book/listar-servicios/localizacion-paso1',[
    'uses' => 'ServicesController@listar_servicios_localizacion_paso1',
    'as' => 'reservas_localizacion_listar_servicios_paso1_path',
]);
Route::get('/admin/quotes/new/step1/nuevo-servicio/{id1}/{id2}/{id3}',[
    'uses' => 'ServicesController@nuevos_servicios',
    'as' => 'agregar_servicios_paso1_path',
]);
Route::post('admin/itineraries/listar', [
    'uses' => 'PackageController@itineraries_listar_pagina',
    'as' => 'show_itineraries_listar_path'
]);
Route::post('admin/book/servicio/confirmar', [
    'uses' => 'BookController@confirmar_servicio_reservas',
    'as' => 'confirmar_reservas_servicio_path',
]);
Route::post('admin/book/hotel/confirmar', [
    'uses' => 'BookController@confirmar_hotel_reservas',
    'as' => 'confirmar_hotel_servicio_path',
]);
Route::post('admin/book/hotel/delete', [
    'uses' => 'BookController@eliminar_hotel_reservas',
    'as' => 'eliminar_hotel_servicio_path',
]);
Route::post('admin/quotes/generar-codigo',[
    'uses' => 'QouteController@generar_codigo',
    'as' => 'quotes_generar_codigo_path',
]);
Route::post('admin/book/guardar-archivos',[
    'uses' => 'BookController@guardar_archivos',
    'as' => 'guardar_archivos_cotizacion_path',
]);
Route::get('storage/cotizacion_archivos/{filename}', [
    'uses' => 'BookController@getCotiArchivosImageName',
    'as' => 'cotizacion_archivos_image_path'
]);
Route::get('storage/cotizacion_archivos/download/{archivo}', [
    'uses' => 'BookController@downloadCotiArchivos',
    'as' => 'cotizacion_archivos_image_download_path'
]);
Route::post('admin/book/eliminar-archivo/', [
    'uses' => 'BookController@eliminar_archivo',
    'as' => 'eliminar_archivo_path'
]);
Route::post('admin/coti/{id_1}/{id_2}', [
    'uses' => 'BookController@eliminar_archivo',
    'as' => 'eliminar_archivo_path'
]);
Route::post('admin/show-cotizacion/ask_information', [
    'uses' => 'PackageCotizacionController@ask_information',
    'as' => 'package_cotizacion_ask_information_path',
]);
Route::post('admin/show-cotizacion/ingresar-notas', [
    'uses' => 'PackageCotizacionController@ingresar_notas',
    'as' => 'package_cotizacion_notas_path',
]);
Route::post('admin/show-cotizacion/ingresar-idatos', [
    'uses' => 'PackageCotizacionController@ingresar_idatos',
    'as' => 'package_cotizacion_ingresar_datos_path',
]);
Route::post('admin/contabilidad/listar/proveedores/ajax', [
    'uses' => 'ContabilidadController@pagar_a_banco',
    'as' => 'contabilidad_listar_provedores_path',
]);
Route::get('admin/contabilidad/pagos/pendientes/consulta/{id}/pdf', [
    'uses' => 'ContabilidadController@consulta_h_pdf',
    'as' => 'descargar_consulta_h_path',
]);
Route::post('admin/quotes/new/step1/cambiar-fecha/ajax',[
    'uses' => 'QouteController@cambiar_fecha',
    'as' => 'quotes_cambiar_fecha_ajax_path',
]);
Route::post('admin/contabilidad/listar/fechas/show/serv', [
    'uses' => 'ContabilidadController@list_fechas_show_serv',
    'as' => 'list_fechas_show_serv_path',
]);
Route::get('admin/contabilidad/pagos/pendientes/serv/consulta/{id}/{grupo}/pdf', [
    'uses' => 'ContabilidadController@consulta_s_pdf',
    'as' => 'descargar_consulta_s_path',
]);
Route::post('admin/reservas/notas/guardar', [
    'uses' => 'BookController@guardar_notas',
    'as' => 'reservas_guadar_notas_path',
]);
Route::post('admin/current-quote/leads', [
    'uses' => 'QouteController@leads',
    'as' => 'qoute_leads_path',
]);
Route::post('admin/quotes/expedia/new/profile/import', [
    'uses' => 'QouteController@import',
    'as' => 'expedia_import_path',
]);
Route::post('admin/quotes/expedia/new/profile/import/save',[
    'uses' => 'QouteController@expedia_save',
    'as' => 'quotes_new1_expedia_save_path',
]);
Route::post('admin/quotes/new/profile/list-paquetes',[
    'uses' => 'PackageCotizacionController@list_paquetes',
    'as' => 'Package_list_paquetes_path',
]);
Route::post('admin/book/servicio/anular', [
    'uses' => 'BookController@anular_servicio_reservas',
    'as' => 'anular_reservas_servicio_path',
]);
Route::post('admin/book/hotel/anular', [
    'uses' => 'BookController@anular_hotel_reservas',
    'as' => 'anular_hotel_servicio_path',
]);

Route::post('admin/book/list-paquetes', [
    'uses' => 'BookController@list_paquetes',
    'as' => 'list_paquetes_path',
]);
Route::post('admin/book/list-paquetes-codigo', [
    'uses' => 'BookController@list_paquetes_codigo',
    'as' => 'list_paquetes_codigo_path',
]);
Route::post('admin/quotes/new/step1/agregar-nuevo-servicio', [
    'uses' => 'PackageCotizacionController@agregar_nuevo_servicio',
    'as' => 'agregar_nuevo_servicio_path',
]);
Route::post('admin/quotes/new/step1/agregar-nuevo-hotel', [
    'uses' => 'PackageCotizacionController@agregar_nuevo_hotel',
    'as' => 'agregar_nuevo_hotel_path',
]);
Route::post('admin/quotes/new/step1/list-localizacion-hoteles', [
    'uses' => 'PackageCotizacionController@listar_hoteles',
    'as' => 'listar_hoteles_path',
]);
Route::post('admin/quotes/editar/step1/list-localizacion-hoteles', [
    'uses' => 'PackageCotizacionController@listar_hoteles',
    'as' => 'listar_hoteles_edit_path',
]);
Route::post('admin/quotes/new/step1/cambiar-hotel', [
    'uses' => 'PackageCotizacionController@cambiar_hotel',
    'as' => 'cambiar_hotel_path',
]);
Route::get('reportes/profit', [
    'uses' => 'ReportesController@profit',
    'as' => 'reporte_profit_path',
]);
Route::post('admin/reportes/profit', [
    'uses' => 'ReportesController@profit_buscar',
    'as' => 'reporte_profit_buscar_path',
]);
Route::post('admin/quotes/buscar-nro-servicios', [
    'uses' => 'PackageCotizacionController@buscar_servicios',
    'as' => 'nueva_cotizacions_buscar_path',
]);
Route::post('admin/book/traer-fecha-pago', [
    'uses' => 'PackageCotizacionController@traer_fecha_pago',
    'as' => 'traer_fecha_pago_path',
]);
Route::post('admin/book/traer-fecha-pago-h', [
    'uses' => 'PackageCotizacionController@traer_fecha_pago_h',
    'as' => 'traer_fecha_pago_h_path',
]);
Route::post('/admin/contabilidad/pagos/entradas/pendientes/filtrar', [
    'uses' => 'ContabilidadController@pagos_pendientes_filtro_datos_servicios_entradas',
    'as' => 'pagos_pendientes_rango_fecha_filtro_servicios_entrada_path',
]);
Route::post('/admin/contabilidad/pagos/entradas/pendientes/pagar', [
    'uses' => 'ContabilidadController@pagos_pendientes_entradas_pagar',
    'as' => 'pagar_entradas_path',
]);
Route::get('/admin/contabilidad/pagos/entradas/pendientes/filtrar/{opcion}/{id}', [
    'uses' => 'ContabilidadController@pagos_pendientes_filtro_datos_servicios_entradas_guardado_pagado',
    'as' => 'pagos_pendientes_rango_fecha_filtro_servicios_entrada_guardado_pagado_path',
]);
Route::get('admin/contabilidad/pagos/pendientes/serv/consulta/pdf/{id}', [
    'uses' => 'ContabilidadController@consulta_entradas_pdf',
    'as' => 'descargar_consulta_entradas_path',
]);
Route::post('/admin/book/traer-situacion-servicios', [
    'uses' => 'BookController@situacion_servicios_hoteles',
    'as' => 'situacion_servicios_busqueda_path',
]);
Route::get('/admin/book/situacion/traer-servicios',[
    'uses' => 'BookController@situacion_servicios',
    'as' => 'situacion_servicios_path',
]);
Route::get('/admin/reportes/lista-de-cotizaciones/{web}/{desde}/{hasta}/{filtro}',[
    'uses' => 'ReportesController@lista_cotizaciones',
    'as' => 'lista_de_cotizaciones_path',
]);
Route::post('/admin/quotes/new/step1/step1_edit_precio_servicios', [
    'uses' => 'PackageCotizacionController@step1_edit_precio_servicios',
    'as' => 'step1_edit_servicio_precio_path'
]);
Route::post('/admin/servicio/cambiar-estado', [
    'uses' => 'ServicesController@cambiar_estado',
    'as' => 'service_cambiar_estado_path',
]);
Route::post('/admin/cotizacion/anular', [
    'uses' => 'PackageCotizacionController@anular',
    'as' => 'cotizacion_anular_path',
]);

// rutas para los profits
Route::get('/admin/profit/{anio}',[
    'uses' => 'ProfitController@show',
    'as' => 'profits_index_path',
]);
Route::post('/admin/profit/new',[
    'uses' => 'ProfitController@store',
    'as' => 'profit_save_path',
]);
Route::post('/admin/profit/edit',[
    'uses' => 'ProfitController@edit',
    'as' => 'profit_edit_path',
]);
Route::post('/admin/profit/delete',[
    'uses' => 'ProfitController@delete',
    'as' => 'profit_delete_path',
]);
Route::post('/admin/profit/enviar_file',[
    'uses' => 'ProfitController@enviar_file',
    'as' => 'enviar_file_path',
]);
Route::get('admin/contabilidad/pagos-en-genral/filtrar/', [
    'uses' => 'ContabilidadController@pagos_pendientes_general',
    'as' => 'contabilidad.pagos_en_genral.filtrar',
]);
Route::post('/admin/contabilidad/pagos-en-genral/pendientes/filtrar', [
    'uses' => 'ContabilidadController@pagos_pendientes_general_filtro_datos',
    'as' => 'contabilidad.pagos_en_genral.filtrar.buscar',
]);
Route::post('/admin/contabilidad/operaciones/traer-datos', [
    'uses' => 'ContabilidadController@traer_datos',
    'as' => 'contabilidad.traer_datos',
]);
Route::post('/admin/contabilidad/hotel/store', [
    'uses' => 'ContabilidadController@hotel_store',
    'as' => 'contabilidad.hotel.store',
]);
Route::post('/admin/ventas/edit/agregar/dia', [
    'uses' => 'PackageCotizacionController@agregar_dia',
    'as' => 'ventas.edit.agregar.dia',
]);
Route::post('/admin/show-cotizacion/agregar-pago', [
    'uses' => 'PackageCotizacionController@agregar_pago',
    'as' => 'guardar.paquete.pagos',
]);
Route::get('/admin/contabilidad/ingresos/general', [
    'uses' => 'ContabilidadController@ingresos',
    'as' => 'contabilidad.ingresos',
]);
Route::post('admin/contabilidad/ingresos/lista-pagos', [
    'uses' => 'ContabilidadController@list_pagos',
    'as' => 'list_pagos_path',
]);

Route::post('admin/contabilidad/ingresos/buscar-pagos-recientes', [
    'uses' => 'ContabilidadController@pagos_recientes',
    'as' => 'pagos.recientes',
]);

Route::post('admin/book/hotel/traer-lista-proveedores', [
    'uses' => 'BookController@traer_lista_proveedores',
    'as' => 'hotel.traer.lista.proveedores',
]);
Route::post('admin/book/servicios/traer-lista-proveedores', [
    'uses' => 'BookController@traer_lista_proveedores_servicios',
    'as' => 'servicios.traer.lista.proveedores',
]);

Route::post('admin/book/servicios/traer-lista-proveedores/borrar', [
    'uses' => 'BookController@traer_lista_proveedores_servicios_borrar',
    'as' => 'servicios.traer.lista.proveedores',
]);
Route::post('admin/book/servicios/traer-lista-proveedores/borrar/hotel', [
    'uses' => 'BookController@traer_lista_proveedores_servicios_borrar_hotel',
    'as' => 'servicios.traer.lista.proveedores.borrar.hotel',
]);
Route::post('/admin/contabilidad/preparar-requerimiento', [
    'uses' => 'ContabilidadController@preparar_requerimiento',
    'as' => 'contabilidad.preparar_requerimiento',
]);
Route::post('/admin/contabilidad/hotel/store/notas', [
    'uses' => 'ContabilidadController@hotel_store_notas',
    'as' => 'contabilidad.hotel.store.notas',
]);
Route::post('/admin/contabilidad/enviar-requerimiento', [
    'uses' => 'ContabilidadController@enviar_requerimiento',
    'as' => 'contabilidad.enviar_requerimiento',
]);
// Route::get('/admin/contabilidad/revisar-requerimientoss', [
//     'uses' => 'ContabilidadController@pagos_pendientes_general',
//     'as' => 'contabilidad.revisar_requerimiento',
// ]);
Route::get('admin/revisor/revisar/requerimientos', [
    'uses' => 'ContabilidadController@revisar_requerimiento_revisor',
    'as' => 'revisor.revisar_requerimiento',
]);
Route::post('/admin/revisor/revisar/requerimientos/buscar', [
    'uses' => 'ContabilidadController@revisar_requerimiento_revisor_buscar',
    'as' => 'contabilidad.revisar_requerimiento_revisor_buscar',
]);
// Route::get('admin/contabilidad/operaciones/requerimientos/{id}/{operacion}', [
//     'uses' => 'ContabilidadController@operaciones_requerimiento_revisor',
//     'as' => 'revisor.operaciones_requerimiento',
// ]);
// Route::post('admin/contabilidad/operaciones/requerimientos/estado-contabiliadad/cambiar/contabilidad', [
//     'uses' => 'ContabilidadController@operaciones_requerimiento_estado_contabiliadad_revisor',
//     'as' => 'revisor.operaciones_requerimiento_estado_contabiliadad',
// ]);
// Route::post('/admin/contabilidad/hotel/store/notas/revisor', [
//     'uses' => 'ContabilidadController@hotel_store_notas_revisor_revisor',
//     'as' => 'revisor.hotel.store.revisor',
// ]);
// Route::post('/admin/contabilidad/enviar-requerimiento/revisor', [
//     'uses' => 'ContabilidadController@enviar_requerimiento_revisor_revisor',
//     'as' => 'revisor.enviar_requerimiento_revisor',
// ]);
//-- contabilidad
Route::get('admin/contabilidad/revisar/requerimientos', [
    'uses' => 'ContabilidadController@revisar_requerimiento',
    'as' => 'contabilidad.revisar_requerimiento',
]);
Route::post('/admin/contabilidad/revisar/requerimientos/buscar', [
    'uses' => 'ContabilidadController@revisar_requerimiento_contabilidad_buscar',
    'as' => 'contabilidad.revisar_requerimiento_contabilidad_buscar',
]);
// Route::get('admin/contabilidad/revisar/requerimientos', [
//     'uses' => 'ContabilidadController@revisar_requerimiento',
//     'as' => 'contabilidad.revisar_requerimiento',
// ]);
Route::get('admin/contabilidad/operaciones/requerimientos/{id}/{operacion}', [
    'uses' => 'ContabilidadController@operaciones_requerimiento',
    'as' => 'contabilidad.operaciones_requerimiento',
]);
Route::post('admin/contabilidad/operaciones/requerimientos/estado-contabiliadad/cambiar/contabilidad', [
    'uses' => 'ContabilidadController@operaciones_requerimiento_estado_contabiliadad',
    'as' => 'contabilidad.operaciones_requerimiento_estado_contabiliadad',
]);
Route::post('/admin/contabilidad/hotel/store/notas/revisor', [
    'uses' => 'ContabilidadController@hotel_store_notas_revisor',
    'as' => 'contabilidad.hotel.store.revisor',
]);
Route::post('/admin/contabilidad/enviar-requerimiento/revisor', [
    'uses' => 'ContabilidadController@enviar_requerimiento_revisor',
    'as' => 'contabilidad.enviar_requerimiento_revisor',
]);
Route::post('admin/contabilidad/revisar/requerimientos/borrar-lista', [
    'uses' => 'ContabilidadController@requerimientos_borrar_lista',
    'as' => 'contabilidad.requerimientos_borrar_lista',
]);
Route::post('admin/contabilidad/revisar/requerimientos/borrar-lista/uno', [
    'uses' => 'ContabilidadController@requerimientos_borrar_lista_uno',
    'as' => 'contabilidad.requerimientos_borrar_lista',
]);
// Route::post('admin/contabilidad/operaciones/requerimientos/borrar-file-programacion', [
//     'uses' => 'ContabilidadController@borrar_file_programacion',
//     'as' => 'contabilidad.borrar_file_programacion',
// ]);

//-- estado de pagos de un file
// Rutas para contabilidad, facturaciones
Route::get('/admin/contabilidad/facturacion/{anio}/{mes}/{page}/{tipo_filtro}', [
    'uses' => 'ContabilidadController@contabilidad_facturacion_path',
    'as' => 'contabilidad.facturacion.path',
]);
Route::get('admin/contabilidad/facturacion/show/{id}/{anio}/{mes}/{pagina}/{filtro}', [
    'uses' => 'ContabilidadController@show_cotizacion_id',
    'as' => 'cotizacion_id_show_facturado_path',
]);

//RESERVAS
Route::get('admin/contabilidad/estado-de-pagos/files', [
    'uses' => 'ContabilidadController@estado_de_pagos',
    'as' => 'contabilidad_lista_total_path',
]);
Route::get('admin/contabilidad/lista-total/{id}', [
    'uses' => 'ContabilidadController@lista_total_show',
    'as' => 'contabilidad_lista_total_show_path',
]);

Route::post('admin/contabilidad/ingresar-factura', [
    'uses' => 'ContabilidadController@ingresar_factura',
    'as' => 'ingresar_factura_path',
]);
Route::get('admin/contabilidad/estado-de-pagos/files/{id}', [
    'uses' => 'ContabilidadController@show_estado_pagos',
    'as' => 'contabilidad_show_estado_pagos_path',
]);
Route::post('admin/contabilidad/ingresos/buscar-pagos-recientes', [
    'uses' => 'ContabilidadController@pagos_recientes_filtro',
    'as' => 'pagos.recientes.filtro',
]);
Route::get('/admin/administracion/ingresos/general', [
    'uses' => 'ContabilidadController@administracion_ingresos',
    'as' => 'administracion.ingresos',
]);
Route::post('admin/administracion/ingresos/buscar-pagos-recientes', [
    'uses' => 'ContabilidadController@ingresos_filtro',
    'as' => 'ingresos.filtro',
]);
Route::post('/admin/quotes/new/buscar/day-by-day', [
    'uses' => 'PackageController@buscar_day_by_day_ajax_valor',
    'as' => 'buscar.day_by_day',
]);
Route::post('admin/package/buscar-day-by-day/ajax/dia-edit',[
    'uses' => 'PackageController@buscar_day_by_day_ajax_dia_edit',
    'as' => 'package_buscar_day_by_day_ajax_edit_path',
]);
Route::post('admin/quotes/new/step1/cambiar-hotel-reservas', [
    'uses' => 'PackageCotizacionController@cambiar_hotel_reservas',
    'as' => 'cambiar_hotel_reservas_path',
]);
Route::post('admin/provider/modal', [
    'uses' => 'ProveedorController@modal',
    'as' => 'provider_modal_path',
]);
Route::get('/admin/book/servicios/add/uno/{id1}/{id2}/{id3}',[
    'uses' => 'BookController@nuevo_servicio_uno',
    'as' => 'servicios_add_uno_path',
]);
Route::post('/admin/book/nuevo-servicio/nuevo/uno',[
    'uses' => 'BookController@nuevo_servicio_add_uno',
    'as' => 'nuevo_servicio_add_uno_path',
]);
