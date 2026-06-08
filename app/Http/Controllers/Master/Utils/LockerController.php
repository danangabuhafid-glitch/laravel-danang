<?php

namespace App\Http\Controllers\Master\Utils;

use App\Http\Controllers\Controller;
use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LockerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Locker Management';
        $lockers = DB::table('lockers')->get();
        return view('admin.locker.index', compact('lockers', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
     return redirect()->route('locker.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'locker_code' => 'required|string|max:5|unique:lockers,locker_code',
            'locker_name' => 'nullable|string|max:60',
            'locker_description' => 'nullable|string|max:255',
            'major' => 'required|in:Web Programming,Multimedia,Teknik Jaringan',
            'locker_status' => 'required|in:Available,Unavailable,Damaged,Missing',
            'batch' => 'required|in:1,2,3',
        ]);

        Locker::create([
            'locker_code' => $request->locker_code,
            'locker_name' => $request->locker_name,
            'locker_description' => $request->locker_description,
            'major' => $request->major,
            'locker_status' => $request->locker_status,
            'batch' => $request->batch,
        ]);

        return redirect()->route('locker.index')->with('success', 'Locker created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       return redirect()->route('locker.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'locker_code' => 'required|string|max:5|unique:lockers,locker_code,' . $id,
            'locker_name' => 'nullable|string|max:60',
            'locker_description' => 'nullable|string|max:255',
            'major' => 'required|in:Web Programming,Multimedia,Teknik Jaringan',
            'locker_status' => 'required|in:Available,Unavailable,Damaged,Missing',
            'batch' => 'required|in:1,2,3',
        ]);

        Locker::where('id', $id)->update([
            'locker_code' => $request->locker_code,
            'locker_name' => $request->locker_name,
            'locker_description' => $request->locker_description,
            'major' => $request->major,
            'locker_status' => $request->locker_status,
            'batch' => $request->batch,
        ]);

        return redirect()->route('locker.index')->with('success', 'Locker updated successfully!');
    }

    /**
     * Check if a locker code is available.
     */
    public function checkCode(Request $request)
    {
        $code = $request->query('locker_code');
        $id = $request->query('id');

        $query = Locker::where('locker_code', $code);
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
    $locker = Locker::find($id);
    $locker->delete();
    return redirect()->route('locker.index')->with('success', 'Locker deleted successfully!');
    }
}
