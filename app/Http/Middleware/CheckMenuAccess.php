<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\MenuRol;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMenuAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->guest('login');
        }

        // Normaliza ruta actual con slash inicial y sin querystring
        $current = '/' . ltrim($request->path(), '/'); // ej: /pp/detalle/3

        // Permite home y vacío
        if ($current === '/' || $current === '') {
            return $next($request);
        }

        // Sáltate API/AJAX/JSON
        if ($request->expectsJson() || $request->ajax() || str_starts_with($current, '/api/')) {
            return $next($request);
        }

        // Rol del usuario (asumes un solo rol)
        $role = $user->roles()->select('id', 'name')->first();
        if (! $role) {
            abort(403, 'No tiene rol asignado para acceder.');
        }

        // Menús habilitados para el rol
        $menuIds = MenuRol::where('rol_id', $role->id)
            ->where('check', true)
            ->pluck('menu_id');

        if ($menuIds->isEmpty()) {
            abort(403, 'No tiene acceso a menús.');
        }

        // Rutas permitidas como plantillas (ej: "pp/detalle/{id}")
        $templates = Menu::whereIn('id', $menuIds->all())
            ->pluck('route')
            ->filter(fn($r) => is_string($r) && trim($r) !== '')
            ->map(fn($r) => '/' . ltrim(trim($r), '/'))   // asegúrate de leading slash
            ->unique()
            ->values()
            ->all();

        // ¿Alguna plantilla hace match con la URL actual?
        foreach ($templates as $tpl) {
            $pattern = $this->compileTemplateToRegex($tpl); // convierte {id} a ([^/]+)
            if (preg_match($pattern, $current)) {
                return $next($request);
            }
        }

        abort(403, 'No tiene permisos para acceder a esta ruta.');
    }

    /**
     * Convierte "/pp/detalle/{id}" en regex "/^\/pp\/detalle\/([^\/]+)\/?$/"
     */
    protected function compileTemplateToRegex(string $tpl): string
    {
        // Normaliza con slash inicial
        $tpl = '/' . ltrim($tpl, '/');

        // Si termina en /*, autoriza TODO el subárbol
        if (str_ends_with($tpl, '/*')) {
            $base = substr($tpl, 0, -2); // sin /*
            $baseQuoted = preg_quote($base, '/');
            // ^/ventas/chofers(?:/.*)?$  → permite /ventas/chofers y cualquier cosa debajo
            return '/^' . $baseQuoted . '(?:\/.*)?$/';
        }

        // Caso normal: placeholders {id}
        $quoted = preg_quote($tpl, '/');
        // {param} → ([^/]+)
        $quoted = preg_replace('/\\\\\{[A-Za-z_][A-Za-z0-9_]*\\\\\}/', '([^\/]+)', $quoted);

        // Slash final opcional
        return '/^' . $quoted . '\/?$/';
    }
}
