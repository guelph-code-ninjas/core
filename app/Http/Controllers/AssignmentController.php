<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;

include "fileValidator.php";
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
        //and the current time in EST. Remaining is sent as a fromatted string into the view
        if($interval->y != 0)
            $remaining .= "Years: " . $interval->y;
        if($interval->m != 0)
            $remaining .= " Months: " . $interval->m;
        if($interval->d != 0)
            $remaining .= " Days: " . $interval->d;
        $remaining .= " - " . $interval->h . ":" . $interval->i . ":" . $interval->s;

        return view('assignments.show', compact('cName', 'aName', 'aDescription', 'aDue', 'aStart', 'aSimilarity', 'remaining'));
    }

    public function fileCheck(Assignment $assignment){         
        $result = $assignment->description; 
        return view('assignments.test', compact('result'));
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

        //File validator
       $fileName = $_FILES['aFile']['name'];

        if(typeCheck($fileName, array('zip','php'))){
            $a->description = "True";
        } 
        else{
            $a->description = "False";
        }
        return redirect()->action('AssignmentController@fileCheck', $a);
    }
}