<?php

function manage_category($data) {
    logger("1", $data, "", 5, "/manage_category");
    $datetime = current_date_time();
    $date = $datetime['date'];
    $data['lastUpdate'] = $date;
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {

            unset($data['id']);
            $manage = insert_category($data);
        } else {
            $manage = update_category($data);
        }
        return $manage;
    } else {
        return $check;
    }
}

function check_device_id($data) {
    logger("1", $data, "", 5, "/check_device_id");
    $check = check_key_available($data, array('deviceId', 'userId'));
    if ($check['success'] == 'true') {
        $checkDevice = select_mongo('user', array('deviceId' => $data['deviceId'], '_id' => new MongoId($data['userId'])));
        $checkDevice = add_id($checkDevice);
        if (sizeof($checkDevice) > 0) {
            return array('success' => 'true', 'data' => 'Available', 'error_code' => '100');
        } else {
            return array('success' => 'false', 'data' => 'Not Available', 'error_code' => '101');
        }
    } else {
        return $check;
    }
}

function get_user_type($data) {
    logger("1", $data, "", 5, "/get_user_type");
    if (isset($data['type'])) {
        $getUsers = explode(",", $data['type']);
        $currentId = $_SESSION['user']['user_id'];
        $where = array('user_type' => array('$in' => $getUsers), 'parentId' => "{$currentId}");
        $tmp = select_mongo('user', $where);
        $return = add_id($tmp, "id");
        return array('data' => $return, 'error_code' => '1013', 'success' => 'true');
    }
}

function insert_category($data) {
    logger("1", $data, "", 5, "/insert_category");
    $check = check_key_available($data, array('parent_id', 'code', 'title'));
    if ($check['success'] == 'true') {

        logger(1, '', $data, 5);
        $data['_id'] = new MongoId();
        $data['childs'] = array();
        $success = insert_mongo('category', $data);
        if ($success['n'] == '0') {
            $id = $data['_id']->{'$id'};
            $extra = array('id' => $id, 'n' => $data['title'], 'p' => $data['parent_id'], 'c' => $data['code']);

            //$notifyData=insert_notification(array('customerId'=>'43','mid'=>'1','smid'=>'1','userId'=>'0','itemId'=>$id.'|'.$data['parent_id'],'eid'=>"121",'extra'=>json_encode($extra)));

            $categoryData = get_category(array());
            if (!empty($categoryData)) {
                $parentIds = explode(",", get_category_parents($categoryData['data'], $data['parent_id']));


                if (sizeof($parentIds)) {

                    $parentIdsObject = array();
                    foreach ($parentIds as $pid) {
                        if ($pid != 'Array' && $pid != '') {

                            array_push($parentIdsObject, new MongoId($pid));
                        }
                    }
                    $updateAll = update_push_mongo('category', array('childs' => $id), array('_id' => array('$in' => $parentIdsObject)));
                }
            }
            $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '2', 'userId' => '', 'action' => $data['title'], 'stringId' => '2'));

            return array('data' => $id, 'error_code' => '1001', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1002', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_category_parents($categoryData, $currentParentId) {
    $categoryIds = array();
    foreach ($categoryData as $category) {
        if ($category['id'] == $currentParentId) {

            $categoryIds[] = get_category_parents($categoryData, $category['parent_id']);
            array_push($categoryIds, $category['id']);
        }
    }

    if (sizeof($categoryIds)) {
        return implode(",", array_filter(explode(",", implode(",", $categoryIds))));
    } else {
        return $categoryIds;
    }
}

function get_category_childs($categoryData, $currentCategoryId) {
    $categoryIds = array();
    foreach ($categoryData as $category) {
        if ($category['parent_id'] == $currentCategoryId) {
            $categoryIds[] = get_category_childs($categoryData, $category['id']);
            array_push($categoryIds, $category['id']);
        }
    }

    if (sizeof($categoryIds)) {
        return implode(",", array_filter(explode(",", implode(",", $categoryIds))));
    } else {
        return null;
    }
}

function update_category($data) {
    logger("1", $data, "", 5, "/update_category");
    $id = $data['id'];
    unset($data['id']);
    $allCategory = get_category(array());
    $allSubCategories = get_category_childs($allCategory['data'], $id);
    if ($allSubCategories) {
        $data['childs'] = explode(",", $allSubCategories);
    }
    $success = update_mongo('category', $data, array('_id' => new MongoId($id)));
    if ($success['n'] == '1') {
        $extra = array('id' => $id, 'n' => $data['title'], 'p' => $data['parent_id'], 'l' => $data['lang'], 'c' => $data['code']);
        //$notifyData=insert_notification(array('customerId'=>'43','mid'=>'1','smid'=>'1','userId'=>'0','itemId'=>$id.'|'.$data['parent_id'],'eid'=>"122",'extra'=>json_encode($extra)));

        $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '2', 'userId' => '', 'action' => $data['title'], 'stringId' => '3'));
        return array('data' => $id, 'error_code' => '1003', 'success' => 'true');
    } else {
        return array('data' => $id, 'error_code' => '1004', 'success' => 'false');
    }
}

function delete_category($data) {

    logger("1", $data, "", 5, "/delete_category");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $delete = delete_mongo('category', array("_id" => new MongoId($data['id'])));
        if ($delete['n'] == '0') {

            return array('data' => $data['id'], 'error_code' => '1006', 'success' => 'false');
        } else {
            // $notifyData=insert_notification(array('customerId'=>'43','mid'=>'1','smid'=>'1','userId'=>'0','itemId'=>$data['id'],'eid'=>"123",'extra'=>json_encode($data)));

            $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '2', 'userId' => '', 'action' => $data['id'], 'stringId' => '4'));


            return array('data' => $data['id'], 'error_code' => '1005', 'success' => 'true');
        }
    } else {
        return $check;
    }
}

