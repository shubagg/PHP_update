<?php
include_once '../../../../global.php';
$category_id=$_POST['category'];
print_r($category_id);
//$get_category_users=curl_post($webservice_url."/get_category_users",array("category_id"=>$category_id));
//print_r($get_category_users['user_ids']);
/*$allUsers=array();
foreach($get_category_users['user_ids'] as $ids)
{
    array_push($allUsers,$ids['id']);
}
echo implode(",",$allUsers);*/
?>