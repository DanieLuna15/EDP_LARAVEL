<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuRolController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::apiResource('users', 'UserController');
    Route::apiResource('rol', RolController::class);
    Route::apiResource('menu', MenuController::class);
    Route::post('menu/change/cambiar-orden', [MenuController::class, 'cambiarOrden']);
    Route::apiResource('menu-rol', MenuRolController::class);
    Route::apiResource('compras', 'CompraController');
    Route::post('compras/finalizar/{compra}', 'CompraController@finalizar');
    Route::apiResource('compras-aves', 'CompraAveController');
    Route::apiResource('documentacions', 'DocumentacionController');
    Route::post('login', 'UserController@login');
    Route::get('personas-inactivos', 'PersonaController@inactivo');
    Route::get('backups', 'BackupController@index');
    Route::post('backups', 'BackupController@backup');
    Route::post('backups/truncate', 'BackupController@truncateTables');
    Route::post('backups/truncate-default', 'BackupController@truncateDefaultTables');
    Route::post('backups/truncate-precios', 'BackupController@truncatePrecios');
    Route::get('backups/tables', 'BackupController@getTables');
    Route::post('backups/restore', 'BackupController@restore');
    Route::get('backups/download/{id}', 'BackupController@download');
    Route::post('personas-{id}/image', 'PersonaController@image');
    Route::post('sucursals-{id}/image', 'SucursalController@image');
    Route::post('items-{id}/image', 'ItemController@image');
    Route::post('clientes-{id}/image', 'ClienteController@image');
    Route::post('personas-image-delete/{id}', 'PersonaController@imageDelete');
    Route::post('clientes-image-delete/{id}', 'ClienteController@imageDelete');
    Route::post('sucursals-image-delete/{id}', 'SucursalController@imageDelete');
    Route::post('items-image-delete/{id}', 'ItemController@imageDelete');
// Para monedas
    Route::post('monedas-{id}/image', 'MonedaController@image');
    Route::post('monedas-image-delete/{id}', 'MonedaController@imageDelete');
// Para monedas
    Route::apiResource('banderas', 'BanderaController');
    Route::apiResource('categorias', 'CategoriaController');
    Route::apiResource('medidas', 'MedidaController');
    Route::apiResource('productos', 'ProductoController');
    Route::apiResource('tipoclientes', 'TipoclienteController');
    Route::apiResource('almacens', 'AlmacenController');
    Route::apiResource('consolidacionparams', 'ConsolidacionparamController');
    Route::apiResource('logs', 'LogController');
    Route::apiResource('areas', 'AreaController');
    Route::apiResource('comprobantes', 'ComprobanteController');
    Route::apiResource('motivomemorandums', 'MotivomemorandumController');
    Route::apiResource('memorandums', 'MemorandumController');
    Route::apiResource('tipoarchivos', 'TipoarchivoController');
    Route::apiResource('tipocontratos', 'TipocontratoController');
    Route::apiResource('documentos', 'DocumentoController');
    Route::apiResource('personas', 'PersonaController');
