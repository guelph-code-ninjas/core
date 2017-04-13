<?php

namespace App\Http\Controllers;

use App\Course;
use App\Assignment;
use Illuminate\Support\Facades\DB;
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
        $assignments = DB::table('assignments')->select('id', 'name', 'due', 'similarity')->where('course_id', $course->id)->get();

        $courseID = $course->name;
        $slug = $course->slug;

        return view('courses.show', compact('courseID', 'slug'), ['assignments' => $assignments]);
    }

    /**
    * Show the course registration page
    *
    * @return
    */
    public function showRegistration()
    {
        return view('courses.register');
    }

    /**
    * Show the course settings page
    *
    * @return
    */
    public function enroll(Course $course)
    {
        $users = DB::table('users')->select('id', 'name', 'email')->get();
        $courses = DB::table('courses')->select('slug')->get();

        return view('courses.enroll', ['users' => $users], ['course' => $course]);
    }

    /**
    * Save data from settings page into database
    *
    * @return
    */
    public function storeSettings()
    {
        
    }

    /**
     * Stores the course registration information into the database
     *
     * @return redirection to the new course page
     */
    public function store(Request $request)
    {
        // validate the input before storing it into the database
        $this->validate($request,[
            'courseName' => 'required',
            'courseSemester' => 'required',
            'courseSection' => 'required'
        ]);

        // if any of the fields are null, bring them back to the registration page (did not select an option)
        if($request->courseName == null || $request->courseSemester == null || $request->courseSection == null) {
            return back()->withInput();
        }

        // create slug
        $slug = $request->courseName . '_' . $request->courseSemester . '_' . $request->courseSection;

        // sanitize the slug

        //store data into the database
        $c = new Course;
        $c->name = $request->courseName;
        $c->slug = $slug;
        $c->save();

        return redirect()->action('CourseController@show', $c);
    }

    /**
     * Shows the assignments for a specified course on the course page
     *
     *
     */
    public function displayAssignments() {

        $assignments = DB::table('assignments')->pluck('name');

        foreach($assignments as $assignment)
            echo $assignment;


        return view('courses.show', ['assignments' => $assignments]);
    }
}
