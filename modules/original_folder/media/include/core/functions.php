<?php
function manage_multi_media($data) {
    global $media_url;
    if (!isset($data['cid'])) {
        $companyId = get_company_data();
        $data['cid'] = $companyId['cid'];
        $data['scid'] = $companyId['scid'];
    }

    Switch ($data['mediaType']) {
        case "image":
            $media_url1 = $media_url . "images/";
            break;

        case "video":
            $media_url1 = $media_url . "videos/";
            break;

        case "audio":
            $media_url1 = $media_url . "audios/";
            break;

        default:
            $media_url1 = $media_url . "others/";
            break;
    }
    $len = count($_FILES[$data['mediaName']]['name']);
    $mediaIds = array();
    unset($data['id']);
    for ($i = 0; $i < $len; $i++) {
        if ($_FILES[$data['mediaName']]['name'][$i] == "") {
            continue;
        }

        $medianame = explode(".", $_FILES[$data['mediaName']]['name'][$i]);
        $mextension = end($medianame);
        $marray = explode('.', $_FILES[$data['mediaName']]['name'][$i]);
        if (isset($data['deviceType']) && $data['deviceType'] == 'web') {
            $extensionType = end($medianame);
        }
        // $medianame = "media_".time()."_".$i.".".end($medianame);
        $ext = end(explode("/", $_FILES[$data['mediaName']]['type'][$i]));
        //$medianame = "media_".time()."_".rand()."_".$ext;
        $medianame = "media_" . time() . "_" . rand() . "_" . $i;
        if(!empty($data['useExtension'])) {
            $media_name = $media_url1 . $medianame . '.' . $mextension;
        } else {
            if(!empty($data['deviceType']) && in_array($data['deviceType'], array('ios', 'android'))) {
                $media_name = $media_url1 . $medianame;
            } else {
                if(in_array($mextension, array('jpg', 'jpeg', 'gif', 'png', 'mpeg', 'mp4', 'mp3'))) {
                    $media_name = $media_url1 . $medianame;
                } else {
                    $media_name = $media_url1 . $medianame . '.' . $mextension;
                }
            }
        }
        $uploadFile = rename($_FILES[$data['mediaName']]['tmp_name'][$i], $media_name);
        if ($uploadFile) {
            $data1 = $data;
            if (isset($data['deviceType']) && $data['deviceType'] == 'web') {
                $data1['type'] = $extensionType;
            }
            $data1['mediaName'] = $medianame;
            $data1['mediaOrgName'] = $marray[0];
            $data1['uploadedOn'] = new MongoDate();
            $data1['lastUpdate'] = new MongoDate();
            $data1['lastUpdate'] = new MongoDate();
            $data1['extension']=$mextension;
            $data1['mediaOrgName']=$marray[0];
            $res = insert_mongo('media', $data1);
            $media_id = db_id($data1);
            resize_mediaData($data, $medianame, $media_url1, $media_id);
            array_push($mediaIds, $media_id);
            update_media_counter($data1, $media_id);
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "10001");
        }
    }
}

