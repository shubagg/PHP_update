 <?php 

if(isset($_POST['starttime']) && isset($_POST['endtime'])) 
{

	include("../../../global.php");
	   $endtime=$_POST['starttime'];
	   $starttime=$_POST['endtime'];
}
else
{
	 $starttime=date("m/d/Y",time());  
	 $endtime=date("m/d/Y",time());   
}       
$column_head=array($ui_string['cronId'],$ui_string['logsId'],$ui_string['cronName'],$ui_string['starttime'],$ui_string['endtime'],$ui_string['result'],$ui_string['status']);  
$show_fields=array('cronId','logsId','cronName','starttime','endtime','result','status'); 
$All_data=array("head"=>$column_head);
$table_data=array("table_id"=>"data_table_1","table_data"=>$All_data);

get_ajax_datatable($table_data,$show_fields,admin_ui_url()."notification/ajax/cronStatus_datatable_ajax.php?starttime=".$starttime."&endtime=".$endtime); 

?>    