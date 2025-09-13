<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Filesucursal;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\UsuarioSucursal;
use Auth;
class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model =  Sucursal::with(['Documento'])->where('estado',1)->get();
        $list = [];
        foreach($model as $sucursal){
            $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function($file){
                $file->path_url = url($file->File->path);
            });
            $sucursal->image = $sucursal->file_sucursals->first();
            $list[] = $sucursal;
        }
        return $list;
    }

    public function listar_punto_sesion(){
        $sucursales = Sucursal::get();
        return response()->json(["success"=>"true","data"=>$sucursales,"mensaje"=>"datos encontrados"]);
    }
    
    public function punto_venta_user($userId) {//listado de sucursal asignada
        $puntoVenta = UsuarioSucursal::where('user_id', $userId)->first();
        return $puntoVenta;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucursal = new Sucursal();
        $sucursal->nombre = $request->nombre;
        $sucursal->telefono = $request->telefono;
        $sucursal->documento_id = $request->documento_id;
        $sucursal->email = $request->email;
        $sucursal->doc = $request->doc;
        $sucursal->direccion = $request->direccion;
        $sucursal->encargado = $request->encargado;
        $sucursal->medidor = $request->medidor;
        $sucursal->responsable = $request->responsable;
        $sucursal->save();
        return $sucursal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        $sucursal->file_sucursals = $sucursal->Filesucursals()->get()->each(function($file){
            $file->path_url = url($file->File->path);
        });
        return $sucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $sucursal->nombre = $request->nombre;
        $sucursal->telefono = $request->telefono;
        $sucursal->documento_id = $request->documento_id;
        $sucursal->email = $request->email;
        $sucursal->doc = $request->doc;
        $sucursal->direccion = $request->direccion;
        $sucursal->encargado = $request->encargado;
        $sucursal->medidor = $request->medidor;
        $sucursal->responsable = $request->responsable;
        $sucursal->save();
        return $sucursal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        $sucursal->estado = 0;
        $sucursal->save();
    }
    public function image(Request $request,$id)
        {
         

            $file = $request->file('file')->store('public/sucursals');
            $url = Storage::url($file);

            $fileModel = new File();
            $fileModel->path = $url;
            $fileModel->save();
            $filesucursal = new Filesucursal();
            $filesucursal->file_id = $fileModel->id;
            $filesucursal->sucursal_id = $id;
            $filesucursal->tipoarchivo_id = $request->tipoarchivo_id;
            $filesucursal->save();
           
            return $filesucursal;
        }
        public function imageDelete($id)
        {
            $file = Filesucursal::find($id);
            $file->estado = 0;
            $file->save();
        }
}
