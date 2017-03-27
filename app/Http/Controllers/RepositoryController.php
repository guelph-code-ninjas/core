<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class RepositoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the given assignment.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(App\Repository $repository)
    {
        $name = $repository->name;
        $repository = $repository->repository();

        //When a repository is empty and you attempt to get the tree
        //an exeception is thrown.
        //This should be improved somehow
        $tree = [];
        try {
            $tree = $repository->getTree();
        } catch (Exception $e) {
            $tree = [];
        }
        finally{
            return view('repositories.show', compact('repository', 'name', 'tree'));
        }

    }
}
