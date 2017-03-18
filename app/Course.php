<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Course extends Model 
{
    public function persons()
    {
        return $this->belongsToMany('App\User', 'courses_users',
            'course_id', 'user_id')->withPivot('role');

    }

    // Register a user for a course
    //TODO: Extend this to allow collections
    public function register(User $user, $role) {
        $this->persons()->attach($user->id,['role' => $role]); 
        //We must also add submissions
        $assignments = $this->assignments()->get();

        foreach($assignments as $assignment) {
            $submission = Submission::create([
                'assignment_id' => $assignment->id,
                'user_id' => $user->id,
            ]);

            $submission->save();
        }
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function newAssignment(Assignment $assignment)
    {
        //register the assignment relationship;
        $assignment->course_id = $this->id;
        $assignment->save();
        //For all students in the course create a submission entry for each
        //assignment.

        $students = $this->persons()->where('role', 'student')->get();
        foreach($students as $student) {
            $submission = Submission::create([
                'assignment_id' => $assignment->id,
                'user_id' => $student->id,
            ]);

            $submission->save();
        }

    }
}
