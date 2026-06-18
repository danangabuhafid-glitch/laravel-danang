<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Menu;

class CheckMenuPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('signin');
        }

        // If the user does not have a role, they have no permissions
        if (!$user->role_id) {
            abort(403, 'Unauthorized action. You have no role assigned.');
        }

        $routeName = $request->route()?->getName();
        if (!$routeName) {
            return $next($request);
        }

        // Find if this route or its resource base is defined in the menus table
        $baseRoute = $routeName;
        if (str_contains($routeName, '.')) {
            $parts = explode('.', $routeName);
            if (in_array(end($parts), ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'])) {
                array_pop($parts);
                $baseRoute = implode('.', $parts);
            }
        }

        // Check if there is a menu associated with this route
        $menu = Menu::where(function($query) use ($routeName, $baseRoute) {
            $query->where('route', $routeName)
                  ->orWhere('route', 'like', $baseRoute . '.%');
        })->first();

        // If the route is not registered as a menu, allow access
        if (!$menu) {
            return $next($request);
        }

        // Check if the user's role is allowed to access this menu
        $hasPermission = $user->role->menus()->where('menus.id', $menu->id)->exists();

        if (!$hasPermission) {
            abort(403, 'Unauthorized action. You do not have permission to access this page.');
        }

        return $next($request);
    }
}
