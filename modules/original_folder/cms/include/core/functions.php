<?php

function manage_cms($data) {
    logger("29", $data, "", 5, "/manage_cms");
    $check = check_key_available($data, array('id', 'slug', 'title', 'description'));
    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_cms($data);
                break;

            default:
                $manage = update_cms($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_cms($data) {
    logger("29", $data, "", 5, "/add_cms");
    $r = count_mongo('cms', array("slug" => $data['slug']));
    // print_r($r); die;
    if ($r == 0) {
        $data['createDate'] = new MongoDate();
        $data['status'] = "0";
        unset($data['id']);

        $res = insert_mongo('cms', $data);
        if ($res['n'] == 1) {
            return array("success" => "false", "data" => $data, "error_code" => "29002");
        } else {
            $ins_id = db_id($data);
            return array("success" => "true", "data" => $ins_id, "error_code" => "29008");
        }
    } else {
        return array("success" => "false", "data" => $data, "error_code" => "29001");
    }
}

function update_cms($data) {
    logger("29", $data, "", 5, "/update_cms");
    $id = $data['id'];
    unset($data['id']);
    $res = update_mongo('cms', $data, array('_id' => new MongoId($id)));
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "29003");
    } else {
        return array("success" => "true", "data" => $data, "error_code" => "29009");
    }
}

function get_cms_by_id($data) {
    logger("29", $data, "", 5, "/get_cms_by_id");
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
        if (isset($data['smid'])) {
            $arr = array('smid' => $data['smid']);
        }
        //$arr=array("slug"=>$data['slug']);
        $res = select_mongo('cms', $arr, array());
        $res = add_id($res, "id");
        //print_r($res);
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function get_cms_by_slug($data) {
    logger("29", $data, "", 5, "/get_cms_by_slug");
    $check = check_key_available($data, array('slug'));
    if ($check['success'] == 'true') {
        $arr = array();
        // if($data['id']!=0)
        // {
        //     $id = explode("|",$data['id']);
        //     foreach ($id as $key => $val) {
        //         $id[$key] = new MongoId($val);
        //     }
        //     $arr=array('_id'=>array('$in'=> $id));
        // }
        $arr = array("slug" => $data['slug']);
        $res = select_mongo('cms', $arr, array());
        $res = add_id($res, "id");
        //print_r($res);
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function delete_cms($data) {
    logger("29", $data, "", 5, "/delete_cms");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition = array('_id' => array('$in' => $id));

        $res = delete_mongo('cms', $condition);
        $res = add_id($res, "id");
        if ($res['1'] == sizeof($id)) {
            return array("success" => "true", "data" => $data, "error_code" => "29003");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "29004");
        }
    } else {
        return $check;
    }
}

/* * **********Breaking news functions************************ */

function manage_bn($data) {
    logger("29", $data, "", 5, "/manage_bn");
    $check = check_key_available($data, array('id', 'articleId'));
    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_bn($data);
                break;

            default:
                $manage = update_bn($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_bn($data) {
    unset($data['id']);
    $articleIds = explode("|", $data['articleId']);
    foreach ($articleIds as $value) {
        $data1 = array();
        $data1['createDate'] = new MongoDate();
        $data1['expiryDate'] = new MongoDate();
        $data1['status'] = "0";
        $data1['articleId'] = $value;
        $res = insert_mongo('breakingNews', $data1);
    }

    if ($res['n'] == 1) {
        return array("success" => "false", "data" => $data, "error_code" => "29002");
    } else {
        $ins_id = db_id($data);
        return array("success" => "true", "data" => $ins_id, "error_code" => "29008");
    }
}

function update_bn($data) {
    logger("29", $data, "", 5, "/update_bn");
    $id = $data['id'];
    $data['createDate'] = new MongoDate();
    $data['expiryDate'] = new MongoDate(strtotime($data['expiryDate']));
    unset($data['id']);
    $res = update_mongo('breakingNews', $data, array('_id' => new MongoId($id)));
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "29003");
    } else {
        return array("success" => "true", "data" => $data, "error_code" => "29009");
    }
}

function get_bn_by_id($data) {
    logger("29", $data, "", 5, "/get_bn_by_id");
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

        $res = select_mongo('breakingNews', $arr, array(), array('createDate' => -1));
        $res = add_id($res, "id");

        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function delete_bn($data) {
    logger("29", $data, "", 5, "/delete_bn");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition = array('_id' => array('$in' => $id));

        $res = delete_mongo('breakingNews', $condition);
        $res = add_id($res, "id");
        if ($res['1'] == sizeof($id)) {
            return array("success" => "true", "data" => $data, "error_code" => "29003");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "29004");
        }
    } else {
        return $check;
    }
}

/* * **********Breaking news functions************************ */

/* * **********Press functions************************ */

function manage_press($data) {
    logger("29", $data, "", 5, "/manage_press");
    $check = check_key_available($data, array('id', 'title', 'description'));
    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_press($data);
                break;

            default:
                $manage = update_press($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_press($data) {
    logger("29", $data, "", 5, "/add_press");
    $data['createDate'] = new MongoDate();
    $data['updateDate'] = new MongoDate();
    $data['status'] = "0";
    unset($data['id']);

    $res = insert_mongo('press', $data);
    if ($res['n'] == 1) {
        return array("success" => "false", "data" => $data, "error_code" => "29002");
    } else {
        $ins_id = db_id($data);
        return array("success" => "true", "data" => $ins_id, "error_code" => "29008");
    }
}

function update_press($data) {
    logger("29", $data, "", 5, "/update_press");
    $id = $data['id'];
    $data['updateDate'] = new MongoDate();
    unset($data['id']);
    $res = update_mongo('press', $data, array('_id' => new MongoId($id)));
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "29003");
    } else {
        return array("success" => "true", "data" => $data, "error_code" => "29009");
    }
}

function get_press_by_id($data) {
    logger("29", $data, "", 5, "/get_press_by_id");
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
        if (isset($data['smid'])) {
            $arr = array('smid' => $data['smid']);
        }

        $res = select_sort_mongo('press', $arr, array(), array('updateDate' => -1));
        $res = add_id($res, "id");
        if (isset($data['amid']) && isset($data['asmid'])) {
            foreach ($res as $key => $val) {
                $association_data = get_association_data("29", $data['amid'], $data['asmid'], $val['id']);
                $res[$key]['association_data'] = $association_data;
            }
        }
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function delete_press($data) {
    logger("29", $data, "", 5, "/delete_press");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition = array('_id' => array('$in' => $id));

        $res = delete_mongo('press', $condition);
        $res = add_id($res, "id");
        if ($res['1'] == sizeof($id)) {
            return array("success" => "true", "data" => $data, "error_code" => "29003");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "29004");
        }
    } else {
        return $check;
    }
}

/* * **********Press functions************************ */

function add_pg($pg_heading, $pg_url, $pg_content, $pg_un_name) {

    global $db;
    $arr = array(
        'pg_heading' => "$pg_heading",
        'pg_url' => "$pg_url",
        'pg_content' => "$pg_content",
        'pg_un_name' => "$pg_un_name",
        'status' => "1",
        '_id' => new MongoId()
    );
    $res = $db->cms->insert($arr);
    return $arr['_id'];
}

function update_pg($id, $pg_heading, $pg_url, $pg_content, $pg_un_name) {
    global $db;
    $check = $db->cms->update(array('_id' => new MongoId($id)), array('$set' => array("pg_heading" => "$pg_heading", "pg_url" => "$pg_url", "pg_content" => "$pg_content", "pg_un_name" => "$pg_un_name")));
    if ($check) {
        return array("success" => "true");
    } else {
        return array("success" => "false");
    }
}

function pg_status($id, $status) {
    global $db;
    return $check = $db->cms->update(array('_id' => new MongoId($id)), array('$set' => array("status" => "$status")));
    /* if($check){ 
      return array("success"=>"true");
      }else{
      return array("success"=>"false");
      } */
}

function pg_listing() {

    global $db;
    $tmp = $db->cms->find();
    return $tmp;
}

function pg_data($id) {

    global $db;
    $tmp = $db->cms->find(array('_id' => new MongoId($id)));
    return $tmp;
}

function pg_delete_cms($id) {
    global $db;
    $check = $db->cms->remove(array('_id' => new MongoId($id)));
    if ($check) {
        return array("success" => "true");
    } else {
        return array("success" => "false");
    }
}

/* * **********TEam functions************************ */

function manage_team($data) {
    logger("29", $data, "", 5, "/manage_team");
    $check = check_key_available($data, array('id', 'name', 'description', 'designation'));
    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_team($data);
                break;

            default:
                $manage = update_team($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_team($data) {
    logger("29", $data, "", 5, "/add_team");
    $data['createDate'] = new MongoDate();
    $data['updateDate'] = new MongoDate();
    $data['status'] = "0";
    unset($data['id']);

    $res = insert_mongo('team', $data);
    if ($res['n'] == 1) {
        return array("success" => "false", "data" => $data, "error_code" => "29002");
    } else {
        $ins_id = db_id($data);
        return array("success" => "true", "data" => $ins_id, "error_code" => "29008");
    }
}

function update_team($data) {
    logger("29", $data, "", 5, "/update_team");
    $id = $data['id'];
    $data['updateDate'] = new MongoDate();
    unset($data['id']);
    $res = update_mongo('team', $data, array('_id' => new MongoId($id)));
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "29003");
    } else {
        return array("success" => "true", "data" => $data, "error_code" => "29009");
    }
}

function get_team_by_id($data) {
    logger("29", $data, "", 5, "/get_team_by_id");
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


        $res = select_mongo('team', $arr, array());
        $res = add_id($res, "id");
        if (isset($data['amid']) && isset($data['asmid'])) {
            foreach ($res as $key => $val) {
                $association_data = get_association_data("29", $data['amid'], $data['asmid'], $val['id']);
                $res[$key]['association_data'] = $association_data;
            }
        }
        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

function delete_team($data) {
    logger("29", $data, "", 5, "/delete_team");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition = array('_id' => array('$in' => $id));

        $res = delete_mongo('team', $condition);
        $res = add_id($res, "id");
        if ($res['1'] == sizeof($id)) {
            return array("success" => "true", "data" => $data, "error_code" => "29003");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "29004");
        }
    } else {
        return $check;
    }
}

