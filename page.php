<?php
include("global.php");
$url=$_SERVER['REQUEST_URI'];
function get_string_between($var1="",$var2="",$pool){
		$temp1 = strpos($pool,$var1)+strlen($var1);
		$result = substr($pool,$temp1,strlen($pool));
		$dd=strpos($result,$var2);
		if($dd == 0){
		$dd = strlen($result);
		}
		return substr($result,0,$dd);
}
$currentUrlCalled=get_string_between('admin/', '?',$url);
$route=get_route($currentUrlCalled);
?>