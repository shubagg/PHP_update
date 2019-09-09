 <?php 

if(isset($_POST['starttime']) && isset($_POST['endtime'])) 
{
	//print_r($_POST);die;
	include("../../../global.php");
	   $endtime=$_POST['starttime'];
	   $starttime=$_POST['endtime'];
	   $mid=$_POST['mid'];
	   $smid=$_POST['smid'];
	   $type=$_POST['type'];
}
else
{
	 $starttime=date("m/d/Y",time());  
	 $endtime=date("m/d/Y",time()); 
	 $mid=isset($_GET['mid'])?$_GET['mid']:""; 
	 $smid=isset($_GET['smid'])?$_GET['smid']:"";
	 $type=isset($_GET['type'])?$_GET['type']:""; 
}    

$column_head=array($ui_string['userId'],$ui_string['ipaddress'],$ui_string['lastAttemptTime'],$ui_string['stringId'],$ui_string['action']);  
$show_fields=array('userId','ipaddress','lastAttemptTime','action','stringId');

$All_data=array("head"=>$column_head);
$table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);
    
get_ajax_datatable($table_data,$show_fields,admin_ui_url()."resources/ajax/logs_datatable_ajax.php?mid=".$mid."&smid=".$smid."&type=".$type."&starttime=".$starttime."&endtime=".$endtime); 
                                

?>    