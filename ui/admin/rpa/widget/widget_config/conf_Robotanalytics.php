<?php  
include_once("../../../../../global.php");

if (isset($_POST['widget_id'])) 
{
	include_once($server_path."ui/admin/dashboard/ajax/edit_charts.php");
	//echo $widget_data;
	$chart_img = $widget_data['chart_img'];
	$config = $widget_data['config_Json'];
	$config = json_decode($config,true);
	extract($config);
}else{
	$from_date = '';
	$to_date = '';
	$refresh_interval = '';
	$time_interval = '';
}


$REFRESH_INTERVAL_JSON = array('type'=>'select','label'=>'Refresh Interval','name'=>'conf_refresh_interval','id'=>'conf_refresh_interval','selected_value'=>$refresh_interval);

$TIME_PERIOD_JSON = array('type'=>'select','label'=>'Time Interval','name'=>'conf_time_interval','id'=>'conf_time_interval','selected_value'=>$time_interval);

$LIMIT_JSON = array('type'=>'select','label'=>'Product Limit','name'=>'conf_limit','id'=>'conf_limit','selected_value'=>$limit);

echo $html='<div class="col-md-12 col-sm-12 col-xs-12 modal-iframe">
		<div>
			<div class="panel">
				<div class="panel-body align-xs-center">
				<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-4">'.createDropdown('LIMIT',$LIMIT_JSON).'</div>
				</div>
				<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-4">'.createDropdown('TIME_PERIOD',$TIME_PERIOD_JSON).'</div>
				</div>
				<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-4">'.createDropdown('REFRESH_INTERVAL',$REFRESH_INTERVAL_JSON).'</div>
				</div>
				</div>	
				</div>
			</div>	
		</div>		
	</div>';

	?>