function manage_media($data) {
    logger(5, '', $data, 5);

    if (isset($data['keyjson'])) {
        $tmp = json_decode($data['keyjson']);
        foreach ($tmp as $key => $val) {
            $data[$key] = $val;
        }
        unset($data['keyjson']);
    }

    $check = check_key_available($data, array('id', 'smid', 'amid', 'asmid', 'aiid', 'mediaName', 'mediaType'));
    if ($check['success'] == 'true') {
        if (isset($data['delete_previous']) == 'true') {
            delete_previous_media(array('amid' => $data['amid'], "asmid" => $data['asmid'], "aiid" => $data['aiid']));
        }
        switch ($data['id']) {
            case "0":
                $manage = upload_media($data);
                break;

            default:
                $manage = update_media($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function upload_media($data) {
    global $media_url;
    $callbackUrl = false;
    if (isset($data['callbackUrl']) == 'true') {
        $callbackUrl = true;
        unset($data['callbackUrl']);
    }
    $medianame = explode(".", $_FILES[$data['mediaName']]['name']);
    $medianame = "media_" . time() . "_" . rand() . "." . end($medianame);
    $medianame = "media_" . time() . "_" . rand();
    $media_url1 = '';
    $marray = explode('.', $_FILES[$data['mediaName']]['name']);
    $mextension = end($marray);
    if(!in_array($mextension, array('jpg', 'jpeg', 'png'))) {
        return array("success" => "false", "data" => "Profile updated sucessfully, Image upload failed only 'jpg', 'jpeg', 'png' files are allowed", "error_code" => "10009");
    }
    if (!isset($data['cid'])) {
        $companyId = get_company_data();
        $data['cid'] = $companyId['cid'];
        $data['scid'] = $companyId['scid'];
    }
    Switch ($data['mediaType']) {
        case "image":
            $media_url1 = $media_url . "images/";
            break;

        case "video":
            $media_url1 = $media_url . "videos/";
            break;

        case "audio":
            $media_url1 = $media_url . "audios/";
            break;

        default:
            $media_url1 = $media_url . "others/";
            break;
    }
    if (!is_dir($media_url1)) {
        return array("success" => "false", "data" => $media_url1 . " Folder does not exist", "error_code" => "10009");
    }
    if (!is_writable($media_url1)) {
        return array("success" => "false", "data" => $media_url1 . " Folder does not have permissions to upload file", "error_code" => "10009");
    }

    if (isset($data['base64enc']) && $data['base64enc'] == "1") {
        if (isset($data[$data['mediaName']])) {
            if (isset($data['extension'])) {
                if (!file_put_contents($media_url1 . $medianame, base64_decode(str_replace(" ", "+", $data[$data['mediaName']])))) {
                    return array("success" => "false", "data" => array(), "error_code" => "10009");
                }
            } else {
                $findext = explode(",", $data[$data['mediaName']]);
                if (sizeof($findext) == 2) {
                    $findext1 = explode("/" . $findext[0]);
                    $findext2 = explode(";", $findext1[1]);
                    $medianame .= $findext2[0];
                    if (!file_put_contents($media_url1 . $medianame, base64_decode(str_replace(" ", "+", end($findext)))))
                        return array("success" => "false", "data" => array(), "error_code" => "10009");
                }
                else {
                    return array("success" => "false", "data" => array(), "error_code" => "10011");
                }
            }
        } else {
            return array("success" => "false", "data" => array(), "error_code" => "10010");
        }

        unset($data[$data['mediaName']]);
        unset($data['base64enc']);
    } else if ($data['mediaType'] == "html") {
        $medianame = $data['mediaName'];
    } else {

        if (isset($data['multimedia']) && $data['multimedia'] == 0) {
            if(!empty($data['useExtension'])) {
                $media_name = $media_url1 . $medianame . '.' . $mextension;
            } else {
                if(!empty($data['deviceType']) && in_array($data['deviceType'], array('ios', 'android'))) {
                    $media_name = $media_url1 . $medianame;
                } else {
                    if(in_array($mextension, array('jpg', 'jpeg', 'gif', 'png', 'mpeg', 'mp4', 'mp3'))) {
                        $media_name = $media_url1 . $medianame;
                    } else {
                        $media_name = $media_url1 . $medianame . '.' . $mextension;
                    }
                }
            }

            if (move_uploaded_file($_FILES[$data['mediaName']]['tmp_name'], $media_name)) {
                logger("10", "10002", $data, 5);
            } else {
                return array("success" => "false", "data" => $data, "error_code" => "10001");
            }
        } else {
            $len = count($_FILES[$data['mediaName']]['name']);
            $mediaIds = array();
            unset($data['id']);
            for ($i = 0; $i < $len; $i++) {
                if ($_FILES[$data['mediaName']]['name'][$i] == "") {
                    continue;
                }

                $medianame = explode(".", $_FILES[$data['mediaName']]['name'][$i]);
                if (isset($data['deviceType']) && $data['deviceType'] == 'web') {
                    $extensionType = end($medianame);
                }
                // $medianame = "media_".time()."_".$i.".".end($medianame);
                $ext = end(explode("/", $_FILES[$data['mediaName']]['type'][$i]));
                //$medianame = "media_".time()."_".rand()."_".$ext;
                $medianame = "media_" . time() . "_" . rand() . "_" . $i;


                if ($data['amid'] == '5' && $data['asmid'] == '1') {///for media push in job module.
                    copy($_FILES[$data['mediaName']]['tmp_name'][$i], $media_url . "tmp/" . $medianame . $ext);
                    $uploadFile = rename($media_url . "tmp/" . $medianame . $ext, $media_url1 . $medianame);
                    //$uploadFile=move_uploaded_file($_FILES[$data['mediaName']]['tmp_name'][$i],$media_url1.$medianame);
                } else {
                    $uploadFile = rename($_FILES[$data['mediaName']]['tmp_name'][$i], $media_url1 . $medianame);
                }

                if ($uploadFile) {
                    $data1 = $data;
                    if (isset($data['deviceType']) && $data['deviceType'] == 'web') {
                        $data1['type'] = $extensionType;
                        $data1['mediaOrgName'] = $_FILES[$data['mediaName']]['name'][$i];
                    }
                    $data1['mediaName'] = $medianame;
                    $data1['uploadedOn'] = new MongoDate();
                    $data1['lastUpdate'] = new MongoDate();
                    $res = insert_mongo('media', $data1);
                    $media_id = db_id($data1);
                    resize_mediaData($data, $medianame, $media_url1, $media_id);
                    array_push($mediaIds, $media_id);
                    update_media_counter($data1, $media_id);
                    if ($data['amid'] == '5') {///for media push in job module.
                        $itemId = $data['aiid'] . "|" . $media_id;
                        $jobs = get_job_by_id(array("id" => $data['aiid'], "smid" => $data['asmid'], "assignedTo" => "true"));
                        $jobs = $jobs['data'][0];
                        $userToSend = $jobs['userid'];
                        insert_notification(array('customerId' => "43", 'mid' => "5", 'smid' => $data['asmid'], 'userId' => $userToSend, 'itemId' => $itemId, 'eid' => "38", "extra" => json_encode($data)));
                    }
                } else {
                    return array("success" => "false", "data" => $data, "error_code" => "10001");
                }
            }
            if ($callbackUrl) {
                $media_url = get_upload_dir_uri() . "media/?smid=" . $data['smid'] . "&amid=" . $data['amid'] . "&asmid=" . $data['asmid'] . "&aiid=" . $data['aiid'];
                return array("success" => "true", "data" => $media_url, "error_code" => "10008");
            } else {
                return array("success" => "true", "data" => $mediaIds, "error_code" => "10008");
            }
        }
    }

    if (isset($data['multimedia']) && $data['multimedia'] == 0) {

        /* $data['type']=$mextension;
          if(isset($data['type']))
          {
          $data['type'] = $data['type'];
          } */
        $data['mediaName'] = $medianame;
        $data['uploadedOn'] = new MongoDate();
        $data['lastUpdate'] = new MongoDate();
        unset($data['id']);
        $data['extension'] = $mextension;
        $data['mediaOrgName'] = $marray[0];
        
        $res = insert_mongo('media', $data);
        $media_id = db_id($data);
        update_media_counter($data, $media_id);
        if (function_exists('associate_module')) {
            associate_module("10",$media_id,$data['amid'],$data['asmid'],$data['aiid'],array(),'add');
        }
        //resize_mediaData($data,$medianame,$media_url1,$media_id);

        if ($data['amid'] == '5') {///for media push in job module.
            $itemId = $data['aiid'] . "|" . $media_id;
            $jobs = get_job_by_id(array("id" => $data['aiid'], "smid" => $data['asmid'], "assignedTo" => "true"));
            $jobs = $jobs['data'][0];
            $userToSend = $jobs['userid'];
            insert_notification(array('customerId' => "43", 'mid' => "5", 'smid' => $data['asmid'], 'userId' => $userToSend, 'itemId' => $itemId, 'eid' => "38", "extra" => json_encode($data)));
        }

        if ($callbackUrl) {
            $media_url = get_upload_dir_uri() . "media/?id=" . $media_id . "&smid=" . $data['smid'] . "&amid=" . $data['amid'] . "&asmid=" . $data['asmid'] . "&aiid=" . $data['aiid'];
            return array("success" => "true", "data" => $media_url, "error_code" => "10008");
        } else {
            return array("success" => "true", "data" => $media_id, "error_code" => "10008");
        }
    }
}

function update_media_counter($data, $mediaId) {
    if ($data['amid'] == '5') {
        // do here whatever you want to do

        $settings = get_module_setting_by_mid(array('mid' => $data['amid'], 'smid' => $data['asmid']));
        
        if ($settings['success'] == 'true') {
            $settingsText = $settings['data'][0]['uiSetting']['mediaType'];
            $settingsId = $settings['data'][0]['uiSetting']['mediaTypeId'];

            $keyId = array_search($data['smid'], $settingsId);

            $keyId = $settingsText[$keyId];
            $jobData = array('iid' => $data['aiid'], 'key' => $keyId, 'value' => '1', 'counter' => 'true');

            $metaManage = manage_meta($jobData, 'job');
            if ($data['smid'] == 1) {
                manage_job_related_data(array('iid' => $data['aiid'], 'noteFor' => 'insert', 'userid' => get_logged_user(), 'note' => "", 'type' => "image", 'mediaid' => $mediaId,'cid'=>$data['cid'],'scid'=>$data['scid']));
            } elseif ($data['smid'] == 2) {
                manage_job_related_data(array('iid' => $data['aiid'], 'noteFor' => 'insert', 'userid' => get_logged_user(), 'note' => "", 'type' => "pdf", 'mediaid' => $mediaId,'cid'=>$data['cid'],'scid'=>$data['scid']));
            }
            /* elseif($data['smid']==3)
              {
              manage_job_related_data(array('iid'=>$data['aiid'],'noteFor'=>'insert','userid'=>get_logged_user(),'note'=>"",'type'=>"doc",'mediaid'=>$mediaId));
              } */ elseif ($data['smid'] == 4) {
                manage_job_related_data(array('iid' => $data['aiid'], 'noteFor' => 'insert', 'userid' => get_logged_user(), 'note' => "", 'type' => "audio", 'mediaid' => $mediaId,'cid'=>$data['cid'],'scid'=>$data['scid']));
            } elseif ($data['smid'] == 5) {
                manage_job_related_data(array('iid' => $data['aiid'], 'noteFor' => 'insert', 'userid' => get_logged_user(), 'note' => "", 'type' => "video", 'mediaid' => $mediaId,'cid'=>$data['cid'],'scid'=>$data['scid']));
            } elseif ($data['smid'] == 6) {
                manage_job_related_data(array('iid' => $data['aiid'], 'noteFor' => 'insert', 'userid' => get_logged_user(), 'note' => "", 'type' => "image", 'mediaid' => $mediaId,'cid'=>$data['cid'],'scid'=>$data['scid']));
            } elseif ($data['smid'] == 7) {
                manage_job_related_data(array('iid' => $data['aiid'], 'noteFor' => 'insert', 'userid' => get_logged_user(), 'note' => "", 'type' => "html", 'mediaid' => $mediaId,'cid'=>$data['cid'],'scid'=>$data['scid']));
            }
        }
    }
}

function resize_mediaData($data,$medianame,$media_url,$media_id)
{
    
    if($data['mediaType']!='others')
    {            
        $json = get_setting_by_mid(array("mid"=>"10","smid"=>$data['smid']));
        
        $json = $json['data'][0]['json'];
        logger("10","",$json,5);
        $resize_arr = $json['type'][$data['mediaType']]['resize_arr'];
        logger("10","",$resize_arr,5);
        $convert_to = $json['type'][$data['mediaType']]['convert_to'];
        $keep_main_media = $json['keep_main_media'];
        if(sizeof($resize_arr)>0)
        {
            resize_media($medianame,$media_url,$resize_arr,$data['mediaType'],$media_id,$convert_to,$keep_main_media);
        }
        else
        {
            logger("10","",array("error"=>"json is incorrect or not found"),5);
        }
    }
    
    logger("10","",$data,2);
    
}

function resize_media($medianame,$mediapath,$resize_arr,$media_type,$media_id,$convert_to,$keep_main_media)
{
    global $server_path;
    $new_arr = array();

    for($i=0;$i<sizeof($resize_arr);$i++)
    {
        $w = $resize_arr[$i]['w'];
        $h = $resize_arr[$i]['h'];
        
        $mediaame = explode(".",$medianame);
        if($convert_to!='')
        {
            $newname = $mediaame[0]."_$w.".$convert_to;
        }
        else
        {
            $newname = $mediaame[0]."_$w.".end($mediaame);
        }
        
        $mediacopypath = $mediapath.$medianame;
        $newmediapath = $mediapath.$newname;
        array_push($new_arr,array("w"=>$w,"h"=>$h,"image"=>$newname));
        Switch($media_type)
        {
            case "image":
                    $image = new SimpleImage($w,$h,$h); 
                    if($image->loadimage($mediacopypath))
                    {
                        if($image->adaptsize(ADAPT_DT))
                        {
                            if($image->resizetoadaptedsize($newmediapath))
                            {
                                $no_error = true;
                            }
                        }
                    }
            break;
            case "video":
                    $ffmpeg = $server_path.'/modules/media/include/core/ffmpeg/bin/ffmpeg';  
                    $size = $w."*".$h;
                    $cmd = shell_exec("$ffmpeg -i $mediacopypath -vcodec h264 -acodec aac -strict -2 -s $size $newmediapath");
            break;
            default:
                    echo "No action required";
            break;
        }
        
        if($keep_main_media==0)//delete=0 keep=1
        {
            unlink($mediapath.$medianame);
        }
        $res = update_mongo('media',array("editedMedia"=>$new_arr),array('_id'=>new mongoId($media_id)));
    }
}

function update_media($data)
{
    global $media_url;
    
    $medianame = explode(".",$_FILES[$data['mediaName']]['name']);
    $medianame = "media_".time().".".end($medianame);
    $marray = explode('.', $_FILES[$data['mediaName']]['name']);
    $mextension = end($marray);
    if(!in_array($mextension, array('jpg', 'jpeg', 'png'))) {
        return array("success" => "false", "data" => "Profile updated sucessfully, Image upload failed only 'jpg', 'jpeg', 'png' files are allowed", "error_code" => "10009");
    }
    Switch($data['mediaType'])
    {
        case "image":
                $media_url = $media_url."images/";
        break;
        
        case "video":
                $media_url = $media_url."videos/";
        break;
        
        case "audio":
                $media_url = $media_url."audios/";
        break;
        
        default:
                $media_url = $media_url."others/";
        break;
    }
    if(isset($data['base64enc']) && $data['base64enc']=="1")
    {
        if(isset($data[$data['mediaName']])){
            if(isset($data['extension']))
            {
                $medianame.=$data['extension'];
                if(!file_put_contents($media_url.$medianame,base64_decode($data[$data['mediaName']])))
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
                    if(!file_put_contents($media_url.$medianame,base64_decode(end($findext))))
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
    else
    {
        if(move_uploaded_file($_FILES[$data['mediaName']]['tmp_name'],$media_url.$medianame))
        {
            logger("10","10002",array("data"=>"successful"),5);
        }
        else
        {
            return array("success"=>"false","data"=>$data,"error_code"=>"10001");
        }
    }
    
    /*$data['type']=$mextension;
    if(isset($data['type']))
    {
        $data['type'] = $data['type'];
    }*/
    $data['mediaName'] = $medianame;
    $data['lastUpdate'] = new MongoDate();
    $id = $data['id'];
    unset($data['id']);
    unlink_media($id);
    
    $res = update_mongo('media',$data,array('_id'=> new MongoId($id)));
    if($res['n'] == 0)
    {
        return array("success"=>"false","data"=>array(),"error_code"=>"10004");
    }
    else
    {
        $media_id = $id;
        if($data['mediaType']!='others')
        {
            
            $json = get_setting(array("mid"=>"10","smid"=>$data['smid']));
            $json = $json['data'][0]['json'];
            logger("10","",$json,5);
            
            $resize_arr = $json['type'][$data['mediaType']]['resize_arr'];
            logger("10","",$resize_arr,5);
            
            $convert_to = $json['type'][$data['mediaType']]['convert_to'];
            $keep_main_media = $json['keep_main_media'];
            
            if(sizeof($resize_arr)>0)
            {
                resize_media($medianame,$media_url,$resize_arr,$data['mediaType'],$media_id,$convert_to,$keep_main_media);
            }
            else
            {
                logger("10","",array("error"=>"json is incorrect or not found"),5);
            }
        }
      //  associate_module("10",$media_id,$data['amid'],$data['asmid'],$data['aiid'],array(),'add');

        return array("success"=>"true","data"=>$media_id,"error_code"=>"10007");
    }
}

function get_media_by_amid($data)
{
    logger("10","",$data,5);
    $check = check_key_available($data,array('amid','type'));
    if($check['success'] == 'true')
    {
        $arr = array();
        $amid = explode("|",$data['amid']);
        
        switch($data['type'])
        {
            case 'all':
                $arr = array('amid'=>array('$in'=> $amid));
            break;
            default:
                $arr = array("mediaType"=>$data['type'],'amid'=>array('$in'=> $amid));
            break;
        }
        
        if(isset($data['timestamp']))
        {
            $arr['lastUpdate'] = array('$gt' => new MongoDate($data['timestamp'])); 
        }
        
        if(isset($data['nor']))
        {
            if(isset($data['index']))
            {
                $res = select_sort_limit_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['index'],$data['nor']);
            }
            else
            {
                $res = select_sort_limitonly_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['nor']);
            }
        }
        else
        {
            $res = select_sort_mongo('media',$arr,array(),array('lastUpdate'=>-1));
        }
        $res = add_id($res,"id");
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    } 
}

function get_media_by_smid($data)
{
    logger("10","",$data,5);
    $check = check_key_available($data,array('smid','type'));
    if($check['success'] == 'true')
    {
        $arr=array();
        $smid = explode("|",$data['smid']);
        
        switch($data['type'])
        {
            case 'all':
                $arr = array('smid'=>array('$in'=> $smid));
            break;
            default:
                $arr = array("mediaType"=>$data['type'],'smid'=>array('$in'=> $smid));
            break;
        }
        
        if(isset($data['timestamp']))
        {
            $arr['lastUpdate'] = array('$gt' => new MongoDate($data['timestamp'])); 
        }
        
        if(isset($data['nor']))
        {
            if(isset($data['index']))
            {
                $res = select_sort_limit_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['index'],$data['nor']);
            }
            else
            {
                $res = select_sort_limitonly_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['nor']);
            }
        }
        else
        {
            $res = select_sort_mongo('media',$arr,array(),array('lastUpdate'=>-1));
        }
        $res = add_id($res,"id");
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    } 
}

function get_media_by_type($data)
{
    logger("10","",$data,5);
    $check = check_key_available($data,array('type'));
    if($check['success'] == 'true')
    {
        $arr=array("mediaType"=>$data['type']);
        if(isset($data['timestamp']))
        {
            $arr['lastUpdate'] = array('$gt' => new MongoDate($data['timestamp'])); 
        }
        
        if(isset($data['nor']))
        {
            if(isset($data['index']))
            {
                $res = select_sort_limit_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['index'],$data['nor']);
            }
            else
            {
                $res = select_sort_limitonly_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['nor']);
            }
        }
        else
        {
            $res = select_sort_mongo('media',$arr,array(),array('lastUpdate'=>-1));
        }
        $res = add_id($res,"id");
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    } 
}

function get_media_by_id($data)
{
    logger("10","",$data,5);
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        $object=false;
        if(isset($data['object'])){ $object=true; unset($data['object']); }
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
                $res = select_sort_limit_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['index'],$data['nor']);
            }
            else
            {
                $res = select_sort_limitonly_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['nor']);
            }
        }
        else
        {
            if(isset($data['aiid'])){ $arr['aiid']=array('$in'=>explode("|",$data['aiid'])); }
            if(isset($data['l_id'])  && $data['l_id']!=''){ $arr['l_id']=$data['l_id']; }
            $res = select_sort_mongo('media',$arr,array(),array('lastUpdate'=>-1));
        }
        $res = add_id($res,"id");

        if(isset($data['amid']) && isset($data['asmid']))
        {
            $association_data = get_association_data("10",$data['amid'],$data['asmid'],$data['id']);
            //$res['association_data'] = $association_data;
        }

        if($object){
            $return=array();
            foreach($res as $ret)
            {
                $ret['link']=get_upload_dir_uri()."media/".$ret['mediaType']."s/".$ret['mediaName'];
                array_push($return,$ret);
            }

            return array("success"=>"true","data"=>$return,"error_code"=>"100");
        }

        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function get_media_by_date($data)
{
    logger("10","",$data,5);
    $check = check_key_available($data,array('start_date','end_date','type'));
    if($check['success'] == 'true')
    {
        $stdate = $data['start_date']. " 00:00";
        $enddate = $data['end_date']. " 24:00";
        
        $start = new MongoDate(strtotime($stdate));
        $end = new MongoDate(strtotime($enddate));
        if($data['type'] == 'all')
        {
            
            $arr = array("uploadedOn"=>array('$gt'=>$start,'$lt'=>$end));
        }
        else
        {
            $arr = array("uploadedOn"=>array('$gt'=>$start,'$lt'=>$end),"mediaType"=>$data['type']);
        }
        
        if(isset($data['timestamp']))
        {
            $arr['lastUpdate'] = array('$gt' => new MongoDate($data['timestamp'])); 
        }
        
        if(isset($data['nor']))
        {
            if(isset($data['index']))
            {
                $res = select_sort_limit_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['index'],$data['nor']);
            }
            else
            {
                $res = select_sort_limitonly_mongo('media',$arr,array(),array('lastUpdate'=>-1),$data['nor']);
            }
        }
        else
        {
            $res = select_sort_mongo('media',$arr,array(),array('lastUpdate'=>-1));
        }
        $res = add_id($res,"id");
        
        return array("success"=>"true","data"=>$res,"error_code"=>"100");
    }
    else
    {
        return $check;
    }
}