function get_user_category($data) {
    logger("1", $data, "", 5, "/get_user_category");
    $check = check_key_available($data, array('category_ids', 'code'));
    if ($check['success'] == 'true') {
        $categories = '';
        $catids = explode("|", $data['category_ids']);
        $code = $data['code'];
        foreach ($catids as $catid) {
            $catid = new MongoId($catid);
            if (isset($data['code']) && $data['code'] != "") {
                $tmp = select_mongo('category', array('_id' => $catid, 'code' => $code), array('title1'));
            } else {
                $tmp = select_mongo('category', array('_id' => $catid), array('title1'));
            }


            $data = add_id($tmp, "id");
            if (isset($data[0]['title1'])) {
                $categories .= $data[0]['title1'] . " | ";
            }
        }
        $allCategory = substr($categories, 0, -3);
        if ($allCategory) {
            return array('data' => $allCategory, 'error_code' => '1007', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1008', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_category_users($data) {
    logger("1", $data, "", 5, "/get_category_users");
    $check = check_key_available($data, array('category_ids'));
    if ($check['success'] == 'true') {
        $catids = explode("|", $data['category_ids']);
        $categoryIds = array();
        $userId = '';
        $fields = array();
        $follow = '0';
        if (isset($data['userId'])) {
            $userId = $data['userId'];
        }

        if (isset($data['fields'])) {
            $fields = explode(',', $data['fields']);
        }

        foreach ($catids as $cid) {


            $categoryIds[] = $cid;
        }


        $tmp = select_mongo('user', array('category' => array('$in' => $categoryIds), 'status' => array('$ne' => '10')), $fields);
        $return = add_id($tmp, "id");
        //print_r($retrun);     die;
        if (isset($return[0]) && !empty($return[0])) {
            $alldata = array();
            foreach ($return as $ret) {

                if ($userId != '') {
                    $follow = check_exists(array('amid' => "1", "asmid" => "1", "aiid" => $ret['id'], "userId" => $userId, "type" => "followers"));

                    if ($follow == true) {
                        $follow = "1";
                    } else {
                        $follow = "0";
                    }
                }
                $profile_picture = '';
                $imageData = get_association_data("1", "10", "1", $ret['id']);
                if (isset($imageData['media']['1'][$ret['id']][0]) && $imageData['media']['1'][$ret['id']][0] != '') {
                    $profile_picture = $imageData['media']['1'][$ret['id']][0]['mediaName'];
                    $ret['ProfileImage'] = site_url() . 'uploads/media/images/' . $profile_picture;
                } else {
                    $ret['ProfileImage'] = "";
                }
                $ret['isFollow'] = $follow;
                array_push($alldata, $ret);
            }
            return array('data' => $alldata, 'error_code' => '1009', 'success' => 'true');
        } else {
            return array('data' => '', 'error_code' => '1010', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_category_usersold($data) {
    logger("1", $data, "", 5, "/get_category_usersold");
    $check = check_key_available($data, array('category_ids'));
    if ($check['success'] == 'true') {
        $catids = explode("|", $data['category_ids']);
        $final_array = array();
        for ($i = 0; $i < sizeof($catids); $i++) {
            $tmp = select_mongo('user', array('category' => array('$regex' => $catids[$i])), array('id'));
            $arr = add_id($arr, 'id');
            foreach ($arr as $res) {
                array_push($final_array, $res);
            }
        }

        if (sizeof($final_array) > 0) {
            return array('data' => $final_array, 'error_code' => '1009', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1010', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_category($data) {
    logger("1", $data, "", 5, "/get_category");
    if (isset($data['id'])) {
        $cats = array();
        $ids = explode("|", $data['id']);
        foreach ($ids as $id) {
            $category_id = new MongoId($id);
            array_push($cats, $category_id);
        }
        $tmp = select_mongo('category', array('_id' => array('$in' => $cats)));
    } else if (isset($data['title'])) {

        $condition['$or'] = array(array("title" => $data['title']), array("_id" => new MongoId($data['title'])));
        $tmp = select_mongo('category', $condition, array('title'));
    } else if (isset($data['code'])) {
        $cats = array();
        $ids = explode("|", $data['code']);
        foreach ($ids as $id) {
            //$category_id = new MongoId($id);
            array_push($cats, $id);
        }
        if (isset($data['parent_id'])) {
            $tmp = select_mongo('category', array('parent_id' => $data['parent_id'], 'code' => array('$in' => $cats), 'parent_id' => array('$ne' => '0')));
        } else {
            $tmp = select_mongo('category', array('code' => array('$in' => $cats), 'parent_id' => array('$ne' => '0')));
        }
    } else {
        $tmp = select_all_mongo('category');
    }
    $retrun = add_id($tmp, "id");
    if (sizeof($retrun)) {
        return array('data' => $retrun, 'error_code' => '1011', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1012', 'success' => 'false');
    }
}

function get_users($data) {
    global $companyId;
    logger("1", $data, "", 5, "/get_users");
    if (isset($data['id'])) {
        $user_id = explode("|", $data['id']);
        $userids = array();
        foreach ($user_id as $uid) {
            $userids[] = new MongoId($uid);
        }
        $tmp = select_mongo('user', array('_id' => array('$in' => $userids)));
    } else {
        $query = array();
        $query['status'] = array('$ne' => '10');
        $query['user_type'] = array('$ne' => 'super admin');
        $tmp = select_mongo('user', $query);
    }
    $return = add_id($tmp, "id");

    if (isset($return[0]) && !empty($return[0])) {
        $alldata = array();
        foreach ($return as $ret) {
            $imageData = get_association_data("1", "10", "1", $ret['id']);
            if (isset($imageData['media']['1'][$ret['id']]) && !empty($imageData['media']['1'][$ret['id']])) {
                $profile_picture = $imageData['media']['1'][$ret['id']][0]['mediaName'];
                if ($profile_picture != '') {

                    $ret['media'] = site_url() . 'uploads/' . $companyId . '/media/images/' . $profile_picture;
                } else {
                    $ret['media'] = "";
                }
            }
            array_push($alldata, $ret);
        }
        return array('data' => $alldata, 'error_code' => '1013', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1014', 'success' => 'false');
    }
}

function get_user($data) {
    logger("1", $data, "", 5, "/get_user");
    if (!empty($data['fields'])) {
        $user = select_mongo('user', $data['query'], $data['fields']);
    } else {
        $user = select_mongo('user', $data['query']);
    }
    $return = add_id($user, "id");
    return $return;
}
function manage_user($data) {
    stripAllFields($data);
    logger("1", $data, "", 5, "/manage_user");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == '0' || $data['id'] == '') {
            $check = check_key_available($data, array('category', 'username', 'email', 'name', 'role'));
            if ($check['success'] == 'true') {
                $manage_user = insert_user($data);
            } else {
                return $check;
            }
        } else {
            $manage_user = update_user($data);
        }
        return $manage_user;
    } else {
        return $check;
    }
}

function insert_user($data) {
    global $companyId;
    logger("1", $data, "", 5, "/insert_user");
    if (!check_email_exists($data['email'])) {
        $data['email'] = htmlspecialchars(trim(strtolower($data['email'])));
        $check = check_key_available($data, array('password'));
        if ($check['success'] == 'true') {
            $companyInfo = get_company_data();
            if (isset($companyInfo['lang'])) {
                $data['currentLang'] = $companyInfo['lang'];
            }
            unset($data['id']);
            $data['_id'] = new MongoId();
            if (isset($data['deviceType']) && ($data['deviceType'] == 'ios' || $data['deviceType'] == 'android')) {
                $roleInfo = get_roles(array('title' => $data['role']));
                $catInfo = get_category(array('title' => $data['category']));

                if ($catInfo['success'] == 'true' && $roleInfo['success'] == 'true') {
                    $data['role'] = $roleInfo['data'][0]['id'];
                    $data['category'] = array($catInfo['data'][0]['id']);
                } else {
                    if ($catInfo['success'] == 'false') {
                        return array('data' => 'category not available', 'error_code' => '1055', 'success' => 'false');
                    } else if ($roleInfo['success'] == 'false') {
                        return array('data' => 'role not available', 'error_code' => '1056', 'success' => 'false');
                    }
                }
            } else {
                $categorys = '';
                if (isset($data['category']) && $data['category'] != "") {
                    $categories = explode("|", $data['category']);
                    $categorys = $categories;
                }
                $data['category'] = $categorys;
            }
            $manager = array('');
            if (isset($data['manager'])) {
                $manager = explode("|", $data['manager']);
                unset($data['manager']);
            }
            $data['manager'] = $manager;
            $data['uploadedOn'] = new MongoDate();
            $versionNo = get_min_max_data(array('type' => 'max'));
            $data['versionNo'] = $versionNo['data'] + 1;
            $chat_url = "";
            if (isset($data['chat_url'])) {
                $chat_url = $data['chat_url'];
                unset($data['chat_url']);
            }
            $data['name'] = htmlspecialchars(trim($data['name']));
            $data['designation'] = htmlspecialchars(trim($data['designation']));
            $ret = insert_mongo('user', $data);
            if ($ret['n'] == '0') {
                $id = $data['_id']->{'$id'};
                if ($chat_url != "") {
                    $chatData = array('id' => '0', 'iid' => $id, 'name' => $data['name'], 'email' => $data['email'], 'password' => $data['password'], 'url' => $chat_url);
                    $url = $chat_url . "/webservices/manage_chat_user";
                    $insertUserData = curl_post_ext($url, $chatData);
                }
                $loginAttempt = manage_login_attempt_logs(array('id' => '0', 'userId' => $id, 'email' => $data['email'], 'attemptNo' => 0, 'status' => 1));
                $extra = array('id' => $id, 'n' => $data['name'], 'e' => $data['email'], 'cat' => $data['category'], 'desg' => $data['designation']);
                $notifyData = insert_notification(array('customerId' => $companyId, 'mid' => '1', 'smid' => '1', 'userId' => $id, 'itemId' => $id, 'eid' => "1", 'extra' => json_encode($extra)));
                $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $id, 'action' => $data['email'], 'stringId' => '12'));
                return array('data' => $id, 'error_code' => '1016', 'success' => 'true');
            } else {
                return array('data' => $data, 'error_code' => '1017', 'success' => 'false');
            }
        } else {
            return $check;
        }
    } else {
        return array('data' => $data['email'], 'error_code' => '1015', 'success' => 'false');
    }
}

function update_user($data) {
    global $companyId;
    logger("1", $data, "", 5, "/update_user");
    $id = $data['id'];
    unset($data['id']);
    if($id == '569f7faa7c3d68011e3c9869') {
        return array('data' => $data, 'error_code' => '1017', 'success' => 'false');
    }
    $chat_url = "";
    /*Check Active User for License*/
    if(!empty($data['status'])) {
        $is_valid_for_active = check_total_active_users($id);
        if(empty($is_valid_for_active)) {
            return array('data' => $data, 'error_code' => '1020', 'success' => 'false');
        }
    }
    if (isset($data['chat_url'])) {
        $chat_url = $data['chat_url'];
        unset($data['chat_url']);
    }
    if (isset($data['email']) && !empty($data['email'])) {
        $data['email'] = htmlspecialchars(trim(strtolower($data['email'])));
    }
    if (isset($data['category'])) {
        $categories = explode("|", $data['category']);
        $data['category'] = $categories;
        $newCategoriesIds = $categories;
        $userInfo = get_user_info_by_id(array('id' => $id, 'fields' => 'category'));
        $oldCategoriesIds = $userInfo['data'][0]['category'];
    }
    if (isset($data['manager'])) {
        $data['manager'] = explode("|", $data['manager']);
    }
    $data['uploadedOn'] = new MongoDate();
    if (empty($data['last_activity'])) {
        $versionNo = get_min_max_data(array('type' => 'max'));
        $data['versionNo'] = $versionNo['data'] + 1;
    }
    if(!empty($data['name'])) {
        $data['name'] = htmlspecialchars(trim($data['name']));
    }
    if(!empty($data['designation'])) {
        $data['designation'] = htmlspecialchars(trim($data['designation']));
    }
    $ret = update_mongo('user', $data, array('_id' => new MongoId($id)));
    if ($ret['n'] == '1') {
        if ($chat_url != "") {
            if (isset($data['password']) || isset($data['name'])) {
                $chatData = array();
                $chatData['id'] = $id;
                if (isset($data['password']) && $data['password'] != "") {
                    $chatData['password'] = $data['password'];
                }
                if (isset($data['name']) && $data['name'] != "") {
                    $chatData['name'] = $data['name'];
                }
                if (!empty($chatData)) {

                    $url = $chat_url . "/webservices/manage_chat_user";
                    $updateUserData = curl_post_ext($url, $chatData);
                }
            }
        }
        if (isset($data['category']) && $data['category'] != "") {
            $extra['id'] = $id;
            $extra['cat'] = $data['category'];
            if (isset($data['name'])) {
                $extra['n'] = $data['name'];
            }
            if (isset($data['email'])) {
                $extra['e'] = $data['email'];
            }
            if (isset($data['designation'])) {
                $extra['desg'] = $data['designation'];
            }
            $result = array_merge(array_diff($oldCategoriesIds, $newCategoriesIds), array_diff($newCategoriesIds, $oldCategoriesIds));
            if ($result) {
                $notifyData = insert_notification(array('customerId' => $companyId, 'mid' => '1', 'smid' => '1', 'userId' => $id, 'itemId' => $id, 'eid' => "120", 'extra' => json_encode($extra)));
            } else {
                $notifyData = insert_notification(array('customerId' => $companyId, 'mid' => '1', 'smid' => '1', 'userId' => $id, 'itemId' => $id, 'eid' => "2", 'extra' => json_encode($extra)));
            }
            } else {
            if (isset($data['name']) || isset($data['designation'])) {
                $extra['id'] = $id;
                if (isset($data['name'])) {
                    $extra['n'] = $data['name'];
                }
                if (isset($data['designation'])) {
                    $extra['desg'] = $data['designation'];
                }
                $notifyData = insert_notification(array('customerId' => $companyId, 'mid' => '1', 'smid' => '1', 'userId' => $id, 'itemId' => $id, 'eid' => "2", 'extra' => json_encode($extra)));
            }
        }
        if (isset($data['name'])) {
            $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $id, 'action' => $data['name'], 'stringId' => '13'));
        }
        return array('data' => $id, 'error_code' => '1018', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1019', 'success' => 'false');
    }
}
/*This function is to get total number of active Users based on Role*/
function check_total_active_users($user_id) {
    $status = FALSE;
    $user_info = get_resource_by_id(array('id' => $user_id, 'fields' => 'role'));
    if(!empty($user_info['data'][0]['role'])) {
        $role_id = $user_info['data'][0]['role'];
        $total_users = count_mongo('user', array('status' => '1', 'role' => $role_id, '_id' => array('$nin' => array(new MongoId('569f7faa7c3d68011e3c9869'), new MongoId('5cefeeb6eba3671a128b4568')))));
        $total_licenses = count_mongo('company_licenses', array());
        if($total_users < $total_licenses) {
            $status = TRUE;
        }
    }
    return $status;
}

function check_email_exists($email)
{   logger("1",$email,"",5,"/check_email_exists");
    $tmp = select_mongo('user',array('email'=>$email));
    $retrun= add_id($tmp,"id");
    if(count($retrun)>0)
    {
     return true;
    }
    return false;
}

function delete_user($data) {
    logger("1", $data, "", 5, "/delete_user");
    $check = check_key_available($data, array('id'));
    $chat_url = "";
    if (isset($data['chat_url'])) {
        $chat_url = $data['chat_url'];
        unset($data['chat_url']);
    }
    if ($check['success'] == 'true') {
        $user_id = explode("|", $data['id']);
        $idsToDelete = array();
        foreach ($user_id as $res) {
            $idsToDelete[] = new MongoId($res);
        }
        $delete = update_mongo('user', array('status' => '10', 'email' => time() . "@gmail.com", 'googleID' => time() . "@gmail.com", 'username' => time() . "@gmail.com", 'deviceId' => ''), array("_id" => array('$in' => $idsToDelete)));
        if ($delete['n'] == '0') {

            return array('data' => $data, 'error_code' => '1021', 'success' => 'false');
        } else {
            if (!empty($user_id)) {
                foreach ($user_id as $v) {
                    if ($chat_url != "") {
                        $chatData = array();
                        $chatData['id'] = $v;
                        $url = $chat_url . "/webservices/delete_chat_user_data";
                        $deleteUserData = curl_post_ext($url, $chatData);
                    }
                    $logsDelete = delete_login_attempt_logs(array('userId' => $v));
                    //$notifyData=insert_notification(array('customerId'=>'43','mid'=>'1','smid'=>'1','userId'=>'0','itemId'=>$v,'eid'=>"119",'extra'=>json_encode($data)));
                    $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $v, 'action' => $v, 'stringId' => '14'));
                }
            }
            return array('data' => implode(",", $idsToDelete), 'error_code' => '1020', 'success' => 'true');
        }
    } else {
        return $check;
    }
}

function get_roles($data) {

    logger("1", $data, "", 5, "/get_roles");
    $fields = array();
    if (isset($data['fields'])) {

        $fields = explode(",", $data['fields']);
    }

    if (isset($data['id'])) {

        $ids = explode("|", $data['id']);
        $role_id = array();
        foreach ($ids as $id) {
            array_push($role_id, new MongoId($id));
        }

        $arr = select_mongo('role', array("_id" => array('$in' => $role_id)), $fields);
    } else if (isset($data['title'])) {
        $condition['$or'] = array(array("title" => $data['title']), array("_id" => new MongoId($data['title'])));
        //  $tmp = select_mongo('role',$condition,array('title'));
        $arr = select_mongo('role', $condition, array('title'));
    } else {
        $condition = array();

        $arr = select_mongo('role', $condition, $fields);
    }


    $arr = add_id($arr, "id");
    if (sizeof($arr) > 0) {
        return array('data' => $arr, 'error_code' => '1022', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1023', 'success' => 'false');
    }
}

function manage_role($data) {
    logger("1", $data, "", 5, "/manage_role");
    $check = check_key_available($data, array('title', 'permission', 'id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == '' || $data['id'] == '0') {
            unset($data['id']);
            $data['_id'] = new MongoId();
            $return = insert_role($data);
        } else {
            $return = update_role($data);
        }
        return $return;
    } else {
        return $check;
    }
}

function insert_role($data) {
    logger("1", $data, "", 5, "/insert_role");
    $data['_id'] = new MongoId();
    $insert = insert_mongo('role', $data);
    if ($insert['n'] == '0') {
        $id = $data['_id']->{'$id'};
        $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '3', 'userId' => '', 'action' => $data['title'], 'stringId' => '5'));

        return array('data' => $id, 'error_code' => '1024', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1025', 'success' => 'false');
    }
}

function update_role($data) {
    logger("1", $data, "", 5, "/update_role");
    $id = $data['id'];
    unset($data['id']);
    $update = update_mongo('role', $data, array('_id' => new MongoId($id)));
    if ($update['n'] == '1') {
        $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '3', 'userId' => '', 'action' => $data['title'], 'stringId' => '6'));

        return array('data' => $id, 'error_code' => '1026', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1027', 'success' => 'false');
    }
}

function delete_role($data) {
    logger("1", $data, "", 5, "/delete_role");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = array();
        $delete_ids = explode("|", $data['id']);
        foreach ($delete_ids as $ids) {
            array_push($id, new MongoId($ids));
        }
        $delete = delete_mongo('role', array('_id' => array('$in' => $id)));
        if ($delete['n'] == '1') {
            $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '3', 'userId' => '', 'action' => $delete_ids[0], 'stringId' => '7'));

            return array('data' => $data['id'], 'error_code' => '1028', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1029', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function manage_module($data) {
    logger("1", $data, "", 5, "/manage_module");
    $check = check_key_available($data, array('title', 'id', 'permissions'));
    if ($check['success'] == 'true') {
        if ($data['id'] == '0' || $data['id'] == '') {
            unset($data['id']);
            $data['_id'] = new MongoId();
            $add_module = insert_mongo('module', $data);
            if ($add_module['n'] == '0') {
                return array('data' => $data['_id'], 'error_code' => '1030', 'success' => 'true');
            } else {
                return array('data' => $data, 'error_code' => '1031', 'success' => 'false');
            }
        } else {
            $id = $data['id'];
            unset($data['id']);
            $update_module = update_mongo('module', $data, array('_id' => new MongoId($id)));
            if ($update_module['n'] == '1') {
                return array('data' => $id, 'error_code' => '1032', 'success' => 'true');
            } else {
                return array('data' => $data, 'error_code' => '1033', 'success' => 'false');
            }
        }
    } else {
        return $check;
    }
}

function get_modules($data) {
    logger("1", $data, "", 5, "/get_modules");
    $arr = select_all_mongo('module');
    $arr = add_id($arr, "id");
    return array('data' => $arr, 'error_code' => '1034', 'success' => 'true');
}

function manage_social_usersOld($data) {
    logger("1", $data, "", 5, "/manage_social_users");
    $check = check_key_available($data, array('social_id', 'social_type'));
    if ($check['success'] == 'true') {
        if (!check_social_id($postvar['social_id'])) {
            $manage_user = manage_user($postvar);
            if ($manage_user['success'] == 'true') {
                $get_user = get_users(array('data' => $manage_user['data']));
                return $manage_user;
            } else {
                return $manage_user;
            }
        } else {
            $tmp = select_mongo('user', array('social_id' => $data['social_id']));
            $return = add_id($tmp);
            if ($return[0]) {
                $alldata = array();
                foreach ($return as $ret) {
                    array_push($alldata, $ret);
                }
                return array('data' => $alldata, 'error_code' => '1013', 'success' => 'true');
            } else {
                return array('data' => $data, 'error_code' => '1014', 'success' => 'false');
            }
        }
    } else {
        return $check;
    }
}

function user_login($data) {
    global $companyId;
    logger("1", $data, "", 5, "/user_login");
    $check = check_key_available($data, array('email', 'password'));
    if ($check['success'] == 'true') {
        if (isset($data['login_type']) && ($data['login_type'] == "facebook" || $data['login_type'] == "google" || $data['login_type'] == "twitter")) {
            $result = manage_social_users($data);
            return $result;
        } else {
            $message = 'Server Issue, Please try again';
            $captcha = 'no';
            $showCaptchaAfter = '1';
            $lockAfter = '5';
            $blockAfter = '10';
            $logingLogDetails = 'no';
            $lockEnabledAfter = '10';
            $advanceSetting = get_module_setting_by_mid(array('mid' => '1', 'smid' => '1'));
            if ($advanceSetting['success'] == 'true' && !empty($advanceSetting['data'][0])) {
                $captcha = $advanceSetting['data'][0]['advanceSetting']['showCaptcha'];
                $showCaptchaAfter = $advanceSetting['data'][0]['advanceSetting']['showCaptchaAfter'];
                $lockAfter = $advanceSetting['data'][0]['advanceSetting']['lockAfter'];
                $blockAfter = $advanceSetting['data'][0]['advanceSetting']['blockAfter'];
                $logingLogDetails = $advanceSetting['data'][0]['advanceSetting']['logingLogDetails'];
                $lockEnabledAfter = $advanceSetting['data'][0]['advanceSetting']['lockEnabledAfter'];
            }
            $query = array("email" => strtolower("$data[email]"), "password" => "$data[password]");
            $tmp = select_mongo('user', $query);
            $return = add_id($tmp);
            if (isset($return[0])) {
                if (OAUTH) {
                    $checkAuthKeys = check_key_available($data, array('client_id', 'client_secret'));
                    if ($checkAuthKeys['success'] == 'true') {
                        $token = get_oauth_token(array('client_id' => $data['client_id'], 'client_secret' => $data['client_secret']));
                        if ($token['success'] == 'true') {
                            $oauthToken = $token['data'];
                        } else {
                            return $token;
                        }
                    } else {
                        return $checkAuthKeys;
                    }
                }

                $alldata = array();
                $cdate = '';
                $alldata = $return[0];
                if ($alldata['status'] == '3') {
                    $getLogsAttmpt = get_login_attempt_logs(array('email' => $data['email']));
                    if ($getLogsAttmpt['success'] == 'true') {
                        $lastAttempt = $getLogsAttmpt['data'][0]['lastAttempt']->sec + (60 * $lockEnabledAfter);
                        if (time() > $lastAttempt) {
                            unset($alldata['status']);
                            $alldata['status'] = '1';
                            manage_user(array('id' => $alldata['id'], 'status' => '1'));
                        }
                    }
                }
                if ($alldata['status'] == '0') {
                    $message = 'User is Inactive.';
                    $data['message'] = $message;
                    manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $data['email'], 'action' => 'inactive', 'stringId' => '1'));
                    return array('data' => $data, 'error_code' => '1600', 'success' => 'false');
                } else if ($alldata['status'] == '2') {
                    manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $data['email'], 'action' => 'IP lock', 'stringId' => '1'));
                    return array('data' => $data, 'error_code' => '1602', 'success' => 'false');
                } else if ($alldata['status'] == '3') {
                    manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $data['email'], 'action' => 'account lock', 'stringId' => '1'));
                    return array('data' => $data, 'error_code' => '1603', 'success' => 'false');
                } else {
                    $userId = $alldata['id'];
                    $loginAttempt = manage_login_attempt_logs(array('id' => '1', 'email' => $data['email'], 'attemptNo' => 0, 'status' => 1));
                    if ($logingLogDetails == 'yes') {
                        manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $data['email'], 'action' => 'active', 'stringId' => '1'));
                    }
                    /* $imageData=get_association_data("1","10","1",$userId);
                      if($imageData['media']['1'][$userId]){
                      $imageData=$imageData['media']['1'][$userId][0]['mediaName'];
                      $alldata['media']=$imageData;
                      $alldata['mediaPath']=ui_media_url();
                      } */
                    $imageData = get_association_data("1", "10", "1", $userId);
                    if (isset($imageData['media']['1'][$userId]) && !empty($imageData['media']['1'][$userId])) {
                        $profile_picture = $imageData['media']['1'][$userId][0]['mediaName'];
                        if ($profile_picture != '') {

                            $alldata['media'] = site_url() . 'uploads/' . $companyId . '/media/images/' . $profile_picture;
                        } else {
                            $alldata['media'] = "";
                        }
                    }
                    $arr = array();
                    $oldGCM = "";
                    $oldDeviceId = "";
                    $arr['id'] = $userId;
                    if (isset($data['gcm'])) {
                        $oldGCM = $alldata['gcm'];
                        $arr['gcm'] = $data['gcm'];
                        $alldata['gcm'] = $data['gcm'];
                    }
                    if (isset($data['deviceId'])) {
                        $oldDeviceId = $alldata['deviceId'];
                        $arr['deviceId'] = $data['deviceId'];
                        $alldata['deviceId'] = $data['deviceId'];
                    }
                    if (isset($data['deviceType'])) {
                        $arr['deviceType'] = $data['deviceType'];
                        $alldata['deviceType'] = $data['deviceType'];
                    }

                    $role = $alldata['role'];
                    unset($alldata['role']);
                    $i = 0;
                    $permission = array();
                    $result = array();

                    if (!empty($role)) {

                        if (is_array($role)) {
                            $role_id = $role;
                        } else {
                            $role_id = explode(",", $role);
                        }


                        foreach ($role_id as $v) {

                            $get_roles = get_roles(array('id' => $v));
                            $get_roles = $get_roles['data'];

                            foreach ($get_roles as $key => $obj) {

                                if (json_decode($obj['permission'], true)) {
                                    $nat = json_decode($obj['permission'], true);
                                } else {
                                    $nat = $obj['permission'];
                                }


                                foreach ($nat as $key1 => $obj1) {
                                    $permission[$key1][] = $obj1;
                                }
                            }
                        }

                        foreach ($permission as $key2 => $obj2) {
                            foreach ($obj2 as $obj3) {
                                foreach ($obj3 as $key3 => $obj4) {
                                    $permission_key = $key3;
                                    $permission_element = $obj4;
                                    if (!isset($result[$key2][$permission_key])) {
                                        $result[$key2][$permission_key] = array();
                                    }
                                    foreach ($permission_element as $obj5) {
                                        if (!in_array($obj5, $result[$key2][$permission_key])) {
                                            $result[$key2][$permission_key][] = $obj5;
                                        }
                                    }
                                }
                            }
                        }
                        $alldata['role'] = json_encode($result);
                    }
                    

                    if (isset($data['deviceType']) && ($data['deviceType'] == "ios" || $data['deviceType'] == "android")) {
                        if ($arr['gcm'] != $oldGCM && $arr['deviceId'] != $oldDeviceId) {
                            $arr['oldGCM'] = $oldGCM;
                            $arr['oldDeviceId'] = $oldDeviceId;
                            $activity = update_user_last_activity($arr);
                            $notifyData = insert_notification(array('customerId' => $companyId, 'mid' => '1', 'smid' => '1', 'userId' => $alldata['id'], 'itemId' => $oldDeviceId, 'eid' => "71", 'extra' => json_encode(array('id' => $alldata['id']))));
                        } else {
                            $activity = update_user_last_activity($arr);
                        }
                        if (ENVIROMENT_ACCESS == 1) {
                            $moduleInfo = module_access_url("35", "1");
                            if ($moduleInfo) {
                                $info = json_decode($moduleInfo, true);
                                $chat_url = $info['url'];
                                $url = $chat_url . "/webservices/manage_chat_user";
                                $updateUserData = curl_post_ext($url, $arr);
                            }
                        }
                        $lang = get_languages(array('deviceType' => $data['deviceType']));
                        $alldata['languages'] = $lang['data'];

                        if (isset($alldata['role']) && $alldata['role'] != "" && $alldata['role'] != "null") {
                            $mr1 = array();
                            $newArr = array();
                            $moduledata = get_modules_by_id(array('mid' => "0", 'status' => "0"));
                            if (isset($moduledata['data'])) {
                                //print_r($moduledata['data']);die;
                                foreach ($moduledata['data'] as $mo) {
                                    array_push($newArr, $mo['mval']);
                                }
                            }
                            foreach ($result as $key => $val) {
                                if (in_array($key, $newArr)) {
                                    unset($result[$key]);
                                }
                            }
                            foreach ($result as $key => $val) {
                                $tmr1 = array();
                                $mid = get_module_by_name(trim($key));
                                $tmr1['id'] = $mid;
                                $tmr1['nm'] = $key;
                                $sm = array();
                                $tm = 1;

                                foreach ($val as $key1 => $val1) {
                                    if (isset($val1)) {
                                        $tsm = array();
                                        $smmid = get_submodule_id(array("mid" => "$mid", "sname" => "$key1"));
                                        if (isset($smmid['success']) != 'false') {
                                            $smmtitle = get_submodule_title_by_id(array("mid" => "$mid", "sname" => "$key1"));

                                            $tsm['id'] = $smmid;
                                            $tsm['nm'] = $key1;
                                            $tsm['title'] = $smmtitle;
                                            $tsm['permission'] = $val1;
                                            array_push($sm, $tsm);
                                        }
                                    }
                                }
                                $tmr1['submodule'] = $sm;
                                array_push($mr1, $tmr1);
                            }
                            $alldata['role'] = json_encode($mr1);
                        }
                        $cdata = array("logo" => "http://192.168.0.165/teammerge/ui/assets/img/logo_pyk.png", "module" => "1,2,3,4,5,6,7,8,9", "cid" => "565ee2c89c76841409000000");
                        $alldata['cdata'] = $cdata;
                    }
                    if (OAUTH) {
                        $hexPermissions = get_hexa_permissions(array('roles' => $role));
                        $pm = $hexPermissions['data']['pm'];
                        $sm = $hexPermissions['data']['sm'];
                        $oauthToken['access_token'] = $oauthToken['access_token'] . "-" . $pm;
                        $alldata['token'] = $oauthToken;
                    }
                    
                    // check user already login other system
                    if (isset($data['recorder_login']) && $data['recorder_login'] == 'true') {
                        // check user have license or not
                        if($alldata['user_type']=='super admin')
                        {
                            return array('data' =>"", 'error_code' => '1505', 'success' => 'false');
                        }
                        $str=rand(); 
                        $login_token = sha1($str);
                        $alldata['login_token']=$login_token;
                        update_user_last_activity(array('login_token'=>$login_token,'id'=>$alldata['id']));
                        if(isset($alldata['license_type']) && $alldata['license_type']=='1')
                        {
                            $tmp = select_mongo('company_licenses', array('userId'=>$alldata['id']));
                            $return = add_id($tmp);
                            if(isset($return[0]) && $return[0]['active_status']=='1' && $return[0]['assign_status']=='1') {
                            }
                            else
                            {
                                return array('data' => $alldata, 'error_code' => '1500', 'success' => 'false');
                            }
                        }
//                        $tmp = select_mongo('recorder_login', array('email' => $data['email']));
//                        $return = add_id($tmp);
//                        if (isset($return[0])) {
//                            return array('data' => "Already Login", 'error_code' => '1501', 'success' => 'false');
//                        } else {
//                            insert_mongo('recorder_login', array('email' => $data['email'], 'status' => '1'));
//                        }
                    }
                    insert_mongo('recorder_login', array('email' => $data['email'], 'status' => '1'));
                    return array('data' => $alldata, 'error_code' => '1035', 'success' => 'true');
                }
            } else {
                $message = 'Incorrect Password';
                $error_code = "1036";
                $getLogsAttmpt = get_login_attempt_logs(array('email' => $data['email']));
                if ($getLogsAttmpt['success'] == 'true') {
                    
                    $loginStatus = "password error";
                    $attemptNo = $getLogsAttmpt['data'][0]['attemptNo'] + 1;
                    manage_login_attempt_logs(array('id' => '1', 'email' => $data['email'], 'attemptNo' => $attemptNo));
                    if ($attemptNo == $lockAfter) {
                        $loginStatus = "account lock";
                        manage_user(array('id' => $getLogsAttmpt['data'][0]['userId'], 'status' => '3'));
                        manage_login_attempt_logs(array('id' => '1', 'email' => $data['email'], 'status' => 3));
                    } else if ($attemptNo >= $blockAfter) {
                        $loginStatus = "IP lock";
                        manage_user(array('id' => $getLogsAttmpt['data'][0]['userId'], 'status' => '2'));
                        manage_login_attempt_logs(array('id' => '1', 'email' => $data['email'], 'status' => 2));
                    }

                    $error_code = "1036";
                    if ($getLogsAttmpt['data'][0]['status'] == '2') {
                        $error_code = "1602";
                    } else if ($getLogsAttmpt['data'][0]['status'] == '3') {
                        $error_code = "1603";
                    } else if ($getLogsAttmpt['data'][0]['status'] == '0') {
                        $error_code = "1600";
                    }
                } else {
                    $message = 'User does not exists.';
                    $loginStatus = "account does not exists";
                    $error_code = "1036";
                }

                if ($logingLogDetails == 'yes') {
                    manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $data['email'], 'action' => $loginStatus, 'stringId' => '1'));
                }
                $data['message'] = $message;
                return array('data' => $data, 'error_code' => $error_code, 'success' => 'false');
            }
        }
    } else {
        return $check;
    }
}

