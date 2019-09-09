<?php
if(isset($_REQUEST['action']) && $_REQUEST['action']=='get_retData')
{
	include_once("../../../global.php");
     $index=array();
     $mid=$_POST['mid'];
     $smid=$_POST['smid'];
     $report_id=$_POST['report_id'];
     $cookie_column_head = json_encode($_POST['defaultField']);

     if(isset($_REQUEST['type']) && $_REQUEST['type']=='submit')
     {
	     if(isset($_COOKIE['cookie_column_head_'.$mid.'_'.$report_id.'_'.$_SESSION['user']['user_id']]))
	     {
	     	$defaultField=$_COOKIE['cookie_column_head_'.$mid.'_'.$report_id.'_'.$_SESSION['user']['user_id']];
	 	 }
	 	 else
	 	 {
	 	 	$defaultField=$cookie_column_head;
	 	 }
 	 }
 	 else
 	 {
 	 	$month = time() + (60 * 60 * 24 * 30);                     
     	setcookie('cookie_column_head_'.$mid.'_'.$report_id.'_'.$_SESSION['user']['user_id'], $cookie_column_head, $month, "/");
     	$defaultField=$cookie_column_head;
     	
 	 }

 	 $defaultField1=json_decode($defaultField);

	 $column_head=$_POST['head'];
	 //print_r($column_head);
	 //die;
	 $show_fields=$_POST['field'];
	 $noOfFields=count($defaultField1);
	 
	 if(!empty($column_head)){foreach ($column_head as $k=>$v) 
	 	{
	 	if(in_array($v, $defaultField1)){
	 		$index[]=$k;
	 	}
	 } }


}
else
{
	$index=array();
	$column_head=array();
	$show_fields=array();
    $defaultField=array();
    $noOfFields=count($defaultField);
    
}

//print_r($index);
//print_r($column_head);
?>


<div class="table-responsive">


	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover datatable"  id="data_table_3"> 
	<thead> 
	<tr>
	<?php $cnt=1;if(!empty($column_head)){ foreach ($column_head as $key=>$value) { if(!in_array($key, $index)){ continue;}?>
	<th><?php echo $value;?></th>
	<?php $cnt++; } }?>	

	</tr> 
	</thead>
	<tbody> 
	<?php if(!empty($show_fields)){ foreach ($show_fields as $value1) {?>	
	<tr> 
	<?php foreach ($value1 as $k2=>$value2) { if(!in_array($k2, $index)){ continue;}?>
	<td><?php echo $value2;?></td>	
	<?php } ?>
	</tr> 
	<?php } } ?> 
	</tbody> 
	</table>
</div>
<script type="text/javascript" src="<?php echo admin_ui_url(); ?>report/js/chart_report.js"></script>
<script type="text/javascript">
var setting='<button class="custom-setting-btn pull-right" onclick="checkedheadersetting();" style="padding-top: 1px; font-size:19px; margin-left:6px;" data-toggle="modal" data-target="#md-normal"><i class="fa fa-cog"></i></button><button onclick="export_report()" type="button" data-toggle="tooltip" data-placement="top" title="" class="btn btn-default pull-right" data-original-title="Export"> <i class="glyphicon glyphicon-export"></i></button>';
$('#data_table_3').DataTable();
 var new_mid='<?php echo $mid;?>';
 var new_smid='<?php echo $smid;?>';
 var new_report_id='<?php echo $report_id;?>';
 var head='<?php echo json_encode($column_head);?>';
 var field='<?php echo json_encode($show_fields);?>';
 var OlddefaultField='<?php echo $defaultField;?>';
$(".reportButton").append(setting); 
</script>			