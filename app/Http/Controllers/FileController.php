<?php

namespace App\Http\Controllers;
include "fileValidator.php"

use Illuminate\Http\Request;

class FileController extends Controller
{
	public function test(){
		return view('home');
		print_r($_FILES);
		echo "hello";
		print_r($_POST);  
	}
    
}
