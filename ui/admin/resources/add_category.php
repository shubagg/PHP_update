<?php
include_once '../../global.php';
if(isset($_REQUEST['cat_add']))
{
	$parent = $_REQUEST['parent'];
    
	$name = $_REQUEST['name'];
	$code = $_REQUEST['code'];
	$output = curl_post($webservice_url."/add_category",array('parent'=>$parent,'name'=>$name,'code'=>$code));
	print_r($output);
}
?>
<h1>Add Category</h2>
<hr>
<h2>Current Category</h2>
<pre>
<?php 
$cat = curl_post($webservice_url."/get_category",array());
print_r($cat);
echo "<br /><br />";

//$get_user_categories=curl_post($webservice_url."/get_user_category",array("category_id"=>"55d6af829c7684bc07000000,55d6af979c7684bc07000001,55d6afc69c7684bc07000002","description"=>"profile"));
$allUsers=array();
$get_category_users=curl_post($webservice_url."/get_category_users",array("category_id"=>"55d6afc69c7684bc07000002"));
foreach($get_category_users['user_ids'] as $ids)
{
    array_push($allUsers,$ids['id']);
}
echo implode(",",$allUsers);
//echo get_category_structre($cat['category']);
//echo show_cat_accordian(0,'','category_ids',1);
?>
</pre>
<hr>
<form>
parent_id : <input type="text" name="parent" value="">
Name : <input type="text" name="name" value="">
Code : <input type="text" name="code" value="">
<input type="submit" name="cat_add">
</form>