<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $aSimilarity = $assignment->similarity;
        $remaining = "";

        //Course variables
        $cName = $course->name;

        //Calculations
        $currentTime = Carbon::now();
        $interval = date_diff($currentTime, new \DateTime($aDue));

        //This calculates the difference between the assignment due date
        //and the current time in EST. Remaining is sent as a formatted string into the view
        if($interval->y != 0)
            $remaining .= "Years: " . $interval->y;
        if($interval->m != 0)
            $remaining .= " Months: " . $interval->m;
        if($interval->d != 0)
            $remaining .= " Days: " . $interval->d;
        $remaining .= " - " . $interval->h . ":" . $interval->i . ":" . $interval->s;

        return view('assignments.show', compact('cName', 'aName', 'aDescription', 'aDue', 'aStart', 'aSimilarity', 'remaining', 'course', 'assignment'));
    }

    public function register(Course $course)
    {
        $cName = $course->name;
        return view('assignments.register', compact('cName', 'course'));
    }

    public function settings(Course $course)
    {
        $cName = $course->name;
        return view('assignments.settings', compact('cName', 'course'));
    }

    public function submit(Course $course, Assignment $assignment, Request $request)
    {
        $courses = DB::table('courses')->select('slug')->get();

        //Variables for general course and assignment information
        $aName = $assignment->name;
        $cName = $course->name;

        //Variables for submission
        $sTime = Carbon::now();
        $sName = $request->sName;
        $sComments = $request->sComments;

        //Submission difference calculation
        $sRemaining = "";
        $sRemainingAttach = "";
        $sRemainingColor = "";
        
        //Getting user ID
        $userID = Auth::id();
        $userIDCheck = DB::table('courses_users')->where('user_id', $userID)->value('course_id');

        //Check if user is enrolled in the course
        if($userIDCheck != $course->id){
            abort('403');
        }

        //Checks the difference between due date and submission time
        //Also sets the text color of the difference and determines whether
        //the submission is early or late.
        if ($sTime > $assignment->due){
            $interval = date_diff($sTime, new \DateTime($assignment->due));
            $sRemainingAttach = " late";
            $sRemainingColor = "red";
        }else{
            $interval = date_diff(new \DateTime($assignment->due), $sTime);
            $sRemainingAttach = " early";
            $sRemainingColor = "green";
        }
        
        //Format the remaining time calculated above
        if($interval->y != 0)
            $sRemaining .= $interval->y . " year(s) ";
        if($interval->m != 0)
            $sRemaining .= $interval->m . " month(s) ";
        if($interval->d != 0)
            $sRemaining .= $interval->d . " days(s)";
        
        $sRemaining .= " - " . $interval->h . " hour(s) " . $interval->i . " minute(s) " . $interval->s . " second(s) " . $sRemainingAttach;


        return view ('assignments.submit', compact('cName', 'aName', 'sTime', 'sName', 'sComments', 'sRemaining', 'sRemainingColor', 'test', 'course', 'assignment'));
    }

    public function store(Course $course, Request $request)
    {
        $a = new Assignment;

        //If there is no course id, direct to 404 page
        if($course->id == 0){
            abort(404);
        }
        
        //Error checking the fields to see if the required fields are empty, if so, redirect back with all the information
        if($request->aName == "" || $request->aDescription == "" || $request->aDueDate < Carbon::now()){
            return back()->withInput();
        }

        //Storing all the data into the variable a and saving it into the database
        $a->course_id = $course->id;
        $a->slug = str_replace(' ', '-', $request->aName);
        $a->description = $request->aDescription;
        $a->start = Carbon::now();
        $a->due = $request->aDueDate;
        $a->name = $request->aName;
        $a->similarity = $request->aSimilarity;
        $a->save();

        return redirect()->action('AssignmentController@show', [$course, $a]);
    }
}