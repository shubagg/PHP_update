<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo $admin_ui_url; die;
//echo (__DIR__); 
include_once("../../../global.php");

//$server_path = $_SERVER["DOCUMENT_ROOT"] . "/" . $folder . "/";
if(!empty($_GET['JsonType'])) {
    
    $module = explode('_', $_GET['JsonType']); 
    //include(lang_url()."global_en.php");
    //echo $module[0]; die('tttt');

    include_once($server_path . 'ui/admin/jsonReportController/' . $module[0] . '_json.php');
   //echo "<pre>"; print_r($json_data); die;
     
    if(!empty($json_data[$_GET['JsonType']])) {
        require_once($server_path . "ui/admin/controller/process.php");
        $requested_data = $json_data[$_GET['JsonType']];
        
        if(isset($requested_data['template']))
        {
        $requested_data['template'] = 'report';
        }
        if(isset($requested_data['advanced_search']['status']))
        {
        $requested_data['advanced_search']['status'] = false;
        }
        $requested_data['listing_details']['custom_buttons'] = false;
        //$pagination=>array("set"=>array(5,10,15,100),"show"=>array('n_5','n_10','n_15','n_100'));
        $pagination=array("set"=>array(5,10,15,100),"show"=>array('n_5','n_10','n_15','n_100'));
        $requested_data['listing_details']['pagination'] = $pagination;  
        $requested_data['listing_details']['div_id'] = 'table_'.$_GET['divID'];     
        $requested_data['listing_details']['processing'] = false; 
        $requested_data['listing_details']['dropDownPaging'] = false; 
        $requested_data['template'] = 'reportWidget';

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
