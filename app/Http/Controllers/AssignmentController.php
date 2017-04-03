<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $a = new Assignment;
        
    }
}