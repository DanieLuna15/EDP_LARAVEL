<?php

namespace App\Http\Controllers;

use App\Models\CajaProveedor;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\Documento;
use App\Models\Persona;
use App\Models\Proveedor;
use App\Models\ProveedorCompra;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Documento::where('estado', 1)->get();
    }

    private function validateData(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'El campo Nombre es obligatorio y no puede estar vacío.',
            'name.string' => 'El campo Nombre debe ser una cadena de texto válida.',
            'name.max' => 'El campo Nombre no puede tener más de 255 caracteres.'
        ]);
        if ($validator) {
            return $validator;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validateData($request);

            $documento = new Documento();
            $documento->name = $request->name;
            $documento->save();

            return response()->json([
                'success' => 'Documento guardado exitosamente.',
                'data' => $documento
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        return $documento;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        try {
            $this->validateData($request);

            $documento->name = $request->name;
            $documento->save();

            return response()->json([
                'success' => 'Documento actualizado exitosamente.',
                'data' => $documento
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        $existeRelacion = CajaProveedor::where('documento_id', $documento->id)->exists() ||
            Chofer::where('documento_id', $documento->id)->exists() ||
            Cliente::where('documento_id', $documento->id)->exists() ||
            Persona::where('documento_id', $documento->id)->exists() ||
            Proveedor::where('documento_id', $documento->id)->exists() ||
            ProveedorCompra::where('documento_id', $documento->id)->exists() ||
            Sucursal::where('documento_id', $documento->id)->exists();

        if ($existeRelacion) {
            return response()->json(['error' => 'El documento está relacionado con otros registros y no puede ser eliminado.'], 400);
        }

        $documento->estado = 0;
        $documento->save();

        return response()->json(['success' => 'Documento eliminado correctamente.'], 200);
    }
}
