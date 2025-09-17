<?php

namespace App\Http\Controllers;

use App\Models\CajaSucursalUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
            $cajaActiva->arqueo_activo = $arqueoActivo;
        } else {
            Log::warning('⚠️ No se encontró caja activa (apertura = 1) para despacho.');
            return response()->json(null);
        }
        return response()->json($cajaActiva);
    }

    public function cajaActivaUsuarioApp()
    {
        $user = Auth::user()->id;
        $sucursal = Auth()->user()->getSellingPointSucursal()->first();
        $sucursal= $sucursal->id;
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
            $cajaActiva->arqueo_activo = $arqueoActivo;
        } else {
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
