<?php 

namespace App\VersionControl\FileSystem;
use Illuminate\FileSystem\FileSystem as OSFileSystem;

use App\VersionControl\Action;

class Add implements Action
{
    protected $path;
    private $from;
    private $to;

    public function __construct($path, $from, $to, $name)
    {
        $this->from = $from;
        $this->to = $to;
        $this->path = $path;
        $this->name = $name;
    }

    public function do()
    {
        $filesystem = new OSFileSystem();
        $target = $this->path . $this->to . $this->name;
        $success = $filesystem->copy($this->from, $target);

        return new ActionResult(true, null);
    }

    public function type()
    {
        return "add";
    }
}

?>
