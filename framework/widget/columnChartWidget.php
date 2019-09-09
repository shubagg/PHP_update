<?php
require_once($server_path.'framework/widget/'.'chartWidget.php');

function columnChartInitWidgetMarkup(&$returnValue)
{
	global $site_url;
	getChartInitWidgetMarkup($returnValue);
	$returnValue["columnchartwidget"] = "<script type='text/javascript' src='".assets_url()."chart/column.js'></script>" ;
}

?>
