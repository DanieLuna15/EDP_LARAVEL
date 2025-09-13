<?php
namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\File;
use App\Models\Filepersona;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{

    // Validar los datos de la persona
    private function validateData(Request $request)
    {
        $validator = $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellidos'    => 'required|string|max:255',
            'telefono'     => 'required|string|max:15',
            'documento_id' => 'required|integer',
            'cargo'        => 'required|string|max:255',
            'direccion'    => 'required|string|max:255',
        ], [
            'nombre.required'       => 'El nombre es obligatorio.',
            'apellidos.required'    => 'El apellido es obligatorio.',
            'telefono.required'     => 'El teléfono es obligatorio.',
            'documento_id.required' => 'El documento es obligatorio.',
            'cargo.required'        => 'El cargo es obligatorio.',
            'direccion.required'    => 'La dirección es obligatoria.',
        ]);
        if ($validator) {
            return $validator;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Persona::with(['Documento'])->where([['estado', 1], ['inactivo', 1]])->get();
        $list  = [];
        foreach ($model as $persona) {
            $persona->file_personas = $persona->Filepersonas()->get()->each(function ($file) {
                $file->path_url = url($file->File->path);
            });
            $persona->image = $persona->file_personas->first();
            $list[]         = $persona;
        }
        return $list;
    }
    public function inactivo()
    {
        $model = Persona::with(['Documento'])->where([['estado', 1], ['inactivo', 2]])->get();
        $list  = [];
        foreach ($model as $persona) {
            $persona->file_personas = $persona->Filepersonas()->get()->each(function ($file) {
                $file->path_url = url($file->File->path);
            });
            $persona->image = $persona->file_personas->first();
            $list[]         = $persona;
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
        try {
            $this->validateData($request);

            $persona               = new Persona();
            $persona->nombre       = $request->nombre;
            $persona->inactivo     = $request->inactivo;
            $persona->apellidos    = $request->apellidos;
            $persona->telefono     = $request->telefono;
            $persona->documento_id = $request->documento_id;
            $persona->cargo        = $request->cargo;
            $persona->garante      = $request->garante;
            $persona->doc          = $request->doc;
            $persona->direccion    = $request->direccion;
            $persona->cel_garante  = $request->cel_garante;
            $persona->dir_garante  = $request->dir_garante;
            $persona->tel_cor      = $request->tel_cor;
            $persona->save();

            return response()->json([
                'success' => 'Persona registrada correctamente.',
                'data'    => $persona,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        $persona->file_personas = $persona->Filepersonas()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        return $persona;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        try {
            $this->validateData($request);

            $persona->nombre       = $request->nombre;
            $persona->inactivo     = $request->inactivo;
            $persona->apellidos    = $request->apellidos;
            $persona->telefono     = $request->telefono;
            $persona->documento_id = $request->documento_id;
            $persona->cargo        = $request->cargo;
            $persona->garante      = $request->garante;
            $persona->doc          = $request->doc;
            $persona->direccion    = $request->direccion;
            $persona->cel_garante  = $request->cel_garante;
            $persona->dir_garante  = $request->dir_garante;
            $persona->tel_cor      = $request->tel_cor;
            $persona->save();

            return response()->json([
                'success' => 'Persona actualizada correctamente.',
                'data'    => $persona,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $existeRelacion = Contrato::where('persona_id', $persona->id)->exists() ||
        Filepersona::where('persona_id', $persona->id)->exists();

        if ($existeRelacion) {
            return response()->json(['error' => 'La persona está relacionada con otros registros y no puede ser eliminada.'], 400);
        }

        $persona->estado = 0;
        $persona->save();

        return response()->json(['success' => 'Persona eliminada correctamente.'], 200);
    }
    public function image(Request $request, $id)
    {
        $file = $request->file('file')->store('public/personas');
        $url  = Storage::url($file);

        $fileModel       = new File();
        $fileModel->path = $url;
        $fileModel->save();
        $filePersona                 = new Filepersona();
        $filePersona->file_id        = $fileModel->id;
        $filePersona->persona_id     = $id;
        $filePersona->tipoarchivo_id = $request->tipoarchivo_id;
        $filePersona->save();

        return $filePersona;
    }
    public function imageDelete($id)
    {
        $file         = Filepersona::find($id);
        $file->estado = 0;
        $file->save();
    }
}
