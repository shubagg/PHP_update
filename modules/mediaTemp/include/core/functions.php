<?php
function manage_media_temp($data)
{ 
   logger(5,'',$data,5);
   if(isset($data['keyjson']))
    {
        $tmp = json_decode($data['keyjson']);
        foreach ($tmp as $key => $val) {
           $data[$key]=$val;
        }
        unset($data['keyjson']);
    }
   
    $check = check_key_available($data,array('id','smid','amid','asmid','aiid','mediaName','mediaType','multimedia'));
    if($check['success'] == 'true')
    {
  
        switch($data['id'])
        {
            case "0":
                $manage = upload_media_temp($data);
            break;
            
            default:
                $manage = update_media($data);
            break;
        }
        return $manage;
    }
    else
    {
        return $check;
    }    
}

function upload_media_temp($data)
{
    
           
    global $site_url;
    global $media_url;
    
    $medianame = explode(".",$_FILES[$data['mediaName']]['name']);
    $medianame = "media_".time()."_".rand().".".end($medianame);
    

    $media_url1 = $siteurl = '';
     
    Switch($data['mediaType'])
    {
        case "image":
                $media_url1 = $media_url."images/";     
                $siteurl = $site_url."uploads/media/images/";
        break;
        
        case "video":
                $media_url1 = $media_url."videos/";    
                $siteurl = $site_url."uploads/media/videos/";
        break;
        
        case "audio":
                $media_url1 = $media_url."audios/";  
                $siteurl = $site_url."uploads/media/audios/";
        break;

        default:
                $media_url1 = $media_url."others/";
                $siteurl = $site_url."uploads/media/others/";
        break;
    }
    
    if(isset($data['base64enc']) && $data['base64enc']=="1")
    {
    
        if(isset($data[$data['mediaName']])){
            if(isset($data['extension']))
            {
                $medianame.=$data['extension'];
                //echo $data['mediaName'];
                if(!file_put_contents($media_url1.$medianame,base64_decode($data[$data['mediaName']])))
                    return array("success"=>"false","data"=>array(),"error_code"=>"10009");
            }
            else
            {
                $findext =  explode(",",$data[$data['mediaName']]);
                if(sizeof($findext)==2)
                {
                    $findext1 = explode("/".$findext[0]);
                    $findext2 = explode(";",$findext1[1]);
                    $medianame.=$findext2[0];
                    if(!file_put_contents($media_url1.$medianame,base64_decode(end($findext))))
                        return array("success"=>"false","data"=>array(),"error_code"=>"10009");
                }
                else
                {
                    return array("success"=>"false","data"=>array("error"=>"extension not found"),"error_code"=>"10011");
                }
            }
        }
        else{
            return array("success"=>"false","data"=>array(),"error_code"=>"10010");
            }
            
            unset($data[$data['mediaName']]);
            unset($data['base64enc']);
    }
    else if($data['mediaType'] == "html")
    {
        $medianame = $data['mediaName'];
    }
    else
    { 
    
        if(isset($data['multimedia']) && $data['multimedia'] == 0)
        {
       
            if(isset($data['indexVal']))
            {
                $indexVal = $data['indexVal'];
                $medianame = explode(".",$_FILES[$data['mediaName']]['name'][$indexVal]);
                $medianame = "media_".time()."_".$indexVal.".".end($medianame);
                if(copy($_FILES[$data['mediaName']]['tmp_name'][$indexVal],$media_url1.$medianame))
                {

                }
                else
                {
                    return array("success"=>"false","data"=>$medianame,"error_code"=>"10010");
                }
            }
            else if(isset($data['copyImage']))
            {
                if(copy($_FILES[$data['mediaName']]['tmp_name'],$media_url1.$medianame))
                {
                    logger("10","10002",$data,5);
                }
                else
                {
                    return array("success"=>"false","data"=>$_FILES[$data['mediaName']]['name'],"error_code"=>"10001");
                }
            }
            else if(move_uploaded_file($_FILES[$data['mediaName']]['tmp_name'],$media_url1.$medianame))
            {
                logger("10","10002",$data,5);
            }
            else
            {
                return array("success"=>"false","data"=>$_FILES[$data['mediaName']]['name'],"error_code"=>"10001");
            }
        }
        else
        {
           
            $len = count($_FILES[$data['mediaName']]['name']);

            $mediaIds = array();
            unset($data['id']);

            for($i=0;$i<$len;$i++) 
            {
                if($_FILES[$data['mediaName']]['name'][$i]==""){ continue; }
                $medianame = explode(".",$_FILES[$data['mediaName']]['name'][$i]);

                $mediaOrgName = $_FILES[$data['mediaName']]['name'][$i];

                $medianame = "media_".time()."_".$i.".".end($medianame);
              
                
                if(move_uploaded_file($_FILES[$data['mediaName']]['tmp_name'][$i],$media_url1.$medianame))
                {
                    $data1 = $data;
                    $data1['mediaName'] = $medianame;
                    $data1['mediaOrgName'] = $mediaOrgName;

                    $data1['uploadedOn'] = new MongoDate();
                    $data1['lastUpdate'] = new MongoDate();
                    $data1['_id']=new MongoId();
                    $res = insert_mongo('mediatemp',$data1);
                    $media_id = db_id($data1);
                    resize_mediaData($data,$medianame,$media_url1,$media_id);
                    array_push($mediaIds, $media_id);
                    update_media_counter($data1,$media_id);
                    /*checking count */
                     /*if(function_exists('associate_module'))
                     {
                        associate_module("10",$media_id,$data['amid'],$data['asmid'],$data['aiid'],array(),'add');
                    }*/
 
                    /* checking count */
                }
                else
                {
                    return array("success"=>"false","data"=>$data,"error_code"=>"10001");
                }
            }
            
            return array("success"=>"true","data"=>$mediaIds,"error_code"=>"10008");
        }
    }
    
    if(isset($data['multimedia']) && $data['multimedia'] == 0)
    {
        $mediaOrgName = $_FILES[$data['mediaName']]['name'];
        $data['mediaOrgName'] = $mediaOrgName;
        $data['mediaName'] = $medianame;
        $data['uploadedOn'] = new MongoDate();
        $data['lastUpdate'] = new MongoDate();
        unset($data['id']);
        $data['_id']=new MongoId();

        $res = insert_mongo('mediatemp',$data);

        $media_id = db_id($data);
    
        update_media_counter($data,$media_id);
    
        /*if(function_exists('associate_module'))
        {
            associate_module("10",$media_id,$data['amid'],$data['asmid'],$data['aiid'],array(),'add');
        }*/
        resize_mediaData($data,$medianame,$media_url1,$media_id);
    
    if($data['amid']=='5')
        {
        $userToSend="";
            $itemId = $data['aiid']."|".$media_id;
    
            $jobs = get_job_by_id(array("id"=>$data['aiid'],"smid"=>$data['asmid'],"allStatus"=>"true"));
        
            $jobs = $jobs['data'][0];

            if(sizeof($jobs['status']) > 0)
            {
        if($jobs['status']!=0)
        {
                $sendTo = array();
                foreach ($jobs['status'] as $key => $value) {
                    array_push($sendTo,$value['userid']);
                }
                $userToSend = implode("|",$sendTo);
                }
            }
        if($userToSend!='')
        {
            insert_notification(array('customerId'=>"43",'mid'=>"5",'smid'=>$data['asmid'],'userId'=>$userToSend,'itemId'=>$itemId,'eid'=>"38","extra"=>json_encode($data)));
        }
        }
    
        if(isset($data['duration']) && $data['duration']==1)
        {
        
            $duration = get_media_duration(array("type"=>"audio","mediaName"=>$medianame));
            $newarr = array("id"=>$media_id,"duration"=>$duration['data']);
            return array("success"=>"true","data"=>$newarr,"error_code"=>"10008");
        }
        
        if(isset($data['deviceType']))
        {
            $newarr = array("id"=>$media_id,"url"=>$siteurl."".$medianame);
            return array("success"=>"true","data"=>$newarr,"error_code"=>"10008");
        }

        return array("success"=>"true","data"=>"$media_id","error_code"=>"10008");
    }
}
function movetempmedia($data)
{
    $id=$data['id'];
    unset($data['id']);
    $data['uploadedOn'] = new MongoDate();
    $data['lastUpdate'] = new MongoDate();
    $data['_id']=new MongoId();
    $res = insert_mongo('media',$data);
    $media_id = db_id($data);
    if(function_exists('associate_module'))
    {
        associate_module("10",$media_id,$data['amid'],$data['asmid'],$data['aiid'],array(),'add');        
   
        $dataId=new MongoId($id);
        $condition=array('_id'=>array('$in'=> array($dataId)));
        $res = delete_mongo('mediatemp',$condition);
        
    }
}
function gettempmedia($data)
{
        if($data['id']!=0)
        {
            $id = explode("|",$data['id']);
            foreach ($id as $key => $val) {
                $id[$key] = new MongoId($val);
            }
            $arr=array('_id'=>array('$in'=> $id));
        }
        $res = select_mongo('mediatemp',$arr,array());
        $res = add_id($res,"id");
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
}
?>