/* * **********RPA functions************************ */
/* * **********RPA functions************************ */
function get_data_by_table($data) {
    $check = check_key_available($data, array("table"));
    if ($check['success'] == "true") {
        $table = $data['table'];
        $condition = array();
        $license = array();
        $check_attanders_status = "0";
        $attanders_info = array();
        if ($table == "robotrunstatus") {
            $userInfo = get_resource_by_id(array('email' => $data['ip']));
            if ($userInfo['success'] == 'true' && !empty($userInfo['data'][0])) {
                if (isset($data['login_token'])) {
                    if ($data['login_token'] != $userInfo['data'][0]['login_token']) {
                        return array("success" => "false", "data" => array(), "error_code" => "400");
                    }
                }
                $userid = $userInfo['data'][0]['id'];
                /* Check Robot Attendars */
                $check_attanders_info = check_robot_attendars($userid);
                $check_attanders_status = $check_attanders_info['status'];
                $attanders_info = $check_attanders_info['data'];
                if (!empty($userInfo['data'][0]['type']) && $userInfo['data'][0]['type'] != 'attender') {
                    $tmp = select_mongo('company_licenses', array('userId' => $userid));
                    $return = add_id($tmp);
                    if (isset($return[0]) && $return[0]['active_status'] == '1' && $return[0]['assign_status'] == '1') {
                        $data['check_license'] = 'true';
                        $license = $return[0];
                    } else {
                        return array("success" => "false", "data" => array(), "error_code" => "101");
                    }
                }
            } else {
                return array("success" => "false", "data" => array(), "error_code" => "400");
            }
            $condition = array("status" => "0", 'ip' => $data['ip']);
        }
        if (isset($data['id'])) {
            $condition['_id'] = new MongoId($data['id']);
        }
        if (isset($data['status'])) {
            $condition['status'] = $data['status'];
        }
        $fields = array();
        $res = select_mongo($table, $condition, $fields);
        $res = add_id($res, "id");
        $allData = array();
        if (sizeof($res) > 0) {
            foreach ($res as $ret) {
                if (isset($data['check_license'])) {
                    if (isset($license['licenses_no'])) {
                        $ret['licenses_no'] = $license['licenses_no'];
                    }
                    if (isset($license['id'])) {
                        $ret['licenses_id'] = $license['id'];
                    }
                }
                array_push($allData, $ret);
            }
            if (!empty($userInfo['data'][0]['type']) && $userInfo['data'][0]['type'] == 'attender') {
                return array("success" => "true", "data" => $allData, "error_code" => "101");
            } else {
                return array("success" => "true", "data" => $allData, "error_code" => "100");
            }
        } else {
            if ($check_attanders_status == "1") {
                unset($attanders_info['id']);
                return array("success" => "true", "data" => $attanders_info, "error_code" => "200");
            } else {
                if (!empty($userInfo['data'][0]['type']) && $userInfo['data'][0]['type'] == 'attender') {
                    return array("success" => "false", "data" => $allData, "error_code" => "101");
                } else {
                    return array("success" => "false", "data" => $allData, "error_code" => "100");
                }
            }
        }
    } else {
        return $check;
    }
}

/*
 * Get Robot Attendars details
 */
function check_robot_attendars($userid) {
    $status = "0";
    $condition = array('status' => 'open');
    $res_status = select_mongo("robotMachineStatus", $condition, array());
    $res_status = add_id($res_status, "id");
    $return_result = array();
    if(!empty($res_status)) {
	$return_result = $res_status[0];
        $robot_ids = array();
        foreach($res_status as $val) {
            $robot_ids[] = new MongoId($val['robot_id']);
        }
        //Check User Attendar in robotList Tbl
        $conds = array('_id' => array('$in' => $robot_ids));
        $conds['attanders'] = array('$in' => array($userid));
        $res = select_mongo("robotlist", $conds, array('title'));
        $res = add_id($res, "id");
        if(!empty($res)) {
           $status = "1"; 
        }
    }
    return array('status' => $status, 'data' => $return_result);
}

/**
 * 
 * To Update Status & details of popup User
 * @param MongoId $data
 * @return array of data
 */
function run_popup_user($data) {
    $check = check_key_available($data, array("status", "machine", "run_by", "error", "robot_id"));
    if ($check['success'] == "true") {
        $condition = array();
        $condition['robot_id'] = $data['robot_id'];
        $condition['machine'] = $data['machine'];
        $res_status = select_mongo("robotMachineStatus", $condition, array());
        $res_status = add_id($res_status, "id");
        $res_status = !empty($res_status[0]) ? $res_status[0] : array();
        if($data['status'] == 'open') {
            if(!empty($res_status)) {
                $res_update = update_mongo('robotMachineStatus', $data, array('_id' => new MongoId($res_status['id'])));
                return array("success" => "true", "data" => $data, "error_code" => "100");
            } else {
                $data['_id'] = new MongoId();
                $res = insert_mongo('robotMachineStatus', $data);
                if ($res['n'] == 1) {
                    return array("success" => "false", "data" => array(), "error_code" => "470100");
                } else {
                    unset($data['_id']);
                    return array("success" => "true", "data" => $data, "error_code" => "100");
                }
            }
        } else if($data['status'] == 'waiting') {
            if($res_status['status'] == 'open') {
                $res_status['status'] = 'waiting';
            }
            unset($res_status['id']);
            return array("success" => "true", "data" => $res_status, "error_code" => "100");
        } else if($data['status'] == 'close') {
            $res_update = update_mongo('robotMachineStatus', $data, array('robot_id' => $data['robot_id'], 'machine' => $data['machine']));
            $res_status['status'] = 'close';
            unset($data['id']);
            return array("success" => "true", "data" => $data, "error_code" => "100");
        } else {
            return array("success" => "false", "data" => "Not a valid status", "error_code" => "470100");
        }
    } else {
        return $check;
    }
}

function run_robot($data) {
    $check = check_key_available($data, array("id"));
    if ($check['success'] == "true") {
        $condition = array('_id' => new MongoId($data['id']));
        $fields = array();
        $res = select_mongo("robotlist", $condition, $fields);
        $res = add_id($res, "id");
        if (sizeof($res) > 0) {
            return array("success" => "true", "data" => $res, "error_code" => "100");
        }
    } else {
        return $check;
    }
}

function getUserTaskList($data) {

    $check = check_key_available($data, array("userId"));
    if ($check['success'] == "true") {
        $createdBy = $data['userId'];
        $res = select_sort_mongo('robotlistAssociate', array('userId' => $createdBy), array('asid', 'name'), array('_id' => -1));
        $res = add_id($res, "id");
        if (sizeof($res) > 0) {
            return array("success" => "true", "data" => $res, "error_code" => "200");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "502");
        }
    } else {
        return $check;
    }
}

function getTaskListData($data) {

    $check = check_key_available($data, array("id"));
    if ($check['success'] == "true") {
        $id = $data['id'];
        $res = select_mongo('robotlist', array('_id' => new MongoId($id)));
        $res = add_id($res, "id");
        if (sizeof($res) > 0) {
            return array("success" => "true", "data" => $res, "error_code" => "200");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "502");
        }
    } else {
        return $check;
    }
}

function stop_robot($data) {
    $check = check_key_available($data, array("id"));

    if ($check['success'] == "true") {
        $id = $data['id'];
        unset($data['id']);
        $res = update_mongo('robotlistAssociate', $data, array('asid' => $id));
        if ($res['n'] == 0) {
            return array("success" => "false", "data" => $data, "error_code" => "502");
        } else {
            $query = array();
            $data['stopDate'] = new MongoDate();
            $query['asid'] = $id;
            $query['stopDate'] = null;
            $resp = update_mongo('robotrunstatus', $data, $query);
            return array("success" => "true", "data" => $data, "error_code" => "200");
        }
    } else {
        return $check;
    }
}

