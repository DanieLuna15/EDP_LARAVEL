<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lote;
use App\Models\LoteAve;
use App\Models\CompraAve;
use App\Models\SubMedida;
use App\Models\Inventario;
use App\Models\CajaEntrada;
use App\Models\LoteDetalle;
use Illuminate\Http\Request;
use App\Exports\CompraExport;
use App\Models\AveInventario;
use App\Models\LoteAveDetalle;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CompraInventario;
use App\Models\CompraAveInventario;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class CompraAveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = CompraAve::with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra', 'Lote', 'ConsolidacionDetalles'])->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->creacion = $s->created_at->format('Y-m-d ');
            $s->url_sub_pdf = url("reportes/compra_aves-sub/$s->id");
            $s->url_pdf = url("reportes/compras_aves/$s->id");
            $s->url_pdf_2 = url("reportes/compra_aves-originals/$s->id");
            $s->url_excel = url("reportes/compra_aves-excels/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra_aves-categorizadas/$s->id");
            $list[] = $s;
        }
        return $list;
    } // Asegúrate de tener esto al inicio del archivo

    public function vigentes()
    {
        $model = CompraAve::with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra', 'Lote', 'ConsolidacionDetalles'])
            ->where('fin', 0)
            ->get();
        $list = [];
        foreach ($model as $s) {
            $s->creacion = $s->created_at ? $s->created_at->format('Y-m-d') : null;
            $s->url_sub_pdf = url("reportes/compra_aves-sub/$s->id");
            $s->url_pdf = url("reportes/compras_aves/$s->id");
            $s->url_pdf_2 = url("reportes/compra_aves-originals/$s->id");
            $s->url_excel = url("reportes/compra_aves-excels/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra_aves-categorizadas/$s->id");

            $list[] = $s;
        }
        return $list;
    }

    public function finalizadas()
    {
        $model = CompraAve::with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra', 'Lote', 'ConsolidacionDetalles'])->where('fin', 1)->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->creacion = $s->created_at->format('Y-m-d ');
            $s->url_sub_pdf = url("reportes/compra_aves-sub/$s->id");
            $s->url_pdf = url("reportes/compras_aves/$s->id");
            $s->url_pdf_2 = url("reportes/compra_aves-originals/$s->id");
            $s->url_excel = url("reportes/compra_aves-excels/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra_aves-categorizadas/$s->id");
            $list[] = $s;
        }
        return $list;
    }
    public function validar_caja()
    {
        $model = CompraAve::where('validar', 0)->with(['Sucursal', 'User', 'Consolidacion', 'ProveedorCompra'])->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            $s->creacion = $s->created_at->format('Y-m-d ');
            $s->url_pdf = url("reportes/compras_aves/$s->id");
            $s->url_pdf_2 = url("reportes/compra_aves-originals/$s->id");
            $s->url_categorizada_pdf = url("reportes/compra_aves-categorizadas/$s->id");
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
        Log::info('Inicio store Compra AVE', ['request' => $request->all()]);
        //dd($request->all());
        $compra = new CompraAve();
        $compra->nro = $request->nro;
        $compra->nro_compra = $request->nro_compra;
        $compra->obs = $request->obs;
        $compra->fecha = $request->fecha;
        $compra->fecha_salida = $request->fecha_salida;
        $compra->fecha_llegada = $request->fecha_llegada;
        $compra->proveedor_compra_id = $request->proveedor_compra['id'];
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
        $compra->almacen_id = $request->almacen_id;
        $compra->save();

        $lote = new LoteAve();
        $lote->compra_ave_id = $compra->id;
        $lote->user_id = 1;
        $lote->precio_venta = 0;
        $lote->valor_venta = 0;
        $lote->pollos = $request->sum_cant_pollos;
        $lote->valor_compra = 0;
        $lote->cajas = $request->sum_cant_envases;
        $lote->valor_peso = $request->sum_peso_bruto;
        $lote->fecha = Carbon::now()->format('Y-m-d');
        $lote->save();

        $cajaEntrada = new CajaEntrada();
        $cajaEntrada->user_id = 1;
        $cajaEntrada->almacen_id = $request->almacen_id;
        $cajaEntrada->sucursal_id = 1;
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
            $inventario = new AveInventario();
            $inventario->producto_id = $d['producto']['id'];
            $inventario->almacen_id = $request->almacen_id;
            $inventario->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida["id"];
            $inventario->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida']['id'] : $sub_medida_id;
            $inventario->cant = $d['producto_model']['cantidad'];
            $inventario->nro = $d['producto_model']['nro'];
            $inventario->motivo = "COMPRA DE LOTE";
            $inventario->save();

            $CompraInventario = new CompraAveInventario();
            $CompraInventario->inventario_id = $inventario->id;
            $CompraInventario->compra_ave_id = $compra->id;
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
            $loteDetalle = new LoteAveDetalle();
            $loteDetalle->lote_id = $lote->id;
            $loteDetalle->compra_ave_id = $compra->id;
            $loteDetalle->cajas = $d['producto_model']['cantidad'];
            $loteDetalle->tipo_producto = $d['tipo'];
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
            $loteDetalle->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida["id"];
            $loteDetalle->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida_2']['id'] : $sub_medida_id;
            $loteDetalle->compra_inventario_id = $CompraInventario->id;
            $loteDetalle->save();
        }
        $compra->url_pdf = url("reportes/compras_aves/$compra->id");
        $compra->url_pdf_2 = url("reportes/compra_aves-originals/$compra->id");
        return $compra;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompraAve  $compra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info("ID recibido: {$id}");

        $compra = CompraAve::with('sucursal.Filesucursals.File', 'User', 'ProveedorCompra')->find($id);

        if (!$compra) {
            Log::error("CompraAve no encontrada con ID: {$id}");
            return response()->json(['error' => 'CompraAve no encontrada'], 404);
        }

        Log::info("Iniciando show() para CompraAve ID: {$compra->id}");

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

        foreach ($detalles as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;
            $sub_original = $sub->first()->subOriginal;


            // // $list_sin_cinta[] =  ["categoria"=>$categoria,"sub_medida"=>$sub_medida,"list"=>$sub];
            $list_cinta[] =  [
                "name" => $sub_medida->name,
                "pigmento" => "CON PIGMENTO",
                "sub_medida" => $sub_medida,
                "sub_original" => $sub_original,
                "categoria" => $categoria,
                "list" => $sub
            ];
        }

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
        $compra->lista_detalles = $detalle_collect->sortBy('name');
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
        Log::info("Iniciando procesamiento de categorías para proveedor.");

        foreach ($compra->category_list as $index => $d) {
            Log::info("Procesando categoría #{$index}: {$d['categoria']->name} (ID: {$d['categoria']->id})");

            // Buscar si la categoría está en el proveedor
            $buscar = $compra->ProveedorCompra->ProveedorCategorias()->where('categoria_id', $d['categoria']->id)->get();

            Log::info("Número de coincidencias en proveedor para categoría {$d['categoria']->name}: " . $buscar->count());

            if ($buscar->count() > 0) {
                $sumaPollosCategoria = 0;
                $sumaValorCategoria = 0;
                $sumaValorNetoCategoria = 0;
                $sumaValorTaraCategoria = 0;
                $category = $buscar->first();

                Log::info("Detalles categoría proveedor encontrada: " . json_encode($category));

                $compraInventarios = $compra->CompraInventarios()->get();
                Log::info("Total CompraInventarios obtenidos: " . $compraInventarios->count());

                foreach ($compraInventarios as $iIndex => $i) {
                    Log::info("Procesando CompraInventario #{$iIndex} - ID: {$i->id}, categoria_id: {$i->categoria_id}, sub_medida_id: {$i->sub_medida_id}, cinta: {$i->cinta}");

                    // Buscar si la sub medida está en el proveedor
                    $buscar_sub = $category->ProveedorCategoriaDetalles()->where('sub_medida_id', $i->sub_medida_id)->get();

                    Log::info("Número de coincidencias para sub_medida_id {$i->sub_medida_id} en categoria proveedor: " . $buscar_sub->count());

                    $pollos = $i->tipo_pollo == 1 ? $i->nro : 0;
                    Log::info("Tipo pollo: {$i->tipo_pollo}, pollos para suma: {$pollos}");

                    if ($buscar_sub->count() > 0 && $i->cinta == 1) {
                        $sumaPollosCategoria += $pollos;
                        $sumaValorCategoria += $i->valor;
                        $sumaValorNetoCategoria += $i->valor - ($i->cant * 7);
                        $sumaValorTaraCategoria += ($i->cant * 7);
                        Log::info("Suma actualizada (cinta 1): Pollos={$sumaPollosCategoria}, Valor={$sumaValorCategoria}, Neto={$sumaValorNetoCategoria}, Tara={$sumaValorTaraCategoria}");
                    }

                    if ($i->cinta == 2 && $i->categoria_id == $category->categoria_id) {
                        $sumaPollosCategoria += $pollos;
                        $sumaValorCategoria += $i->valor;
                        $sumaValorNetoCategoria += $i->valor - ($i->cant * 7);
                        $sumaValorTaraCategoria += ($i->cant * 7);
                        Log::info("Suma actualizada (cinta 2): Pollos={$sumaPollosCategoria}, Valor={$sumaValorCategoria}, Neto={$sumaValorNetoCategoria}, Tara={$sumaValorTaraCategoria}");
                    }
                }

                Log::info("Sumas finales para categoría {$d['categoria']->name}: Pollos = {$sumaPollosCategoria}, Valor bruto = {$sumaValorCategoria}, Valor neto = {$sumaValorNetoCategoria}, Tara = {$sumaValorTaraCategoria}");

                $d['sumaPollos'] = number_format($sumaPollosCategoria, 3);
                $d['sumaTotal'] = number_format($sumaValorNetoCategoria, 3);
                $d['peso_bruto'] = number_format($sumaValorCategoria, 3);
                $d['peso_neto'] = number_format($sumaValorNetoCategoria, 3);
                $d['total_tara'] = number_format($sumaValorTaraCategoria, 3);

                $categoria_proveedor_list[] = $d;

                Log::info("Agregada categoría a lista: " . json_encode($d));
            } else {
                Log::info("Categoría {$d['categoria']->name} no encontrada en proveedor.");
            }
        }

        Log::info("Finalizado procesamiento de categorías para proveedor. Total categorías agregadas: " . count($categoria_proveedor_list));
        $compra->categoria_proveedor_list = $categoria_proveedor_list;
        return $compra;
    }

    public function lote($id)
    {
        $compra = CompraAve::find($id);
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
    public function showCategorizada($id)
    {
        $compra = CompraAve::find($id);
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
        foreach ($detalles_sin_cinta as $d) {
            $sub = $d;
            $categoria = $sub->first()->categoria;
            $sub_medida = $sub->first()->subMedida;


            // // $list_sin_cinta[] =  ["categoria"=>$categoria,"sub_medida"=>$sub_medida,"list"=>$sub];
            $list_sin_cinta[] =  ["sub_medida" => $sub_medida, "categoria" => $categoria, "list" => $sub];
        }
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
     * @param  \App\Models\CompraAve  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info("ID recibido: {$id}");

        $compra = CompraAve::with('sucursal.Filesucursals.File', 'User', 'ProveedorCompra')->find($id);

        if (!$compra) {
            Log::error("CompraAve no encontrada con ID: {$id}");
            return response()->json(['error' => 'CompraAve no encontrada'], 404);
        }
        Log::info("CompraAve encontrada:", ['compra_id' => $compra->id]);

        Log::info("Datos recibidos en request:", $request->all());

        $compra->nro = $request->nro;
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
        Log::info("CompraAve actualizada y guardada", ['compra_id' => $compra->id]);

        $lote = $compra->Lote;
        if (!$lote) {
            Log::warning("No se encontró lote para compra ID: {$compra->id}");
        } else {
            $lote->pollos = $request->sum_cant_pollos;
            $lote->cajas = $request->sum_cant_envases;
            $lote->valor_peso = $request->sum_peso_bruto;
            $lote->save();
            Log::info("Lote actualizado para compra ID: {$compra->id}");
        }

        if (isset($request->compra_inventarios)) {
            foreach ($request->compra_inventarios as $d) {
                Log::info("Actualizando compra_inventario ID: {$d['id']}", $d);

                $subMedida = SubMedida::find($d['sub_original_id']);
                $CompraInventario = CompraAveInventario::find($d['id']);

                if (!$CompraInventario) {
                    Log::error("CompraAveInventario no encontrado con ID: {$d['id']}");
                    continue;
                }

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

                $loteDetalle = LoteAveDetalle::where('compra_inventario_id', $CompraInventario->id)->first();
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
                    Log::info("LoteAveDetalle actualizado para compra_inventario ID: {$CompraInventario->id}");
                } else {
                    Log::warning("No se encontró LoteAveDetalle para compra_inventario ID: {$CompraInventario->id}");
                }
            }
        } else {
            Log::warning("No se recibieron compra_inventarios en el request");
        }

        if (isset($request->productos_model)) {
            foreach ($request->productos_model as $d) {
                Log::info("Procesando productos_model:", $d);

                $sub_medida_id = "";
                $medida = "";

                if ($d["tipo"] == 0) {
                    $medida = $d["medida_producto"];
                    $sub_medida = $medida["sub_medidas"][0];
                    $sub_medida_id = $sub_medida["id"];
                }

                $inventario = new AveInventario();
                $inventario->producto_id = $d['producto']['id'];
                $inventario->almacen_id = $request->almacen_id;
                $inventario->medida_producto_id = $d['tipo'] == 1 ? $d['medida_producto']['id'] : $medida['id'];
                $inventario->sub_medida_id = $d['tipo'] == 1 ? $d['sub_medida']['id'] : $sub_medida_id;
                $inventario->cant = $d['producto_model']['cantidad'];
                $inventario->nro = $d['producto_model']['nro'];
                $inventario->motivo = "COMPRA DE LOTE";
                $inventario->save();

                $CompraInventario = new CompraAveInventario();
                $CompraInventario->inventario_id = $inventario->id;
                $CompraInventario->compra_ave_id = $compra->id;
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

                $loteDetalle = new LoteAveDetalle();
                $loteDetalle->lote_id = $lote->id;
                $loteDetalle->compra_ave_id = $compra->id;
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
        } else {
            Log::warning("No se recibieron productos_model en el request");
        }

        $compra->url_pdf = url("reportes/compras_aves/$compra->id");
        $compra->url_pdf_2 = url("reportes/compra_aves-originals/$compra->id");
        return $compra;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraAve  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compra = CompraAve::find($id);
        $compra->estado = 0;
        $compra->save();
        $lote = $compra->Lote;
        $lote->estado = 0;
        $lote->save();
    }
    public function pdf($id)
    {
        $compra = $this->show($id);
        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.compra', ["compra" => $compra]);
        return $pdf->stream();
    }
    public function categorizada($id)
    {
        $compra = $this->showCategorizada($id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.compracategorizada', ["compra" => $compra]);
        return $pdf->stream();
    }
    public function sub($id)
    {
        $compra = $this->show($id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.compra_sub', ["compra" => $compra]);
        return $pdf->stream();
    }
    public function pdf_horizontal($id)
    {
        $compra = $this->show($id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.compra_horizontal', ["compra" => $compra])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function pdf_view($id)
    {
        $compra = $this->show($id);

        return view('reportes.pdf.almacen.compras_aves.compra', ["compra" => $compra]);
    }
    public function pdf_o($id)
    {
        $compra = $this->show($id);

        $pdf = Pdf::loadView('reportes.pdf.almacen.compras_aves.compra_2', ["compra" => $compra]);
        return $pdf->stream();
    }

    public function pdf_excel($id)
    {
        $compra = $this->show($id);
        $compra2 = new CompraExport($compra);
        return Excel::download($compra2, "COMPRA-AVE-{$compra->id}-{$compra->fecha}-{$compra->sucursal->nombre}.xlsx");
        return $compra;
    }
}
