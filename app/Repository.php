<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\VersionControl\VersionControl;

class Repository extends Model 
{
    //version control system
    private $vcs;

    public function backend()
    {
        return $this->pluck('backend');
    }

    public function path()
    {
        return $this->pluck('path');
    }

    public function list($path)
    {
        $vcs->list($path);
    } 

    public function commit($actions)
    {
        $vcs->commit($actions);
    }

}