function user_login1($data) {
    logger("1", $data, "", 5, "/user_login1");
    $check = check_key_available($data, array('username', 'password'));
    if ($check['success'] == 'true') {
        $tmp = select_mongo('user', array("username" => "$data[username]", "password" => "$data[password]"));
        $return = add_id($tmp);
        if ($return[0]) {
            $alldata = array();
            $cdate = '';
            $alldata = $return[0];
            $userId = $alldata['id'];
            $imageData = get_association_data("1", "10", "1", $userId);
            $imageData = $imageData['media']['1'][$userId][0]['mediaName'];
            $alldata['media'] = $imageData;

            if (isset($data['cid'])) {
                //$cdate=get_company_by_id(array('id'=>$data['cid']));
                // $cdate=$cdate['data'][0];
                // $alldata['cdata']=array('logo'=>$cdate['logo'],'module'=>$cdate['moduleid'],'cid'=>$cdate['id']);
                // prepare_send_notification("1","1","$alldata[id]","user_login","$alldata[id]");
            }

            return array('data' => $alldata, 'error_code' => '1035', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1036', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_resource_by_id($data) {
    logger("1", $data, "", 5, "/get_resource_by_id");
    $fields = array();
    if (isset($data['fields'])) {
        $fields = explode(",", $data['fields']);
    }

    $query = array();

    //$index=""; $nor="";
    $orderby = array();
    $orderby['name'] = 1;

    if (isset($data['index']) && isset($data['nor'])) {
        $pagi = true;
        $index = $data['index'];
        $nor = $data['nor'];
    }

    if (isset($data['email'])) {
        $emailId = explode("|", $data['email']);
        $emailIds = array();
        foreach ($emailId as $email) {
            array_push($emailIds, $email);
        }
        $query['email'] = array('$in' => $emailIds);
    }
    if (isset($data['username'])) {
        $usernameData = explode("|", $data['username']);
        $usernames = array();
        foreach ($usernameData as $un) {
            array_push($usernames, $un);
        }
        $query['username'] = array('$in' => $usernames);
    }
    if (isset($data['id'])) {
        if ($data['id'] != '0') {

            $user_id = explode("|", $data['id']);
            $userIds = array();
            foreach ($user_id as $uid) {
                if (MongoId::isValid($uid)) {
                    array_push($userIds, new MongoId($uid));
                }
            }
            $query['_id'] = array('$in' => $userIds);
        }
    }


    if (isset($data['search'])) {
        $search_string = $data['search'];
        if (isset($data['searchBy'])) {
            $query[$data['searchBy']] = new MongoRegex("/^$search_string/i");
        } else {
            $query['name'] = new MongoRegex("/^$search_string/i");
        }
    }

    $query['status'] = array('$ne' => '10');
    if (isset($data['user_type'])) {
        $query['user_type'] = $data['user_type'];
    }
    if (isset($data['googleID'])) {
        $query['googleID'] = $data['googleID'];
    }
    if (isset($data['type'])) {
        $query['type'] = $data['type'];
    }
    if (isset($data['business_email'])) {
        $query['business_email'] = $data['business_email'];
    }
    if (isset($data['orderby'])) {
        $orderby['uploadedOn'] = -1;
    }


    if (isset($index) && isset($nor)) {
        $tmp = select_sort_limit_mongo('user', $query, $fields, $orderby, $index, $nor);
        $return = add_id($tmp, "id");
    } else {
        $tmp = select_mongo('user', $query, $fields);
        $return = add_id($tmp, "id");
    }
    if (isset($return[0])) {
        $alldata = array();
        foreach ($return as $ret) {
            array_push($alldata, $ret);
        }
        return array('data' => $alldata, 'error_code' => '1013', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1014', 'success' => 'false');
    }
}

function check_social_id($id) {
    logger("1", $id, "", 5, "/check_social_id");
    global $db;
    $tmp = $db->user->find(array('social_id' => $id));
    $tmp = data_array($tmp);
    if (count($tmp) > 0) {
        return true;
    }
    return false;
}

function get_tree($data) {
    logger("1", $data, "", 5, "/get_tree");
    $cat = get_category();
    $all_cats = $cat['data'];
    $deviceType = "";
    if (isset($data['deviceType'])) {
        $deviceType = $data['deviceType'];
    }
    if (isset($data['id']) && $data['id'] != "") {
        $dat = get_category_tree($all_cats, $data['id'], '0', $deviceType);
    } else {
        $dat = get_category_tree($all_cats, 0, '0', $deviceType);
    }
    return array('success' => 'true', 'data' => $dat, 'error_code' => '100');
}

function get_category_treeOld($all_cats, $parentid, $chk = '0') {
    $ret = array();
    $return = '';
    for ($i = 0; $i < sizeof($all_cats); $i++) {

        if ($all_cats[$i]['parent_id'] == $parentid) {
            $ar = array('id' => $all_cats[$i]['id'], 'name' => $all_cats[$i]['title1'], 'parent_id' => $parentid);
            $retd = get_category_tree($all_cats, $all_cats[$i]['id']);
            if (sizeof($retd)) {

                $ar = array('id' => $all_cats[$i]['id'], 'name' => $all_cats[$i]['title1'], 'parent_id' => $parentid, "dhierarchy" => $all_cats[$i]['dhierarchy'], "child" => $retd);
            }
            array_push($ret, $ar);
        }
        if ($chk == '1' && $all_cats[$i]['id'] == $parentid) {
            $ar1 = array('id' => $all_cats[$i]['id'], 'name' => $all_cats[$i]['title1'], 'parent_id' => $all_cats[$i]['parent_id'], "child" => $ret);
        }
    }

    if ($chk == 1) {
        $ar1['child'] = $ret;
        $ar2 = array('0' => $ar1);
        return $ar2;
    } else {

        return $ret;
    }
}

function get_category_tree($all_cats, $parentid, $chk = '0', $deviceType = "") {
    $ret = array();
    $return = '';
    for ($i = 0; $i < sizeof($all_cats); $i++) {
        if($all_cats[$i]['id'] != '5ce0fbf590941ba86a3c9871') {
            if ($all_cats[$i]['parent_id'] == $parentid) {
                $dhierarchy = "0";
                if (isset($all_cats[$i]['dhierarchy'])) {
                    $dhierarchy = $all_cats[$i]['dhierarchy'];
                }
                if (isset($all_cats[$i]['title1'])) {
                    $title1 = $all_cats[$i]['title1'];
                }
                $ar = array('id' => $all_cats[$i]['id'], 'name' => $title1, 'parent_id' => $parentid, "dhierarchy" => $dhierarchy, 'code' => $all_cats[$i]['code']);
                if (isset($deviceType) && $deviceType != "") {
                    $ar = array('id' => $all_cats[$i]['id'], 'n' => $title1, 'p' => $parentid, 'l' => $all_cats[$i]['lang'], 'c' => $all_cats[$i]['code']);
                }
                $retd = get_category_tree($all_cats, $all_cats[$i]['id'], '0', $deviceType);
                if (sizeof($retd)) {
                    $dhierarchy = "0";
                    if (isset($all_cats[$i]['dhierarchy'])) {
                        $dhierarchy = $all_cats[$i]['dhierarchy'];
                    }
                    $ar = array('id' => $all_cats[$i]['id'], 'name' => $all_cats[$i]['title1'], 'parent_id' => $parentid, 'code' => $all_cats[$i]['code'], "dhierarchy" => $dhierarchy, "child" => $retd);
                    if (isset($deviceType) && $deviceType != "") {
                        $ar = array('id' => $all_cats[$i]['id'], 'n' => $all_cats[$i]['title1'], 'p' => $parentid, 'l' => $all_cats[$i]['lang'], 'c' => $all_cats[$i]['code'], "child" => $retd);
                    }
                }
                array_push($ret, $ar);
            }
            if ($chk == '1' && $all_cats[$i]['id'] == $parentid) {
                $dhierarchy = "0";
                if (isset($all_cats[$i]['dhierarchy'])) {
                    $dhierarchy = $all_cats[$i]['dhierarchy'];
                }
                $ar1 = array('id' => $all_cats[$i]['id'], 'name' => $all_cats[$i]['title1'], 'parent_id' => $all_cats[$i]['parent_id'], 'lang' => $all_cats[$i]['lang'], 'code' => $all_cats[$i]['code'], "dhierarchy" => $dhierarchy, "child" => $ret);
                if (isset($deviceType) && $deviceType != "") {
                    $ar1 = array('id' => $all_cats[$i]['id'], 'n' => $all_cats[$i]['title1'], 'p' => $all_cats[$i]['parent_id'], 'l' => $all_cats[$i]['lang'], 'c' => $all_cats[$i]['code'], "child" => $ret);
                }
            }
        }
    }

    if ($chk == 1) {
        $ar1['child'] = $ret;
        $ar2 = array('0' => $ar1);
        return $ar2;
    } else {

        return $ret;
    }
}

function get_department_tree($all_cats, $parentid, $chk = '0', $deviceType = "") {
    //pr($all_cats);
    $ret = array();
    $return = '';
    for ($i = 0; $i < sizeof($all_cats); $i++) {

        //$parentid=$parentid[$i];
        if ($all_cats[$i]['parent_id'] == $parentid) {

            $dhierarchy = "0";
            if (isset($all_cats[$i]['dhierarchy'])) {
                $dhierarchy = $all_cats[$i]['dhierarchy'];
            }
            $ar = array('id' => $all_cats[$i]['id'], 'name' => $all_cats[$i]['title1'], 'parent_id' => $parentid, 'lang' => $all_cats[$i]['lang'], "dhierarchy" => $dhierarchy, 'code' => $all_cats[$i]['code']);

            if (isset($deviceType) && $deviceType != "") {
                $ar = array('id' => $all_cats[$i]['id'], 'n' => $all_cats[$i]['title1'], 'p' => $parentid, 'l' => $all_cats[$i]['lang'], 'c' => $all_cats[$i]['code']);
            }
            $retd = get_department_tree($all_cats, $all_cats[$i]['id'], '0', $deviceType);
            if (sizeof($retd)) {
                $dhierarchy = "0";
                if (isset($all_cats[$i]['dhierarchy'])) {
                    $dhierarchy = $all_cats[$i]['dhierarchy'];
                }
                $ar = array('id' => $all_cats[$i]['id'], 'name' => $all_cats[$i]['title1'], 'parent_id' => $parentid, 'lang' => $all_cats[$i]['lang'], 'code' => $all_cats[$i]['code'], "dhierarchy" => $dhierarchy, "child" => $retd);

                if (isset($deviceType) && $deviceType != "") {
                    $ar = array('id' => $all_cats[$i]['id'], 'n' => $all_cats[$i]['title1'], 'p' => $parentid, 'l' => $all_cats[$i]['lang'], 'c' => $all_cats[$i]['code'], "child" => $retd);
                }
            }
            array_push($ret, $ar);
        }
        if ($chk == '1' && $all_cats[$i]['id'] == $parentid) {
            $dhierarchy = "0";
            if (isset($all_cats[$i]['dhierarchy'])) {
                $dhierarchy = $all_cats[$i]['dhierarchy'];
            }
            $ar1 = array('id' => $all_cats[$i]['id'], 'name' => $all_cats[$i]['title1'], 'parent_id' => $all_cats[$i]['parent_id'], 'lang' => $all_cats[$i]['lang'], 'code' => $all_cats[$i]['code'], "dhierarchy" => $dhierarchy, "child" => $ret);
            if (isset($deviceType) && $deviceType != "") {
                $ar1 = array('id' => $all_cats[$i]['id'], 'n' => $all_cats[$i]['title1'], 'p' => $all_cats[$i]['parent_id'], 'l' => $all_cats[$i]['lang'], 'c' => $all_cats[$i]['code'], "child" => $ret);
            }
        }
    }

    if ($chk == 1) {
        $ar1['child'] = $ret;
        $ar2 = array('0' => $ar1);
        return $ar2;
    } else {

        return $ret;
    }
}

function show_department_accordians($dat, $space, $parent_id, $no) {
    //pr($dat);    
    $space .= "---";
    for ($k = 0; $k < sizeof($dat); $k++) {

        if (isset($dat[$k]['parent_id'])) {
            echo $parent_id;
            $pid = $dat[$k]['parent_id'];
            ?>


            <?php echo $space;
            if ($pid != 0) { ?>

                <option value="<?php echo $dat[$k]['id']; ?>"><?php echo $space . $dat[$k]['name']; ?></option>
            <?php } else { ?><option value="<?php echo $dat[$k]['id']; ?>">---<?php echo $dat[$k]['name']; ?></option><?php } ?>

            <?php
            if (sizeof($dat[$k]['child'])) {
                show_department_accordians($dat[$k]['child'], $space, $dat[$k]['parent_id'], $no);
            }
        } else {
            $newdat = $dat[$k];

            for ($l = 0; $l < sizeof($newdat); $l++) {
                echo $parent_id;
                $pid = $newdat[$l]['parent_id'];
                ?>


                <?php echo $space;
                if ($pid != 0) { ?>

                    <option value="<?php echo $newdat[$l]['id']; ?>"><?php echo $space . $newdat[$l]['name']; ?></option>
                <?php } else { ?><option value="<?php echo $newdat[$l]['id']; ?>">---<?php echo $newdat[$l]['name']; ?></option><?php } ?>

                <?php
                if (sizeof($newdat[$l]['child'])) {
                    show_department_accordians($newdat[$l]['child'], $space, $newdat[$l]['parent_id'], $no);
                }
            }
        }
    }
}

function show_accordian($dat, $space, $parent_id, $no, $chkname, $category_data, $user_id, $abc = '', $mainParent = 0) {

    global $ui_string;
    $space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    for ($k = 0; $k < sizeof($dat); $k++) {

        if ($dat[$k]['parent_id'] == '0') {
            $mainParent = $dat[$k]['id'];
        }
        $pid = $dat[$k]['parent_id'];
        ?>
        <tr class="parent-<?php echo $dat[$k]['parent_id'] . "-" . $no; ?> all-open"  id="<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($dat[$k]['parent_id'] != 0) {
            if ($user_id == "") { ?> style="display:none;"<?php }
        } ?>>
        <?php
        if (isset($dat[$k]['child'])) {


            if (sizeof($dat[$k]['child'])) {
                ?>     
                    <td id="tdpad-<?php echo $dat[$k]['id'] . "-" . $no; ?>" onclick="show_childs('<?php echo $dat[$k]['id'] . "-" . $no; ?>');" class="tdpadd">
                        <i style="cursor: pointer;" id="icon-<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($user_id != "") { ?> class="fa fa-minus-square" <?php } else { ?> class="fa fa-plus-square"<?php } ?>></i>
                    </td>  
                <?php
            }
        } else {
            ?>     
                <td>&nbsp;</td>
            <?php
        }
        ?> 

            <td style="text-align: left;" class="tdpadd">
        <?php echo $space;
        if ($pid != 0) { ?>
                    <input data-check-valid="blank" name="<?php echo $chkname; ?>[]" value="<?php echo $dat[$k]['id']; ?>" <?php if ($user_id != '') {
                if (!empty($category_data)) {
                    if (in_array($dat[$k]['id'], $category_data)) {
                        echo 'checked="checked"';
                    }
                }
            } ?> id="chk-<?php echo $dat[$k]['id'] . "-" . $no; ?>" onclick="check_all_childs('<?php echo $dat[$k]['id'] . "-" . $no; ?>', '<?php echo $dat[$k]['name']; ?>')" class="checkbox-<?php echo $dat[$k]['parent_id'] . "-" . $no; ?>  p-<?php echo $mainParent; ?>  <?php echo $abc; ?> addUser editUser" data-error-setting='2' data-error-show-in="ecats" data-error-text="<?php echo $ui_string['1309']; ?>" type="checkbox" />
        <?php } ?>&nbsp;&nbsp;&nbsp;<?php echo $dat[$k]['name']; ?></td>     
        </tr>
        <?php
        if (isset($dat[$k]['child'])) {

            if (sizeof($dat[$k]['child'])) {
                show_accordian($dat[$k]['child'], $space, $dat[$k]['parent_id'], $no, $chkname, $category_data, $user_id, $abc, $mainParent);
            }
        }
    }
}

function show_departmentheirarchy($dat, $space, $parent_id, $no, $chkname, $category_data, $user_id, $abc, $mainParent = 0) {
    $space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    for ($k = 0; $k < sizeof($dat); $k++) {

        if ($dat[$k]['parent_id'] == '0') {
            $mainParent = $dat[$k]['id'];
        }
        $pid = $dat[$k]['parent_id'];
        ?>
        <tr class="parent-<?php echo $dat[$k]['parent_id'] . "-" . $no; ?> all-open"  id="<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($dat[$k]['parent_id'] != 0) {
            if ($user_id == "") { ?> style="display:none;"<?php }
        } ?>>
        <?php
        if (isset($dat[$k]['child']) && sizeof($dat[$k]['child'])) {
            ?>     
                <td id="tdpad-<?php echo $dat[$k]['id'] . "-" . $no; ?>" onclick="show_childs('<?php echo $dat[$k]['id'] . "-" . $no; ?>');" class="tdpadd">
                    <i style="cursor: pointer;" id="icon-<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($user_id != "") { ?>class="fa fa-minus-square"<?php } else { ?> class="fa fa-plus-square"<?php } ?>></i>
                </td>  
            <?php
        } else {
            ?>     
                <td>&nbsp;</td>
            <?php
        }
        ?> 

            <td style="text-align: left;" class="tdpadd">
        <?php echo $space;
        if ($pid != 0) { ?>
                    <input data-check-valid="blank" name="<?php echo $chkname; ?>" value="<?php echo $dat[$k]['id']; ?>" id="chk-<?php echo $dat[$k]['id'] . "-" . $no; ?>" onclick="enableChild('<?php echo $dat[$k]['id'] ?>')" data-error-setting='2' data-error-show-in="ecats" data-error-text="Please select a category" type="radio" />
        <?php } ?>&nbsp;&nbsp;&nbsp;<?php echo $dat[$k]['name']; ?>
            </td>   

        <?php
        $getUsers = get_category_users(array('category_ids' => $dat[$k]['id'], 'fields' => 'name'));
        //echo "</pre>";print_r($getUsers); 
        if (!empty($getUsers['data'])) {
            foreach ($getUsers['data'] as $uservalue) {
                if ($uservalue['id'] != $_SESSION['user']['user_id']) {
                    ?> 
                    <tr class="parent-<?php echo $dat[$k]['parent_id'] . "-" . $no; ?> all-open" id="<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($dat[$k]['parent_id'] != 0) {
                        if ($user_id == "") { ?> style="display:none;"<?php }
                    } ?>>
                        <td>&nbsp;</td><td>&nbsp;</td>
                        <td style="text-align: left;" class="tdpadd">
                            <input name="userIdTo" value="<?php echo $uservalue['id']; ?>" id="" class="disabledAll cat-<?php echo $dat[$k]['id'] ?>" type="radio" disabled="disabled" onclick="checkexistcommonusedpersonnel('<?php echo $dat[$k]['id'] ?>', '<?php echo $uservalue['id']; ?>');"/>
                            &nbsp;&nbsp;&nbsp;<?php echo $uservalue['name']; ?></td> 
                    </tr>
                <?php }
            }
        } ?> 
        </tr>
        <?php
        if (isset($dat[$k]['child']) && sizeof($dat[$k]['child'])) {
            show_departmentheirarchy($dat[$k]['child'], $space, $dat[$k]['parent_id'], $no, $chkname, $category_data, $user_id, $abc, $mainParent);
        }
    }
}

function show_orgnizeheirarchy($dat, $space, $parent_id, $no, $chkname, $category_data, $user_id, $abc, $mainParent = 0) {
    $space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    for ($k = 0; $k < sizeof($dat); $k++) {

        if ($dat[$k]['parent_id'] == '0') {
            $mainParent = $dat[$k]['id'];
        }
        $pid = $dat[$k]['parent_id'];
        ?>
        <tr class="parent-<?php echo $dat[$k]['parent_id'] . "-" . $no; ?> all-open"  id="<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($dat[$k]['parent_id'] != 0) {
            if ($user_id == "") { ?> style="display:none;"<?php }
        } ?>>
        <?php
        if (sizeof($dat[$k]['child'])) {
            ?>     
                <td id="tdpad-<?php echo $dat[$k]['id'] . "-" . $no; ?>" onclick="show_childs('<?php echo $dat[$k]['id'] . "-" . $no; ?>');" class="tdpadd">
                    <i style="cursor: pointer;" id="icon-<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($user_id != "") { ?>class="fa fa-minus-square"<?php } else { ?>class="fa fa-plus-square"<?php } ?>></i>
                </td>  
            <?php
        } else {
            ?>     
                <td>&nbsp;</td>
            <?php
        }
        ?> 

            <td style="text-align: left;" class="tdpadd">
        <?php echo $space;
        if ($pid != 0) { ?>
                    <!--<input data-check-valid="blank" name="<?php echo $chkname; ?>" value="<?php echo $dat[$k]['id']; ?>" id="chk-<?php echo $dat[$k]['id'] . "-" . $no; ?>" data-error-setting='2' data-error-show-in="ecats" data-error-text="Please select a category" type="checkbox" disabled="disabled" />-->
        <?php } ?>&nbsp;&nbsp;&nbsp;<?php echo $dat[$k]['name']; ?>
            </td>   

        <?php
        $getUsers = get_category_users(array('category_ids' => $dat[$k]['id'], 'fields' => 'name'));
        //echo "</pre>";print_r($getUsers); 
        if (!empty($getUsers['data'])) {
            foreach ($getUsers['data'] as $uservalue) {
                ?> 
                <tr class="parent-<?php echo $dat[$k]['parent_id'] . "-" . $no; ?> all-open"  id="<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($dat[$k]['parent_id'] != 0) {
                    if ($user_id == "") { ?> style="display:none;"<?php }
                } ?>>
                    <td>&nbsp;</td><td>&nbsp;</td>  
                    <td style="text-align: left;" class="tdpadd">
                        <input name="users[]" value="<?php echo $uservalue['id']; ?>" id="users_<?php echo $uservalue['id']; ?>" class="disabledAll cat-<?php echo $dat[$k]['id'] ?>" type="checkbox"/>
                        &nbsp;&nbsp;&nbsp;<?php echo $uservalue['name']; ?></td> 
                <tr>
            <?php }
        } ?> 
        </tr>
        <?php
        if (sizeof($dat[$k]['child'])) {
            show_orgnizeheirarchy($dat[$k]['child'], $space, $dat[$k]['parent_id'], $no, $chkname, $category_data, $user_id, $abc, $mainParent);
        }
    }
}

