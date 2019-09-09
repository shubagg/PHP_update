<?php
function manage_event($data)
{
    logger("25",$data,"",5,"/manage_event");
    $check = check_key_available($data,array('id','title','desc'));
    if($check['success'] == 'true')
    {
        switch($data['id'])
        {
            case "0":
                $manage = add_event($data);
            break;
            
            default:
                $manage = update_event($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }    
}

function add_event($data)
{    
    logger("25",$data,"",5,"/add_event");
    $data['status'] = "0";
    $data['lastUpdate'] = new MongoDate();
    $data['createdOn'] = new MongoDate();
    unset($data['id']);
    $res = insert_mongo('event',$data);
    if($res['n']==1)
    {
        return array("success"=>"false","data"=>$data,"error_code"=>"25001");
    }
    else
    {
        $ins_id = db_id($data);
        //prepare_send_notification("25","1","0",$ins_id,'24');
        //on_item_post(array("customerId"=>'43',"mid"=>'25',"smid"=>'1',"userId"=>$data['userId'],"itemId"=>$ins_id,"table"=>'blog'));
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"25006");
    }
}

function update_event($data)
{
    logger("25",$data,"",5,"/update_event");
    $cond=array(
        '_id'=>new MongoId($data['id'])
    );
    $data['lastUpdate'] = new MongoDate();
    $id = $data['id'];
    unset($data['id']);
    $res = update_mongo('event',$data,$cond);
    if($res['n']==0)
    {
        return array("success"=>"false","data"=>$data,"error_code"=>"25002");
    }
    else
    {
        // prepare_send_notification("25","1","0",$id,'225');
        return array("success"=>"true","data"=>$data,"error_code"=>"25005");
    } 
}

function get_event_by_id($data)
{
    logger("25",$data,"",5,"/get_event_by_id");
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

        if(isset($data['ctgId']) && $data['ctgId']!=0)
        {
            $arr['ctgId'] = $data['ctgId'];
        }
        
        if(isset($data['smid']))
        {
           $arr['smid'] = $data['smid']; 
        }
        if(isset($data['status']))
        {
            $arr['status'] = $data['status'];
        }

        if(isset($data['timestamp']))
        {
            $arr['lastUpdate'] = array('$gt' => new MongoDate($data['timestamp'])); 
        }
        
        if(isset($data['nor']))
        {
            if(isset($data['index']))
            {
                $res = select_sort_limit_mongo('event',$arr,array(),array('lastUpdate'=>-1),$data['index'],$data['nor']);
            }
            else
            {
                $res = select_sort_limitonly_mongo('event',$arr,array(),array('lastUpdate'=>-1),$data['nor']);
            }
        }
        else
        {
    
            $res = select_sort_mongo('event',$arr,array(),array('lastUpdate'=>-1));
            
        }
        $res = add_id($res,"id");
    
        if(isset($data['amid']) && isset($data['asmid']))
        {
            foreach ($res as $key => $val) {
                $association_data = get_association_data("25",$data['amid'],$data['asmid'],$val['id']);
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

function delete_event($data)
{
	logger("25",$data,"",5,"/delete_event");
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        $id = explode("|",$data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition=array('_id'=>array('$in'=> $id));
        
        $ids = implode(",",$id);
       
        //$q = mysql_query("delete from item_table where item_id in('$ids')");
        
        $res = delete_mongo('event',$condition);
        $res = add_id($res,"id");


        if($res['1']==sizeof($id))
        {
            return array("success"=>"true","data"=>$data,"error_code"=>"25003");
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"25004");
        }
    }
    else
    {
        return $check;
    }
}


function manage_event_category($data)
{
    logger("25",$data,"",5,"/manage_event_category");
    $check = check_key_available($data,array('id','name'));
    if($check['success'] == 'true')
    {
        switch($data['id'])
        {
            case "0":
                $manage = add_event_category($data);
            break;
            
            default:
                $manage = update_event_category($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }    
}

function add_event_category($data)
{    
    logger("25",$data,"",5,"/add_event_category");
    $data['status'] = "0";
    $data['lastUpdate'] = new MongoDate();
    $data['createdOn'] = new MongoDate();
    unset($data['id']);
    $res = insert_mongo('eventCategory',$data);
    if($res['n']==1)
    {
        return array("success"=>"false","data"=>$data,"error_code"=>"25001");
    }
    else
    {
        $ins_id = db_id($data);
        //prepare_send_notification("25","1","0",$ins_id,'24');
        //on_item_post(array("customerId"=>'43',"mid"=>'25',"smid"=>'1',"userId"=>$data['userId'],"itemId"=>$ins_id,"table"=>'blog'));
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"25006");
    }
}

function update_event_category($data)
{
    logger("25",$data,"",5,"/update_event_category");
    $cond=array(
        '_id'=>new MongoId($data['id'])
    );
    $data['lastUpdate'] = new MongoDate();
    $id = $data['id'];
    unset($data['id']);
    $res = update_mongo('eventCategory',$data,$cond);
    if($res['n']==0)
    {
        return array("success"=>"false","data"=>$data,"error_code"=>"25002");
    }
    else
    {
        // prepare_send_notification("25","1","0",$id,'225');
        return array("success"=>"true","data"=>$data,"error_code"=>"25005");
    } 
}

function get_event_category_by_id($data)
{
    logger("25",$data,"",5,"/get_event_category_by_id");
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

        if(isset($data['smid']))
        {
           $arr['smid'] = $data['smid']; 
        }

        $res = select_sort_mongo('eventCategory',$arr,array(),array('lastUpdate'=>-1));
        $res = add_id($res,"id");
       
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}
?>