<?php
namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Menú Escritorio nivel 0
        $escritorioMenu = Menu::create([
            'icon'  => 'mdiDatabase',
            'label' => 'Escritorio',
            'order' => 0,
            'level' => 0,
        ]);

        // Items escritorio Nivel 1
        Menu::create([
            'icon'    => 'mdiHomeAccount',
            'label'   => 'Accesos Directos',
            'order'   => 1,
            'level'   => 1,
            'route'   => 'accesos-directos',
            'menu_id' => $escritorioMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiHomeCircle',
            'label'   => 'Escritorio',
            'order'   => 1,
            'level'   => 1,
            'route'   => '/',
            'menu_id' => $escritorioMenu->id,
        ]);
        // Menú principal "Admin"
        $adminMenu = Menu::create([
            'icon'  => 'mdiCog',
            'label' => 'Admin',
            'order' => 1,
            'level' => 0, // Nivel 0
        ]);

        // Submenú "Configuracion" (Nivel 1)
        $configuracionSubMenu = Menu::create([
            'icon'    => 'mdiCog',
            'label'   => 'Configuracion',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $adminMenu->id,
        ]);

        //Menu Nivel 2
        Menu::create([
            'icon'    => 'mdiFileDocument',
            'label'   => 'Documentos',
            'order'   => 1,
            'level'   => 2,
            'route'   => 'admin/configuracion/documentos',
            'menu_id' => $configuracionSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiFileTypeTxt',
            'label'   => 'Tipo de Archivo',
            'order'   => 2,
            'level'   => 2,
            'route'   => 'admin/configuracion/tipoarchivos',
            'menu_id' => $configuracionSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiCreditCardOutline',
            'label'   => 'Tipo de Pago',
            'order'   => 3,
            'level'   => 2,
            'route'   => 'admin/configuracion/tipopagos',
            'menu_id' => $configuracionSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiMapMarker',
            'label'   => 'Sucursales',
            'order'   => 4,
            'level'   => 2,
            'route'   => 'admin/configuracion/sucursal',
            'menu_id' => $configuracionSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiReceipt',
            'label'   => 'Comprobantes',
            'order'   => 5,
            'level'   => 2,
            'route'   => 'admin/configuracion/comprobantes',
            'menu_id' => $configuracionSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiPrinter',
            'label'   => 'Tirajes',
            'order'   => 6,
            'level'   => 2,
            'route'   => 'admin/configuracion/sucursaltiraje',
            'menu_id' => $configuracionSubMenu->id,
        ]);

        // Submenu Nivel 1
        $personalSubMenu = Menu::create([
            'icon'    => 'mdiAccountMultiple',
            'label'   => 'Personal',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $adminMenu->id,
        ]);

        //submenú "Personal" Nivel 2
        Menu::create([
            'icon'    => 'mdiAccountMultiple',
            'label'   => 'Personas',
            'order'   => 1,
            'level'   => 2,
            'route'   => 'admin/personal/persona',
            'menu_id' => $personalSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiAccountMultipleRemove',
            'label'   => 'Personas Inactivas',
            'order'   => 2,
            'level'   => 2,
            'route'   => 'admin/personal/persona/inactivos',
            'menu_id' => $personalSubMenu->id,
        ]);

        // Submenu Nivel 1
        $controlSubMenu = Menu::create([
            'icon'    => 'mdiAccountMultiple',
            'label'   => 'Administrar',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $adminMenu->id,
        ]);

        //submenú "Permisos" Nivel 2
        Menu::create([
            'icon'    => 'mdiAccountMultiple',
            'label'   => 'Usuarios',
            'order'   => 3,
            'level'   => 2,
            'route'   => 'admin/control_acceso/usuario',
            'menu_id' => $controlSubMenu->id,
        ]);
        Menu::create([
            'icon'    => 'mdiAccountMultipleRemove',
            'label'   => 'Control de Acceso',
            'order'   => 2,
            'level'   => 2,
            'route'   => 'admin/control_acceso/permisos',
            'menu_id' => $controlSubMenu->id,
        ]);

$documentacionSubMenu = Menu::create([
            'icon'    => 'mdiAccountMultiple',
            'label'   => 'Documentacion',
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $adminMenu->id,
        ]);

        //submenú "Permisos" Nivel 2
        Menu::create([
            'icon'    => 'mdiAccountMultiple',
            'label'   => 'Admin',
            'order'   => 1,
            'level'   => 2,
            'route'   => 'admin/documentacion/admin',
            'menu_id' => $documentacionSubMenu->id,
        ]);
        Menu::create([
            'icon'    => 'mdiAccountMultipleRemove',
            'label'   => 'Listado',
            'order'   => 2,
            'level'   => 2,
            'route'   => 'admin/documentacion',
            'menu_id' => $documentacionSubMenu->id,
        ]);

Menu::create([
            'icon'    => 'mdiHomeCircle',
            'label'   => 'Logs',
            'order'   => 4,
            'level'   => 1,
            'route'   => 'admin/logs',
            'menu_id' => $adminMenu->id,
        ]);
Menu::create([
            'icon'    => 'mdiHomeCircle',
            'label'   => 'Storage',
            'order'   => 5,
            'level'   => 1,
            'route'   => 'admin/storage',
            'menu_id' => $adminMenu->id,
        ]);
Menu::create([
            'icon'    => 'mdiHomeCircle',
            'label'   => 'Backup DB',
            'order'   => 6,
            'level'   => 1,
            'route'   => 'admin/backup',
            'menu_id' => $adminMenu->id,
        ]);
Menu::create([
            'icon'    => 'mdiHomeCircle',
            'label'   => 'Restore DB',
            'order'   => 7,
            'level'   => 1,
            'route'   => 'admin/restore',
            'menu_id' => $adminMenu->id,
        ]);
