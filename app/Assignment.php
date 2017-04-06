<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
	protected $fillable = [
		'name', 'slug',    
	];
	
    public function submissions()
    {
        return $this->hasMany('App\Submission', 'assignment_id');
    }

}
