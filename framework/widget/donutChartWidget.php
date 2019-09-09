<?php
require_once($server_path.'framework/widget/'.'chartWidget.php');

function donutChartInitWidgetMarkup(&$returnValue)
{
	global $site_url;
	getChartInitWidgetMarkup($returnValue);
	$returnValue["donutchartwidget"]="<script type='text/javascript' src='".assets_url()."chart/donut.js'></script>" ;
}




?>