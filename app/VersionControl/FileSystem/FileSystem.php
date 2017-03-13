<?php

namespace App\VersionControl\FileSystem;

use App\VersionControl as VC;
use Illuminate\Support\Collection;
use Illuminate\FileSystem\Filesystem as OSFileSystem;

//Should extend App\VersionControl
class FileSystem 
{
    private $path;

    public function __construct($path)
    {
        //parent::__construct($path);
        $this->path = $path;
    }

    //Should we return relative paths or absolute paths?
    public function list($directory)
    {
        $results = new Collection();
        $fs = new OSFileSystem();

        //Check that path is a directory, not a file.
        //Security Risk: Users can travel up the tree with ./../../..
        $files = $fs->glob($this->path.$directory."/*");
        if($files == false)
            return [];

        foreach($files as $file)
        {
            $name = str_replace($this->path.$directory.'/', "", $file);
            $type = $fs->isfile($file) ? 'file' : 'directory';

            $result = new VC\FileResult($name, $type);

            $results->push($result);
        }

        return $results;
    }

    public function commit($actions)
    {
        $results = new Collection();
        foreach($actions as $action) {
            $results->push($action->do());
        }
    
        return $results;
    }
}
