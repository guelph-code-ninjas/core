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
        $submission = Submission::where('repository_id', $this->id)->get()[0];
        $assignment = Assignment::where('id', $submission->assignment_id)->get()[0];
        $fs = new FileSystem();

        $laravelStorage = app()->storagePath();
        $userId = $submission->user_id;
        $assignmentId = $submission->assignment_id;
        $repositoryPath = $this->absolutePath();
        $hookPath = $this->path.'.git/hooks/';

        //First create the user's repository and init a git repo.
        Storage::makeDirectory($this->path);
        $this->repo = GitRepository::open($this->absolutePath());
        $this->repo->init();
        //
        $assignmentPath = realpath($repositoryPath . "../");
        $assignmentPathRel = $this->path.'/../';

        //Obtain the template for a repository environment.
        $env = Storage::get('templates/environment.php');

        //We're starting to tie repositories directly to an assignment.
        //It should be broken up into a generic repository and
        //an AssignmentRepository.
        

        $parameters = [
            '__LARAVEL_STORAGE__'       =>  $laravelStorage,
            '__STUDENT_ID__'            =>  $userId,
            '__ASSIGNMENT_ID__'         =>  $assignmentId,
            '__SUBMISSION_DIR__'        =>  $repositoryPath,
            '__SIMILARITY_THRESHOLD__'  =>  $assignment->similarity,
            '__ASSIGNMENT_DIR__'        =>  $assignmentPath,
            ];

        foreach($parameters as $key => $value) {
            $env = str_replace($key, $value, $env);
        }



        /*GIT Repo config*/
        $file = Storage::get('templates/config');
        $configPath = $this->path.'.git/';
        Storage::put($configPath.'config', $file);

        /*Git Environment*/
        Storage::put($hookPath.'environment.php', $env);

        /*Post-update Hook*/
        $file = Storage::get('templates/post-update');
        Storage::put($hookPath.'post-update', $file);
        $fs->chmod($this->absolutePath().'/.git/hooks/post-update', 0755);
        /*post-commit hook*/
        $file = Storage::get('templates/post-commit');
        Storage::put($hookPath.'post-commit', $file);
        $fs->chmod($this->absolutePath().'/.git/hooks/post-commit', 0755);

        /*Assignment config*/
        /*Currently this gets overwritten each time a repository is created*/
        Storage::makeDirectory($assignmentPathRel.'/.config/');
        $file = Storage::get('templates/hooks.php');
        Storage::put($assignmentPathRel.'/.config/hooks.php', $file);
        $fs->chmod($assignmentPath . '/.config/hooks.php', 0755);


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
