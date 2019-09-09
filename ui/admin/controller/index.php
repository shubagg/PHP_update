<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../../../global.php");
//pr($_REQUEST);
//$server_path = $_SERVER["DOCUMENT_ROOT"] . "/" . $folder . "/";
if(!empty($_GET['type'])) {
    $module = explode('_', $_GET['type']);
    if(isset($_GET['jsonPath']) && $_GET['jsonPath']!='')
    {
        //echo $server_path . $_GET['jsonPath'] . $module[0] . '_json.php'; die;
        include_once($server_path . $_GET['jsonPath'] . $module[0] . '_json.php');
    }
    else
    {
    include_once($server_path . 'ui/admin/jsonController/' . $module[0] . '_json.php');
    }
    
    if(!empty($json_data[$_GET['type']])) {
        require_once($server_path . "ui/admin/controller/process.php");
        $requested_data = $json_data[$_GET['type']];
        //pr($requested_data); die;
        $default_class = new process();
        $default_class->dynamic_json_data = $requested_data;
        $default_class->dynamic_export_json_data = json_encode($requested_data);
        $default_class->userId = $_SESSION['user']['user_id']; 
        $default_class->call_process($requested_data);
    } 
    else 
    {
        echo "No Json defined for the calling Page";
    } 
}
else 
{
    echo "No Json defined for the calling Page";
} 

?>
