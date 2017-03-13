<?php 

namespace App\VersionControl\FileSystem;

use App\VersionControl\Action;

class Remove implements Action
{
    private $filename;

    public function do()
    {
        return  "remove " . $this->filename;
    }

    public function type()
    {
        return "remove";
    }
}

?>
