<?php
    $time=$_GET['time'];
    $path=$_GET['path'];
    $DelFilePath=$path.$time.'.zip';
    $dir=$time;
$zip = new ZipArchive;
if ($zip->open($DelFilePath, ZipArchive::CREATE) === TRUE)
{
    // Add files to the zip file
    foreach (glob($path.$time."/*") as $file) {  
        $zip->addFile($file,str_replace($path.$time, "", $file));  
    }
    // All files are added, so close the zip file.
    $zip->close();
   
}

foreach (glob($path.$time."/*") as $file)
{
    unlink($file);

}
rmdir($path.$time);


 if (file_exists($DelFilePath)) {
  header('Content-Type: application/zip');
  header('Content-Disposition: attachment; filename="'.basename($DelFilePath).'"');
  header('Content-Length: ' . filesize($DelFilePath));
  flush();
  readfile($DelFilePath);
   unlink($DelFilePath);
   $result=array('data'=>'','error_code'=>'100','success'=>'true');
     echo json_encode($result);
}

?>