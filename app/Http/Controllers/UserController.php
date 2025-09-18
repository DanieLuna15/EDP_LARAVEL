<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Menu;
use App\Models\MenuRol;
use App\Models\Rol;
use App\Models\RolUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\UsuarioSucursal;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showDashboard()
    {
        $menuData = $this->menuRender(Auth::id());
        return view('index', ["menus" => $menuData['menus']]);
    }

    private function validateData(Request $request)
    {
        $validator = $request->validate([
            'nombre'    => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'usuario'   => 'required|string|max:100|unique:users,usuario,' . $request->id,
            'correo'    => 'required|email|max:255|unique:users,correo,' . $request->id,
            'password'  => 'required|string|min:6',
        ], [
            'nombre.required'    => 'El nombre es obligatorio.',
            'apellidos.required' => 'El apellido es obligatorio.',
            'usuario.required'   => 'El nombre de usuario es obligatorio.',
            'usuario.unique'     => 'El nombre de usuario ya está en uso.',
            'correo.required'    => 'El correo es obligatorio.',
            'correo.email'       => 'El formato del correo es inválido.',
            'correo.unique'      => 'El correo ya está registrado.',
            'password.required'  => 'La contraseña es obligatoria.',
            'password.min'       => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        return $validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles', 'permissions')->orderBy('id', 'asc')
            ->where('estado', 1)
            ->get()->makeHidden(['password', 'created_at', 'updated_at', 'deleted_at']);
        return $users;
    }
    public function login(Request $request)
    {
        $credentials = $request->only('usuario', 'password');
        if (! Auth::attempt($credentials)) {
            return response()->json(["success" => "false", "mensaje" => "Credenciales invalidas"], Response::HTTP_UNAUTHORIZED);
        }
        $ids = Auth::user()->id;
        /*CONTROL DE ACCESO AL SISTEMA*/
        $usuario = User::where('id', $ids)
            ->whereHas('permissions', function ($query) {
                $query->where('name', 'SISEP');
            })->first();
        if (empty($usuario)) {
            return response()->json(["success" => "false", "mensaje" => "El usuario no tiene acceso al sistema"], Response::HTTP_UNAUTHORIZED);
        }
        /*CONTROL DE VERIFICACION DE ROLES*/
        $roles = Auth::user()->getRoleNames();
        if (count($roles) > 0) {
        } else {
            return response()->json(["success" => "false", "mensaje" => "El usuario no tiene asignado un rol especifico para poder navegar en el sistema"], Response::HTTP_UNAUTHORIZED);
        }
        $user = $request->user();
        /*INSERCION LOG DE SEGURIDAD DE ACCESO*/
        $log          = new Log();
        $log->user_id = $user->id;
        $log->browser = $this->getBrowser($_SERVER['HTTP_USER_AGENT']);
        $log->ip      = $this->ip();
        $log->save();
        /*FIN DEL LOG*/
        $sucursal = Auth()->user()->getSellingPointSucursal();
        if (count($sucursal) > 0) {
        } else {
            return response()->json(["success" => "false", "mensaje" => "No tiene ninguna sucursal Asignada"], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json(["success" => "true", "mensaje" => "Bienvenido al Sistema", "data" => $user, "sucursal" => $sucursal], Response::HTTP_OK);
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
            $pass = $request->password;

            $user            = new User();
            $user->nombre    = $request->nombre;
            $user->apellidos = $request->apellidos;
            $user->usuario   = $request->usuario;
            $user->correo    = $request->correo;
            $user->password  = Hash::make($pass);
            $user->save();
            return response()->json(['success' => 'Usuario registrado correctamente.', 'data' => $user], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
    }

    public function getBrowser($user_agent)
    {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) {
            return 'Opera';
        } elseif (strpos($user_agent, 'Edge')) {
            return 'Edge';
        } elseif (strpos($user_agent, 'Chrome')) {
            return 'Chrome';
        } elseif (strpos($user_agent, 'Safari')) {
            return 'Safari';
        } elseif (strpos($user_agent, 'Firefox')) {
            return 'Firefox';
        } elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) {
            return 'Internet Explorer';
        }

        return 'Other';
    }
    public function ip()
    {

        $realIP = "Invalid IP Address";

        $activeHeaders = [];

        $headers = [
            "HTTP_CLIENT_IP",
            "HTTP_PRAGMA",
            "HTTP_XONNECTION",
            "HTTP_CACHE_INFO",
            "HTTP_XPROXY",
            "HTTP_PROXY",
            "HTTP_PROXY_CONNECTION",
            "HTTP_VIA",
            "HTTP_X_COMING_FROM",
            "HTTP_COMING_FROM",
            "HTTP_X_FORWARDED_FOR",
            "HTTP_X_FORWARDED",
            "HTTP_X_CLUSTER_CLIENT_IP",
            "HTTP_FORWARDED_FOR",
            "HTTP_FORWARDED",
            "ZHTTP_CACHE_CONTROL",
            "REMOTE_ADDR", #this should be the last option
        ];

        #Find active headers
        foreach ($headers as $key) {
            if (array_key_exists($key, $_SERVER)) {
                $activeHeaders[$key] = $_SERVER[$key];
            }
        }

        #Reemove remote address since we got more options to choose from
        if (count($activeHeaders) > 1) {
            unset($activeHeaders["REMOTE_ADDR"]);
        }

        #Pick a random item now that we have a secure way.
        $realIP = $activeHeaders[array_rand($activeHeaders)];

        #Validate the public IP
        if (filter_var($realIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $realIP;
        }

        return $realIP;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $request->merge(['id' => $user->id]); // Para excluir el usuario actual en validaciones únicas
            $this->validateData($request);
            $pass = $request->password;

            $user->nombre    = $request->nombre;
            $user->apellidos = $request->apellidos;
            $user->usuario   = $request->usuario;
            $user->correo    = $request->correo;
            $user->password  = Hash::make($pass);
            $user->save();

            return response()->json(['success' => 'Usuario actualizado correctamente.', 'data' => $user], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Verificar si el usuario que intenta eliminar es el mismo que está logueado
        if (Auth::id() === $user->id) {
            return response()->json([
                'error' => 'No puedes eliminar tu propio usuario mientras tienes la sesión activa.',
            ], 400);
        }
        $user->estado = 0;
        $user->save();
        return response()->json(['success' => 'Usuario eliminado correctamente.'], 200);
    }
    public function menuRender($usuarioId)
    {
        $rolUser = RolUser::where('usuario_id', $usuarioId)->first();

        if (!$rolUser) {
            return [];
        }

        $rolId = $rolUser->rol_id;

        $menuRoles = MenuRol::where('rol_id', $rolId)
            ->where('check', true)
            ->pluck('menu_id')
            ->toArray();

        if (empty($menuRoles)) {
            return [];
        }

        // Carga todos los menús y sus relaciones de forma recursiva
        // con un simple with() para que el modelo gestione la recursividad
        $menus = Menu::whereNull('menu_id')
            ->where('estado', '!=', 0)
            ->with('children')
            ->orderBy('order', 'asc')
            ->get();

        return $this->buildMenuTree($menus, $menuRoles);
    }

    private function buildMenuTree($menus, $menuRoles)
    {
        $resp = [];
        foreach ($menus as $menu) {
            if ((int) ($menu->estado ?? 0) !== 1) {
                continue;
            }
            $currentMenu = $menu->toArray();
            $currentMenu['sub_menu'] = []; // Inicializa la clave sub_menu como un array vacío

            // Llama recursivamente para construir el sub-árbol
            $subMenu = $this->buildMenuTree($menu->children, $menuRoles);

            // Si el sub-árbol no está vacío, lo asignamos
            if (!empty($subMenu)) {
                $currentMenu['sub_menu'] = $subMenu;
            }

            // Se incluye el menú si:
            // 1) Su ID está en la lista de roles asignados.
            // 2) O si tiene submenús válidos que se deben mostrar.
            if (in_array($menu->id, $menuRoles) || !empty($currentMenu['sub_menu'])) {
                $resp[] = $currentMenu;
            }
        }
        return $resp;
    }
    public function menuRol($rolId)
    {
        $menuRol_  = MenuRol::where('rol_id', $rolId)->where('check', true)->get()->pluck('menu_id');
        // Eager load nivel 1 y sus hijos (nivel 2)
        $menus_    = Menu::with(['subMenuN1' => function ($q) {
            $q->where('estado', '!=', 0)->orderBy('order', 'asc');
        }, 'subMenuN1.children' => function ($q) {
            $q->where('estado', '!=', 0)->orderBy('order', 'asc');
        }])->whereNull('menu_id')->where('estado', '!=', 0)->orderBy('order', 'asc')->get();

        $menusResp = [];
        foreach ($menus_ as $key => $value) {
            $subMenus = $value->subMenuN1;
            // Marca activos para nivel 1 y 2
            $subM_ = $this->verificaEstadoSubmenu($subMenus, $menuRol_);
            // Mantiene compatibilidad: adjunta sub_menu procesado y progreso
            $value->sub_menu = $subM_;
            $value->progreso = $this->progresoMenu($subM_);
            $menusResp[] = $value;
        }
        return ['menus' => $menusResp];
    }

    public function progresoMenu($menus)
    {
        $resp        = 0;
        $total       = count($menus);
        $countActive = 0;

        foreach ($menus as $key => $value) {
            if ($value->active) {
                $countActive = $countActive + 1;
            }
        }

        if ($countActive == 0) {
            return ['porcentaje' => $resp, 'countActive' => $countActive, 'total' => $total]; //.'/'.$countActive.' : '. $resp;
        } else {
            $resp = 100 / ($total / $countActive);
            return ['porcentaje' => $resp, 'countActive' => $countActive, 'total' => $total]; //.'/'.$countActive.' : '. $resp;
        }
    }

    /**
     * Construye un árbol de menús recursivamente, filtrando por permisos.
     *
     * @param \Illuminate\Database\Eloquent\Collection $menus
     * @param array $menuRoles
     * @return array
     */
    public function verificaEstadoSubmenu($subMenus, $arrayMenuUser)
    {
        $resp = [];
        if (!is_array($subMenus)) {
            foreach ($subMenus as $key => $value) {
                // Activo si el menú está asignado al rol
                $value->active = in_array($value->id, $arrayMenuUser->toArray());

                // Si tiene hijos cargados, marcar también sus estados de forma recursiva
                if (method_exists($value, 'relationLoaded') && $value->relationLoaded('children')) {
                    $children = $value->children;
                    if ($children) {
                        $this->verificaEstadoSubmenu($children, $arrayMenuUser);
                    }
                }

                $resp[] = $value;
            }
        }
        return $resp;
    }

    public function quitarSistema(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->syncRoles([]);
            $user->revokePermissionTo('SISEP');
            $user->save();
            return response()->json(["success" => "true", "mensaje" => "Se quito el acceso correctamente", "data" => $user]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response()->json(["success" => "false", "mensaje" => $ex]);
        }
    }

    public function agregarSistema(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->givePermissionTo('SISEP');
            return response()->json(["success" => "true", "mensaje" => "Se dio  acceso al sistema", "data" => $user]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response()->json(["success" => "false", "mensaje" => $ex->getMessage()]);
        }
    }

    public function rolUser($userId)
    {
        $rolUser_     = RolUser::where('usuario_id', $userId)->first();
        $usuarioRolId = null;
        if ($rolUser_ != null) {
            $usuarioRolId = $rolUser_->rol_id;
        }
        $roles_ = Rol::all();
        return ['roles' => $roles_->toArray(), 'rolUser' => $usuarioRolId];
    }

    public function asignarPuntoVenta($usarioId, $puntoVentaId)
    {
        $puntoventaUsers = UsuarioSucursal::where('user_id', $usarioId)->first();
        if ($puntoventaUsers != null) {
            $puntoVenta = UsuarioSucursal::find($puntoventaUsers->id);
            $puntoVenta->sucursal_id = $puntoVentaId;
            $puntoVenta->user_id = $usarioId;
            $puntoVenta->usr_modificado = Auth::user()->id;
            $puntoVenta->save();
        } else {
            $puntoVenta = new UsuarioSucursal();
            $puntoVenta->sucursal_id = $puntoVentaId;
            $puntoVenta->user_id = $usarioId;
            $puntoVenta->usr_registrado = Auth::user()->id;
            $puntoVenta->save();
        }
        return $puntoVenta;
    }
}
