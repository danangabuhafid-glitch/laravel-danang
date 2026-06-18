<?php

namespace App\Http\Controllers\Master\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        
        // Default to the first role if none is selected
        $selectedRoleId = $request->get('role_id', $roles->first()?->id);
        $selectedRole = Role::findOrFail($selectedRoleId);

        // Fetch parent menus with active status
        $menus = Menu::with(['submenus' => function($query) {
            $query->where('is_active', 1)->orderBy('order');
        }])
        ->whereNull('parent_id')
        ->where('is_active', 1)
        ->orderBy('order')
        ->get();

        // Get the list of menu IDs currently assigned to this role
        $assignedMenuIds = $selectedRole->menus()->pluck('menus.id')->toArray();

        $title = 'Role Permissions';

        return view('Master.RolePermission.index', compact('roles', 'selectedRole', 'menus', 'assignedMenuIds', 'title'));
    }

    /**
     * Store the role permissions.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'menu_ids' => 'nullable|array',
            'menu_ids.*' => 'exists:menus,id',
        ]);

        $role = Role::findOrFail($request->role_id);
        
        // Sync the menus
        $role->menus()->sync($request->menu_ids ?? []);

        return redirect()->route('role-permission.index', ['role_id' => $role->id])
            ->with('success', 'Permissions updated successfully for role: ' . $role->role_name);
    }
}
