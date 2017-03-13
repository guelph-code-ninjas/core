<?php

namespace App\VersionControl;

class Add implements Action
{
    public $path;

    public function do()
    {
        return "";
    }

    public function type()
    {
        return "add";
    }
}
