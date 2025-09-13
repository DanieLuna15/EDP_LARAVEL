<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Producto;
use App\Models\TransItem;
use Illuminate\Http\Request;
use App\Models\TransEspecial;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Models\ProductoPrecioCambio;

class ProductoPrecioCambioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductoPrecioCambio::where('estado',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productoPrecioCambio = new ProductoPrecioCambio();
        $productoPrecioCambio->name = $request->name;
        $productoPrecioCambio->save();
        return $productoPrecioCambio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoPrecioCambio  $productoPrecioCambio
     * @return \Illuminate\Http\Response
     */
    public function show(ProductoPrecioCambio $productoPrecioCambio)
    {

        return $productoPrecioCambio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductoPrecioCambio  $productoPrecioCambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductoPrecioCambio $productoPrecioCambio)
    {
        $productoPrecioCambio->name = $request->name;
        $productoPrecioCambio->save();
        return $productoPrecioCambio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoPrecioCambio  $productoPrecioCambio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductoPrecioCambio $productoPrecioCambio)
    {
        $productoPrecioCambio->estado = 0;
        $productoPrecioCambio->save();
    }

    public function pdf(ProductoPrecioCambio $productoPrecioCambio)
    {
        $producto = Producto::with('MedidaProductos.SubMedidas')->find(1);
        $orden_cintas = [];
        if ($producto && $producto->medidaProductos && count($producto->medidaProductos)) {
            $sub_medidas = $producto->medidaProductos[0]->subMedidas ?? [];
            foreach ($sub_medidas as $s) {
                $orden_cintas[$s->name] = $s->nro_orden;
            }
        }


        $productoPrecioCambio = $this->show($productoPrecioCambio);
        $pps = $productoPrecioCambio->ProductoPrecioSucursals;

        function getPpsName($de) {
            if ($de->ProductoPrecio && isset($de->ProductoPrecio->name)) {
                return $de->ProductoPrecio->name;
            }
            if (isset($de['ProductoPrecio']['name'])) {
                return $de['ProductoPrecio']['name'];
            }
            return null;
        }

        $pps_sorted = $pps->sort(function ($a, $b) use ($orden_cintas) {
            $nameA = getPpsName($a);
            $nameB = getPpsName($b);
            $orderA = $orden_cintas[$nameA] ?? 9999;
            $orderB = $orden_cintas[$nameB] ?? 9999;
            return $orderA <=> $orderB;
        })->values();

        $productoPrecioCambio->ProductoPrecioSucursals = $pps_sorted;

        foreach ($pps_sorted as $idx => $p) {
            $nombre = getPpsName($p);
            $order = $orden_cintas[$nombre] ?? 9999;
            Log::info("[$idx] $nombre => $order");
        }


        $user = $productoPrecioCambio->User;
        $sucursal = $productoPrecioCambio->Sucursal;

        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $sucursal->image = $sucursal->file_sucursals->first();
        $transItem = TransItem::with(['TransItemDetalles','Item'])->where('estado',1)->get();
        $transEspecial = TransEspecial::with(['TransEspecialItems','Item'])->where('estado',1)->get();

        $pdf = Pdf::loadView('reportes.pdf.cambioPrecios.producto', [
            "productoPrecioCambio" => $productoPrecioCambio,
            "sucursal" => $sucursal,
            "user" => $user,
            "transItem" => $transItem,
            "transEspecial" => $transEspecial,
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function fecha(Request $request)
    {
        $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
        $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');

        $model = ProductoPrecioCambio::with(['Sucursal'])->where('estado', 1)->whereDate('fecha','>=', $fecha_inicio)->whereDate('fecha','<=', $fecha_fin)->get();
        $list = [];
        foreach ($model as $m ) {
           $m->url_pdf = url("reportes/productoPrecioCambios/$m->id");

            $list[] = $m;
        }
        return $list;
    }
}
