<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolUser;
use App\Models\User;
use App\Models\Rol;
// use App\Models\User;
class RolUserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->only(['rol_id', 'usuario_id']);
        $request->validate([
            'rol_id' => 'required|integer',
            'usuario_id' => 'required|integer',
        ]);
        try {
            // Validar que el rol exista
            $role = Rol::find($data['rol_id']);
            if (! $role) {
                return response()->json([
                    'message' => 'Rol no encontrado',
                ], 422);
            }

            // Crear o actualizar registro en tabla propia
            $rolUser = RolUser::where('usuario_id', $data['usuario_id'])->first();
            if ($rolUser) {
                $rolUser->rol_id = $data['rol_id'];
                $rolUser->save();
            } else {
                $rolUser = RolUser::create($data);
            }

            // Sincronizar también con Spatie (model_has_roles)
            $user = User::find($data['usuario_id']);
            if ($user) {
                $user->syncRoles([$role->name]);
            }

            return response()->json($rolUser, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'No se pudo asignar el rol',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_user_password(Request $request)
    {
        //return $request->all();
        try {
            $usuario                   = User::find($request->id);
            $usuario->password         = bcrypt($request->password);
            $usuario->usr_new_password = $request->password;
            $usuario->name             = $usuario->name;
            $usuario->usr_usuario      = $usuario->usr_usuario;
            $usuario->email            = $usuario->email;
            $usuario->save();
            return response()->json(["success" => "true", "mensaje" => "Contraseña Actualizada", "data" => $usuario]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response()->json(["success" => "false", "mensaje" => "No se pudo actualizar la contraseña intente nuevamente", "data" => $ex]);
        }
    }
}
