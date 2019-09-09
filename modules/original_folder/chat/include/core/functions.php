<?php
function add_chatroom($id,$lang="en")
{
   global $db;
  // logger("8","",array("id"=>$id,"lang"=>$lang),4);
  // $id = new MongoID($id);
  // $arr = $db->sample->find(array('_id'=>$id));
  // $arr = add_id_multi($arr,"id",$lang);
  // return array("success"=>"true","data"=>$arr,"error_code"=>"100");
}
function adduserinchat($data)
{
    global $memcache;
    logger("35",$data,"",5,"/adduserinchat");
    $check = check_key_available($data,array('fid','oid'));
    if($check['success'] == 'true')
    {
        $key=$data["fid"].'_'.$data["oid"];
        $memcache->set($key, "1");
        return array("success"=>"true","data"=>"1","error_code"=>"35005"); //add in cache
    }
    else
    {
        return $check;
    }  
}
function getuserinchat($data)
{
     global $memcache;
    logger("35",$data,"",5,"/getuserinchat");
    $check = check_key_available($data,array('fid','oid'));
    if($check['success'] == 'true')
    {
        $key=$data["fid"].'_'.$data["oid"];
        $key2=$data["oid"].'_'.$data["fid"];
        $user1=$memcache->get($key);
        $user2=$memcache->get($key2);
        if($user1=="1" && $user2=="1")
        {
        return array("success"=>"true","data"=>"1","error_code"=>"35006"); //user found 
        }
        else
        {
          return array("success"=>"false","data"=>"0","error_code"=>"35007");  //user found not
        }
        
    }
    else
    {
        return $check;
    }  
}
function deleteuserinchat($data)
{
     global $memcache;
    logger("35",$data,"",5,"/deleteuserinchat");
    $check = check_key_available($data,array('fid','oid'));
    if($check['success'] == 'true')
    {
        $key=$data["fid"].'_'.$data["oid"];
        $user1=$memcache->delete($key);
        return array("success"=>"true","data"=>"1","error_code"=>"35008"); //user found delest in chat
    }
    else
    {
        return $check;
    } 
}
function add_chatroom_user($data)
{
   logger("35",$data,"",5,"/add_chatroom_user");
  
    $check = check_key_available($data,array('userid','users','name','chatgid'));
  
  if($check['success'] == 'true')
    {
        $t=time();
        $allnewusers=array();
        $uid=getfriendid($data['userid']);
        $checkchatroom=check_room($data['chatgid']);
          if($checkchatroom["success"]=="true")
            $insert= $checkchatroom;
        else
        {
            $insertchatroom=array("createdby"=>$uid,"name"=>$data['name'],"type"=>"0","lastactivity"=>$t,"chatuid"=>$data['chatgid']);
            $insert=insert_mysql($insertchatroom,'cometchat_chatrooms');
        }
        if($insert["success"]=="true"){
          $alluser=explode(",",$data['users']);
          
          foreach($alluser as $user)
          {  
            $uid=getfriendid($user);
            $allnewusers[]=$uid;
            $isuser=check_user_in_room($uid,$insert['data']);
            if($isuser=="1")
            { 
                $insertchatroomuser=array("userid"=>$uid,"chatroomid"=>$insert['data'],"lastactivity"=>$t,"isbanned"=>"0");  
                $insertuser=insert_mysql($insertchatroomuser,'cometchat_chatrooms_users');
            }
            
          } 
          $room_user=get_all_user_in_room($insert['data']);
         
          if($room_user["success"]=="true")
          {
            foreach($room_user["data"] as $newu)
            if (in_array($newu, $allnewusers)) {
            }
            else
            {
            user_delete_in_room($insert['data'],$newu);
            }
          }
            return array("success"=>"true","data"=>$insert["data"],"error_code"=>"35001");  // chat room create
        }
        else
        {
            return array("success"=>"true","data"=>$insert["data"],"error_code"=>"35002");  // chat room create not
        }
        
    }
    else
    {
        return $check;
    }   
}

