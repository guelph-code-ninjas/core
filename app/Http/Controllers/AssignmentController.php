<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;

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
    public function show($courseID, $assignmentID)
    {
        return view('assignments.show', compact('courseID', 'assignmentID'));
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