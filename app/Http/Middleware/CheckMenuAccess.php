<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\MenuRol;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * If the authenticated user's role does not have access (via menu_roles)
     * to a menu whose route matches the current path, forbid the request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->guest('login');
        }

        // Normalize current path (no leading slash)
        $path = trim($request->path(), '/');

        // Allow home dashboard and blank path by default
        if ($path === '' || $path === '/') {
            return $next($request);
        }

        // If the request is clearly API/AJAX/json, skip this check
        if ($request->expectsJson() || $request->ajax() || strpos($path, 'api/') === 0) {
            return $next($request);
        }

        // Retrieve the first role via Spatie (system assumes single-role per user)
        $role = $user->roles()->select('id', 'name')->first();
        if (! $role) {
            // No role assigned: block navigation to protected areas
            abort(403, 'No tiene rol asignado para acceder.');
        }

        // Get allowed menu ids for this role
        $menuIds = MenuRol::where('rol_id', $role->id)
            ->where('check', true)
            ->pluck('menu_id')
            ->toArray();

        if (empty($menuIds)) {
            abort(403, 'No tiene acceso a menús.');
        }

        // Only gather routes that are explicitly assigned to the role
        $allowed = Menu::whereIn('id', $menuIds)
            ->pluck('route')
            ->filter(function ($route) {
                return is_string($route) && trim($route) !== '';
            })
            ->map(function ($route) {
                return trim($route, '/');
            })
            ->unique()
            ->values()
            ->all();

        // Compare current path with allowed prefixes
        foreach ($allowed as $prefix) {
            if ($prefix === '') continue;
            if ($path === $prefix || strpos($path, $prefix . '/') === 0) {
                return $next($request);
            }
        }

        abort(403, 'No tiene permisos para acceder a esta ruta.');
    }
}
