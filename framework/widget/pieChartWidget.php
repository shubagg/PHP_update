<?php
require_once($server_path.'framework/widget/'.'chartWidget.php');

function pieChartInitWidgetMarkup(&$returnValue)
{
	global $site_url;
	getChartInitWidgetMarkup($returnValue);
	$returnValue["piechartwidget"] = "<script type='text/javascript' src='".assets_url()."chart/pie.js'></script>" ;
}

?>