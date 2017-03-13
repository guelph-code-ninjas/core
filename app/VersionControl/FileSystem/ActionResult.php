<?php

namespace App\VersionControl\FileSystem;


class ActionResult
{
    public $success;
    public $ret;

    public function __construct($success, $ret)
    {
        $this->success = $success;
        $this->ret = $ret;
    }
}
