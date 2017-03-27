<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    public function enrollments()
    {
        return $this->belongsToMany(
            'App\User', 'courses_users',
            'course_id', 'user_id'
        )->withPivot('role');

    }

    private function _constraints($user, $assignment)
    {
        $repo_id = null;
        if($assignment->requiresRepository)
        {
            //$path = 'repositories/'.$this->id.'/'.$assignment->id.'/'.$user->id.'/';
            $path = 'repositories/'.$this->slug.'/'.$assignment->slug.'/'.$user->id.'/';
            $name = $assignment->slug;

            $repo = Repository::create(
                [
                'name' => $name,
                'path' => $path,
                'backend' => 'git', 
                ]
            );
            //Initialize the repository
            $repo->repository(); 
            $repo_id = $repo->id;
        }

        $submission = Submission::create(
            [
            'assignment_id' => $assignment->id,
            'user_id' => $user->id,
            'repository_id' => $repo_id,
            ]
        );

        $submission->save();
    }

    // Register a user for a course
    //TODO: Extend this to allow collections
    public function register(User $user, $role) 
    {
        $this->enrollments()->attach($user->id, ['role' => $role]); 

        //We must also add submissions for a student
        if($role == 'student') {
            $assignments = $this->assignments()->get();
            foreach ($assignments as $assignment) {
                $this->_constraints($user, $assignment);
            }
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

        $students = $this->enrollments()->where('role', 'student')->get();
        foreach ($students as $student) {
            $this->_constraints($student, $assignment);
        }

    }
}
