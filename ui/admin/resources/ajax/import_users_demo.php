
<?php

include_once '../../../../global.php';
$cid=get_company_data();
$comid=$cid['cid'];
$file_path = site_url().'company/'.$comid.'/uploads/demo.xls';
$result=array('data'=>$file_path,'error_code'=>'100','success'=>'true');
     echo json_encode($result);
?>