function show_accordian_table($dat, $space, $parent_id, $no, $chkname, $category_data, $user_id) {
    print_r($user_id);

    $space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    for ($k = 0; $k < sizeof($dat); $k++) {
        $pid = $dat[$k]['parent_id'];
        ?>

        <tr class="parent-<?php echo $dat[$k]['parent_id'] . "-" . $no; ?> all-open"  id="<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($dat[$k]['parent_id'] != 0) {
            if ($user_id == "") { ?> style="display:none;"<?php }
        } ?>>
        <?php
        if (isset($dat[$k]['child'])) {
            if (sizeof($dat[$k]['child'])) {
                ?>     
                    <td style="width: 60%;height: 50px;" id="tdpad-<?php echo $dat[$k]['id'] . "-" . $no; ?>" onclick="show_childs('<?php echo $dat[$k]['id'] . "-" . $no; ?>');" class="tdpadd">
                        <i style="cursor: pointer;" id="icon-<?php echo $dat[$k]['id'] . "-" . $no; ?>" <?php if ($user_id != "") { ?>class="fa fa-minus-square"<?php } else { ?> class="fa fa-plus-square"<?php } ?>></i><?php echo $space . $dat[$k]['name']; ?>
                    </td>  
                <?php
            }
        } else {
            ?>     
                <td style="text-align: left;" class="tdpadd">
            <?php echo $space;
            if ($pid != 0) { ?>
            <?php } ?><?php echo $dat[$k]['name']; ?></td>
            <?php
        }
        ?> 



            <td style="width: 40%;height: 50px; text-align:center;">
        <?php if (check_user_permission("resources", "users", "category_all") == 1) { ?>
                    <span class="tooltip-area">
                        <a data-original-title="Edit" href="javascript:;" onclick="open_add_category('update', '<?php echo $dat[$k]['id']; ?>')" class="btn btn-default btn-sm" title=""><i class="fa fa-pencil"></i></a>
                        &nbsp;
            <?php
            if ($pid == 0) {
                if (check_user_permission("resources", "users", "parentCategoryDelete") == 1) {
                    ?>
                                <a data-original-title="Delete" onclick="delete_category('<?php echo $dat[$k]['id']; ?>')" id="<?php echo $dat[$k]['id']; ?>" href="javascript:void(0)" class="btn btn-default btn-sm" title=""><i class="fa fa-trash-o"></i></a>&nbsp;
                <?php }
            } else { ?>
                            <a data-original-title="Delete" onclick="delete_category('<?php echo $dat[$k]['id']; ?>')" id="<?php echo $dat[$k]['id']; ?>" href="javascript:void(0)" class="btn btn-default btn-sm" title=""><i class="fa fa-trash-o"></i></a>&nbsp;
            <?php } ?>
            <?php
            if ($pid == 0) {
                if (isset($dat[$k]['child'])) {
                    if (sizeof($dat[$k]['child'])) {
                        ?>     

                                    <a data-original-title="View" id="<?php echo $dat[$k]['id']; ?>" href="<?php echo 'hierarchy' . '?id=' . $dat[$k]['id'] ?>" class="btn btn-default btn-sm"
                                       title="" target="_blank"><i class="fa fa-eye "></i></a>&nbsp;

                        <?php
                    }
                }
            }
            ?> 
                    </span>
        <?php } ?>    
            </td>

        <?php //}  ?>



        </tr>
        <?php
        if (isset($dat[$k]['child'])) {
            if (sizeof($dat[$k]['child'])) {
                show_accordian_table($dat[$k]['child'], $space, $dat[$k]['parent_id'], $no, $chkname, $category_data, $user_id);
            }
        }
    }
}

function show_category_accordians($dat, $space, $parent_id, $no) {

    $space .= "---";
    for ($k = 0; $k < sizeof($dat); $k++) {
        echo $parent_id;
        $pid = $dat[$k]['parent_id'];
        ?>


        <?php echo $space;
        if ($pid != 0) { ?>

            <option value="<?php echo $dat[$k]['id']; ?>"><?php echo $space . $dat[$k]['name']; ?></option>
        <?php } else { ?><option value="<?php echo $dat[$k]['id']; ?>">---<?php echo $dat[$k]['name']; ?></option><?php } ?>

        <?php
        if (isset($dat[$k]['child'])) {
            if (sizeof($dat[$k]['child'])) {
                show_category_accordians($dat[$k]['child'], $space, $dat[$k]['parent_id'], $no);
            }
        }
    }
}

function manage_permission($data) {
    logger("1", $data, "", 5, "/manage_permission");
    $check = check_key_available($data, array('title', 'id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == '0' || $data['id'] == '') {
            unset($data['id']);
            $data['_id'] = new MongoId();
            $add_module = insert_mongo('permission', $data);
            if ($add_module['n'] == '0') {
                return array('data' => $data['_id'], 'error_code' => '1050', 'success' => 'true');
            } else {
                return array('data' => $data, 'error_code' => '1051', 'success' => 'false');
            }
        } else {
            $id = $data['id'];
            unset($data['id']);
            $update_module = update_mongo('permission', $data, array('_id' => new MongoId($id)));
            if ($update_module['n'] == '1') {
                return array('data' => $id, 'error_code' => '1052', 'success' => 'true');
            } else {
                return array('data' => $data, 'error_code' => '1053', 'success' => 'false');
            }
        }
    } else {
        return $check;
    }
}

function get_permission($data) {
    logger("1", $data, "", 5, "/get_permission");
    if (isset($data['id'])) {
        $ids = explode("|", $data['id']);
        $permission_id = array();
        foreach ($ids as $id) {
            array_push($permission_id, new MongoId($id));
        }

        $arr = select_mongo('permission', array("_id" => array('$in' => $permission_id)));
    } else {
        $arr = select_all_mongo('permission');
    }

    $arr = add_id($arr, "id");
    return array('data' => $arr, 'error_code' => '1054', 'success' => 'true');
}

