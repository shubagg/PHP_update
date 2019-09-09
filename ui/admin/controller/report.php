<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../../../global.php");

//$server_path = $_SERVER["DOCUMENT_ROOT"] . "/" . $folder . "/";

if(!empty($_GET['type'])) {
    
    $module = explode('_', $_GET['type']); 
    include_once($server_path . 'ui/admin/jsonReportController/' . $module[0] . '_json.php');

    if(!empty($json_data[$_GET['type']])) {
        
       // echo "<pre>"; print_r($ui_string); die;
        require_once($server_path . "ui/admin/controller/process.php");
        $requested_data = $json_data[$_GET['type']];

        if(isset($requested_data['template']))
        {
            $requested_data['template'] = 'report';
        }
        if(isset($requested_data['advanced_search']['status']))
        {
            $requested_data['advanced_search']['status'] = false;
        }


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
