<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
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
     * Show the given course.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($courseID)
    {
        return view('courses.show', compact('courseID'));
    }
}
