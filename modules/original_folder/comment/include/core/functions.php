<?php
function check_exists($data)
{ 
    logger("8",$data,"",5,"/check_exists");
    $fields=array('amid'=>$data['amid'],"asmid"=>$data['asmid'],"aiid"=>$data['aiid'],"data.userId"=>$data['userId'],"data.type"=>"$data[type]");
    
    $tmp = count_mongo('commentAssociate',$fields);
    if($tmp>0)
    {
     return true;
    }
    return false;
}

function get_count($data)
{
   logger("8",$data,"",5,"/get_count");
    $check = check_key_available($data,array('amid','asmid','aiid','type'));
    if($check['success'] == 'true')
    {
        $fields = array('amid'=>$data['amid'],"asmid"=>$data['asmid'],"aiid"=>$data['aiid'],"data.type"=>"$data[type]");
        if(isset($data['commentId']))
        {
            $fields['data.commentId'] = 0;
        }
        if (isset($data['getPrivate']) && $data['getPrivate'] == '0') {
            $fields['data.isPrivate'] = '0';
        }
        $tmp = count_mongo('commentAssociate',$fields);
         
        return array("success"=>"true","data"=>$tmp,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function manage_like($data)
{
    logger("8",$data,"",5,"/manage_like");
    $check = check_key_available($data,array('amid','asmid','aiid','userId','type'));
    if($check['success'] == 'true')
    {
        if(!check_exists($data))
        {
    		$result = add_like($data);
        }
        else
		{
			$result = delete_like($data);
		}
        return $result;
    }
    else
    {
        return $check;
    }    
}

function add_like($data)
{   global $companyId;
    $fields=array(
        'userId'=>$data['userId'],
        'type'=>'like',
        'datetime'=>new MongoDate(),
        '_id'=>new MongoId()
        );
    logger("8",$data,"",5,"/add_like");
    $res = insert_mongo('comment',$fields);
    if($res['n']==1)
    {
        return array("success"=>"false","data"=>$fields,"error_code"=>"8001");
    }
    else
    {
        $ins_id = db_id($fields);
        associate_module("8",$ins_id,$data['amid'],$data['asmid'],$data['aiid'],array('userId'=>$data['userId'],'type' => 'like'),'add');
        $userId=$data['userId'];
        if(isset($data['amid']) && $data['amid']=="7")
        {
            $getuserblog=get_blog_by_id(array('id'=>$data['aiid']));
            $userId=$getuserblog['data'][0]['userId'];
        }
        insert_notification(array('customerId'=>$companyId,'mid'=>$data['amid'],'smid'=>$data['asmid'],'userId'=>$userId,'itemId'=>$ins_id."||".$data['userId'],'eid'=>"33","extra"=>json_encode($fields)));
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"8012");
    }
}

function delete_like($data)
{
    global $companyId;
    $condition=array(
        'amid' => $data['amid'],
        'asmid' => $data['asmid'],
        'aiid' => $data['aiid'],
        'data.userId' => $data['userId'],
        'data.type' => 'like'
        );
    
    logger("8",$data,"",5,"/delete_like");
    $res = select_mongo('commentAssociate',$condition);
    $res = add_id($res,'id');
    $iid = $res[0]['iid'];
    
    $res = delete_mongo('comment',array('_id' => new MongoId($iid)));
    if($res['n']==0)
    {
        return array("success"=>"false","data"=>$condition,"error_code"=>"8002");
    }
    else
    {
        /*$userId=$data['userId'];
        if(isset($data['amid']) && $data['amid']=="7")
        {
            $getuserblog=get_blog_by_id(array('id'=>$data['aiid']));
            $userId=$getuserblog['data'][0]['userId'];
        }
        $condition['type']='unlike';
        insert_notification(array('customerId'=>$companyId,'mid'=>$data['amid'],'smid'=>$data['asmid'],'userId'=>$userId,'itemId'=>$iid."||".$data['userId'],'eid'=>"33","extra"=>json_encode($condition)));*/
        associate_module("8",$iid,'','','',array(),'delete');
        return array("success"=>"true","data"=>$condition,"error_code"=>"8013");
    } 
    
}

function manage_rating($data)
{
    logger("8",$data,"",5,"/manage_rating");
    $check = check_key_available($data,array('amid','asmid','aiid','userId','type','rating'));
    if($check['success'] == 'true')
    {
        if(!check_exists($data))
        {
    		$result = add_rating($data);
        }
        else
		{
			$result = update_rating($data);
		}
        return $result;
    }
    else
    {
        return $check;
    }    
}

function add_rating($data)
{
    $fields=array(
        'userId'=>$data['userId'],
        'type'=>'rating',
        'rating'=>$data['rating'],
        'datetime'=>new MongoDate(),
        '_id'=>new MongoId()
        );
    logger("8",$data,"",5,"/add_rating");
    $res = insert_mongo('comment',$fields);
    if($res['n']==1)
    {
        return array("success"=>"false","data"=>$fields,"error_code"=>"8003");
    }
    else
    {
        $ins_id = db_id($fields);
        associate_module("8",$ins_id,$data['amid'],$data['asmid'],$data['aiid'],array('userId'=>$data['userId'],'type' => 'rating','rating' => $data['rating']),'add');
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"8014");
    }
}

function update_rating($data)
{
	$condition=array(
        'amid' => $data['amid'],
        'asmid' => $data['asmid'],
        'aiid' => $data['aiid'],
        'data.userId' => $data['userId'],
        'data.type' => 'rating'
        );
    
    logger("8",$data,"",5,"/update_rating");
    $res = select_mongo('commentAssociate',$condition);
    $res = add_id($res,'id');
    $iid = $res[0]['iid'];
    
    $res = update_mongo('comment',array('rating'=>$data['rating']),array('_id' => new MongoId($iid)));
    if($res['n']==0)
    {
        return array("success"=>"false","data"=>$data,"error_code"=>"8004");
    }
    else
    {
         associate_module("8",$iid,$data['amid'],$data['asmid'],$data['aiid'],array('userId'=>$data['userId'],'type' => 'rating','rating' => $data['rating']),'add');
        return array("success"=>"true","data"=>$data,"error_code"=>"8015");
    } 
   
}

function get_aiid_rating($data)
{
    logger("8",$data,"",5,"/get_aiid_rating");
    $check = check_key_available($data,array('amid','asmid','aiid'));
    if($check['success'] == 'true')
    {
        $aiid = explode("|",$data['aiid']);
        $final_array=array();
        for($i=0;$i<sizeof($aiid);$i++)
        {
            $fields=array(
            'amid'=>$data['amid'],
            'asmid'=>$data['asmid'],
            'aiid'=>$aiid[$i],
            'data.type' => "rating"
            );

            $tmp = select_mongo('commentAssociate',$fields);
           
            $res=add_id($tmp,"id");
            $sum=0;$count=0;
            foreach($res as $arr)
            {
                $count++;
                $sum=$sum+$arr['data']['rating'];
            }
            $rateNum=round($sum/$count);
            array_push($final_array,array("aiid"=>$fields['aiid'],"rating"=>$rateNum));
        }
        return array("success"=>"true","data"=>$final_array,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function get_user_rating($data)
{
    logger("8",$data,"",5,"/get_user_rating");
    $check = check_key_available($data,array('amid','asmid','aiid','userId'));
    if($check['success'] == 'true')
    {
        $userId = explode("|",$data['userId']);
        $final_array=array();
        for($i=0;$i<sizeof($userId);$i++)
        {
            $fields=array(
            'amid'=>$data['amid'],
            'asmid'=>$data['asmid'],
            'aiid'=>$data['aiid'],
            'data.userId'=>$userId[$i],
            'data.type' => 'rating'
            );

            $tmp = select_mongo('commentAssociate',$fields);
            $res=add_id($tmp,"id");
            array_push($final_array,array("aiid"=>$data['aiid'],"userId"=>$userId[$i],"rating"=>$res[0]['data']['rating']));
        }
        return array("success"=>"true","data"=>$final_array,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function manage_comment($data)
{
    
    logger("8",$data,"",5,"/manage_comment");
    $check = check_key_available($data,array('id','amid','asmid','aiid','userId','commentId','comment'));
    if($check['success'] == 'true')
    {
        if($data['id']==0)
        {
    		$result = add_comment($data);
        }
        else
		{
			$result = update_comment($data);
		}
        return $result;
    }
    else
    {
        return $check;
    }    
}

function add_comment($data)
{
    global $companyId;
    logger("8",$data,"",5,"/add_comment");
	$isPrivate = isset($data['isPrivate']) ? $data['isPrivate'] : '0';
    $fields=array(
        'userId'=>$data['userId'],
        'type'=>'comment',
        'comment'=>$data['comment'],
        'commentId'=>$data['commentId'],
        'datetime'=>new MongoDate(),
        'status' => "1",
		'isPrivate' => $isPrivate,
        '_id'=>new MongoId()
        );
  
    $extradata=array(
        'userId'=>$data['userId'],
        'type'=>'comment',
        'comment'=>$data['comment'],
        'commentId'=>$data['commentId']
        );
    $res = insert_mongo('comment',$fields);
    if($res['n']==1)
    {
        return array("success"=>"false","data"=>$fields,"error_code"=>"8005");
    }
    else
    {
        $ins_id = db_id($fields);
        associate_module("8",$ins_id,$data['amid'],$data['asmid'],$data['aiid'],array('userId'=>$data['userId'],'type' => 'comment','commentId' => $data['commentId'],'comment' => $data['comment'], 'isPrivate' => $isPrivate),'add');
        /*sendCommentNotification($data['amid'],$data['asmid'],"0",$data['aiid'],"comment",$data['userId'],$fields);*/
        $userId=$data['userId'];
        if(isset($data['amid']) && $data['amid']=="7")
        {
           $getuserblog=get_blog_by_id(array('id'=>$data['aiid']));
           $userId=$getuserblog['data'][0]['userId'];
           insert_notification(array('customerId'=>$companyId,'mid'=>$data['amid'],'smid'=>$data['asmid'],'userId'=>$userId,'itemId'=>$ins_id."||".$data['userId'],'eid'=>"32","extra"=>json_encode($extradata)));
        }
        
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"8016");
    }
}

function update_comment($data)
{
    logger("8",$data,"",5,"/update_comment");   
    $res = update_mongo('comment',array('comment'=>$data['comment'],'commentId'=>$data['commentId']),array('_id' => new MongoId($data['id'])));
    if($res['n']==0)
    {
        return array("success"=>"false","data"=>$data,"error_code"=>"8006");
    }
    else
    {
         associate_module("8",$data['id'],$data['amid'],$data['asmid'],$data['aiid'],array('userId'=>$data['userId'],'type' => 'comment','commentId' => $data['commentId'],'comment' => $data['comment']),'add');
        return array("success"=>"true","data"=>$data,"error_code"=>"8017");
    } 
}

function update_comment_status($data)
{
    logger("8",$data,"",5,"/update_comment_status"); 
    $check = check_key_available($data,array('id','status'));
    if($check['success'] == 'true')
    {
        $res = update_mongo('comment',array('status'=>$data['status']),array('_id' => new MongoId($data['id'])));
        if($res['n']==0)
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"8006");
        }
        else
        {
            return array("success"=>"true","data"=>$data,"error_code"=>"8017");
        }
    }
    else
    {
        return $check;
    }
}

function delete_comment($data)
{
	logger("8",$data,"",5,"/delete_comment");
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        $id = explode("|",$data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
            associate_module(8,$val,'','','',array(),'delete');
        }
        $condition=array('_id'=>array('$in'=> $id));
        $condition1=array('commentId'=>array('$in'=> $id));
        $condition2=array('iid'=>array('$in'=> $id));
        $condition3=array('data.commentId'=>array('$in'=> $id));

	
        $res = delete_mongo('comment',$condition);
        $res = add_id($res,"id");
	
        $res1 = delete_mongo('comment',$condition1);
        $res1 = add_id($res1,"id");
	
        $res2 = delete_mongo('commentAssociate',$condition2);
        $res2 = add_id($res2,"id");

        $res3 = delete_mongo('commentAssociate',$condition3);
        $res3 = add_id($res3,"id");
        if($res['1']==sizeof($id))
        {
            return array("success"=>"true","data"=>$data,"error_code"=>"7003");
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"7004");
        }
    }
    else
    {
        return $check;
    } 
}

function get_comment_by_id($data)
{
    logger("8",$data,"",5,"/get_comment_by_id");
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        $arr = array();
        if($data['id']!=0)
        {
            $id = explode("|",$data['id']);
            foreach ($id as $key => $val) {
                $id[$key] = new MongoId($val);
            }
            $arr=array('_id'=>array('$in'=> $id));
        }
        
        if(isset($data['timestamp']))
        {
            $arr['lastUpdate'] = array('$gt' => new MongoDate($data['timestamp'])); 
        }

        if(isset($data['type']))
        {
            $arr['type'] = $data['type']; 
            $arr['commentId'] = "0";
        }
        if(isset($data['status']))
        {
            $arr['status'] = $data['status'];
        }
        if(isset($data['nor']))
        {
            if(isset($data['index']))
            {
                $res = select_limit_mongo('comment',$arr,array(),$data['index'],$data['nor']);
            }
            else
            {
                $res = select_limitonly_mongo('comment',$arr,array(),$data['nor']);   
            }
        }
        else
        {
            $res = select_mongo('comment',$arr,array());
        }
    
        $res = add_id($res,"id");

        if(isset($data['child']) && $data['child']==1)
        {
            $ChildCondition=array();
            if(isset($data['status']))
            {
                $ChildCondition['status'] = $data['status'];
            }
            foreach ($res as $key => $val) 
            {
                $ChildCondition['commentId'] = $val['id'];
                $child_comment = select_mongo('comment',$ChildCondition);
                $child_comment = add_id($child_comment,'id');
                $res[$key]['child_comment'] = $child_comment;
            }
        }

        if(isset($data['amid']) && isset($data['asmid']))
        {
            foreach ($res as $key => $val) {
                $association_data = get_association_data("8",$data['amid'],$data['asmid'],$val['id']);
                $res[$key]['association_data'] = $association_data;
            }
        }
        
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function get_comments($data) {
    logger("8",$data,"",5,"/get_comments");
    $check = check_key_available($data, array('amid', 'asmid', 'aiid'));
    if ($check['success'] == 'true') {
        $arr = array(
            'amid' => $data['amid'],
            'asmid' => $data['asmid']
        );
        if(!empty($data['aiid'])) {
            $arr['aiid'] = $data['aiid'];
        }
        
        if(!empty($data['commentId'])) {
            $arr['data.commentId'] = $data['commentId'];
        }

        if (isset($data['child'])) {
            $arr['data.commentId'] = 0;
        }
        
        if (isset($data['getPrivate']) && $data['getPrivate'] == '0') {
            $arr['data.isPrivate'] = 0;
        }
		
        if (isset($data['timestamp'])) {
            $arr['lastUpdate'] = array('$gt' => new MongoDate($data['timestamp']));
        }
        if (isset($data['leave_comments']) && !empty($data['leave_comments'])) {
            $iid_array = array();
            if (!is_array($data['leave_comments'])) {
                $iid_array1 = explode(",", $data['leave_comments']);
            }
            foreach ($iid_array1 as $key => $value) {
                array_push($iid_array, $value);
            }
            $arr['iid'] = array('$nin' => $iid_array);
            unset($data['leave_comments']);
        }
        if (isset($data['leave_reply_comments']) && !empty($data['leave_reply_comments'])) {
            $iid_array = array();
            if (!is_array($data['leave_reply_comments'])) {
                $iid_array1 = explode(",", $data['leave_reply_comments']);
            }
            foreach ($iid_array1 as $key => $value) {
                array_push($iid_array, $value);
            }
            $arr['iid'] = array('$nin' => $iid_array);
            unset($data['leave_reply_comments']);
        }
        //return array("success" => "true", "data" => $arr, "error_code" => "100");
        if (isset($data['nor'])) {
            
            if (isset($data['index'])) {
                $res = select_limit_mongo('commentAssociate', $arr, array('iid'), $data['index'], $data['nor']);
            } else {
                $res = select_limitonly_mongo('commentAssociate', $arr, array('iid'), $data['nor']);
            }
        } else {
             
            $res = select_mongo('commentAssociate', $arr, array('iid'));
        }

        $res = add_id($res, "id");
        if (isset($data['getLast'])) {
           $res=  select_sort_limit_mongo('commentAssociate',$arr,array(),array('iid'=>-1),'0','1'); 
        }

        $res = add_id($res, "id");

        $id = array();
        foreach ($res as $key => $val) {
            $id[$key] = new MongoId($val['iid']);
        }

        $condition = array('_id' => array('$in' => $id), "type" => "comment");
        if (isset($data['status'])) {
            $condition['status'] = $data['status'];
        }
        $res = select_mongo('comment', $condition);
        $res = add_id($res, "id");
        if (isset($data['deviceType'])) {
            foreach ($res as $key => $val) {
                $get_resource = get_resource_by_id(array('id' => $val['userId']));
                if ($get_resource['success'] == 'false') {
                    $userinfo = array('name' => "", 'email' => "", 'userId' => "", 'status' => "", 'image' => "");
                    $res[$key]['userInfo'] = $userinfo;
                } else {
                    $uemail = $get_resource['data'][0]['email'];
                    $uname = $get_resource['data'][0]['name'];
                    $ustatus = $get_resource['data'][0]['status'];
                    $umedia = isset($get_resource['data'][0]['media']) ? $get_resource['data'][0]['media'] : "";
                    $uid = $get_resource['data'][0]['id'];
                    unset($val['userId']);
                    $res[$key] = $val;
                    $userinfo = array('name' => $uname, 'email' => $uemail, 'userId' => $uid, 'status' => $ustatus, 'image' => $umedia);
                    $res[$key]['userInfo'] = $userinfo;
                }
            }
        }

        if (isset($data['child']) && $data['child'] == 1) {
            $ChildCondition=array();
            if (isset($data['status'])) {
            $ChildCondition['status'] = $data['status'];
            }
            foreach ($res as $key => $val) {
                $ChildCondition['commentId']=$val['id'];
                $child_comment = select_mongo('comment', $ChildCondition);
                $child_comment = add_id($child_comment, 'id');
                $res[$key]['child_comment'] = $child_comment;
            }
        }
        
        if(!empty($data['count_child'])) {
            foreach ($res as $key => $val) {
                $res[$key]['total_reply'] = count_mongo('commentAssociate', array("data.commentId" => $val['id']));
            }
        }

        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function manage_comment_data($data)
{
    logger("8",$data,"",5,"/manage_comment_data");
    $check = check_key_available($data,array('amid','asmid','aiid','userId','type'));
    if($check['success'] == 'true')
    {
        if(!check_exists($data))
        {
            $result = add_comment_data($data);
        }
        else
        {
            if($data['type']=='play' || $data['type']=='share')
            {
                $result = add_comment_data($data);
            }
            else
            {
                $result = delete_comment_data($data);
            }
        }
        return $result;
    }
    else
    {
        return $check;
    }    
}

function add_comment_data($data)
{
    $fields=array(
        'userId'=>$data['userId'],
        'type'=>$data['type'],
        'datetime'=>new MongoDate(),
        '_id'=>new MongoId()
        );
    logger("8",$data,"",5,"/add_comment_data");
    $res = insert_mongo('comment',$fields);
    if($res['n']==1)
    {
        return array("success"=>"false","data"=>$fields,"error_code"=>"8008");
    }
    else
    {
	
        $ins_id = db_id($fields);
        sendCommentNotification($data['amid'],$data['asmid'],0,$data['aiid'],$data['type'],$data['userId'],$data);
	
        associate_module("8",$ins_id,$data['amid'],$data['asmid'],$data['aiid'],array('userId'=>$data['userId'],'type' => $data['type']),'add');
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"8019");
       

    }
}

function delete_comment_data($data)
{
    $condition=array(
        'amid' => $data['amid'],
        'asmid' => $data['asmid'],
        'aiid' => $data['aiid'],
        'data.userId' => $data['userId'],
        'data.type' => $data['type']
        );
    
    logger("8",$data,"",5,"/delete_comment_data");
    $res = select_mongo('commentAssociate',$condition);
    $res = add_id($res,'id');
    $iid = $res[0]['iid'];
    
    associate_module("8",$iid,'','','',array(),'delete');
    $res = delete_mongo('comment',array('_id' => new MongoId($iid)));

    if($res['n']==0)
    {
        return array("success"=>"false","data"=>$condition,"error_code"=>"8009");
    }
    else
    {
        
        return array("success"=>"true","data"=>$condition,"error_code"=>"8020");
    } 
}

function get_comment_data($data)
{   logger("8",$data,"",5,"/get_comment_data");
    $check = check_key_available($data,array('amid','asmid',"type"));
    if($check['success'] == 'true')
    {
        $condition = array("amid"=>$data['amid'],"asmid"=>$data['asmid'],"data.type"=>$data['type']);
        if(isset($data['userId']))
        {
            $condition['data.userId'] = $data['userId'];
        }

        if(isset($data['aiid']))
        {
            $condition['aiid'] = $data['aiid'];
        }
        
        $res = select_mongo('commentAssociate',$condition,array());
        $res = add_id($res,"id");
        return array("success"=>"true","data"=>$res,"error_code"=>"8022");
    }
    else
    {
        return $check;
    }   
}
function get_count_comment_data($data)
{   logger("8",$data,"",5,"/get_count_comment_data");
    $check = check_key_available($data,array('amid','asmid',"type"));
    if($check['success'] == 'true')
    {
        $condition = array("amid"=>$data['amid'],"asmid"=>$data['asmid'],"data.type"=>$data['type']);
        if(isset($data['userId']))
        {
            $condition['data.userId'] = $data['userId'];
        }
        
        $res = count_mongo('commentAssociate',$condition,array());
        return array("success"=>"true","data"=>$res,"error_code"=>"8022");
    }
    else
    {
        return $check;
    }   
}

function sendCommentNotification($mid,$smid,$userId,$aiid,$type,$actionBy,$data)
{
    $eid = 0;
    if($type == 'like')
    {
        Switch($mid)
        {
            case "5":
                $eid = "37";
            break;
            case "6":
                $eid = "34";
            break;
            case "7":
                $eid = "33";
            break;
        }
    }
    else if($type == 'comment')
    {
        Switch($mid)
        {
            case "5":
                $eid = "36";
            break;
            case "6":
                $eid = "35";
            break;
            case "7":
                $eid = "32";
            break;
        }
    }
    else
    {

    }
    //print_r(array('customerId'=>"43",'mid'=>$mid,'smid'=>$smid,'userId'=>$userId,'itemId'=>$aiid,'eid'=>$eid));die;
	if($eid!=0)
	{
		insert_notification(array('customerId'=>"43",'mid'=>$mid,'smid'=>$smid,'userId'=>$userId,'itemId'=>$aiid."||".$actionBy,'eid'=>$eid,"extra"=>json_encode($data)));
	}
}
?>
