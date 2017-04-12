<?php
//Throws an exception when unable to access the resouce.
function activateSimillarityHook(
    $assignment, $threshold, $student, $assignmentDir, $language)
{
    $url = 'http://localhost:4910/check';
    $data = '{"assignmentId" : "' . $assignment . '", 
              "threshold" : ' . $threshold . ', 
              "studentId" : "'. $student .'", 
              "directory" : "'. $assignmentDir .'",
              "language"  : "'. $language .'"}'; 

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_exec($curl);
    curl_close($curl);
}

?>