function getrobotdata($data) {
    $login_user_id=$data['userId'];
    global $db;
    $index = "";
    $nor = "";
    $indexing = "";
    $orderbyval = 1;
    $orderby = array();
    $query = array();
    $searchType = array();
    if (isset($data['demanderid'])) {
        $query['demanderId'] = $data['demanderid'];
    }
    if (isset($data['userId'])) {
        $query['userId'] = $data['userId'];
    }
    if (isset($data['assignto'])) {
        $query['assignto']['$in'] = $data['assignto'];
    }
    $fields = array();
    if (isset($data['offset'])) {
        $data['index'] = $data['offset'];
        unset($data['offset']);
    }
    if (isset($data['limit'])) {
        $data['nor'] = $data['limit'];
        unset($data['limit']);
    }
    if (isset($data['fields'])) {
        $fields = explode(",", $data['fields']);
    }

    if (isset($data['order_by']) && isset($data['order_column'])) {
        if (isset($data['order_by'])) {
            if ($data['order_by'] == 'desc') {
                $orderbyval = -1;
            }
        }
        $columnName = preg_replace('/\s+/', '', $data['order_column']);
        $orderby = array($columnName => $orderbyval);
    }
    if (isset($data['index']) && isset($data['nor'])) {
        $index = $data['index'];
        $indexing = 1;
        $nor = $data['nor'];
        unset($data['index']);
        unset($data['nor']);
    }

    if (isset($data['search']) && $data['search'] != "") {
        $searchstring = $data['search'];
        foreach ($data['search_on_like'] as $fieldName) {
            $query['$or'][] = array($fieldName => new MongoRegex("/^$searchstring/i"));
        }
    }
    if (isset($data['query_str']) && ($data['query_str'] != '')) {
        $cond_qyery = json_decode($data['query_str'], true);
        foreach ($cond_qyery as $ck => $cv) {
            foreach ($cv['examStartDate'] as $keys => $dvalue) {
                if ($key == $eq) {
                    unset($cv['examStartDate']['$eq']);
                    $cv['examStartDate']['$gte'] = new MongoDate(strtotime($dvalue . "00:00:00"));
                    $cv['examStartDate']['$lte'] = new MongoDate(strtotime($dvalue . "23:59:59"));
                } else {
                    $cv['examStartDate'][$keys] = new MongoDate(strtotime($dvalue));
                }
            }

            $query = array_merge($query, $cv);
        }
    }
    if (isset($data['query_str']['filter']) && ($data['query_str']['filter']=='top_used')) {
    $orderby = array("count" => -1);
    }
    else if (isset($data['query_str']['filter']) && ($data['query_str']['filter']=='recent_robot')) {
    $orderby = array("run_time" => -1);
    }
    else{
        $orderby = array("createDate" => -1);
    }
    if ($indexing != '' && $nor != '' && $data['search'] == "") {
        $res = select_sort_limit_mongo('robotlistAssociate', $query, $fields, $orderby, $index, $nor);
        $totalCount = count_mongo('robotlistAssociate', $query);
    } else {
        $res = select_sort_limit_mongo('robotlistAssociate', $query, $fields, $orderby, $index, $nor);
        $totalCount = count_mongo('robotlistAssociate', $query);
    }
    $associatedata = add_id($res, "id");
    foreach ($associatedata as $key => $record) {
        if (isset($record['status'])) {
            /* $color = "red";
              $data_status = 'inactive';
              if ($record['status'] == 1) {
              $data_status = 'active';
              $color = 'green';
              } else if ($record['status'] == 2) {
              $data_status = 'block';
              $color = 'yellow';
              } else if ($record['status'] == 3) {
              $data_status = 'lock';
              $color = 'blue';
              } */

            $color = "green";
            $data_status = 'inactive';
            if ($record['status'] == 1) {
                $data_status = 'active';
                $color = 'red';
            } else if ($record['status'] == 2) {
                $data_status = 'block';
                $color = 'yellow';
            } else if ($record['status'] == 3) {
                $data_status = 'lock';
                $color = 'blue';
            }


            $record['status'] = '<a onclick="update_run_status(this.id)" disabled data-status="' . $data_status . '" data-id="' . $record['asid'] . '" id="status-' . $record['asid'] . '" style="border-color: ' . $color . '; color: ' . $color . ';" class="btn btn-default btn-link" title="">
                               <i class="glyphicon glyphicon-off"></i>
                            </a>';
            $userId = $record['userId'];
            $record['machine'] = '';
            $result = select_mongo('robotlist',array('_id' => new MongoId($record['asid'])));
            $associatedata2 = add_id($result, "id");
            $userData = get_resource_by_id(array('id' => $userId, 'fields' => 'name,machine'));
            $userData1 = get_resource_by_id(array('id' => $associatedata2[0]['robot'][0][tasklist][0]['userId'], 'fields' => 'name,email,machine'));
            $login_user_data=get_resource_by_id(array('id' => $login_user_id, 'fields' => 'name,email,machine,type'));
            if (isset($userData['data'][0]) && !empty($userData['data'][0])) {
                $record['created_by'] = $userData1['data'][0]['name'];
                if($login_user_data['data'][0]['type']=='machine')
                {
                    $record['machine'] .= '<select id="machine_select">';
                    $record['machine'] .= '<option value="' . $login_user_data['data'][0]['email'] . '" id="' . $login_user_data['data'][0]['id'] . '">' . $login_user_data['data'][0]['name'] . '</option>';
                    $record['machine'] .= '</select>';
                }
                else
                {
                    /*Get Robot Last Machine Assignee*/
                    $resultRobotRunStatus = select_sort_limit_mongo('robotrunstatus', array('asid' => $record['asid']), array('machine_id'), array('_id' => -1), 0, 1);
                    $resultRobotRunStatus = add_id($resultRobotRunStatus, "id");
                    $selected_machine = !empty($resultRobotRunStatus[0]['machine_id']) ? $resultRobotRunStatus[0]['machine_id'] : 0;
                    if (isset($userData['data'][0]['machine']) && !empty($userData['data'][0]['machine'])) {
                        $record['machine'] .= '<select id="machine_select">';
                        foreach ($userData['data'][0]['machine'] as $machineId) {
                            $user_machine = get_resource_by_id(array('id' => $machineId, 'fields' => 'name,email'));
                            $machine_name = $user_machine['data'][0]['name'];
                            $machine_email = $user_machine['data'][0]['email'];
                            $machine_id = $user_machine['data'][0]['id'];
                            $selected = '';
                            if(!empty($selected_machine) && $selected_machine == $machineId) {
                                $selected = 'selected="selected"';
                            }
                            $record['machine'] .= '<option value="' . $machine_email . '" id="' . $machine_id . '" '.$selected.'>' . $machine_name . '</option>';
                        }
                        $record['machine'] .= '</select>';
                    } 
                    else 
                    {
                        $record['machine'] .= '<select id="machine_select">';
                        $record['machine'] .= '<option value="' . $userData1['data'][0]['email'] . '" id="' . $userData1['data'][0]['id'] . '">' . $userData1['data'][0]['name'] . '</option>';
                        $record['machine'] .= '</select>';
                    }
                }
            } else {
                
            }
            
        }
        $associatedata[$key] = $record;
    }
    $datafinal = array("data" => $associatedata, "total_count" => $totalCount);
    logger("47", $datafinal, "", KLogger::INFO, "success--error_code=>470099");
    return array("success" => "true", "data" => $datafinal, "error_code" => "470099");
}

function robot_analytic($data) {

    $condition = array();
    $fields = array();
    $res = select_mongo("robotlist", $condition, $fields);
    $res = add_id($res, "id");
    if (sizeof($res) > 0) {
        $res = array("name", "mark");
        array_push($res, array("monan", 34));
        /* foreach ($res as $key => $val)
          {
          $res =array("name","mark");
          $res[$key]['association_data'] = $association_data;
          } */
        return array("success" => "true", "data" => $res, "error_code" => "470099");
    }
    $res = array(array("name", "mark"));
    array_push($res, array("monan", 34));
    return array("success" => "true", "data" => $res, "error_code" => "470099");
}

function add_robot($data) {
    $sizeoftaskaction = sizeof($data['robot'][0]['tasklist'][0]['actionlist']);
    for ($i = 0; $i < $sizeoftaskaction; $i++) {
        $datalist = array();
        $datalist_new = "";
        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'fetch_ocr_data') {
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['variable_box']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['variable_box'])) {
                $m = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['variable_box'] as $val) {
                    $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['data_list']["[var]" . $val] = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['text_box'][$m];
                    $m++;
                }
            }
        }

        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'get') {
            $Params = array();
            $Params_new = "";
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['url_key']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['url_key'])) {
                $m = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['url_key'] as $val) {
                    if(!empty($val)){
                    $Params[$val] = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['url_value'][$m];
                    }
                    $m++;
                }
            }

            if (!empty($Params)) {
                $Params_new = $Params;
            }
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['Params'] = $Params_new;
        }

        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'post') {
            $Params = array();
            $Params_new = "";
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['url_key']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['url_key'])) {
                $m = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['url_key'] as $val) {
                    if (!empty($val)) {
                        $Params[$val] = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['url_value'][$m];
                    } 
                    $m++;
                }
            }
            if (!empty($Params)) {
                $Params_new = $Params;
            }
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['Params'] = $Params_new;
        }

        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'get') {
            $Headers = array();
            $Body = array();
            $Headers_new = "";
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['header_key']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['header_key'])) {
                $m = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['header_key'] as $val) {
                    if (!empty($val)) {
                    $Headers[$val] = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['header_value'][$m];
                    }
                    $m++;
                }
            }
            $Body[] = "";

            if (!empty($Headers)) {
                $Headers_new = $Headers;
            }

            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['Headers'] = $Headers_new;
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['Body'] = $Body;
        }

        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'post') {
            $Headers = array();
            $Headers_new = "";
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['header_key']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['header_key'])) {
                $m = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['header_key'] as $val) {
                    if (!empty($val)) {
                        $Headers[$val] = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['header_value'][$m];
                    } else {
                        $Headers = "";
                    }
                    $m++;
                }
            }

            if (!empty($Headers)) {
                $Headers_new = $Headers;
            }

            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['Headers'] = $Headers_new;
        }

        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'post') {
            $formdata = array();
            $formdata_new = "";
            if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['type'] == 'form-data' || $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['type'] == 'x-www-form-urlencoded') {
                unset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['rawtext']);
                unset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['raw']);
                if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['form_key']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['form_key'])) {
                    $m = 0;
                    foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['form_key'] as $val) {
                        if (!empty($val)) {
                            $formdata[$val] = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['form_value'][$m];
                        } else {
                            $formdata = "";
                        }
                        $m++;
                    }
                }
            } else {
                unset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['form_key']);
                unset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['form_value']);
                if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['rawtext']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['rawtext'])) {
                    $formdata = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['rawtext'];
                }
            }
            if (!empty($formdata)) {
                $formdata_new = $formdata;
            }
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['Body'] = $formdata_new;
        }

        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'type_on_image') {
            unset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['type_of_action']);
            $perform_actions = array();
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['clicktype']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['clicktype'])) {
                $m = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['clicktype'] as $val) {
                    $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['path'][$m], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['value'][$m], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['x_loc'][$m], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['y_loc'][$m]));
                    $m++;
                }
            }

            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['perform_actions'] = $perform_actions;
        }

        //keystroke handler json
        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'keystroke') {
            $perform_actions = array();
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action'])) {
                $m = 0;
                $t = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action'] as $val) {
                    if ($val == 'press') {

                        $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['value'][$m], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['count'][$t]));
                        $t++;
                    } else {
                        $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['value'][$m]));
                    }

                    $m++;
                }
            }
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['perform_actions'] = $perform_actions;
            //end of keystroke handler json
        }
        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'equation') {
            unset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['old_value']);
            unset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['variables']);
        }

//start of update data json
        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'update_data') {
            $perform_actions = array();
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action'])) {
                $cellname_count = 0;
                $set_range_count = 0;
                $variable_count = 0;
                $formula_count = 0;
                $rowname_count = 0;
                $columnname_count = 0;
                $from_count = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action'] as $val) {
                    if ($val == 'set_cell_value') {
                        $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['cellname'][$cellname_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['cellvalue'][$cellname_count]));
                        $cellname_count++;
                    }
                    if ($val == 'set_range') {
                        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['set_range'][$set_range_count] == "row") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['set_range'][$set_range_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['rowname'][$rowname_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['rowvalue'][$rowname_count]));
                            $rowname_count++;
                        } else if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['set_range'][$set_range_count] == "column") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['set_range'][$set_range_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['columnname'][$columnname_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['columnvalue'][$columnname_count]));
                            $columnname_count++;
                        } else if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['set_range'][$set_range_count] == "range") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['set_range'][$set_range_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['from'][$from_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['fromvalue'][$from_count]));
                            $from_count++;
                        }
                        $set_range_count++;
                    }
                    if ($val == 'append_range') {
                        $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['variable'][$variable_count]));
                        $variable_count++;
                    }
                    if ($val == 'apply_formula') {
                        $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['formula'][$formula_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['column_name'][$formula_count]));
                        $formula_count++;
                    }
                }
            }
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action_perform'] = $perform_actions;
        }
//end of update data json function
//start of Fetch data json function
        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'fetch_data') {
            $perform_actions = array();
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action'])) {
                $value_count = 0;
                $get_range_count = 0;
                $columnname_count = 0;
                $rowname_count = 0;
                $from_count = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action'] as $val) {
                    if ($val == 'get_cell_value') {
                        $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['value'][$value_count]));
                        $value_count++;
                    }
                    if ($val == 'get_range') {
                        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['get_range'][$get_range_count] == "row") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['get_range'][$get_range_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['rowname'][$rowname_count]));
                            $rowname_count++;
                        } else if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['get_range'][$get_range_count] == "column") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['columnname'][$columnname_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['columnvalue'][$columnname_count]));
                            $columnname_count++;
                        } else if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['get_range'][$get_range_count] == "range") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['get_range'][$get_range_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['from'][$from_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['to'][$from_count]));
                            $from_count++;
                        }
                        $get_range_count++;
                    }
                }
            }
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action_perform'] = $perform_actions;
        }
