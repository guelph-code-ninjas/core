<?php

namespace App\Http\Controllers;
include "fileValidator.php"

use Illuminate\Http\Request;

class FileController extends Controller
{
	public function test(){
		//return view('show');
		print_r($_FILES);
		echo "<br>";
		print_r($_POST);  
	}
    
}