//Route::apiResource('especialidads','EspecialidadController');
    Route::apiResource('sucursals', 'SucursalController');
    Route::apiResource('formapagos', 'FormapagoController');
    Route::apiResource('parametrovacacions', 'ParametrovacacionController');
    Route::apiResource('sucursalTirajes', 'SucursalTirajeController');
    Route::apiResource('costofijos', 'CostofijoController');
    Route::apiResource('costovariables', 'CostovariableController');
    Route::apiResource('proveedors', 'ProveedorController');
    Route::apiResource('proveedorCompras', 'ProveedorCompraController');
    Route::get('proveedorCompras-inactivos', 'ProveedorCompraController@inactivos');
    Route::apiResource('proveedorComprasAves', 'ProveedorCompraAveController');
    Route::get('proveedorComprasAves-inactivos', 'ProveedorCompraAveController@inactivos');
    Route::get('clientes-precios-list', 'ClienteController@precios_list');
    Route::apiResource('clientes', 'ClienteController');
    Route::put('clientes-precios/{cliente}', 'ClienteController@precios');
    Route::apiResource('dotacions', 'DotacionController');
    Route::apiResource('inventarios', 'InventarioController');
    Route::get('stockdotacions/sucursal/{id}', 'StockdotacionController@sucursal');
    Route::apiResource('stockdotacions', 'StockdotacionController');
    Route::get('compras-finalizadas', 'CompraController@finalizadas');
    Route::get('compras-vigentes', 'CompraController@vigentes');
    Route::get('compras-anuladas', 'CompraController@anuladas');

    Route::get('compras-aves-finalizadas', 'CompraAveController@finalizadas');
    Route::get('compras-aves-vigentes', 'CompraAveController@vigentes');

    Route::get('contratos-finiquitoanuals', 'ContratoController@finiquitoAnual');
    Route::get('contratos-finiquinquenios', 'ContratoController@finiquitoQuinquenio');
    Route::get('contratos-finivacacionals', 'ContratoController@finiquitoVacacional');
    Route::get('contratos-finiaguinaldos', 'ContratoController@finiquitoAguinaldo');
    Route::get('contratos-liquidacions', 'ContratoController@Liquidacions');
    Route::post('kardexDotacionFecha', 'KardexDotacionController@dotacionFecha');
    Route::apiResource('ajustedotacions', 'AjustedotacionController');
    Route::apiResource('traspasoDotacions', 'TraspasoDotacionController');
    Route::get('traspasoDotacions/sucursal/{id}', 'TraspasoDotacionController@sucursal');
    Route::get('ajustedotacions/sucursal/{id}', 'AjustedotacionController@sucursal');
    Route::apiResource('salidadotacioncontratos', 'SalidadotacioncontratoController');
    Route::apiResource('salidadotaclientes', 'SalidadotaclienteController');
    Route::apiResource('devosalidotacontras', 'DevosalidotacontraController');
    Route::apiResource('redotacions', 'RedotacionController');
    Route::apiResource('contratos', 'ContratoController');
    Route::apiResource('cogplanillas', 'CogplanillaController');
    Route::apiResource('planillas', 'PlanillaController');
    Route::apiResource('planillaservicios', 'PlanillaservicioController');
    Route::apiResource('finiquitoanuals', 'FiniquitoanualController');
    Route::apiResource('finiquinquenios', 'FiniquinquenioController');
    Route::apiResource('finivacacionals', 'FinivacacionalController');
    Route::apiResource('finiaguinaldos', 'FiniaguinaldoController');
    Route::apiResource('liquidacions', 'LiquidacionController');
    Route::apiResource('consolidacions', 'ConsolidacionController');
    Route::apiResource('consolidacions_aves', 'ConsolidacionAveController');
    Route::apiResource('consolidacions_aves_new', 'ConsolidacionAveNewController');
    Route::apiResource('subMedidas', 'SubMedidaController');
    Route::apiResource('medidaProductos', 'MedidaProductoController');
    Route::apiResource('consolidacionPagos', 'ConsolidacionPagoController');
    Route::apiResource('consolidacionAvePagos', 'ConsolidacionAvePagoController');
    Route::apiResource('consolidacionAveNewPagos', 'ConsolidacionAveNewPagoController');

    Route::apiResource('consolidacionDetalles', 'ConsolidacionDetalleController');
    Route::apiResource('consolidacionAveDetalles', 'ConsolidacionAveDetalleController');
    Route::apiResource('consolidacionAveNewDetalles', 'ConsolidacionAveNewDetalleController');
    Route::apiResource('cajaProveedors', 'CajaProveedorController');
    Route::apiResource('cajas', 'CajaController');
    Route::apiResource('compraCajas', 'CompraCajaController');
    Route::apiResource('compraCajaDetalles', 'CompraCajaDetalleController');
    Route::apiResource('cajaInventarios', 'CajaInventarioController');
    Route::apiResource('consolidacionPagoTickets', 'ConsolidacionPagoTicketController');
    Route::apiResource('consolidacionAvePagoTickets', 'ConsolidacionAvePagoTicketController');
    Route::apiResource('consolidacionAveNewPagoTickets', 'ConsolidacionAveNewPagoTicketController');
    Route::apiResource('bancos', 'BancoController');
    Route::apiResource('traspasoCajas', 'TraspasoCajaController');
    Route::apiResource('cajaEnvios', 'CajaEnvioController');
    Route::apiResource('validarCajas', 'ValidarCajaController');
    Route::apiResource('cajaCompras', 'CajaCompraController');

    Route::middleware('web')->post('cajaCompras/filtrar', 'CajaCompraController@filtrarPorFecha');

    Route::middleware('web')->post('arqueos/filtrar', 'ArqueoController@filtrarPorFechaArqueo');
    Route::middleware('web')->post('cobranzaGastos/filtrar', 'ArqueoController@filtrarPorFechaGeneral');
    Route::middleware('web')->post('cobranzaGastos/filtrar-por-usuario', 'ArqueoController@filtrarPorFechaUsuario');
    Route::middleware('web')->post('cobranzaGastos/filtrar-por-chofer', 'ArqueoController@filtrarPorFechaChofer');

    Route::middleware('web')->post('entregaCajas/filtrar', 'EntregaController@filtrarPorFechaDevolucionGeneral');
    Route::middleware('web')->post('entregaCajas/filtrar-clientes-deudores', 'EntregaController@filtrarPorFechaClientesDeudores');
    Route::middleware('web')->post('entregaCajas/filtrar-seguimiento-cliente', 'EntregaController@filtrarPorFechaSeguimientoCliente');
    Route::middleware('web')->post('cuentasPorCobrar/filtrar-cuentas-por-cobrar', 'EntregaController@filtrarPorFechaCuentasPorCobrarCliente');
    Route::middleware('web')->post('cuentasPorCobrar/filtrar-cuentas-por-cobrar-historico', 'EntregaController@filtrarPorFechaCuentasPorCobrarHistoricoCliente');

    Route::middleware('web')->post('cobros/filtrar-cobros-individuales', 'EntregaController@filtrarPorFechaCobrosIndividuales');
    Route::middleware('web')->post('cobros/filtrar-cobros-globales', 'EntregaController@filtrarPorFechaCobrosGlobales');

    Route::apiResource('cajaAjustes', 'CajaAjusteController');
    Route::apiResource('pagoCompraCajas', 'PagoCompraCajaController');
    Route::apiResource('compoInternas', 'CompoInternaController');
    Route::apiResource('compoExternas', 'CompoExternaController');
    Route::apiResource('cintaClientes', 'CintaClienteController');
    Route::apiResource('zonaDespachos', 'ZonaDespachoController');
    Route::apiResource('tipoNegocios', 'TipoNegocioController');
    Route::apiResource('formaPedidos', 'FormaPedidoController');
    Route::apiResource('compoExternaDetalles', 'CompoExternaDetalleController');
    Route::apiResource('informePreliminars', 'InformePreliminarController');
    Route::apiResource('ventaTurnoChofers', 'VentaTurnoChoferController');

    Route::apiResource('proveedorCategorias', 'ProveedorCategoriaController');
    Route::apiResource('proveedorCategoriaDetalles', 'ProveedorCategoriaDetalleController');
    Route::post('ppDetalles-masa', 'PpDetalleController@masa');
    Route::post('regresar-item-ppdetalleitem/{detallePp}', 'PpDetalleController@regresarDetalleItem');
    Route::post('regresar-item-ptdetalleitem/{detallePt}', 'PtDetalleController@regresarDetalleItem');
    Route::post('ptDetalles-masa', 'PtDetalleController@masa');
    Route::post('ptDetalles-lote', 'PtDetalleController@storeLote');
    Route::apiResource('loteEnvioPps', 'LoteEnvioPpController');
    Route::post('envioGenPpsFecha', 'EnvioGenPpController@fecha');
    Route::post('envioGenPtsFecha', 'EnvioGenPtController@fecha');
    Route::post('traspasoPpsFecha', 'TraspasoPpController@fecha');
    Route::post('loteEnvioPpsFecha', 'LoteEnvioPpController@fecha');
    Route::post('loteEnvioPtsFecha', 'LoteEnvioPtController@fecha');
    Route::post('bitacoraLoteFecha', 'BitacoraLoteController@fecha');
    Route::post('ventaFecha', 'VentaController@fecha');
    Route::post('entregasFecha', 'EntregaController@fecha');
    Route::post('entregasFechaCliente', 'EntregaController@fechaCliente');
    Route::get('filtrarClientes', 'ClienteController@filtrarClientes');
    Route::post('ventaCerradaFecha', 'VentaCerradaController@fecha');
    Route::post('ventaPtFecha', 'VentaPtController@fecha');
    Route::post('ventaPpFecha', 'VentaPpController@fecha');
    Route::post('productoPrecioCambiosFecha', 'ProductoPrecioCambioController@fecha');
    Route::post('pollolimpioCambiosFecha', 'PollolimpioCambioController@fecha');
    Route::post('cambioPreciosFecha', 'CambioPrecioController@fecha');
    Route::post('subDesPtDetalleDescosFecha', 'SubDesPtDetalleDescoController@fecha');
    Route::post('turnoChofersFecha', 'TurnoChoferController@fecha');
    Route::post('pedidoClienteFecha', 'PedidoClienteController@fecha');
    Route::apiResource('productoPrecios', 'ProductoPrecioController');
    Route::apiResource('pollolimpios', 'PollolimpioController');
    Route::apiResource('items', 'ItemController');
    Route::apiResource('subDesPtDetalleDescos', 'SubDesPtDetalleDescoController');
    Route::apiResource('bitacoraLotes', 'BitacoraLoteController');
    Route::apiResource('loteEnvioPts', 'LoteEnvioPtController');
    Route::apiResource('loteTrozadoPps', 'LoteTrozadoPpController');
    Route::apiResource('familias', 'FamiliaController');
    Route::apiResource('descomponerPts', 'DescomponerPtController');
    Route::apiResource('loteTrozadoPts', 'LoteTrozadoPtController');
    Route::apiResource('loteEnvioPppts', 'LoteEnvioPpptController');
    Route::apiResource('lotes', 'LoteController');
    Route::apiResource('cajaMotivos', 'CajaMotivoController');
    Route::apiResource('cajaMonedas', 'MonedaController');
    Route::apiResource('estadoCompraChofers', 'EstadoCompraChoferController');
    Route::apiResource('turnoChofers', 'TurnoChoferController');
    Route::apiResource('cajaSucursalUsuarios', 'CajaSucursalUsuarioController');
    Route::apiResource('cajaSucursals', 'CajaSucursalController');
    Route::apiResource('ptDetalleSubDescomposicions', 'PtDetalleSubDescomposicionController');
    Route::get('chofers-turno', 'ChoferController@turno');
    Route::get('choferes', 'ChoferController@choferes');
    Route::get('seguiproducto/{lote}', 'LoteController@seguiproducto');
    Route::get('seguicronologico/{lote}', 'LoteController@seguicronologico');
    Route::get('compras-lote/{compra}', 'CompraController@lote');

    Route::get('compras-aves-lote/{compra}', 'CompraAveController@lote');

    Route::get('lotes-pos/{lote}', 'LoteController@pos');
    Route::post('lotes-finalizar/{lote}', 'LoteController@finalizar');
    Route::post('lotes-finalizar-compra/{compra}', 'LoteController@finalizarCompra');
    Route::get('lotes-pp/{lote}', 'LoteController@pp');
    Route::get('lotes-pt/{lote}', 'LoteController@pt');
    Route::get('compras-validar-caja', 'CompraController@validar_caja');
    Route::get('compras-aves-validar-caja', 'CompraAveController@validar_caja');
    Route::get('pp/detalle-pp/{pp}', 'PpController@detalle');
    Route::get('pp/detalle-cronologicopp/{pp}', 'PpController@showPPCronologico2');
    Route::get('pt/detalle-pt/{pt}', 'PtController@detalle');
    Route::get('pt/detalle-pt-reporte-venta/{pt}', 'PtController@showPTReporteVenta');
    Route::get('pt/detalle-pt-reporte-general/{pt}', 'PtController@showPTReporteGeneral');
    Route::get('item-sobras-pt', 'ItemSobraPtController@lista');
    Route::post('sobras-pt-item/aceptar/{itemSobraPt}', 'ItemSobraPtController@store');
    Route::post('pps-cerrar/{pp}', 'PpController@cerrar');
    Route::post('pps-enviar/{pp}', 'PpController@enviar');
    Route::post('pts-cerrar/{pt}', 'PtController@cerrar');
    Route::post('descomponer-ppdetalles/{ppDetalle}', 'PpDetalleController@descomponer');
    Route::post('descomponer-detallepps/{detallePp}', 'DetallePpController@descomponer');
    Route::post('descomponer-detallepts/{detallePt}', 'DetallePtController@descomponer');
    Route::post('detallePpRegresar/{detallePp}', 'PpDetalleController@regresarDetalle');
    Route::post('ptDetalleRegresar/{ptDetalle}', 'PtDetalleController@regresar');
    Route::post('descomponerppdetalles/{ppDetalleDescomposicion}', 'PpDetalleDescomposicionController@descomponer');
    Route::post('descomponerdetallepps/{detallePpDescomposicion}', 'DetallePpDescomposicionController@descomponer');
    Route::post('descomponer-ptdetalles/{ptDetalle}', 'PtDetalleController@descomponer');
    Route::apiResource('ppDetalles', 'PpDetalleController');
    Route::post('compoInternas-{id}/image', 'CompoInternaController@image');
    Route::post('compoInternas-image-delete/{id}', 'CompoInternaController@imageDelete');
    Route::post('compoExternas-{id}/image', 'CompoExternaController@image');
    Route::post('compoExternas-image-delete/{id}', 'CompoExternaController@imageDelete');
    Route::post('ppDetalles-masa-actualizar', 'PpController@actualizarDetallesMasa');
    Route::post('ppDetalles-masa-retornar/{sucursal}', 'PpController@retornarDetallesMasa');
    Route::post('ptDetalles-masa-retornar/{sucursal}', 'PtController@retornarDetallesMasa');
    Route::post('ptDetalles-masa-actualizar', 'PtController@actualizarDetallesMasa');
    Route::post('itemspt-descomponer', 'ItemsPtController@descomponer');
    Route::apiResource('subItems', 'SubItemController');
    Route::apiResource('productoPrecioLotes', 'ProductoPrecioLoteController');
    Route::get('pps/curso-pos/{sucursal}', 'PpController@sucursalCursoPos');
