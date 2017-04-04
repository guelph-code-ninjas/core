<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\VersionControl\VersionControl;
use GitElephant\Repository as GitRepository;
use Illuminate\Support\Facades\Storage;

class Repository extends Model
{
    protected $repo;

    protected function absolutePath()
    {
        return app()->storagePath().'/app/'.$this->path;
    }

    public function repository()
    {
        //Lazy initialization
        if (!$this->initialized) {
            Storage::makeDirectory($this->path);
            $this->repo = GitRepository::open($this->absolutePath());
            $this->repo->init();

            $this->initialized = true;
        }

        if (is_null($this->repo)) {
            $this->repo = GitRepository::open($this->path);
        }

        return $this->repo;
    }


    public function commit($message) {
        //Prehooks should be placed here.
        $this->repository()->commit($message, true);
        //Posthooks should be placed here.
    }


}