function delete_previous_media($data)
{
    global $media_url;
    $check = check_key_available($data,array('amid',"asmid","aiid"));
    if($check['success'] == 'true')
    {
        $getMedia=select_mongo('media',array('amid'=>$data['amid'],'asmid'=>$data['asmid'],'aiid'=>$data['aiid']));
        $getMedia=add_id($getMedia);

        if(sizeof($getMedia))
        {
            $mediaIds=array();
            foreach($getMedia as $mediaData)
            {
                Switch($mediaData['mediaType'])
                 {
                    case "image":
                            $mediaurl = $media_url."images/";
                    break;
                    
                    case "video":
                            $mediaurl = $media_url."videos/";
                    break;
                    
                    case "audio":
                            $mediaurl = $media_url."audios/";
                    break;
                    
                    default:
                            $mediaurl = $media_url."others/";
                    break;
                 }
                if(file_exists($mediaurl.$mediaData['mediaName'])){ unlink($mediaurl.$mediaData['mediaName']); }
                array_push($mediaIds,new MongoId($mediaData['id']));
            }
            $res = delete_mongo('media',array('_id'=>array('$in'=> $mediaIds)));
        }
        else
        {
            $deleteMedia=array('data'=>'not available');
        }
        return $deleteMedia;
    }
    else
    {
        return $check;
    }
}

