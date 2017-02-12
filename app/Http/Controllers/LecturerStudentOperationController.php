<?php

namespace App\Http\Controllers;

use App\Enrollment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class LecturerStudentOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //view profile student
    public function index($id)
    {
        $student = User::find($id);
        $classesEnrolled = Enrollment::join('classrooms', 'enrollments.classroom_id', '=', 'classrooms.classroom_id')
            ->join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->select('enrollments.*')
            ->where('enrollments.user_id', $student->id, 'AND')->where('enrollments.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->get();
//        dd($student);
        return view('users.lecturer.students.viewStudent')
            ->with('student', $student)
            ->with('classesEnrolled', $classesEnrolled);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
