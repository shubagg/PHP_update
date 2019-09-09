<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../global.php");
//$server_path = $_SERVER["DOCUMENT_ROOT"] . "/" . $folder . "/";

if(!empty($_GET['type'])) {
    
    $module = explode('_', $_GET['type']); 
    //include(lang_url()."global_en.php");
    //echo $module[0]; die('tttt');
    require_once($server_path . 'jsonController/' . $module[0] . '_json.php');
   // echo "<pre>"; print_r($json_data); die;

    if(!empty($json_data[$_GET['type']])) {
        require_once($server_path . "controller/process.php");
        $requested_data = $json_data[$_GET['type']];
        
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

?>
