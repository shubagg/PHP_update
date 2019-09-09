<?php
$extentions=array('aintu_form_job','events_and_venues');
foreach($extentions as $extension)
{
    $extensionDir=$server_path."extensions/".$extension."/modules";
   
    require_once($extensionDir.'/'.$extension.'/include/core/functions.php');
    require_once($extensionDir.'/'.$extension.'/include/interface/webservice_functions.php');
}


?>