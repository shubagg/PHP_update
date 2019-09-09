<?php
require_once($server_path.'framework/widget/'.'chartWidget.php');

function lineChartInitWidgetMarkup(&$returnValue)
{
	global $site_url;
	getChartInitWidgetMarkup($returnValue);
	$returnValue["linechartwidget"]="<script type='text/javascript' src='".assets_url()."chart/line.js'></script>" ;
}




?>