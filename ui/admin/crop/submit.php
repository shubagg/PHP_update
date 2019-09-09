<?php
include_once("../../../global.php");

$data =$_REQUEST['imagebaseType'];
$extension =$_REQUEST['imageType'];
$ext=explode("/",$extension);
$filename="image_".time().'.'.$ext[1];
$data = preg_replace('#^data:image/\w+;base64,#i', '', $data);
$data = str_replace(' ', '+', $data);
$data=base64_decode($data,true);
file_put_contents('tempCropupload/'.$filename,$data);

echo ui_url()."admin/crop/tempCropupload/".$filename;

 ?>
