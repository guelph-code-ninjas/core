<?php

namespace App\Http\Controllers;

use App\Course;
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
    public function show(Course $course)
    {
        $courseID = $course->name;
        return view('courses.show', compact('courseID'));
    }

    /**
    * Show the course registration page
    *
    * @return
    */
    public function showRegistration()
    {
        return view('courses.courseregistration');
    }

    public function store(Request $request)
    {
        // validate the input before storing it into the database

        // sanitize the slug

        //store data into the database
        $c = new Course;
        $c->name = $request->courseName;
        $c->slug = $request->courseID;
        $c->save();
    }
}