// PP Y PT DETALLES
    Route::get('pps/detalles/{pp}', 'PpController@detalles');
    Route::get('pps/detalles-V1/{sucursal}', 'PpController@detallesV1');
    Route::get('pps/detalles-pps/{sucursal}', 'PpController@pps');
    Route::get('pts/detalles/{pt}', 'PtController@detalles');
    Route::get('pts/detalles-V1/{sucursal}', 'PtController@detallesV1');
    Route::get('pts/detalles-pts/{sucursal}', 'PtController@pts');

    Route::get('pts/curso-pos/{sucursal}', 'PtController@sucursalCursoPos');
    Route::get('pps/curso/{sucursal}', 'PpController@sucursalCurso');
    Route::get('pts/curso/{sucursal}', 'PtController@sucursalCurso');
    Route::get('pts/curso-subpt/{sucursal}', 'PtController@sucursalCursoSubPt');
    Route::get('lotes-v2', 'LoteController@indexV2');
    Route::get('lotes-cerradas', 'LoteController@indexCerradas');
    Route::get('lotes-general', 'LoteController@general');
    Route::get('lotes-general-compra', 'LoteController@generalCompra');
    Route::apiResource('promedioMermas', 'PromedioMermaController');
    Route::apiResource('pps', 'PpController');
    Route::apiResource('pts', 'PtController');
    Route::get('sobras-pp/disponibles', 'SobraPpController@disponible');
    Route::get('traspasos-pp/disponibles', 'TraspasoPpController@disponible');
    Route::post('traspasos-pp/aceptar/{traspasoPp}', 'TraspasoPpController@aceptar');
    Route::post('traspasos-pt/aceptar/{traspasoPp}', 'TraspasoPpController@aceptarPt');
    Route::post('sobras-pt/aceptar/{sobraPp}', 'SobraPpController@aceptarPt');
    Route::post('items-precios', 'ItemController@precios');
    Route::post('producto-precio-cambios', 'ProductoPrecioController@precios');
    Route::post('pollo-sucursal-precio', 'PolloSucursalController@precio');
    Route::post('transformacion-sucursal-precio', 'TransformacionController@precio');
    Route::post('clientes-aprobar/{cliente}', 'ClienteController@aprobar');
    Route::post('pollolimpio-cambios', 'PollolimpioController@precios');
    Route::get('cajas-usuario/{user}-{sucursal}', 'CajaSucursalUsuarioController@listaUsers');
    Route::get('caja-activa-usuario/{user}/{sucursal}', 'CajaSucursalUsuarioController@cajaActivaUsuario');
    Route::get('items-sucursal/{sucursal}', 'ItemController@listaSucursal');
    Route::get('pollo-sucursal/{sucursal}', 'PolloSucursalController@listaSucursal');
    Route::get('producto-precios-sucursal/{sucursal}', 'ProductoPrecioController@listaSucursal');
    Route::get('pollolimpio-sucursal/{sucursal}', 'PollolimpioController@listaSucursal');
    Route::get('transformacions-sucursal/{sucursal}', 'TransformacionController@listaSucursal');
    Route::get('promedioPollolimpio-sucursal/{sucursal}', 'PromedioPollolimpioController@listaSucursal');
    Route::get('arqueos-usuario/{user}-{sucursal}', 'ArqueoController@listaArqueos');
    Route::get('cliente_aprobar', 'ClienteController@index_2');
    Route::get('cliente_inactivo', 'ClienteController@index_3');
    Route::apiResource('arqueos', 'ArqueoController');
    Route::apiResource('arqueoIngresos', 'ArqueoIngresoController');
    Route::apiResource('traspasoPps', 'TraspasoPpController');
    Route::post('traspasoDesplieguePps', 'TraspasoPpController@storeDespliegue');
    Route::apiResource('subDesDetallePts', 'SubDesDetallePtController');
    Route::apiResource('envioGenPps', 'EnvioGenPpController');
    Route::apiResource('ventas', 'VentaController');
    Route::post('ventas-2', 'VentaController@venta2');
    Route::apiResource('promedioPollolimpios', 'PromedioPollolimpioController');
    Route::apiResource('chofers', 'ChoferController');
    Route::apiResource('monedas', 'MonedaController');
    Route::apiResource('pedidoClientes', 'PedidoClienteController');
    Route::apiResource('transformacions', 'TransformacionController');
    Route::apiResource('transformacionDetalles', 'TransformacionDetalleController');
    Route::apiResource('cajacerradaClientes', 'CajacerradaClienteController');
    Route::apiResource('acuerdoClientes', 'AcuerdoClienteController');
    Route::apiResource('tipoClientePpLimpios', 'TipoClientePpLimpioController');
    Route::apiResource('tipoClientePps', 'TipoClientePpController');
    Route::apiResource('tipopagos', 'TipopagoController');
    Route::get('ventaItemsPts', 'VentaItemsPtController@index');
    Route::post('ventaDetallePps-fechas', 'VentaDetallePpController@fechas');
    Route::post('ventaItemsPts-fechas', 'VentaItemsPtController@fechas');
    Route::get('transItems', 'TransItemController@index');
    Route::get('transEspecials', 'TransEspecialController@index');
    Route::post('transItem-masas', 'TransItemController@masa');
    Route::post('transEspecial-masas', 'TransEspecialController@masa');
    Route::get('ventaDetallePps', 'VentaDetallePpController@index');

