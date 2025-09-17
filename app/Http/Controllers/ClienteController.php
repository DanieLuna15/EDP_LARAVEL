<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteCajacerrada;
use App\Models\ClienteFile;
use App\Models\ClientePp;
use App\Models\ClientePt;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\ClienteExport;
use App\Imports\ClienteImport;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return Cliente::with(['Documento', 'Tipocliente', 'CintaCliente', 'AcuerdoCliente'])->where([['estado', 1], ['aprobado', 1], ['activo', 1]])->get();
    // }

    public function index()
    {
        return Cliente::with([
            'Documento',
            'Tipocliente',
            'CintaCliente',
            'AcuerdoCliente',
            'Ventas' => function ($query) {
                $query->whereIn('metodo_pago', [2, 3, 4])
                    ->where('pendiente_total', '>', 0)
                    ->where('estado', 1);
            }
        ])
            ->where([
                ['estado', 1],
                ['aprobado', 1],
                ['activo', 1]
            ])
            ->get()
            ->map(function ($cliente) {
                $ventas_a_credito = $cliente->Ventas->count();
                $saldo_creditos_activados = $cliente->Ventas->sum('pendiente_total');
                $cliente->creditos_activos_saldo = max($cliente->creditos_activos - $ventas_a_credito, 0);
                $cliente->saldo_creditos_activados = max($saldo_creditos_activados, 0);
                $cliente->saldo_limite_crediticio = number_format(max($cliente->limite_crediticio - $saldo_creditos_activados, 0), 2, '.', '');
                return $cliente;
            });
    }

    // public function precios_list()
    // {
    //     return Cliente::with(['Documento', 'Tipocliente', 'CintaCliente', 'AcuerdoCliente', 'ClienteCajacerradas', 'ClientePps', 'ClientePts'])->where([['estado', 1], ['aprobado', 1], ['activo', 1]])->get();
    // }

    public function precios_list()
    {
        return Cliente::with([
            'Documento',
            'Tipocliente',
            'CintaCliente',
            'AcuerdoCliente',
            'ClienteCajacerradas',
            'ClientePps',
            'ClientePts',
            'Ventas' => function ($query) {
                $query->whereIn('metodo_pago', [2, 3, 4])
                    ->where('pendiente_total', '>', 0)
                    ->where('estado', 1);
            }
        ])
            ->where([
                ['estado', 1],
                ['aprobado', 1],
                ['activo', 1]
            ])
            ->get()
            ->map(function ($cliente) {
                $ventas_a_credito = $cliente->Ventas->count();
                $saldo_creditos_activados = $cliente->Ventas->sum('pendiente_total');
                $cliente->creditos_activos_saldo = max($cliente->creditos_activos - $ventas_a_credito, 0);
                $cliente->saldo_creditos_activados = max($saldo_creditos_activados, 0);
                $cliente->saldo_limite_crediticio = number_format(max($cliente->limite_crediticio - $saldo_creditos_activados, 0), 2, '.', '');
                return $cliente;
            });
    }

    public function index_2()
    {
        return Cliente::with(['Documento', 'Tipocliente', 'CintaCliente', 'AcuerdoCliente'])->where([['estado', 1], ['aprobado', 0]])->get();
    }
    public function index_3()
    {
        return Cliente::with(['Documento', 'Tipocliente', 'CintaCliente', 'AcuerdoCliente'])->where([['estado', 1], ['aprobado', 1], ['activo', 0]])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->doc = $request->doc;
        $cliente->documento_id = $request->documento_id;
        $cliente->tipocliente_id = $request->tipocliente_id;
        $cliente->cinta_cliente_id = $request->cinta_cliente_id ?: 0;
        $cliente->tipopago_id = $request->tipopago_id;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->correo = $request->correo;
        $cliente->limite_crediticio = $request->limite_crediticio;
        $cliente->creditos_activos = $request->creditos_activos;
        $cliente->dias_horas = $request->dias_horas;
        $cliente->latitud = $request->latitud;
        $cliente->longitud = $request->longitud;
        $cliente->deuda_heredada = $request->deuda_heredada;
        $cliente->dinero_cuenta = $request->dinero_cuenta;
        $cliente->tipo_caja_cerrada = $request->tipo_caja_cerrada;
        $cliente->tipo_cliente_pp = $request->tipo_cliente_pp ?: 0;
        $cliente->tipo_pollo_limpia = $request->tipo_pollo_limpia ?: 0;
        $cliente->tipo_pt = $request->tipo_pt ?: 0;
        $cliente->tipo_trans = $request->tipo_trans ?: 0;
        $cliente->acuerdo = $request->acuerdo;
        $cliente->interes = $request->interes;
        $cliente->acuerdo_cliente_id = $request->acuerdo_cliente_id ?: 0;
        $cliente->cajacerrada_cliente_id = $request->cajacerrada_cliente_id;
        $cliente->tipo_cliente_pp_limpio_id = $request->tipo_cliente_pp_limpio_id;
        $cliente->tipo_cliente_pp_id = $request->tipo_cliente_pp_id;
        $cliente->caja_cerrada = $request->caja_cerrada ?: 0;
        $cliente->iva = $request->iva;
        $cliente->is_iva = $request->is_iva;
        $cliente->forma_pedido_id = $request->forma_pedido_id;
        $cliente->tipo_negocio_id = $request->tipo_negocio_id;
        $cliente->zona_despacho_id = $request->zona_despacho_id;
        $cliente->preventista_id = $request->preventista_id ?: 1;
        $cliente->distribuidor_id = $request->distribuidor_id ?: 1;
        $cliente->horario_preferencia = $request->horario_preferencia;
        $cliente->horario_pedido = $request->horario_pedido;
        $cliente->chofer_id = $request->chofer_id;
        $cliente->aprobado = 0;
        $cliente->save();
        foreach ($request->cajas_cerradas as $caja) {
            $clienteCajacerrada = new ClienteCajacerrada();
            $clienteCajacerrada->cliente_id = $cliente->id;
            $clienteCajacerrada->producto_precio_id = $caja['precio_producto']['id'];
            $clienteCajacerrada->valor = $caja['valor'];
            $clienteCajacerrada->save();
        }
        foreach ($request->pps as $p) {
            $clientePp = new ClientePp();
            $clientePp->cliente_id = $cliente->id;
            $clientePp->item_id = $p['item']['id'];
            $clientePp->valor = $p['valor'];
            $clientePp->save();
        }
        foreach ($request->pts as $p) {
            $clientePt = new ClientePt();
            $clientePt->cliente_id = $cliente->id;
            $clientePt->item_id = $p['item']['id'];
            $clientePt->valor = $p['valor'];
            $clientePt->save();
        }
        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $cliente->cliente_files = $cliente->ClienteFiles()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $cliente->cliente_cajacerradas = $cliente->ClienteCajacerradas()->get();
        $cliente->cliente_pps = $cliente->ClientePps()->get();
        $cliente->cliente_pts = $cliente->ClientePts()->get();
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //dd($request->all());
        $cliente->activo = $request->activo;
        $cliente->nombre = $request->nombre;
        $cliente->doc = $request->doc;
        $cliente->tipopago_id = $request->tipopago_id;
        $cliente->documento_id = $request->documento_id;
        $cliente->tipocliente_id = $request->tipocliente_id;
        $cliente->cinta_cliente_id = $request->cinta_cliente_id ?: 0;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->correo = $request->correo;
        $cliente->limite_crediticio = $request->limite_crediticio;
        $cliente->creditos_activos = $request->creditos_activos;
        $cliente->dias_horas = $request->dias_horas;
        $cliente->latitud = $request->latitud;
        $cliente->longitud = $request->longitud;
        $cliente->deuda_heredada = $request->deuda_heredada;
        $cliente->dinero_cuenta = $request->dinero_cuenta;
        $cliente->tipo_caja_cerrada = $request->tipo_caja_cerrada ?: 0;
        $cliente->tipo_cliente_pp   = $request->tipo_cliente_pp ?: 0;
        $cliente->tipo_pollo_limpia = $request->tipo_pollo_limpia ?: 0;
        $cliente->tipo_pt           = $request->tipo_pt ?: 0;
        $cliente->tipo_trans        = $request->tipo_trans ?: 0;
        $cliente->acuerdo = $request->acuerdo;
        $cliente->acuerdo_cliente_id = $request->acuerdo_cliente_id ?: 0;
        $cliente->cajacerrada_cliente_id = $request->cajacerrada_cliente_id;
        $cliente->aprobado = $request->aprobado;
        $cliente->tipo_cliente_pp_limpio_id = $request->tipo_cliente_pp_limpio_id;
        $cliente->tipo_cliente_pp_id = $request->tipo_cliente_pp_id;
        $cliente->interes = $request->interes;
        $cliente->caja_cerrada = $request->caja_cerrada ?: 0;
        $cliente->iva = $request->iva;
        $cliente->is_iva = $request->is_iva;
        $cliente->forma_pedido_id = $request->forma_pedido_id;
        $cliente->tipo_negocio_id = $request->tipo_negocio_id;
        $cliente->zona_despacho_id = $request->zona_despacho_id;
        $cliente->horario_preferencia = $request->horario_preferencia;
        $cliente->horario_pedido = $request->horario_pedido;
        $cliente->chofer_id = $request->chofer_id;
        $cliente->preventista_id = $request->preventista_id ?: 1;
        $cliente->distribuidor_id = $request->distribuidor_id ?: 1;
        $cliente->save();
        return $cliente;
    }
    public function precios(Request $request, Cliente $cliente)
    {
        if (is_array($request->cliente_cajacerradas)) {
            foreach ($request->cliente_cajacerradas as $caja) {
                if (!isset($caja['id'])) continue;
                $clienteCajacerrada = ClienteCajacerrada::find($caja['id']);
                if (!$clienteCajacerrada) continue;
                $clienteCajacerrada->valor = $caja['valor'];
                $clienteCajacerrada->estado = $caja['estado'];
                $clienteCajacerrada->save();
            }
        }

        if (is_array($request->cliente_pps)) {
            foreach ($request->cliente_pps as $caja) {
                if (!isset($caja['id'])) continue;
                $ClientePp = ClientePp::find($caja['id']);
                if (!$ClientePp) continue;
                $ClientePp->valor = $caja['valor'];
                $ClientePp->estado = $caja['estado'];
                $ClientePp->save();
            }
        }

        if (is_array($request->cliente_pts)) {
            foreach ($request->cliente_pts as $caja) {
                if (!isset($caja['id'])) continue;
                $ClientePt = ClientePt::find($caja['id']);
                if (!$ClientePt) continue;
                $ClientePt->valor = $caja['valor'];
                $ClientePt->estado = $caja['estado'];
                $ClientePt->save();
            }
        }


        if (is_array($request->cajas_cerradas)) {
            foreach ($request->cajas_cerradas as $caja) {
                $clienteCajacerrada = new ClienteCajacerrada();
                $clienteCajacerrada->cliente_id = $cliente->id;
                $clienteCajacerrada->producto_precio_id = $caja['precio_producto']['id'];
                $clienteCajacerrada->valor = $caja['valor'];
                $clienteCajacerrada->save();
            }
        }
        if (is_array($request->pps)) {
            foreach ($request->pps as $p) {
                $clientePp = new ClientePp();
                $clientePp->cliente_id = $cliente->id;
                $clientePp->item_id = $p['item']['id'];
                $clientePp->valor = $p['valor'];
                $clientePp->save();
            }
        }
        if (is_array($request->pts)) {
            foreach ($request->pts as $p) {
                $clientePt = new ClientePt();
                $clientePt->cliente_id = $cliente->id;
                $clientePt->item_id = $p['item']['id'];
                $clientePt->valor = $p['valor'];
                $clientePt->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Precios guardados correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->estado = 0;
        $cliente->save();
    }
    public function aprobar(Cliente $cliente, Request $request)
    {
        $cliente->aprobado = 1;
        // $cliente->user_id = $request->user_id;
        $cliente->save();
    }
    public function image(Request $request, $id)
    {


        $file = $request->file('file')->store('public/clientes');
        $url = Storage::url($file);

        $fileModel = new File();
        $fileModel->path = $url;
        $fileModel->save();
        $clienteFile = new ClienteFile();
        $clienteFile->file_id = $fileModel->id;
        $clienteFile->cliente_id = $id;
        $clienteFile->tipoarchivo_id = $request->tipoarchivo_id;
        $clienteFile->save();

        return $clienteFile;
    }
    public function imageDelete($id)
    {
        $file = ClienteFile::find($id);
        $file->estado = 0;
        $file->save();
    }
    public function TemplateExcel()
    {
        $cliente = new ClienteExport();
        return Excel::download($cliente, "ClienteTemplate.xlsx");
    }
    public function ImportarExcel(Request $request)
    {
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|mimes:xlsx',
            ]);

            Excel::import(new ClienteImport, $request->file('file'));
            return "Clientes importados";
        }
    }
    public function filtrarClientes(Request $request)
    {
        $q = $request->input('q');
        $clientes = Cliente::with('documento')
            ->where('nombre', 'like', "%{$q}%")
            ->orWhereHas('documento', function ($q1) use ($q) {
                $q1->where('name', 'like', "%{$q}%");
            })
            ->orWhere('doc', 'like', "%{$q}%")
            ->limit(10)
            ->get();

        return response()->json($clientes);
    }
}
