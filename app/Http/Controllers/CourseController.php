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
    public function show($courseID)
    {
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

        // create slug
        $slug = $request->courseName . '_' . $request->courseSemester . '_' . $request->courseSection;
        //store data into the database
        $c = new Course;
        $c->name = $request->courseName;
        $c->slug = $slug; 
        $c->save();

      //  $url = route('course', ['courseID' => 1]);
        $url = route('home');
        return redirect()->route('home');

       // return redirect()->route('course');
    }
}
