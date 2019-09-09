<?php  
include_once("../../../../../global.php");

if (isset($_POST['widget_id'])) 
{
	include_once($server_path."ui/admin/dashboard/ajax/edit_charts.php");
	$chart_img = $widget_data['chart_img'];
	$config = $widget_data['config_Json'];
	$config = json_decode($config,true);
	extract($config);
}else{
	$query = '';
	$refresh_interval = '';
}
$REFRESH_INTERVAL_JSON = array('type'=>'select','label'=>'Refresh Interval','name'=>'conf_refresh_interval','id'=>'conf_refresh_interval','selected_value'=>$refresh_interval);
$userid=$_SESSION['user']['user_id'];
echo $html='<div class="col-md-12 col-sm-12 col-xs-12 modal-iframe">
		<div>
			<div class="panel">
				<div class="panel-body">
				<div class="row">		
				<div class="col-md-4 col-sm-4 col-xs-4">
				<div id="getQuery" data-html-label="Query" data-type="GET_QUERY"  data-html-userid="'.$userid.'" data-html-selected_value='.$query.'></div></div>
					<div class="col-md-4 col-sm-4 col-xs-4">'.createDropdown('REFRESH_INTERVAL',$REFRESH_INTERVAL_JSON).'</div>
				
					</div>
				</div>
			</div>	
		</div>		
	</div>';

	?>


