<?php
function get_oauth_token($data)
{  logger("1",$data,"",5,"/get_oauth_token");
   $getAuthCode=curl_post_ext(OAUTH_URL."/authorize.php?response_type=code&client_id=".$data['client_id']."&state=xyz",array('authorized'=>'yes'));

   if($getAuthCode['success']=='true'){
      $getToken=curl_post_ext(OAUTH_URL."/token.php",array('grant_type'=>'authorization_code','client_id'=>$data['client_id'],'client_secret'=>$data['client_secret'],'redirect_uri'=>'http://localhost/oauth/demo/token.php','code'=>$getAuthCode['data']));
      if($getToken['access_token'] && $getToken['refresh_token']){
         return array('success'=>'true','data'=>$getToken,'error_code'=>'100');
      }else{
         return array('success'=>'false','data'=>$getToken,'error_code'=>'101');
      }
   }
   else{
      return array('success'=>'false','data'=>$getAuthCode,'error_code'=>'201');
   }
}

function verify_token($data){
   logger("1",$data,"",5,"/verify_token");
   $check=check_key_available($data,array('token','client_id','client_secret','refresh_token'));
   if($check['success']=='true')
   {
      $verify_token=curl_post_ext(OAUTH_URL."/resource.php",array('access_token'=>$data['token']));
      if(isset($verify_token['success'])=='true'){
         return $verify_token;
      }
      else
      {
         if($verify_token['error']=='expired_token' && $data['deviceType']=='desktop')
         {
            $tokenData=array('client_id'=>$data['client_id'],'client_secret'=>$data['client_secret'],'refresh_token'=>$data['refresh_token']);
            $refresh_token=refresh_token($tokenData);
            return $refresh_token;
         }
         else
         {
            return array('success'=>'false','data'=>$verify_token,'error_code'=>'301');
         }
      }
   }
   else
   {
      return $check;
   }
}

function refresh_token($data){
   logger("1",$data,"",5,"/refresh_token");
   $check=check_key_available($data,array('client_id','client_secret','refresh_token'));
   if($check['success']=='true')
   {
      $token=$data['token'];
      $refresh_token=curl_post_ext(OAUTH_URL."/token.php",array('grant_type'=>'refresh_token','client_id'=>$data['client_id'],'client_secret'=>$data['client_secret'],'refresh_token'=>$data['refresh_token']));
         if($refresh_token['access_token'] && $refresh_token['refresh_token']){
            return array('success'=>'true','data'=>$refresh_token,'error_code'=>'100');
         }else{
            return array('success'=>'false','data'=>$refresh_token,'error_code'=>'401');
         }
   }
   else
   {
      return $check;
   }
}

function convert_in_binary($hexCodes)
{  logger("1",$hexCodes,"",5,"/convert_in_binary");
   $binaryCode='';
   $hexCodes=str_split($hexCodes);
   for($i=0;$i<sizeof($hexCodes);$i++)
   {
      $binaryCode.="".decbin(hexdec($hexCodes[$i]));
   }
   return format_to_digits($binaryCode,16);
}

function format_to_digits($digit,$totalLength)
{  
   $digitArray=str_split($digit);
   if(sizeof($digitArray)<$totalLength){ $totalZero=$totalLength-sizeof($digitArray); for($k=0;$k<$totalZero;$k++){ array_unshift($digitArray, "0"); } }
   return join($digitArray);
}

function get_hex_code_from_permissions($allPermissions,$userPermission)
{
   $binaryPermissions=array();
   foreach($allPermissions as $permission)
   {
      foreach($userPermission as $uPersmission)
      {
         if($permission['pid']==$uPersmission){ array_push($binaryPermissions,$permission['hexId']); }
      }
   }
   $formatted_value = format_to_digits(array_sum($binaryPermissions),16);
   //0000-0001-1111-1011
   //$binary = '1111111111111111';
   $hexCode=format_to_digits(base_convert($formatted_value, 2, 16),4); // 7f
   
   return $hexCode;
}

function get_current_module_hex($permissions,$mid,$smid)
{
   global $globalPermissionsIndex;
   $index=$globalPermissionsIndex[$mid][$smid]*4;
   return $permissions=intval(substr($permissions,$index,4),16);
}

function get_hexa_permissions($data)
{  logger("1",$data,"",5,"/get_hexa_permissions");
   $check=check_key_available($data,array('roles'));
   if($check['success']=='true')
   {
      $getPermissions=select_mongo('subModuleSetting',array(),array('smval','permission.hexId','permission.pid'));
      $getPermissions=add_id($getPermissions);

      $allSubmodules=array();
      foreach($getPermissions as $pms){ array_push($allSubmodules,$pms['smval']); }
      //print_r($allSubmodules);

     // $permissions=array();
      $role=$data['roles'];
       if(!empty($role)){
          $role_id=explode(",",$role);
          foreach($role_id  as $v){
          $get_roles = get_roles(array('id'=>$v));
          $get_roles=$get_roles['data'][0];
          $nat = json_decode($get_roles['permission'],true);
          foreach($nat  as $key1 => $obj1){
               foreach($obj1 as $obkey=>$obj)
               {
                  $permissions[$obkey]=$obj;
               }
             }
          }
       } 

      $permissionsInHexcode=array();
      $subModules=array();
      foreach($allSubmodules as $asm)
      {
               $getPermissions=select_mongo('subModuleSetting',array('smval'=>$asm),array('smval','permission.hexId','permission.pid'));
               $getPermissions=add_id($getPermissions);
               $getPermissions=$getPermissions[0];
              
               if(isset($permissions[$asm]))
               {
                  $userModulePermissions=$permissions[$asm];
                  $hexCode=get_hex_code_from_permissions($getPermissions['permission'],$userModulePermissions);
                  $permissionsInHexcode[]=$hexCode;
               }
               else
               {
                  $permissionsInHexcode[]='0000';
               
               }
               $subModules[]=$asm;
           
      }
      $pm=implode("",$permissionsInHexcode);
      $sm=implode("|",$subModules);
      return array('success'=>'true','data'=>array('sm'=>$sm,'pm'=>$pm),'error_code'=>'100');
   }
   else
   {
      return $check;
   }
}

function hex_to_binary($hexCode)
{  logger("1",$hexCode,"",5,"/hex_to_binary");
   $binaryCode=array();
   $hexCode=str_split($hexCode);
   for($i=0;$i<sizeof($hexCode);$i++)
   {
      $binaryCode[]=decbin(hexdec($hexCode[$i]));
   }
   return format_to_digits(implode("",$binaryCode),16);
}


function check_hexa_permission($permissions,$access)
{
   global $globalPermissionsIndex,$permission_values;
   $permit=0;
   foreach($access as $accessKey)
   {
      if($permissions & $permission_values[$accessKey]){
         $permit=1;
      }
   }
   if($permit){
      return array('success'=>'true','data'=>'','error_code'=>'100');
   }
   else
   {
      rs('Access Denied',"101","false");
   }
}

function get_current_token()
{
   return $_SESSION['user']['token']['access_token'];
}

function get_refresh_token()
{
   return $_SESSION['user']['token']['refresh_token'];
}
?>