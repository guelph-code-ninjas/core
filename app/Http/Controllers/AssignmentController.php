<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AssignmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the given assignment.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Assignment $assignment)
    {

        //$c = Course::where('id', $courseID)->get()[0];
        //$a = $c->assignments()->get();
        //$a = Assignment::where('id', $assignmentID)->get()[0];
        $a = $course->assignments()->where('id', $assignment->id)->get();

        if($a->isEmpty()){
            //Throw 404
            abort('404');
        }

        //Assignment variables
        $aName = $assignment->name;
        $aDescription = $assignment->description;
        $aDue = $assignment->due;

        //Course variables
        $cName = $course->name;
        
        return view('assignments.show', compact('cName', 'aName', 'aDescription', 'aDue'));
    }

    public function new($courseID)
    {
        return view('assignments.new', compact('courseID'));
    }

    public function store($courseID, Request $request)
    {
        $a = new Assignment;
        $a->course_id = $courseID;
        $a->slug = $request->aName;
        $a->description = $request->aDescription;
        $a->start = $request->aDueDate;
        $a->due = $request->aDueDate;
        $a->name = $request->aName;
        $a->save();
    }
}