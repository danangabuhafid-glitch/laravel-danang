<?php

namespace App\Http\Controllers\Master\Major;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Majors;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Majors::all();
        $title = 'Major Management';
        return view('Master.Major.index', compact('majors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('major.index');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|in:1,0',
        ]);

        Majors::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('major.index')->with('success', 'Major created successfully!');
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
        return redirect()->route('major.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $major = Majors::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|in:1,0',
        ]);

        $major->name = $request->name;
        $major->is_active = $request->is_active;

        $major->save();

        return redirect()->route('major.index')->with('success', 'Major updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $major = Majors::findOrFail($id);
        $major->delete();

        return redirect()->route('major.index')->with('success', 'Major deleted successfully!');
    }
}