//end of Fetch data json function
//start of Delete data json function
        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'delete_data') {
            $perform_actions = array();
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action'])) {
                $value_count = 0;
                $delete_range_count = 0;
                $columnname_count = 0;
                $rowname_count = 0;
                $from_count = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action'] as $val) {
                    if ($val == 'delete_cell_value') {
                        $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['value'][$value_count]));
                        $value_count++;
                    }
                    if ($val == 'delete_range') {
                        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['delete_range'][$delete_range_count] == "row") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['delete_range'][$delete_range_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['rowname'][$rowname_count]));
                            $rowname_count++;
                        } else if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['delete_range'][$delete_range_count] == "column") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['columnname'][$columnname_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['columnvalue'][$columnname_count]));
                            $columnname_count++;
                        } else if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['delete_range'][$delete_range_count] == "range") {
                            $perform_actions[] = array($val => array($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['delete_range'][$delete_range_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['from'][$from_count], $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['to'][$from_count]));
                            $from_count++;
                        }
                        $delete_range_count++;
                    }
                }
            }
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['action_perform'] = $perform_actions;
        }
//end of Delete data json function
        //receive mail handler json
        if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['action'] == 'receive_mail') {

            $search_criteria = array();
            $intends_callback = array();
            $intends_callback_value = array();
            // search criteria
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['type']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['type'])) {
                $m = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['type'] as $val) {
                    $search_criteria[] = array($val => $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['from'][$m]);
                    $m++;
                }
                $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['search_criteria'] = $search_criteria;
            }
            // intend callback
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['intends_callback_key']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['intends_callback_key'])) {
                $m = 0;
                foreach ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['intends_callback_key'] as $val) {
                    if (!empty($val)) {
                        $intends_callback[] = array($val => $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['intends_callback_value'][$m]);
                    }
                    $m++;   
                }
                $n=0;
                foreach($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['intends_callback_value'] as $val){
                    if(!empty($val)){
                        $intends_callback_value[] = array($val=>$data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['intends_callback_value'][$n]); 
                    }
                    $n++;
                }
                $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['intends_callback'] = $intends_callback;
            }
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['check_attach'] = isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['check_attach']) ? 'true' : 'false';
            $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['check_callback'] = isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['check_callback']) ? 'true' : 'false';
            if(empty($intends_callback) || empty($intends_callback_value))
            {
              $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['check_callback']="false";
            }
            if (empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['intends']) || empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['download_attach'])) {
                $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['check_attach'] = "false";
            }
        }
        //end of receive mail handler json
    }
    $NestedNameArray = array("launch_app" => "launchapplication", "get_window_name" => "getwindowname", "minimize_window" => "minimizewindow", "move_window_left" => "movewindowleft", "move_window_right" => "movewindowright", "move_window_down" => "movewindowdown", "close_window" => "closewindow", "create_workbook" => "createworkbook", "create_worksheet" => "createworksheet", "save_workbook" => "saveworkbook", "set_row" => "setrow", "set_cell_value" => "setcellvalue", "set_column" => "setcolumn", "get_cell_value" => "getcellvalue", "get_row" => "getrow", "get_column" => "getcolumn", "set_range" => "setrange", "get_range" => "getrange", "draw_area_chart" => "drawareachart", "draw_area_chart_3d" => "drawareachart3d", "open_workbook" => "openworkbook", "wait" => "wait", "wait_for_image" => "waitforimage", "copy_from_variable" => "copyfromvariable", "paste_to_variable" => "pastetovariable", "open_terminal" => "openterminal", "execute_command" => "executecommand", "check_existence" => "checkexistence", "create_file" => "createfile", "write_to_file" => "writetofile", "copy_file" => "copyfile", "copy_folder" => "copyfolder", "open_file" => "openfile", "delete_contents" => "deletecontents", "delete_file" => "deletefile", "read_file" => "readfile", "stop" => "stop", "pause" => "pause", "click_position" => "clickposition", "double_click_position" => "doubleclickposition", "click_image" => "clickimage", "double_click_image" => "doubleclickimage", "drag_mouse" => "mousedrag", "mouse_scroll" => "mousescroll", "type_string" => "type", "press" => "press", "command" => "command", "type_on_click_image" => "typeonimageafterclick", "type_on_double_click_image" => "typeonimageafterdoubleclick", "keystroke" => "keystroke", "type_on_image" => "typeonimage", "if_else" => "ifelse", "while" => "while", "open_browser" => "openbrowser", "web_element" => "webelement", "close_browser" => "closebrowser", "+" => "sum", "-" => "subtract", "/" => "division", "*" => "multiplication", "++" => "increment", "--" => "decrement", "=" => "assign", "^" => "power", "read_text_from_image" => "readtextfromimage", "read_text_from_pdf" => "readtextfrompdf", "string_concatenate" => "textconcatinate", "string_length" => "textlength", "string_cases" => "convertcase", "string_split" => "textsplit", "string_slicing" => "textslice", "string_remove" => "textremove", "character_index" => "characterindex", "substring" => "substring", "string_replace" => "replacesubstringintext", "string_find" => "findtext", "string_trim" => "texttrim", "string_between" => "textbetweentext", "maximize_window" => "maximizewindow", "generate_dataset" => "generatedataset", "start_training" => "starttraining", "start_recognizing" => "startrecognizing", "window_operations" => "windowoperations", "file_actions" => "fileactions", "folder_actions" => "folderactions", "date_time" => "datetime", "update_variable" => "updatevariable", "equation" => "arithmeticequation", "dictionary_operations" => "dictionaryoperations", "table_operations" => "tableoperations", "excel_actions" => "excelactions", "update_data" => "updatedata", "fetch_data" => "fetchdata", "delete_data" => "deletedata", "click" => "click", "drag" => "Drag");
    $createdBy = "";
    if (isset($data['createdBy'])) {
        $createdBy = $data['createdBy'];
        unset($data['createdBy']);
    }
    if(!empty($data['parent_id']) && !empty($data['userId'])) {
        $createdBy = $data['userId'];
        unset($data['userId']);
    }
    for ($i = 0; $i < $sizeoftaskaction; $i++) {
        $template = "";
        $newtemplate = "";
        $template = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['template_name'];
        $newtemplate = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['new'];
        if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['template_name']) && !empty($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['template_name'] && $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['new'] == '1')) {
            $checkData = array('table' => 'ocrtemplate', 'field' => 'template_name', 'value' => $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['template_name'], 'field1' => 'userId', 'value1' => $createdBy, 'id' => $data['id']);
            $checkUnique = object_check_unique_field($checkData);
            if ($checkUnique['success'] == 'true') {
                $template = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['template_name'];
                $newtemplate = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['new'];
            } else {
                return $checkUnique;
            }
        }
    }
    if(isset($data['submit_type']) && $data['submit_type'] == "export")
    {
       return export_robot_data($data);   
    }
    if (isset($data['id']) && $data['id'] == "0") {
        $title = "";
        if (isset($data['title'])) {
            $title = $data['title'];
            //unset($data['title']);
        }
        if (isset($data['json'])) {
            $data['robot'] = json_decode($data['robot'], true);
            $data['variablelist'] = json_decode($data['variablelist'], true);
            $configure = select_mongo("configure", array(), array('action'));
            $configureArray = add_id($configure, "id");
            $counter = 1;
            foreach ($data['robot'][0]['tasklist'][0]['actionlist'] as $key => $nestablevalue) {
                $configureIndex = array_search($nestablevalue['action'], array_column($configureArray, 'action'));
                $configId = $configureArray[$configureIndex]['id'];
                $actionName = $nestablevalue['action'];
                $data['nestable_structure'][] = array("id" => $NestedNameArray[$actionName] . "-" . $configId . "-" . $counter);
                $counter++;
            }
            unset($data['json']);
            $data['nestable_structure'] = json_encode($data['nestable_structure']);
        }
        unset($data['id']);
        $data['_id'] = new MongoId();
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : "0";
        $map_id = !empty($data['map_id']) ? $data['map_id'] : "0";
        unset($data['map_id']);
        $res = insert_mongo('robotlist', $data);
        if ($res['n'] == 1) {
            return array("success" => "false", "data" => $data, "error_code" => "470100");
        } else {
            $ins_id = db_id($data);
            $robotno = rand(1, 10);
            $robotno = "robot" . $robotno;
            $ip_address = $_SERVER['HTTP_HOST'];
            $count = 0;
            $run_time =strtotime(date('Y-m-d h:i a'));
            $res = insert_mongo('robotlistAssociate', array("createDate" => new MongoDate(), "asid" => $ins_id, "status" => "1", "runtime" => $robotno, "path" => "c:/window/rpa", "host" => "localhost", "description" => "robot 1", "name" => $title, "template_name" => $template, "userId" => $createdBy, "ip_address" => $ip_address,'count'=>$count,'run_time'=>$run_time, 'parent_id' => $data['parent_id'], 'map_id' => $map_id));
            for ($i = 0; $i < $sizeoftaskaction; $i++) {
                if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['new'] == '1') {
                    $respp = insert_mongo('ocrtemplate', array("createDate" => new MongoDate(), "asid" => $ins_id, "template_name" => $template, "new" => $newtemplate, "userId" => $createdBy));
                }
            }
            return array("success" => "true", "data" => $ins_id, "error_code" => "470101");
        }
    } else {
        $title = "";
        if (isset($data['title'])) {
            $title = $data['title'];
            //unset($data['title']);
        }
        for ($i = 0; $i < $sizeoftaskaction; $i++) {
            if (isset($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['template_name'])) {
                $template = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['template_name'];
                $newtemplate = $data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['new'];
            }
        }
        if (isset($data['json'])) {
            $data['robot'] = json_decode($data['robot'], true);
            $data['variablelist'] = json_decode($data['variablelist'], true);
            $configure = select_mongo("configure", array(), array('action'));
            $configureArray = add_id($configure, "id");
            $counter = 1;
            foreach ($data['robot'][0]['tasklist'][0]['actionlist'] as $key => $nestablevalue) {
                $configureIndex = array_search($nestablevalue['action'], array_column($configureArray, 'action'));
                $configId = $configureArray[$configureIndex]['id'];
                $actionName = $nestablevalue['action'];
                $data['nestable_structure'][] = array("id" => $NestedNameArray[$actionName] . "-" . $configId . "-" . $counter);
                $counter++;
            }
            unset($data['json']);
            $data['nestable_structure'] = json_encode($data['nestable_structure']);
        }

        $id = $data['id'];
        $ins_id = $id;
        unset($data['id']);
        $res = update_mongo('robotlist', $data, array('_id' => new MongoId($id)));
        if ($res['n'] == 0) {
            return array("success" => "false", "data" => $data, "error_code" => "470201");
        } else {
            $resp = update_mongo('robotlistAssociate', array("name" => $title, "template_name" => $template), array('asid' => $id));
            for ($i = 0; $i < $sizeoftaskaction; $i++) {
                if ($data['robot'][0]['tasklist'][0]['actionlist'][$i]['data']['new'] == '1') {
                    $resppp = insert_mongo('ocrtemplate', array("createDate" => new MongoDate(), "asid" => $ins_id, "template_name" => $template, "new" => $newtemplate, "userId" => $createdBy));
                }
            }
            return array("success" => "true", "data" => $id, "error_code" => "470202");
        }
        //return array("success"=>"false","data"=>$data,"error_code"=>"470102");
    }
}

