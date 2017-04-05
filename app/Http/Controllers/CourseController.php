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
    public function new()
    {
        return view('courses.courseregistration');
    }

    public function store(Request $request, $courseID)
    {
        // validate the input before storing it into the database
        $this->validate($request,[
            'courseName' => 'required',
            'courseSemester' => 'required',
            'courseSection' => 'required'
        ]);

        // sanitize the slug

        // if any of the fields are null, bring them back to the registration page (did not select an option)
        if($request->courseName == null || $request->courseSemester == null || $request->courseSection == null) {

            return back()->withInput();
        }

        // create slug
        $slug = $request->courseName . '_' . $request->courseSemester . '_' . $request->courseSection;

        //store data into the database
        $c = new Course;
        $c->name = $request->courseName;
        $c->slug = $slug; 
        $c->save();

        return redirect()->action('CourseController@show', [$c->id]);
    }
}
