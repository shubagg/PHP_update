<?php
$adminUiPath=dirname(__FILE__)."/ui/";

//$extensionRoute['feedback']=$adminUiPath."feedback_list.php";
$extensionRoute['form/fillup']=$adminUiPath."admin/createform.php";
$extensionRoute['form/formdetail']=$adminUiPath."admin/formdetail.php";
$extensionRoute['form/filledformdetails']=$adminUiPath."admin/filledformdetails.php";
$extensionRoute['form_job_approvals']=$adminUiPath."admin/formjobapproval.php";
$extensionRoute['form_job_report']=$adminUiPath."admin/formjobreport.php";


$extensionRoute['form_json_webservices/bank_names']=$adminUiPath."admin/form_json_access/bank_names.json";

$extensionRoute['form_json_webservices/city_list']=$adminUiPath."admin/form_json_access/city_list.json";

$extensionRoute['form_json_webservices/city_list_aintu']=$adminUiPath."admin/form_json_access/city_list_aintu.json";

$extensionRoute['form_json_webservices/outlets']=$adminUiPath."admin/form_json_access/outlets.json";

$extensionRoute['form_json_webservices/radio']=$adminUiPath."admin/form_json_access/radio.json";

$extensionRoute['form_json_webservices/states']=$adminUiPath."admin/form_json_access/states.json";

$extensionRoute['form_json_webservices/states_aintu']=$adminUiPath."admin/form_json_access/states_aintu.json";

$extensionRoute['form_json_webservices/zone_list']=$adminUiPath."admin/form_json_access/zone_list.json";

?>