// TRANSFORMACIONES
    Route::post('sobras-trans-item/aceptar/{itemSobraTrans}', 'ItemSobraTransController@store');
    Route::get('item-sobras-trans', 'ItemSobraTransController@lista');
    Route::get('tranformacion-lotes/curso/{sucursal}', 'TransformacionLoteController@sucursalCurso');
    Route::get('tranformacion-lotes/curso-pos/{sucursal}', 'TransformacionLoteController@sucursalCursoPos');
    Route::post('transformacionLotes', 'TransformacionLoteController@store');
    Route::post('transformacionLotes-cerraritem/{transformacionLote}', 'TransformacionLoteController@cerrarItem');
    Route::post('transformacionLotes-cerrar/{transformacionLote}', 'TransformacionLoteController@cerrar');
    Route::get('tranformacion-lotes', 'TransformacionLoteController@index');
    Route::get('transformacionLotes/detalles/{transformacionLote}', 'TransformacionLoteController@detalles');

// ENVIOS DE PP A TRANSFORMACIONES
    Route::post('envios-pp-transformaciones', 'PpEnvioTransformacionController@store');
    Route::get('envios-pp-transformaciones', 'PpEnvioTransformacionController@envios');
    Route::get('ppEnvioTransformaciones-disponibles', 'PpEnvioTransformacionDetalleController@index');
    Route::post('ppEnvioTransformaciones-aceptar/{ppEnvioTransformacionDetalle}', 'PpEnvioTransformacionDetalleController@aceptar');
