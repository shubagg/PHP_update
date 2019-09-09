<?php
require_once($server_path.'framework/widget/'.'chartWidget.php');

function tableChartInitWidgetMarkup(&$returnValue)
{
	global $site_url;
	getChartInitWidgetMarkup($returnValue);
	$returnValue["tablechartwidget"] = "<script type='text/javascript' src='".assets_url()."chart/table.js'></script>" ;
}

?>
