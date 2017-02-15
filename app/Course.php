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
    // Three  additonal different tables are required for the following 
    // relationships. We can reduce this to one table with a column
    // that stores the user's role.
    //
}
