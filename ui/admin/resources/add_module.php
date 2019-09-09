<?php
include_once '../../../global.php';
//$rt1=curl_post($webservice_url."/add_modules",array('name'=>"Resource",'permissions'=>'view,all'));
//$rt2=curl_post($webservice_url."/add_modules",array('name'=>"Advertisement",'permissions'=>'view,all'));
//$rt3=curl_post($webservice_url."/add_modules",array('name'=>"CMS pages",'permissions'=>'view,all'));
//$rt4=curl_post($webservice_url."/add_modules",array('name'=>"Payment",'permissions'=>'view,all'));
//$rt5=curl_post($webservice_url."/add_modules",array('name'=>"Post",'permissions'=>'view,all'));

$get_modules=curl_post($webservice_url."/get_modules",array());

print_r($get_modules);
?>