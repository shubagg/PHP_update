<?php 
include_once '../../global.php';
get_header();

//var_dump(get_api_key());
/*for ($i=0; $i <=10 ; $i++) { 
	echo "i = ".$i." = ";
	if($i==2||$i==5||$i==8)
		var_dump(get_api_key(true));
	else
		var_dump(get_api_key());
	echo "<br>";
	sleep(1);

}*/

$tmp = array(
	'timestamp'=>"",
	'imei'=>863071014823089,
	'time'=>37654,
	'date'=>141231,
	'lat'=>28.000000,
	'lng'=>77.000000,
	'dist'=>0,
	'alt'=>0,
	'angle'=>0,
	'nos'=>5,
	'speed'=>0,
	'ant'=>1,
	'lac'=>449,
	'ss'=>5,
	'ip'=>0,
	'op'=>255,
	'fuel'=>100,
	'bv'=>0
	);

$db->vts->array($tmp);

//queue_get_address();
queue_get_coordinates();
die;
for ($i=0; $i <100 ; $i++) { 
var_dump(getcoordinates(array('address'=>'1600+Amphitheatre+Parkway,+Mountain+View,+CA')));
echo "<br>";
}


echo "asd";
//var_dump(getaddress(array('lat'=>'28.6100','lng'=>'77.2300')));
var_dump(getcoordinates(array('address'=>'1600+Amphitheatre+Parkway,+Mountain+View,+CA')));
//associate_module("19","50","1","3",array('nav'=>'501'),"add");

echo memcache("nav1");
?>
<script>
curl_post("/sample",{id:"sample"},function(data){console.log(data);});
</script>
<?php
get_footer();
?>