Menu::create([
            'icon'    => 'mdiHomeCircle',
            'label'   => 'Vaciar DB',
            'order'   => 8,
            'level'   => 1,
            'route'   => 'admin/truncate',
            'menu_id' => $adminMenu->id,
        ]);

        // Menú principal "RRHH"
        $rrhhMenu = Menu::create([
            'icon'  => 'mdiDatabase',
            'label' => 'RRHH',
            'order' => 1,
            'level' => 0,
        ]);

        // Items de RRHH (Nivel 1)
        Menu::create([
            'icon'    => 'mdiCreditCardMarkerOutline',
            'label'   => 'Formas de Pago',
            'order'   => 1,
            'level'   => 1,
            'route'   => 'admin/configuracion/formapagos',
            'menu_id' => $rrhhMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiBank',
            'label'   => 'Bancos',
            'order'   => 2,
            'level'   => 1,
            'route'   => 'admin/configuracion/bancos',
            'menu_id' => $rrhhMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiCashMinus',
            'label'   => 'Costos Fijos',
            'order'   => 3,
            'level'   => 1,
            'route'   => '/rrhh/costos/fijos',
            'menu_id' => $rrhhMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiCashMultiple',
            'label'   => 'Costos Variables',
            'order'   => 4,
            'level'   => 1,
            'route'   => 'rrhh/costos/variables',
            'menu_id' => $rrhhMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiDomain',
            'label'   => 'Areas',
            'order'   => 5,
            'level'   => 1,
            'route'   => 'rrhh/area',
            'menu_id' => $rrhhMenu->id,
        ]);

        // Submenú Nivel 1
        $dotacionesSubMenu = Menu::create([
            'icon'    => 'mdiAccountMultiple',
            'label'   => 'Dotaciones',
            'order'   => 6,
            'level'   => 1,
            'menu_id' => $rrhhMenu->id,
        ]);

        //Nivel 2
        Menu::create([
            'icon'    => 'mdiHumanMaleFemaleChild',
            'label'   => 'Familias',
            'order'   => 1,
            'level'   => 2,
            'route'   => 'rrhh/dotacions/familia',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiTruckDelivery',
            'label'   => 'Proveedores Dotacion',
            'order'   => 2,
            'level'   => 1,
            'route'   => 'rrhh/proveedors',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiTruckDelivery',
            'label'   => 'Item Dotaciones',
            'order'   => 3,
            'level'   => 1,
            'route'   => '/rrhh/dotacions',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdiTruckDelivery',
            'label'   => 'Stock de dotaciones',
            'order'   => 3,
            'level'   => 1,
            'route'   => '/rrhh/dotacions/inventario',
            'menu_id' => $dotacionesSubMenu->id,
        ]);
        Menu::create([
            'icon'    => 'mdiAccountArrowRight',
            'label'   => 'Salida por clientes',
            'order'   => 4,
            'level'   => 1,
            'route'   => '/rrhh/dotacions/salidacliente',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        // Salida de dotaciones para personal
        Menu::create([
            'icon'    => 'mdiAccountMultipleArrowRight',
            'label'   => 'Salida para personal',
            'order'   => 5,
            'level'   => 1,
            'route'   => '/rrhh/dotacions/salidacontratos',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        // Re-dotación de elementos
        Menu::create([
            'icon'    => 'mdiRefresh',
            'label'   => 'Redotacion',
            'order'   => 6,
            'level'   => 1,
            'route'   => '/rrhh/dotacions/redotacion',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        // Ingreso de nuevo stock
        Menu::create([
            'icon'    => 'mdiBoxIncoming',
            'label'   => 'Ingreso de Stock',
            'order'   => 7,
            'level'   => 1,
            'route'   => '/rrhh/dotacions/stockingreso',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        // Ajustes en el stock
        Menu::create([
            'icon'    => 'mdiTune',
            'label'   => 'Ajustes de Stock',
            'order'   => 8,
            'level'   => 1,
            'route'   => '/rrhh/dotacions/inventario/ajustes',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        // Traspasos de stock entre ubicaciones
        Menu::create([
            'icon'    => 'mdiSwapHorizontal',
            'label'   => 'Traspasos de Stock',
            'order'   => 9,
            'level'   => 1,
            'route'   => '/rrhh/dotacions/inventario/traspasos',
            'menu_id' => $dotacionesSubMenu->id,
        ]);

        // Kardex para el seguimiento de dotaciones
        Menu::create([
            'icon'    => 'mdiFileDocument',
            'label'   => 'Kardex de Dotacion',
            'order'   => 10,
            'level'   => 1,
            'route'   => '/rrhh/dotacions/kardex',
            'menu_id' => $dotacionesSubMenu->id,
        ]);
        $contratosSubMenu = Menu::create([
            'label'   => 'Contratos',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $rrhhMenu->id,
            'icon'    => 'mdi-file-document',
        ]);

        //Nivel 2
        Menu::create([
            'icon'    => 'mdi-file-document',
            'label'   => 'Tipos de contrato',
            'route'   => 'rrhh/tipocontratos',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $contratosSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdi-file-document',
            'label'   => 'Contratos',
            'route'   => 'rrhh/contratos',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $contratosSubMenu->id,
        ]);

        Menu::create([
            'icon'    => 'mdi-file-document',
            'label'   => 'Parametro vacaciones',
            'route'   => 'admin/configuracion/parametrovacacions',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $contratosSubMenu->id,
        ]);

        //Nivel 1
        $planillasSubMenu = Menu::create([
            'label'   => 'Planillas',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $rrhhMenu->id,
            'icon'    => 'mdi-file-edit',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Configuración',
            'route'   => 'rrhh/planillas/config',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $planillasSubMenu->id,
            'icon'    => 'mdi-cog',
        ]);

        Menu::create([
            'label'   => 'Planillas',
            'route'   => 'rrhh/planillas',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $planillasSubMenu->id,
            'icon'    => 'mdi-file-table',
        ]);

        Menu::create([
            'label'   => 'Planillas Servicio',
            'route'   => 'rrhh/planillaservicios',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $planillasSubMenu->id,
            'icon'    => 'mdi-file-document',
        ]);

        // Level 1
        $finiquitosSubMenu = Menu::create([
            'label'   => 'Finiquitos',
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $rrhhMenu->id,
            'icon'    => 'mdi-file-sign',
        ]);

        //Level 2
        Menu::create([
            'label'   => 'Finiquito anual',
            'route'   => 'rrhh/finiquito/anual',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $finiquitosSubMenu->id,
            'icon'    => 'mdi-calendar-month',
        ]);

        Menu::create([
            'label'   => 'Finiquito quinquenio',
            'route'   => 'rrhh/finiquito/quinquenio',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $finiquitosSubMenu->id,
            'icon'    => 'mdi-calendar-star',
        ]);

        Menu::create([
            'label'   => 'Finiquito vacacional',
            'route'   => 'rrhh/finiquito/vacacional',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $finiquitosSubMenu->id,
            'icon'    => 'mdi-beach',
        ]);

        Menu::create([
            'label'   => 'Finiquito aguinaldo',
            'route'   => 'rrhh/finiquito/aguinaldo',
            'order'   => 4,
            'level'   => 2,
            'menu_id' => $finiquitosSubMenu->id,
            'icon'    => 'mdi-gift',
        ]);

        // 2. Create the single-level "Liquidación" item.
        Menu::create([
            'label'   => 'Liquidación',
            'route'   => 'rrhh/liquidacion',
            'order'   => 4, // Assuming an order after other RRHH items
            'level'   => 1,
            'menu_id' => $rrhhMenu->id,
            'icon'    => 'mdi-cash-multiple', // Icon for liquidation/money
        ]);

        // Level 1
        $reportesSubMenu = Menu::create([
            'label'   => 'Reportes',
            'order'   => 5,
            'level'   => 1,
            'menu_id' => $rrhhMenu->id,
            'icon'    => 'mdi-file-chart',
        ]);

        //Level 2
        Menu::create([
            'label'   => 'Planillas por personal',
            'route'   => 'rrhh/reportes/planillas',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-account-details',
        ]);

        Menu::create([
            'label'   => 'Planillas servicio por personal',
            'route'   => 'rrhh/reportes/planillaservicios',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-account-tie',
        ]);

        Menu::create([
            'label'   => 'Finiquitos anual',
            'route'   => 'rrhh/reportes/finiquitoanuals',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-calendar-check',
        ]);

        Menu::create([
            'label'   => 'Finiquitos vacacional',
            'route'   => 'rrhh/reportes/finiquitovacacionals',
            'order'   => 4,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-calendar-blank',
        ]);

        Menu::create([
            'label'   => 'Finiquitos aguinaldo',
            'route'   => 'rrhh/reportes/finiquitoaguinaldos',
            'order'   => 5,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-gift-outline',
        ]);

        Menu::create([
            'label'   => 'Liquidaciones aguinaldo',
            'route'   => 'rrhh/reportes/liquidacions',
            'order'   => 6,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-cash-check',
        ]);

        //Nivel 0
        $almacenMenu = Menu::create([
            'label' => 'Almacen',
            'order' => 1,
            'level' => 0,
            'icon'  => 'mdi-archive',
        ]);

        //Nivel 1
        Menu::create([
            'label'   => 'Categorias',
            'route'   => 'almacen/categorias',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-tag-multiple', // Icono para Categorias
        ]);

        Menu::create([
            'label'   => 'Producto Precios',
            'route'   => 'almacen/producto-precio',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-cash', // Icono para Precios
        ]);

        Menu::create([
            'label'   => 'Producto Precios Cambio',
            'route'   => 'almacen/producto-precio-cambios',
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-swap-horizontal-bold',
        ]);

        Menu::create([
            'label'   => 'Pollo Limpio Precios',
            'route'   => 'almacen/pollolimpio',
            'order'   => 4,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-food-chicken',
        ]);

        Menu::create([
            'label'   => 'Pollo Limpio Precios Cambio',
            'route'   => 'almacen/pollolimpio-cambios',
            'order'   => 5,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-swap-horizontal',
        ]);

        Menu::create([
            'label'   => 'Proveedores de Lote',
            'route'   => 'almacen/proveedors',
            'order'   => 6,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-truck',
        ]);

        Menu::create([
            'label'   => 'Prov. Lote Inactivos',
            'route'   => 'almacen/proveedors/inactivos',
            'order'   => 7,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-truck-off',
        ]);

        Menu::create([
            'label'   => 'Proveedores de Aves',
            'route'   => 'almacen/proveedors_aves',
            'order'   => 8,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-truck-fast',
        ]);

        Menu::create([
            'label'   => 'Prov. Aves Inactivos',
            'route'   => 'almacen/proveedors_aves/inactivos',
            'order'   => 9,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-truck-off-outline',
        ]);

        Menu::create([
            'label'   => 'Compras de Lotes',
            'route'   => 'almacen/compras',
            'order'   => 10,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-cart',
        ]);

        Menu::create([
            'label'   => 'Compras Cerradas',
            'route'   => 'almacen/compras/compras-cerradas',
            'order'   => 11,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-cart-off',
        ]);

        // 3. Submenú "Consolidacion" (Nivel 1)
        $consolidacionSubMenu = Menu::create([
            'label'   => 'Consolidacion',
            'order'   => 12,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-sitemap',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Parametros',
            'route'   => 'almacen/consilodacion/params',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $consolidacionSubMenu->id,
            'icon'    => 'mdi-cogs',
        ]);

        Menu::create([
            'label'   => 'Consolidaciones',
            'route'   => 'almacen/consilodacion/lista',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $consolidacionSubMenu->id,
            'icon'    => 'mdi-view-list',
        ]);

        Menu::create([
            'label'   => 'Consolidaciones Aves',
            'route'   => 'almacen/consilodacion/lista-ave',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $consolidacionSubMenu->id,
            'icon'    => 'mdi-food-drumstick',
        ]);

        Menu::create([
            'label'   => 'Consolidaciones Aves Oficial',
            'route'   => 'almacen/consilodacion/lista-ave-new',
            'order'   => 4,
            'level'   => 2,
            'menu_id' => $consolidacionSubMenu->id,
            'icon'    => 'mdi-food-drumstick-outline',
        ]);

        //Nivel 1
        $pagarLoteSubMenu = Menu::create([
            'label'   => 'Pagar Compras',
            'order'   => 13,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-credit-card-settings',
        ]);

        // Nivel 2
        Menu::create([
            'label'   => 'Pagar Compra',
            'route'   => 'almacen/consilodacion/pagar',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $pagarLoteSubMenu->id,
            'icon'    => 'mdi-cash-plus',
        ]);

        Menu::create([
            'label'   => 'Pagos lote',
            'route'   => 'almacen/consilodacion/tickets',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $pagarLoteSubMenu->id,
            'icon'    => 'mdi-ticket',
        ]);

        //Nivel 1
        $pagarLoteAvesSubMenu = Menu::create([
            'label'   => 'Pagar Compras Aves',
            'order'   => 14,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-credit-card-plus',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Pagar Compra',
            'route'   => 'almacen/consilodacion/pagar-ave',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $pagarLoteAvesSubMenu->id,
            'icon'    => 'mdi-cash-plus-outline',
        ]);

        Menu::create([
            'label'   => 'Pagos lote',
            'route'   => 'almacen/consilodacion/tickets-ave',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $pagarLoteAvesSubMenu->id,
            'icon'    => 'mdi-ticket-percent-outline',
        ]);

        //Nivel 1
        $pagarAvesSubMenu = Menu::create([
            'label'   => 'Pagar Aves',
            'order'   => 15,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-cash-sync',
        ]);

        // Nivel 2
        Menu::create([
            'label'   => 'Pagar Consolidación',
            'route'   => 'almacen/consilodacion/pagar-ave-new',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $pagarAvesSubMenu->id,
            'icon'    => 'mdi-cash-fast',
        ]);

        Menu::create([
            'label'   => 'Pagos lote',
            'route'   => 'almacen/consilodacion/tickets-ave-new',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $pagarAvesSubMenu->id,
            'icon'    => 'mdi-ticket-confirmation',
        ]);
        Menu::create([
            'label'   => 'Medidas',
            'route'   => 'almacen/medidas',
            'order'   => 16,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-ruler',
        ]);

        Menu::create([
            'label'   => 'Productos',
            'route'   => 'almacen/productos',
            'order'   => 17,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-package-variant',
        ]);

        Menu::create([
            'label'   => 'Almacenes',
            'route'   => 'almacen/almacens',
            'order'   => 18,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-warehouse',
        ]);

        Menu::create([
            'label'   => 'Inventario',
            'route'   => 'almacen/inventario',
            'order'   => 19,
            'level'   => 1,
            'menu_id' => $almacenMenu->id,
            'icon'    => 'mdi-clipboard-list',
        ]);

        $cajasMenu = Menu::create([
            'label' => 'Cajas',
            'order' => 2,
            'level' => 0,
            'icon'  => 'mdi-package-variant',
        ]);

        // Nivel 1
        Menu::create([
            'label'   => 'Proveedores de Caja',
            'route'   => 'almacen/cajas/proveedors',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-truck-cargo-container',
        ]);

        Menu::create([
            'label'   => 'Cajas',
            'route'   => 'almacen/cajas/',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-package-variant-closed',
        ]);

        Menu::create([
            'label'   => 'Compras de Cajas',
            'route'   => 'almacen/cajas/compras',
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-cart-plus',
        ]);

        Menu::create([
            'label'   => 'Pagos Compras',
            'route'   => 'almacen/cajas/compras/tickets',
            'order'   => 4,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-credit-card-plus-outline',
        ]);

        Menu::create([
            'label'   => 'Inventarios',
            'route'   => 'almacen/cajas/inventarios',
            'order'   => 5,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-clipboard-list-outline',
        ]);

        Menu::create([
            'label'   => 'Traspaso',
            'route'   => 'almacen/cajas/traspaso',
            'order'   => 6,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-truck-fast-outline',
        ]);

        Menu::create([
            'label'   => 'Envio de Cajas',
            'route'   => 'almacen/cajas/envio',
            'order'   => 7,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-truck-delivery-outline',
        ]);

        Menu::create([
            'label'   => 'Validacion de Cajas',
            'route'   => 'almacen/cajas/validacion',
            'order'   => 8,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-check-all',
        ]);

        Menu::create([
            'label'   => 'Ajuste de Cajas',
            'route'   => 'almacen/cajas/ajuste',
            'order'   => 9,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-tools',
        ]);

        Menu::create([
            'label'   => 'Bitacoras de Cajas',
            'route'   => 'almacen/cajas/bitacoras',
            'order'   => 10,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-book-multiple',
        ]);

        // Nivel 1
        $reportesSubMenu = Menu::create([
            'label'   => 'Reportes',
            'order'   => 11,
            'level'   => 1,
            'menu_id' => $cajasMenu->id,
            'icon'    => 'mdi-chart-line',
        ]);

        // Nivel 2
        Menu::create([
            'label'   => 'Devoluciones General',
            'route'   => 'entrega/reportes/devolucion-general',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-file-undo-outline',
        ]);

        Menu::create([
            'label'   => 'Clientes Deudores',
            'route'   => 'entrega/reportes/clientes-deudores',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-account-cash',
        ]);

        Menu::create([
            'label'   => 'Seguimiento por Cliente',
            'route'   => 'entrega/reportes/seguimiento-cliente',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-account-search',
        ]);

        Menu::create([
            'label'   => 'Control de Cajas',
            'route'   => 'almacen/cajas/reportes/control-cajas',
            'order'   => 4,
            'level'   => 2,
            'menu_id' => $reportesSubMenu->id,
            'icon'    => 'mdi-inbox-multiple-outline',
        ]);

        $lotesMenu = Menu::create([
            'label' => 'Lotes',
            'order' => 3,
            'level' => 0,
            'icon'  => 'mdi-server',
        ]);

        // Nivel 1
        Menu::create([
            'label'   => 'Banderas',
            'route'   => 'validacion/bandera',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-flag',
        ]);

        Menu::create([
            'label'   => 'Items',
            'route'   => 'validacion/item',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-cube-outline',
        ]);

        Menu::create([
            'label'   => 'Transformaciones',
            'route'   => 'validacion/transformacion',
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-atom-variant',
        ]);

        Menu::create([
            'label'   => 'Items Cambio Precios',
            'route'   => 'validacion/item-precios-cambio',
            'order'   => 4,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-currency-usd-off',
        ]);

        Menu::create([
            'label'   => 'Composicion Interna',
            'route'   => 'pp/composicion/interna',
            'order'   => 5,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-inbox-multiple',
        ]);

        Menu::create([
            'label'   => 'Composicion externa',
            'route'   => 'pp/composicion/externa',
            'order'   => 6,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-inbox-arrow-up',
        ]);

        Menu::create([
            'label'   => 'Compras de Lotes',
            'route'   => 'almacen/compras',
            'order'   => 7,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-truck',
        ]);

        Menu::create([
            'label'   => 'Compras de Aves',
            'route'   => 'almacen/compras-aves',
            'order'   => 8,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-food-drumstick-outline',
        ]);

        Menu::create([
            'label'   => 'Envios PP y PT',
            'route'   => 'validacion/lista',
            'order'   => 9,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-email-send-outline',
        ]);

        Menu::create([
            'label'   => 'Bitacora Lotes',
            'route'   => 'validacion/bitacora',
            'order'   => 10,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-book-multiple',
        ]);

        Menu::create([
            'label'   => 'Envios Gener. PP',
            'route'   => 'validacion/enviosGenPP',
            'order'   => 11,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-export',
        ]);

        Menu::create([
            'label'   => 'Envios Gener. PT',
            'route'   => 'validacion/enviosGenPT',
            'order'   => 12,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-download',
        ]);

        Menu::create([
            'label'   => 'Envios PP',
            'route'   => 'validacion/enviosPP',
            'order'   => 13,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-send-circle',
        ]);

        Menu::create([
            'label'   => 'Envios PT',
            'route'   => 'validacion/enviosPT',
            'order'   => 14,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-send',
        ]);

        Menu::create([
            'label'   => 'Informe',
            'route'   => 'pp/informes',
            'order'   => 15,
            'level'   => 1,
            'menu_id' => $lotesMenu->id,
            'icon'    => 'mdi-file-chart',
        ]);

        // Nivel 0
        $ppMenu = Menu::create([
            'label' => 'PP',
            'order' => 4,
            'level' => 0,
            'icon'  => 'mdi-share-variant',
        ]);

        //Nivel 1
        Menu::create([
            'label'   => 'Promedio Merma',
            'route'   => 'pp/promedio-merma',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $ppMenu->id,
            'icon'    => 'mdi-chart-bar',
        ]);

        Menu::create([
            'label'   => 'Lotes PP',
            'route'   => 'pp/lotes',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $ppMenu->id,
            'icon'    => 'mdi-folder-multiple-image',
        ]);

        Menu::create([
            'label'   => 'Traspaso PP',
            'route'   => 'pp/traspasoPp',
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $ppMenu->id,
            'icon'    => 'mdi-truck-outline',
        ]);

        // Nivel 0
        $ptMenu = Menu::create([
            'label' => 'PT',
            'order' => 4,
            'level' => 0,
            'icon'  => 'mdi-share-variant',
        ]);

        //Nivel 1
        Menu::create([
            'label'   => 'Lotes PT',
            'route'   => 'pt/lotes',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $ptMenu->id,
            'icon'    => 'mdi-folder-multiple-image',
        ]);

        //Nivel 0
        $transformacionMenu = Menu::create([
            'label' => 'Transfor.',
            'order' => 6,
            'level' => 0,
            'icon'  => 'mdi-stop-circle-outline',
        ]);

        //Nivel 1
        Menu::create([
            'label'   => 'Transformaciones',
            'route'   => 'transformacion/lotes',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $transformacionMenu->id,
            'icon'    => 'mdi-sync-circle-outline',
        ]);

        //Nivel 0
        $subptMenu = Menu::create([
            'label' => 'SubPT',
            'order' => 7,
            'level' => 0,
            'icon'  => 'mdi-stop-circle-outline',
        ]);

        //Nivel 1
        Menu::create([
            'label'   => 'Sub PT',
            'route'   => 'pt/subpt',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $subptMenu->id,
            'icon'    => 'mdi-stop-circle-outline',
        ]);

        //Nivel 0
        $finanzasMenu = Menu::create([
            'label' => 'Finanzas',
            'order' => 8,
            'level' => 0,
            'icon'  => 'mdi-inbox',
        ]);

        //Nivel 1
        Menu::create([
            'label'   => 'Asignacion Cajas',
            'route'   => 'cajas',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $finanzasMenu->id,
            'icon'    => 'mdi-cash-multiple',
        ]);

        Menu::create([
            'label'   => 'Motivos de transaccion',
            'route'   => 'cajas/motivos',
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $finanzasMenu->id,
            'icon'    => 'mdi-list-box-outline',
        ]);

        Menu::create([
            'label'   => 'Monedas',
            'route'   => 'cajas/monedas',
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $finanzasMenu->id,
            'icon'    => 'mdi-currency-usd',
        ]);

        Menu::create([
            'label'   => 'Apertura/Cierre',
            'route'   => 'cajas/apertura-cierre',
            'order'   => 4,
            'level'   => 1,
            'menu_id' => $finanzasMenu->id,
            'icon'    => 'mdi-lock-open-check',
        ]);

        //Nivel 1
        $reportesMenu = Menu::create([
            'label'   => 'Reportes',
            'route'   => null,
            'order'   => 5,
            'level'   => 1,
            'menu_id' => $finanzasMenu->id,
            'icon'    => 'mdi-chart-bar-stacked',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Cobranzas y Gastos',
            'route'   => 'cajas/reportes/cobranza-gastos',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-chart-line',
        ]);

        Menu::create([
            'label'   => 'Cobranzas x Usuario',
            'route'   => 'cajas/reportes/cobranza-usuario',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-account-group',
        ]);

        Menu::create([
            'label'   => 'Cobranzas x Chofer',
            'route'   => 'cajas/reportes/cobranza-chofer',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-account-tie-outline',
        ]);

        Menu::create([
            'label'   => 'Reporte de Arqueos',
            'route'   => 'cajas/arqueos',
            'order'   => 4,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-chart-pie',
        ]);

        //Nivel 0
        $ventasMenu = Menu::create([
            'label' => 'Ventas',
            'order' => 9,
            'level' => 0,
            'icon'  => 'mdi-cart',
        ]);

        //Nivel 1
        $clienteMenu = Menu::create([
            'label'   => 'Cliente',
            'route'   => null,
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-account-group',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Acuerdos',
            'route'   => 'ventas/clientes/acuerdo',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-handshake-outline',
        ]);

        Menu::create([
            'label'   => 'Cajas Cerradas',
            'route'   => 'ventas/clientes/cajacerrada',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-package-variant-closed',
        ]);

        Menu::create([
            'label'   => 'Tipos de cliente',
            'route'   => 'ventas/clientes/tipo',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-account-details',
        ]);

        Menu::create([
            'label'   => 'Grupo de cliente',
            'route'   => 'ventas/clientes/cinta',
            'order'   => 4,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-account-multiple',
        ]);

        Menu::create([
            'label'   => 'Tipo Pp Limpio',
            'route'   => 'ventas/clientes/pollolimpio',
            'order'   => 5,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-food-drumstick-outline',
        ]);

        Menu::create([
            'label'   => 'Tipo Pp',
            'route'   => 'ventas/clientes/tipopp',
            'order'   => 6,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-food',
        ]);

        Menu::create([
            'label'   => 'Zonas despacho',
            'route'   => 'ventas/clientes/zona-despacho',
            'order'   => 7,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-map-marker-radius',
        ]);

        Menu::create([
            'label'   => 'Forma pedido',
            'route'   => 'ventas/clientes/forma-pedido',
            'order'   => 8,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-clipboard-list-outline',
        ]);

        Menu::create([
            'label'   => 'Tipo Negocio',
            'route'   => 'ventas/clientes/tipo-negocio',
            'order'   => 9,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-store',
        ]);

        Menu::create([
            'label'   => 'Clientes',
            'route'   => 'ventas/clientes',
            'order'   => 10,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-account-multiple',
        ]);

        Menu::create([
            'label'   => 'Clientes Inactivos',
            'route'   => 'ventas/clientes/inactivos',
            'order'   => 11,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-account-off',
        ]);

        Menu::create([
            'label'   => 'Clientes Aprobar',
            'route'   => 'ventas/clientes/aprobar',
            'order'   => 12,
            'level'   => 2,
            'menu_id' => $clienteMenu->id,
            'icon'    => 'mdi-check-circle-outline',
        ]);

        //Nivel 1
        $pedidosMenu = Menu::create([
            'label'   => 'Pedidos',
            'route'   => null,
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-receipt',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Pedidos',
            'route'   => 'pedidos',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $pedidosMenu->id,
            'icon'    => 'mdi-receipt',
        ]);

        //Nivel 1
        Menu::create([
            'label'   => 'Estado Compra Choferes',
            'route'   => 'ventas/estado-compra-chofers',
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-truck-fast-outline',
        ]);

        Menu::create([
            'label'   => 'Choferes',
            'route'   => 'ventas/chofers',
            'order'   => 4,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-truck',
        ]);

        Menu::create([
            'label'   => 'Turnos Choferes',
            'route'   => 'ventas/chofers/turnos',
            'order'   => 5,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-calendar-clock',
        ]);

        Menu::create([
            'label'   => 'Mapa de Clientes',
            'route'   => 'ventas/clientes/mapa',
            'order'   => 6,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-map-marker',
        ]);

        Menu::create([
            'label'   => 'Ventas',
            'route'   => 'ventas/ventas',
            'order'   => 7,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-sale',
        ]);

        Menu::create([
            'label'   => 'Ventas 2',
            'route'   => 'ventas/ventas2',
            'order'   => 8,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-sale',
        ]);

        Menu::create([
            'label'   => 'Vender',
            'route'   => 'ventas/ventas3',
            'order'   => 9,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-currency-usd',
        ]);

        Menu::create([
            'label'   => 'POS',
            'route'   => 'ventas/pos',
            'order'   => 10,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-point-of-sale',
        ]);

        //Nivel 1
        $reportesMenu = Menu::create([
            'label'   => 'Reportes',
            'route'   => null,
            'order'   => 11,
            'level'   => 1,
            'menu_id' => $ventasMenu->id,
            'icon'    => 'mdi-file-chart',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Ventas PP',
            'route'   => 'ventas/reportes/pp',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-chart-bar',
        ]);

        Menu::create([
            'label'   => 'Ventas PT',
            'route'   => 'ventas/reportes/pt',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-chart-line',
        ]);

        Menu::create([
            'label'   => 'Ventas General',
            'route'   => 'ventas/lista',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-file-document-outline',
        ]);

        Menu::create([
            'label'   => 'Venta Clientes',
            'route'   => 'ventas/venta-clientes',
            'order'   => 4,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-account-cash',
        ]);

        Menu::create([
            'label'   => 'Ventas Cerrada',
            'route'   => 'ventas/cerrada',
            'order'   => 5,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-lock-outline',
        ]);

        Menu::create([
            'label'   => 'Ventas PP General',
            'route'   => 'ventas/pp',
            'order'   => 6,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-chart-areaspline',
        ]);

        Menu::create([
            'label'   => 'Ventas PT General',
            'route'   => 'ventas/pt',
            'order'   => 7,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-chart-scatter-plot-hexbin',
        ]);

        //Nivel 0
        $entregaMenu = Menu::create([
            'label' => 'Entrega',
            'order' => 10,
            'level' => 0,
            'icon'  => 'mdi-truck-check-outline',
        ]);

        //Nivel 1
        Menu::create([
            'label'   => 'Historial',
            'route'   => 'entrega/historial',
            'order'   => 1,
            'level'   => 1,
            'menu_id' => $entregaMenu->id,
            'icon'    => 'mdi-history',
        ]);

        //Nivel 1
        $reportesMenu = Menu::create([
            'label'   => 'Reportes',
            'route'   => null,
            'order'   => 2,
            'level'   => 1,
            'menu_id' => $entregaMenu->id,
            'icon'    => 'mdi-file-chart-outline',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Devoluciones General',
            'route'   => 'entrega/reportes/devolucion-general',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-refresh-circle',
        ]);

        Menu::create([
            'label'   => 'Clientes Deudores',
            'route'   => 'entrega/reportes/clientes-deudores',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-account-cash-outline',
        ]);

        Menu::create([
            'label'   => 'Seguimiento por Cliente',
            'route'   => 'entrega/reportes/seguimiento-cliente',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $reportesMenu->id,
            'icon'    => 'mdi-map-marker-path',
        ]);

        //Nivel 1
        $reportesCobranzasMenu = Menu::create([
            'label'   => 'Reportes Cobranzas',
            'route'   => null,
            'order'   => 3,
            'level'   => 1,
            'menu_id' => $entregaMenu->id,
            'icon'    => 'mdi-receipt-text-outline',
        ]);

        //Nivel 2
        Menu::create([
            'label'   => 'Ctas. por cobrar x Fechas',
            'route'   => 'entrega/reportes/cuentas-por-cobrar',
            'order'   => 1,
            'level'   => 2,
            'menu_id' => $reportesCobranzasMenu->id,
            'icon'    => 'mdi-calendar-range',
        ]);

        Menu::create([
            'label'   => 'Ctas. por cobrar Hist.',
            'route'   => 'entrega/reportes/cuentas-por-cobrar-historico',
            'order'   => 2,
            'level'   => 2,
            'menu_id' => $reportesCobranzasMenu->id,
            'icon'    => 'mdi-history',
        ]);

        Menu::create([
            'label'   => 'Cobros Individuales',
            'route'   => 'entrega/reportes/cobros-individuales',
            'order'   => 3,
            'level'   => 2,
            'menu_id' => $reportesCobranzasMenu->id,
            'icon'    => 'mdi-account-cash',
        ]);

        Menu::create([
            'label'   => 'Cobros Globales',
            'route'   => 'entrega/reportes/cobros-globales',
            'order'   => 4,
            'level'   => 2,
            'menu_id' => $reportesCobranzasMenu->id,
            'icon'    => 'mdi-finance',
        ]);

        $hiddenRoutes = [
            ['parent_route' => 'admin/configuracion/sucursal', 'route' => 'admin/configuracion/sucursal/*'],
            ['parent_route' => 'admin/personal/persona', 'route' => 'admin/personal/persona/*'],
            ['parent_route' => 'admin/control_acceso/usuario', 'route' => 'admin/control_acceso/usuario/*'],
            ['parent_route' => 'rrhh/contratos', 'route' => 'rrhh/contratos/*'],
            ['parent_route' => 'rrhh/planillas', 'route' => 'rrhh/planillas/*'],
            ['parent_route' => 'rrhh/planillaservicios', 'route' => 'rrhh/planillaservicios/*'],
            ['parent_route' => 'rrhh/finiquito/anual', 'route' => 'rrhh/finiquito/anual/*'],
            ['parent_route' => 'rrhh/finiquito/quinquenio', 'route' => 'rrhh/finiquito/quinquenio/*'],
            ['parent_route' => 'rrhh/finiquito/vacacional', 'route' => 'rrhh/finiquito/vacacional/*'],
            ['parent_route' => 'rrhh/finiquito/aguinaldo', 'route' => 'rrhh/finiquito/aguinaldo/*'],
            ['parent_route' => 'rrhh/liquidacion', 'route' => 'rrhh/liquidacion/*'],
            ['parent_route' => 'rrhh/reportes/planillaservicios', 'route' => 'rrhh/reportes/planillaservicios/*'],
            ['parent_route' => 'rrhh/proveedors', 'route' => 'rrhh/proveedors/*'],
            ['parent_route' => '/rrhh/dotacions/inventario', 'route' => 'rrhh/dotacions/inventario/*'],
            ['parent_route' => '/rrhh/dotacions/inventario/ajustes', 'route' => 'rrhh/dotacions/inventario/ajustes/*'],
            ['parent_route' => '/rrhh/dotacions/inventario/traspasos', 'route' => 'rrhh/dotacions/inventario/traspasos/*'],
            ['parent_route' => '/rrhh/dotacions/salidacliente', 'route' => 'rrhh/dotacions/salidacliente/*'],
            ['parent_route' => '/rrhh/dotacions/salidacontratos', 'route' => 'rrhh/dotacions/salidacontratos/*'],
            ['parent_route' => 'almacen/proveedors', 'route' => 'almacen/proveedors/*'],
            ['parent_route' => 'almacen/proveedors_aves', 'route' => 'almacen/proveedors_aves/*'],
            ['parent_route' => 'almacen/compras', 'route' => 'almacen/compras/*'],
            ['parent_route' => 'almacen/compras-aves', 'route' => 'almacen/compras-aves/*'],
            ['parent_route' => 'almacen/consilodacion/lista', 'route' => 'almacen/consilodacion/add'],
            ['parent_route' => 'almacen/consilodacion/lista-ave', 'route' => 'almacen/consilodacion/add-ave'],
            ['parent_route' => 'almacen/consilodacion/lista-ave-new', 'route' => 'almacen/consilodacion/add-ave-new'],
            ['parent_route' => 'almacen/consilodacion/pagar', 'route' => 'almacen/consilodacion/pagar/*'],
            ['parent_route' => 'almacen/consilodacion/tickets', 'route' => 'almacen/consilodacion/tickets/*'],
            ['parent_route' => 'almacen/consilodacion/pagar-ave', 'route' => 'almacen/consilodacion/pagar-ave/*'],
            ['parent_route' => 'almacen/consilodacion/tickets-ave', 'route' => 'almacen/consilodacion/tickets/add-ave'],
            ['parent_route' => 'almacen/consilodacion/pagar-ave-new', 'route' => 'almacen/consilodacion/pagar-ave-new/*'],
            ['parent_route' => 'almacen/consilodacion/tickets-ave-new', 'route' => 'almacen/consilodacion/tickets/add-ave-new'],
            ['parent_route' => 'almacen/productos', 'route' => 'almacen/productos/*'],
            ['parent_route' => 'almacen/cajas/proveedors', 'route' => 'almacen/cajas/proveedors/*'],
            ['parent_route' => 'almacen/cajas/', 'route' => 'almacen/cajas', 'label' => 'Cajas Base'],
            ['parent_route' => 'almacen/cajas/', 'route' => 'almacen/cajas/*'],
            ['parent_route' => 'almacen/cajas/compras', 'route' => 'almacen/cajas/compras/*'],
            ['parent_route' => 'almacen/cajas/compras/tickets', 'route' => 'almacen/cajas/compras/tickets/*'],
            ['parent_route' => 'almacen/cajas/traspaso', 'route' => 'almacen/cajas/traspaso/*'],
            ['parent_route' => 'almacen/cajas/envio', 'route' => 'almacen/cajas/envio/*'],
            ['parent_route' => 'almacen/cajas/validacion', 'route' => 'almacen/cajas/validacion/*'],
            ['parent_route' => 'almacen/cajas/ajuste', 'route' => 'almacen/cajas/ajuste/*'],
            ['parent_route' => 'validacion/item', 'route' => 'validacion/item/*'],
            ['parent_route' => 'validacion/lista', 'route' => 'validacion/cerradas', 'label' => 'Validaciones Cerradas'],
            ['parent_route' => 'validacion/lista', 'route' => 'validacion/lotes', 'label' => 'Validaciones Lotes'],
            ['parent_route' => 'pp/informes', 'route' => 'pp/informes/*'],
            ['parent_route' => 'pt/lotes', 'route' => 'pt/detalle/*'],
            ['parent_route' => 'transformacion/lotes', 'route' => 'transformacion/detalle/*'],
            ['parent_route' => 'cajas', 'route' => 'cajas/asignacion/*'],
            ['parent_route' => 'cajas/monedas', 'route' => 'cajas/moneda/*'],
            ['parent_route' => 'ventas/clientes', 'route' => 'ventas/clientes/*'],
            ['parent_route' => 'ventas/chofers', 'route' => 'ventas/chofers/*'],
        ];

        foreach ($hiddenRoutes as $definition) {
            $parent = Menu::where('route', $definition['parent_route'])->first();

            if (!$parent || Menu::where('route', $definition['route'])->exists()) {
                continue;
            }

            $label = $definition['label'] ?? trim($parent->label . ' Operaciones');
            $icon = $definition['icon'] ?? $parent->icon;
            $maxOrder = Menu::where('menu_id', $parent->id)->max('order');
            $order = is_null($maxOrder) ? 1 : $maxOrder + 1;

            Menu::create([
                'icon'    => $icon,
                'label'   => $label,
                'order'   => $order,
                'level'   => $definition['level'] ?? $parent->level + 1,
                'route'   => $definition['route'],
                'menu_id' => $parent->id,
                'estado'  => 2,
            ]);
        }

        // Asignar los menús al rol de administrador (rol_id = 1)
        $menus = Menu::all();
        foreach ($menus as $menu) {
            DB::table('menu_roles')->insert([
                'menu_id' => $menu->id,
                'check'   => true,
                'rol_id'  => 1,
            ]);
        }
    }
}
