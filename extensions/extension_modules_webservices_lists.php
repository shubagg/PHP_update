<?php
$extentions_webservices=array('aintu_form_job','events_and_venues');
foreach($extentions_webservices as $extension_web)
{
    $extensionDir=$server_path."extensions/".$extension_web."/modules/".$extension_web."/webservice.php";
    require_once($extensionDir);
  
}


?>