function update_robot($data) {
    $id = $data['id'];
    unset($data['id']);
    $res = update_mongo('robotlist', $data, array('_id' => new MongoId($id)));
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "470103");
    } else {
        return array("success" => "true", "data" => $data, "error_code" => "470104");
    }
}

function copy_data($data) {
    $id = $data['id'];
    unset($data['id']);
    $asid = $data['asid'];
    if (isset($data['userId']) && $data['userId'] != "") {
        $data['assignto'] = explode(",", $data['userId']);
    }
    unset($data['asid']);
    unset($data['userId']);
    $copydata = select_mongo("robotlistAssociate", array('_id' => new MongoId($id)));
    $copydataArray = add_id($copydata, "id");
    if(!empty($data)) {
        $res = update_mongo('robotlistAssociate', $data, array('_id' => new MongoId($id)));
        if ($res['n'] == 0) {
            return array("success" => "false", "data" => $data, "error_code" => "47010366");
        } else {
            if (isset($data['assignto']) && sizeof($data['assignto']) > 0) {
                if (sizeof($copydataArray) > 0) { 
                    $robotData = select_mongo("robotlist", array('_id' => new MongoId($copydataArray[0]['asid'])));
                    $robotData = add_id($robotData, "id");
                    $robotData = !empty($robotData[0]) ? $robotData[0] : array();
                    $resp_robotlist = update_mongo('robotlist', array('attanders' => $data['assignto']), array('_id' => new MongoId($asid)));
                    foreach ($data['assignto'] as $key => $value) {
                        if ($value != $copydataArray[0]['userId']) {
                            $count_copydata = count_mongo("robotlistAssociate", array('map_id' => $id, 'userId' => $value));
                            if ($count_copydata == 0) {
                                $robotData['parent_id'] = $copydataArray[0]['asid'];
                                $robotData['id'] = 0;
                                $robotData['map_id'] = $id;
                                unset($robotData['attanders']);
                                $robotData['userId'] = $value;
                                add_robot($robotData);
                            }
                        }
                    }
                }
                $temp_assigned_users = !empty($copydataArray[0]['assignto']) ? $copydataArray[0]['assignto'] : array();
                if(!empty($temp_assigned_users)) {
                    $assigned_diff_arr = array_diff($temp_assigned_users, $data['assignto']);
                    $assigned_diff_arr = array_values($assigned_diff_arr);
                    if(!empty($assigned_diff_arr)) {
                        /*Delete All users which are unselect*/
                        $temp_robot_data = select_mongo("robotlistAssociate", array('parent_id' => $asid, 'userId' => array('$in' => $assigned_diff_arr)), array('asid'));
                        $temp_robot_data = add_id($temp_robot_data, "id");
                        if(!empty($temp_robot_data)) {
                            foreach($temp_robot_data as $rv) {
                                delete_mongo("robotlist", array('_id' => new MongoId($rv['asid'])));
                            }
                        }
                        delete_mongo("robotlistAssociate", array('parent_id' => $asid, 'userId' => array('$in' => $assigned_diff_arr)));
                    }
                }
            } else {
                /*Delete All If no Assignee except Parent*/
                update_mongo('robotlist', array('attanders' => array()), array('_id' => new MongoId($asid)));
                update_mongo('robotlistAssociate', array('assignto' => array()), array('asid' => $asid));
                delete_mongo("robotlist", array('parent_id' => $asid));
                delete_mongo("robotlistAssociate", array('parent_id' => $asid));
            }
            return array("success" => "true", "data" => $data, "error_code" => "470104");
        }
    } else {
        /*Delete All If no Assignee except Parent*/
        update_mongo('robotlist', array('attanders' => array()), array('_id' => new MongoId($asid)));
        update_mongo('robotlistAssociate', array('assignto' => array()), array('asid' => $asid));
        delete_mongo("robotlist", array('parent_id' => $asid));
        delete_mongo("robotlistAssociate", array('parent_id' => $asid));
        return array("success" => "true", "data" => $data, "error_code" => "470104");
    }
}

function manage_training_panel($data) {
    if (isset($data['id']) && $data['id'] == "0") {
        unset($data['id']);
        $res = insert_mongo('chatbottraining', $data);
        if ($res['n'] == 1) {
            return array("success" => "false", "data" => $data, "error_code" => "470100");
        } else {
            $ins_id = db_id($data);
            $data['id'] = $ins_id;
            return array("success" => "true", "data" => $data, "error_code" => "470101");
        }
    } else {
        $id = $data['id'];
        unset($data['id']);
        $res = update_mongo('chatbottraining', $data, array('_id' => new MongoId($id)));
        if ($res['n'] == 0) {
            return array("success" => "false", "data" => $data, "error_code" => "470103");
        } else {
            $data['id'] = $id;
            return array("success" => "true", "data" => $data, "error_code" => "470104");
        }
    }
}

function delete_by_tablename($data) {
    logger("29", $data, "", 5, "/delete_by_tablename");
    $check = check_key_available($data, array('tablename', 'id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
        }
        $condition = array('_id' => array('$in' => $id));

        $res = delete_mongo($data['tablename'], $condition);
        $res = add_id($res, "id");
        if ($res['1'] == sizeof($id)) {
            return array("success" => "true", "data" => $data, "error_code" => "29003");
        } else {
            return array("success" => "false", "data" => $data, "error_code" => "29004");
        }
    } else {
        return $check;
    }
}

function getbytablename($data) {

    global $db, $site_url;
    logger("29", $data, "", 5, "/getbytablename");
    $check = check_key_available($data, array('tablename'));
    if ($check['success'] == 'true') {
        $index = "0";
        $nor = "10";
        $indexing = "";
        $orderbyval = 1;
        $orderby = array();
        $query = array();
        $searchType = array();
        $tablename = "";
        if (isset($data['tablename']) && $data['tablename'] != "") {
            $tablename = $data['tablename'];
        }
        $fields = array();
        if (isset($data['offset'])) {
            $data['index'] = $data['offset'];
            unset($data['offset']);
        }
        if (isset($data['limit'])) {
            $data['nor'] = $data['limit'];
            unset($data['limit']);
        }
        if (isset($data['fields'])) {
            $fields = explode(",", $data['fields']);
        }
        if (isset($data['order_by']) && isset($data['order_column'])) {
            if (isset($data['order_by'])) {
                if ($data['order_by'] == 'desc') {
                    $orderbyval = -1;
                }
            }
            $columnName = preg_replace('/\s+/', '', $data['order_column']);
            $orderby = array($columnName => $orderbyval);
        }
        if (isset($data['index']) && isset($data['nor'])) {
            $index = $data['index'];
            $indexing = 1;
            $nor = $data['nor'];
            unset($data['index']);
            unset($data['nor']);
        }
        if (isset($data['search']) && $data['search'] != "") {
            $searchstring = $data['search'];
            foreach ($data['search_on_like'] as $fieldName) {
                $query['$or'][] = array($fieldName => new MongoRegex("/^$searchstring/i"));
            }
        }
        if (isset($data['smid']) && $data['smid'] != "") {
            $query['smid'] = $data['smid'];
        }
        if (isset($data['query_str']) && ($data['query_str'] != '')) {
            $cond_qyery = json_decode($data['query_str'], true);
            foreach ($cond_qyery as $ck => $cv) {
                foreach ($cv['examStartDate'] as $keys => $dvalue) {
                    if ($key == $eq) {
                        unset($cv['examStartDate']['$eq']);
                        $cv['examStartDate']['$gte'] = new MongoDate(strtotime($dvalue . "00:00:00"));
                        $cv['examStartDate']['$lte'] = new MongoDate(strtotime($dvalue . "23:59:59"));
                    } else {
                        $cv['examStartDate'][$keys] = new MongoDate(strtotime($dvalue));
                    }
                }

                $query = array_merge($query, $cv);
            }
        }
        if (isset($data['createdOn']) && $data['createdOn'] == '1') {
            $orderby = array("createdOn" => -1);
        } else {
            $orderby = array("createDate" => -1);
        }

        if ($indexing != '' && $nor != '' && $data['search'] == "") {

            $res = select_sort_limit_mongo($tablename, $query, $fields, $orderby, $index, $nor);
            $totalCount = count_mongo($tablename, $query);
        } else {

            $res = select_sort_limit_mongo($tablename, $query, $fields, $orderby, $index, $nor);
            $totalCount = count_mongo($tablename, $query);
        }

        $associatedata = add_id($res, "id");
        if (!empty($associatedata) && count($associatedata) > 0) {
            foreach ($associatedata as $key => $record) {
                if (isset($record['status'])) {
                    $color = "green";
                    $data_status = 'inactive';
                    if ($record['status'] == 1) {
                        $data_status = 'active';
                        $color = 'red';
                    } else if ($record['status'] == 2) {
                        $data_status = 'block';
                        $color = 'yellow';
                    } else if ($record['status'] == 3) {
                        $data_status = 'lock';
                        $color = 'blue';
                    }


                    $record['status'] = '<a onclick="update_status(this.id)" disabled data-status="' . $data_status . '" data-id="' . $id . '" id="status-' . $id . '" style="border-color: ' . $color . '; color: ' . $color . ';" class="btn btn-default btn-link" title="">
                                           <i class="glyphicon glyphicon-off"></i>
                                        </a>';
                }
                if (isset($data['extra'])) {
                    $output = select_mongo($tablename, array('smid' => '5', 'ass_id' => $record['ass_id']));
                    $reso = add_id($output, "id");
                    $record['image1'] = "";
                    if (!empty($reso[0]) && count($reso[0]) > 0) {
                        $record['image1'] = '<img src="' . $site_url . "cron/media/" . $reso[0]['media'] . '" width="200" height="200">';
                    }
                    $record['name'] = "Image";
                    $record['image'] = '<img src="' . $site_url . "uploads/28/media/images/" . $record['media'] . '" width="150" height="50">';

                    $record['date_time'] = date("Y-m-d h:i a", $record['createdOn']->sec);
                }
                $associatedata[$key] = $record;
            }
            $datafinal = array("data" => $associatedata, "total_count" => $totalCount);
            logger("47", $datafinal, "", KLogger::INFO, "success--error_code=>470099");
            return array("success" => "true", "data" => $datafinal, "error_code" => "470099");
        } else {
            return array("success" => "false", "data" => "", "error_code" => "470099");
        }
    } else {
        return $check;
    }
}

