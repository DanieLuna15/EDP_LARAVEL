

<?php

use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\PlanillaservicioController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\RolUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('login', function () {
    return view('login');
});

/////////////////////////////////////////////////////
//////////MOBIL APP//////////////////////////////////
/////////////////////////////////////////////////////
Route::group(['prefix' => '/preventista'], function () {
    Route::get('/home', function () {
        return view('preventista.home');
    })->name('preventista.home');
    Route::group(['prefix' => '/preventa'], function () {
        Route::get('/', function () {
            return view('preventista.preventa.index');
        });
    });
    Route::group(['prefix' => '/cliente'], function () {
        Route::get('/', function () {
            return view('preventista.cliente.index');
        });
        Route::get('/add', function () {
            return view('preventista.cliente.add');
        });
        Route::get('/edit/{id}', function ($id) {
            return view('preventista.cliente.edit', ['id' => $id]);
        });
        Route::get('/precios/{id}', function ($id) {
            return view('preventista.cliente.precios', ['id' => $id]);
        });
    });
    Route::group(['prefix' => '/auth'], function () {
        Route::get('/login', function () {
            return view('preventista.auth.login');
        });
    });
    Route::group(['prefix' => '/entrega'], function () {
        Route::get('/', function () {
            return view('preventista.entrega.historial');
        });
    });
    Route::group(['prefix' => '/caja'], function () {
        Route::get('/', function () {
            return view('preventista.cajas.aperturacierre');
        });
    });
    Route::group(['prefix' => '/productoPrecio'], function () {
        Route::get('/', function () {
            return view('preventista.productoPrecio.productoPrecio');
        });
        Route::get('/cambios', function () {
            return view('preventista.productoPrecio.productoPrecioCambio');
        });
    });
    Route::group(['prefix' => '/backupRestore'], function () {
        Route::get('/', function () {
            return view('preventista.backupRestore.backup');
        });
    });
});

////


