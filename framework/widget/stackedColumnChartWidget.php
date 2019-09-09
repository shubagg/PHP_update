<?php
require_once($server_path.'framework/widget/'.'chartWidget.php');

function stackedColumnChartInitWidgetMarkup(&$returnValue)
{
	global $site_url;
	getChartInitWidgetMarkup($returnValue);
	$returnValue["stackedColumnChartWidget"] = "<script type='text/javascript' src='".assets_url()."chart/column_stacked.js'></script>" ;
}

?>