function pdf_status($data) {
    logger("29", $data, "", 5, "/pdf_status");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $data['createDate'] = new MongoDate();
        $data['status'] = "0";
        unset($data['id']);
        $res = insert_mongo('invoice_execute_status', $data);
        if ($res['n'] == 1) {
            return array("success" => "false", "data" => $data, "error_code" => "29002");
        } else {
            $ins_id = db_id($data);
            return array("success" => "true", "data" => $ins_id, "error_code" => "29008");
        }
    } else {
        return $check;
    }
}

function run_invoice_status($data) {
    logger("29", $data, "", 5, "/run_invoice_status");
    $check = check_key_available($data, array("table"));
    if ($check['success'] == "true") {
        $table = $data['table'];
        unset($data['table']);
        $condition = array();
        $fields = array();
        if ($table == "robotrunstatus") {
            $condition = array("status" => "0", 'ip' => $data['ip']);
        }
        if (isset($data['id']) && $data['id'] != "0") {
            $condition['_id'] = new MongoId($data['id']);
        }
        if (isset($data['ip']) && $data['ip'] != "0") {
            $condition['ip'] = $data['ip'];
        }
        if (isset($data['status']) && $data['status'] != "") {
            $condition['status'] = $data['status'];
        }
        if (isset($data['type']) && $data['type'] == "update") {

            $id = $data['id'];
            unset($data['id']);
            $res = update_mongo($table, $data, array('_id' => new MongoId($id)));
            if ($res['n'] == 0) {
                return array("success" => "false", "data" => $data, "error_code" => "470109");
            } else {
                $data['id'] = $id;
                return array("success" => "true", "data" => $data, "error_code" => "470110");
            }
        } else {

            $res = select_mongo($table, $condition, $fields);
            $res = add_id($res, "id");
            if (sizeof($res) > 0) {
                return array("success" => "true", "data" => $res, "error_code" => "100");
            } else {
                return array("success" => "false", "data" => array(), "error_code" => "100");
            }
        }
    } else {
        return $check;
    }
}

function add_dashboard_data($data) {
    $rawPostData = file_get_contents('php://input');
    $jsonData = json_decode($rawPostData);
    $jsonData = json_encode($jsonData);
    $array = json_decode($jsonData, true);
    $data = $array[0];
    logger("29", $data, "", 5, "/add_dashboard_data");
    $check = check_key_available($data, array("id"));
    if ($check['success'] == "true") {
        if (isset($data['id']) && $data['id'] == "0") {
            $count_copydata = count_mongo("dashboard_task", array('username' => $data['username']));
            if ($count_copydata == 0) {
                $data['lastUpdate'] = new MongoDate();
                $data['createDate'] = new MongoDate();
                unset($data['id']);
                $data['_id'] = new MongoId();
                $res = insert_mongo('dashboard_task', $data);
                if ($res['n'] == 1) {
                    return array("success" => "false", "data" => $data, "error_code" => "470100");
                } else {
                    $ins_id = db_id($data);
                    $insert_data['id'] = $ins_id;
                    unset($data['_id']);
                    $data['associative_id'] = $insert_data['id'];
                    $res = insert_mongo('dashboard_task_logs', $data);
                    return array("success" => "true", "data" => $insert_data, "error_code" => "470101");
                }
            } else {

                $deltet_res = delete_mongo("dashboard_task", array('username' => $data['username']));
                $data['lastUpdate'] = new MongoDate();
                $data['createDate'] = new MongoDate();
                unset($data['id']);
                $data['_id'] = new MongoId();
                $res = insert_mongo('dashboard_task', $data);
                if ($res['n'] == 1) {
                    return array("success" => "false", "data" => $data, "error_code" => "470100");
                } else {
                    $ins_id = db_id($data);
                    $insert_data['id'] = $ins_id;
                    unset($data['_id']);
                    $data['associative_id'] = $insert_data['id'];
                    $res = insert_mongo('dashboard_task_logs', $data);
                    return array("success" => "true", "data" => $insert_data, "error_code" => "470101");
                }
            }
        } else {
            $data['lastUpdate'] = new MongoDate();
            $id = $data['id'];
            unset($data['id']);
            $res = update_mongo('dashboard_task', $data, array('_id' => new MongoId($id)));
            if ($res['n'] == 0) {
                return array("success" => "false", "data" => $data, "error_code" => "470103");
            } else {
                $data['id'] = $id;
                unset($data['_id']);
                unset($data['id']);
                $data['associative_id'] = $data['id'];
                $res = update_mongo('dashboard_task_logs', $data, array('associative_id' => $data['id']));
                return array("success" => "true", "data" => $data, "error_code" => "470104");
            }
        }
    } else {
        return $check;
    }
}

function get_dashboard_data($data) {

    $condition = array();
    $fields = array();
    if (isset($data['username']) && $data['username'] != "") {
        $condition['username'] = $data['username'];
    }
    $res = select_mongo("dashboard_task", $condition, $fields);
    $res = add_id($res, "id");
    if (sizeof($res) > 0) {
        return array("success" => "true", "data" => $res, "error_code" => "470099");
    }
    return array("success" => "false", "data" => $data, "error_code" => "470090");
}

/* * **********RPA functions************************ */

function manage_schedule_robot($data) {
    logger("43", $data, "", 5, "/manage_schedule");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {


        if ($data['id'] == '0' || $data['id'] == '') {

            $schedule = insert_schedule($data);
        } else {
            $schedule = update_schedule($data);
        }
        return $schedule;
    } else {
        return $check;
    }
}

function insert_schedule($data) {

    unset($data['id']);
    $data['_id'] = new MongoId();
    $data['schedule_id'] = $data['_id']->{'$id'};
    $data['uploadedOn'] = new MongoDate();
    $data['createdOn'] = new MongoDate();
    $robot = explode('-', $data['robot']);
    $data['asid'] = $robot[0];
    $data['schedule_created_date'] = new MongoDate();
    $lastTransaction = $data['startdate'] . " " . $data['starttime'];
    $data['lastUpdatedCron'] = strtotime($lastTransaction);
    $data['bot_desc'] = htmlspecialchars(trim($data['bot_desc']));
    $data['starttime'] = htmlspecialchars(trim($data['starttime']));
    $data['startdate'] = htmlspecialchars(trim($data['startdate']));
    $success = insert_mongo('schedule', $data);

    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};
        return array('data' => $id, 'error_code' => '6000', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '6001', 'success' => 'false');
    }
}

function update_schedule($data) {
    $id = $data['id'];
    $data['uploadedOn'] = new MongoDate();
    $robot = explode('-', $data['robot']);
    $data['asid'] = $robot[0];
    $lastTransaction = $data['startdate'] . " " . $data['starttime'];
    $data['lastUpdatedCron'] = strtotime($lastTransaction);
    $data['bot_desc'] = htmlspecialchars(trim($data['bot_desc']));
    $data['starttime'] = htmlspecialchars(trim($data['starttime']));
    $data['startdate'] = htmlspecialchars(trim($data['startdate']));
    $success = update_mongo('schedule', $data, array('_id' => new MongoId($id)));
    if ($success['n'] == '1') {
        return array('data' => $id, 'error_code' => '4303', 'success' => 'true');
    } else {
        return array('data' => $id, 'error_code' => '4304', 'success' => 'false');
    }
}

function getschedulebyid($data) {
    logger("43", $data, "", 5, "/manage_schedule");
    $check = check_key_available($data, array('user_id'));
    if ($check['success'] == 'true') {
        $scheduleData = select_mongo('schedule', array('user_id' => $data['user_id']));
        $scheduleData = add_id($scheduleData, "id");
        $finaldata = array();
        if (sizeof($scheduleData) > 0) {
            foreach ($scheduleData as $scheduleDataVal) {
                $name = get_resource_by_id(array('id' => $scheduleDataVal['user']));
                $allData['name'] = $name['data'][0]['name'];

                $data['asid'] = $robot[0];
                $robotName = select_mongo('robotlistAssociate', array('asid' => $scheduleDataVal['asid'], 'userId' => $scheduleDataVal['user']));
                $robotName = add_id($robotName);
                $allData['robotname'] = $robotName[0]['name'];
                $allData['bot'] = $scheduleDataVal['bot'];
                $schetype = explode('-', $scheduleDataVal['scheduletype']);
                $allData['startdate'] = $scheduleDataVal['startdate'];
                $allData['user'] = $scheduleDataVal['user'];
                $allData['robot'] = $scheduleDataVal['robot'];

                $str = "";
                if ($schetype[0] == '1') {
                    $str = "Hours";
                } else if ($schetype[0] == '2') {
                    $str = "Days";
                } else if ($schetype[0] == '3') {
                    $str = "Week";
                } else if ($schetype[0] == '4') {
                    $str = "Months";
                } else if ($schetype[0] == '5') {
                    $str = "Years";
                }
                if($schetype[0] == '6')
                {
                  $allData['trigger'] = "One Time";  
                }
                else
                {
                    $allData['trigger'] = "Every " . $scheduleDataVal['every'] . " " . $str;
                }
                $allData['starttime'] = $scheduleDataVal['starttime'];
                $allData['id'] = $scheduleDataVal['id'];
                array_push($finaldata, $allData);
            }

            return array('data' => $finaldata, 'error_code' => '7000', 'success' => 'true');
        }
        return array('data' => "", 'error_code' => '8000', 'success' => 'false');
    } else {
        return $check;
    }
}

/* * ********** New Webservices For Nikky*************** */