function check_user_in_room($userid,$chatromid)
{
     $fields="userid";
    $table="cometchat_chatrooms_users";
    $conditions="userid=$userid and chatroomid=$chatromid";
    $query="Select $fields from $table where $conditions";
    $get_data=mysql_query($query);
    if(mysql_num_rows($get_data)>0)
    {
        return "2";
    }
    else
    {
        return "1";
    }
}
function check_room($chatroomid)
{   logger("35",$chatroomid,"",5,"/check_room");
    $fields="id";
    $table="cometchat_chatrooms";
    $conditions="chatuid='".$chatroomid."'";
     $query="Select $fields from $table where $conditions";
    $get_data=mysql_query($query);
    if(mysql_num_rows($get_data)>0)
        {
            $fetch=mysql_fetch_array($get_data);
            return array("success"=>"true","data"=>$fetch["id"]);
        }
        else
        {
            return array("success"=>"false","data"=>"No data available");
        }
    
   
}
function adduserinroom($data)
{       logger("35",$data,"",5,"/adduserinroom");
        $alluser=explode(",",$data['users']);
          $insert=check_room($data['chatgid']);
        if($insert["success"]=="true"){
          $alluser=explode(",",$data['users']);
          foreach($alluser as $user)
          {  
            $uid=getfriendid($user);
            $isuser=check_user_in_room($uid,$insert['data']);
            if($isuser=="1")
            { 
                $insertchatroomuser=array("userid"=>$uid,"chatroomid"=>$insert['data'],"lastactivity"=>$t,"isbanned"=>"0");  
                $insertuser=insert_mysql($insertchatroomuser,'cometchat_chatrooms_users');
            }
            
          } 
            return array("success"=>"true","data"=>$insert["data"],"error_code"=>"35003");  // chat room user insert
        }
        else
        {
            return array("success"=>"true","data"=>$insert["data"],"error_code"=>"35004");  // chat room not found
        }
}
function user_delete_in_room($roomid,$userid)
{
    delete_mysql("cometchat_chatrooms_users","userid=$userid and chatroomid=$roomid");
}
function get_all_user_in_room($roomid)
{   logger("35",$roomid,"",5,"/get_all_user_in_room");
    $alluser=array();
     $query="Select userid from cometchat_chatrooms_users where chatroomid='$roomid'";
    $get_data=mysql_query($query);
    if(mysql_num_rows($get_data)>0)
        {
            while($fetch=mysql_fetch_array($get_data))
            {
               $alluser[]= $fetch["userid"];
            }
            return array("success"=>"true","data"=>$alluser);
        }
        else
        {
            return array("success"=>"false","data"=>"No data available");
        }
}


function manage_user_chat_activity($data)
{
    //print_r($data);die;
    global $db;
    logger("35",$data,"",5,"/manage_user_chat_activity");
    $check = check_key_available($data,array('userId','status','deviceType'));
    if($check['success'] == 'true')
    {
        $userid=getfriendid($data['userId']);
        if($userid)
        {
            $newdata=array();
            $newdata['isdevice']="0";
            $isdevice="0";
            $newdata['status']='offline';
            $newdata['lastseen']=time();
            $newdata['lastactivity']=time();
            if(isset($data['deviceType']) && $data['deviceType']!="")
            {
                if($data['deviceType']=="ios" || $data['deviceType']=="android")
                {
                    $newdata['isdevice']="1";
                    $isdevice="1";
                }
                
            }
            if(isset($data['status']) && $data['status']!="")
            {
                if($data['status']=='1')
                {
                    $checkUserData=get_all_chat_user(array('id'=>$userid));
                    if($checkUserData['success']=='true' && !empty($checkUserData['data']))
                    {
                        $newdata['status']="available";
                        $updatetUserData=update_mysql($newdata,'cometchat_status','userid="'.$userid.'"');
                    }
                    else
                    {
                        $updatetUserData=insert_mysql(array('userid'=>$userid,'status'=>"available",'isdevice'=>$isdevice,'lastactivity'=>time(),'lastseen'=>time()),'cometchat_status');
                    }
                    

                }
                else if($data['status']=='2')
                {
                    $newdata['status']="offline";
                    $updatetUserData=update_mysql($newdata,'cometchat_status','userid="'.$userid.'"');
                }
                else if($data['status']=='3')
                {
                    //$newdata['status']="away";
                    $condition="userid='$userid'";
                    $updatetUserData=delete_mysql('cometchat_status',$condition);
                }
                
            }
            
            return array("success"=>"true","data"=>"","error_code"=>"35010");  
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"35011");  
        }
         
    }
    else
    {
        return $check;
    }
    
}


