<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    //
    protected $fillable = ['assignment_id', 'user_id', 'repository_id'];
}
