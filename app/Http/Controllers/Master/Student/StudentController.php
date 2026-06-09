<?php

namespace App\Http\Controllers\Master\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('major')->get();
        $majors = \App\Models\Majors::where('is_active', 1)->get();
        $title = 'Student Management';
        return view('Master.Student.index', compact('students', 'majors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('student.index');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'student_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'is_active' => 'required|in:1,0',
        ]);

        Student::create([
            'major_id' => $request->major_id,
            'student_name' => $request->student_name,
            'phone' => $request->phone,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('student.index')->with('success', 'Student created successfully!');
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
        return redirect()->route('student.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'student_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'is_active' => 'required|in:1,0',
        ]);

        $student->major_id = $request->major_id;
        $student->student_name = $request->student_name;
        $student->phone = $request->phone;
        $student->is_active = $request->is_active;

        $student->save();

        if ($student->is_active == 0) {
            // Release assigned locker and set status to Available
            \App\Models\Locker::where('student_id', $student->id)->update([
                'student_id' => null,
                'locker_status' => 'Available'
            ]);
        } else {
            // Keep owner name synchronized
            \App\Models\Locker::where('student_id', $student->id)->update([
                'locker_name' => $student->student_name
            ]);
        }

        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }
}
