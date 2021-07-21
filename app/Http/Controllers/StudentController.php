<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index',compact('students'))
        ->with('i',(request()->input('page', 1) -1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
           $validated = $request->validate([
                'studname' => 'required|unique:students|max:255',
                'course' => 'required|unique:students|max:255',
               'fee' => 'required|unique:students|max:255',
                
            ]);
      
       $student_details = new Student;
       $student_details -> id = $request-> id;
    $student_details -> studname = $request-> studname;
       $student_details -> course = $request-> course;
       $student_details -> fee = $request-> fee;
       $student_details -> save();
      return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view ('student.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view ('students.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
       
        $request->validate([
            'studname' => 'required',
            'course' => 'required',
            'fee' => 'required'
        ]);
        $student->studname = $request->studname;
        $student->course = $request->course;
        $student->fee = $request->fee;
        $student->save();
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //$student = Student::findOrFail('student');
        $student->delete();

        return redirect('/students')->with('completed', 'Student has been deleted');
    }
}
