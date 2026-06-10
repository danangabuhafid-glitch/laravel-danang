<?php

namespace App\Http\Controllers\Master\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Instructor;
use App\Models\User;
use App\Models\role;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::with('major')->get();
        $majors = \App\Models\Majors::where('is_active', 1)->get();
        $title = 'Instructor Management';
        return view('Master.Instructor.index', compact('instructors', 'majors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('instructor.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'instructor_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'is_active' => 'required|in:1,0',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $instructorRole = \App\Models\role::firstOrCreate(
                ['role_name' => 'Instructor'],
                ['is_active' => 'active']
            );

            $user = User::create([
                'name' => $request->instructor_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $instructorRole->id,
            ]);

            Instructor::create([
                'user_id' => $user->id,
                'major_id' => $request->major_id,
                'instructor_name' => $request->instructor_name,
                'phone' => $request->phone,
                'is_active' => $request->is_active,
            ]);

            DB::commit();
            return redirect()->route('instructor.index')->with('success', 'Instructor created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
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
        return redirect()->route('instructor.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $instructor = Instructor::findOrFail($id);

        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'instructor_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'is_active' => 'required|in:1,0',
        ]);

        $instructor->major_id = $request->major_id;
        $instructor->instructor_name = $request->instructor_name;
        $instructor->phone = $request->phone;
        $instructor->is_active = $request->is_active;

        $instructor->save();

        return redirect()->route('instructor.index')->with('success', 'Instructor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();

        return redirect()->route('instructor.index')->with('success', 'Instructor deleted successfully!');
    }
}
