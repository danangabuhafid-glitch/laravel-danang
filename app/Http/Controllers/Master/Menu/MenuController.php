<?php

namespace App\Http\Controllers\Master\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('parent')->orderBy('parent_id')->orderBy('order')->get();
        $parentMenus = Menu::whereNull('parent_id')->orderBy('order')->get();
        $title = 'Menu Management';
        
        return view('Master.Menu.index', compact('menus', 'parentMenus', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('menu.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'required|integer|min:0',
            'is_active' => 'required|in:1,0',
        ]);

        Menu::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'route' => $request->route,
            'parent_id' => $request->parent_id ?: null,
            'order' => $request->order,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('menu.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->route('menu.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id|different:id',
            'order' => 'required|integer|min:0',
            'is_active' => 'required|in:1,0',
        ]);

        $menu->name = $request->name;
        $menu->icon = $request->icon;
        $menu->route = $request->route;
        $menu->parent_id = $request->parent_id ?: null;
        $menu->order = $request->order;
        $menu->is_active = $request->is_active;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully!');
    }
}
