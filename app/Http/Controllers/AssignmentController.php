<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;

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
        $a = $course->assignments()->where('id', $assignment->id)->get();

        if($a->isEmpty())
        {
            abort('404');
        }

        //Assignment variables
        $aName = $assignment->name;
        $aDescription = $assignment->description;
        $aDue = $assignment->due;
        $aStart = $assignment->start;

        //Course variables
        $cName = $course->name;

        return view('assignments.show', compact('cName', 'aName', 'aDescription', 'aDue', 'aStart'));
    }

    public function new(Course $course)
    {
        $cName = $course->name;
        return view('assignments.new', compact('cName', 'course'));
    }

    public function store(Course $course, Request $request)
    {
        $a = new Assignment;

        if($course->id == 0){
            abort(404);
        }
        
        if($request->aName == "" || $request->aDescription == "" || $request->aDueDate < Carbon::now()){
            return back()->withInput();
        }

        $a->course_id = $course->id;
        $a->slug = $request->aName;
        $a->description = $request->aDescription;
        $a->start = Carbon::now();
        $a->due = $request->aDueDate;
        $a->name = $request->aName;
        $a->save();

        return redirect()->action('AssignmentController@show', [$course, $a]);
    }
}