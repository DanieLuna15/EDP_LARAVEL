<?php

namespace App\Http\Controllers;

use App\Models\CajaSucursalUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CajaSucursalUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CajaSucursalUsuario::where('estado', 1)->get();
    }
    public function listaUsers($user, $sucursal)
    {
        $lista = CajaSucursalUsuario::with(['CajaSucursal'])->where('estado', 1)->get()->each(function ($item) {
            $item->sucursal_id = $item->CajaSucursal->sucursal_id;
        });
        $filtro = collect($lista)->where('sucursal_id', $sucursal)->where('user_id', $user)->values();
        return $filtro;
    }

    public function cajaActivaUsuario($user, $sucursal)
    {
        Log::info('🔍 Buscando caja activa para despacho:', [
            'user_id' => $user,
            'sucursal_id' => $sucursal
        ]);

        $cajaActiva = CajaSucursalUsuario::with(['CajaSucursal', 'arqueos'])
            ->where('estado', 1)
            ->where('user_id', $user)
            ->whereHas('CajaSucursal', function ($query) use ($sucursal) {
                $query->where('sucursal_id', $sucursal);
            })
            ->get()
            ->first(function ($item) {
                return $item->arqueos->contains('apertura', 1);
            });

        if ($cajaActiva) {
            $arqueoActivo = $cajaActiva->arqueos->firstWhere('apertura', 1);

            Log::info('✅ Caja activa encontrada para despacho:', [
                'caja_sucursal_usuario_id' => $cajaActiva->id,
                'arqueo_activo' => $arqueoActivo ? $arqueoActivo->toArray() : 'No encontrado'
            ]);

            // Puedes incluir el arqueo activo manualmente si el frontend lo necesita
            $cajaActiva->arqueo_activo = $arqueoActivo;
        } else {
            Log::warning('⚠️ No se encontró caja activa (apertura = 1) para despacho.');
            return response()->json(null);
        }

        return response()->json($cajaActiva);
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cajaSucursalUsuario = new CajaSucursalUsuario();
        $cajaSucursalUsuario->caja_sucursal_id = $request->caja_sucursal_id;
        $cajaSucursalUsuario->user_id = $request->user_id;
        $cajaSucursalUsuario->save();
        return $cajaSucursalUsuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CajaSucursalUsuario  $cajaSucursalUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(CajaSucursalUsuario $cajaSucursalUsuario)
    {

        return $cajaSucursalUsuario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CajaSucursalUsuario  $cajaSucursalUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CajaSucursalUsuario $cajaSucursalUsuario)
    {
        $cajaSucursalUsuario->name = $request->name;
        $cajaSucursalUsuario->save();
        return $cajaSucursalUsuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CajaSucursalUsuario  $cajaSucursalUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(CajaSucursalUsuario $cajaSucursalUsuario)
    {
        $cajaSucursalUsuario->estado = 0;
        $cajaSucursalUsuario->save();
    }
}
