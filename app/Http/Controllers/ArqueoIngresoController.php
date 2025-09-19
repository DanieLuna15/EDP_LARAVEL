<?php

namespace App\Http\Controllers;

use App\Models\ArqueoIngreso;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArqueoIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArqueoIngreso::with(['formapago', 'cajamotivo', 'banco'])
            ->where('estado', 1)
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lista = ArqueoIngreso::where('arqueo_id',$request->arqueo_id)->get();
        $nro = count($lista);
        $arqueoIngreso = new ArqueoIngreso();
        $arqueoIngreso->cajamotivo_id = $request->cajamotivo_id;
        $arqueoIngreso->arqueo_id = $request->arqueo_id;
        $arqueoIngreso->formapago_id = $request->formapago_id;
        $arqueoIngreso->tipo = $request->tipo;
        $arqueoIngreso->monto = $request->monto;
        $arqueoIngreso->banco_id = $request->filled('banco_id') ? $request->banco_id : null;
        $arqueoIngreso->nro_comprobante = $request->filled('nro_comprobante')
            ? trim($request->nro_comprobante)
            : null;
        $arqueoIngreso->obs = $request->filled('obs') ? trim($request->obs) : null;
        $arqueoIngreso->fecha = Carbon::now()->format('Y-m-d');
        $arqueoIngreso->nro = $nro+1;
        $arqueoIngreso->save();
        return $arqueoIngreso->load(['formapago', 'cajamotivo', 'banco']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArqueoIngreso  $arqueoIngreso
     * @return \Illuminate\Http\Response
     */
    public function show(ArqueoIngreso $arqueoIngreso)
    {
        
        return $arqueoIngreso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArqueoIngreso  $arqueoIngreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArqueoIngreso $arqueoIngreso)
    {
        $campos = [
            'cajamotivo_id',
            'formapago_id',
            'tipo',
            'monto',
            'banco_id',
            'nro_comprobante',
            'obs',
        ];

        foreach ($campos as $campo) {
            if ($request->has($campo)) {
                $valor = $request->$campo;
                if ($campo === 'banco_id') {
                    $arqueoIngreso->$campo = $request->filled('banco_id') ? $request->banco_id : null;
                } elseif (in_array($campo, ['nro_comprobante', 'obs'])) {
                    $arqueoIngreso->$campo = $request->filled($campo) ? trim($valor) : null;
                } else {
                    $arqueoIngreso->$campo = $valor;
                }
            }
        }

        if ($request->has('fecha')) {
            $arqueoIngreso->fecha = $request->fecha;
        }

        $arqueoIngreso->save();

        return $arqueoIngreso->load(['formapago', 'cajamotivo', 'banco']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArqueoIngreso  $arqueoIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArqueoIngreso $arqueoIngreso)
    {
        $arqueoIngreso->estado = 0;
        $arqueoIngreso->save();
    }
}
