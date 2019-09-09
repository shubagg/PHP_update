<?php
require_once '../../../../global.php';
if(isset($_REQUEST['str']) && !empty($_REQUEST['str']))
{
	$str = $_REQUEST['str'];
	pr($str);	
	$abc = json_decode($str,true);
	pr($abc);
}
//pr($_REQUEST);
// /[ {"deviceId":{"$eq":"a"}}, {"deviceId":{"$eq":"b"}}, {"deviceId":{"$eq":"c"}}]

?>