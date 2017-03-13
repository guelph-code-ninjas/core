<?php

namespace App\VersionControl;
/*
 * Best to start off with a simple versionControl Interface
 */

interface VersionControlInterface
{
    public function list($path);
    public function commit($actions);
}
