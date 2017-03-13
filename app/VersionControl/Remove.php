<?php 

namespace App\VersionControl;

use App\VersionControl\Action;

class Remove implements Action
{
    public function do()
    {
        return "";
    }

    public function type()
    {
        return "remove";
    }
}

?>
