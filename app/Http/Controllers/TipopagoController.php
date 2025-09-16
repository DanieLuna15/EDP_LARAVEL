<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Tipopago;

class TipopagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipopago::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('tipopagos', 'name'),
                ],
            ],
            [
                'name.required' => 'El nombre del método de pago es obligatorio.',
                'name.string'   => 'El nombre debe ser un texto válido.',
                'name.max'      => 'El nombre no puede superar los 100 caracteres.',
                'name.unique'   => 'Ya existe un método de pago con este nombre.',
            ]
        );

        $tipopago = Tipopago::create($validated);
        return response()->json($tipopago, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function show(Tipopago $tipopago)
    {

        return $tipopago;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipopago $tipopago)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('tipopagos', 'name')->ignore($tipopago->id),
                ],
            ],
            [
                'name.required' => 'El nombre del método de pago es obligatorio.',
                'name.string'   => 'El nombre debe ser un texto válido.',
                'name.max'      => 'El nombre no puede superar los 100 caracteres.',
                'name.unique'   => 'Ya existe un método de pago con este nombre.',
            ]
        );

        $tipopago->update($validated);
        return response()->json($tipopago->fresh(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipopago  $tipopago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipopago $tipopago)
    {
        $tipopago->estado = 0;
        $tipopago->save();
    }
}
