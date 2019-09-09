<?php
include_once '../../../../global.php';
$action=$_REQUEST['action'];
 
if(isset($_REQUEST['user_add']))
{
        $send=array(
          'category'=>$category,
          'role'=>json_encode($permission),
          'role_result'=>'',
          'user_type'=>'user',
          'username'=>$email,
          'email'=>$email,
          'name'=>$name,
          'password'=>$password,
          'age'=>$age,
          'status'=>'0',
          'profile_picture'=>$profile_picture,
          'login_type'=>'normal',
          'manager'=>$manager,
          'parentId'=>$parentId,
          'id'=>'0'
          );
          $output = curl_post("/manage_user",$send);
          $aiid=$output['data'];
        

        if($_FILES['profile_picture']['name']!="")
        {
               $tmp = file_get_contents($_FILES['profile_picture']['tmp_name']);
               $array = explode('.', $_FILES['profile_picture']['name']);
               $ext= end($array);
               $outputs=curl_post("/manage_media",array('id'=>"0",'smid'=>"0",'amid'=>"1",'asmid'=>"1",'aiid'=>$aiid,'mediaName'=>"userImg",'mediaType'=>"image",'userImg'=>urlencode(base64_encode($tmp)),'base64enc'=>'1','extension'=>$ext,'multimedia'=>0));
         logger_ui("add_user/manage_media","",$outputs,5);
        }
        echo json_encode($output);
    }
    
if(isset($_REQUEST['data_id']))
{
    $data_id=$_REQUEST['data_id'];
    $output=curl_post($webservice_url."/delete_user",array("user_id"=>$data_id));
    if($output){
        echo $output;
    }
    else{
        echo "0";
    }    
}



if($action=='get_user_data')
{
    $data_id=$_REQUEST['id'];
    
    $output=curl_post("/get_resource_by_id",array("id"=>$data_id,"asmid"=>1,"amid"=>10));
    echo json_encode($output); 
}

 if($action=='change_user_password'){
    
   $uId=$_REQUEST['uId'];
   $new_password=$_REQUEST['pwd'];
   
         $output=curl_post("/manage_user",array('password'=>$new_password,'id'=>$uId)); 
         echo json_encode($output);
 }

?>
