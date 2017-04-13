<?php
include 'similarityChecker.php';
//Change this so we somehow dynamically obtain the path.
$laravelPath = "/home/vagrant/Code/Laravel/app";

require dirname($laravelPath) . '/vendor/autoload.php';
$app = require dirname($laravelPath) . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
//Don't remove the 3 lines belows. They somehow allow a connection to the database
$kernel->call("inspire");
$output = $kernel->output();
echo $output;

use App\Assignment;

function getSimilarity($assignmentId) {
    $assignment = Assignment::where('id', $assignmentId)->first();
    return $assignment->similarity;
}

function postUpdate($args, $args2) {

    $assignmentId = $args['assignmentId'];
    $studentId = $args['studentId'];
    $similarity = getSimilarity($assignmentId);
    $assignmentPath = $args['assignmentPath'];
    $laravelStorage = $args['laravelStorage'];
    #Reset the respository since it's not a bare git repo.
    system($laravelStorage.'/app/scripts/reset-head.sh ' . $args2);


    #Call the similarity checker
    activateSimillarityHook($assignmentId, $similarity, $studentId, $assignmentPath, "c"); 
    return 0;
}

function postCommit($args) {

    $assignmentId = $args['assignmentId'];
    $similarity = getSimilarity($assignmentId);
    $studentId = $args['studentId'];
    $assignmentPath = $args['assignmentPath'];

    activateSimillarityHook($assignmentId, $similarity, $studentId, $assignmentPath, "c");
    return 0;
}
