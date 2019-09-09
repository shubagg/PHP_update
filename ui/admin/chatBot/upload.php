<?php
if(isset($_POST) == true){
    
    $myString= nl2br(file_get_contents($_FILES["file"]["tmp_name"]));
    $myArray = preg_split('/<br[^>]*>/i', $myString);
    $response['status'] = 'ok';
    $response['data'] = array_values(array_filter($myArray, function($value) { return trim($value) !== ''; }));
    echo json_encode($response);
}
?>