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
    public function register(User $user, $role) {
        $this->persons()->attach($user->id,['role' => $role]); 
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
    }
}
