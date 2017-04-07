<?php 

/* Checks the type of the passed file(s) against a preset list of acceptable extensions
 file -> Array(test.c, index.h) extList -> Array(c, h, zip, out) */ 
function typeCheck($file, $extList){
	$ext = substr($file, strpos($file, ".") + 1);
	foreach ($extList as $currentExt) {	
		if($ext == $currentExt){
			return true;  
		}	 	
	}
	return false; 
}
// Uploads the file from a POST request. tmpName: tmp dir file name, 
function uploadFile($tmpName, $fileName, $path){
	$path = $path.basename($fileName); 
	if(move_uploaded_file($tmpName, $path)){
		return true; 
	}
	else
	{
		return false; 
	}
}

//Compares directory structures
function dirCompare($dir1, $dir2){
		if(scandir(realpath($dir1)) == scandir(realpath($dir2))){
			return true; 
		}
		else{
			return false; 
		}
}
//extracts files from dir to path 
function extractFiles($dir,$path){
	$zip = new ZipArchive;
	$res = $zip->open(realpath($dir));
	if ($res === true) {
		  $zip->extractTo(realpath($path));
		  $zip->close();
		  return true; 
  	}
  	return false;
}

?>