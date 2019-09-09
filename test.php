<?php
$test_json = '[{"id":"foreach-5c4ec402eba3674d7a3c986d-1","icon":"flaticon-refresh","children":[{"id":"message-5c4ebe5eeba367de743c9869-6","icon":"fa fa-bars"},{"id":"foreach-5c4ec402eba3674d7a3c986d-2","icon":"flaticon-refresh","children":[{"id":"message-5c4ebe5eeba367de743c9869-7","icon":"fa fa-bars","children":[{"id":"foreach-5c4ec402eba3674d7a3c986d-4","icon":"flaticon-refresh","children":[{"id":"message-5c4ebe5eeba367de743c9869-8","icon":"fa fa-bars"}]}]}]}]}]';
$jsonArrayData = json_decode($test_json, true);
global $final_array;
$find_keys_arr = array();
global $keys_count_array;
global $keys_count;
global $parent_keys;
foreach($jsonArrayData as $val) {
    $keys_count++;
    $keys_count_array[$val['id']] = $keys_count;
    $tmp_parent_key = 0;
    $parent_keys[$val['id']] = $tmp_parent_key;
    if(strpos($val['id'], 'foreach') !== false || strpos($val['id'], 'while') !== false) {
        array_push($find_keys_arr, $val['id']);
    }
    if(!empty($val['children'])) {
        $tmp_parent_key = $keys_count;
        find_keys($val['children'], $find_keys_arr, $tmp_parent_key);
    }
}
function find_keys($val, &$find_keys_arr, $tmp_parent_key) {
    global $keys_count_array;
    global $keys_count;
    global $parent_keys;
    foreach($val as $v) {
        $keys_count++;
        $parent_keys[$v['id']] = $tmp_parent_key;
        $keys_count_array[$v['id']] = $keys_count;
        if(strpos($v['id'], 'foreach') !== false || strpos($v['id'], 'while') !== false) {
            array_push($find_keys_arr, $v['id']);
        }
        if(!empty($v['children'])) {
            $tmp_parent_key = $keys_count;
            find_keys($v['children'], $find_keys_arr, $tmp_parent_key);
        }
    }
}
/***************End Keys*********************/
getNestedFinalData($jsonArrayData, $find_keys_arr);
pr($jsonArrayData);
//pr($parent_keys);die;
function getNestedFinalData($jsonArrayData, $find_keys_arr) {
    global $final_array;
    global $keys_count_array;
    global $parent_keys;
    $nested_count = 1;
    foreach($jsonArrayData as $key => $val) {
        $nested_count++;
        if(in_array($val['id'], $find_keys_arr)) {
            $else = 0;
            if(!empty($jsonArrayData[$key+1])) {
                $else = $keys_count_array[$jsonArrayData[$key+1]['id']];
            } else {
                $else = $parent_keys[$val['id']];
            }
            if(!empty($val['children'])) {
                $final_array[$val['id']] = array('then' => $nested_count, 'else' => $else);
            }
        }
        if(!empty($val['children'])) {
            $p_id = $val['id'];
            getChildNestedFinalData($jsonArrayData, $val['children'], $find_keys_arr, $nested_count, $p_id);
        }
    }
}

function getChildNestedFinalData($jsonArrayData, $req_data, $find_keys_arr, &$nested_count, $p_id) {
    global $final_array;
    global $keys_count_array;
    global $parent_keys;
    foreach($req_data as $req_key => $req_val) {
        $nested_count++;
        if(in_array($req_val['id'], $find_keys_arr)) {
            $else = 0;
            if(!empty($jsonArrayData[$req_key+1])) {
                $else = $keys_count_array[$jsonArrayData[$req_key+1]['id']];
            } else {
                $else = $parent_keys[$req_val['id']];
            }
            if(!empty($req_val['children'])) {
                $final_array[$req_val['id']] = array('then' => $nested_count, 'else' => $else);
            }
        }
        if(!empty($req_val['children'])) {
            $p_id = $req_val['id'];
            getChildNestedFinalData($jsonArrayData, $req_val['children'], $find_keys_arr, $nested_count, $p_id);
        }
    }
}
pr($final_array);
/*Get Final Data*/
//pr($find_keys_arr);

function pr($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
die('Test');


echo getmyuid().':'.getmygid(); //ex:. 0:0

echo "<br/>";
$media_url1='E:\xampp\htdocs\Teamerge_in/'.$_GET['folder'];
if(!is_dir($media_url1)){ print_r(array("success"=>"false","data"=>$media_url1." Folder does not exist","error_code"=>"10009")); }
echo "<br/>";
if(!is_writable($media_url1) && is_dir($media_url1)){ print_r(array("success"=>"false","data"=>$media_url1." Folder does not have permissions to upload file","error_code"=>"10009")); }

echo substr(sprintf('%o', fileperms($media_url1)), -4);
die;
//include("global.php");
echo dirname(__FILE__);
if(isset($_POST['submit']))
{
echo time();
$strServer = "10.140.0.7";
$strServerPort = "22";
$strServerUsername = "tm-sftp";
$strServerPassword = "ZAT9x5HceN";

//connect to server 
$resConnection = ssh2_connect($strServer, $strServerPort);

if(ssh2_auth_password($resConnection, $strServerUsername, $strServerPassword)){
	//Initialize SFTP subsystem
	$resSFTP = ssh2_sftp($resConnection);
	
	//
	//Send/Download file here
	//
	//$resFile = fopen("ssh2.sftp://{$resSFTP}/var/www/html/uploads/lalit.txt", 'w');
	//fwrite($resFile, "Yes it worked!");
	//fclose($resFile);

	//$check=ssh2_scp_send($resConnection, $_FILES['dataFile']['tmp_name'], "ssh2.sftp://{$resSFTP}/var/www/html/uploads/abc.jpg");
	echo $_FILES['dataFile']['tmp_name'];
	$fileContent=file_get_contents($_FILES['dataFile']['tmp_name']);
//	file_put_contents("ssh2.sftp://{$resSFTP}/var/www/html/uploads/3.jpg", $fileContent);
	//print_r($check);
	echo "<br/>haan chal gya<br/>";
echo time();

	//file_put_contents("ssh2.sftp://{$resSFTP}/var/www/html/uploads/lalit.txt", "Yes it works 111111");
}else{
	echo "Unable to authenticate on server";
}

}

?>
<form method="POST" enctype="multipart/form-data">
	<input type="file" name="dataFile" />
	<input type="submit" name="submit" value="SUBMIT"/>
</form>


<?php

die;

echo " <pre>";
menu_tree();
die;

$mediaAccessUrl=module_access_url(10,1);
if($mediaAccessUrl)
{
	$mediaAccessUrl=json_decode($mediaAccessUrl,true);
	$mediaAccessUrl=$mediaAccessUrl['access_url']."webservices/manage_media";
	$currentPath="E:/xampp/htdocs/Teamerge_in/company/9/uploads/media/images/media_1495536003_31369";
	
	$postImage=curl_post_ext($mediaAccessUrl,array('name'=>'11234'));
	print_r($postImage);
	
	//echo $currentPath."<br/>".$mediaAccessUrl;

}

?>
