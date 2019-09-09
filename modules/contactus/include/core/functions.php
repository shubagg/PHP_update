<?php
/*
function add_contactus($name,$email,$query,$phone,$callback)
{
    global $db,$webservice_url;
    $arr = array(
        'name'=>$name,
        'email'=>$email,
        'query'=>$query,
        'phone'=>$phone,
        'callback'=>$callback,
        'creation_date'=>mongo_time(),
        '_id'=> new Mongoid()   
        );
    $db->contactus->insert($arr);
    return db_id($arr);

    $arr=array(array(
    "customer_id" => 43,
    "moduleid" => "3",
    "eventid" => "3",
    "uid1" =>get_admin_id(),
    "uid2" => $contact_id,
    "uid3" => '',
    "uid4" => '',
    "uid5"=>array(),
    "url1"=>'',
    "url2"=>'',
    "stringid"=>'',
    "mstringid"=>'',
    "reqtype"=>'inline',
    "requrl"=>'',
    "used
    _for"=>'',
    "dev1"=>''
    ));
    //echo json_encode($arr);
    $data = curl_post("$webservice_url/add_notification",array("jsondata"=>json_encode($arr)));
    
}*/

function add_contactus($data)
{    
    logger("25",$data,"",5,"/add_contactus");
    $check=check_key_available($data,array('name','email','mobile','message'));
    if($check['success']=='true')
    {
        $data['status'] = "0";
        //$data['lastUpdate'] = new MongoDate();
        $data['createdOn'] = new MongoDate();
        //unset($data['id']);
        $res = insert_mongo('contactus',$data);
        if($res['n']==1)
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"25001");
        }
        else
        {
            $ins_id = db_id($data);
            //prepare_send_notification("7","1","0",$ins_id,'24');
            return array("success"=>"true","data"=>$ins_id,"error_code"=>"25006");
        }
    }
    else
    {
        return $check;
    }
}

function get_contactus_by_id($data)
{
     logger("25",$data,"",5,"/get_contactus_by_id");
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
        
        if(isset($data['nor']))
        {
            if(isset($data['index']))
            {
                $res = select_sort_limit_mongo('contactus',$arr,array(),array('lastUpdate'=>-1),$data['index'],$data['nor']);
            }
            else
            {
                $res = select_sort_limitonly_mongo('contactus',$arr,array(),array('lastUpdate'=>-1),$data['nor']);
            }
        }
        else
        {
            //$arr['mid'] = "22";
            
            $res = select_sort_mongo('contactus',$arr,array(),array('lastUpdate'=>-1));
            
        }
        $res = add_id($res,"id");
       
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}
function delete_contactus($data)
{
    logger("25",$data,"",5,"/delete_contactus");
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        $id = explode("|",$data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition=array('_id'=>array('$in'=> $id));
        
        $res = delete_mongo('contactus',$condition);
        //$res = add_id($res,"id");


        if($res['n']=='1')
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

/*
function get_contactus($id="")
{
    global $db;
    if($id=="")
    {
        $arr = $db->contactus->find()->sort(array("creation_date"=>-1));
    }
    else
    {
        $id = new Mongoid($id);
        $arr = $db->contactus->find(array('_id'=>$id));
    }
    return add_id($arr,"id");
}

function delete_contactus($id)
{
    global $db;
    
    $db->contactus->remove(array('_id'=>new MongoId($id)));
    return "1";
}*/
?>