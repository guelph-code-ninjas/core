<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\VersionControl\VersionControl;
use GitElephant\Repository as GitRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\FileSystem\FileSystem;

class Repository extends Model
{
    protected $repo;

    protected function absolutePath()
    {
        return app()->storagePath().'/app/'.$this->path;
    }

    protected function init()
    {
        Storage::makeDirectory($this->path);
        $this->repo = GitRepository::open($this->absolutePath());
        $this->repo->init();

        //copy the post-update hook into the repository.
        $postUpdate = Storage::get('scripts/post-update');
        //We're starting to tie repositories directly to an assignment.
        //It should be broken up into a generic repository and
        //an AssignmentRepository.
        
        $submission = Submission::where('repository_id', $this->id)->get()[0];
        $assignment = Assignment::where('id', $submission->assignment_id)->get()[0];

        $parameters = [
            '__LARAVEL_STORAGE__'       =>  app()->storagePath(),
            '__STUDENT_ID__'            =>  $submission->user_id,
            '__ASSIGNMENT_ID__'         =>  $submission->assignment_id,
            '__SUBMISSION_DIR__'        =>  $this->absolutePath(),
            '__SIMILARITY_THRESHOLD__'  =>  $assignment->similarity,
            ];

        foreach($parameters as $key => $value) {
            $postUpdate = str_replace($key, $value, $postUpdate);
        }

        $hookPath = $this->path.'.git/hooks/';
        Storage::put($hookPath.'post-update', $postUpdate);

        $fs = new FileSystem();
        $fs->chmod($this->absolutePath().'/.git/hooks/post-update', 0755);

        $this->initialized = true;
    }

    public function repository()
    {
        //Lazy initialization
        if (!$this->initialized) {
            $this->init();
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
