<?php
/***********Others webservices**************/

function send_curl_post($data, $url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

function insert_notification($data)
{
    logger("3", $data, "", 5, "/insert_notification");
    $check = check_key_available($data, array('customerId', 'mid', 'smid', 'userId', 'itemId', 'eid'));
    if ($check['success'] == 'true') {
        $ms = time() * 1000 + (1 * 60 * 1000);
        if (isset($data['ms'])) {
            $ms = $data['ms'];
        }
        $data['ms'] = "$ms";
        $data['status'] = "0";
        $data['createdOn'] = new MongoDate();
        $data['_id'] = new MongoId();
        unset($data['id']);
        //if($data['mid']=="5")
        //{
        $res = insert_mongo('toSend', $data);
        if ($res['n'] == 1) {
            return array("success" => "false", "data" => $data, "error_code" => "3001");
        } else {
            $ins_id = db_id($data);
            return array("success" => "true", "data" => $ins_id, "error_code" => "3010");
        }
        //}
        //return array("success"=>"false","data"=>$data,"error_code"=>"3001");
    } else {
        return $check;
    }
}

function send_ios_notification($data)
{
    logger("3", $data, "", 5, "/send_ios_notification");
    $check = check_key_available($data, array('deviceToken', 'message'));
    if ($check['success'] == 'true') {
        $Json = new Json();
        $result = $Json->send_ios_push($data['deviceToken'], $data['message']);
        return array("success" => "true", "data" => $result, "error_code" => "100");
    } else {
        return $check;
    }
}


function send_notification($data)
{
    logger("3", $data, "", 5, "/send_notification");
    $check = check_key_available($data, array('customerId', 'mid', 'smid', 'userId', 'itemId', 'eid'));
    if ($check['success'] == 'true') {
        $anouid = "";
        $pushTitle = "";
        $ms = time() * 1000;
        if (isset($data['anouid']) && $data['anouid'] != "") {
            $anouid = $data['anouid'];
        }
        if (isset($data['pushTitle']) && $data['pushTitle'] != "") {
            $pushTitle = $data['pushTitle'];
        }
        if (isset($data['ms']) && $data['ms'] != "") {
            $ms = $data['ms'];
        }

        $result = prepare_send_notification($data['mid'], $data['smid'], $data['userId'], $data['itemId'], $data['eid'], $data['extra'], $pushTitle, $anouid, $ms, $data['customerId'], $data['extra_data']);

        return array("success" => "true", "data" => $result, "error_code" => "100");
    } else {
        return $check;
    }
}

function prepare_send_notification($mid, $smid, $users, $id, $eventId = 0, $extra = array(), $pushTitle, $anouid, $ms, $customerId, $extra_data = array())
{

    $count = count_mongo('triggers', array());
    if ($count > 0) {
        //var_dump(array('mid'=>$mid,'smid'=>$smid,'eid'=>$eventId,'status'=>'1'));
        $select = select_mongo('triggers', array('mid' => "$mid", 'smid' => "$smid", 'eid' => "$eventId", 'status' => '1'));
        $fetch = add_id($select, 'id');
        if (count($fetch) > 0) {

            $e = $p = $s = 0;
            $pmsg = "";
            $emsg = "";
            $smsg = "";
            foreach ($fetch as $trigger) {
                Switch ($trigger['type']) {
                    case 'push':
                        $p = 1;
                        $pmsg = $trigger['msg'];
                        break;
                    case 'email':
                        $e = 1;
                        $emsg = $trigger['msg'];
                        break;
                    case 'sms':
                        $s = 1;
                        $smsg = $trigger['msg'];
                        break;
                }
            }


            $params = array("mid" => $mid, "smid" => $smid);
            $getsetting = get_module_setting_by_mid($params);
            $uiSetting = "";
            if ($mid == "22" && $smid == "1" && $eventId == "96") {
                $uiSetting = json_encode($getsetting['data'][0]['uiSetting']);
            }
            $userArr = array();
            $setting = $getsetting['data'][0]['uiSetting']['notification'][$eventId];
            if ($setting['user'] == 1) {
                $n = (isset($setting['desktopNotification'])) ? $setting['desktopNotification'] : 0;

                $stringid = 0;
                $mstringid = 0;
                $uid1 = $uid2 = $uid3 = $url1 = $url2 = $deviceid = $usedFor = '';
                $uid = explode('|', $id);
                if (isset($uid[0])) {
                    $uid1 = $uid[0];
                }
                if (isset($uid[1])) {
                    $uid2 = $uid[1];
                }
                if (isset($uid[2])) {
                    $uid3 = $uid[2];
                }

                if ($eventId == '116' && $uid1 == 'email') {
                    $p = $s = $n = 0;
                }
                if ($eventId == '116' && $uid1 != 'email') {
                    $e = 0;
                }
                if ($users == "0") {
                    $userparams = array("id" => '0', 'fields' => 'name');
                } else {
                    $userparams = array("id" => $users, 'fields' => 'name');
                }

                $ctgusers = '';

                $users = get_user_info_by_id($userparams);
                if ($users['success'] == 'true') {
                    foreach ($users['data'] as $val) {
                        $dummyArr = array();
                        $managerArr = array();
                        if ($setting['manager'] == 1) {

                            /*$manager = get_user_manager(array("userid"=>$val['id']));
                                if($manager['success']=='true')
                                {
                                    foreach($manager['data'] as $val1)
                                    {
                                        array_push($dummyArr,$val1['id']);
                                    }
                                }

                                array_push($managerArr,$dummyArr);*/
                        }

                        if (isset($setting['categories']) && $setting['categories'] != '') {
                            //$ctgusers = $setting['categories'];
                        }

                        array_push($userArr, $val['id']);
                    }
                }

                if (isset($setting['stringid'])) {
                    $stringid = $setting['stringid'];
                }
                if (isset($setting['mstringid'])) {
                    $mstringid = $setting['mstringid'];
                }
                if (isset($setting['url1'])) {
                    $url1 = $setting['url1'];
                }
                if (isset($setting['url2'])) {
                    $url2 = $setting['url2'];
                }
                if (isset($setting['usedFor'])) {
                    $usedFor = $setting['usedFor'];
                }
                if (isset($setting['deviceid'])) {
                    $deviceid = $setting['deviceid'];
                }//here you will have to check it from extra parameter

                $arr = array(
                    "customer_id" => $customerId,
                    "moduleid" => $mid,
                    "submoduleid" => $smid,
                    "eventid" => $eventId,
                    "uid1" => $userArr,
                    "uid2" => $uid1,
                    "uid3" => $uid2,
                    "uid4" => $uid3,
                    "uid5" => $managerArr,
                    "url1" => $url1,
                    "url2" => $url2,
                    "stringid" => $stringid,
                    "mstringid" => $mstringid,
                    "reqtype" => "inline",
                    "requrl" => "",
                    "used_for" => $usedFor,
                    "data" => $extra,
                    "dev1" => $deviceid,
                    "ctgUsers" => $ctgusers,
                    "uiSetting" => $uiSetting,
                    "smsg" => $smsg,
                    "emsg" => $emsg,
                    "pmsg" => $pmsg,
                    "pushTitle" => $pushTitle,
                    "anouid" => $anouid,
                    "desktopNotification" => $n,
                    "ms" => $ms,
                    "extra_data" => $extra_data,
                );

                $sendArray = array($arr);
                // print_r($sendArray);die;

                $Json = new Json();

                $send_notification = $Json->add_notification(json_encode($sendArray), $e, $p, $s, $n);

                //return array("success"=>"true","data"=>$send_notification,"error_code"=>"100");
            }
        } else {
            return array("success" => "false", "data" => 'trigger not set1', "error_code" => "100");
        }
    } else {
        return array("success" => "false", "data" => 'trigger not set2', "error_code" => "100");
    }


}

function send_push_on_devices($data)
{
    logger("3", $data, "", 5, "/send_push_on_devices");
    $check = check_key_available($data, array('userId', 'message'));
    if ($check['success'] == 'true') {
        $user = explode("|", $data['userId']);
        $Json = new Json();
        $result = $Json->send_push_on_device($user, $data['message']);
        return array("success" => "true", "data" => $result, "error_code" => "100");
    } else {
        return $check;
    }
}

function sendEmailToUser($data)
{
    logger("3", $data, "", 5, "/sendEmailToUser");
    $check = check_key_available($data, array('email', 'subject', 'message', 'account'));
    if ($check['success'] == 'true') {
        if ($data['email'] != '') {
            $auto_mail = new auto_mail1(3);
            $subject = $data['subject'];
            $account = get_account_by_id(array("id" => "0"));
            $account = $account['data'][0];
            $replace_template = $data['message'];

            $email = explode(",", $data['email']);
            foreach ($email as $value) {
                $ismail = $auto_mail->send_email($value, $replace_template, $subject, $account);
            }
        }
    } else {
        return $check;
    }
}

function send_broadcast_notification($data)
{
    logger("3", $data, "", 5, "/send_broadcast_notification");
    $check = check_key_available($data, array('userId', 'ctgId', 'type', 'txt', 'tempId', 'accId', 'subject'));
    if ($check['success'] == 'true') {
        $userids = array();
        $users1 = array();
        $users2 = array();
        if ($data['userId'] != '' && $data['userId'] != '0') {
            $users1 = explode(",", $data['userId']);
        }

        if ($data['ctgId'] != '' && $data['ctgId'] != '0') {
            $ctgs = explode(",", $data['ctgId']);
            $ctgs = implode("|", $ctgs);
            $ctgusers = get_category_users(array("category_ids" => $ctgs));

            foreach ($ctgusers as $key => $value) {
                array_push($users2, $value['id']);
            }
        }

        /*******For subscribed email user*********/
        if ($data['userId'] == '0') {
            $emails = get_email_by_id(array("id" => "0"));
            $emails = $emails['data'];
            $auto_mail = new auto_mail1(3);
            $subject = $data['subject'];
            $account = get_account_by_id(array("id" => $data['accId']));
            $account = $account['data'];
            $replace_template = $data['txt'];

            foreach ($emails as $key => $value) {
                $ismail = $auto_mail->send_email($value['email'], $replace_template, $subject, $account);
            }
        }
        /*******For subscribed email user*********/

        $userids = array_merge($users1, $users2);
        $users = implode("|", $userids);
        $Json = new Json();
        if ($data['type'] == 'push') {
            $gcmno = array();
            if (isset($users)) {
                $get = get_resource_by_id(array("id" => $users));

                foreach ($get['data'] as $key => $value) {
                    if (isset($value['gcm'])) {
                        array_push($gcmno, $value['gcm']);
                    }
                }
            }


            if (count($gcmno) > 0) {

                $res = $Json->send_push($gcmno, $data['txt']);
                //print_r($res);
            }
        }

        if ($data['type'] == 'sms') {
            $contacts = array();
            if (isset($users)) {
                $get = get_resource_by_id(array("id" => $users));
                foreach ($get['data'] as $key => $value) {
                    if (isset($value['contact'])) {
                        array_push($contacts, $value['contact']);
                    }
                }
            }

            if (count($contacts) > 0) {
                send_sms($contacts, $data['txt']);
            }
        }


        if ($data['type'] == 'email') {
            $emails = array();
            if (isset($users)) {
                $auto_mail = new auto_mail1(3);
                $subject = $data['subject'];
                $account = get_account_by_id(array("id" => $data['accId']));
                $account = $account['data'];
                $replace_template = $data['txt'];
                $get = get_resource_by_id(array("id" => $users));
                foreach ($get['data'] as $key => $value) {
                    $ismail = $auto_mail->send_email($value['email'], $replace_template, $subject, $account);
                }
            }
        }
        return array("success" => "true", "data" => "", "error_code" => "100");
    } else {
        return $check;
    }
}


function get_all_modules()
{
    $res = select_all_mongo('module');
    $res = data_array($res);
    return array("success" => "true", "data" => $res, "error_code" => "100");
}

function get_all_events($data)
{
    logger("3", $data, "", 5, "/get_all_events");
    $check = check_key_available($data, array('mid'));
    if ($check['success'] == 'true') {
        $res = select_mongo('events', array("mid" => $data['mid']));
        $res = data_array($res);
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_all_fieldsOld($data)
{
    logger("3", $data, "", 5, "/get_all_fieldsOld");
    $check = check_key_available($data, array('eid'));
    if ($check['success'] == 'true') {
        $arr = array();
        $final_array = array();
        if (isset($data['eid']) && $data['eid'] != "") {
            $arr['eid'] = $data['eid'];
        }
        $res = select_mongo('event_fields', $arr);

        $res = add_id($res, "id");

        foreach ($res as $arr) {
            $tmp1 = select_mongo('fields', array("fieldId" => ($arr['fieldId'])));
            $res1 = add_id($tmp1, "id");
            array_push($final_array, array("fieldName" => $res1[0]['fieldName'], "fieldValue" => $res1[0]['fieldValue']));
        }
        return array("success" => "true", "data" => $final_array, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_all_fields($data)
{
    logger("3", $data, "", 5, "/get_all_fields");
    $check = check_key_available($data, array('eid'));
    if ($check['success'] == 'true') {
        $arr = array();
        if (isset($data['fieldId']) && $data['fieldId'] != "") {
            $arr['fieldId'] = $data['fieldId'];
        }
        $tmp1 = select_mongo('fields', $arr);
        $res1 = add_id($tmp1, "id");

        return array("success" => "true", "data" => $res1, "error_code" => "100");
    } else {
        return $check;
    }
}


function get_notification_by_id($data)
{
    global $other_server;
    logger("3", $data, "", 5, "/get_notification_by_id");
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/get_notification_by_id";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }


    $check = check_key_available($data, array('id', 'userId'));
    if ($check['success'] == 'true') {

        $arr = array();
        if ($data['id'] != 0) {
            $id = explode("|", $data['id']);
            foreach ($id as $key => $val) {
                $id[$key] = new MongoId($val);
            }
            $arr = array('_id' => array('$in' => $id));
        }

        if (isset($data['timestamp'])) {
            $arr['ms'] = array('$gt' => new MongoDate($data['timestamp']));
        }

        if (isset($data['seen'])) {
            $arr['seen'] = $data['seen'];
        }
        if (isset($data['desktopNotification'])) {
            $arr['desktopNotification'] = $data['desktopNotification'];
        }

        if (isset($data['deviceType'])) {
            $arr['download'] = "0";
        }
        if (isset($data['userId'])) {
            $arr['userId'] = array('$in' => array($data['userId']));
        }

        if (isset($data['nor'])) {
            if (isset($data['index'])) {
                $res = select_sort_limit_mongo('notification', $arr, array(), array('ms' => -1), $data['index'], $data['nor']);
            } else {
                $res = select_sort_limitonly_mongo('notification', $arr, array(), array('ms' => -1), $data['nor']);
            }
        } else {

            $res = select_sort_mongo('notification', $arr, array(), array('ms' => -1));

        }
        $res = add_id($res, "id");

        if (isset($data['deviceType'])) {
            $res1 = array();
            foreach ($res as $key => $val) {

                //$getstring = select_mongo('strings',array("id"=>$val['stringid']),array());
                //$getstring = add_id($getstring,"id");
                //$res1[$key]['txt'] = $getstring[0]['txt'];
                $pmsg = (isset($val['pmsg'])) ? $val['pmsg'] : '';
                if (isset($val['pushTitle']) && $val['pushTitle'] != "") {
                    $pmsg = $val['pushTitle'];
                }

                $res1[$key]['timeago'] = milesecond_time_elapsed_string($val['ms']);
                $res1[$key]['t'] = $pmsg;
                $res1[$key]['ms'] = strval($val['ms']);
                $res1[$key]['mid'] = $val['moduleid'];
                $res1[$key]['smid'] = $val['submoduleid'];
                $res1[$key]['eid'] = $val['eventid'];
                $res1[$key]['sid'] = $val['stringid'];
                $res1[$key]['u1'] = $val['userId'];
                $res1[$key]['u2'] = $val['uid2'];
                $res1[$key]['u3'] = $val['uid3'];
                $res1[$key]['u4'] = $val['uid4'];
                $res1[$key]['u5'] = "";
                $res1[$key]['cdata'] = (isset($val['cdata'])) ? json_decode($val['cdata']) : array();
                update_mongo("notification", array("download" => "1"), array('_id' => new MongoId($val['id'])));

            }
            $res = $res1;
        } else {

            foreach ($res as $key => $val) {
                $pmsg = (isset($val['pmsg'])) ? $val['pmsg'] : '';
                if (isset($val['pushTitle']) && $val['pushTitle'] != "") {
                    $pmsg = $val['pushTitle'];
                }
                if (isset($val['url1']) && $val['url1'] != "") {
                    $string = array("[JobID]", "[ticketID]", "[blogID]");
                    $replace = array($val['uid2'], $val['uid2'], $val['uid2']);
                    $url1 = str_replace($string, $replace, $val['url1']);
                    $res[$key]['url1'] = $url1;
                }
                if (isset($val['url2']) && $val['url2'] != "") {
                    $string = array("[JobID]", "[ticketID]", "[blogID]");
                    $replace = array($val['uid2'], $val['uid2'], $val['uid2']);
                    $url2 = str_replace($string, $replace, $val['url1']);
                    $res[$key]['url2'] = $url2;
                }

                //$getstring = select_mongo('strings',array("id"=>$val['stringid']),array());
                //$getstring = add_id($getstring,"id");
                $res[$key]['txt'] = $pmsg;
                $res[$key]['t'] = $pmsg;
                $res[$key]['ms'] = strval($val['ms']);

                $res[$key]['timeago'] = milesecond_time_elapsed_string($val['ms']);

            }

        }


        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }

}


function time_elapsed_string($time)
{
    $ntime = time();
    if ($time) {
        $ntime = intval($time);
    }
    $time = time() - $ntime; // to get the time since that moment
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }
}

function milesecond_time_elapsed_string($time)
{
    $ntime = time();
    if ($time) {
        $ntime = intval($time);
    }
    $time = time() - $ntime / 1000; // to get the time since that moment
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }
}

function manage_notification($data)
{
    //print_r($data);die;
    /*global $other_server;
        if($other_server == "1")
        {
            global $notification_url;
            $url = $notification_url."webservices/manage_notification";
            $curl_post = send_curl_post($data,$url);
            return json_decode($curl_post,true);
            die;
        }
        */
    logger("3", $data, "", 5, "/manage_notification");
    $check = check_key_available($data, array('id', 'moduleid', 'submoduleid', 'eventid', 'userId', 'uid2', 'uid3', 'uid4', 'uid5', 'ms', 'seen', 'download'));
    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_notifications($data);
                break;

            default:
                $manage = update_notification($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_notifications($data)
{
    logger("3", $data, "", 5, "/add_notifications");
    unset($data['id']);
    $matchdata = $data['moduleid'] . "-" . $data['submoduleid'] . "-" . $data['eventid'] . "-" . $data['userId'] . "-" . $data['uid2'] . "-" . $data['uid3'] . "-" . $data['uid4'];

    //$checkrecord = count_mongo("notification",array("matchdata"=>$matchdata));
    $checkrecord = 0;
    if ($checkrecord == 0) {
        $data['matchdata'] = $matchdata;
        $res = insert_mongo('notification', $data);
        if ($res['n'] == 1) {
            return array("success" => "false", "data" => $data, "error_code" => "3001");
        } else {
            $ins_id = db_id($data);
            return array("success" => "true", "data" => $ins_id, "error_code" => "3010");
        }
    } else {
        return array("success" => "false", "data" => array(), "error_code" => "3010");
    }
}

function update_notification($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/update_notification";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/update_notification");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $arr = array();
        if ($data['id'] != 0) {
            $id = explode("|", $data['id']);
            foreach ($id as $key => $value) {
                $cond = array('_id' => new MongoId($value));
                $res = update_mongo('notification', array("seen" => "1"), $cond);
            }
        } else {
            $res = update_mongo('notification', array("seen" => "1"), array());
        }

        return array("success" => "true", "data" => $data, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_strings_by_id($data)
{
    /*global $other_server;
        if($other_server == "1")
        {
            global $notification_url;
            $url = $notification_url."webservices/get_strings_by_id";
            $curl_post = send_curl_post($data,$url);
            return json_decode($curl_post,true);
            die;
        }*/
    logger("3", $data, "", 5, "/get_strings_by_id");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $getstringtxt = select_mongo("strings", array("id" => "$data[id]"), array('txt'));
        $getstringtxt = add_id($getstringtxt, "id");
        return array("success" => "true", "data" => $getstringtxt, "error_code" => "100");
    } else {
        return $check;
    }
}

function clear_notificationOld($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/clear_notification";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/clear_notificationOld");
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') {
        $res = update_mongo('notification', array("seen" => "1"), array("userId" => $data['userId']));
        return array("success" => "true", "data" => $data, "error_code" => "100");
    } else {
        return $check;
    }
}

function clear_notification($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/clear_notification";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/clear_notification");
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') {
        $res = delete_mongo('notification', array("userId" => $data['userId']));
        return array("success" => "true", "data" => $data, "error_code" => "100");
    } else {
        return $check;
    }
}

function count_notification($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/count_notification";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    //logger("3",$data,"",5,"/count_notification");
    $arr = array();
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') {
        if (isset($data['desktopNotification'])) {
            $arr['desktopNotification'] = $data['desktopNotification'];
        }
        $arr['seen'] = "0";
        $arr['userId'] = array('$in' => array($data['userId']));
        $total = count_mongo('notification', $arr);
        return array("success" => "true", "data" => $total, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_events_by_id($data)
{
    logger("3", $data, "", 5, "/get_events_by_id");
    $check = check_key_available($data, array('eid'));
    if ($check['success'] == 'true') {
        $arr = array();
        if ($data['eid'] != 0) {
            $id = explode("|", $data['eid']);
            foreach ($id as $key => $val) {
                $id[$key] = $val;
            }
            $arr = array('eid' => array('$in' => $id));
        }

        $res = select_mongo('events', $arr, array());
        $res = add_id($res, "id");
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}


function get_modules_by_id($data)
{
    logger("3", $data, "", 5, "/get_modules_by_id");
    $check = check_key_available($data, array('mid'));
    if ($check['success'] == 'true') {
        $arr = array();
        if ($data['mid'] != 0) {
            $id = explode("|", $data['mid']);
            foreach ($id as $key => $val) {
                $id[$key] = $val;
            }
            $arr = array('mid' => array('$in' => $id));
        }
        //print_r($arr);

        if (isset($data['status'])) {
            $arr['status'] = $data['status'];
        }

        $res = select_mongo('module', $arr, array());
        $res = add_id($res, "id");
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_submodule_by_id($data)
{
    logger("3", $data, "", 5, "/get_submodule_by_id");
    $check = check_key_available($data, array('mid', 'smid'));
    if ($check['success'] == 'true') {
        $res = select_mongo('subModuleSetting', array("mid" => $data['mid'], "smid" => $data['smid']), array('name'));
        $res = add_id($res, "id");
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_module_submodule($data)
{
    logger("3", $data, "", 5, "/get_module_submodule");
    $mlist = select_mongo("module", array("status" => "1"));
    $mlist = add_id($mlist);
    $final_array = array();

    foreach ($mlist as $value) {
        $smarr = array();
        $smlist = select_mongo("subModuleSetting", array("mid" => $value['mid']));
        $smlist = add_id($smlist, "id");
        foreach ($smlist as $val) {
            array_push($smarr, array("smid" => $val['smid'], "name" => $val['name']));
        }
        array_push($final_array, array("id" => $value['mid'], "moduleName" => $value['title'], "submodule" => $smarr));
    }
    return array("success" => "true", "data" => $final_array, "error_code" => "18014");
}

function get_submodule_events($data)
{
    logger("3", $data, "", 5, "/get_submodule_events");
    $check = check_key_available($data, array('mid', 'smid'));
    if ($check['success'] == 'true') {
        $arr = array();
        $sdata = select_mongo("subModuleSetting", array("mid" => $data['mid'], "smid" => $data['smid']), array("events"));
        $sdata = add_id($sdata, "id");
        $eventid = $sdata[0]['events'];
        if ($eventid != '') {
            $events = get_events_by_id(array("eid" => $eventid));
            return $events;
        } else {
            return array("success" => "true", "data" => array(), "error_code" => "18014");
        }
    } else {
        return $check;
    }
}

/***********Account webservices**************/
function manage_account($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/manage_account";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/manage_account");
    $check = check_key_available($data, array('id', 'domain', 'username', 'password', 'accType', 'accName', 'email', 'url', 'port'));
    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_account($data);
                break;

            default:
                $manage = update_account($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_account($data)
{
    logger("3", $data, "", 5, "/add_account");
    $data['status'] = "1";
    $data['createdOn'] = new MongoDate();
    unset($data['id']);
    $res = insert_mongo('accounts', $data);
    if ($res['n'] == 1) {
        return array("success" => "false", "data" => $data, "error_code" => "3001");
    } else {
        $ins_id = db_id($data);
        return array("success" => "true", "data" => $ins_id, "error_code" => "3010");
    }
}

function update_account($data)
{
    logger("3", $data, "", 5, "/update_account");
    $cond = array('_id' => new MongoId($data['id']));
    unset($data['id']);
    $res = update_mongo('accounts', $data, $cond);
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "3002");
    } else {
        return array("success" => "true", "data" => $data, "error_code" => "3011");
    }
}

function delete_account($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/delete_account";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/delete_account");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition = array('_id' => array('$in' => $id));

        $res = delete_mongo('accounts', $condition);
        $res = add_id($res, "id");
        if ($res['1'] == sizeof($id)) {
            return array("success" => "true", "data" => $data, "error_code" => "3012");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "3003");
        }
    } else {
        return $check;
    }
}

function get_account_by_id($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/get_account_by_id";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/get_account_by_id");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $arr = array();
        if ($data['id'] != 0) {
            $id = explode("|", $data['id']);
            foreach ($id as $key => $val) {
                $id[$key] = new MongoId($val);
            }
            $arr = array('_id' => array('$in' => $id));
        }

        $res = select_sort_mongo('accounts', $arr, array(), array('createdOn' => -1));
        $res = add_id($res, "id");
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

/***********Trigger webservices**************/
function check_trigger($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/check_trigger";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/check_trigger");
    $check = check_key_available($data, array('mid', 'smid', 'eid', 'type'));
    if ($check['success'] == 'true') {
        $fields = array("mid" => $data['mid'], "smid" => $data['smid'], "eid" => $data['eid'], "type" => $data['type']);
        $res = count_mongo('triggers', $fields);
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function manage_trigger($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/manage_trigger";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/manage_trigger");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_trigger($data);
                break;

            default:
                $manage = update_trigger($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_trigger($data)
{
    $check = check_key_available($data, array('mid', 'eid', 'accId', 'tempId', 'mtempId', 'subject', 'type', 'ctgId'));
    if ($check['success'] == 'true') {
        logger("3", $data, "", 5, "/add_trigger");
        $data['status'] = "1";
        $data['createdOn'] = new MongoDate();
        unset($data['id']);
        $res = insert_mongo('triggers', $data);
        if ($res['n'] == 1) {
            return array("success" => "false", "data" => $data, "error_code" => "3004");
        } else {
            $ins_id = db_id($data);
            return array("success" => "true", "data" => $ins_id, "error_code" => "3013");
        }
    } else {
        return $check;
    }
}

function update_trigger($data)
{
    logger("3", $data, "", 5, "/update_trigger");
    $cond = array('_id' => new MongoId($data['id']));
    unset($data['id']);
    $data['createdOn'] = new MongoDate();
    $res = update_mongo('triggers', $data, $cond);
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "3005");
    } else {
        return array("success" => "true", "data" => $data, "error_code" => "3014");
    }
}

function delete_trigger($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/delete_trigger";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/delete_trigger");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition = array('_id' => array('$in' => $id));

        $res = delete_mongo('triggers', $condition);

        if ($res['n'] == '1') {
            return array("success" => "true", "data" => $data, "error_code" => "3015");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "3006");
        }
    } else {
        return $check;
    }
}

function get_trigger_by_id($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/get_trigger_by_id";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/get_trigger_by_id");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $arr = array();
        if ($data['id'] != 0) {
            $id = explode("|", $data['id']);
            foreach ($id as $key => $val) {
                $id[$key] = new MongoId($val);
            }
            $arr = array('_id' => array('$in' => $id));
        }

        if (isset($data['mid'])) {
            $arr['mid'] = $data['mid'];
        }
        if (isset($data['smid'])) {
            $arr['smid'] = $data['smid'];
        }
        if (isset($data['eid'])) {
            $arr['eid'] = $data['eid'];
        }

        $res = select_sort_mongo('triggers', $arr, array(), array('createdOn' => -1));
        $res = add_id($res, "id");
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

/***********Template webservices**************/
function manage_template($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/manage_template";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/manage_template");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_template($data);
                break;

            default:
                $manage = update_template($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_template($data)
{

    $check = check_key_available($data, array('mid', 'eid', 'tempName', 'tempDesc', 'tempFor'));
    if ($check['success'] == 'true') {
        logger("3", $data, "", 5, "/add_template");
        $data['status'] = "1";
        $data['createdOn'] = new MongoDate();
        unset($data['id']);
        $res = insert_mongo('templates', $data);
        if ($res['n'] == 1) {
            return array("success" => "false", "data" => $data, "error_code" => "3007");
        } else {
            $ins_id = db_id($data);
            return array("success" => "true", "data" => $ins_id, "error_code" => "3016");
        }
    } else {
        return $check;
    }
}

function update_template($data)
{
    logger("3", $data, "", 5, "/update_template");
    $cond = array('_id' => new MongoId($data['id']));
    unset($data['id']);
    $data['createdOn'] = new MongoDate();
    $res = update_mongo('templates', $data, $cond);
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "3008");
    } else {
        return array("success" => "true", "data" => $data, "error_code" => "3017");
    }
}

function delete_template($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/delete_template";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/delete_template");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition = array('_id' => array('$in' => $id));
        //print_r($condition);die;

        $res = delete_mongo('templates', $condition);

        if ($res['n'] == '1') {
            return array("success" => "true", "data" => $data, "error_code" => "3018");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "3009");
        }
    } else {
        return $check;
    }
}

