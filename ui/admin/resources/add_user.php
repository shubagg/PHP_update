<?php
include_once '../../../global.php';
if(isset($_REQUEST['user_add']))
{
	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$roles = $_REQUEST['roles'];
	$cat = $_REQUEST['category'];
	$manager = $_REQUEST['manager'];
	$emp_id = $_REQUEST['emp'];

	$output = curl_post($webservice_url."/add_user",array('name'=>$name,'email'=>$email,'password'=>$password,'roles'=>$roles,'category'=>$cat,'manager'=>$manager,'emp'=>$emp_id));
	print_r($output);
}

//$update_user=curl_post($webservice_url."/edit_user",array('status'=>0,'user_id'=>'55d6bd219c7684dc07000000'));
//print_r($update_user);
echo "<br /><br />";

$get_users=curl_post($webservice_url."/get_users",array());
print_r($get_users);

?>
<h1>Add User</h2>
<hr>
<h2>Current Roles</h2>
<pre>
<?php 
$role = curl_post($webservice_url."/get_roles",array());
print_r($role);
?>
</pre>
<hr>
<h2>Current Category</h2>
<?php
echo "<br /><br />";
echo "Update Category<br />";
//$edit_category= curl_post($webservice_url."/edit_category",array('category_id'=>'55cd97429c76844c05000000','name'=>'Category 5','description'=>'profile','parent'=>'0'));

echo "<br /><br />";
echo "Get Single Category<br />";
$single_cat = curl_post($webservice_url."/get_category",array("category_id"=>"55cd97429c76844c05000000"));
print_r($single_cat);

echo"<hr/>";

echo "<br /><br />";
echo "Delete Category<br />";
$delete_category=curl_post($webservice_url."/delete_category",array("category_id"=>"55d1ebdc9c76846408000000"));
//print_r($delete_category);

echo"<hr/>";

echo "<br /><br />";
echo "Get All Categories<br />";
$cat = curl_post($webservice_url."/get_category",array());
print_r($cat);
echo"<hr/>";
 //echo get_category_structre($cat['category']); ?>

<hr>
<form>
Name : <input type="text" name="name" value=""><br><br>
email : <input type="text" name="email" value=""><br><br>
password : <input type="text" name="password" value=""><br><br>
Roles : <input type="text" name="roles" value=""><br><br>
Category : <input type="text" name="category" value=""><br><br>
Manager : <input type="text" name="manager" value=""><br><br>
Employee_id : <input type="text" name="emp" value=""><br><br>
<input type="submit" name="user_add"><br><br>
</form>