Route::post('login', [UserController::class, 'login'])->name('login');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/accesos-directos', function () {
        return view('accesos-directos');
    });
    Route::get('usuario/menu-rol/{rolId}', [UserController::class, 'menuRol']);
    Route::get('usuario/agregar-sistema/{id}', [UserController::class, 'agregarSistema']);
    Route::get('usuario/quitar-sistema/{id}', [UserController::class, 'quitarSistema']);
    Route::get('usuario/rol-user/{id}', [UserController::class, 'rolUser']);
    Route::get('usuario/menu-render/{usuarioId}', [UserController::class, 'menuRender']);

    Route::apiResource('usuario/rol-user', RolUserController::class);
    Route::get('usuario/listar_punto_sesion', [SucursalController::class, 'listar_punto_sesion']);
    Route::get('usuario/punto_venta_user/{userId}', [SucursalController::class, 'punto_venta_user']);
    Route::get('usuario/asignar-puntoventa/{usarioId}/{puntoVentaId}', [UserController::class, 'asignarPuntoVenta']);

    Route::get('/sucursal', function () {
        return view('sucursal');
    });

    Route::group(['prefix' => '/admin', 'middleware' => 'menu.access'], function () {
        Route::get('/logs', function () {
            return view('admin.log');
        });
        Route::get('/storage', function () {
            return Artisan::call('storage:link');
        });
        Route::get('/backup', function () {
            return view('admin.backup');
        });
        Route::get('/restore', function () {
            return view('admin.restore');
        });
        Route::get('/truncate', function () {
            return view('admin.truncate');
        });
        Route::group(['prefix' => '/personal','middleware' => 'menu.access'], function () {
            Route::group(['prefix' => '/persona'], function () {
                Route::get('/', function () {
                    return view('admin.personal.persona.index');
                });
                Route::get('/add', function () {
                    return view('admin.personal.persona.add');
                });

                Route::get('/inactivos', function () {
                    return view('admin.personal.persona.inactivo');
                });

                Route::get('/edit/{id}', function ($id) {
                    return view('admin.personal.persona.edit', ['id' => $id]);
                });

                Route::get('/image/{id}', function ($id) {
                    return view('admin.personal.persona.image', ['id' => $id]);
                });
            });
        });
        Route::group(['prefix' => '/control_acceso'], function () {
            Route::group(['prefix' => '/usuario'], function () {
                Route::get('/', function () {
                    return view('admin.control_acceso.usuario.index');
                });
                Route::get('/add', function () {
                    return view('admin.control_acceso.usuario.add');
                });

                Route::get('/edit/{id}', function ($id) {
                    return view('admin.control_acceso.usuario.edit', ['id' => $id]);
                });
            });
            Route::group(['prefix' => '/permisos'], function () {
                Route::get('/', function () {
                    return view('admin.control_acceso.permisos');
                });
            });
        });
        Route::group(['prefix' => '/documentacion'], function () {

            Route::get('/', function () {
                return view('admin.documentacion.page');
            });
            Route::get('/admin', function () {
                return view('admin.documentacion.admin');
            });
        });
        Route::group(['prefix' => '/configuracion'], function () {

            Route::get('/bancos', function () {
                return view('admin.config.bancos');
            });
            Route::get('/documentos', function () {
                return view('admin.config.documentos');
            });
            Route::get('/formapagos', function () {
                return view('admin.config.formapagos');
            });
            Route::get('/areas', function () {
                return view('admin.config.areas');
            });
            Route::get('/comprobantes', function () {
                return view('admin.config.comprobantes');
            });

            Route::get('/tipoarchivos', function () {
                return view('admin.config.tipoarchivos');
            });
            Route::get('/tipopagos', function () {
                return view('admin.config.tipopagos');
            });
            Route::get('/sucursaltiraje', function () {
                return view('admin.config.sucursaltiraje');
            });
            Route::get('/parametrovacacions', function () {
                return view('admin.config.parametrovacacions');
            });
            Route::group(['prefix' => '/sucursal'], function () {
                Route::get('/', function () {
                    return view('admin.config.sucursal.index');
                });
                Route::get('/add', function () {
                    return view('admin.config.sucursal.add');
                });

                Route::get('/edit/{id}', function ($id) {
                    return view('admin.config.sucursal.edit', ['id' => $id]);
                });
                Route::get('/image/{id}', function ($id) {
                    return view('admin.config.sucursal.image', ['id' => $id]);
                });
            });
        });
    });
    Route::group(['prefix' => '/rrhh', 'middleware' => 'menu.access'], function () {
        Route::get('/area', function () {
            return view('rrhh.areas');
        });
        Route::get('/tipocontratos', function () {
            return view('rrhh.tipocontratos');
        });
        Route::group(['prefix' => '/costos'], function () {
            Route::get('/fijos', function () {
                return view('rrhh.costos.fijos');
            });
            Route::get('/variables', function () {
                return view('rrhh.costos.variables');
            });
        });
        Route::group(['prefix' => '/memorandums'], function () {
            Route::get('/', function () {
                return view('rrhh.memorandum.index');
            });
            Route::get('/motivo', function () {
                return view('rrhh.memorandum.motivo');
            });
            Route::get('/add', function () {
                return view('rrhh.memorandum.add');
            });
        });
        Route::group(['prefix' => '/dotacions'], function () {
            Route::get('/', function () {
                return view('rrhh.dotacion.index');
            });
            Route::get('/redotacion', function () {
                return view('rrhh.dotacion.redotacion');
            });
            Route::get('/familia', function () {
                return view('rrhh.dotacion.familia');
            });
            Route::get('/kardex', function () {
                return view('rrhh.dotacion.kardex');
            });
            Route::get('/stockingreso', function () {
                return view('rrhh.dotacion.stockingreso');
            });
            Route::group(['prefix' => '/salidacliente'], function () {
                Route::get('/', function () {
                    return view('rrhh.dotacion.salidacliente.index');
                });
                Route::get('/add', function () {
                    return view('rrhh.dotacion.salidacliente.add');
                });
            });
            Route::group(['prefix' => '/salidacontratos'], function () {
                Route::get('/', function () {
                    return view('rrhh.dotacion.salidacontrato.index');
                });
                Route::get('/add', function () {
                    return view('rrhh.dotacion.salidacontrato.add');
                });

                Route::get('/edit/{id}', function ($id) {
                    return view('rrhh.dotacion.salidacontrato.edit', ["id" => $id]);
                });
                Route::get('/redotacion/{id}', function ($id) {
                    return view('rrhh.dotacion.salidacontrato.redotacion', ["id" => $id]);
                });
            });

            Route::group(['prefix' => '/inventario'], function () {
                Route::get('/', function () {
                    return view('rrhh.dotacion.inventario.index');
                });
                Route::get('/stock', function () {
                    return view('rrhh.dotacion.inventario.stock');
                });

                Route::group(['prefix' => '/ajustes'], function () {
                    Route::get('/', function () {
                        return view('rrhh.dotacion.inventario.ajuste.index');
                    });
                    Route::get('/add', function () {
                        return view('rrhh.dotacion.inventario.ajuste.add');
                    });
                });
                Route::group(['prefix' => '/traspasos'], function () {
                    Route::get('/', function () {
                        return view('rrhh.dotacion.inventario.traspaso.index');
                    });
                    Route::get('/add', function () {
                        return view('rrhh.dotacion.inventario.traspaso.add');
                    });
                });
            });
        });
        Route::group(['prefix' => '/planillaservicios'], function () {
            Route::get('/', function () {
                return view('rrhh.planillaservicios.index');
            });
            Route::get('/add', function () {
                return view('rrhh.planillaservicios.add');
            });
            Route::get('/config', function () {
                return view('rrhh.planillaservicios.cog');
            });
        });
        Route::group(['prefix' => '/planillas'], function () {
            Route::get('/', function () {
                return view('rrhh.planilla.index');
            });
            Route::get('/add', function () {
                return view('rrhh.planilla.add');
            });
            Route::get('/config', function () {
                return view('rrhh.planilla.cog');
            });
        });
        Route::group(['prefix' => '/liquidacion'], function () {
            Route::get('/', function () {
                return view('rrhh.liquidacion.index');
            });
            Route::get('/add', function () {
                return view('rrhh.liquidacion.add');
            });
        });
        Route::group(['prefix' => '/proveedors'], function () {
            Route::get('/', function () {
                return view('rrhh.proveedor.index');
            });
            Route::get('/add', function () {
                return view('rrhh.proveedor.add');
            });

            Route::get('/edit/{id}', function ($id) {
                return view('rrhh.proveedor.edit', ['id' => $id]);
            });
        });
        Route::group(['prefix' => '/contratos'], function () {
            Route::get('/', function () {
                return view('rrhh.contrato.index');
            });
            Route::get('/add', function () {
                return view('rrhh.contrato.add');
            });

            Route::get('/edit/{id}', function ($id) {
                return view('rrhh.contrato.edit', ['id' => $id]);
            });
        });
        Route::group(['prefix' => '/reportes'], function () {
            Route::get('/planillaservicios', function () {
                return view('rrhh.reportes.planillaservicio');
            });
            Route::get('/planillas', function () {
                return view('rrhh.reportes.planilla');
            });
            Route::get('/finiquitoanuals', function () {
                return view('rrhh.reportes.finiquitoanual');
            });
            Route::get('/finiquitovacacionals', function () {
                return view('rrhh.reportes.finiquitovacacional');
            });
            Route::get('/finiquitoaguinaldos', function () {
                return view('rrhh.reportes.finiquitoaguinaldo');
            });
            Route::get('/liquidacions', function () {
                return view('rrhh.reportes.liquidacion');
            });
        });
        Route::group(['prefix' => '/finiquito'], function () {
            Route::group(['prefix' => '/anual'], function () {
                Route::get('/', function () {
                    return view('rrhh.finiquito.anual.index');
                });
                Route::get('/add', function () {
                    return view('rrhh.finiquito.anual.add');
                });
            });

            Route::group(['prefix' => '/quinquenio'], function () {
                Route::get('/', function () {
                    return view('rrhh.finiquito.quinquenio.index');
                });
                Route::get('/add', function () {
                    return view('rrhh.finiquito.quinquenio.add');
                });
            });
            Route::group(['prefix' => '/vacacional'], function () {
                Route::get('/', function () {
                    return view('rrhh.finiquito.vacacional.index');
                });
                Route::get('/add', function () {
                    return view('rrhh.finiquito.vacacional.add');
                });
            });
            Route::group(['prefix' => '/aguinaldo'], function () {
                Route::get('/', function () {
                    return view('rrhh.finiquito.aguinaldo.index');
                });
                Route::get('/add', function () {
                    return view('rrhh.finiquito.aguinaldo.add');
                });
            });
        });
    });
    Route::group(['prefix' => '/almacen', 'middleware' => 'menu.access'], function () {
        Route::get('/categorias', function () {
            return view('almacen.categorias');
        });
        Route::get('/producto-precio', function () {
            return view('almacen.productoPrecio');
        });
        Route::get('/producto-precio-cambios', function () {
            return view('almacen.productoPrecioCambio');
        });
        Route::get('/pollolimpio', function () {
            return view('almacen.pollolimpio');
        });
        Route::get('/pollolimpio-cambios', function () {
            return view('almacen.pollolimpioCambio');
        });
        Route::group(['prefix' => '/cajas'], function () {
            Route::get('/', function () {
                return view('almacen.cajas.cajas');
            });
            Route::get('/inventarios', function () {
                return view('almacen.cajas.inventario.index');
            });
            Route::get('/bitacoras', function () {
                return view('almacen.cajas.bitacoras.index');
            });
            Route::get('/reportes/control-cajas', function () {
                return view('almacen.cajas.reportes.control_cajas');
            });
            Route::get('/reportes/control-cajas', function () {
                return view('almacen.cajas.reportes.control_cajas');
            });
            Route::get('/reportes/control-cajas', function () {
                return view('almacen.cajas.reportes.control_cajas');
            });
            Route::get('/reportes/control-cajas', function () {
                return view('almacen.cajas.reportes.control_cajas');
            });
            Route::group(['prefix' => '/compras'], function () {
                Route::get('/', function () {
                    return view('almacen.cajas.compras.index');
                });
                Route::get('/add', function () {
                    return view('almacen.cajas.compras.add');
                });
                Route::group(['prefix' => '/tickets'], function () {
                    Route::get('/', function () {
                        return view('almacen.cajas.compras.tickets.index');
                    });
                    Route::get('/add', function () {
                        return view('almacen.cajas.compras.tickets.add');
                    });
                });
            });
            Route::group(['prefix' => '/validacion','middleware' => 'menu.access'], function () {
                Route::get('/', function () {
                    return view('almacen.cajas.validacion.index');
                });
                Route::get('/add', function () {
                    return view('almacen.cajas.validacion.add');
                });
            });
            Route::group(['prefix' => '/envio'], function () {
                Route::get('/', function () {
                    return view('almacen.cajas.envio.index');
                });
                Route::get('/add', function () {
                    return view('almacen.cajas.envio.add');
                });
            });
            Route::group(['prefix' => '/ajuste'], function () {
                Route::get('/', function () {
                    return view('almacen.cajas.ajuste.index');
                });
                Route::get('/add', function () {
                    return view('almacen.cajas.ajuste.add');
                });
            });
            Route::group(['prefix' => '/traspaso'], function () {
                Route::get('/', function () {
                    return view('almacen.cajas.traspaso.index');
                });
                Route::get('/add', function () {
                    return view('almacen.cajas.traspaso.add');
                });
            });
            Route::group(['prefix' => '/proveedors'], function () {
                Route::get('/', function () {
                    return view('almacen.cajas.proveedor.index');
                });
                Route::get('/add', function () {
                    return view('almacen.cajas.proveedor.add');
                });
                Route::get('/edit/{id}', function ($id) {
                    return view('almacen.cajas.proveedor.edit', ['id' => $id]);
                });
            });
        });
        Route::group(['prefix' => '/consilodacion'], function () {
            Route::get('/params', function () {
                return view('almacen.consolidacion.params');
            });
            Route::get('/lista', function () {
                return view('almacen.consolidacion.index');
            });

            Route::get('/add', function () {
                return view('almacen.consolidacion.add');
            });
            Route::get('/edit/{id}', function ($id) {
                return view('almacen.consolidacion.edit', ['id' => $id]);
            });

            Route::get('/add', function () {
                return view('almacen.consolidacion.add');
            });
            Route::get('/pagar', function () {
                return view('almacen.consolidacion.pagar');
            });
            Route::get('/pagar/add', function () {
                return view('almacen.consolidacion.pagarAdd');
            });
            Route::get('/tickets', function () {
                return view('almacen.consolidacion.tickets.index');
            });
            Route::get('/tickets/add', function () {
                return view('almacen.consolidacion.tickets.add');
            });

            // CONSOLIDACION AVES
            Route::get('/lista-ave', function () {
                return view('almacen.consolidacion_aves.index');
            });
            Route::get('/add-ave', function () {
                return view('almacen.consolidacion_aves.add');
            });
            Route::get('/edit-ave/{id}', function ($id) {
                return view('almacen.consolidacion_aves.edit', ['id' => $id]);
            });
            Route::get('/add-ave', function () {
                return view('almacen.consolidacion_aves.add');
            });
            Route::get('/pagar-ave', function () {
                return view('almacen.consolidacion_aves.pagar');
            });
            Route::get('/pagar-ave/add', function () {
                return view('almacen.consolidacion_aves.pagarAdd');
            });
            Route::get('/tickets-ave', function () {
                return view('almacen.consolidacion_aves.tickets.index');
            });
            Route::get('/tickets/add-ave', function () {
                return view('almacen.consolidacion_aves.tickets.add');
            });
            // CONSOLIDACION AVES

            // CONSOLIDACION AVES NEW
            Route::get('/lista-ave-new', function () {
                return view('almacen.consolidacion_aves_new.index');
            });
            Route::get('/add-ave-new', function () {
                return view('almacen.consolidacion_aves_new.add');
            });
            Route::get('/edit-ave-new/{id}', function ($id) {
                return view('almacen.consolidacion_aves_new.edit', ['id' => $id]);
            });
            Route::get('/add-ave-new', function () {
                return view('almacen.consolidacion_aves_new.add');
            });
            Route::get('/pagar-ave-new', function () {
                return view('almacen.consolidacion_aves_new.pagar');
            });
            Route::get('/pagar-ave-new/add', function () {
                return view('almacen.consolidacion_aves_new.pagarAdd');
            });
            Route::get('/tickets-ave-new', function () {
                return view('almacen.consolidacion_aves_new.tickets.index');
            });
            Route::get('/tickets/add-ave-new', function () {
                return view('almacen.consolidacion_aves_new.tickets.add');
            });
            // CONSOLIDACION AVES NEW
        });

        Route::get('/medidas', function () {
            return view('almacen.medida.index');
        });
        Route::group(['prefix' => '/productos'], function () {
            Route::get('/', function () {
                return view('almacen.producto.index');
            });
            Route::get('/add', function () {
                return view('almacen.producto.add');
            });
            Route::get('/edit/{id}', function ($id) {
                return view('almacen.producto.edit', ['id' => $id]);
            });
        });
        Route::group(['prefix' => '/proveedors'], function () {
            Route::get('/', function () {
                return view('almacen.proveedor.index');
            });
            Route::get('/inactivos', function () {
                return view('almacen.proveedor.inactivo');
            });
            Route::get('/add', function () {
                return view('almacen.proveedor.add');
            });
            Route::get('/edit/{id}', function ($id) {
                return view('almacen.proveedor.edit', ['id' => $id]);
            });
        });
        Route::group(['prefix' => '/proveedors_aves'], function () {
            Route::get('/', function () {
                return view('almacen.proveedor_aves.index');
            });
            Route::get('/inactivos', function () {
                return view('almacen.proveedor_aves.inactivo');
            });
            Route::get('/add', function () {
                return view('almacen.proveedor_aves.add');
            });
            Route::get('/edit/{id}', function ($id) {
                return view('almacen.proveedor_aves.edit', ['id' => $id]);
            });
        });

        Route::get('/almacens', function () {
            return view('almacen.almacen.index');
        });
        Route::group(['prefix' => '/compras'], function () {

            Route::get('/', function () {
                return view('almacen.compras.index');
            });
            Route::get('/compras-cerradas', function () {
                return view('almacen.compras.compras_cerradas');
            });
            Route::get('/compras-anuladas', function () {
                return view('almacen.compras.compras_anuladas');
            });
            Route::get('/add', function () {
                return view('almacen.compras.add');
            });
            Route::get('/edit/{id}', function ($id) {
                return view('almacen.compras.edit', ['id' => $id]);
            });
        });

        // nuevas rutas para compras aves
        Route::group(['prefix' => '/compras-aves'], function () {
            Route::get('/', function () {
                return view('almacen.compras_aves.index');
            });
            Route::get('/compras-cerradas', function () {
                return view('almacen.compras_aves.compras_cerradas');
            });
            Route::get('/add', function () {
                return view('almacen.compras_aves.add');
            });
            Route::get('/edit/{id}', function ($id) {
                return view('almacen.compras_aves.edit', ['id' => $id]);
            });
        });
        // nuevas rutas para compras aves

        Route::group(['prefix' => '/inventario'], function () {

            Route::get('/', function () {
                return view('almacen.inventario.index');
            });
        });
    });
    Route::group(['prefix' => '/ventas', 'middleware' => 'menu.access'], function () {
        Route::group(['prefix' => '/chofers'], function () {
            Route::get('/', function () {
                return view('ventas.chofers.index');
            });
            Route::get('/add', function () {
                return view('ventas.chofers.add');
            });

            Route::get('/turnos', function () {
                return view('ventas.chofers.turnos');
            });

            Route::get('/edit/{id}', function ($id) {
                return view('ventas.chofers.edit', ['id' => $id]);
            });

            Route::get('/turno-apertura/{id}', function ($id) {
                return view('ventas.chofers.turno-apertura', ['id' => $id]);
            });
            Route::get('/venta-entregar/{id}', function ($id) {
                return view('ventas.chofers.venta-entrega', ['id' => $id]);
            });
        });
        Route::get('/estado-compra-chofers', function () {
            return view('ventas.chofers.estado');
        });
        Route::group(['prefix' => '/clientes'], function () {
            Route::get('/', function () {
                return view('ventas.clientes.index');
            });

            Route::get('/aprobar', function () {
                return view('ventas.clientes.index2');
            });
            Route::get('/inactivos', function () {
                return view('ventas.clientes.inactivos');
            });
            Route::get('/add', function () {
                return view('ventas.clientes.add');
            });
            Route::get('/tipo', function () {
                return view('ventas.clientes.tipo');
            });
            Route::get('/cinta', function () {
                return view('ventas.clientes.cinta');
            });
            Route::get('/mapa', function () {
                return view('ventas.clientes.mapa');
            });
            Route::get('/cajacerrada', function () {
                return view('ventas.clientes.cajacerrada');
            });
            Route::get('/pollolimpio', function () {
                return view('ventas.clientes.pollolimpio');
            });
            Route::get('/tipopp', function () {
                return view('ventas.clientes.tipopp');
            });
            Route::get('/zona-despacho', function () {
                return view('ventas.clientes.zona-despacho');
            });
            Route::get('/tipo-negocio', function () {
                return view('ventas.clientes.tipo-negocio');
            });
            Route::get('/forma-pedido', function () {
                return view('ventas.clientes.forma-pedido');
            });
            Route::get('/acuerdo', function () {
                return view('ventas.clientes.acuerdo');
            });

            Route::get('/edit/{id}', function ($id) {
                return view('ventas.clientes.edit', ['id' => $id]);
            });
            Route::get('/precios/{id}', function ($id) {
                return view('ventas.clientes.precios', ['id' => $id]);
            });
            Route::get('/aprobar/{id}', function ($id) {
                return view('ventas.clientes.aprobar', ['id' => $id]);
            });
            Route::get('/convenio/{id}', function ($id) {
                return view('ventas.clientes.convenio', ['id' => $id]);
            });
        });
        Route::get('/pos', function () {
            return view('ventas.pos.add');
        });
        Route::get('/ventas', function () {
            return view('ventas.pos.ventas');
        });
        Route::get('/ventas2', function () {
            return view('ventas.pos.ventas2');
        });
        Route::get('/ventas3', function () {
            return view('ventas.pos.ventas3');
        });
        Route::get('/venta-clientes', function () {
            return view('ventas.venta-clientes');
        });
        Route::group(['prefix' => '/reportes'], function () {

            Route::get('/pp', function () {
                return view('ventas.reportes.pp');
            });
            Route::get('/pt', function () {
                return view('ventas.reportes.pt');
            });
        });

        Route::get('/lista', function () {
            return view('ventas.lista');
        });
        Route::get('/cerrada', function () {
            return view('ventas.cerrada');
        });
        Route::get('/pp', function () {
            return view('ventas.pp');
        });
        Route::get('/pt', function () {
            return view('ventas.pt');
        });
    });
    Route::group(['prefix' => '/entrega', 'middleware' => 'menu.access'], function () {
        Route::get('/historial', function () {
            return view('entrega.historial');
        });
        Route::get('/reportes/devolucion-general', function () {
            return view('entrega.reportes.devolucion_general');
        });
        Route::get('/reportes/clientes-deudores', function () {
            return view('entrega.reportes.clientes_deudores');
        });
        Route::get('/reportes/seguimiento-cliente', function () {
            return view('entrega.reportes.seguimiento_cliente');
        });
        Route::get('/reportes/cuentas-por-cobrar', function () {
            return view('entrega.reportes.cuentas_por_cobrar');
        });
        Route::get('/reportes/cuentas-por-cobrar-historico', function () {
            return view('entrega.reportes.cuentas_por_cobrar_historico');
        });
        Route::get('/reportes/cobros-individuales', function () {
            return view('entrega.reportes.cobros_individuales');
        });
        Route::get('/reportes/cobros-globales', function () {
            return view('entrega.reportes.cobros_globales');
        });
    });
    Route::group(['prefix' => '/validacion','middleware'=>'menu.access'], function () {
        Route::get('/bandera', function () {
            return view('validacion.bandera');
        });
        Route::get('/add', function () {
            return view('validacion.add');
        });
        Route::get('/lista', function () {
            return view('validacion.index');
        });
        Route::get('/cerradas', function () {
            return view('validacion.cerradas');
        });
        Route::get('/transformacion', function () {
            return view('validacion.transformacion');
        });
        Route::get('/transformacion/{id}', function ($id) {
            return view('validacion.transformacion_detalle', ['id' => $id]);
        });
        Route::get('/lotes', function () {
            return view('validacion.lotes');
        });

        Route::get('/bitacora', function () {
            return view('validacion.bitacora');
        });
        Route::get('/enviosGenPP', function () {
            return view('validacion.enviosGenPP');
        });
        Route::get('/enviosGenPT', function () {
            return view('validacion.enviosGenPT');
        });
        Route::get('/enviosPP', function () {
            return view('validacion.enviosPP');
        });
        Route::get('/enviosPT', function () {
            return view('validacion.enviosPT');
        });

        Route::get('/detalle/{id}', function ($id) {
            return view('validacion.id', ['id' => $id]);
        });
        Route::get('/item-precios-cambio', function () {
            return view('validacion.item.cambio');
        });
        Route::group(['prefix' => '/item'], function () {
            Route::get('/', function () {
                return view('validacion.item.index');
            });
            Route::get('/add', function () {
                return view('validacion.item.add');
            });

            Route::get('/edit/{id}', function ($id) {
                return view('validacion.item.edit', ['id' => $id]);
            });
            Route::get('/image/{id}', function ($id) {
                return view('validacion.item.image', ['id' => $id]);
            });
        });
    });
    Route::group(['prefix' => '/pp','middleware'=>'menu.access'], function () {

        Route::get('/lotes', function () {
            return view('pp.lotes.index');
        });
        Route::get('/promedio-merma', function () {
            return view('pp.promedio-merma');
        });
        Route::get('/informes', function () {
            return view('pp.informe.index');
        });
        Route::get('/informes/add', function () {
            return view('pp.informe.add');
        });
        Route::get('/lista', function () {
            return view('pp.index');
        });

        Route::get('/lotes/{id}', function ($id) {
            return view('pp.lotes.id', ['id' => $id]);
        });

        Route::get('/detalle/{id}', function ($id) {
            return view('pp.lotes.cerrar', ['id' => $id]);
        });

        Route::get('/cerrar-pp/{id}', function ($id) {
            return view('pp.lotes.cerrar', ['id' => $id]);
        });

        Route::get('/composicion/interna', function () {
            return view('pp.composicion.interna');
        });
        Route::get('/composicion/externa', function () {
            return view('pp.composicion.externa');
        });
        Route::get('/composicion/externa/detalles/{id}', function ($id) {
            return view('pp.composicion.detalle.id', ['id' => $id]);
        });
        Route::get('/enviosPT', function () {
            return view('pp.enviosPT');
        });
        Route::get('/trozadoPP', function () {
            return view('pp.trozadoPP');
        });
        Route::get('/traspasoPp', function () {
            return view('pp.traspasoPp');
        });
        Route::group(['prefix' => '/composicion/image'], function () {

            Route::get('/interna/{id}', function ($id) {
                return view('pp.composicion.image.interna', ['id' => $id]);
            });
            Route::get('/externa/{id}', function ($id) {
                return view('pp.composicion.image.id_externa', ['id' => $id]);
            });
        });
    });

    Route::group(['prefix' => '/pt','middleware'=>'menu.access'], function () {

        Route::get('/lotes', function () {
            return view('pt.lotes.index');
        });
        Route::get('/subpt', function () {
            return view('pt.subpt');
        });
        Route::get('/lotes/{id}', function ($id) {
            return view('pt.lotes.id', ['id' => $id]);
        });

        Route::get('/detalle/{id}', function ($id) {
            return view('pt.lotes.detalle', ['id' => $id]);
        });
        Route::get('/trozadoPT', function () {
            return view('pt.trozadoPT');
        });
        Route::get('/trozadoSubPT', function () {
            return view('pt.trozadoSubPT');
        });
    });
    Route::group(['prefix' => '/transformacion','middleware'=>'menu.access'], function () {

        Route::get('/lotes', function () {
            return view('transformacion.lotes.index');
        });
        Route::get('/detalle/{id}', function ($id) {
            return view('transformacion.lotes.detalle', ['id' => $id]);
        });
    });
    Route::group(['prefix' => '/cajas','middleware'=>'menu.access'], function () {
        Route::get('/', function () {
            return view('cajas.index');
        });
        Route::get('/motivos', function () {
            return view('cajas.motivos');
        });
        Route::get('/monedas', function () {
            return view('cajas.moneda');
        });
        Route::get('/arqueos', function () {
            return view('cajas.arqueo');
        });
        Route::get('/apertura-cierre', function () {
            return view('cajas.aperturacierre');
        });
        Route::get('/asignacion/{id}', function ($id) {
            return view('cajas.asignacion', ['id' => $id]);
        });
        Route::get('/moneda/image/{id}', function ($id) {
            return view('cajas.image', ['id' => $id]);
        });
        Route::get('/reportes/cobranza-gastos', function () {
            return view('cajas.reportes.cobranza_gastos');
        });
        Route::get('/reportes/cobranza-chofer', function () {
            return view('cajas.reportes.cobranza_chofer');
        });
        Route::get('/reportes/cobranza-usuario', function () {
            return view('cajas.reportes.cobranza_usuario');
        });
    });
    Route::group(['prefix' => '/pedidos'], function () {

        Route::get('/', function () {
            return view('pedidos.lista');
        });
        Route::get('/add', function () {
            return view('pedidos.add');
        });
    });
    Route::group(['prefix' => '/reportes', 'middleware' => 'auth'], function () {
        Route::get('stockdotacions/{stockdotacion}', 'StockdotacionController@pdf');
        Route::get('stockdotacions-ticket/{stockdotacion}', 'StockdotacionController@pdfTicket');
        Route::get('contratos/{contrato}', 'ContratoController@pdf');
        Route::get('planillas/{planilla}', 'PlanillaController@pdf');
        Route::get('finiquitoanuals/{finiquitoanual}', 'FiniquitoanualController@pdf');
        Route::get('finiquinquenios/{finiquinquenio}', 'FiniquinquenioController@pdf');
        Route::get('finivacacionals/{finivacacional}', 'FinivacacionalController@pdf');
        Route::get('finiaguinaldos/{finiaguinaldo}', 'FiniaguinaldoController@pdf');
        Route::get('liquidacions/{liquidacion}', 'LiquidacionController@pdf');
        Route::get('ajustedotacions/{ajustedotacion}', 'AjustedotacionController@pdf');
        Route::get('ajustedotacions-ticket/{ajustedotacion}', 'AjustedotacionController@pdfTicket');
        Route::get('traspasoDotacions/{traspasoDotacion}', 'TraspasoDotacionController@pdf');
        Route::get('traspasoDotacions-ticket/{traspasoDotacion}', 'TraspasoDotacionController@pdfTicket');
        Route::get('salidadotacioncontratos/{salidadotacioncontrato}', 'SalidadotacioncontratoController@pdf');
        Route::get('redotacions/{redotacion}', 'RedotacionController@pdf');
        Route::get('salidadotaclientes/{salidadotacliente}', 'SalidadotaclienteController@pdf');
        Route::get('planillaservicios/{planillaservicio}', 'PlanillaservicioController@pdf');
        Route::get('memorandums/{memorandum}', 'MemorandumController@pdf');

        Route::get('compras_2/{compra}', 'CompraController@pdf_view');
        Route::get('compras/{compra}', 'CompraController@pdf');
        Route::get('compras_horizontal/{compra}', 'CompraController@pdf_horizontal');
        Route::get('compra-originals/{compra}', 'CompraController@pdf_o');
        Route::get('compra-categorizadas/{compra}', 'CompraController@categorizada');
        Route::get('compra-sub/{compra}', 'CompraController@sub');
        Route::get('compra-excels/{compra}', 'CompraController@pdf_excel');

        Route::get('compras_aves_2/{compra}', 'CompraAveController@pdf_view');
        Route::get('compras_aves/{compra}', 'CompraAveController@pdf');
        Route::get('compras_aves_horizontal/{compra}', 'CompraAveController@pdf_horizontal');
        Route::get('compra_aves-originals/{compra}', 'CompraAveController@pdf_o');
        Route::get('compra_aves-categorizadas/{compra}', 'CompraAveController@categorizada');
        Route::get('compra_aves-sub/{compra}', 'CompraAveController@sub');
        Route::get('compra_aves-excels/{compra}', 'CompraAveController@pdf_excel');

        Route::get('consolidacions/{consolidacion}', 'ConsolidacionController@pdf');
        Route::get('consolidacions-cambios-precio/{consolidacion}', 'ConsolidacionController@pdfcambios');
        Route::get('consolidacionPagos/{consolidacionPago}', 'ConsolidacionPagoController@pdf');
        Route::get('consolidacionPagoTickets/{consolidacionPagoTicket}', 'ConsolidacionPagoTicketController@ticket');

        Route::get('consolidacions_aves/{consolidacion}', 'ConsolidacionAveController@pdf');
        Route::get('consolidacions_aves-cambios-precio/{consolidacion}', 'ConsolidacionAveController@pdfcambios');
        Route::get('consolidacion_avesPagos/{consolidacionPago}', 'ConsolidacionAvePagoController@pdf');
        Route::get('consolidacion_avesPagoTickets/{consolidacionPagoTicket}', 'ConsolidacionAvePagoTicketController@ticket');

        Route::get('consolidacions_aves_new/{consolidacion}', 'ConsolidacionAveNewController@pdf');
        Route::get('consolidacions_aves_new2/{consolidacion}', 'ConsolidacionAveNewController@pdf2');
        Route::get('consolidacions_aves_new-cambios-precio/{consolidacion}', 'ConsolidacionAveNewController@pdfcambios');
        Route::get('consolidacion_aves_newPagos/{consolidacionPago}', 'ConsolidacionAveNewPagoController@pdf');
        Route::get('consolidacion_aves_newPagoTickets/{consolidacionPagoTicket}', 'ConsolidacionAveNewPagoTicketController@ticket');

        Route::get('compraCajas/{compraCaja}', 'CompraCajaController@ticket');
        Route::get('traspasoCajas/{traspasoCaja}', 'TraspasoCajaController@ticket');
        Route::get('cajaAjustes/{cajaAjuste}', 'CajaAjusteController@ticket');
        Route::get('cajaEnvios/{cajaEnvio}', 'CajaEnvioController@ticket');
        Route::get('validarCajas/{validarCaja}', 'ValidarCajaController@pdf');

        Route::get('control-cajas/pdf', 'ValidarCajaController@generarReportePDF');
        Route::get('control-cajas-semanal/pdf', 'ValidarCajaController@generarReporteSemanalPDF');
        //ticket taco
        Route::get('validarCajasTicket/{validarCaja}', 'ValidarCajaController@pdfTicket');
        //ticket taco
        Route::get('pagoCompraCajas/{pagoCompraCaja}', 'PagoCompraCajaController@ticket');
        Route::get('informePreliminars/{informePreliminar}', 'InformePreliminarController@pdf');
        Route::get('lotes/{lote}', 'LoteController@pdf');
        Route::get('lotes-seguimiento/{lote}', 'LoteController@pdfseg');
        Route::get('lotes-seguimiento-cliente/{lote}', 'LoteController@pdfsegcliente');
        Route::get('lotes-seguimiento-cliente-cronologico/{lote}', 'LoteController@pdfsegcliente_cronologico');
        Route::get('lotes-seguimiento-producto/{lote}', 'LoteController@pdfsegproducto');
        Route::get('lotes-seguimiento-producto-pt-pp/{lote}', 'LoteController@pdfsegproducto_pp_pt');
        Route::get('lotes-seguimiento-cronologico/{lote}', 'LoteController@pdfsegcronologico');
        Route::get('lotes-seguimiento-cronologico-movimiento/{lote}', 'LoteController@pdfsegcronologicoMovimiento');
        Route::get('lotes-seguimiento-cronologico-movimiento-compra/{lote}', 'LoteController@pdfsegcronologicoMovimientoCompra');
        Route::get('envios-pt-pp/{lote}', 'LoteController@pdfenviosptpp');
        Route::get('pp-cronologico-2/{pp}', 'PpController@showPPCronologico');
        Route::get('loteEnvioPps/{loteEnvioPp}', 'LoteEnvioPpController@pdf');
        Route::get('loteEnvioPts/{loteEnvioPt}', 'LoteEnvioPtController@pdf');
        Route::get('loteTrozadoPps/{loteTrozadoPp}', 'LoteTrozadoPpController@pdf');
        Route::get('loteTrozadoPts/{loteTrozadoPt}', 'LoteTrozadoPtController@pdf');
        Route::get('loteEnvioPppts/{loteEnvioPppt}', 'LoteEnvioPpptController@pdf');
        Route::get('lotes-pt/{lote}', 'LoteController@pdf_pt');
        Route::get('lotes-pp/{lote}', 'LoteController@pdf_pp');
        Route::get('subDesPtDetalleDescos/{subDesPtDetalleDesco}', 'SubDesPtDetalleDescoController@pdf');
        Route::get('pp/{pp}', 'PpController@pdf');
        Route::get('pp-inicial-2/{pp}', 'PpController@PesoInicialPp');
        Route::get('pp-inicial-total/{pp}', 'PpController@PesoInicialPp');
        Route::get('pp-inicial-total/{pp}', 'PpController@PesoInicialTotalPp');
        Route::get('pp_entrada_lotes/{pp}', 'PpController@pp_entrada_lotes_pdf');
        Route::get('pp-reporte-general/{pp}', 'PpController@pp_reporte_general_pdf');
        Route::get('pp_general_lotes/{pp}', 'PpController@pp_general_lotes_pdf');
        Route::get('pp-informe/{pp}', 'PpController@InformePdf');
        Route::get('pp_envio_lotes/{pp}', 'PpController@pp_envio_lotes_pdf');
        Route::get('pp_venta_lotes/{pp}', 'PpController@pp_venta_lotes_pdf');
        Route::get('pt/{pt}', 'PtController@pdf');
        Route::get('pp-cronologico/{pp}', 'PpController@CronologicoPdf');
        Route::get('pp-reporte-venta/{pp}', 'PpController@ReportVentaPdf');
        Route::get('pt_entrada_lotes/{pt}', 'PtController@pt_entrada_lotes_pdf');
        Route::get('pt_informe_lotes/{pt}', 'PtController@pt_informe_lotes_pdf');
        Route::get('pt_informe/{pt}', 'PtController@pt_informe');
        Route::get('pt_general_lotes/{pt}', 'PtController@pt_general_lotes_pdf');
        Route::get('pt_envio_lotes/{pt}', 'PtController@pt_envio_lotes_pdf');
        Route::get('pp_aceptado_lotes/{pp}', 'PpController@pp_aceptado_lotes_pdf');
        Route::get('pt_venta_lotes/{pt}', 'PtController@pt_venta_lotes_pdf');
        Route::get('pt_descomponer_lotes/{pt}', 'PtController@pt_descomponer_lotes_pdf');
        Route::get('pt_items_lotes/{pt}', 'PtController@pt_items_lotes_pdf');
        Route::get('traspasoPps/{traspasoPp}', 'TraspasoPpController@pdf');
        Route::get('envioGenPps/{envioGenPp}', 'EnvioGenPpController@pdf');
        Route::get('envioGenPts/{envioGenPt}', 'EnvioGenPtController@pdf');
        Route::get('ventas/{venta}', 'VentaController@pdf');
        Route::get('ventas-oficial/{venta}', 'VentaController@pdfOficial');

        // NOTAS PDF
        Route::get('ticket-ventas-oficial/{venta}', 'VentaController@pdfTicketOficial');
        // Route::get('cajas-oficial/{venta}', 'VentaController@ticketCajasOficial');

        // Route::get('cajas-oficial/{venta}/{entregaCaja}/{entregaCajaRecuperada?}', 'VentaController@ticketCajasOficial');
        Route::get('cajas-oficial/{entregaCaja}', 'VentaController@ticketCajasOficial');
        // Route::get('cajas-oficial-chofer/{venta}/{entregaCaja}/{entregaCajaRecuperada?}', 'VentaController@ticketCajasChoferOficial');
        Route::get('cajas-oficial-chofer/{entregaCaja}', 'VentaController@ticketCajasChoferOficial');
        Route::get('cobranzas-oficial/{venta}', 'VentaController@ticketCobranzasOficial');

        Route::get('cobranzas-oficial-ind/{pago}', 'VentaController@ticketCobranzasIndOficial');
        Route::get('cobranza-global-oficial/{pago}', 'VentaController@ticketCobranzasGlobalOficial');

        Route::get('reporte-cobranza-gastos', 'ArqueoController@pdfReporteCobranzaYGastos');
        Route::get('reporte-cobranza-usuario', 'ArqueoController@pdfReporteCobranzaUsuario');
        Route::get('reporte-cobranza-chofer', 'ArqueoController@pdfReporteCobranzaChofer');

        Route::get('reporte-devolucion-general', 'EntregaController@pdfReporteDevolucionGeneral');
        Route::get('reporte-devolucion-clientes-por-chofer', 'EntregaController@pdfListaDeClientesDeudoresPorChofer');
        Route::get('reporte-seguimiento-cliente', 'EntregaController@pdfSeguimientoCliente');
        Route::get('reporte-cuentas-por-cobrar', 'EntregaController@pdfCuentasPorCobrarCliente');
        Route::get('reporte-cuentas-por-cobrar-historico', 'EntregaController@pdfCuentasPorCobrarHistoricoCliente');

        Route::get('cierre-caja/{arqueo}', 'ArqueoController@cierreCajaPdf');
        // NOTAS PDF

        Route::get('pedidoClientes/{pedidoCliente}', 'PedidoClienteController@pdf');
        Route::get('cambioPrecios/{cambioPrecio}', 'CambioPrecioController@pdf');
        Route::get('productoPrecioCambios/{productoPrecioCambio}', 'ProductoPrecioCambioController@pdf');
        Route::get('pollolimpioCambios/{pollolimpioCambio}', 'PollolimpioCambioController@pdf');
        Route::get('turnoChofers/{turnoChofer}', 'TurnoChoferController@pdf');
        Route::get('pollo-promedios/{sucursal}', 'PolloSucursalController@pdf');
        Route::get('pollo-promedios-preventista/{sucursal}', 'PolloSucursalController@pdf_preventista');
        Route::get('consolidacions-detalle-pagos/{consolidacion}', 'ConsolidacionController@pdfdetallePagos');
        Route::get('consolidacions_aves-detalle-pagos/{consolidacion}', 'ConsolidacionAveController@pdfdetallePagos');
        Route::get('consolidacions_aves_new-detalle-pagos/{consolidacion}', 'ConsolidacionAveNewController@pdfdetallePagos');

        // TRANSFORMACIONES
        Route::get('transEspecials', 'TransEspecialController@pdf');
        Route::get('transformacionLotes-excel/{transformacionLote}', 'TransformacionLoteController@excelstock');
        Route::get('transformacionLotes-peso-total/{transformacionLote}', 'TransformacionLoteController@PesoInicialTotalTrans');
        Route::get('transformacionLotes-movimientos/{transformacionLote}', 'TransformacionLoteController@ReporteVentasMovimientosTrans');
        Route::get('transformacionLotes-general/{transformacionLote}', 'TransformacionLoteController@ReporteGeneralTrans');
        Route::get('transItems', 'TransItemController@pdf');

        //PT
        Route::get('pt/peso-inicial-1/{pt}', 'PtController@PesoInicialPt');
        Route::get('pt/peso-inicial-2/{pt}', 'PtController@PesoInicial2Pt');
        Route::get('pt/peso-total/{pt}', 'PtController@PesoInicialTotalPt');
        Route::get('pt/pt-reporte-general/{pt}', 'PtController@ReporteGeneral');
        Route::get('pt/pt-ventas/{pt}', 'PtController@ReporteVentas');
        Route::get('pt/pt-movimientos-reporte/{pt}', 'PtController@ReporteMovimientosPt');
        //VENTAS
        Route::get('ventas-cliente', 'VentaController@ventaCliente');
        Route::get('ventas-cliente-2', 'VentaController@ventaClienteReport');
        Route::get('venta-clientes/zona-{zona}/tipo-{tipo}/chofer-{chofer}/preventista-{user}/forma-{forma}/fecha_inicio-{fecha_1}/fecha_fin-{fecha_2}/excel', 'VentaController@ventaClienteReportExcel');
        Route::get('venta-clientes/zona-{zona}/tipo-{tipo}/chofer-{chofer}/preventista-{user}/forma-{forma}/fecha_inicio-{fecha_1}/fecha_fin-{fecha_2}/pdf', 'VentaController@ventaClienteReportPDF');
    });
    //Excel
    Route::get('/download-template-cliente', 'ClienteController@TemplateExcel');
    Route::post('/import-template-cliente', 'ClienteController@ImportarExcel');

    Route::get('/download-template-planilla', [PlanillaController::class, 'TemplateExcel'])->name('planillas.downloadTemplate');
    Route::post('/import-template-planilla', [PlanillaController::class, 'ImportarExcel'])->name('planillas.import');

    Route::get('/download-template-planilla-servicio', [PlanillaservicioController::class, 'TemplateExcel'])->name('planillasservicio.downloadTemplate');
    Route::post('/import-template-planilla-servicio', [PlanillaservicioController::class, 'ImportarExcel'])->name('planillasservicio.import');
});
