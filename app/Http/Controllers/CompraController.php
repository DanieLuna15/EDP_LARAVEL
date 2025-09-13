<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Caja;
use App\Models\Lote;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\SubMedida;
use App\Models\CajaCompra;
use App\Models\Inventario;
use InitRed\Tabula\Tabula;
use App\Models\CajaEntrada;
use App\Models\LoteDetalle;
use App\Models\LoteDetalleVenta;
use Illuminate\Http\Request;
use App\Exports\CompraExport;
use App\Models\CajaInventario;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CompraInventario;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Compra::with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra', 'Lote', 'ConsolidacionDetalles'])->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->creacion = $s->created_at->format('Y-m-d ');
            $s->url_sub_pdf = url("reportes/compra-sub/$s->id");
            $s->url_pdf = url("reportes/compras/$s->id");
            $s->url_pdf_2 = url("reportes/compra-originals/$s->id");
            $s->url_excel = url("reportes/compra-excels/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra-categorizadas/$s->id");
            $s->url_ventas_pdf = url("reportes/lotes-seguimiento-cronologico-movimiento-compra/$s->id");
            if ($s->Lote) {
                $s->url_seguimiento_cliente_pdf = url('reportes/lotes-seguimiento-cliente/' . $s->Lote->id);
                $s->url_seguimiento_producto_pdf = url('reportes/lotes-seguimiento-producto/' . $s->Lote->id);
                $s->url_seguimiento_cronologico_pdf = url('reportes/lotes-seguimiento-cronologico-movimiento/' . $s->Lote->id);
            }


            $list[] = $s;
        }
        return $list;
    }
    public function vigentes()
    {
        $model = Compra::with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra', 'Lote', 'ConsolidacionDetalles'])->where('fin', 0)->where('estado', 1)->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->creacion = $s->created_at->format('Y-m-d ');
            $s->url_sub_pdf = url("reportes/compra-sub/$s->id");
            $s->url_pdf = url("reportes/compras/$s->id");
            $s->url_pdf_2 = url("reportes/compra-originals/$s->id");
            $s->url_excel = url("reportes/compra-excels/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra-categorizadas/$s->id");
            $s->url_ventas_pdf = url("reportes/lotes-seguimiento-cronologico-movimiento-compra/$s->id");
            if ($s->Lote) {
                $s->url_seguimiento_cliente_pdf = url('reportes/lotes-seguimiento-cliente/' . $s->Lote->id);
                $s->url_seguimiento_producto_pdf = url('reportes/lotes-seguimiento-producto/' . $s->Lote->id);
                $s->url_seguimiento_cronologico_pdf = url('reportes/lotes-seguimiento-cronologico-movimiento/' . $s->Lote->id);
            }
            $list[] = $s;
        }
        return $list;
    }
    public function anuladas()
    {
        $model = Compra::with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra', 'Lote', 'ConsolidacionDetalles'])->where('fin', 0)->where('estado', 0)->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->creacion = $s->created_at->format('Y-m-d ');
            $s->url_sub_pdf = url("reportes/compra-sub/$s->id");
            $s->url_pdf = url("reportes/compras/$s->id");
            $s->url_pdf_2 = url("reportes/compra-originals/$s->id");
            $s->url_excel = url("reportes/compra-excels/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra-categorizadas/$s->id");
            $s->url_ventas_pdf = url("reportes/lotes-seguimiento-cronologico-movimiento-compra/$s->id");
            if ($s->Lote) {
                $s->url_seguimiento_cliente_pdf = url('reportes/lotes-seguimiento-cliente/' . $s->Lote->id);
                $s->url_seguimiento_producto_pdf = url('reportes/lotes-seguimiento-producto/' . $s->Lote->id);
                $s->url_seguimiento_cronologico_pdf = url('reportes/lotes-seguimiento-cronologico-movimiento/' . $s->Lote->id);
            }
            $list[] = $s;
        }
        return $list;
    }
    public function finalizadas()
    {
        $model = Compra::with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra', 'Lote', 'ConsolidacionDetalles'])->where('fin', 1)->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->creacion = $s->created_at->format('Y-m-d ');
            $s->url_sub_pdf = url("reportes/compra-sub/$s->id");
            $s->url_pdf = url("reportes/compras/$s->id");
            $s->url_pdf_2 = url("reportes/compra-originals/$s->id");
            $s->url_excel = url("reportes/compra-excels/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra-categorizadas/$s->id");
            $s->url_ventas_pdf = url("reportes/lotes-seguimiento-cronologico-movimiento-compra/$s->id");
            if ($s->Lote) {
                $s->url_seguimiento_cliente_pdf = url('reportes/lotes-seguimiento-cliente/' . $s->Lote->id);
                $s->url_seguimiento_producto_pdf = url('reportes/lotes-seguimiento-producto/' . $s->Lote->id);
                $s->url_seguimiento_cronologico_pdf = url('reportes/lotes-seguimiento-cronologico-movimiento/' . $s->Lote->id);
            }
            $list[] = $s;
        }
        return $list;
    }
    public function validar_caja()
    {
        $model = Compra::where('validar', 0)->with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra'])->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->creacion = $s->created_at->format('Y-m-d ');
            $s->url_pdf = url("reportes/compras/$s->id");
            $s->url_pdf_2 = url("reportes/compra-originals/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra-categorizadas/$s->id");
            $s->url_ventas_pdf = url("reportes/lotes-seguimiento-cronologico-movimiento-compra/$s->id");
            $list[] = $s;
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compra = new Compra();
        $compra->nro = $request->nro;
        $compra->nro_compra = $request->nro_compra;
        $compra->obs = $request->obs;
        $compra->fecha = $request->fecha;
        $compra->fecha_salida = $request->fecha_salida;
        $compra->fecha_llegada = $request->fecha_llegada;
        $compra->proveedor_compra_id = $request->proveedor_compra['id'];
        $compra->hora = $request->hora;
        $compra->sucursal_id = $request->sucursal_id;
        $compra->user_id = $request->user_id;
        $compra->chofer = $request->chofer;
        $compra->camion = $request->camion;
        $compra->placa = $request->placa;
        $compra->e_despacho = $request->e_despacho;
        $compra->e_recepcion = $request->e_recepcion;
        $compra->sum_cant_pollos = $request->sum_cant_pollos;
        $compra->sum_cant_envases = $request->sum_cant_envases;
        $compra->sum_peso_bruto = $request->sum_peso_bruto;
        $compra->sum_peso_neto = $request->sum_peso_neto;
        $compra->sum_retraccion = $request->sum_retraccion;
        $compra->almacen_id = $request->almacen_id;
        $compra->save();

        // $cajas = Caja::where('estado',1)->get()->first();
        // $inventario = new CajaInventario();
        // $inventario->cantidad = $request->sum_cant_envases;
        // $inventario->compra = $cajas->compra;
        // $inventario->caja_id = $cajas->id;
        // $inventario->venta = $cajas->venta;
        // $inventario->almacen_id = $request->almacen_id;
        // $inventario->motivo = "COMPRA DE LOTE";
        // $inventario->tipo=1;
        // $inventario->save();

        // $cajaCompra = new CajaCompra();
        // $cajaCompra->caja_id = $cajas->id;
        // $cajaCompra->caja_inventario_id = $inventario->id;
        // $cajaCompra->compra_id = $compra->id;
        // $cajaCompra->save();

        // foreach($request->cajas_almacens as $d){
        //     $inventario2 = new CajaInventario();
        //     $inventario2->caja_id = $d['caja']['id'];
        //     $inventario2->cantidad = 0-$d['cantidad'];
        //     $inventario2->compra = $d['caja']['compra'];
        //     $inventario2->venta = $d['caja']['venta'];
        //     $inventario2->almacen_id = $d['almacen']['id'];
        //     $inventario2->motivo = "COMPRA DE LOTES";
        //     $inventario2->tipo=2;
        //     $inventario2->save();
        // }

        // $lote = new Lote();
        // $lote->compra_id = $compra->id;
        // $lote->user_id = $request->user_id;
        // $lote->precio_venta = 0;
        // $lote->valor_venta = 0;
        // $lote->pollos = $request->sum_cant_pollos;
        // $lote->valor_compra = 0;
        // $lote->cajas = $request->sum_cant_envases;
        // $lote->valor_peso = $request->sum_peso_bruto;
        // $lote->fecha = Carbon::now()->format('Y-m-d');
        // $lote->save();

        $cajaEntrada = new CajaEntrada();
        $cajaEntrada->user_id = $request->user_id;
        $cajaEntrada->almacen_id = $request->almacen_id;
        $cajaEntrada->sucursal_id = $request->sucursal_id;
        $cajaEntrada->cantidad = $request->sum_cant_envases;
        $cajaEntrada->fecha = Carbon::now()->format('Y-m-d');
        $cajaEntrada->hora = Carbon::now()->format('H:i:s');
        $cajaEntrada->tipo = 1;
        $cajaEntrada->save();
        foreach ($request->productos_model as $d) {
            $sub_medida_id = "";
            $medida = "";
            if ($d["tipo"] == 0) {
                $medida = $d["medida_producto"];
                $sub_medida = $medida["sub_medidas"][0];
                $sub_medida_id = $sub_medida["id"];
            }
            $inventario = new Inventario();
            $inventario->producto_id = $d['producto']['id'];
            $inventario->almacen_id = $request->almacen_id;
            $inventario->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida["id"];
            $inventario->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida']['id'] : $sub_medida_id;
            $inventario->cant = $d['producto_model']['cantidad'];
            $inventario->nro = $d['producto_model']['nro'];
            $inventario->motivo = "COMPRA DE LOTE";
            $inventario->save();
            $CompraInventario = new CompraInventario();
            $CompraInventario->inventario_id = $inventario->id;
            $CompraInventario->compra_id = $compra->id;
            $CompraInventario->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida["id"];
            $CompraInventario->categoria_id = $d['categoria']['id'];
            $CompraInventario->name = $d['tipo'] == 1 ? ($d['categoria']['name'] . "-" . $d['sub_medida_2']['name']) : $d['producto']['name'];
            $CompraInventario->name_producto = $d['tipo'] == 1 ? $d['sub_medida_2']['name'] : $d['producto']['name'];
            $CompraInventario->cinta = $d['categoria']['cinta'];
            $CompraInventario->sub_original_id = $d['tipo'] == 1 ? $d['sub_medida_2']['id'] : $sub_medida_id;
            $CompraInventario->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida']['id'] : $sub_medida_id;
            $CompraInventario->cant = $d['producto_model']['cantidad'];
            $CompraInventario->nro = $d['producto_model']['nro'];
            $CompraInventario->valor = $d['producto_model']['peso'];
            $CompraInventario->pigmento = $d['producto_model']['pigmento'];
            $CompraInventario->tipo_pollo = $d['tipo'];
            $CompraInventario->save();
            //LOTE DETALLES
            // $loteDetalle = new LoteDetalle();
            // $loteDetalle->lote_id = $lote->id;
            // $loteDetalle->compra_id = $compra->id;
            // $loteDetalle->cajas = $d['producto_model']['cantidad'];
            // $loteDetalle->tipo_producto = $d['tipo'];
            // $loteDetalle->pollos = $d['tipo'] == 1 ? ($d['producto_model']['nro'] / $d['producto_model']['cantidad']) : 1;
            // $loteDetalle->equivalente = $d['producto_model']['nro'];
            // $loteDetalle->peso_total = $d['producto_model']['peso'];
            // $loteDetalle->name = $d['tipo'] == 1 ? ($d['categoria']['name'] . "-" . $d['sub_medida_2']['name']) : $d['producto']['name'];
            // $loteDetalle->fecha = Carbon::now()->format('Y-m-d');
            // $loteDetalle->hora = Carbon::now()->format('H:i:s');
            // $loteDetalle->user_id = $lote->user_id;
            // $loteDetalle->tipo = "COM";
            // $loteDetalle->nro = "E";
            // $loteDetalle->id_nro = "{$compra->id}";
            // $loteDetalle->detalle = "{$compra->id} COMPRA";
            // $loteDetalle->producto = $d['tipo'] == 1 ? $d['sub_medida_2']['name'] : $d['producto']['name'];
            // $loteDetalle->pigmento = $d['producto_model']['pigmento'];
            // $loteDetalle->categoria_id = $d['categoria']['id'];
            // $loteDetalle->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida["id"];
            // $loteDetalle->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida_2']['id'] : $sub_medida_id;
            // $loteDetalle->compra_inventario_id = $CompraInventario->id;
            // $loteDetalle->save();
        }

        $compraAgrupada = $this->lote($compra);

        $lote = new Lote();
        $lote->compra_id = $compra->id;
        $lote->user_id = $compra->user_id;
        $lote->precio_venta = 0; // O valor según lógica
        $lote->valor_venta = 0;  // O valor según lógica
        $lote->pollos = $compra->sum_cant_pollos;
        $lote->valor_compra = 0;
        $lote->cajas = $compra->sum_cant_envases;
        $lote->valor_peso = $compra->sum_peso_bruto;
        $lote->fecha = Carbon::now()->format('Y-m-d');
        $lote->save();
        foreach ($compraAgrupada->detalles as $l) {
            $loteDetalle = new LoteDetalle();
            $loteDetalle->lote_id = $lote->id;
            $loteDetalle->compra_id = $compra->id;
            $loteDetalle->cajas = $l['cajas'];
            $loteDetalle->pollos = $l['cajas'] > 0 ? $l['pollos'] / $l['cajas'] : 0;
            $loteDetalle->equivalente = $l['pollos'];
            $loteDetalle->peso_total = $l['valor'];
            $loteDetalle->name = $l['name'];
            $loteDetalle->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalle->hora = Carbon::now()->format('H:i:s');
            $loteDetalle->user_id = $lote->user_id;
            $loteDetalle->tipo = "COM";
            $loteDetalle->nro = "E";
            $loteDetalle->id_nro = "{$compra->id}";
            $loteDetalle->detalle = "{$compra->id} COMPRA";
            $loteDetalle->producto = $l['producto_name'];
            $loteDetalle->pigmento = $l['pigmento'];
            $loteDetalle->categoria_id = $l['categoria']['id'];
            $loteDetalle->medida_producto_id = $l['medida_producto']['id'];
            $loteDetalle->sub_medida_id = $l['sub_medida']['id'];
            $loteDetalle->save();
        }

        $compra->url_pdf = url("reportes/compras/$compra->id");
        $compra->url_pdf_2 = url("reportes/compra-originals/$compra->id");
        return $compra;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        $compra->sucursal = $compra->Sucursal;
        $compra->sucursal->file_sucursals = $compra->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $compra->sucursal->image = $compra->sucursal->file_sucursals->first();
        $compra->user = $compra->User;
        $detalles = $compra->CompraInventarios()->where('cinta', 1)->get()->groupBy('sub_original_id');
        $detalles_pigmento = $compra->CompraInventarios()->where([['cinta', 1], ['pigmento', 1]])->get()->groupBy('sub_medida_id');
        $detalles_sin_pigmento = $compra->CompraInventarios()->where([['cinta', 1], ['pigmento', 2]])->get()->groupBy('sub_medida_id');
        $detalles_general = $compra->CompraInventarios()->get();
        $detalles_2 = $compra->CompraInventarios()->where('cinta', 1)->get()->groupBy('sub_original_id');
        $detalles_sin_cinta_pigmento = $compra->CompraInventarios()->where([['cinta', 2], ['pigmento', 1]])->get()->groupBy('categoria_id');
        $detalles_sin_cinta_sin_pigmento = $compra->CompraInventarios()->where([['cinta', 2], ['pigmento', 2]])->get()->groupBy('categoria_id');
        $detalles_sin_cinta = $compra->CompraInventarios()->where('cinta', 2)->get()->groupBy('categoria_id');
        //compra original
        $detalles_pigmento_cinta = $compra->CompraInventarios()->where([['cinta', 1], ['pigmento', 1]])->get()->groupBy('sub_original_id');
        $detalles_sin_pigmento_cinta = $compra->CompraInventarios()->where([['cinta', 1], ['pigmento', 2]])->get()->groupBy('sub_original_id');
        $detalles_pigmento_sin_cinta = $compra->CompraInventarios()->where([['cinta', 2], ['pigmento', 1]])->get()->groupBy('sub_medida_id');
        $detalles_sin_pigmento_sin_cinta = $compra->CompraInventarios()->where([['cinta', 2], ['pigmento', 2]])->get()->groupBy('sub_medida_id');
        $list = [];
        $list_cinta = [];
        $list_pigmento = [];
        $list_sin_pigmento = [];
        $list_2 = [];
        $list_sin_cinta = [];
        $list_pigmento_cinta = [];
        $list_sin_pigmento_cinta = [];
        $list_pigmento_sin_cinta = [];
        $list_sin_pigmento_sin_cinta = [];
        $list_sin_cinta_pigmento = [];
        $list_sin_cinta_sin_pigmento = [];


        $producto = Producto::with('MedidaProductos.SubMedidas')->find(1);
        $orden_cintas = [];
        if ($producto && $producto->medidaProductos && count($producto->medidaProductos)) {
            $sub_medidas = $producto->medidaProductos[0]->subMedidas ?? [];
            foreach ($sub_medidas as $s) {
                $orden_cintas[$s->name] = $s->nro_orden;
            }
        }

        foreach ($detalles as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;
            $sub_original = $sub->first()->subOriginal;
            $nombre = $sub_medida->name ?? '';
            $nro_orden = isset($orden_cintas[$nombre]) ? $orden_cintas[$nombre] : 9999;

            // // $list_sin_cinta[] =  ["categoria"=>$categoria,"sub_medida"=>$sub_medida,"list"=>$sub];
            $list_cinta[] =  [
                "name" => $sub_medida->name,
                "nro_orden" => $nro_orden,
                "pigmento" => "CON PIGMENTO",
                "sub_medida" => $sub_medida,
                "sub_original" => $sub_original,
                "categoria" => $categoria,
                "list" => $sub
            ];
        }

        usort($list_cinta, function ($a, $b) {
            return $a['nro_orden'] <=> $b['nro_orden'];
        });



        foreach ($detalles_pigmento_sin_cinta as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;


            // // $list_sin_cinta[] =  ["categoria"=>$categoria,"sub_medida"=>$sub_medida,"list"=>$sub];
            $list_pigmento_sin_cinta[] =  [
                "name" => $sub_medida->name,
                "pigmento" => "SUB PIGMENTO",
                "sub_medida" => $sub_medida,
                "categoria" => $categoria,
                "list" => $sub
            ];
        }



        foreach ($detalles_sin_pigmento_sin_cinta as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;


            // // $list_sin_cinta[] =  ["categoria"=>$categoria,"sub_medida"=>$sub_medida,"list"=>$sub];
            $list_sin_pigmento_sin_cinta[] =  ["sub_medida" => $sub_medida, "categoria" => $categoria, "list" => $sub];
        }

        foreach ($detalles_pigmento_cinta as $d) {
            $sub = $d;
            $subOriginal = $sub->first()->subOriginal;


            $list_pigmento_cinta[] =  ["sub_original" => $subOriginal, "list" => $sub];
        }
        foreach ($detalles_sin_pigmento_cinta as $d) {
            $sub = $d;
            $subOriginal = $sub->first()->subOriginal;


            $list_sin_pigmento_cinta[] =  [

                "sub_original" => $subOriginal,
                "list" => $sub
            ];
        }

        foreach ($detalles as $d) {
            $sub = $d;
            $subOriginal = $sub->first()->subOriginal;


            $list_2[] =  ["sub_original" => $subOriginal, "list" => $sub];
        }
        foreach ($detalles as $d) {
            $sub = $d;
            $submedida = $sub->first()->subMedida;


            $list[] =  ["sub_medida" => $submedida, "list" => $sub];
        }
        foreach ($detalles_pigmento as $d) {
            $sub = $d;
            $submedida = $sub->first()->subMedida;


            $list_pigmento[] =  [
                "cinta" => "CON CINTA",
                "name" => $submedida->name,
                "pigmento" => "CON PIGMENTO",
                "sub_medida" => $submedida,
                "list" => $sub
            ];
        }
        foreach ($detalles_sin_pigmento as $d) {
            $sub = $d;
            $submedida = $sub->first()->subMedida;


            $list_sin_pigmento[] =  [
                "cinta" => "CON CINTA",
                "name" => $submedida->name,
                "pigmento" => "SIN PIGMENTO",
                "sub_medida" => $submedida,
                "list" => $sub
            ];
        }
        foreach ($detalles_sin_cinta as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;


            // // $list_sin_cinta[] =  ["categoria"=>$categoria,"sub_medida"=>$sub_medida,"list"=>$sub];
            $list_sin_cinta[] =  [

                "sub_medida" => $sub_medida,
                "categoria" => $categoria,
                "list" => $sub
            ];
        }
        foreach ($detalles_sin_cinta_pigmento as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;


            // // $list_sin_cinta[] =  ["categoria"=>$categoria,"sub_medida"=>$sub_medida,"list"=>$sub];
            $list_sin_cinta_pigmento[] =  [
                "cinta" => "SIN CINTA",
                "name" => $categoria->name,
                "pigmento" => "CON PIGMENTO",
                "sub_medida" => $sub_medida,
                "categoria" => $categoria,
                "list" => $sub
            ];
        }
        foreach ($detalles_sin_cinta_sin_pigmento as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;


            // // $list_sin_cinta[] =  ["categoria"=>$categoria,"sub_medida"=>$sub_medida,"list"=>$sub];
            $list_sin_cinta_sin_pigmento[] =  [
                "name" => $categoria->name,
                "cinta" => "SIN CINTA",
                "pigmento" => "SIN PIGMENTO",
                "sub_medida" => $sub_medida,
                "categoria" => $categoria,
                "list" => $sub
            ];
        }
        $categorias = $compra->CompraInventarios()->get()->groupBy('categoria_id');
        $category_List = [];
        $categoria_id = $compra->ProveedorCompra->categoria_id;
        foreach ($categorias as $d) {
            $list = $d;

            $sub = $list;

            $categoria = $sub->first()->categoria;
            $submedida = $sub->first()->subMedida;



            $suma_total = $sub->sum('valor');
            $suma_pollos = $sub->where('tipo_pollo', 1)->sum('nro');
            $taras = $sub->sum('cant');

            //quitar comas y dejar 2 decimales

            $category_List[] =  [

                "categoria" => $categoria,
                "submedida" => $submedida,
                "sumaTotal" => $suma_total,
                "sumaPollos" => $suma_pollos,
                "taras" => $taras,
                "criterio" => 0,
                "precio" => 0,
                "nuevoajuste" => 0,
            ];
            // }


        }

        usort($list_cinta, function ($a, $b) {
            return $a['nro_orden'] <=> $b['nro_orden'];
        });

        usort($list_pigmento_cinta, function ($a, $b) {
            return ($a['sub_original']->nro_orden ?? 9999) <=> ($b['sub_original']->nro_orden ?? 9999);
        });
        usort($list_sin_pigmento_cinta, function ($a, $b) {
            return ($a['sub_original']->nro_orden ?? 9999) <=> ($b['sub_original']->nro_orden ?? 9999);
        });
        usort($list_pigmento_sin_cinta, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        usort($list_sin_pigmento_sin_cinta, function ($a, $b) {
            return strcmp($a['sub_medida']->name ?? '', $b['sub_medida']->name ?? '');
        });

        $compra->category_list = $category_List;
        $compra->detalles = $list;
        $compra->detalles_cinta = $list_cinta;
        $compra->detalles_pigmento = $list_pigmento;
        $compra->detalles_sin_pigmento = $list_sin_pigmento;
        $compra->detalles_general = $detalles_general;
        $compra->detalles_original = $list_2;
        $compra->detalles_sin_cita_pigmento = $list_sin_cinta_pigmento;
        $compra->detalles_sin_cita_sin_pigmento = $list_sin_cinta_sin_pigmento;
        $compra->detalles_sin_cita = $list_sin_cinta;
        $compra->detalles_pigmento_cinta = $list_pigmento_cinta;
        $compra->detalles_sin_pigmento_cinta = $list_sin_pigmento_cinta;
        $compra->detalles_pigmento_sin_cinta = $list_pigmento_sin_cinta;
        $compra->detalles_sin_pigmento_sin_cinta = $list_sin_pigmento_sin_cinta;
        $detalle_collect = collect($list_pigmento);
        $detalle_collect = $detalle_collect->concat($list_sin_pigmento);
        $detalle_collect = $detalle_collect->concat($list_sin_cinta_sin_pigmento);
        $detalle_collect = $detalle_collect->concat($list_sin_cinta_pigmento);
        $compra->lista_detalles = $detalle_collect->sortBy(function ($item) use ($orden_cintas) {
            if (isset($item['sub_medida']) && $item['sub_medida']) {
                $name = $item['sub_medida']->name ?? null;
                return $orden_cintas[$name] ?? 9999;
            }
            if (isset($item['name'])) {
                return $orden_cintas[$item['name']] ?? 9999;
            }
            return 9999;
        })->values();

        $compra->compra_inventarios = $compra->CompraInventariosWithout()->get();
        $compra->caja_compras = $compra->CajaCompras()->get();
        $lote_detalle_compras = $compra->LoteDetalleCompras()->get()->groupBy('lote_detalle_id');
        $lotedetallecompra = [];
        foreach ($lote_detalle_compras as $lote_detalle_compra) {
            $l = $lote_detalle_compra;
            $lote_detalle = $l->first()->LoteDetalle;

            $lotedetallecompra[] = [
                "lote_detalle" => $lote_detalle,
                "faltante" => $l->sum('peso_bruto'),

            ];
        }
        $compra->lote_detalle_compras = $lotedetallecompra;
        // CATEGORIAS POR PROVEEEDOR
        $categoria_proveedor_list = [];
        foreach ($compra->category_list as $d) {
            //buscar si la categoria esta en el proveedor
            $buscar = $compra->ProveedorCompra->ProveedorCategorias()->where('categoria_id', $d['categoria']->id)->get();
            //si la categoria esta en el proveedor
            if ($buscar->count() > 0) {
                $sumaPollosCategoria = 0;
                $sumaValorCategoria = 0;
                $sumaValorNetoCategoria = 0;
                $sumaValorTaraCategoria = 0;
                $category = $buscar->first();
                // foreach ($compra->CompraInventarios()->where([["categoria_id",$category->categoria_id]])->get() as $i) {
                //recorrer los inventarios de la compra
                foreach ($compra->CompraInventarios()->get() as $i) {
                    //buscar si la sub medida esta en el proveedor
                    $buscar_sub = $category->ProveedorCategoriaDetalles()->where('sub_medida_id', $i->sub_medida_id)->get();
                    //si la sub medida esta en el proveedor y la categoria es la misma
                    $pollos = $i->tipo_pollo == 1 ? $i->nro : 0;
                    if ($buscar_sub->count() > 0 && $i->cinta == 1) {
                        $sumaPollosCategoria += $pollos;
                        $sumaValorCategoria += $i->valor;
                        $sumaValorNetoCategoria += $i->valor - ($i->cant * 2);
                        $sumaValorTaraCategoria += ($i->cant * 2);
                    }
                    if ($i->cinta == 2 && $i->categoria_id == $category->categoria_id) {
                        $sumaPollosCategoria += $pollos;
                        $sumaValorCategoria += $i->valor;
                        $sumaValorNetoCategoria += $i->valor - ($i->cant * 2);
                        $sumaValorTaraCategoria += ($i->cant * 2);
                    }
                }
                $d['sumaPollos'] = number_format($sumaPollosCategoria, 2);
                // $d['sumaTotal'] = number_format($sumaValorCategoria,2);
                $d['sumaTotal'] = number_format($sumaValorNetoCategoria, 2);
                $d['peso_bruto'] = number_format($sumaValorCategoria, 2);
                $d['peso_neto'] = number_format($sumaValorNetoCategoria, 2);
                $d['total_tara'] = number_format($sumaValorTaraCategoria, 2);
                $categoria_proveedor_list[] = $d;
            }
        }
        $compra->categoria_proveedor_list = $categoria_proveedor_list;
        return $compra;
    }


    public function lote(Compra $compra)
    {
        $compra->sucursal = $compra->Sucursal;
        $compra->sucursal->file_sucursals = $compra->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $compra->sucursal->image = $compra->sucursal->file_sucursals->first();
        $compra->user = $compra->User;
        $detalles_pigmento = $compra->CompraInventarios()->where([['cinta', 1], ['pigmento', 1]])->get()->groupBy('sub_original_id');
        $detalles_sin_pigmento = $compra->CompraInventarios()->where([['cinta', 1], ['pigmento', 2]])->get()->groupBy('sub_original_id');

        $detalles_second_pigmento = $compra->CompraInventarios()->where([['cinta', 2], ['pigmento', 1]])->get()->groupBy('sub_original_id');
        $detalles_second_sin_pigmento = $compra->CompraInventarios()->where([['cinta', 2], ['pigmento', 2]])->get()->groupBy('sub_original_id');
        $list = [];

        foreach ($detalles_pigmento as $d) {
            $sub = $d;
            // $submedida = $sub->first()->subMedida;
            $submedida = $sub->first()->subOriginal;

            $categoria = $sub->first()->categoria;
            $medida_producto = $sub->first()->medidaProducto;
            $pollos = $sub->where('tipo_pollo', 1)->sum('nro');
            $cajas = $sub->sum('cant');
            $valor = $sub->sum('valor');
            $taras = $cajas * 2;
            $name =  $submedida->name . " - " . $categoria->name;
            $producto_name = $submedida->name;
            $list[] =  [
                "name" => $name,
                "producto_name" => $producto_name,
                "pigmento" => 1,
                "sub_medida" => $submedida,
                "list" => $sub,
                "categoria" => $categoria,
                "pollos" => $pollos,
                "cajas" => $cajas,
                "valor" => $valor,
                "taras" => $taras,
                "medida_producto" => $medida_producto,
            ];
        }

        foreach ($detalles_sin_pigmento as $d) {
            $sub = $d;
            // $submedida = $sub->first()->subMedida;
            $submedida = $sub->first()->subOriginal;
            $categoria = $sub->first()->categoria;
            $medida_producto = $sub->first()->medidaProducto;
            // $pollos = $sub->sum('nro');
            $pollos = $sub->where('tipo_pollo', 1)->sum('nro');
            $cajas = $sub->sum('cant');
            $valor = $sub->sum('valor');
            $taras = $cajas * 2;
            $name =  $submedida->name . " - " . $categoria->name;
            $producto_name = $submedida->name;
            $list[] =  [

                "name" => $name,
                "producto_name" => $producto_name,
                "pigmento" => 2,
                "sub_medida" => $submedida,
                "list" => $sub,
                "categoria" => $categoria,
                "pollos" => $pollos,
                "cajas" => $cajas,
                "valor" => $valor,
                "taras" => $taras,
                "medida_producto" => $medida_producto,
            ];
        }
        foreach ($detalles_second_pigmento as $d) {
            $sub = $d;
            // $submedida = $sub->first()->subMedida;
            $submedida = $sub->first()->subOriginal;
            $categoria = $sub->first()->categoria;
            $medida_producto = $sub->first()->medidaProducto;
            $name =  $submedida->name . " - " . $categoria->name;
            // $pollos = $sub->sum('nro');
            $pollos = $sub->where('tipo_pollo', 1)->sum('nro');
            $cajas = $sub->sum('cant');
            $valor = $sub->sum('valor');
            $taras = $cajas * 2;
            $name =  $submedida->name . " - " . $categoria->name;
            $producto_name = $categoria->name;
            $list[] =  [
                "name" => $name,
                "pigmento" => 1,
                "producto_name" => $producto_name,
                "sub_medida" => $submedida,
                "list" => $sub,
                "categoria" => $categoria,
                "pollos" => $pollos,
                "cajas" => $cajas,
                "valor" => $valor,
                "taras" => $taras,
                "medida_producto" => $medida_producto,
            ];
        }

        foreach ($detalles_second_sin_pigmento as $d) {
            $sub = $d;
            // $submedida = $sub->first()->subMedida;
            $submedida = $sub->first()->subOriginal;
            $categoria = $sub->first()->categoria;
            $medida_producto = $sub->first()->medidaProducto;
            $name =  $submedida->name . " - " . $categoria->name;
            // $pollos = $sub->sum('nro');
            $pollos = $sub->where('tipo_pollo', 1)->sum('nro');
            $cajas = $sub->sum('cant');
            $valor = $sub->sum('valor');
            $taras = $cajas * 2;
            $name =  $submedida->name . " - " . $categoria->name;
            $producto_name = $categoria->name;
            $list[] =  [
                "name" => $name,
                "pigmento" => 2,
                "producto_name" => $producto_name,
                "sub_medida" => $submedida,
                "list" => $sub,
                "categoria" => $categoria,
                "pollos" => $pollos,
                "cajas" => $cajas,
                "valor" => $valor,
                "taras" => $taras,
                "medida_producto" => $medida_producto,
            ];
        }


        $compra->detalles = $list;


        $compra->compra_inventarios = $compra->CompraInventariosWithout()->get();
        $compra->caja_compras = $compra->CajaCompras()->get();
        return $compra;
    }

    public function showCategorizada(Compra $compra)
    {
        $compra->sucursal = $compra->Sucursal;
        $compra->sucursal->file_sucursals = $compra->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $compra->sucursal->image = $compra->sucursal->file_sucursals->first();
        $compra->user = $compra->User;
        $detalles = $compra->CompraInventarios()->where('cinta', 1)->get()->groupBy('sub_medida_id');
        $detalles_general = $compra->CompraInventarios()->get();
        $detalles_2 = $compra->CompraInventarios()->where('cinta', 1)->get()->groupBy('sub_original_id');
        $detalles_sin_cinta = $compra->CompraInventarios()->where('cinta', 2)->get()->groupBy('categoria_id');
        $list = [];
        $list_2 = [];
        $list_sin_cinta = [];
        $list = [];

        foreach ($detalles as $d) {
            $sub = $d;
            $submedida = $sub->first()->subMedida;
            $nro_orden = $submedida->nro_orden ?? 9999;

            $list[] = [
                "sub_medida" => $submedida,
                "nro_orden" => $nro_orden,
                "list" => $sub
            ];
        }

        // Ordenar por nro_orden
        usort($list, function ($a, $b) {
            return $a['nro_orden'] <=> $b['nro_orden'];
        });


        foreach ($detalles_sin_cinta as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;
            $nro_orden = $sub_medida->nro_orden ?? 9999;

            $list_sin_cinta[] = [
                "sub_medida" => $sub_medida,
                "categoria" => $categoria,
                "nro_orden" => $nro_orden,
                "list" => $sub
            ];
        }
        usort($list_sin_cinta, function ($a, $b) {
            return $a['nro_orden'] <=> $b['nro_orden'];
        });


        $categorias = $compra->CompraInventarios()->get()->groupBy('categoria_id');
        $category_List = [];
        foreach ($categorias as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $submedida = $sub->first()->subMedida;


            $category_List[] =  [
                "categoria" => $categoria,
                "submedida" => $submedida,
                "sumaTotal" => $sub->sum('valor'),
                "sumaPollos" => $sub->sum('nro'),
                "taras" => $sub->sum('cant'),
                "criterio" => 0,
                "precio" => 0,
                "nuevoajuste" => 0,
            ];
        }
        $compra->category_list = $category_List;
        $compra->detalles = $list;
        $compra->detalles_general = $detalles_general;
        $compra->detalles_original = $list_2;
        $compra->detalles_sin_cita = $list_sin_cinta;
        $compra->compra_inventarios = $compra->CompraInventariosWithout()->get();
        $compra->caja_compras = $compra->CajaCompras()->get();
        return $compra;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Compra $compra)
    // {
    //     //dd($request->sum_cant_envases);
    //     $compra->nro = $request->nro;
    //     $compra->fecha = $request->fecha;
    //     $compra->fecha_salida = $request->fecha_salida;
    //     $compra->fecha_llegada = $request->fecha_llegada;
    //     $compra->proveedor_compra_id = $request->proveedor_compra_id;
    //     $compra->hora = $request->hora;
    //     $compra->sucursal_id = 1;
    //     $compra->user_id = 1;
    //     $compra->chofer = $request->chofer;
    //     $compra->camion = $request->camion;
    //     $compra->placa = $request->placa;
    //     $compra->e_despacho = $request->e_despacho;
    //     $compra->e_recepcion = $request->e_recepcion;
    //     $compra->sum_cant_pollos = $request->sum_cant_pollos;
    //     $compra->sum_cant_envases = $request->sum_cant_envases;
    //     $compra->sum_peso_bruto = $request->sum_peso_bruto;
    //     $compra->sum_peso_neto = $request->sum_peso_neto;
    //     $compra->sum_retraccion = $request->sum_retraccion;
    //     $compra->save();

    //     $lote = $compra->Lote;
    //     $lote->pollos = $request->sum_cant_pollos;
    //     $lote->cajas = $request->sum_cant_envases;
    //     $lote->valor_peso = $request->sum_peso_bruto;
    //     $lote->save();
    //     foreach ($request->compra_inventarios as $d) {

    //         $subMedida = SubMedida::find($d['sub_original_id']);
    //         $CompraInventario = CompraInventario::find($d['id']);

    //         $CompraInventario->medida_producto_id = $d['medida_producto']['id'];
    //         $CompraInventario->categoria_id = $d['categoria']['id'];
    //         $CompraInventario->sub_medida_id = $d['sub_medida_id'];
    //         if ($CompraInventario->sub_original_id != $d['sub_original_id']) {
    //             $CompraInventario->editado = 1;
    //         }
    //         $CompraInventario->name = $d['categoria']['name'] . "-" . $d['sub_original']['name'];
    //         $CompraInventario->name_producto = $d['sub_original']['name'];
    //         $CompraInventario->sub_original_id = $d['sub_original_id'];
    //         $CompraInventario->cant = $d['cant'];
    //         $CompraInventario->nro = $d['nro'];
    //         $CompraInventario->valor = $d['valor'];
    //         $CompraInventario->estado = $d['estado'];
    //         $CompraInventario->pigmento = $d['pigmento'];
    //         $CompraInventario->tipo_pollo = $d['tipo_pollo'];
    //         $CompraInventario->save();

    //         $loteDetalle = LoteDetalle::where('compra_inventario_id', $CompraInventario->id)->get()->first();
    //         $loteDetalle->cajas = $d['cant'];
    //         $loteDetalle->pollos = $d['nro'] / $d['cant'];
    //         $loteDetalle->equivalente = $d['nro'];
    //         $loteDetalle->peso_total = $d['valor'];
    //         $loteDetalle->name = $d['categoria']['name'] . "-" . $subMedida->name;
    //         $loteDetalle->producto = $subMedida->name;
    //         $loteDetalle->pigmento = $d['pigmento'];
    //         $loteDetalle->categoria_id = $d['categoria']['id'];
    //         $loteDetalle->medida_producto_id = $d['medida_producto']['id'];
    //         $loteDetalle->sub_medida_id = $d['sub_medida_id'];
    //         $loteDetalle->save();
    //     }
    //     foreach ($request->productos_model as $d) {
    //         $sub_medida_id = "";
    //         $medida = "";
    //         if ($d["tipo"] == 0) {
    //             $medida = $d["medida_producto"];
    //             $sub_medida = $medida["sub_medidas"][0];
    //             $sub_medida_id = $sub_medida["id"];
    //         }
    //         $inventario = new Inventario();
    //         $inventario->producto_id = $d['producto']['id'];
    //         $inventario->almacen_id = $request->almacen_id;
    //         $inventario->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida['id'];
    //         $inventario->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida']['id'] : $sub_medida_id;
    //         $inventario->cant = $d['producto_model']['cantidad'];
    //         $inventario->nro = $d['producto_model']['nro'];
    //         $inventario->motivo = "COMPRA DE LOTE";
    //         $inventario->save();

    //         $CompraInventario = new CompraInventario();
    //         $CompraInventario->inventario_id = $inventario->id;

    //         $CompraInventario->compra_id = $compra->id;
    //         $CompraInventario->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida['id'];
    //         $CompraInventario->categoria_id = $d['categoria']['id'];
    //         $CompraInventario->cinta = $d['categoria']['cinta'];
    //         $CompraInventario->sub_original_id = $d['tipo'] == 1 ? $d['sub_medida_2']['id'] : $sub_medida_id;
    //         $CompraInventario->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida']['id'] : $sub_medida_id;
    //         $CompraInventario->cant = $d['producto_model']['cantidad'];
    //         $CompraInventario->nro = $d['producto_model']['nro'];
    //         $CompraInventario->valor = $d['producto_model']['peso'];
    //         $CompraInventario->pigmento = $d['producto_model']['pigmento'];
    //         $CompraInventario->tipo_pollo = $d['producto_model']['tipo_pollo'];
    //         $CompraInventario->name = $d['tipo'] == 1 ? ($d['categoria']['name'] . "-" . $d['sub_medida_2']['name']) : $d['producto']['name'];
    //         $CompraInventario->name_producto = $d['tipo'] == 1 ? $d['sub_medida_2']['name'] : $d['producto']['name'];
    //         $CompraInventario->save();

    //         $loteDetalle = new LoteDetalle();
    //         $loteDetalle->lote_id = $lote->id;
    //         $loteDetalle->compra_id = $compra->id;
    //         $loteDetalle->cajas = $d['producto_model']['cantidad'];
    //         $loteDetalle->pollos = $d['tipo'] == 1 ? ($d['producto_model']['nro'] / $d['producto_model']['cantidad']) : 1;
    //         $loteDetalle->equivalente = $d['producto_model']['nro'];
    //         $loteDetalle->peso_total = $d['producto_model']['peso'];
    //         $loteDetalle->name = $d['tipo'] == 1 ? ($d['categoria']['name'] . "-" . $d['sub_medida_2']['name']) : $d['producto']['name'];
    //         $loteDetalle->fecha = Carbon::now()->format('Y-m-d');
    //         $loteDetalle->hora = Carbon::now()->format('H:i:s');
    //         $loteDetalle->user_id = $lote->user_id;
    //         $loteDetalle->tipo = "COM";
    //         $loteDetalle->nro = "E";
    //         $loteDetalle->id_nro = "{$compra->id}";
    //         $loteDetalle->detalle = "{$compra->id} COMPRA";
    //         $loteDetalle->producto = $d['tipo'] == 1 ? $d['sub_medida_2']['name'] : $d['producto']['name'];
    //         $loteDetalle->pigmento = $d['producto_model']['pigmento'];
    //         $loteDetalle->categoria_id = $d['categoria']['id'];
    //         $loteDetalle->medida_producto_id =  $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida["id"];
    //         $loteDetalle->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida_2']['id'] : $sub_medida_id;
    //         $loteDetalle->compra_inventario_id = $CompraInventario->id;
    //         $loteDetalle->save();
    //     }
    //     $compra->url_pdf = url("reportes/compras/$compra->id");
    //     $compra->url_pdf_2 = url("reportes/compra-originals/$compra->id");
    //     return $compra;
    // }


    public function update(Request $request, Compra $compra)
    {
        $compra->nro = $request->nro;
        $compra->obs = $request->obs;
        $compra->fecha = $request->fecha;
        $compra->fecha_salida = $request->fecha_salida;
        $compra->fecha_llegada = $request->fecha_llegada;
        $compra->proveedor_compra_id = $request->proveedor_compra_id;
        $compra->hora = $request->hora;
        $compra->sucursal_id = 1;
        $compra->user_id = 1;
        $compra->chofer = $request->chofer;
        $compra->camion = $request->camion;
        $compra->placa = $request->placa;
        $compra->e_despacho = $request->e_despacho;
        $compra->e_recepcion = $request->e_recepcion;
        $compra->sum_cant_pollos = $request->sum_cant_pollos;
        $compra->sum_cant_envases = $request->sum_cant_envases;
        $compra->sum_peso_bruto = $request->sum_peso_bruto;
        $compra->sum_peso_neto = $request->sum_peso_neto;
        $compra->sum_retraccion = $request->sum_retraccion;
        $compra->save();

        $lote = $compra->Lote;

        foreach ($request->compra_inventarios as $index => $d) {
            $subMedida = SubMedida::find($d['sub_original_id']);
            $CompraInventario = CompraInventario::find($d['id']);

            if ($CompraInventario) {
                $CompraInventario->medida_producto_id = $d['medida_producto']['id'];
                $CompraInventario->categoria_id = $d['categoria']['id'];
                $CompraInventario->sub_medida_id = $d['sub_medida_id'];
                if ($CompraInventario->sub_original_id != $d['sub_original_id']) {
                    $CompraInventario->editado = 1;
                }
                $CompraInventario->name = $d['categoria']['name'] . "-" . $d['sub_original']['name'];
                $CompraInventario->name_producto = $d['sub_original']['name'];
                $CompraInventario->sub_original_id = $d['sub_original_id'];
                $CompraInventario->cant = $d['cant'];
                $CompraInventario->nro = $d['nro'];
                $CompraInventario->valor = $d['valor'];
                $CompraInventario->estado = $d['estado'];
                $CompraInventario->pigmento = $d['pigmento'];
                $CompraInventario->tipo_pollo = $d['tipo_pollo'];
                $CompraInventario->save();
            }

            $loteDetalle = LoteDetalle::where('compra_inventario_id', $CompraInventario->id)->first();
            if ($loteDetalle) {
                $loteDetalle->cajas = $d['cant'];
                $loteDetalle->pollos = $d['nro'] / $d['cant'];
                $loteDetalle->equivalente = $d['nro'];
                $loteDetalle->peso_total = $d['valor'];
                $loteDetalle->name = $d['categoria']['name'] . "-" . $subMedida->name;
                $loteDetalle->producto = $subMedida->name;
                $loteDetalle->pigmento = $d['pigmento'];
                $loteDetalle->categoria_id = $d['categoria']['id'];
                $loteDetalle->medida_producto_id = $d['medida_producto']['id'];
                $loteDetalle->sub_medida_id = $d['sub_medida_id'];
                $loteDetalle->save();
            }
        }

        // Insertar productos nuevos
        foreach ($request->productos_model as $index => $d) {
            $sub_medida_id = "";
            $medida = "";
            if ($d["tipo"] == 0) {
                $medida = $d["medida_producto"];
                $sub_medida = $medida["sub_medidas"][0];
                $sub_medida_id = $sub_medida["id"];
            }

            // Inventario
            $inventario = new Inventario();
            $inventario->producto_id = $d['producto']['id'];
            $inventario->almacen_id = $request->almacen_id;
            $inventario->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida['id'];
            $inventario->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida']['id'] : $sub_medida_id;
            $inventario->cant = $d['producto_model']['cantidad'];
            $inventario->nro = $d['producto_model']['nro'];
            $inventario->motivo = "COMPRA DE LOTE";
            $inventario->save();

            // CompraInventario nuevo
            $CompraInventario = new CompraInventario();
            $CompraInventario->inventario_id = $inventario->id;
            $CompraInventario->compra_id = $compra->id;
            $CompraInventario->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida['id'];
            $CompraInventario->categoria_id = $d['categoria']['id'];
            $CompraInventario->cinta = $d['categoria']['cinta'];
            $CompraInventario->sub_original_id = $d['tipo'] == 1 ? $d['sub_medida_2']['id'] : $sub_medida_id;
            $CompraInventario->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida']['id'] : $sub_medida_id;
            $CompraInventario->cant = $d['producto_model']['cantidad'];
            $CompraInventario->nro = $d['producto_model']['nro'];
            $CompraInventario->valor = $d['producto_model']['peso'];
            $CompraInventario->pigmento = $d['producto_model']['pigmento'];
            $CompraInventario->tipo_pollo = $d['producto_model']['tipo_pollo'];
            $CompraInventario->name = $d['tipo'] == 1 ? ($d['categoria']['name'] . "-" . $d['sub_medida_2']['name']) : $d['producto']['name'];
            $CompraInventario->name_producto = $d['tipo'] == 1 ? $d['sub_medida_2']['name'] : $d['producto']['name'];
            $CompraInventario->save();

            // LoteDetalle nuevo
            $loteDetalle = new LoteDetalle();
            $loteDetalle->lote_id = $lote->id;
            $loteDetalle->compra_id = $compra->id;
            $loteDetalle->cajas = $d['producto_model']['cantidad'];
            $loteDetalle->pollos = $d['tipo'] == 1 ? ($d['producto_model']['nro'] / $d['producto_model']['cantidad']) : 1;
            $loteDetalle->equivalente = $d['producto_model']['nro'];
            $loteDetalle->peso_total = $d['producto_model']['peso'];
            $loteDetalle->name = $d['tipo'] == 1 ? ($d['categoria']['name'] . "-" . $d['sub_medida_2']['name']) : $d['producto']['name'];
            $loteDetalle->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalle->hora = Carbon::now()->format('H:i:s');
            $loteDetalle->user_id = $lote->user_id;
            $loteDetalle->tipo = "COM";
            $loteDetalle->nro = "E";
            $loteDetalle->id_nro = "{$compra->id}";
            $loteDetalle->detalle = "{$compra->id} COMPRA";
            $loteDetalle->producto = $d['tipo'] == 1 ? $d['sub_medida_2']['name'] : $d['producto']['name'];
            $loteDetalle->pigmento = $d['producto_model']['pigmento'];
            $loteDetalle->categoria_id = $d['categoria']['id'];
            $loteDetalle->medida_producto_id =  $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida["id"];
            $loteDetalle->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida_2']['id'] : $sub_medida_id;
            $loteDetalle->compra_inventario_id = $CompraInventario->id;
            $loteDetalle->save();
        }

        if ($lote) {
            $lote->pollos = $request->sum_cant_pollos;
            $lote->cajas = $request->sum_cant_envases;
            $lote->valor_peso = $request->sum_peso_bruto;
            $lote->save();
            LoteDetalle::where('lote_id', $lote->id)->delete();
        }
        $compraAgrupada = $this->lote($compra);
        foreach ($compraAgrupada->detalles as $l) {
            $loteDetalle = new LoteDetalle();
            $loteDetalle->lote_id = $lote->id;
            $loteDetalle->compra_id = $compra->id;
            $loteDetalle->cajas = $l['cajas'];
            $loteDetalle->pollos = $l['cajas'] > 0 ? $l['pollos'] / $l['cajas'] : 0;
            $loteDetalle->equivalente = $l['pollos'];
            $loteDetalle->peso_total = $l['valor'];
            $loteDetalle->name = $l['name'];
            $loteDetalle->fecha = Carbon::now()->format('Y-m-d');
            $loteDetalle->hora = Carbon::now()->format('H:i:s');
            $loteDetalle->user_id = $lote->user_id;
            $loteDetalle->tipo = "COM";
            $loteDetalle->nro = "E";
            $loteDetalle->id_nro = "{$compra->id}";
            $loteDetalle->detalle = "{$compra->id} COMPRA";
            $loteDetalle->producto = $l['producto_name'];
            $loteDetalle->pigmento = $l['pigmento'];
            $loteDetalle->categoria_id = $l['categoria']['id'];
            $loteDetalle->medida_producto_id = $l['medida_producto']['id'];
            $loteDetalle->sub_medida_id = $l['sub_medida']['id'];
            $loteDetalle->save();
        }

        $compra->url_pdf = url("reportes/compras/$compra->id");
        $compra->url_pdf_2 = url("reportes/compra-originals/$compra->id");
        return $compra;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */

    public function destroy(Compra $compra)
    {
        $tieneVentas = LoteDetalleVenta::query()
            ->join('lote_detalles', 'lote_detalles.id', '=', 'lote_detalle_ventas.lote_detalle_id')
            ->join('ventas', 'ventas.id', '=', 'lote_detalle_ventas.venta_id')
            ->where('lote_detalles.compra_id', $compra->id)
            ->where('ventas.estado', 1)
            ->exists();

        if ($tieneVentas) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No se puede anular esta compra porque tiene lotes ya utilizados en ventas activas.'
            ], 422);
        }

        $tieneEnvioPP = LoteDetalle::query()
            ->join('pp_detalles', 'pp_detalles.lote_detalle_id', '=', 'lote_detalles.id')
            ->where('lote_detalles.compra_id', $compra->id)
            ->where('pp_detalles.estado', 1)
            ->exists();

        if ($tieneEnvioPP) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No se puede anular esta compra porque tiene lotes que han sido enviados a PP.'
            ], 422);
        }

        $tieneEnvioPT = LoteDetalle::query()
            ->join('pt_detalles', 'pt_detalles.lote_detalle_id', '=', 'lote_detalles.id')
            ->where('lote_detalles.compra_id', $compra->id)
            ->where('pt_detalles.estado', 1)
            ->exists();

        if ($tieneEnvioPT) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'No se puede anular esta compra porque tiene lotes que han sido enviados a PT.'
            ], 422);
        }
        $compra->estado = 0;
        $compra->save();
        $lote = $compra->Lote;
        if ($lote) {
            $lote->estado = 0;
            $lote->save();
        }

        return response()->json(['ok' => true, 'mensaje' => 'Compra anulada correctamente']);
    }



    public function finalizar(Compra $compra)
    {
        $compra->fin = 1;
        $compra->save();

        $lote = $compra->Lote;
        if ($lote) {
            $lote->fin = 1;
            $lote->save();
        }

        return response()->json(['ok' => true, 'mensaje' => 'Compra finalizada correctamente']);
    }

    public function pdf(Compra $compra)
    {
        $compra = $this->show($compra);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compra', ["compra" => $compra])
            ->setPaper('a4')
            ->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function categorizada(Compra $compra)
    {
        $compra = $this->showCategorizada($compra);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compracategorizada', ["compra" => $compra])
            ->setPaper('a4')
            ->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function sub(Compra $compra)
    {
        $compra = $this->showCategorizada($compra);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compra_sub', ["compra" => $compra])
            ->setPaper('a4')
            ->setOption('enable_php', true);
        return $pdf->stream();
    }
    public function pdf_horizontal(Compra $compra)
    {
        $compra = $this->show($compra);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compra_horizontal', ["compra" => $compra])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function pdf_view(Compra $compra)
    {
        $compra = $this->show($compra);

        return view('reportes.pdf.almacen.compra', ["compra" => $compra]);
    }
    public function pdf_o(Compra $compra)
    {
        $compra = $this->show($compra);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compra_2', ["compra" => $compra])
            ->setPaper('a4')
            ->setOption('enable_php', true);
        return $pdf->stream();
    }


    public function pdf_excel(Compra $compra)
    {
        $compra = $this->show($compra);


        // $excelContent = \PhpOffice\PhpSpreadsheet\IOFactory::load($pdf)->getActiveSheet()->toArray();

        // // Crear una respuesta HTTP con el archivo Excel
        // $response = Response::make($excelContent, 200);
        // $response->header('Content-Type', 'application/vnd.ms-excel');
        // $response->header('Content-Disposition', 'attachment; filename="archivo_excel.xls"');
        // $pdf->save(storage_path('app/public/reports/invoice.pdf'));


        // $file = storage_path('app/public/reports/invoice.pdf');

        // $tabula = new Tabula('/usr/bin/');

        // $tabula->setPdf($file)
        //     ->setOptions([
        //         'format' => 'csv',
        //         'pages' => 'all',
        //         'lattice' => true,
        //         'stream' => true,
        //         'outfile' => storage_path("app/public/reports/test.csv"),
        //     ])
        //     ->convert();

        // return response()->download(storage_path("app/public/reports/test.csv"));
        $compra2 = new CompraExport($compra);
        return Excel::download($compra2, "COMPRA-{$compra->id}-{$compra->fecha}-{$compra->sucursal->nombre}.xlsx");


        return $compra;
    }
}
