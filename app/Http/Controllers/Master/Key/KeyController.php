<?php

namespace App\Http\Controllers\Master\Key;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keys;

class KeyController extends Controller
{
    public function index()
    {
        $keys = Keys::with('locker')->get();
        $title = 'Key Management';
        return view('Master.Key.index', compact('keys', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('key.index');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:keys,name',
            'is_active' => 'required|in:1,0',
        ]);

        Keys::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('key.index')->with('success', 'Key created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->route('key.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $key = Keys::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:keys,name,' . $id,
            'is_active' => 'required|in:1,0',
        ]);

        $key->name = $request->name;
        $key->is_active = $request->is_active;

        $key->save();

        return redirect()->route('key.index')->with('success', 'Key updated successfully!');
    }

    /**
     * Check if a key name is available.
     */
    public function checkName(Request $request)
    {
        $name = $request->query('name');
        $id = $request->query('id');

        $query = Keys::where('name', $name);
        if ($id) {
            $query->where('id', '!=', $id);
        }

        $exists = $query->exists();

        return response()->json([
            'available' => !$exists
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $key = Keys::findOrFail($id);
        $key->delete();

        return redirect()->route('key.index')->with('success', 'Key deleted successfully!');
    }
}