function delete_media($data)
{
    global $media_url;
    global $companyId;
    logger("10","",$data,5);
    $check = check_key_available($data,array('id'));
    if($check['success'] == 'true')
    {
        unlink_media($data['id']);
        $id = explode("|",$data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
            associate_module("10",$val,'','','',array(),'delete');
        }
        $condition=array('_id'=>array('$in'=> $id));
        
        $res = delete_mongo('media',$condition);
        if($res['n']=='1')
        { 
            if($data['amid']=='5')///for media push in job module.
            {
                $itemId = $data['aiid']."|".$id;
                $jobs = get_job_by_id(array("id"=>$data['aiid'],"smid"=>$data['asmid'],"assignedTo"=>"true"));
                $jobs = $jobs['data'][0];
                $userToSend = $jobs['userid'];
                insert_notification(array('customerId'=>$companyId,'mid'=>"5",'smid'=>$data['asmid'],'userId'=>$userToSend,'itemId'=>$itemId,'eid'=>"40","extra"=>$data));   
            }
            return array("success"=>"true","data"=>$fields,"error_code"=>"10006");
        }
        else
        {
            return array("success"=>"false","data"=>$fields,"error_code"=>"10005");
        }
    }
    else
    {
        return $check;
    }
}

function get_media($data=array())
{   
    logger("10","",$data,5);
    global $companyId;
    $urlField=false;$object=false;
    if(isset($data['url'])=='true'){ $urlField=true; unset($data['url']); }
    if(isset($data['object'])=='true'){ $object=true; unset($data['object']); }

    
    $getMedia=select_mongo('media',$data,array('mediaName','type','extension','mediaType','smid','mediaOrgName', 'lastUpdate','imagetype'));


    $getMedia=add_id($getMedia);
    $media_url=MEDIA_ACCESS_URL."media/";
    $getUrl=module_access_url('10');
    if($getUrl){ 
        $getUrl=json_decode($getUrl,true); 
       // $media_url=$getUrl['access_url']."company/".$companyId."/uploads/media/";
    }

    if($urlField || $object)
    {
        $media=array();
        foreach($getMedia as $mediaData)
        {
             Switch($mediaData['mediaType'])
             {
                case "image":
                        $mediaurl = $media_url."images/";
                break;
                
                case "video":
                        $mediaurl = $media_url."videos/";
                break;
                
                case "audio":
                        $mediaurl = $media_url."audios/";
                break;
                
                default:
                        $mediaurl = $media_url."others/";
                break;
             }
            $url=$mediaurl.$mediaData['mediaName'];
            if($object)
            {
                $mediaData['url']=$url;
                array_push($media,$mediaData);
            }
            else
            {
                array_push($media,$url);
            }
        }
        return array('success'=>'true','error_code'=>'100','data'=>$media);
    }

    return array('success'=>'true','error_code'=>'100','data'=>$getMedia);
}

function unlink_media($id)
{
    logger("10","",$id,5);
    global $media_url;
    $id = explode("|",$id);
    foreach ($id as $key => $val) {
        $id[$key] = new MongoId($val);
    }
    $condition=array('_id'=>array('$in'=> $id));
        
    $res = select_mongo('media',$condition);
    $res = add_id($res,"id");

    foreach($res as $row)
    {
        Switch($row['mediaType'])
        {
            case "image":
                    $mediaurl = $media_url."images/";
            break;
            
            case "video":
                    $mediaurl = $media_url."videos/";
            break;
            
            case "audio":
                    $mediaurl = $media_url."audios/";
            break;
            
            default:
                    $mediaurl = $media_url."others/";
            break;
        }
        unlink($mediaurl.$row['mediaName']);
        
        foreach($row['editedMedia'] as $val)
        {
            unlink($mediaurl.$val['image']);
        }
    }
}
?>