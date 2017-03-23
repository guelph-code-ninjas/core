<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\VersionControl\VersionControl;
use GitElephant\Repository;

class Repository extends Model 
{
    protected $repo;

    public function repository()
    {
        //Lazy initialization
        
        if(!$this->initialized)
        {
            $this->repo = new Repository($this->path);
            $this->init();

            $this->initialized = true;
        }

        if(is_null($this->repo))
        {
            $this->repo = new Repository::open($this->path);
        }

        return $this->repo;
    }

}