//ENVIO DE ITEMS A TRANSFORMACIONES
    Route::post('enviarItemPtTransformacions', 'EnviarItemPtTransformacionController@store');
    Route::get('enviarItemPtTransformacions', 'EnviarItemPtTransformacionController@index');
    Route::put('enviarItemPtTransformacions/{enviarItemPtTransformacion}', 'EnviarItemPtTransformacionController@update');
    Route::post('descomponerTransformacionLotes', 'DescomponerTransformacionLoteController@store');
//ENTREGAR ITEMS A ENCARGADOS PARA TRANSFORMACION
    Route::post('itemPtTransformacionLotes', 'ItemPtTransformacionLoteController@store');
    Route::post('itemPtTransformacionLotes-cerrar/{itemPtTransformacionLote}', 'ItemPtTransformacionLoteController@cerrar');
    Route::post('subItemPtTransformacionLotes', 'SubItemPtTransformacionLoteController@store');

//VENTA REPORTES
    Route::get('venta-clientes', 'VentaController@ventaClienteReport');
    Route::post('venta-clientes-post', 'VentaController@ventaClienteReport2');

// -------------------------------------------------------
    Route::group(['prefix' => '/reportes'], function () {
        Route::group(['prefix' => '/contratos'], function () {
            Route::get('/planillas/{id}', 'PlanillaController@contrato');
            Route::post('/planillas-fecha/{id}', 'PlanillaController@contratoFecha');
            Route::get('/finiquitoanuals/{id}', 'FiniquitoanualController@contrato');
            Route::get('/finivacacionals/{id}', 'FinivacacionalController@contrato');
            Route::get('/finiaguinaldos/{id}', 'FiniaguinaldoController@contrato');
            Route::get('/liquidacions/{id}', 'LiquidacionController@contrato');
            Route::get('/planillaservicios/{id}', 'PlanillaservicioController@contrato');
        });
    });

// ! ||--------------------------------------------------------------------------------||
// ! ||                     MODULO DE ENTREGAS Y DESPACHO DE VENTAS                    ||
// ! ||--------------------------------------------------------------------------------||
    Route::post('entregas-venta', 'DespachoArqueoController@store');
    Route::get('/ventas-credito/{clienteId}', 'DespachoArqueoController@obtenerVentasCredito');
    Route::post('/pagar-venta', 'DespachoArqueoController@pagarVenta');
