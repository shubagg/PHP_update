<?php 
include_once '../../global.php';
echo "asdasdasdadsasdasd";
$tmp = format_amid("1","1","2~3~4");
//echo "asdasd";
print_r($tmp);
die;
get_header();
echo "<br><br><br><h2>Multi Language</h2>";
//// Multi Language ///////

//code to set language
//set_language("jp");

//code to get language
//get_language();


//add data
//$data = curl_post("/add_sample",array("sample"=>array("sample_en"=>"asdasd111","sample_jp"=>"jp111")));

//get data
$data = curl_post("/sample",array("id"=>"562783c89c76848408000003"));

logger_ui("sample/index.php",$data['errorcode'],$data['data'],5);
if($data['success']=="true")
{
	print_r($data);
}
else
{
	//error
}

echo "<br><br><br><h2>Error String</h2>";


print_r($error_string);


echo "<br><br><br><h2>UI String</h2>";


print_r($ui_string);
?>
<script>
curl_post("/sample",{id:"sample"},function(data){console.log(data);});
</script>
<?php
get_footer();
?>