function get_template_by_id($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/get_template_by_id";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/get_template_by_id");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $arr = array();
        if ($data['id'] != 0) {
            $id = explode("|", $data['id']);
            foreach ($id as $key => $val) {
                $id[$key] = new MongoId($val);
            }
            $arr = array('_id' => array('$in' => $id));
        }


        $res = select_sort_mongo('templates', $arr, array(), array('createdOn' => -1));
        $res = add_id($res, "id");

        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_me_templates($data)
{
    global $other_server;
    if ($other_server == "1") {
        global $notification_url;
        $url = $notification_url . "webservices/get_me_templates";
        $curl_post = send_curl_post($data, $url);
        return json_decode($curl_post, true);
        die;
    }
    logger("3", $data, "", 5, "/get_me_templates");
    $check = check_key_available($data, array('mid', 'smid', 'eid'));
    if ($check['success'] == 'true') {
        $fields = array("mid" => $data['mid'], "smid" => $data['smid'], "eid" => $data['eid']);
        $res = select_mongo('templates', $fields, array("tempName"));
        $res = add_id($res, "id");
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}


function get_module_submodule_event_template($data)
{
    global $other_server;
    logger("3", $data, "", 5, "/get_module_submodule_event_template");
    $check = check_key_available($data, array('mid', 'smid'));
    if ($check['success'] == 'true') {
        $fields = array();
        $condition = array();
        $res = array();
        $final_array = array();
        if (isset($data['fields'])) {
            $fields = explode(",", $data['fields']);
        }
        $marr = explode("|", $data['mid']);
        $i = 0;
        foreach ($marr as $value) {
            $final_array['id'] = $value;
            $smarr = explode("|", $data['smid']);
            $smarr1 = explode(",", $smarr[$i]);
            $condition['mid'] = $value;
            $condition['smid'] = array('$in' => $smarr1);
            $submoduleArr = array();
            $arr = select_mongo('subModuleSetting', $condition, $fields);
            $arr = add_id($arr, "id");
            //print_r($arr);die;
            foreach ($arr as $key => $value1) {
                $newArr = array();
                $newArr['smid'] = $value1['smid'];
                $newArr['name'] = $value1['name'];
                $eventsArr = array();
                if (isset($value1['events']) && $value1['events'] != "") {
                    $events = get_events_by_id(array('eid' => $value1['events']));
                    if (!empty($events)) {
                        foreach ($events['data'] as $evalue) {
                            $submoduleArr['events'][] = array('eid' => $evalue['eid'], 'name' => $evalue['name']);
                            /*$submoduleArr['events']['triggers'][]=array();
                                $triggers=get_trigger_by_id(array('id'=>'0','mid'=>$value,'smid'=>$value1['smid'],'eid'=>$evalue['eid']));
                                if(!empty($triggers['data']))
                                {
                                    foreach ($triggers['data'] as  $tvalue)
                                    {
                                        $submoduleArr['events']['triggers'][]=array('type'=>$tvalue['type'],'title'=>$tvalue['msg'],'subject'=>$tvalue['subject']);
                                    }
                                }*/
                            $eventsArr[] = $newArr;

                        }
                        $eventsArr[] = $newArr;
                    }
                }
                $submoduleArr[] = $newArr;
                //array_push($submoduleArr,$newArr);
            }
            $final_array['submodule'] = $submoduleArr;
            array_push($res, $final_array);
            $i++;
        }


        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}


function send_announcement_notification($data)
{
    global $companyId;
    logger("3", $data, "", 5, "/send_announcement_notification");
    $check = check_key_available($data, array('userId', 'ctgId', 'type', 'txt', 'tempId', 'title'));

    if ($check['success'] == 'true') {
        $userids = array();
        $users1 = array();
        $users2 = array();
        $senderId = "";
        $senderName = "";
        $type = explode("|", $data['type']);
        $type1 = $type[0];
        $type2 = $type[1];
        $anouid = "";
        if (isset($data['senderId'])) {
            $senderId = $data['senderId'];
        }
        if (isset($data['senderName'])) {
            $senderName = $data['senderName'];
        }
        if ($data['userId'] != '' && $data['userId'] != '0') {
            $users1 = explode(",", $data['userId']);
        }

        if ($data['ctgId'] != '' && $data['ctgId'] != '0') {
            $ctgs = explode(",", $data['ctgId']);
            $ctgs = implode("|", $ctgs);
            $ctgusers = get_category_users(array("category_ids" => $ctgs));
            foreach ($ctgusers['data'] as $value) {
                array_push($users2, $value['id']);
            }
        }

        $userids = array_unique(array_merge($users1, $users2));
        $users = implode("|", $userids);
        $Json = new Json();
        if ($type1 == 'push' || $type2 == 'push') {
            unset($data['userId']);
            unset($data['ctgId']);


        }

        if ($data['type'] == 'sms') {
            $contacts = array();
            if (isset($users)) {
                $get = get_resource_by_id(array("id" => $users));
                foreach ($get['data'] as $key => $value) {
                    if (isset($value['contact'])) {
                        array_push($contacts, $value['contact']);
                    }
                }
            }

            if (count($contacts) > 0) {
                send_sms($contacts, $data['txt']);
            }
        }

        if ($type1 == 'email' || $type2 == 'email') {
            $subject = base64_encode($data['title']);
            $replace_template = base64_encode($data['txt']);
            $notifyData = insert_notification(array('customerId' => $companyId, 'mid' => '37', 'smid' => '1', 'userId' => $users, 'itemId' => "email|" . $subject . "|" . $replace_template, 'eid' => "116", 'extra' => json_encode($data)));

            unset($data['userId']);
            unset($data['ctgId']);
        }
        $users = $users . "|569f7faa7c3d68011e3c9869";
        $data['usersId'] = $users;
        if (!isset($data['id'])) {
            $data['id'] = '0';
        }
        $anouid = manage_announcement($data);
        if ($type1 == 'push' || $type2 == 'push') {

            $notification = send_notification(array('customerId' => $companyId, 'mid' => '37', 'smid' => '1', 'userId' => $users, 'itemId' => $senderId . "|" . $senderName . "|" . $anouid['data'], 'eid' => "116", 'anouid' => $anouid['data'], 'extra' => json_encode(array('usersId' => $users, 'title' => $data['title'], 'message' => $data['txt'], 'uploadedOn' => new MongoDate()))));

        }
        return array("success" => "true", "data" => "", "error_code" => "100");
    } else {
        return $check;
    }
}


function manage_announcement($data)
{
    logger("3", $data, "", 5, "/manage_announcement");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == '0' || $data['id'] == '') {
            $check = check_key_available($data, array('title', 'txt', 'usersId'));
            if ($check['success'] == 'true') {

                $manage = add_announcement($data);
            } else {
                return $check;
            }
        } else {
            $manage = update_announcement($data);
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_announcement($data)
{
    logger("3", $data, "", 5, "/add_announcement");
    unset($data['id']);
    if (isset($data['usersId'])) {
        $userId = explode("|", $data['usersId']);
        $data['userId'] = $userId;
    }
    $data['uploadedOn'] = new MongoDate();
    $data['status'] = "1";
    $res = insert_mongo('announcement', $data);
    if ($res['n'] == 1) {
        return array("success" => "false", "data" => $data, "error_code" => "100");
    } else {
        $ins_id = db_id($data);
        return array("success" => "true", "data" => $ins_id, "error_code" => "100");
    }

}

function update_announcement($data)
{
    logger("3", $data, "", 5, "/update_announcement");
    $id = $data['id'];
    unset($data['id']);
    if (isset($data['usersId'])) {
        $userId = explode("|", $data['usersId']);
        $data['userId'] = $userId;
    }
    $data['uploadedOn'] = new MongoDate();
    $ret = update_mongo('announcement', $data, array('_id' => new MongoId($id)));
    if ($ret['n'] == '1') {
        return array('data' => $id, 'error_code' => '100', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '100', 'success' => 'false');
    }
}


function get_announcement_by_id($data)
{
    logger("3", $data, "", 5, "/get_announcement_by_id");
    $condition = array();
    $index = 0;
    $nrecords = 1;
    if (isset($data['index'])) {
        $index = $data['index'];
    }
    if (isset($data['nrecords'])) {
        $nrecords = $data['nrecords'];
    }
    if (isset($data['id'])) {
        $condition['_id'] = new MongoId($data['id']);
    }
    if (isset($data['userId'])) {
        $condition['userId'] = array('$in' => explode("|", $data['userId']));
    }
    if (isset($data['ntype'])) {
        $condition['type'] = $data['ntype'];
    }
    $res = select_limit_mongo('announcement', $condition, array(), $index, $nrecords);
    $res = add_id($res, "id");
    return array("success" => "true", "data" => $res, "error_code" => "100");

}

function delete_announcement($data)
{
    global $companyId;
    logger("3", $data, "", 5, "/delete_announcement");
    $check = check_key_available($data, array('id'));
    $usersIds = array();
    if ($check['success'] == 'true') {
        $user_id = explode("|", $data['id']);
        /*$idsToDelete = array();
        foreach($user_id as $res)
        {
            $idsToDelete[] = new MongoId($res);
        }*/
        $announcementInfo = get_announcement_by_id(array('id' => $user_id[0]));
        if ($announcementInfo['data'][0]) {

            $usersId = $announcementInfo['data'][0]['usersId'];
            $usersIds = explode("|", $usersId);
            $to_remove = array($data['userId']);
            $result = array_diff($usersIds, $to_remove);
            $updateInfo = manage_announcement(array('id' => $user_id[0], 'usersId' => implode("|", $result)));
            if (isset($announcementInfo['data'][0]['type']) && $announcementInfo['data'][0]['type'] == 'push') {
                $deletNotificationData = delete_notification_by_id(array('anouid' => $user_id[0], 'userId' => $data['userId']));
                $notifyData = insert_notification(array('customerId' => $companyId, 'mid' => '37', 'smid' => '1', 'userId' => $data['userId'], 'itemId' => $user_id[0], 'eid' => "150", 'extra' => json_encode($data)));
            }

            return array('data' => $user_id[0], 'error_code' => '100', 'success' => 'true');


        } else {
            return array('data' => $data, 'error_code' => '100', 'success' => 'false');
        }

        /*$delete=delete_mongo('announcement',array("_id"=>array('$in'=>$idsToDelete)));
        if($delete['n']=='0')
        {

            return array('data'=>$data,'error_code'=>'100','success'=>'false');
        }
        else
        {
            $deletNotificationData=delete_notification_by_id(array('anouid'=>$data['id']));
            return array('data'=>implode(",",$idsToDelete),'error_code'=>'100','success'=>'true');
        }*/
    } else {
        return $check;
    }
}


function delete_notification_by_id($data)
{

    logger("3", $data, "", 5, "/delete_notification_by_id");
    $check = check_key_available($data, array('anouid'));
    if ($check['success'] == 'true') {
        $condition = array();
        if (isset($data['ids'])) {
            $user_id = explode("|", $data['ids']);
            $idsToDelete = array();
            foreach ($user_id as $res) {
                $idsToDelete[] = new MongoId($res);
            }
            $condition['_id'] = array('$in' => $idsToDelete);
        }
        if (isset($data['anouid']) && $data['anouid'] != "") {
            $condition['anouid'] = $data['anouid'];

        }
        if (isset($data['userId'])) {
            $condition['userId'] = $data['userId'];

        }

        $delete = delete_mongo('notification', $condition);
        if ($delete['n'] == '0') {

            return array('data' => $data, 'error_code' => '100', 'success' => 'false');

        } else {
            return array('data' => implode(",", $data['anouid']), 'error_code' => '100', 'success' => 'true');
        }
    } else {
        return $check;
    }
}


function get_current_action_data($data)
{
    logger("3", $data, "", 5, "/get_current_action_data");
    $condition = array();
    $index = 0;
    $nrecords = 10;
    if (isset($data['index'])) {
        $index = $data['index'];
    }
    if (isset($data['nrecords'])) {
        $nrecords = $data['nrecords'];
    }
    if (isset($data['id'])) {
        $condition['_id'] = new MongoId($data['id']);
    }
    if (isset($data['user_id'])) {
        $condition['user_id'] = array('$in' => explode("|", $data['user_id']));
    }
    if (isset($data['ntype'])) {
        $condition['type'] = $data['ntype'];
    }
    $res = select_limit_mongo('currentAction', $condition, array(), $index, $nrecords);
    $res = add_id($res, "id");
    if (isset($res[0])) {
        $alldata = array();
        foreach ($res as $ret) {
            array_push($alldata, $ret);
        }
        return array('data' => $alldata, 'error_code' => '100', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '100', 'success' => 'false');
    }


}

function manage_time_triggers_data($data)
{
    logger("3", $data, "", 5, "/manage_time_triggers_data");
    $data['lastUpdate'] = new MongoDate();
    $check = check_key_available($data, array('cronId', 'id', 'fileName'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {
            unset($data['id']);
            $manage = insert_time_triggers_data($data);
        } else {
            $manage = update_time_triggers_data($data);
        }
        return $manage;
    } else {
        return $check;
    }

}

function insert_time_triggers_data($data)
{
    logger("3", $data, "", 5, "/insert_time_triggers_data");
    $data['_id'] = new MongoId();
    $success = insert_mongo('timeTrigger', $data);
    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};

        return array('data' => $id, 'error_code' => '3300', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3301', 'success' => 'false');
    }
}

function update_time_triggers_data($data)
{
    logger("3", $data, "", 5, "/update_time_triggers_data");
    $id = $data['id'];
    unset($data['id']);
    $success = update_mongo('timeTrigger', $data, array('_id' => new MongoId($id)));
    if ($success['n'] == '1') {

        return array('data' => $id, 'error_code' => '3320', 'success' => 'true');
    } else {
        return array('data' => $id, 'error_code' => '3321', 'success' => 'false');
    }
}

function get_all_time_triggers_data($data)
{
    logger("3", $data, "", 5, "/get_all_time_triggers_data");
    $where = array();
    if (isset($data['cronId'])) {
        $cronId = explode("|", $data['cronId']);
        $where['cronId'] = array('$in' => $cronId);

    }
    if (isset($data['id'])) {
        $where['_id'] = new MongoId($data['id']);
    }
    $tmp = select_mongo('timeTrigger', $where);
    $return = add_id($tmp, "id");
    if ($return[0]) {
        $alldata = array();
        foreach ($return as $ret) {

            array_push($alldata, $ret);

        }
        return array('data' => $alldata, 'error_code' => '3302', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3303', 'success' => 'false');
    }

}

function manage_cron_error_logs($data)
{
    logger("3", $data, "", 5, "/manage_cron_error_logs");
    $data['lastUpdate'] = new MongoDate();
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {
            unset($data['id']);
            $manage = insert_cron_error_logs($data);
        } else {
            $manage = update_cron_error_logs($data);
        }
        return $manage;
    } else {
        return $check;
    }

}

function insert_cron_error_logs($data)
{
    logger("3", $data, "", 5, "/insert_cron_error_logs");
    $data['_id'] = new MongoId();
    $success = insert_mongo('cronErrorLogs', $data);
    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};

        return array('data' => $id, 'error_code' => '3304', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3305', 'success' => 'false');
    }
}

function get_cron_error_logs($data)
{
    logger("3", $data, "", 5, "/get_cron_error_logs");
    $where = array();
    if (isset($data['cronId'])) {
        $cronId = explode("|", $data['cronId']);
        $where['cronId'] = array('$in' => $cronId);

    }
    $tmp = select_mongo('cronErrorLogs', $where);
    $return = add_id($tmp, "id");
    if ($return[0]) {
        $alldata = array();
        foreach ($return as $ret) {

            array_push($alldata, $ret);

        }
        return array('data' => $alldata, 'error_code' => '3306', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3307', 'success' => 'false');
    }

}

function manage_cron_status($data)
{
    logger("3", $data, "", 5, "/manage_cron_status");
    $data['lastUpdate'] = new MongoDate();
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {
            unset($data['id']);
            $manage = insert_cron_status($data);
        } else {
            $manage = update_cron_status($data);
        }
        return $manage;
    } else {
        return $check;
    }

}

function insert_cron_status($data)
{
    logger("3", $data, "", 5, "/insert_cron_status");
    $data['_id'] = new MongoId();
    $success = insert_mongo('cronStatus', $data);
    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};

        return array('data' => $id, 'error_code' => '3308', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3309', 'success' => 'false');
    }
}

function update_cron_status($data)
{
    logger("3", $data, "", 5, "/update_cron_status");
    if (isset($data['id']) && $data['id'] != "") {
        $id = $data['id'];
        unset($data['id']);
        $success = update_mongo('cronStatus', $data, array('_id' => new MongoId($id)));

    } else {
        $condition = array();
        if (isset($data['cronId']) && $data['cronId'] != "") {
            $condition['cronId'] = $data['cronId'];

        }
        if (isset($data['status']) && $data['status'] != "") {

            $condition['status'] = $data['status'];
        }

        $success = update_multiple_fields_mongo('cronStatus', array('status' => 'stop'), $condition);
    }
    if ($success['n'] == '1') {

        return array('data' => "", 'error_code' => '3310', 'success' => 'true');
    } else {
        return array('data' => "", 'error_code' => '3311', 'success' => 'false');
    }
}

function get_previous_cron_status($data)
{
    logger("3", $data, "", 5, "/get_previous_cron_status");
    $where = array();
    if (isset($data['cronId'])) {
        $cronId = explode("|", $data['cronId']);
        $where['cronId'] = array('$in' => $cronId);

        if (isset($data['status'])) {
            $where['status'] = $data['status'];

        }
        $tmp = select_sort_limit_mongo('cronStatus', $where, array(), array('lastUpdate' => -1), 0, 1);

    } else {
        $tmp = select_mongo('cronStatus', $where);
    }

    $return = add_id($tmp, "id");
    if ($return[0]) {
        $alldata = array();
        foreach ($return as $ret) {

            array_push($alldata, $ret);

        }
        return array('data' => $alldata, 'error_code' => '3312', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3313', 'success' => 'false');
    }
}

function manage_cron($data)
{
    logger("3", $data, "", 5, "/manage_cron");
    $data['lastUpdate'] = new MongoDate();
    $check = check_key_available($data, array('id', 'name'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {
            unset($data['id']);
            $manage = insert_cron($data);
        } else {
            $manage = update_cron($data);
        }
        return $manage;
    } else {
        return $check;
    }

}

function insert_cron($data)
{
    logger("3", $data, "", 5, "/insert_cron");
    $data['_id'] = new MongoId();
    $success = insert_mongo('cron', $data);
    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};

        return array('data' => $id, 'error_code' => '3314', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3315', 'success' => 'false');
    }
}

function update_cron($data)
{
    logger("3", $data, "", 5, "/update_cron");
    $id = $data['id'];
    unset($data['id']);
    $success = update_mongo('cron', $data, array('_id' => new MongoId($id)));
    if ($success['n'] == '1') {

        return array('data' => $id, 'error_code' => '3316', 'success' => 'true');
    } else {
        return array('data' => $id, 'error_code' => '3317', 'success' => 'false');
    }
}

function get_crons($data)
{
    logger("3", $data, "", 5, "/get_crons");
    $where = array();
    if (isset($data['cronId'])) {
        $where['cronId'] = $data['cronId'];

    }
    $tmp = select_mongo('cron', $where);
    $return = add_id($tmp, "id");
    if ($return[0]) {
        $alldata = array();
        foreach ($return as $ret) {

            array_push($alldata, $ret);

        }
        return array('data' => $alldata, 'error_code' => '3318', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3319', 'success' => 'false');
    }
}


function delete_time_trigger($data)
{
    logger("3", $data, "", 5, "/delete_time_trigger");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $condition = array();
        $user_id = explode("|", $data['id']);
        $idsToDelete = array();
        foreach ($user_id as $res) {
            $idsToDelete[] = new MongoId($res);
        }
        $condition['_id'] = array('$in' => $idsToDelete);

        $delete = delete_mongo('timeTrigger', $condition);
        if ($delete['n'] == '0') {

            return array('data' => $data, 'error_code' => '3323', 'success' => 'false');

        } else {
            return array('data' => $data['id'], 'error_code' => '3324', 'success' => 'true');
        }
    } else {
        return $check;
    }
}


function get_cron_status_data($data)
{
    logger("3", $data, "", 5, "/get_cron_status_data");
    $condition = array();
    if (isset($data['starttime']) && isset($data['endtime'])) {
        $dt = $data['starttime'] . " 00:00";
        $start = new MongoDate(strtotime($dt));
        $dt1 = $data['endtime'] . " 23:00";
        $end = new MongoDate(strtotime($dt1));
        $condition['lastUpdate'] = array('$gte' => $start, '$lte' => $end);

    }

    $tmp = select_mongo('cronStatus', $condition);
    $return = add_id($tmp, "id");
    if ($return[0]) {
        $alldata = array();
        foreach ($return as $ret) {

            array_push($alldata, $ret);

        }
        return array('data' => $alldata, 'error_code' => '3312', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3313', 'success' => 'false');
    }
}

function manage_notification_events($data)
{
    logger("3", $data, "", 5, "/manage_notification_events");
    $data['lastUpdate'] = new MongoDate();
    $check = check_key_available($data, array('id', 'eid','name','mid','status'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {
            unset($data['id']);
            $manage = insert_notification_events($data);
        } else {
            $manage = update_notification_events($data);
        }
        return $manage;
    } else {
        return $check;
    }

}

function insert_notification_events($data)
{
    $data['_id'] = new MongoId();
    $success = insert_mongo('events', $data);
    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};

        return array('data' => $id, 'error_code' => '3320', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '3321', 'success' => 'false');
    }
}

function update_notification_events($data)
{
    $id = $data['id'];
    unset($data['id']);
    $success = update_mongo('events', $data, array('_id' => new MongoId($id)));
    if ($success['n'] == '1') {

        return array('data' => $id, 'error_code' => '3322', 'success' => 'true');
    } else {
        return array('data' => $id, 'error_code' => '3323', 'success' => 'false');
    }
}


?>
