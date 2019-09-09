<?php
function manage_setting($data)
{
    logger("18",$data,"",5,"/manage_setting");
    $check = check_key_available($data,array('id','mid','smid','json'));
    if($check['success'] == 'true')
    {
        switch($data['id'])
        {
            case "0":
                $manage = add_setting($data);
            break;
            
            default:
                $manage = update_setting($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }    
}

function add_setting($data)
{
    $arr = array();
    logger("18",$data,"",5,"/add_setting");
    $arr['mid'] = $data['mid'];
    $arr['smid'] = $data['smid'];
    $arr['created_on']=new MongoDate();
    $arr['json']=$data['json'];
    $arr['_id']=new MongoId();
   
    $res = insert_mongo('setting',$arr);;
    if($res['n']==1)
    {
        return array("success"=>"true","data"=>$arr,"error_code"=>"18001");
    }
    else
    {
        $ins_id=db_id($arr);
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"18002");
    }
}

function update_setting($data)
{
    $arr = array();
    logger("18",$data,"",5,"/update_setting");
    $arr['mid'] = $mid;
    $arr['smid'] = $smid;
    $arr['created_on']=new MongoDate();
    $arr['json']=$json;

    $cond=array(
        '_id'=>new MongoId($id)
    );
    
    $res = update_mongo('setting',$arr,$cond);
    if($res['n']==0)
    {
        return array("success"=>"true","data"=>$arr,"error_code"=>"18003");
    }
    else
    {
        
        return array("success"=>"true","data"=>$arr,"error_code"=>"18004");
    } 
}

function get_setting_by_mid($data)
{
    logger("18",$data,"",5,"/get_setting_by_mid");
    $check = check_key_available($data,array('mid','smid'));
    if($check['success'] == 'true')
    { 
        if(isset($data['mid']) && $data['mid']!='' && $data['mid']!="null"){
        $mid=$data['mid'];
        $smid=$data['smid'];
        if($mid!='' && $smid!=0)
        {
            $fields = array("mid"=>$mid,"smid"=>$smid);
            $arr = select_mongo('setting',$fields); 
        }
        else if($mid!='' && $smid==0)
        {
            $fields = array("mid"=>$mid);
            $arr = select_mongo('setting',$fields);
        }
        else
        {
            $arr = select_mongo('setting'); 
        }
         
        $res = add_id($arr,"id");
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
        }
        else
        {
          return array("success"=>"true","data"=>"","error_code"=>"100");
         
         }
    }
    else
    {
        return $check;
    }
}

function delete_setting($id)
{
    logger("18",$data,"",5,"/delete_setting");
	$check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        $id = explode("|",$data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition=array('_id'=>array('$in'=> $id));
        
        $res = delete_mongo('setting',$condition);
        $res = add_id($res,"id");
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

function manage_module_setting($data)
{
    logger("18",$data,"",5,"/manage_module_setting");
    $check = check_key_available($data,array('id','mid','name'));
    if($check['success'] == 'true')
    {
        switch($data['id'])
        {
            case "0":
                $manage = add_module_setting($data);
            break;
            
            default:
                $manage = update_module_setting($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }    
}

function add_module_setting($data)
{   logger("18",$data,"",5,"/add_module_setting");
    $data['created_on']=new MongoDate();
    $data['_id']=new MongoId();
    unset($data['id']);
    $res = insert_mongo('moduelSetting',$data);
    if($res['n']==1)
    {
        return array("success"=>"true","data"=>$arr,"error_code"=>"18001");
    }
    else
    {
        $ins_id=db_id($data);
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"18002");
    }
}

function update_module_setting($data)
{   logger("18",$data,"",5,"/update_module_setting");
    $cond=array(
        '_id'=>new MongoId($data['id'])
    );
    unset($data['id']);
    $res = update_mongo('moduelSetting',$data,$cond);
    if($res['n']==0)
    {
        return array("success"=>"true","data"=>$arr,"error_code"=>"18003");
    }
    else
    {
        
        return array("success"=>"true","data"=>$arr,"error_code"=>"18004");
    } 
}

function manage_submodule_setting($data)
{
    logger("18",$data,"",5,"/manage_submodule_setting");
    $check = check_key_available($data,array('id','mid','smid','permission','uiSetting'));
    if($check['success'] == 'true')
    {
        switch($data['id'])
        {
            case "0":
                $manage = add_submodule_setting($data);
            break;
            
            default:
                $manage = update_submodule_setting($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }    
}

function add_submodule_setting($data)
{
    $arr = array();
    logger("18",$data,"",5,"/add_submodule_setting");
    $arr['mid'] = $data['mid'];
    $arr['smid'] = $data['smid'];
    $arr['created_on']=new MongoDate();
    $arr['psermission']=$data['permission'];
    $arr['uiSetting']=$data['uiSetting'];
    $arr['_id']=new MongoId();
   
    $res = insert_mongo('subModuleSetting',$arr);
    if($res['n']==1)
    {
        return array("success"=>"true","data"=>$arr,"error_code"=>"18001");
    }
    else
    {
        $ins_id=db_id($arr);
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"18002");
    }
}

function update_submodule_setting($data)
{
    $arr = array();
    logger("18",$data,"",5,"/update_submodule_setting");
    $arr['mid'] = $data['mid'];
    $arr['smid'] = $data['smid'];
    $arr['created_on']=new MongoDate();
    $arr['msid']=$data['msid'];
    $arr['_id']=new MongoId();

    $cond=array(
        '_id'=>new MongoId($id)
    );
    
    $res = update_mongo('setting',$arr,$cond);
    if($res['n']==0)
    {
        return array("success"=>"true","data"=>$arr,"error_code"=>"18003");
    }
    else
    {
        
        return array("success"=>"true","data"=>$arr,"error_code"=>"18004");
    } 
}

function get_module_permission($data)
{
    logger("18",$data,"",5,"/get_module_permission");
    $check = check_key_available($data,array('mid'));
    if($check['success'] == 'true')
    {
        $mlist = select_mongo("moduleSetting",array("mid"=>$data['mid']));
        $mlist = add_id($mlist,"id");
        return array("success"=>"true","data"=>$mlist,"error_code"=>"18014");
    }
    else
    {
        return $check;
    }  
}


function get_module_json($data)
{   logger("18",$data,"",5,"/get_module_json");
    $mlist = select_mongo("module",array("status"=>"1"));
    $mlist = add_id($mlist);
    $final_array =  array();
    $visibility="";
    foreach ($mlist as $value) 
    {
        $smarr = array();
        $smlist = select_mongo("subModuleSetting",array("mid" => $value['mid']));
        $smlist = add_id($smlist,"id");
        foreach($smlist as $val)
        {
            array_push($smarr,$val);
        }
        $visibility="";
        if(isset($value['visibility'])){
         $visibility=$value['visibility'];
        }
        
        array_push($final_array,array("id"=>$value['mid'],"moduleName"=>$value['title'],"moduleVal"=>$value['mval'],"status"=>$value['status'],"visibility"=>$visibility,"submodule"=>$smarr));
    }


    return array("success"=>"true","data"=>$final_array,"error_code"=>"18014");
}


function manage_user_setting($data)
{
    logger("18",$data,"",5,"/manage_user_setting");
    $check = check_key_available($data,array('id','type','userId'));
    if($check['success'] == 'true')
    {
        switch($data['id'])
        {
            case "0":
                $manage = add_user_setting($data);
            break;
            
            default:
                $manage = update_user_setting($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }    
}

function add_user_setting($data)
{
    $arr = array();
    logger("18",$data,"",5,"/add_user_setting");
    $data['updatedOn']=new MongoDate();
    unset($data['id']);
    $res = insert_mongo('userSetting',$data);
    if($res['n']==1)
    {
        return array("success"=>"true","data"=>$arr,"error_code"=>"18001");
    }
    else
    {
        $ins_id=db_id($arr);
        return array("success"=>"true","data"=>$ins_id,"error_code"=>"18002");
    }
}

function update_user_setting($data)
{
   logger("18",$data,"",5,"/update_user_setting");
    $cond=array(
        '_id'=>new MongoId($data['userId'])
    );
    $data['updatedOn']=new MongoDate();
    $res = update_mongo('userSetting',$data,$cond);
    if($res['n']==0)
    {
        return array("success"=>"true","data"=>$arr,"error_code"=>"18003");
    }
    else
    {
        
        return array("success"=>"true","data"=>$arr,"error_code"=>"18004");
    } 
}

function get_user_setting($data)
{
    logger("18",$data,"",5,"/get_user_setting");
    $check = check_key_available($data,array('userId'));
    if($check['success'] == 'true')
    {
        $arr = select_mongo('userSetting',array("userId"=>$data['userId'])); 
        $res = add_id($arr,"id");
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function get_module_setting_by_mid($data) {
    logger("18",$data,"",5,"/get_module_setting_by_mid");
    $check = check_key_available($data, array('mid', 'smid'));
    if ($check['success'] == 'true') {
        $params = array();
        if (isset($data['deviceType']) && ($data['deviceType'] == 'android' || $data['deviceType'] == 'ios')) {

            $params = array("mid", "smid", "name", "uiSetting");

            $marr = explode("|", $data['mid']);

            $i = 0;
            $res = array();


            foreach ($marr as $key1 => $value1) {

                $final_array = array("id" => $value1);
                $submoduleArr = array();
                $smarr = explode("|", $data['smid']);
                $smarr1 = explode(";", $smarr[$i]);

                $fields = array("mid" => $value1, "smid" => array('$in' => $smarr1));

                $arr = select_mongo('subModuleSetting', $fields, $params);
                $arr = add_id($arr, "id");
                foreach ($arr as $key => $value) {
                    unset($value['uiSetting']['notification']);
                    unset($value['mid']);
                    unset($value['id']);
                    $smid = $value['smid'];
                    unset($value['smid']);
                    $arr[$key] = $value;
                    $arr[$key]['id'] = $smid;
                    array_push($submoduleArr, $arr[$key]);
                }

                $final_array['submodule'] = $submoduleArr;

                array_push($res, $final_array);
                $i++;
            }
        } else {
            $mid = $data['mid'];
            $smid = $data['smid'];
            $smid1 = explode("|", $data['smid']);
            
            $cond['smid'] = array('$in' => $smid1);
            $cond['mid'] = $mid;
            if ($mid != '' && $smid != 0) {
                $arr = select_mongo('subModuleSetting', $cond, $params);
            } else if ($mid != '' && $smid == 0) {
                $fields = array("mid" => $mid);
                $arr = select_mongo('subModuleSetting', $fields, $params);
            } else {
                $arr = select_mongo('subModuleSetting', array(), $params);
            }
            $res = add_id($arr, "id");
        }




        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_module_roles($data) {
    logger("18",$data,"",5,"/get_module_roles");
    $check = check_key_available($data, array('specific_id'));
    if ($check['success'] == 'true') {
        $cond['specific_to'] = $data['specific_id'];
        $arr = select_mongo('role', $cond);
        $res = add_id($arr, "id");
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_submodule_name($data)
{
    logger("18",$data,"",5,"/get_submodule_name");
    $check = check_key_available($data,array('mid','smid'));
    if($check['success'] == 'true')
    {
        $mid = $data['mid'];
        $smid = $data['smid'];
        if($mid!='' && $smid!=0)
        {
            $fields = array("mid"=>$mid,"smid"=>$smid);
        }
        
        $arr = select_mongo('subModuleSetting',$fields,array('smval','name'));
        $res = add_id($arr,"id");
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function get_submodules_by_mid($data)
{   logger("18",$data,"",5,"/get_submodules_by_mid");
    $check = check_key_available($data,array('mid'));
    if($check['success'] == 'true')
    {
        $fields = array("mid"=>$data['mid']);
        
        $arr = select_mongo('subModuleSetting',$fields,array("smid"));
        $res = add_id($arr,"id");
        return $res;
    }
    else
    {
        return $check;
    }
}


function get_submodule_id($data)
{
    logger("18",$data,"",5,"/get_submodule_id");
    $check = check_key_available($data,array('mid','sname'));
    if($check['success'] == 'true')
    {
        
        $fields = array("mid"=>$data['mid'],"smval"=>$data['sname']);
        $countTotal = count_mongo('subModuleSetting',$fields);
        if($countTotal>0){
        $arr = select_mongo('subModuleSetting',$fields,array("smid"));
        $res = add_id($arr,"id");
        return $res[0]['smid'];
		}else{
			return array('success'=>'false','data'=>'','error_code'=>'101');
		}
    }
    else
    {
        return $check;
    }
} 

function get_module_name($data)
{
    logger("18",$data,"",5,"/get_module_name");
    $check = check_key_available($data,array('name'));
    if($check['success'] == 'true')
    {
        $fields = array("mval"=>$data['name']);
        $arr = select_mongo('module',$fields,array());
        $res = add_id($arr,"id");
        return $res[0]['mid'];
    }
    else
    {
        return $check;
    }
} 

function get_module_status($data)
{
    logger("18",$data,"",5,"/get_module_status");
    $check = check_key_available($data,array('id','name'));
    if($check['success'] == 'true')
    {
        if($data['id']!=0)
        {
            $fields = array("mid"=>$data['id']);
        }
        if($data['name']!='')
        {
            $fields['mval'] = $data['name'];
        }
        
        $arr = select_mongo('module',$fields,array());
        $res = add_id($arr,"id");
        return $res[0]['status'];
    }
    else
    {
        return $check;
    }
} 


function manage_module_page_setting($data)
{
    logger("18",$data,"",5,"/manage_module_page_setting");
    $check = check_key_available($data,array('userId'));
    if($check['success'] == 'true')
    {
        $condition = array("userId"=>$data['userId']);
        $count = count_mongo('pageSetting',$condition);
        if($count > 0)
        {
            $res = update_mongo('pageSetting',$data,$condition);
            if($res['n']==0)
            {
                return array("success"=>"true","data"=>$res,"error_code"=>"18003");
            }
            else
            {
                
                return array("success"=>"true","data"=>$res,"error_code"=>"18004");
            }
        }
        else
        {
            $res = insert_mongo('pageSetting',$data);
            if($res['n']==1)
            {
                return array("success"=>"true","data"=>$res,"error_code"=>"18001");
            }
            else
            {
                $ins_id=db_id($res);
                return array("success"=>"true","data"=>$ins_id,"error_code"=>"18002");
            }
        }
    }
    else
    {
        return $check;
    }    
}


function get_module_page_setting($data)
{
    logger("18",$data,"",5,"/get_module_page_setting");
    $check = check_key_available($data,array('userId'));
    if($check['success'] == 'true')
    {
        $count = count_mongo('pageSetting',$data);
        if($count > 0)
        {
            $res = select_mongo('pageSetting',$data);
            $res =  add_id($res,'id');
            return array("success"=>"true","data"=>$res,"error_code"=>"18003");
        }
        else
        {
            return array("success"=>"false","data"=>array(),"error_code"=>"18004");
        }
    }
    else
    {
        return $check;
    }
}

function get_report_setting($data)
{
    logger("18",$data,"",5,"/get_report_setting");
    $check = check_key_available($data,array('mid','smid'));
    if($check['success'] == 'true')
    {
        $count = count_mongo('reportSetting',$data);
        if($count > 0)
        {
            $res = select_mongo('reportSetting',$data);
            $res =  add_id($res,'id');
            return array("success"=>"true","data"=>$res,"error_code"=>"18003");
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"18004");
        }
    }
    else
    {
        return $check;
    }
}


function change_module_status($data)
{   
    logger("18",$data,"",5,"/change_module_status");
    $check = check_key_available($data,array('mid','status'));
    $status = array("status"=>$data['status']);
    if($check['success'] == 'true')
    {
            $marr = explode("|",$data['mid']);
                
            foreach ($marr as $value1) 
            {   

                $con=array('mid'=>$value1);
                $res = update_mongo('module',$status,$con);
            } 
            if($res['n']==0)
            {
                return array("success"=>"true","data"=>$res,"error_code"=>"18003");
            }
            else
            {
                
                return array("success"=>"true","data"=>$res,"error_code"=>"18004");
            }
          
    }
    else
    {
        return $check;
    }
}

function get_submodule_title_by_id($data)
{
    logger("18",$data,"",5,"/get_submodule_title_by_id");
    $check = check_key_available($data,array('mid','sname'));
    if($check['success'] == 'true')
    {
        
        $fields = array("mid"=>$data['mid'],"smval"=>$data['sname']);
        
        
        $arr = select_mongo('subModuleSetting',$fields,array("name"));
        $res = add_id($arr,"id");
        return $res[0]['name'];
    }
    else
    {
        return $check;
    }
} 
function manage_email($data)
{
    logger("18",$data,"",5,"/manage_email");
    $check = check_key_available($data,array('email'));
    if($check['success'] == 'true')
    {
        
        $manage = add_email($data);
        return $manage;
    }
    else
    {
        return $check;
    }    
}

function add_email($data)
{
    logger("18",$data,"",5,"/add_email");
    $r = count_mongo('emails',array("email"=>$data['email']));
    if($r==0)
    {
        $data['createDate'] = new MongoDate();
        $data['status'] = "1";
        
        $res = insert_mongo('emails',$data);
        if($res['n']==1)
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"18002");
        }
        else
        {
            $ins_id=db_id($data);
            return array("success"=>"true","data"=>$ins_id,"error_code"=>"18008");
        }
    }
    else 
    {
        update_email(array("email"=>$data['email'],"status"=>"1"));
        return array("success"=>"true","data"=>$data,"error_code"=>"18008");
    }
}

function update_email($data)
{
   
    logger("18",$data,"",5,"/update_email");
    $id = $data['id'];
    unset($data['id']); 
    if($data['status']=="1")
    {
    $data['status'] = "0";
    }
    else
    {
     $data['status'] = "1";   
    }
    $res = update_mongo('emails',$data,array('_id'=>new MongoId($id)));
    if($res['n']==0)
    {
        return array("success"=>"false","data"=>$data,"error_code"=>"18003");
    }
    else
    {       
        return array("success"=>"true","data"=>$data,"error_code"=>"18009");
    }
}

function get_email_by_id($data)
{
    logger("18",$data,"",5,"/get_email_by_id");
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
        
        $res = select_mongo('emails',$arr,array());
        $res = add_id($res,"id");
        //print_r($res);
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}
function delete_emails($data)
{
    logger("18",$data,"",5,"/delete_emails");
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        $id = explode("|",$data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition=array('_id'=>array('$in'=> $id));
        
        $res = delete_mongo('emails',$condition);
        $res = add_id($res,"id");
        if($res['1']==sizeof($id))
        {
            return array("success"=>"true","data"=>$data,"error_code"=>"18003");
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"18004");
        }
    }
    else
    {
        return $check;
    }
}

function getModuleName($mid)
{    logger("18",$mid,"",5,"/getModuleName");
    $moduleRes = select_mongo('module',array('mid'=>$mid));
    $res = add_id($moduleRes);
    $mval =  $res[0]['mval'];
    return $mval; 
}
?>
