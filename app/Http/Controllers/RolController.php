<?php
namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\RolUser;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::orderBy('id', 'desc')->get();
        return $roles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id) {
            $rol       = Rol::find($request->id);
            $rol->name = $request->name;
            $rol->save();
        } else {
            $rol             = new Rol();
            $rol->name       = $request->name;
            $rol->guard_name = 'web';
            $rol->save();
        }
        return response()->json(["success" => "true", "mensaje" => "datos registrados", "data" => $rol]);
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
        $input     = $request->all();
        $rol       = Rol::find($id);
        $rol->name = $input['name'];
        $rol->save();

        return $rol;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rolUser = RolUser::where('rol_id', $id)->get();
        $total   = count($rolUser);

        if ($total != 0) {
            $result = [
                'code'    => 406,
                'message' => "El rol esta asignado a un usuario ",
            ];
            return response()->json($result, 406);
        } else {
            $rol = Rol::find($id);
            $rol->delete();
            return "delete";
        }
    }

}
