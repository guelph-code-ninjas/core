<?php

namespace App\VersionControl;

interface Action
{
    public function do();
    public function type();
}

?>
