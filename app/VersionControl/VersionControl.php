<?php

namespace App\VersionControl;

abstract class VersionControl implements VersionControlInterface
{
    protected $path; 
    abstract public function list($path);
    abstract public function commit($actions);

    function __construct($path)
    {
        $this->path = $path;
    }
}