function get_all_chat_user($data)
{   logger("35",$data,"",5,"/get_all_chat_user");
    $alluser=array();
    if(isset($data['id']))
    {
        $query="Select * from cometchat_status where userId='".$data['id']."'";
    }
    else if(isset($data['status']))
    {
        $query="Select id,name from user where status='".$data['status']."'";
    }
    else
    {
        $query="Select id,name from user";
    }
    
    $get_data=mysql_query($query);
    if(mysql_num_rows($get_data)>0)
        {
            while($fetch=mysql_fetch_array($get_data))
            {
               array_push($alluser, $fetch);
            }
            return array("success"=>"true","data"=>$alluser);
        }
        else
        {
            return array("success"=>"false","data"=>"");
        }
}


function getfriendid($id)
{   logger("35",$id,"",5,"/getfriendid");
    $data=Select_Some('id','user',"iid='$id'");
    $fetch=mysqli_fetch_array($data);
    return $fetch['id'];
}

function get_friend_data_by_id($data)
{   logger("35",$data,"",5,"/get_friend_data_by_id");
    $check=check_key_available($data,array('userId'));
    if($check['success']=='true')
    {
        $info=Select_Some('id','user',"iid='$data[userId]'");
        if(is_array($info) && $info['success']=='false')
        {
            return array('data'=>"",'error_code'=>'3501','success'=>'false');
        }
        else
        {
             $fetch=mysqli_fetch_array($info);
             return array('data'=>$fetch['id'],'error_code'=>'3502','success'=>'true');
        } 
    }
    else
    {
        return $check;
    }
}

function manage_chat_user($data)
{
      
    logger("35",$data,"",5,"/manage_chat_user");
    $check=check_key_available($data,array('id'));
    if($check['success']=='true')
    {
        if($data['id']=='0' || $data['id']=='')
        {   
            $manage_user=insert_chat_user($data);      
        }
        else
        {
            $manage_user=update_chat_user($data); 
        }   
        return $manage_user;
    }
    else
    {
        return $check;
    }
    
}

function insert_chat_user($data)
{
    global $companyId;
    logger("35",$data,"",5,"/insert_chat_user");
    $check=check_key_available($data,array('iid','name','email','password','url'));
    if($check['success']=='true')
    {
        $condition=array(); 
        $condition['imagepath']=$data['url'].'/company/'.$companyId.'/uploads/default_media/avatar.png';
        $condition['iid']=$data['iid'];
        $condition['name']=$data['name'];
        $condition['email']=$data['email'];
        $condition['password']=md5($data['password']);
        $insertUserData=insert_mysql($condition,'user');
        if($insertUserData['success']=='true')
        {
            return array('data'=>$fetch['id'],'error_code'=>'3503','success'=>'true');
        }
        else
        {
            return array('data'=>$fetch['id'],'error_code'=>'3504','success'=>'false');
        }
    }
    else
    {
        return $check;
    }
}

function update_chat_user($data)
{

    global $companyId;
    logger("35",$data,"",5,"/update_chat_user");
    $id=$data['id'];
    unset($data['id']);
    $condition=array();
    if(isset($data['password']) && $data['password']!="")
    {
        $condition['password']=md5($data['password']);
    }
    if(isset($data['name']) && $data['name']!="")
    {
        $condition['name']=$data['name'];
    }
    $updatetUserData=update_mysql($condition,'user','iid="'.$id.'"');
    if($updatetUserData['success']=='true')
    {
        return array('data'=>$fetch['id'],'error_code'=>'3505','success'=>'true');
    }
    else
    {
        return array('data'=>$fetch['id'],'error_code'=>'3506','success'=>'false');
    }
    
}

function delete_chat_user_data($data)
{
     logger("35",$data,"",5,"/delete_chat_user_data");
    global $companyId;
    $check=check_key_available($data,array('id'));
    if($check['success']=='true')
    {
        
        $deleteUserData=delete_mysql('user','iid="'.$data['id'].'"');
        if($deleteUserData['success']=='true')
        {
            return array('data'=>$data['id'],'error_code'=>'3507','success'=>'true');
        }
        else
        {
            return array('data'=>$data['id'],'error_code'=>'3508','success'=>'false');
        }
    }
    else
    {
        return $check;
    }
}


?>