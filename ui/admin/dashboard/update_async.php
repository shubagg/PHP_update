
<?php
include_once("../../../global.php");
$widget_data = curl_post("/async_update",array("table"=>'widgetDetail'));
pr($widget_data);
?>