function define_hierarchy($data) {
    logger("1", $data, "", 5, "/define_hierarchy");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $cid = $data['id'];
        $update_to_zero = update_mongo("category", array('dhierarchy' => '0'), array('dhierarchy' => '1'));

        $update_all_hirarchy = update_mongo("category", array('dhierarchy' => '1'), array('_id' => new MongoId($cid)));
        if ($update_all_hirarchy['n'] == '1') {
            return array('data' => $cid, 'error_code' => '1037', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1038', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_hierarchy_id() {
    logger("1", $data, "", 5, "/get_hierarchy_id");
    $get_hierarchy_id = select_mongo('category', array("dhierarchy" => '1'));
    $arr = add_id($get_hierarchy_id, "id");
    if (sizeof($arr) > 0) {
        return array('data' => $arr, 'error_code' => '1040', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1039', 'success' => 'false');
    }
}

function manage_manager($data) {
    logger("1", $data, "", 5, "/manage_manager");
    $check = check_key_available($data, array('categories', 'userid'));
    if ($check['success'] == 'true') {
        $categories = explode("|", $data['categories']);
        $checkit = remove_manager($data['userid']);
        $allcheck = 0;
        foreach ($categories as $category) {
            $checkit1 = add_manager($data['userid'], $category);
            if (!$checkit1) {
                $allcheck = 1;
            }
        }
        if ($allcheck == 0) {
            return array('data' => implode(",", $categories), 'error_code' => '1041', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1042', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function remove_manager($uid) {
    logger("1", $uid, "", 5, "/remove_manager");
    $allcheck = 0;
    $get_manager = select_mongo('category', array('manager' => array('$exists' => true, '$in' => array($uid))));
    $getdata = add_id($get_manager, "id");
    foreach ($getdata as $cid) {
        $getMan = select_mongo('category', array('_id' => new MongoId($cid['id'])), array('manager'));
        $getdata = add_id($get_manager, "id");
        $data = $getdata[0]['manager'];
        $key = array_search($uid, $data);
        unset($data[$key]);

        $update_manager = update_mongo('category', array('manager' => array('2')), array('_id' => new MongoId($cid['id'])));
        if ($update_manager['n'] != '1') {
            $allcheck = 1;
        }
    }
    return $allcheck;
}

function add_manager($uid, $cid) {
    $get_manager = select_mongo('category', array('_id' => new MongoId($cid)), array('manager'));
    $getdata = add_id($get_manager, "id");
    $data = $getdata[0]['manager'];
    if (!$data) {
        $data = array();
    }
    array_push($data, $uid);

    $dt = array_unique($data);
    $add_manager = update_mongo('category', array('manager' => $dt), array('_id' => new MongoId($cid)));
    if ($add_manager['n'] == 1) {
        return true;
    } else {
        return false;
    }
}

function get_user_categories($data) {
    logger("1", $data, "", 5, "/get_user_categories");
    $check = check_key_available($data, array('userid'));
    if ($check['success'] == 'true') {
        $get_category = select_mongo('user', array('_id' => new MongoId($data['userid'])), array('category'));
        $getdata = add_id($get_category, "id");
        $categories = $getdata[0]['category'];
        return array('data' => implode(",", $categories), 'error_code' => '1043', 'success' => 'true');
    } else {
        return $check;
    }
}

function get_user_manager($data) {
    logger("1", $data, "", 5, "/get_user_manager");
    $check = check_key_available($data, array('userid'));
    if ($check['success'] == 'true') {
        $allCats = array();
        $cats = get_user_categories($data);
        $cats = explode(",", $cats['data']);
        foreach ($cats as $cat) {
            $dt = array('categoryid' => $cat);
            $catManager = get_category_managers($dt);
            if ($catManager['success'] == 'true') {
                array_push($allCats, $catManager['data']);
            }
        }
        $allCats = array_unique(explode(",", implode(",", $allCats)));
        if (sizeof($allCats) > 0) {
            return array('data' => $allCats, 'error_code' => '1045', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1044', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_category_managers($data) {
    logger("1", $data, "", 5, "/get_category_managers");
    $check = check_key_available($data, array('categoryid'));
    if ($check['success'] == 'true') {
        $category = explode(",", $data['categoryid']);
        $get_manager = select_mongo('user', array('manager' => array('$in' => $category), 'status' => '1'), array('id'));

        $getdata = add_id($get_manager, "id");
        $userIds = array();
        foreach ($getdata as $managerData) {
            array_push($userIds, $managerData['id']);
        }
        if (sizeof($userIds)) {
            return array('data' => implode(",", $userIds), 'error_code' => '1043', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1043', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_managers_category($data) {
    logger("1", $data, "", 5, "/get_managers_category");
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') {
        $getManager = select_mongo('user', array('_id' => new MongoId($data['userId'])), array('manager'));
        $getdata = add_id($getManager, "id");
        $managerOf = array_values(array_filter($getdata[0]['manager']));
        if (sizeof($managerOf)) {
            if (isset($data['object']) == 'true') {
                $query = array('id' => implode("|", $managerOf), 'childs' => 'true');
                if (isset($data['code'])) {
                    $query['code'] = $data['code'];
                }
                $categoryData = get_category($query);
                if ($categoryData['success'] == 'true') {
                    return array('data' => $categoryData['data'], 'error_code' => '1043', 'success' => 'true');
                } else {
                    return array('data' => $data, 'error_code' => '1043', 'success' => 'false');
                }
            }
            return array('data' => $managerOf, 'error_code' => '1043', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1043', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

//***Vipin Edit Function**//
function enroll($data) {
    //echo "<pre>"; print_r($data); die;
    logger("1", $data, "", 5, "/enroll");
    $check = check_key_available($data, array('itemId', 'mid', 'smid', 'userId', 'categoryId'));
    if ($check['success'] == 'true') {

        if (isset($data['proj_group_id']) && !empty($data['proj_group_id'])) {

            $usersBefore = get_all_users_enrolled_to_item(array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid'], 'proj_group_id' => $data['proj_group_id']));
        } else {

            unset($data['proj_group_id']);
            $usersBefore = get_all_users_enrolled_to_item(array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid']));
        }
        //echo "<pre>a"; print_r($usersBefore); die;
        if (isset($data['userId']) && !empty($data['userId'])) {
            $userId = explode(",", $data['userId']);
        }
        if (isset($data['proj_roles']) && !empty($data['proj_roles'])) {
            $data['proj_roles'] = explode(",", $data['proj_roles']);
        }

        if (isset($data['proj_group_id']) && !empty($data['proj_group_id'])) {
            $delUsers = delete_mongo('enrollments', array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid'], 'type' => 'user', 'proj_group_id' => $data['proj_group_id']));
        } else {
            $delUsers = delete_mongo('enrollments', array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid'], 'type' => 'user'));
        }



        if ($data['categoryId']) {

            $data['_id'] = new MongoId();
            $data['parent'] = '0';
            $data['createdOn'] = new MongoDate();
            $namedata = get_category_name_data($data['categoryId']);
            $data['categoryData'] = $namedata;
            unset($data['userId']);
            $data['type'] = 'category';
            $addData = insert_mongo('enrollments', $data);
            $id = $data['_id']->{'$id'};


            $categories = explode("|", $data['categoryId']);
            if (sizeof($categories) > 0) {
                foreach ($categories as $category) {
                    $nData = array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid'], 'parent' => $id, 'categoryId' => explode(",", $category));
                    //  $addData=insert_mongo('enrollments',$nData);
                }
            }
        }


        if (sizeof($userId) > 0) {

            unset($data['categoryData']);
            unset($data['categoryId']);
            $data['_id'] = new MongoId();
            $data['users'] = $userId;
            $data['type'] = 'user';



            $addUsers = insert_mongo('enrollments', $data);
        }
        if (isset($data['proj_group_id']) && !empty($data['proj_group_id'])) {

            $usersNow = get_all_users_enrolled_to_item(array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid'], 'proj_group_id' => $data['proj_group_id']));

            //echo "s" .$usersNow; die;
        } else {
            $usersNow = get_all_users_enrolled_to_item(array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid']));
        }



        notifyUsers($usersBefore['data'], $usersNow['data'], '', $data['mid'], $data['smid'], $data['itemId']);
        return array('success' => 'true', 'data' => $id, 'error_code' => '99');
    } else {
        return $check;
    }
}

/* function enroll($data)
  {
  logger(1,'',$data,5);
  $check=check_key_available($data,array('itemId','mid','smid','userId','categoryId'));
  if($check['success']=='true')
  {
  $usersBefore=get_all_users_enrolled_to_item(array('itemId'=>$data['itemId'],'mid'=>$data['mid'],'smid'=>$data['smid']));

  $userId=explode(",",$data['userId']);
  if(isset($data['categoryId']))
  {
  $data['_id']=new MongoId();
  $data['parent']='0';
  $data['createdOn']=new MongoDate();
  $namedata=get_category_name_data($data['categoryId']);
  $data['categoryData']=$namedata;
  unset($data['userId']);
  $data['type']='category';
  $addData=insert_mongo('enrollments',$data);
  $id=$data['_id']->{'$id'};


  $categories=explode("|",$data['categoryId']);
  if(sizeof($categories)>0)
  {
  foreach($categories as $category)
  {
  $nData=array('itemId'=>$data['itemId'],'mid'=>$data['mid'],'smid'=>$data['smid'],'parent'=>$id,'categoryId'=>explode(",",$category));
  //  $addData=insert_mongo('enrollments',$nData);
  }
  }
  }


  if(sizeof($userId)>0)
  {
  unset($data['categoryData']);
  unset($data['categoryId']);
  $data['_id']=new MongoId();
  $data['users']=$userId;
  $data['type']='user';


  $delUsers=delete_mongo('enrollments',array('itemId'=>$data['itemId'],'mid'=>$data['mid'],'smid'=>$data['smid'],'type'=>'user'));
  $addUsers=insert_mongo('enrollments',$data);

  }

  $usersNow=get_all_users_enrolled_to_item(array('itemId'=>$data['itemId'],'mid'=>$data['mid'],'smid'=>$data['smid']));

  notifyUsers($usersBefore['data'],$usersNow['data'],'',$data['mid'],$data['smid'],$data['itemId']);
  return array('success'=>'true','data'=>$id,'error_code'=>'99');
  }
  else
  {
  return $check;
  }
  } */

function notifyUsers($usersBefore, $usersNow, $event = "enrolled", $mid, $smid, $itemId = 0) {

    global $companyId;
    $newUsers = array_diff($usersNow, $usersBefore);
    $usersRemoved = array_diff($usersBefore, $usersNow);

    if (sizeof($usersRemoved)) {
        if ($mid == 2) {
            $eid = 72;
        } if ($mid == 6) {
            $eid = 31;
        } if ($mid == 7) {
            $eid = 162;
        }
        $notifyData = array('customerId' => $companyId, 'mid' => $mid, 'smid' => $smid, 'userId' => implode("|", $usersRemoved), 'itemId' => "$itemId", 'eid' => "$eid", 'extra' => '');
        insert_notification($notifyData);
    }

    if (sizeof($newUsers)) {
        $userData = get_resource_by_id(array('id' => implode("|", $newUsers), 'fields' => 'role'));
        $userData = $userData['data'];

        $eid = 0;

        if ($mid == 2) {
            $eid = 14;
        }
        if ($mid == 6) {
            $eid = 31;
        }
        if ($mid == 7) {
            $eid = 162;
        }
        $notifyData = array('customerId' => $companyId, 'mid' => $mid, 'smid' => $smid, 'userId' => implode("|", $newUsers), 'itemId' => "$itemId", 'eid' => "$eid", 'extra' => '');
        insert_notification($notifyData);




        $module = get_module($mid);

        /* foreach($userData as $user)
          {

          $roleData=json_decode($user['role'],true);

          $modulePermissions=$roleData[$module];

          if(sizeof($modulePermissions))
          {
          $modulePermissions=$modulePermissions[$module.$smid];
          if(isset($modulePermissions))
          {
          if(!in_array('view', $modulePermissions))
          {
          array_push($modulePermissions,'view');
          $roleData[$module][$module.$smid]=$modulePermissions;

          $updateData=array('id'=>$user['id'],'role'=>json_encode($roleData));
          $manageUserPermissions=manage_user($updateData);
          }
          }
          else
          {
          $roleData[$module][$module.$smid]=array('view');

          $updateData=array('id'=>$user['id'],'role'=>json_encode($roleData));
          $manageUserPermissions=manage_user($updateData);
          }

          }
          else
          {

          $roleData[$module][$module.$smid]=array('view');

          $updateData=array('id'=>$user['id'],'role'=>json_encode($roleData));
          $manageUserPermissions=manage_user($updateData);
          }
          } */
    }
    //category_deleted
}

function get_all_users_enrolled_to_item($data) {
    //echo "<pre>"; print_r($data); die;
    logger("1", $data, "", 5, "/get_all_users_enrolled_to_item");
    $check = check_key_available($data, array('itemId', 'mid', 'smid'));
    if ($check['success'] == 'true') {
        $data['type'] = 'user';
        $allUsers = array();
        $getUsersEnrolled = select_mongo('enrollments', $data, array('userId'));
        $getUsersEnrolled = add_id($getUsersEnrolled);

        if (count($getUsersEnrolled)) {
            foreach ($getUsersEnrolled as $key => $value) {
                if (isset($value['userId'])) {
                    $allUsers_temp = explode(",", $value['userId']);
                    if (count($allUsers_temp)) {
                        foreach ($allUsers_temp as $uk => $uv) {
                            array_push($allUsers, $uv);
                        }
                    }
                }
            }
        }

        //echo "ar<pre>"; print_r($allUsers); die;
        $data['type'] = 'category';
        $data['parent'] = '0';
        $getCategoryEnrolled = select_mongo('enrollments', $data, array('categoryId'));
        $getCategoryEnrolled = add_id($getCategoryEnrolled);

        $allCategories = array();
        foreach ($getCategoryEnrolled as $enrolled) {
            $catIds = explode("|", $enrolled['categoryId']);
            $users = get_multiple_category_users($catIds);
            foreach ($users as $user) {
                array_push($allCategories, $user['id']);
            }
        }

        $allUsersEnrolled = array_unique(array_merge($allUsers, $allCategories));
        //echo "<pre>"; print_r($allUsersEnrolled); die;
        return array('success' => 'true', 'data' => $allUsersEnrolled, 'error_code' => '91');
    } else {
        return $check;
    }
}

function get_all_users_by_enrollment($data) {
    logger("1", $data, "", 5, "/get_all_users_by_enrollment");
    $check = check_key_available($data, array('itemId'));
    if ($check['success'] == 'true') {
        $conds['itemId'] = $data['itemId'];
        if (isset($data['proj_group_id'])) {
            $conds['proj_group_id'] = $data['proj_group_id'];
        }
        $params = array("users", "categoryId");
        $arr = select_mongo('enrollments', $conds, $params);
        $arr = add_id($arr, "id");
        $allUsersEnrolled = array();

        foreach ($arr as $enrolledData) {
            if (isset($enrolledData['users'])) {
                foreach ($enrolledData['users'] as $u) {
                    array_push($allUsersEnrolled, $u);
                }
            }
            if (isset($enrolledData['categoryId'])) {
                $catUsers = get_category_users(array('category_ids' => $enrolledData['categoryId'], 'fields' => 'id'));
                if (sizeof($catUsers['data'])) {
                    foreach ($catUsers['data'] as $cu) {
                        array_push($allUsersEnrolled, $cu['id']);
                    }
                }
            }
        }
        $allUsersEnrolled = array_values(array_filter(array_unique($allUsersEnrolled)));
        if (!empty($allUsersEnrolled)) {
            $ids = array();
            foreach ($allUsersEnrolled as $key => $val) {
                $ids[$key] = new MongoId($val);
            }
            $conds_arr = array('_id' => array('$in' => $ids));
            $allUsersEnrolled = select_mongo('user', $conds_arr, array('name'));
            $allUsersEnrolled = add_id($allUsersEnrolled, "id");
        }
        return array('success' => 'true', 'data' => $allUsersEnrolled, 'error_code' => '100');
    } else {
        return $check;
    }
}

function get_category_name_data($category_ids) {
    logger("1", $category_ids, "", 5, "/get_category_name_data");
    $category_ids = array_filter(explode("|", $category_ids));

    $arr1 = array();
    foreach ($category_ids as $catids) {
        $catids = array_filter(explode(",", $catids));
        $code = "";
        $arr2 = array();
        foreach ($catids as $catid) {
            $dt = array('id' => $catid);
            $catdata = get_category($dt);
            $catdata = $catdata['data'][0];
            $data_array = array('title' => $catdata['title'], 'code' => $catdata['code']);
            $code = $catdata['code'];
            array_push($arr2, $data_array);
        }

        array_push($arr1, array('code' => $code, 'all' => $arr2));
    }
    return json_encode($arr1);
}

function set_notification_location($data) {
    logger("1", $data, "", 5, "/set_notification_location");
    if (isset($data['userId'])) {
        if ($data['userId'] != '') {
            $old_data = explode(',', $data['userId']);
        }
        unset($data['userId']);
    } else {
        $old_data = array();
    }

    $new_data = get_enrolled($data);
    $new_data = $new_data['data']['users'];
    if (count($old_data) && count($new_data)) {
        $result = array_merge(array_diff($old_data, $new_data), array_diff($new_data, $old_data));
    } else if (count($old_data)) {
        $result = $old_data;
    } else {
        $result = $new_data;
    }


    if (is_array($result) && count($result)) {
        $res = implode(',', $result);
        return array('success' => 'true', 'data' => $result, 'error_code' => '98');
    } else {
        return array('success' => 'true', 'data' => array(), 'error_code' => '97');
    }
}

//****Vipin Edit Function**///
function get_enrolled($data) {
    logger("1", $data, "", 5, "/get_enrolled");
    $check = check_key_available($data, array('itemId', 'mid', 'smid'));
    if ($check['success'] == 'true') {
        $data['parent'] = '0';
        $data['type'] = 'category';
        /* if($data['mid']!='32' && isset($data['proj_group_id']))
          {
          unset($data['proj_group_id']);
          } */
        $selectEnroll = select_mongo('enrollments', $data);
        $selectEnroll = add_id($selectEnroll);
        //echo "<pre>"; print_r($data); die;
        //echo "<pre>"; print_r($selectEnroll); die;
        $allEnrolled = array();

        $data['type'] = 'user';

        unset($data['parent']);
        //echo "<pre>"; print_r($data); die;
        $selectUsers = select_mongo('enrollments', $data);
        $selectUsers = add_id($selectUsers);
        
        //echo "<pre>"; print_r($selectUsers); die;
        if (sizeof($selectEnroll) > 0 || sizeof($selectUsers) > 0) {

            foreach ($selectEnroll as $enrolled) {
                $catIds = explode("|", $enrolled['categoryId']);
                $totalUsers = count_mongo('user', array('category' => array('$in' => $catIds), 'status' => array('$ne' => '10')));
                $enrolled['totalUsers'] = $totalUsers;
                array_push($allEnrolled, $enrolled);
            }
            $proj_sel_users = array();
            if (count($selectUsers)) {
                foreach ($selectUsers as $key => $value) {
                    if (isset($value['userId'])) {
                        $users_new = explode(",", $value['userId']);
                        $proj_sel_users = array_unique(array_merge($proj_sel_users, $users_new));
                    }
                }
            }
            //echo "<pre>"; print_r($proj_sel_users); die;
            if (isset($selectUsers[0]['proj_roles']) && is_array($selectUsers[0]['proj_roles']) && count($selectUsers[0]['proj_roles'])) {

                $proj_roles = $selectUsers[0]['proj_roles'];
            } else {
                $proj_roles = array();
            }

            $a = array('success' => 'true', 'data' => array('category' => $allEnrolled, 'users' => $selectUsers[0]['users'], 'proj_ass_users' => $proj_sel_users, 'users_proj_roles' => $proj_roles), 'error_code' => '98');
            //echo "<pre>"; print_r($a); die;
            return $a;
        } else {
            return array('success' => 'false', 'data' => '', 'error_code' => '97');
        }
    } else {
        return $check;
    }
}

/* function get_enrolled($data)
  {
  logger(1,'',$data,5);
  $check=check_key_available($data,array('itemId','mid','smid'));
  if($check['success']=='true')
  {
  $data['parent']='0';
  $data['type']='category';
  $selectEnroll=select_mongo('enrollments',$data);
  $selectEnroll=add_id($selectEnroll);

  $allEnrolled=array();

  $data['type']='user';

  unset($data['parent']);
  $selectUsers=select_mongo('enrollments',$data);
  $selectUsers=add_id($selectUsers);


  if(sizeof($selectEnroll)>0 || sizeof($selectUsers)>0)
  {

  foreach($selectEnroll as $enrolled)
  {
  $catIds=explode("|",$enrolled['categoryId']);
  $users=get_multiple_category_users($catIds);
  $totalUsers='';
  $enrolled['totalUsers']=sizeof($users);
  array_push($allEnrolled,$enrolled);
  }



  return array('success'=>'true','data'=>array('category'=>$allEnrolled,'users'=>$selectUsers[0]['users']),'error_code'=>'98');
  }
  else
  {
  return array('success'=>'false','data'=>'','error_code'=>'97');
  }
  }
  else
  {
  return $check;
  }
  } */

function get_multiple_category_users($category_ids) {
    logger("1", $category_ids, "", 5, "/get_multiple_category_users");
    $allArray = array();
    foreach ($category_ids as $andoperation) {
        if (isset($andoperation)) {
            array_push($allArray, array('category' => array('$exists' => true, '$in' => explode(",", $andoperation))));
        }
    }
    $newArray = array('$and' => $allArray);
    $getMan = select_mongo('user', $newArray, array('email'));
    $getMan = add_id($getMan, "id");
    return $getMan;
}

function delete_category_enrolled_to_item($data) {
    logger("1", $data, "", 5, "/delete_category_enrolled_to_item");
    $check = check_key_available($data, array('id', 'itemId', 'mid', 'smid'));
    if ($check['success'] == 'true') {
        $usersBefore = get_all_users_enrolled_to_item(array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid']));

        $deleteCats = delete_mongo('enrollments', array('$or' => array(array('_id' => new MongoId($data['id'])), array('parent' => $data['id']))));

        $usersNow = get_all_users_enrolled_to_item(array('itemId' => $data['itemId'], 'mid' => $data['mid'], 'smid' => $data['smid']));
        notifyUsers($usersBefore, $usersNow, 'category_deleted');
        return array('success' => 'true', 'data' => '', 'error_code' => '81');
    } else {
        return $check;
    }
}

function get_items_enrolled($data) {
    logger("1", $data, "", 5, "/get_items_enrolled");
    $check = check_key_available($data, array('userId', 'mid', 'smid'));
    if ($check['success'] == 'true') {
        $fromUsersEnrolled = array();
        $query = array('users' => array('$exists' => true, '$in' => explode("|", $data['userId'])), 'mid' => $data['mid'], 'smid' => $data['smid']);
        if (isset($data['proj_group_id']) != '') {
            $query['proj_group_id'] = $data['proj_group_id'];
        }
        $getFromUsersEnrolled = select_mongo('enrollments', $query, array('itemId'));
        $getFromUsersEnrolled = add_id($getFromUsersEnrolled);
        if (sizeof($getFromUsersEnrolled)) {
            foreach ($getFromUsersEnrolled as $users) {
                array_push($fromUsersEnrolled, $users['itemId']);
            }
        }


        $getUserCategory = select_mongo('user', array('_id' => new MongoId($data['userId']), 'mid' => $data['mid'], 'smid' => $data['smid']), array('category'));
        $getUserCategory = add_id($getUserCategory);
        if (!empty($getUserCategory)) {
            $getUserCategory = $getUserCategory[0]['category'];
        }
        $fromCategoriesEnrolled = array();
        if (sizeof($getUserCategory) > 0) {
            $getFromCategoriesEnrolled = select_mongo('enrollments', array('categoryId' => array('$exists' => true, '$in' => $getUserCategory), 'mid' => $data['mid'], 'smid' => $data['smid']), array('itemId'));
            $getFromCategoriesEnrolled = add_id($getFromCategoriesEnrolled);
            if (sizeof($getFromCategoriesEnrolled)) {
                foreach ($getFromCategoriesEnrolled as $cusers) {
                    array_push($fromCategoriesEnrolled, $cusers['itemId']);
                }
            }
        }

        $allItemsEnrolled = array_values(array_unique(array_merge($fromCategoriesEnrolled, $fromUsersEnrolled)));
        return array('success' => 'true', 'data' => $allItemsEnrolled, 'error_code' => '82');
    } else {
        return $check;
    }
}

function update_category_child($data) {
    logger("1", $data, "", 5, "/update_category_child");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $delete = delete_mongo('category', array("_id" => new MongoId($data['id'])));
        if ($delete['n'] == '1') {

            $res = update_mongo('category', array('parent_id' => '0'), array('parent_id' => $data['id']));
            //$notifyData=insert_notification(array('customerId'=>'43','mid'=>'1','smid'=>'1','userId'=>'0','itemId'=>$data['id'],'eid'=>"123",'extra'=>json_encode($data))); 
            return array('data' => $data['id'], 'error_code' => '1005', 'success' => 'true');
        } else {
            return array('data' => $data['id'], 'error_code' => '1006', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_user_category_manager($data) {
    logger("1", $data, "", 5, "/get_user_category_manager");

    $check = check_key_available($data, array('category_ids'));
    if ($check['success'] == 'true') {
        $categories = '';
        $catids = explode("|", $data['category_ids']);

        foreach ($catids as $catid) {
            if ($catid) {
                $catid = new MongoId($catid);
                $tmp = select_mongo('category', array('_id' => $catid), array('title1'));
                $data = add_id($tmp, "id");
                $categories .= $data[0]['title1'] . " | ";
            }
        }
        $allCategory = substr($categories, 0, -3);
        if ($allCategory) {
            return array('data' => $allCategory, 'error_code' => '1007', 'success' => 'true');
        } else {
            return array('data' => '', 'error_code' => '1008', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_user_by_category_manager($data) {

    logger("1", $data, "", 5, "/get_user_by_category_manager");
    if ($data['category_ids']) {
        $where = array('category' => array('$exists' => true, '$in' => $data['category_ids']));
        $tmp = select_mongo('user', $where);
        $return = add_id($tmp, "id");
        return array('data' => $return, 'error_code' => '1013', 'success' => 'true');
    }
}

function update_user_last_activity($data) {
    logger("1", $data, "", 5, "/update_user_last_activity");
    $id = $data['id'];
    unset($data['id']);
    if (sizeof($data)) {
        $ret = update_mongo('user', $data, array('_id' => new MongoId($id)));
    }
}

function get_user_info_by_id($data) {
    logger("1", $data, "", 5, "/get_user_info_by_id");
    $fields = array();
    $query = array();
    $query['status'] = array('$ne' => '10');
    if (isset($data['fields'])) {
        $fields = explode(",", $data['fields']);
    }
    //if(isset($data['status'])){ $query['status']=array('$ne'=>'10'); }
    if (isset($data['id']) && $data['id'] != "" && $data['id'] != "NULL") {
        if ($data['id'] != '0') {
            $user_id = explode("|", $data['id']);
            $userIds = array();
            foreach ($user_id as $uid) {
                if (MongoId::isValid($uid)) {
                    array_push($userIds, new MongoId($uid));
                }
            }
            $query['_id'] = array('$in' => $userIds);
            $tmp = select_mongo('user', $query, $fields);
        } else {
            $tmp = select_mongo('user', $query, $fields);
        }

        $return = add_id($tmp, "id");
        if (isset($return[0])) {
            $alldata = array();
            foreach ($return as $ret) {
                array_push($alldata, $ret);
            }
            return array('data' => $alldata, 'error_code' => '1013', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1014', 'success' => 'false');
        }
    } else {
        return array('data' => $data, 'error_code' => '1014', 'success' => 'false');
    }
}

function get_user_associate_item_list($data) {
    global $db;
    logger("1", $data, "", 5, "/get_user_associate_item_list");
    $check = check_key_available($data, array('mid', 'smid'));
    if ($check['success'] == 'true') {
        $userId = array();
        if (isset($data['userId'])) {
            $userId = explode(',', $data['userId']);
        }

        if (!count($userId)) {
            $tmp = select_mongo('enrollments', array('mid' => $data['mid'], 'smid' => $data['smid']), array());
        } else if (isset($data['category'])) {
            $tmp = select_mongo('enrollments', array('mid' => $data['mid'], 'smid' => $data['smid'], 'users' => array('$in' => $userId)), array());
        } else {
            if (isset($data['itemId'])) {
                $tmp = select_mongo('enrollments', array('mid' => $data['mid'], 'itemId' => $data['itemId'], 'smid' => $data['smid'], 'users' => array('$in' => $userId)), array());
            } else {
                $tmp = select_mongo('enrollments', array('mid' => $data['mid'], 'smid' => $data['smid'], 'users' => array('$in' => $userId)), array());
            }
        }

        $return = add_id($tmp, "id");

        return array('data' => $return, 'error_code' => '1005', 'success' => 'true');
    } else {
        return $check;
    }
}

function get_all_parent_category($data) {
    // print_r($data);die;
    logger("1", $data, "", 5, "/get_all_parent_category");
    if (isset($data['id'])) {
        $cats = array();
        $ids = explode("|", $data['id']);
        foreach ($ids as $id) {
            $category_id = new MongoId($id);
            array_push($cats, $category_id);
        }
        $tmp = select_mongo('category', array('_id' => array('$in' => $cats)));
    } else if (isset($data['parent_id'])) {
        $tmp = select_mongo('category', array('parent_id' => $data['parent_id']));
    } else {
        $tmp = select_all_mongo('category');
    }
    $retrun = add_id($tmp, "id");
    if ($retrun[0]) {
        $alldata = array();
        foreach ($retrun as $ret) {
            $info = array();
            $info["id"] = $ret["id"];
            $info["p"] = $ret["parent_id"];
            $info["n"] = $ret["title1"];
            $info["l"] = $ret["lang"];
            $info["c"] = $ret["code"];
            if (isset($data['deviceType']) && $data['deviceType'] != "") {
                array_push($alldata, $info);
            } else {
                array_push($alldata, $ret);
            }
        }
        return array('data' => $alldata, 'error_code' => '1011', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1012', 'success' => 'false');
    }
}

function get_all_users($data) {
    logger("1", $data, "", 5, "/get_all_users");
    $fields = array();
    $query = array();
    $query['status'] = array('$ne' => '10');
    $query['user_type'] = array('$ne' => 'super admin');
    if (isset($data['fields'])) {
        $fields = explode(",", $data['fields']);
    }
    if (isset($data['id'])) {
        $uids = array();
        $ids = explode("|", $data['id']);
        foreach ($ids as $id) {
            $user_id = new MongoId($id);
            array_push($uids, $user_id);
        }
        $query['_id'] = array('$in' => $uids);
    }
    $tmp = select_mongo('user', $query, $fields);
    $return = add_id($tmp, "id");
    if (isset($return[0])) {
        $alldata = array();
        foreach ($return as $ret) {
            $info = array();
            $info["id"] = $ret["id"];
            $info["n"] = $ret["name"];
            $info["e"] = $ret["email"];
            $info["cat"] = $ret["category"];
            $info["desg"] = $ret["designation"];
            $info["dept"] = $ret["department"];
            $info["mg"] = $ret["manager"];
            if (isset($data['deviceType']) && $data['deviceType'] != "") {
                array_push($alldata, $info);
            } else {
                array_push($alldata, $ret);
            }
        }
        return array('data' => $alldata, 'error_code' => '1013', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '1014', 'success' => 'false');
    }
}

function manage_login_attempt_logs($data) {
    logger("1", $data, "", 5, "/manage_login_attempt_logs");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {
            unset($data['id']);
            $manage = insert_login_attempt_logs($data);
        } else {
            $manage = update_login_attempt_logs($data);
        }
        return $manage;
    } else {
        return $check;
    }
}

function insert_login_attempt_logs($data) {
    logger("1", $data, "", 5, "/insert_login_attempt_logs");
    $data['_id'] = new MongoId();
    $data['lastAttempt'] = new MongoDate();
    $success = insert_mongo('loginAttempt', $data);
    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};
        return array('data' => $id, 'error_code' => '16010', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '16011', 'success' => 'false');
    }
}

function update_login_attempt_logs($data) {
    logger("1", $data, "", 5, "/update_login_attempt_logs");
    $id = $data['id'];
    unset($data['id']);
    $data['lastAttempt'] = new MongoDate();
    $success = update_mongo('loginAttempt', $data, array('email' => $data['email']));
    if ($success['n'] == '1') {
        return array('data' => $data['email'], 'error_code' => '16012', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '16013', 'success' => 'false');
    }
}

function get_login_attempt_logs($data) {
    // print_r($data);die;
    logger("1", $data, "", 5, "/get_login_attempt_logs");
    if (isset($data['id'])) {
        $cats = array();
        $ids = explode("|", $data['id']);
        foreach ($ids as $id) {
            $category_id = new MongoId($id);
            array_push($cats, $category_id);
        }
        $tmp = select_mongo('loginAttempt', array('_id' => array('$in' => $cats)));
    } else if (isset($data['email'])) {
        $tmp = select_mongo('loginAttempt', array('email' => $data['email']));
    } else {
        $tmp = select_all_mongo('loginAttempt');
    }
    $retrun = add_id($tmp, "id");
    if ($retrun[0]) {
        $alldata = array();
        foreach ($retrun as $ret) {
            array_push($alldata, $ret);
        }
        return array('data' => $alldata, 'error_code' => '16014', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '16015', 'success' => 'false');
    }
}

function delete_login_attempt_logs($data) {
    logger("1", $data, "", 5, "/delete_login_attempt_logs");
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') {
        $delete = delete_mongo('loginAttempt', array("userId" => $data['userId']));
        if ($delete['n'] == '0') {
            return array('data' => $data['userId'], 'error_code' => '16016', 'success' => 'false');
        } else {
            return array('data' => $data['userId'], 'error_code' => '16017', 'success' => 'true');
        }
    } else {
        return $check;
    }
}

function manage_login_details($data) {
    logger("1", $data, "", 5, "/manage_login_details");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {
            unset($data['id']);
            $manage = insert_login_details($data);
        }
        return $manage;
    } else {
        return $check;
    }
}

function insert_login_details($data) {
    logger("1", $data, "", 5, "/insert_login_details");
    $data['_id'] = new MongoId();
    $data['lastAttempt'] = new MongoDate();
    $data['ipaddress'] = get_client_ip();
    $success = insert_mongo('loginDetails', $data);
    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};
        return array('data' => $id, 'error_code' => '16018', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '16019', 'success' => 'false');
    }
}

function get_login_details($data) {
    // print_r($data);die;
    logger("1", $data, "", 5, "/get_login_details");
    if (isset($data['id'])) {
        $cats = array();
        $ids = explode("|", $data['id']);
        foreach ($ids as $id) {
            $category_id = new MongoId($id);
            array_push($cats, $category_id);
        }
        $tmp = select_mongo('loginDetails', array('_id' => array('$in' => $cats)));
    } else if (isset($data['email'])) {
        $condition = array();
        $sortcond = array();
        $params = array();
        $sortcond['lastAttempt'] = -1;
        $index = "0";
        $nrecords = "1";
        if (isset($data['fields'])) {
            $params = explode(",", $data['fields']);
        }
        if (isset($data['index'])) {
            $index = $data['index'];
        }
        if (isset($data['nrecords'])) {
            $nrecords = $data['nrecords'];
        }
        $condition['email'] = $data['email'];
        $tmp = select_sort_limit_mongo('loginDetails', $condition, $params, $sortcond, $index, $nrecords);
        //$tmp = select_mongo('loginDetails',array('email'=>$data['email']));
    } else {
        $tmp = select_all_mongo('loginDetails');
    }
    $retrun = add_id($tmp, "id");
    if ($retrun[0]) {
        $alldata = array();
        foreach ($retrun as $ret) {
            array_push($alldata, $ret);
        }
        return array('data' => $alldata, 'error_code' => '16020', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '16021', 'success' => 'false');
    }
}

function get_urgency_data($data) {
    logger("1", $data, "", 5, "/get_urgency_data");
    $alluser = array();
    if (isset($data['id'])) {
        $query = "Select * from urgency_setting where id='" . $data['id'] . "'";
    } else {
        $query = "Select * from urgency_setting";
    }

    $get_data = mysql_query($query);
    if (mysql_num_rows($get_data) > 0) {
        while ($fetch = mysql_fetch_array($get_data)) {
            $info = array();
            if (isset($data['deviceType'])) {
                $info['id'] = $fetch['id'];
                $info['name'] = $fetch['type'];
                array_push($alluser, $info);
            } else {
                array_push($alluser, $fetch);
            }
        }
        return array('data' => $alluser, 'error_code' => '16025', 'success' => 'true');
    } else {
        return array('data' => "", 'error_code' => '16026', 'success' => 'false');
    }
}

function insert_failed_login_data($data) {

    logger("1", $data, "", 5, "/insert_failed_login_data");
    $ip = get_client_ip();
    $table = "failed_login";
    $fields = array();
    $fields['ip_address'] = $ip;
    $fields['date'] = date("Y-m-d H:i:s", time());
    $success = insert_mysql($fields, $table);
    return array('data' => "", 'error_code' => '16023', 'success' => 'true');
}

function delete_failed_login_data($data) {
    logger("1", $data, "", 5, "/delete_failed_login_data");
    $ip = get_client_ip();
    $table = "failed_login";
    $condition = "ip_address = '$ip'";
    $success = delete_mysql($table, $condition);
    return array('data' => "", 'error_code' => '16024', 'success' => 'true');
}

function get_failed_login_data($data) {
    logger("1", $data, "", 5, "/get_failed_login_data");
    $ip = get_client_ip();
    $table = "failed_login WHERE ip_address = '$ip'  AND date BETWEEN DATE_SUB( NOW() , INTERVAL 1 DAY ) AND NOW()";
    $fields = "count(ip_address) AS failed_login_attempt";
    $success = Select_All($fields, $table);
    $fetch = mysqli_fetch_array($success);

    return array('data' => $fetch['failed_login_attempt'], 'error_code' => '16022', 'success' => 'true');
}

function get_min_max_data($data) {

    logger("1", $data, "", 5, "/get_min_max_data");
    global $db;
    $check = check_key_available($data, array('type'));
    if ($check['success'] == 'true') {
        $arr = array();
        $arr['status'] = array('$ne' => "10");
        if ($data['type'] == 'max') {
            $tmp = $db->user->find($arr, array())->sort(array('versionNo' => -1))->limit(1);
        } else if ($data['type'] == 'min') {
            $tmp = $db->user->find($arr, array())->sort(array('versionNo' => 1))->limit(1);
        }

        $return = add_id($tmp);
        if ($return[0]) {
            $alldata = $return[0];
            $versionNo = $alldata['versionNo'];
            return array('data' => $versionNo, 'error_code' => '16026', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '16027', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

//Nilesh Sahu
function manage_common_used_personnel($data) {

    logger("1", $data, "", 5, "/manage_common_used_personnel");
    $check = check_key_available($data, array('id', 'userIdTo', 'userIdFrom', 'name'));

    if ($check['success'] == 'true') {
        switch ($data['id']) {
            case "0":
                $manage = add_common_used_personnel($data);
                break;

            default:
                $manage = update_common_used_personnel($data);
                break;
        }
        return $manage;
    } else {
        return $check;
    }
}

function add_common_used_personnel($data) {
    global $companyId;
    logger("1", $data, "", 5, "/add_common_used_personnel");
    $data['lastUpdate'] = new MongoDate();
    $data['createdOn'] = new MongoDate();
    unset($data['id']);
    $data['_id'] = new MongoId();
    $res = insert_mongo('common_used_personnel', $data);
    if ($res['n'] == 1) {
        return array("success" => "false", "data" => $data, "error_code" => "1061");
    } else {
        $ins_id = db_id($data);

        insert_notification(array('customerId' => $companyId, 'mid' => "1", 'smid' => "1", 'userId' => $data['userIdTo'], 'itemId' => $ins_id . "|" . $data['userIdFrom'], 'eid' => "137", "extra" => json_encode($data)));
        insert_notification(array('customerId' => $companyId, 'mid' => "1", 'smid' => "1", 'userId' => $data['userIdFrom'], 'itemId' => $ins_id, 'eid' => "137", "extra" => json_encode($data)));
        return array("success" => "true", "data" => $ins_id, "error_code" => "1062");
    }
}

function update_common_used_personnel($data) {
    global $companyId;
    logger("1", $data, "", 5, "/update_common_used_personnel");
    $cond = array(
        '_id' => new MongoId($data['id'])
    );
    $data['lastUpdate'] = new MongoDate();
    $id = $data['id'];
    $userIdTo = $data['userIdTo'];
    $userIdFrom = $data['userIdFrom'];
    unset($data['userIdTo']);
    unset($data['userIdFrom']);
    unset($data['id']);
    $res = update_mongo('common_used_personnel', $data, $cond);
    if ($res['n'] == 0) {
        return array("success" => "false", "data" => $data, "error_code" => "1063");
    } else {

        insert_notification(array('customerId' => $companyId, 'mid' => "1", 'smid' => "1", 'userId' => $userIdTo, 'itemId' => $id . "|" . $userIdFrom, 'eid' => "138", "extra" => json_encode($data)));
        insert_notification(array('customerId' => $companyId, 'mid' => "1", 'smid' => "1", 'userId' => $userIdFrom, 'itemId' => $id, 'eid' => "138", "extra" => json_encode($data)));
        return array("success" => "true", "data" => $data, "error_code" => "1064");
    }
}

function delete_common_used_personnel($data) {
    global $companyId;
    logger("1", $data, "", 5, "/delete_common_used_personnel");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $id = explode("|", $data['id']);
        $delId = implode(",", $id);

        foreach ($id as $key => $val) {
            $id[$key] = new MongoId($val);
            $itemId = $val;
        }
        $condition = array('_id' => array('$in' => $id));

        $res = delete_mongo('common_used_personnel', $condition);

        //mysql_query("delete from item_table where item_id in('$delId')");
        if ($res['n'] == '0') {
            return array('data' => $data['id'], 'error_code' => '1065', 'success' => 'false');
        } else {
            insert_notification(array('customerId' => $companyId, 'mid' => "1", 'smid' => "1", 'userId' => $data['userId'], 'itemId' => $itemId, 'eid' => "139", "extra" => json_encode(array('time' => time()))));
            return array('data' => $data['id'], 'error_code' => '1066', 'success' => 'true');
        }
    } else {
        return $check;
    }
}

function get_common_used_personnel_by_id($data) {
    logger("1", $data, "", 5, "/get_common_used_personnel_by_id");
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

        if (isset($data['categoryId']) && $data['categoryId'] != 0) {
            $arr['categoryId'] = $data['categoryId'];
        }

        if (isset($data['userIdTo']) && $data['userIdTo'] != 0) {
            $arr['userIdTo'] = $data['userIdTo'];
        }

        if (isset($data['userIdFrom']) && $data['userIdFrom'] != 0) {
            $arr['userIdFrom'] = $data['userIdFrom'];
        }


        if (isset($data['timestamp'])) {
            $arr['lastUpdate'] = array('$gt' => new MongoDate($data['timestamp']));
        }


        if (isset($data['nor'])) {
            if (isset($data['index'])) {
                $res = select_sort_limit_mongo('common_used_personnel', $arr, array(), array('lastUpdate' => -1), $data['index'], $data['nor']);
            } else {
                $res = select_sort_limitonly_mongo('common_used_personnel', $arr, array(), array('lastUpdate' => -1), $data['nor']);
            }
        } else {
            $res = select_sort_mongo('common_used_personnel', $arr, array(), array('lastUpdate' => -1));
        }

        $res = add_id($res, "id");


        return array("success" => "true", "data" => $res, "error_code" => "100");
    } else {
        return $check;
    }
}

// end


function register_confirmation($data) {
    logger("1", $data, "", 5, "/register_confirmation");
    $check = check_key_available($data, array('email', 'rKey'));
    if ($check['success'] == 'true') {
        $tmp = select_mongo('user', array("email" => "$data[email]", "rKey" => "$data[rKey]"));
        $return = add_id($tmp);
        if ($return[0]) {
            $alldata = $return[0];
            $userId = $alldata['id'];
            $arr = array();
            $arr['id'] = $userId;
            $arr['status'] = "1";
            $arr['rKey'] = "";
            $activity = update_user_last_activity($arr);
            $result = get_resource_by_id(array('id' => $userId));
            if ($data['deviceType'] == "android") {
                return array('data' => $result["data"][0], 'error_code' => '1320', 'success' => 'true');
            } else {
                return $result;
            }
        } else {
            return array('data' => $data, 'error_code' => '1302', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function forgot_password_confirmation($data) {
    logger("1", $data, "", 5, "/forgot_password_confirmation");
    $check = check_key_available($data, array('email', 'forgotKey'));
    if ($check['success'] == 'true') {
        $tmp = select_mongo('user', array("email" => "$data[email]", "forgotKey" => "$data[forgotKey]"));
        $return = add_id($tmp);
        if ($return[0]) {
            $alldata = $return[0];
            $userId = $alldata['id'];
            $arr = array();
            $arr['id'] = $userId;
            $arr['forgotKey'] = "";
            $activity = update_user_last_activity($arr);
            return array('data' => $userId, 'error_code' => '1303', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1304', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function forgot_password_recoveryOld($data) {
    logger("1", $data, "", 5, "/forgot_password_recoveryOld");
    $check = check_key_available($data, array('email'));
    if ($check['success'] == 'true') {
        $tmp = select_mongo('user', array("email" => "$data[email]"));
        $return = add_id($tmp);
        if ($return[0]) {
            $alldata = $return[0];
            $userId = $alldata['id'];
            $arr = array();
            $arr['id'] = $userId;
            //$arr['forgotKey']=substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',500)),0,6);
            $arr['forgotKey'] = '123';
            $activity = update_user_last_activity($arr);
            $message = "     
                  Hello " . $alldata['name'] . ",
                  <br /><br />
                  Welcome to NewHit!<br/>
                  To reset your  password please , use below code for password reset.<br/>
                  <br /><br />
                  Code: " . $arr['forgotKey'] . "
                  <br /><br />
                  Thanks,";
            $subject = "Forgot Password";
            $mail = sendEmailToUser(array("email" => $data['email'], "message" => $message, "subject" => $subject, "account" => array()));
            //print_r($mail);die;
            return array('data' => $userId, 'error_code' => '1305', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1306', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function forgot_password_recovery($data) {
    global $companyId;
    logger("1", $data, "", 5, "/forgot_password_recovery");
    $check = check_key_available($data, array('email'));
    if ($check['success'] == 'true') {
        $tmp = select_mongo('user', array("email" => "$data[email]"));
        $return = add_id($tmp);
        if ($return[0]) {
            $alldata = $return[0];
            if ($alldata['status'] == '1') {
                $userId = $alldata['id'];
                $salt = rand();
                $code = hash('sha512', $salt . $data["email"]);
                $eid = '3';
                if (isset($data['eid']) && !empty($data['eid'])) {
                    $eid = $data['eid'];
                }
                $checkStatus = insert_notification(array('customerId' => $companyId, 'mid' => "1", 'smid' => "1", 'userId' => $userId, 'itemId' => '', 'eid' => $eid, 'extra' => json_encode(array('code' => $code))));
                //print_r($checkStatus);
                $userUpdate = manage_user(array('id' => $userId, 'forgotKey' => $code));
                return array('data' => "", 'error_code' => '1305', 'success' => 'true');
            } else {
                return array('data' => $data, 'error_code' => '1798', 'success' => 'false');
            }
        } else {
            return array('data' => $data, 'error_code' => '1306', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function update_urgency_data($data) {
    logger("1", $data, "", 5, "/update_urgency_data");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $conditions = "id='$data[id]'";
        $updateInfo = update_mysql(array('type' => $data['type'], 'no_of_notification' => $data['no_of_notification'], 'notification_send_after_time' => $data['notification_send_after_time']), 'urgency_setting', $conditions);
        if ($updateInfo['success'] == 'true') {
            return array("data" => "", "success" => "true", "error_code" => "16030");
        } else {
            return array("data" => $data, "success" => "false", "error_code" => "16031");
        }
    } else {
        return $check;
    }
}

function manage_languages($data) {
    logger("1", $data, "", 5, "/manage_languages");
    $data['lastUpdate'] = new MongoDate();
    $check = check_key_available($data, array('stringId', 'id', 'code', 'title'));
    if ($check['success'] == 'true') {
        if ($data['id'] == "" || $data['id'] == '0') {
            unset($data['id']);
            $manage = insert_language($data);
        } else {
            $manage = update_language($data);
        }
        return $manage;
    } else {
        return $check;
    }
}

function get_languages($data) {
    logger("1", $data, "", 5, "/get_languages");
    $where = array();
    if (isset($data['code'])) {
        $code = explode("|", $data['code']);
        $where['code'] = array('$in' => $code);
    }
    if (isset($data['stringId'])) {
        $stringId = explode("|", $data['stringId']);
        $where['stringId'] = array('$in' => $stringId);
    }
    $tmp = select_mongo('languages', $where);
    $return = add_id($tmp, "id");
    if ($return[0]) {
        $alldata = array();
        foreach ($return as $ret) {
            if (isset($data['deviceType'])) {
                $newArr = array();
                $newArr['id'] = $ret['code'];
                $newArr['string'] = $ret['title'];
                array_push($alldata, $newArr);
            } else {
                array_push($alldata, $ret);
            }
        }
        return array('data' => $alldata, 'error_code' => '16033', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '16040', 'success' => 'false');
    }
}

function insert_language($data) {
    logger("1", $data, "", 5, "/insert_language");
    $data['_id'] = new MongoId();
    $success = insert_mongo('languages', $data);
    if ($success['n'] == '0') {
        $id = $data['_id']->{'$id'};

        return array('data' => $id, 'error_code' => '16034', 'success' => 'true');
    } else {
        return array('data' => $data, 'error_code' => '16035', 'success' => 'false');
    }
}

function update_language($data) {
    logger("1", $data, "", 5, "/update_language");
    $id = $data['id'];
    unset($data['id']);
    $success = update_mongo('languages', $data, array('_id' => new MongoId($id)));
    if ($success['n'] == '1') {

        return array('data' => $id, 'error_code' => '16036', 'success' => 'true');
    } else {
        return array('data' => $id, 'error_code' => '16037', 'success' => 'false');
    }
}

function delete_languages($data) {

    logger("1", $data, "", 5, "/delete_languages");
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {
        $delete = delete_mongo('languages', array("_id" => new MongoId($data['id'])));
        if ($delete['n'] == '0') {

            return array('data' => $data['id'], 'error_code' => '16038', 'success' => 'false');
        } else {

            return array('data' => $data['id'], 'error_code' => '16039', 'success' => 'true');
        }
    } else {
        return $check;
    }
}

function google_sso_login($data) {
    logger("1", $data, "", 5, "/google_sso_login");
    $check = check_key_available($data, array('googleID', 'accessToken'));
    if ($check['success'] == 'true') {

        $query = array("googleID" => "$data[googleID]");
        $tmp = select_mongo('user', $query);
        $return = add_id($tmp);
        //print_r($return);die;
        if (isset($return[0])) {
            $alldata = array();
            $alldata = $return[0];
            $cdate = '';
            $arr = array();
            $arr['id'] = $alldata['id'];
            $arr['accessToken'] = $data['accessToken'];
            $arr['status'] = '1';
            if (isset($data['gcm'])) {
                $arr['gcm'] = $data['gcm'];
                $alldata['gcm'] = $data['gcm'];
            }
            if (isset($data['deviceId'])) {
                $arr['deviceId'] = $data['deviceId'];
                $alldata['deviceId'] = $data['deviceId'];
            }
            if (isset($data['deviceType'])) {
                $arr['deviceType'] = $data['deviceType'];
                $alldata['deviceType'] = $data['deviceType'];
            }
            $role = $alldata['role'];
            unset($alldata['role']);
            $permission = array();
            if (!empty($role)) {
                $role_id = explode(",", $role);
                foreach ($role_id as $v) {
                    $get_roles = get_roles(array('id' => $v));
                    $get_roles = $get_roles['data'];

                    foreach ($get_roles as $key => $obj) {
                        $nat = json_decode($obj['permission'], true);
                        foreach ($nat as $key1 => $obj1) {
                            $permission[$key1] = $obj1;
                        }
                    }
                }
            }
            $alldata['role'] = json_encode($permission);
            $activity = update_user_last_activity($arr);
            manage_login_details(array('id' => '0', 'email' => '', 'googleID' => $data['googleID'], 'password' => '', 'loginStatus' => 'google sso active'));

            if ($data['deviceType'] == "ios" || $data['deviceType'] == "android") {
                if (isset($alldata['role']) && $alldata['role'] != "" && $alldata['role'] != "null") {
                    if (($data['deviceId'] != $alldata['deviceId']) && $alldata['deviceId'] != '') {
                        $pushObject = new Json();
                        $messageData = array("sid" => '71', "mid" => '1', "smid" => '1', "eid" => '71', "u1" => $alldata['id'], "u2" => "", "u3" => "", "u4" => "", "u5" => "", "t" => 'Logged in to new device', "ms" => 'Logged in to new device', "cdata" => array());

                        $sendPush = $pushObject->send_push(array($alldata['gcm']), $messageData, true);
                        $alldata['push'] = json_decode($sendPush, true);
                    }
                    $activity = update_user_last_activity($arr);
                    $tmp_role = json_decode($permission, true);
                    $mr1 = array();
                    $newArr = array();
                    $moduledata = get_modules_by_id(array('mid' => "0", 'status' => "0"));
                    if (isset($moduledata['data'])) {
                        //print_r($moduledata['data']);die;
                        foreach ($moduledata['data'] as $mo) {
                            array_push($newArr, $mo['mval']);
                        }
                    }
                    foreach ($permission as $key => $val) {
                        if (in_array($key, $newArr)) {
                            unset($permission[$key]);
                        }
                    }
                    foreach ($permission as $key => $val) {
                        $tmr1 = array();
                        $mid = get_module_by_name(trim($key));
                        $tmr1['id'] = $mid;
                        $tmr1['nm'] = $key;
                        $sm = array();
                        $tm = 1;
                        foreach ($val as $key1 => $val1) {
                            if (isset($val1)) {
                                $tsm = array();
                                $smmid = get_submodule_id(array("mid" => "$mid", "sname" => "$key1"));
                                if (isset($smmid['success']) != 'false') {
                                    $smmtitle = get_submodule_title_by_id(array("mid" => "$mid", "sname" => "$key1"));

                                    $tsm['id'] = $smmid;
                                    $tsm['nm'] = $key1;
                                    $tsm['title'] = $smmtitle;
                                    $tsm['permission'] = $val1;
                                    array_push($sm, $tsm);
                                }
                            }
                        }
                        $tmr1['submodule'] = $sm;
                        array_push($mr1, $tmr1);
                    }
                    $alldata['role'] = json_encode($mr1);
                }
                $cdata = array("logo" => "http://192.168.0.165/teammerge/ui/assets/img/logo_pyk.png", "module" => "1,2,3,4,5,6,7,8,9", "cid" => "565ee2c89c76841409000000");
                //$cdata["media_url"]=ui_media_url();

                $alldata['cdata'] = $cdata;
                unset($alldata['role_result']);
                unset($alldata['profile_picture']);
            }
            return array('data' => $alldata, 'error_code' => '1690', 'success' => 'true');
        } else {
            manage_login_details(array('id' => '0', 'email' => '', 'googleID' => $data['googleID'], 'password' => '', 'loginStatus' => 'google sso  error'));
            return array('data' => "", 'error_code' => '1691', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function google_sso_loginOld($data) {
    logger("1", $data, "", 5, "/google_sso_loginOld");
    $check = check_key_available($data, array('googleID', 'accessToken'));
    if ($check['success'] == 'true') {

        if (check_googleId_exists($data['googleID']) || check_email_exists($data['googleID'])) {

            $arr = array();
            $arr['accessToken'] = $data['accessToken'];
            $arr['username'] = $data['googleID'];
            $arr['googleID'] = $data['googleID'];
            $arr['email'] = $data['googleID'];
            $arr['status'] = '1';

            if (isset($data['gcm'])) {
                $arr['gcm'] = $data['gcm'];
            }
            if (isset($data['deviceId'])) {
                $arr['deviceId'] = $data['deviceId'];
            }
            if (isset($data['deviceType'])) {
                $arr['deviceType'] = $data['deviceType'];
            }

            if (isset($data['name'])) {
                $arr['name'] = $data['name'];
            }

            $userIdInfo = get_id_by_google_sso(array('googleID' => $data['googleID']));
            $arr['id'] = $userIdInfo['data']['id'];
            $update = update_user($arr);
            $userInfo = manage_google_sso($data);
            return $userInfo;
        } else {
            $name = "";
            if (isset($data['name'])) {
                $name = $data['name'];
            }
            $data['password'] = '';
            $data['category'] = '';
            $data['role'] = '';
            $data['role_result'] = '';
            $data['status'] = '1';
            $data['username'] = $data['googleID'];
            $data['email'] = $data['googleID'];
            $data['name'] = $name;
            $userData = insert_user($data);
            $userInfo = manage_google_sso($data);
            return $userInfo;
        }
    } else {
        return $check;
    }
}

function check_googleId_exists($googleID) {
    logger("1", $googleID, "", 5, "/check_googleId_exists");
    $tmp = select_mongo('user', array('googleID' => $googleID));
    $retrun = add_id($tmp, "id");
    if (count($retrun) > 0) {
        return true;
    }
    return false;
}

function manage_google_sso($data) {
    logger("1", $data, "", 5, "/manage_google_sso");
    $check = check_key_available($data, array('googleID'));
    if ($check['success'] == 'true') {

        $query = array('$or' => array(array("googleID" => "$data[googleID]"), array("email" => "$data[googleID]")));
        $tmp = select_mongo('user', $query);
        $return = add_id($tmp);
        //print_r($return);die;
        if (isset($return[0])) {
            $alldata = array();
            $alldata = $return[0];
            $cdate = '';

            manage_login_details(array('id' => '0', 'email' => $data['googleID'], 'googleID' => $data['googleID'], 'password' => '', 'loginStatus' => 'active'));
            if ($data['deviceType'] == "ios" || $data['deviceType'] == "android") {

                if (isset($alldata['role']) && $alldata['role'] != "" && $alldata['role'] != "null") {
                    if (($data['deviceId'] != $alldata['deviceId']) && $alldata['deviceId'] != '') {
                        $pushObject = new Json();
                        $messageData = array("sid" => '71', "mid" => '1', "smid" => '1', "eid" => '71', "u1" => $alldata['id'], "u2" => "", "u3" => "", "u4" => "", "u5" => "", "t" => 'Logged in to new device', "ms" => 'Logged in to new device', "cdata" => array());

                        $sendPush = $pushObject->send_push(array($alldata['gcm']), $messageData, true);
                        $alldata['push'] = json_decode($sendPush, true);
                    }
                    $tmp_role = json_decode($alldata['role'], true);
                    $mr1 = array();
                    $newArr = array();
                    $moduledata = get_modules_by_id(array('mid' => "0", 'status' => "0"));

                    if (isset($moduledata['data'])) {
                        //print_r($moduledata['data']);die;
                        foreach ($moduledata['data'] as $mo) {
                            array_push($newArr, $mo['mval']);
                        }
                    }

                    foreach ($tmp_role as $key => $val) {
                        if (in_array($key, $newArr)) {
                            unset($tmp_role[$key]);
                        }
                    }

                    foreach ($tmp_role as $key => $val) {
                        $tmr1 = array();
                        $mid = get_module_by_name(trim($key));
                        $tmr1['id'] = $mid;
                        $tmr1['nm'] = $key;
                        $sm = array();
                        $tm = 1;

                        foreach ($val as $key1 => $val1) {
                            if (isset($val1)) {
                                $tsm = array();
                                $smmid = get_submodule_id(array("mid" => "$mid", "sname" => "$key1"));
                                if (isset($smmid['success']) != 'false') {
                                    $smmtitle = get_submodule_title_by_id(array("mid" => "$mid", "sname" => "$key1"));

                                    $tsm['id'] = $smmid;
                                    $tsm['nm'] = $key1;
                                    $tsm['title'] = $smmtitle;
                                    $tsm['permission'] = $val1;
                                    array_push($sm, $tsm);
                                }
                            }
                        }
                        $tmr1['submodule'] = $sm;
                        array_push($mr1, $tmr1);
                    }
                    $alldata['role'] = json_encode($mr1);
                } else {
                    $alldata['role'] = "";
                }

                $cdata = array("logo" => "http://192.168.0.165/teammerge/ui/assets/img/logo_pyk.png", "module" => "1,2,3,4,5,6,7,8,9", "cid" => "565ee2c89c76841409000000");
                //$cdata["media_url"]=ui_media_url();

                $alldata['cdata'] = $cdata;
                unset($alldata['role_result']);
                unset($alldata['profile_picture']);
            }
            return array('data' => $alldata, 'error_code' => '1035', 'success' => 'true');
        } else {
            manage_login_details(array('id' => '0', 'email' => $data['googleID'], 'googleID' => $data['googleID'], 'password' => '', 'loginStatus' => 'googleID error'));
            return array('data' => "", 'error_code' => '1036', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function get_id_by_google_sso($data) {
    logger("1", $data, "", 5, "/get_id_by_google_sso");
    $query = array('$or' => array(array("googleID" => "$data[googleID]"), array("email" => "$data[googleID]")));
    $tmp = select_mongo('user', $query);
    $return = add_id($tmp);
    if (isset($return[0])) {
        $alldata = array();
        $alldata = $return[0];
        return array('data' => $alldata, 'error_code' => '1035', 'success' => 'true');
    } else {
        return array('data' => "", 'error_code' => '1036', 'success' => 'false');
    }
}

function user_logout($data) {
    logger("1", $data, "", 5, "/user_logout");
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') {
        $id = $data['userId'];
        unset($data['userId']);
        $data['uploadedOn'] = new MongoDate();
        $data['gcm'] = "";
        $data['deviceId'] = "";
        $data['deviceType'] = "";
        $ret = update_mongo('user', $data, array('_id' => new MongoId($id)));
        if ($ret['n'] == '1') {
            return array('data' => $id, 'error_code' => '1692', 'success' => 'true');
        } else {
            return array('data' => $data, 'error_code' => '1693', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

function check_parent_category_code_fields($data) {
    logger("1", $data, "", 5, "/check_parent_category_code_fields");
    $query['_id'] = array('$ne' => new MongoId($data['id']));
    $query['code'] = $data['code'];
    $query['parent_id'] = $data['parent_id'];
    $tmp = select_mongo('category', $query, array('code'));
    $return = add_id($tmp);
    if (isset($return[0])) {
        $alldata = array();
        foreach ($return as $ret) {
            array_push($alldata, $ret);
        }
        if (sizeof($alldata) > 0) {
            return array('data' => $alldata, 'error_code' => '117', 'success' => 'false');
        } else {
            return array('data' => "", 'error_code' => '100', 'success' => 'true');
        }
    } else {
        return array('data' => "", 'error_code' => '100', 'success' => 'true');
    }
}

function check_userid_exists($data) {
    logger("1", $data, "", 5, "/check_userid_exists");
    if (MongoId::isValid($data['userId'])) {
        $tmp = select_mongo('user', array('_id' => new MongoId($data['userId'])));
        $retrun = add_id($tmp);
        if (count($retrun) > 0) {
            return array('data' => '', 'error_code' => '1035', 'success' => 'true');
        } else {
            return array('data' => '', 'error_code' => '1036', 'success' => 'false');
        }
    } else {
        return array('data' => '', 'error_code' => '1036', 'success' => 'false');
    }
}

function check_emailid_exists($data) {
    logger("1", $data, "", 5, "/check_emailid_exists");
    $tmp = select_mongo('user', array('email' => $data['email']));
    $retrun = add_id($tmp);

    if (count($retrun) > 0) {
        return array('data' => '', 'error_code' => '1036', 'success' => 'false');
    } else {
        return array('data' => '', 'error_code' => '1035', 'success' => 'true');
    }
}

function check_image_exists($data) {
    logger("1", $data, "", 5, "/check_image_exists");

    $file = server_path() . 'company/9/uploads/import_image/' . $data['filename'] . '/' . $data['image_name'];
    if (file_exists($file)) {
        return array('data' => $file, 'error_code' => '1035', 'success' => 'true');
    } else {
        return array('data' => $file, 'error_code' => '1036', 'success' => 'false');
    }
}

function check_image_exists_old($data) {
    logger("1", $data, "", 5, "/check_image_exists_old");
    $file = server_path() . '/uploads/import_image/' . $data['image_name'];
    echo $url = site_url() . 'uploads/import_image/' . $data['image_name'];
    $tmp = file_get_contents($url);
    $array = explode('.', $data['image_name']);
    $ext = end($array);
    print_r($ext);
    if (file_exists($file)) {
        return array('data' => $file, 'error_code' => '1035', 'success' => 'true');
    } else {
        return array('data' => $file, 'error_code' => '1036', 'success' => 'false');
    }
}

function get_user_hirarchy($data) {
    logger("1", $data, "", 5, "/get_user_hirarchy");
    $check = check_key_available($data, array('userId'));
    if ($check['success'] == 'true') {
        $mongoObject = false;
        $object = false;
        if (isset($data['mongoObject']) == 'true') {
            $mongoObject = true;
            unset($data['mongoObject']);
        }
        if (isset($data['object']) == 'true') {
            $object = true;
            unset($data['object']);
        }
        $getUserData = get_resource_by_id(array('id' => $data['userId'], 'fields' => 'manager,role,user_type'));
        $getUserData = $getUserData['data'][0];

        if ($getUserData['user_type'] == 'super admin') {
            $checkApplyHirarchy = false;
        } else {

            $roles = explode(",", $getUserData['role']);
            $roleObject = array();
            foreach ($roles as $role) {
                array_push($roleObject, new MongoId($role));
            }
            $getRoles = select_mongo('role', array('_id' => array('$in' => $roleObject)), array('applyToHirarchy'));
            $getRoles = add_id($getRoles);
            $checkApplyHirarchy = false;
            foreach ($getRoles as $roles) {
                if ($roles['applyToHirarchy'] == '1') {
                    $checkApplyHirarchy = true;
                }
            }

            $categoryManager = array();
            foreach ($getUserData['manager'] as $manager) {
                if ($manager) {
                    array_push($categoryManager, $manager);
                }
            }

            $categoryIds = array();
            if (sizeof($categoryManager)) {
                foreach ($categoryManager as $categoryId) {
                    array_push($categoryIds, new MongoId($categoryId));
                }
                $getCategoryChilds = select_mongo('category', array('_id' => array('$in' => $categoryIds)), array('childs'));
                $getCategoryChilds = add_id($getCategoryChilds);
                $allChilds = array();
                foreach ($getCategoryChilds as $childs) {
                    array_push($allChilds, implode(",", $childs['childs']));
                }
                $allChilds = array_values(array_unique(explode(",", implode(",", $allChilds))));
                $categoryManager = array_merge($categoryManager, $allChilds);
            }
            /* else
              {
              return array('data'=>array(),'error_code'=>'100','success'=>'true');
              } */
        }


        if ($checkApplyHirarchy) {
            //$getUsers=select_mongo('user',array('category'=>array('$in'=>$categoryManager),'status'=>array('$ne'=>'10'),'user_type'=>array('$ne'=>'customer')),array('name','email','status')); 

            $getUsers = select_mongo('user', array('$and' => array(array("user_type" => array('$ne' => 'customer')), array("user_type" => array('$ne' => 'license manager'))), 'category' => array('$in' => $categoryManager), 'status' => array('$ne' => '10')), array('name', 'email', 'status'));
        } else if ($categoryManager) {
            //$getUsers=select_mongo('user',array('user_type'=>array('$ne'=>'super admin'),'status'=>array('$ne'=>'10')),array('name','email','status'));

            $getUsers = select_mongo('user', array('$and' => array(array("user_type" => array('$ne' => 'super admin')), array("user_type" => array('$ne' => 'license manager'))), 'status' => array('$ne' => '10')), array('name', 'email', 'status'));
        } else {
            //$getUsers=select_mongo('user',array('$and' => array(array("user_type" => array('$ne'=>'customer')),array("user_type" => array('$ne'=>'super admin'))),'status'=>array('$ne'=>'10')),array('name','email','status'));

            $getUsers = select_mongo('user', array('$and' => array(array("user_type" => array('$ne' => 'customer')), array("user_type" => array('$ne' => 'super admin')), array("user_type" => array('$ne' => 'license manager'))), 'status' => array('$ne' => '10')), array('name', 'email', 'status'));
        }

        $getUsers = add_id($getUsers);
        $users = array();
        foreach ($getUsers as $userId) {

            if ($mongoObject) {
                array_push($users, new MongoId($userId['id']));
            } else if ($object) {
                $uid = $userId['id'];
                unset($userId['id']);
                $users[$uid] = $userId;
            } else {
                array_push($users, $userId['id']);

                if ($userId['id'] != $data['userId']) {
                    if ($mongoObject) {
                        array_push($users, new MongoId($userId['id']));
                    } else if ($object) {
                        $uid = $userId['id'];
                        unset($userId['id']);
                        $users[$uid] = $userId;
                    } else {
                        array_push($users, $userId['id']);
                    }
                }
            }
        }
        if ($object) {
            return array('data' => $users, 'error_code' => '100', 'success' => 'true');
        } else {
            if ($object) {
                $key = array_search($data['userId'], $users);
                unset($users[$key]);
            }

            return array('data' => array_values($users), 'error_code' => '100', 'success' => 'true');
        }
    } else {
        return $check;
    }
}

function get_logs_string($data) {
    logger("1", $data, "", 5, "/get_logs_string");
    $query = array();
    $tmp = select_mongo('logsStrings', $query);
    $return = add_id($tmp);
    if (isset($return[0]) && !empty($return[0])) {
        $alldata = array();
        foreach ($return as $ret) {
            $alldata[$ret['stringId']] = array($ret['stringId'] => $ret['string']);
        }
        return array('data' => $alldata, 'error_code' => '1705', 'success' => 'true');
    } else {
        return array('data' => "", 'error_code' => '1706', 'success' => 'false');
    }
}

//Vipin add new function    
function manage_adv_save_query($data) {
    logger("1", $data, "", 5, "/manage_adv_save_query");
    $check = check_key_available($data, array('id', 'query', 'type', 'userId', 'name'));
    if ($check['success'] == 'true') {
        if (!empty($data['id'])) {
            $result = update_adv_query($data);
            return $result;
        } else {
            $result = insert_adv_query($data);
            return $result;
        }
    } else {
        return $check;
    }
}

function insert_adv_query($data) {
    logger("1", $data, "", 5, "/insert_adv_query");
    $result = get_saved_queries($data);
    $result = $result['data'];
    foreach ($result as $value) {
        if ($value['name'] == $data['name']) {
            return array('data' => "", 'error_code' => '1796', 'success' => 'false');
        }
    }

    $success = insert_mongo('adv_save_query', $data);
    if ($success['n'] == '0') {
        return array('data' => "", 'error_code' => '1798', 'success' => 'true');
    } else {
        return array('data' => "", 'error_code' => '1799', 'success' => 'false');
    }
}

function update_adv_query($data) {
    logger("1", $data, "", 5, "/update_adv_query");
    $id = $data['id'];
    $success = update_mongo('adv_save_query', $data, array('_id' => new MongoId($id)));
    if ($success['n'] == '1') {
        return array('data' => "", 'error_code' => '1798', 'success' => 'true');
    } else {
        return array('data' => "", 'error_code' => '1799', 'success' => 'false');
    }
}

function get_saved_queries($data) {
    //pr($data); die;
    logger("1", $data, "", 5, "/get_saved_queries");
    $cond = array();
    if (!empty($data['userId'])) {
        $cond['userId'] = $data['userId'];
        //array_push($cond,array("userId"=>$data['userId']));
    }
    if (!empty($data['type'])) {
        $cond['type'] = $data['type'];
        // array_push($cond,array("type"=>$data['type']));
    }
    if (!empty($data['id'])) {
        $id = explode("|", $data['id']);
        $qids = array();
        foreach ($id as $uid) {
            if (MongoId::isValid($uid)) {
                array_push($qids, new MongoId($uid));
            }
        }
        $cond['_id'] = array('$in' => $qids);
    }
    //pr($cond); die;
    $tmp = select_mongo('adv_save_query', $cond);

    $data = add_id($tmp, "id");

    return array('data' => $data, 'error_code' => '1797', 'success' => 'true');
}

//Vipin add new function 


function manage_social_users($data) {
    logger(1, '', $data, 5);
    $check = check_key_available($data, array('id'));
    if ($check['success'] == 'true') {

        if ($data['id'] == '0' || $data['id'] == '') {

            $check = check_key_available($data, array('category', 'username', 'email', 'name', 'role'));
            if ($check['success'] == 'true') {

                $manage_user = insert_social_user($data);
            } else {
                return $check;
            }
        }
        return $manage_user;
    } else {
        return $check;
    }
}

function insert_social_user($data) {
    logger(1, '', $data, 5);
    $deviceType = "";
    $deviceId = "";
    $gcm = "";
    if (isset($data['deviceType'])) {
        $deviceType = $data['deviceType'];
    }
    if (isset($data['deviceId'])) {
        $deviceId = $data['deviceId'];
    }
    if (isset($data['gcm'])) {
        $gcm = $data['gcm'];
    }

    if ($data['email'] && $data['email'] != '') {
        if (!check_email_exists($data['email'])) {

            $userData = insert_social_data($data);
            return $userData;
        } else {


            $result = social_login(array("username" => "", "email" => $data['email'], 'deviceType' => $deviceType, 'deviceId' => $deviceId, 'gcm' => $gcm));
            return $result;
        }
    } else if (!check_username_exists($data['username'])) {

        $userData = insert_social_data($data);
        return $userData;
    } else {

        $result = social_login(array("username" => $data['username'], "email" => "", 'deviceType' => $deviceType, 'deviceId' => $deviceId, 'gcm' => $gcm));
        return $result;
    }
}

function insert_social_data($data) {
    $roleInfo = get_roles(array('title' => $data['role']));
    $catInfo = get_category(array('title' => $data['category']));
    if ($catInfo['success'] == 'true' && $roleInfo['success'] == 'true') {
        unset($data['id']);
        $data['_id'] = new MongoId();
        $data['role'] = $roleInfo['data'][0]['id'];
        $data['category'] = array($catInfo['data'][0]['id']);
        $data['uploadedOn'] = new MongoDate();
        $versionNo = get_min_max_data(array('type' => 'max'));
        $data['versionNo'] = $versionNo['data'] + 1;
        $data['status'] = '1';
        $companyInfo = get_company_data();
        if (isset($companyInfo['lang'])) {
            $data['currentLang'] = $companyInfo['lang'];
        }
        $ret = insert_mongo('user', $data);
        if ($ret['n'] == '0') {
            $id = $data['_id']->{'$id'};
            $result = social_login(array("username" => $data['username'], "email" => $data['email'], 'deviceType' => $data['deviceType'], 'deviceId' => $data['deviceId'], 'gcm' => $data['gcm']));
            return $result;
        } else {
            return array('data' => $data, 'error_code' => '1051', 'success' => 'false');
        }
    } else {
        if ($catInfo['success'] == 'false') {
            return array('data' => 'category not available', 'error_code' => '1055', 'success' => 'false');
        } else if ($roleInfo['success'] == 'false') {
            return array('data' => 'role not available', 'error_code' => '1056', 'success' => 'false');
        }
    }
}

function social_login($data) {

    logger(1, '', $data, 5);
    $check = check_key_available($data, array('username', 'email'));
    if ($check['success'] == 'true') {
        if ($data['username'] != '') {
            $tmp = select_mongo('user', array("username" => "$data[username]"));
        } else if ($data['email'] != '') {
            $tmp = select_mongo('user', array("email" => "$data[email]"));
        }
        $return = add_id($tmp);

        if ($return[0]) {

            $alldata = array();
            $cdate = '';
            $alldata = $return[0];

            if ($alldata['status'] == '0') {
                return array('data' => $data, 'error_code' => '1600', 'success' => 'false');
            } else {

                $arr = array();
                $arr['id'] = $userId;
                if (isset($imageData['media']['1'][$userId]) && !empty($imageData['media']['1'][$userId])) {
                    $profile_picture = $imageData['media']['1'][$userId][0]['mediaName'];
                    if ($profile_picture != '') {

                        $alldata['media'] = site_url() . 'uploads/' . $companyId . '/media/images/' . $profile_picture;
                    } else {
                        $alldata['media'] = "";
                    }
                }
                if (isset($data['gcm'])) {
                    $arr['gcm'] = $data['gcm'];
                    $alldata['gcm'] = $data['gcm'];
                }
                if (isset($data['deviceId'])) {
                    $arr['deviceId'] = $data['deviceId'];
                    $alldata['deviceId'] = $data['deviceId'];
                }
                if (isset($data['deviceType'])) {
                    $arr['deviceType'] = $data['deviceType'];
                    $alldata['deviceType'] = $data['deviceType'];
                }
                $role = $alldata['role'];
                unset($alldata['role']);
                $i = 0;
                $permission = array();
                $result = array();
                if (!empty($role)) {
                    $role_id = explode(",", $role);
                    foreach ($role_id as $v) {
                        $get_roles = get_roles(array('id' => $v));
                        $get_roles = $get_roles['data'];

                        foreach ($get_roles as $key => $obj) {
                            $nat = json_decode($obj['permission'], true);
                            foreach ($nat as $key1 => $obj1) {
                                $permission[$key1][] = $obj1;
                            }
                        }
                    }

                    foreach ($permission as $key2 => $obj2) {
                        foreach ($obj2 as $obj3) {
                            foreach ($obj3 as $key3 => $obj4) {
                                $permission_key = $key3;
                                $permission_element = $obj4;
                                if (!isset($result[$key2][$permission_key])) {
                                    $result[$key2][$permission_key] = array();
                                }
                                foreach ($permission_element as $obj5) {
                                    if (!in_array($obj5, $result[$key2][$permission_key])) {
                                        $result[$key2][$permission_key][] = $obj5;
                                    }
                                }
                            }
                        }
                    }
                    $alldata['role'] = json_encode($result);
                }

                if (isset($data['deviceType']) && ($data['deviceType'] == "ios" || $data['deviceType'] == "android")) {
                    $activity = update_user_last_activity($arr);
                    $lang = get_languages(array('deviceType' => $data['deviceType']));
                    $alldata['languages'] = $lang['data'];
                    $notifyData = insert_notification(array('customerId' => $companyId, 'mid' => '1', 'smid' => '1', 'userId' => $alldata['id'], 'itemId' => "", 'eid' => "71", 'extra' => json_encode(array('id' => $alldata['id']))));
                    if (isset($alldata['role']) && $alldata['role'] != "" && $alldata['role'] != "null") {
                        $mr1 = array();
                        $newArr = array();
                        $moduledata = get_modules_by_id(array('mid' => "0", 'status' => "0"));
                        if (isset($moduledata['data'])) {
                            //print_r($moduledata['data']);die;
                            foreach ($moduledata['data'] as $mo) {
                                array_push($newArr, $mo['mval']);
                            }
                        }
                        foreach ($result as $key => $val) {
                            if (in_array($key, $newArr)) {
                                unset($result[$key]);
                            }
                        }
                        foreach ($result as $key => $val) {
                            $tmr1 = array();
                            $mid = get_module_by_name(trim($key));
                            $tmr1['id'] = $mid;
                            $tmr1['nm'] = $key;
                            $sm = array();
                            $tm = 1;

                            foreach ($val as $key1 => $val1) {
                                if (isset($val1)) {
                                    $tsm = array();
                                    $smmid = get_submodule_id(array("mid" => "$mid", "sname" => "$key1"));
                                    if (isset($smmid['success']) != 'false') {
                                        $smmtitle = get_submodule_title_by_id(array("mid" => "$mid", "sname" => "$key1"));

                                        $tsm['id'] = $smmid;
                                        $tsm['nm'] = $key1;
                                        $tsm['title'] = $smmtitle;
                                        $tsm['permission'] = $val1;
                                        array_push($sm, $tsm);
                                    }
                                }
                            }
                            $tmr1['submodule'] = $sm;
                            array_push($mr1, $tmr1);
                        }
                        $alldata['role'] = json_encode($mr1);
                    }
                    $cdata = array("logo" => "http://192.168.0.165/teammerge/ui/assets/img/logo_pyk.png", "module" => "1,2,3,4,5,6,7,8,9", "cid" => "565ee2c89c76841409000000");
                    $alldata['cdata'] = $cdata;
                }
                //pr($alldata); die;
                return array('data' => $alldata, 'error_code' => '1035', 'success' => 'true');
            }
        }
    } else {
        return $check;
    }
}

function check_username_exists($username) {
    $tmp = select_mongo('user', array('username' => $username));
    $retrun = add_id($tmp, "id");
    if (count($retrun) > 0) {
        return true;
    }
    return false;
}

function get_login_users_widget($request_data) {
    $active = "0";
    $total = count_mongo('loginAttempt', array());
    $all_days = array();
    $period_type = 'day';
    $conds_status = 'Login Users';
    $return = array();
    if (!empty($request_data['daysPreviously'])) {
        $strt_date = get_date_by_days($request_data['daysPreviously'], $request_data['daysPreviously']);
        $end_date = date('Y-m-d');
        if ($request_data['period'] == 'W') {
            $period_type = 'Week';
            $all_days = getWeekDatesBetweenDates($strt_date, $end_date);
        }
        if ($request_data['period'] == 'M') {
            $period_type = 'Month';
            $all_days = getMonthDatesBetweenDates($strt_date, $end_date);
        }
        if ($request_data['period'] == 'D') {
            $period_type = 'Day';

            $all_days = createDateRangeArray($strt_date, $end_date);
        }
    }
    if (!empty($all_days)) {
        $cnt = 1;
        $return[0] = array($period_type, $conds_status);
        foreach ($all_days as $val) {
            if ($period_type == 'Day') {
                $active = count_login_user(array('start' => $val, 'end' => $val));
                $return[$cnt] = array($val, $active);
            } else if ($period_type == 'Week') {
                $active = count_login_user(array('start' => $val[0], 'end' => $val[1]));
                $return[$cnt] = array($val[0], $active);
            } else if ($period_type == 'Month') {
                $active = count_login_user(array('start' => $val[0], 'end' => $val[1]));
                $return[$cnt] = array($val[0], $active);
            }

            $cnt++;
        }
    }
    return array('data' => $return, 'error_code' => '100', 'success' => 'true');
}

function count_login_user($data) {
    $condition = array();
    $dt = $data['start'] . "00:00";
    $start = new MongoDate(strtotime($dt));
    $dt1 = $data['end'] . " 23:59";
    $end = new MongoDate(strtotime($dt1));
    $condition['lastAttempt'] = array('$gte' => $start, '$lt' => $end);
    $condition['mid'] = '1';
    $condition['smid'] = '1';
    $condition['type'] = '1';
    $condition['action'] = 'active';
    $tmp = select_mongo("loginDetails", $condition);
    $return = add_id($tmp, "id");
    if (isset($return[0]) && !empty($return[0])) {
        $alldata = array();
        foreach ($return as $ret) {

            $alldata[$ret['userId']] = $ret;
        }
    }
    return count($alldata);
}

function get_active_users_widget($request_data) {
    logger("1", $data, "", 5, "/get_dashboard");
    $active = "0";
    $total = count_mongo('user', array());
    $all_days = array();
    $period_type = 'day';
    $conds_status = 'Active Users';
    $return = array();
    if (!empty($request_data['daysPreviously'])) {
        $strt_date = get_date_by_days($request_data['daysPreviously']);
        $end_date = date('Y-m-d');
        if ($request_data['period'] == 'W') {
            $period_type = 'week';
            $all_days = getWeekDatesBetweenDates($strt_date, $end_date);
        }
        if ($request_data['period'] == 'M') {
            $period_type = 'month';
            $all_days = getMonthDatesBetweenDates($strt_date, $end_date);
        }
    }

    if (!empty($all_days)) {
        $cnt = 1;
        $return[0] = array($period_type, 'Total', $conds_status);
        foreach ($all_days as $val) {
            $strt_time = strtotime($val[0]);
            $end_time = strtotime($val[1]);

            $start = new MongoDate($strt_time);
            $end = new MongoDate($end_time);

            $condition['uploadedOn'] = array('$gte' => $start, '$lt' => $end);
            $condition['status'] = "1";
            $active = count_mongo('user', $condition);
            $return[$cnt] = array($val[0], $total, $active);
            $cnt++;
        }
    }
    return array('data' => $return, 'error_code' => '100', 'success' => 'true');
}

function get_forgot_password($data) {
    global $companyId;
    logger("1", $data, "", 5, "/forgot_password");
    $check = check_key_available($data, array('email'));
    if ($check['success'] == 'true') {
        $tmp = select_mongo('user', array("email" => "$data[email]"));
        $return = add_id($tmp);
        if ($return[0]) {
            $alldata = $return[0];

            if ($alldata['status'] == '1') {

                $userId = $alldata['id'];
                $password = $alldata["password"];
                $checkStatus = insert_notification(array('customerId' => $companyId, 'mid' => "1", 'smid' => "1", 'userId' => $userId, 'itemId' => '', 'eid' => "3", 'extra' => json_encode(array('password' => $password))));
                return $checkStatus;
            } else {
                return array('data' => $data, 'error_code' => '1798', 'success' => 'false');
            }
        } else {
            return array('data' => $data, 'error_code' => '1306', 'success' => 'false');
        }
    } else {
        return $check;
    }
}

// robot signout
function signout_robot($data) {
    global $companyId;
    logger("1", $data, "", 5, "/signout_robot");
    $check = check_key_available($data, array('email'));
    if ($check['success'] == 'true') {
        $delete = delete_mongo('recorder_login', array("email" => $data['email']));
        if ($delete['n'] == '0') {
            return array('data' => $data['id'], 'error_code' => '1502', 'success' => 'false');
        } else {
            return array('data' => $data['id'], 'error_code' => '1503', 'success' => 'true');
        }
    } else {
        return $check;
    }
}
?>