function run($data) {
    $check = check_key_available($data, array("username", "bot_name"));
    if ($check['success'] == 'true') {

        $get_resource = get_resource_by_id(array('email' => $data['username'], 'fields' => 'name'));
        $userid = $get_resource['data'][0]['id'];
        $query = array();
        $query['userId'] = $userid;
        $query['name'] = $data['bot_name'];
        $robotData = select_mongo('robotlistAssociate', $query);
        $robotData = add_id($robotData);
        if (!empty($robotData) && $robotData > 0) {
            $newdata['createDate'] = new MongoDate();
            $newdata['status'] = "0";
            $newdata['asid'] = $robotData[0]['asid'];
            $newdata['map_id'] = $robotData[0]['id'];
            $newdata['ip'] = $data['username'];
            $newdata['_id'] = new MongoId();
            $res = insert_mongo('robotrunstatus', $newdata);
            $resp = update_mongo('robotlistAssociate', array("status" => '0'), array('_id' => new MongoId($robotData[0]['id'])));
            return array('data' => '', 'error_code' => '7500', 'success' => 'true');
        } else {
            return array('data' => '', 'error_code' => '7501', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_all_robot_list($data) {
    $check = check_key_available($data, array("username"));
    if ($check['success'] == 'true') {

        $get_resource = get_resource_by_id(array('email' => $data['username'], 'fields' => 'name'));
        $userid = $get_resource['data'][0]['id'];
        $query = array();
        $query['userId'] = $userid;
        $fields = array('name', 'status');
        $robotData = select_mongo('robotlistAssociate', $query, $fields);
        $robotData = add_id($robotData);
        if (!empty($robotData) && $robotData > 0) {
            return array('data' => $robotData, 'error_code' => '7502', 'success' => 'true');
        } else {
            return array('data' => '', 'error_code' => '7503', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_all_template_list($data) {
    $check = check_key_available($data, array("username"));
    if ($check['success'] == 'true') {

        $get_resource = get_resource_by_id(array('email' => $data['username'], 'fields' => 'name'));
        $userid = $get_resource['data'][0]['id'];
        $query = array();
        $query['userId'] = $userid;
        $fields = array('template_name');
        $robotData = select_mongo('ocrtemplate', $query, $fields);
        $robotData = add_id($robotData);
        if (!empty($robotData) && $robotData > 0) {
            return array('data' => $robotData, 'error_code' => '7502', 'success' => 'true');
        } else {
            return array('data' => '', 'error_code' => '7503', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function schedule($data) {
    $check = check_key_available($data, array("username", "robot", "scheduletype", "starttime", "startdate", "addtoqueue"));
    if ($check['success'] == 'true') {

        $get_resource = get_resource_by_id(array('username' => $data['username'], 'fields' => 'name'));
        $userid = $get_resource['data'][0]['id'];
        $newdata = array();
        $newdata['user_id'] = $userid;
        $newdata['user'] = $userid;
        $newdata['id'] = $data['id'];
        $newdata['robot'] = $data['robot'];
        $newdata['bot_desc'] = $data['bot_desc'];
        $newdata['scheduletype'] = $data['scheduletype'];
        $newdata['starttime'] = $data['starttime'];
        $newdata['startdate'] = $data['startdate'];
        if (isset($data['every'])) {
            $newdata['every'] = $data['every'];
        } else {
            $newdata['every'] = 1;
        }
        $newdata['addtoqueue'] = $data['addtoqueue'];
        $query = array();

        if ($newdata['scheduletype'] == '1-Hourly') {
            $query['user'] = $newdata['user'];
            $query['starttime'] = $newdata['starttime'];
            $query['every'] = $newdata['every'];
            $query['scheduletype'] = $newdata['scheduletype'];
        } else {
            $query['user'] = $newdata['user'];
            $query['starttime'] = $newdata['starttime'];
            $query['startdate'] = $newdata['every'];
            $query['scheduletype'] = $newdata['scheduletype'];
        }

        $getScheduleData = select_mongo('schedule', $query);
        $getres = add_id($getScheduleData, "id");

        if (!empty($getres) && sizeof($getres) > 0) {
            $res = array('data' => 'Schedule Aleady Exist', 'error_code' => '5004', 'success' => 'schedule');
        } else {
            $currentUser = $_SESSION['user']['user_id'];
            if ($newdata['scheduletype'] == '1-Hourly') {
                $newdata['startdate'] = date('Y-m-d', time());
            }
            $res = manage_schedule_robot($newdata);
        }
        return $res;
    } else {
        return $check;
    }
}

function template_export($data) {
    $check = check_key_available($data, array("username", "template_name", "data"));
    if ($check['success'] == 'true') {

        $get_resource = get_resource_by_id(array('username' => $data['username'], 'fields' => 'name'));
        $userid = $get_resource['data'][0]['id'];
        $newdata = array();
        $newdata['id'] = "";
        $newdata['id'] = '0';
        $newdata['new'] = "";
        $newdata['new'] = '1';
        $template = "";
        $newtemplate = "";
        $template = $data['template_name'];
        $newtemplate = $data['new'];
        if (isset($data['template_name']) && !empty($data['template_name'] && $newdata['new'] == '1')) {
            $checkData = array('table' => 'ocrtemplate', 'field' => 'template_name', 'value' => $data['template_name'], 'field1' => 'userId', 'value1' => $userid, 'id' => $newdata['id']);
            $checkUnique = object_check_unique_field($checkData);
            if ($checkUnique['success'] == 'true') {
                $template = $data['template_name'];
                $newtemplate = $newdata['new'];
            } else {
                return array("success" => "false", "data" => "Template Already Exists", "error_code" => "7101");
            }
        }

        if (isset($newdata['id']) && $newdata['id'] == '0') {
            if ($newdata['new'] == '1') {
                $respp = insert_mongo('ocrtemplate', array("createDate" => new MongoDate(), "template_name" => $template, "new" => $newtemplate, "data" => $data['data'], "userId" => $userid));
            }
            return array("success" => "true", "data" => "success", "error_code" => "7099");
        } else {
            return array("success" => "false", "data" => "unsuccess", "error_code" => "7100");
        }
    } else {
        return $check;
    }
}

function template_import($data) {
    $check = check_key_available($data, array("username", "template_name"));
    if ($check['success'] == 'true') {
        $get_resource = get_resource_by_id(array('username' => $data['username'], 'fields' => 'name'));
        $userid = $get_resource['data'][0]['id'];
        $query = array();
        $query['userId'] = $userid;
        $query['template_name'] = $data['template_name'];
        $fields = array('template_name', 'data', 'new', 'userId');
        $templateData = select_mongo('ocrtemplate', $query, $fields);
        $tempData = add_id($templateData, "id");
        if (sizeof($tempData) > 0) {
            return array("success" => "true", "data" => $tempData, "error_code" => "7102");
        } else {
            return array("success" => "false", "data" => "No data avilable", "error_code" => "7104");
        }
    } else {
        return $check;
    }
}

function rpa_robot_start_to_stop_time($data) {
    logger("47", $data, "", 5, "/rpa_robot_start_to_stop_time");
    $finalData[0] = array('title', 'Hours per Day');
    $query = array();
    $user_ids = array();
    if (isset($data['userId']) && !empty($data['userId'])) {
        $userIds = explode(",", $data['userId']);
        foreach ($userIds as $userId) {
            $user_id = $userId;
            array_push($user_ids, $user_id);
        }
        $query['userId'] = array('$in' => $user_ids);
    }
    if (isset($data['strt_date']) && !empty($data['strt_date']) && isset($data['end_date']) && !empty($data['end_date'])) {

        $dt = $data['strt_date'] . "00:00";
        $fromDate = strtotime($dt);

        $dt1 = $data['end_date'] . " 23:59";
        $toDate = strtotime($dt1);

        $fromDates = new MongoDate($fromDate);
        $toDates = new MongoDate($toDate);
        $query['createDate'] = array('$gte' => $fromDates, '$lt' => $toDates);
    } else {
        $date = date('Y-m-d') . " 23:59";
        $currDate = strtotime($date);
        $endDate = $currDate;

        $toDate = new MongoDate($endDate);
        $query['createDate'] = array('$lt' => $toDate);
    }
    $query['status'] = '1';
    $kpiResultData = select_mongo("robotrunstatus", $query, array());
    $kpiResultData = add_id($kpiResultData, "id");
    $final = array();

    if (count($kpiResultData) > 0) {
        foreach ($kpiResultData as $key) {
            if (isset($key['stopDate']) && isset($key['createDate'])) {
                $title = $key['title'];
                $total_time = ($key['stopDate']->sec - $key['createDate']->sec );
                $time = (($total_time / 1000) / 60);

                $final[$key['asid']]['time'] += $time;
                $final[$key['asid']]['title'] = $title;
            }
        }
    }
    $count = 1;
    foreach ($final as $key1) {
        $finalData[$count] = array($key1['title'], $key1['time']);
        $count++;
    }
    if (count($finalData) < 2) {
        $finalData[1] = array('No Robot Running', 1);
    } else {
        $finalData = $finalData;
    }
    $FinalResult = array('data' => $finalData);

    return array("success" => "false", "data" => array('result' => $FinalResult, 'count' => count($finalData)), "error_code" => "7104");
}

//webservice for schedule chart
function get_schedule_chart($data) {
    logger("43", $data, "", 5, "/manage_schedule");
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') {
        $user_ids = array();
        $query = array();
        if (isset($data['userId']) && !empty($data['userId'])) {
            $userIds = explode(",", $data['userId']);
            foreach ($userIds as $userId) {
                $user_id = $userId;
                array_push($user_ids, $user_id);
            }
            $query['user_id'] = array('$in' => $user_ids);
        }
        $finaldata = array();
        $allData = array();
        $scheduleData = select_mongo('schedule', $query);
        $scheduleData = add_id($scheduleData, "id");
        foreach ($scheduleData as $scheduleDataVal) {
            if (isset($data['strt_date']) && !empty($data['strt_date'])) {
                $dt = $data['strt_date'] . "00:00";
            } else {
                $dt = date('Y-m-d') . "00:00";
            }

            $current_date = strtotime($dt);
            $end_date = $scheduleDataVal['startdate'] . "00:00";
            $end_date = strtotime($end_date);
            if ($scheduleDataVal['scheduletype'] == '1-Hourly') {

                $strt_time = substr($scheduleDataVal['starttime'], 0, -2);
                if (isset($data['strt_date']) && !empty($data['strt_date'])) {
                    $date = $data['strt_date'];
                    //$current_date_daily =$data['strt_date'].$strt_time;
                    $end_date_daily = strtotime($date . " 24:00");
                } else {
                    $date = date('Y-m-d');
                    //$current_date_daily =date('Y-m-d').$strt_time;
                    $end_date_daily = strtotime($date . " 24:00");
                }
                $check_prev_date = strtotime($date . " 00:00");
                $last_update = strtotime(date('Y-m-d 00:00', $scheduleDataVal['lastUpdatedCron']));
                if ($check_prev_date < $last_update) {
                    $current_date_daily = strtotime($date . $strt_time);
                } else {
                    $current_date_daily = $scheduleDataVal['lastUpdatedCron'];
                }

                $result = get_schdeule_data_according_hourly($current_date_daily, $end_date_daily, $scheduleDataVal['every'], $date);
                if (!empty($result)) {
                    foreach ($result[$date] as $key) {
                        $finaldata['id'] = $scheduleDataVal['id'];
                        $finaldata['strt_time'] = substr($key, 0, -2);
                        $finaldata['period_type'] = substr($key, -2);
                        $finaldata['userId'] = $scheduleDataVal['user'];
                        $robot = explode('-', $scheduleDataVal['robot']);
                        $finaldata['robot'] = $robot[0];
                        array_push($allData, $finaldata);
                    }
                }
            } else {
                $result = get_scheduler_date($current_date, $end_date, $scheduleDataVal['scheduletype']);
                if ($result['success'] == 'true') {
                    $finaldata['id'] = $scheduleDataVal['id'];
                    $finaldata['strt_time'] = substr($scheduleDataVal['starttime'], 0, -2);
                    $finaldata['period_type'] = substr($scheduleDataVal['starttime'], -2);
                    $finaldata['userId'] = $scheduleDataVal['user'];
                    $robot = explode('-', $scheduleDataVal['robot']);
                    $finaldata['robot'] = $robot[0];
                    array_push($allData, $finaldata);
                }
            }
        }
        $cnt = 0;
        $finalArray = array();
        $data_final = array();
        foreach ($allData as $values) {
            $robot_data = get_robot_by_id(array('id' => $values['robot']));
            if ($robot_data['success'] == 'true') {
                $data_final[0] = $robot_data['data'][0]['title'];
            }
            $user_data = get_resource_by_id(array('id' => $values['userId'], 'fields' => 'name'));
            if ($user_data['success'] == 'true') {
                $data_final[1] = $user_data['data'][0]['name'];
            }
            $times = $values['strt_time'];
            $times = explode(':', $times);
            $min = $times[1];
            $endmin = $min;
            if ($values['period_type'] == 'AM') {
                $hour = $times[0];
            } else {
                $hour = $times[0] + 12;
            }
            $end_hour = $hour + 1;
            $data_final[2] = array(0, 0, 0, intval($hour), intval($min), 0);
            $data_final[3] = array(0, 0, 0, intval($end_hour), intval($min), 0);
            array_push($finalArray, $data_final);
        }
        $FinalResult = $finalArray;

        return array("success" => "false", "data" => array('result' => $FinalResult, 'count' => count($FinalResult)), "error_code" => "7104");
    }
}

function get_schdeule_data_according_hourly($startdate, $enddate, $hour, $date) {
    $sdate = $startdate;
    $edate = $enddate;
    $dataArray = array();
    while ($sdate <= $edate) {
        $ndate = date("Y-m-d", $sdate);
        if ($date == $ndate) {
            $dataArray[date("Y-m-d", $sdate)][] = date("h:i A", $sdate);
        }

        $sdate = $sdate + (intval($hour) * 60 * 60);
    }
    return $dataArray;
}

function get_scheduler_date($current_date, $end_date, $type) {

    $schedule_id = array();
    if ($type == '3-Weekly') {
        $time = ($current_date - $end_date) / 60 / 60 / 24;
        $time_diff = $time % 7;
        if ($time_diff == 0) {
            return array("success" => "true", "data" => '', "error_code" => "7104");
        } else {
            return array("success" => "false", "data" => '', "error_code" => "7104");
        }
    } else if ($type == '4-Monthly') {

        $lastDateOfMonth_curr = date("Y-m-d", $current_date);
        $lastDateOfMonth_end = date("Y-m-d", $end_date);
        $end_day_date = date("d", $end_date);
        $current_day_date = date("d", $current_date);
        $lastDateOfMonth = date("Y-m-t", $current_date);
        if ($end_day_date == $current_day_date) {
            return array("success" => "true", "data" => '', "error_code" => "7104");
        } else if (($end_day_date == '29' || $end_day_date == '30' || $end_day_date == '31') && $lastDateOfMonth_curr == $lastDateOfMonth) {
            return array("success" => "true", "data" => '', "error_code" => "7104");
        } else {
            return array("success" => "false", "data" => '', "error_code" => "7104");
        }
    } else if ($type == '2-Daily') {
        return array("success" => "true", "data" => '', "error_code" => "7104");
    } else if ($type == '5-Yearly') {
        $earlier = new DateTime(date("Y-m-d", $current_date));
        $later = new DateTime(date("Y-m-d", $end_date));
        $diff = $later->diff($earlier)->format("%a");
        $check_current_date = check_leap_year(date("Y", $current_date));
        $check_end_date = check_leap_year(date("Y", $end_date));
        if ($check_current_date['success'] == 'true' || $check_end_date['success'] == 'true') {
            $time_diff = $diff % 366;
        } else {
            $time_diff = $diff % 365;
        }

        if ($time_diff == 0) {
            return array("success" => "true", "data" => '', "error_code" => "7104");
        } else {
            return array("success" => "false", "data" => '', "error_code" => "7104");
        }
    } else {
        return array("success" => "false", "data" => '', "error_code" => "7104");
    }
}

function get_robot_by_id($data) {
    $check = check_key_available($data, array("id"));
    if ($check['success'] == 'true') {
        $query = array();
        if ($data['id'] != 0) {
            $query['_id'] = new MongoId($data['id']);
        }
        $fields = array('title');
        $robotData = select_mongo('robotlist', $query, $fields);
        $robotData = add_id($robotData);
        if (!empty($robotData) && $robotData > 0) {
            return array('data' => $robotData, 'error_code' => '7502', 'success' => 'true');
        } else {
            return array('data' => '', 'error_code' => '7503', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function check_leap_year($year) {
    if ((0 == $year % 4) and ( 0 != $year % 100) or ( 0 == $year % 400)) {
        return array('data' => '', 'error_code' => '7503', 'success' => 'true');
    } else {
        return array('data' => '', 'error_code' => '7503', 'success' => 'false');
    }
}

//for dashboard task done fail status
function get_task_done_fail_status($data) {
    $query = array();
    $fields = array();
    $user_ids = array();
    $robot_ids = array();
    if (isset($data['userId']) && !empty($data['userId'])) {
        $userId = get_resource_by_id(array('email' => $data['userId'], 'fields' => 'id'));
        if ($userId['success'] == 'true') {
            $query['userId'] = $userId['data'][0]['id'];
        }
    }
    if (isset($data['robot_id']) && !empty($data['robot_id'])) {
        $robotIds = explode(",", $data['robot_id']);
        foreach ($robotIds as $robotId) {
            $robot_id = $robotId;
            array_push($robot_ids, $robot_id);
        }
        $query['robotId'] = array('$in' => $robot_ids);
    }

    if (isset($data['strt_date']) && !empty($data['strt_date'])) {
        $dt = $data['strt_date'] . "00:00";
        $fromDate = strtotime($dt);
        $dt1 = $data['strt_date'] . " 23:59";
        $toDate = strtotime($dt1);
        $fromDates = new MongoDate($fromDate);
        $toDates = new MongoDate($toDate);
        $query['createDate'] = array('$gte' => $fromDates, '$lt' => $toDates);
    }

    $res = select_mongo("dashboard_task_logs", $query, $fields);
    $res = add_id($res, "id");
    if (sizeof($res) > 0) {
        return array("success" => "true", "data" => $res, "error_code" => "470099");
    }
    return array("success" => "false", "data" => $data, "error_code" => "470090");
}
/*Start of Export json data from task function */
function export_robot_data($data)
{
    global $server_path;
    $message= json_encode($data);
    $type="encrypt";
    $password="nikky";
    $msg_bundle="";
    $new_output_encrypt= encrypt_decrypt($message,$type,$password,$msg_bundle);
    $file='bot_'.date('m-d-Y_hia').'.txt';
    $fp = fopen($server_path."uploads/temp". "/".$file,"wb");
    if($fp=='Unable to open file!')
    {
        return array("success" => "false", "data" =>"", "error_code" => "404");     
    }
    else
    {
       fwrite($fp,$new_output_encrypt['data']);
       fclose($fp);  
       $fpath= site_url()."uploads/temp". "/".$file;  
       return array("success" => "true", "data" =>$fpath, "error_code" => "201");
    }
}
/*End of Export json data from task function */

/*dashboard robot run count chart */
function rpa_robot_run_count($data) {
    logger("47", $data, "", 5, "/rpa_robot_run_count");
    $finalData[0] = array('Robot', 'Count');
    $query = array();
    $user_ids = array();
    if (isset($data['userId']) && !empty($data['userId'])) {
        $userIds = explode(",", $data['userId']);
        foreach ($userIds as $userId) {
            $user_id = $userId;
            array_push($user_ids, $user_id);
        }
        $query['machine_id'] = array('$in' => $user_ids);
    }
    if (isset($data['strt_date']) && !empty($data['strt_date'])) {

        $dt = $data['strt_date'] . "00:00";
        $fromDate = strtotime($dt);

        $dt1 = date('Y-m-d') . " 23:59";
        $toDate = strtotime($dt1);

        $fromDates = new MongoDate($fromDate);
        $toDates = new MongoDate($toDate);
        $query['createDate'] = array('$gte' => $fromDates, '$lt' => $toDates);
    } /*else {
        $date = date('Y-m-d') . " 23:59";
        $currDate = strtotime($date);
        $endDate = $currDate;

        $toDate = new MongoDate($endDate);
        $query['createDate'] = array('$lt' => $toDate);
    }*/
   // $query['status'] = '1';
    $kpiResultData = select_mongo("robotrunstatus", $query, array());
    $kpiResultData = add_id($kpiResultData, "id");
    $final = array();
    if (count($kpiResultData) > 0) {
        foreach ($kpiResultData as $value) {
           /* if (isset($key['stopDate']) && isset($key['createDate'])) {
                $title = $key['title'];
                $total_time = ($key['stopDate']->sec - $key['createDate']->sec );
                $time = (($total_time / 1000) / 60);

                $final[$key['asid']]['time'] += $time;
                $final[$key['asid']]['title'] = $title;
            }*/
            $final[$value['asid']]['asid']=$value['asid'];
            $final[$value['asid']]['machine_id']=$value['machine_id'];
            $final[$value['asid']]['title']=$value['title'];
            $final[$value['asid']]['count'] +=1;
        }
    }
    $count = 1;
    foreach ($final as $key1) {
        $finalData[$count] = array($key1['title'], $key1['count']);
        $count++;
    }

    $finalData = $finalData;
    $FinalResult = array('data' => $finalData);

    return array("success" => "false", "data" => array('result' => $FinalResult, 'count' => count($finalData)), "error_code" => "7104");
}
/* * **********RPA functions************************ */
?>
