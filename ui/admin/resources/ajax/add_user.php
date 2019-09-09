<?php

$noclose = true;
include_once '../../../../global.php';
$verifyRequest = $csrf->verifyRequest();
if ($verifyRequest['success'] == 'true') {

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
    } else {
        $action = '';
    }
    if ($action == 'change_password') {
        $password = $_POST['password'];
        $forgotKey = $_POST['forgotKey'];
        $userInfo = get_user(array("query" => array("forgotKey" => $forgotKey)));
        if (!empty($userInfo)) {
            $userId = $userInfo[0]['id'];
            $data = array();
            if (ENVIROMENT_ACCESS == 1) {
                $moduleInfo = module_access_url("35", "1");
                if ($moduleInfo) {
                    $info = json_decode($moduleInfo, true);
                    $data['chat_url'] = $info['url'];
                }
            }
            $data['password'] = $password;
            $data['forgotKey'] = '';
            $data['id'] = $userId;
            $output = manage_user($data);
            if ($output['success'] == 'true') {
                $result = array('success' => 'true', 'errorcode' => '100', 'data' => "");
            } else {
                $result = array('success' => 'false', 'errorcode' => '100', 'data' => "");
            }
        } else {
            $result = array('success' => 'false', 'errorcode' => '120', 'data' => "");
        }
        echo json_encode($result);
    }

    if ($action == 'check_user_login_status') {
        $abc = get_user(array("query" => array("email" => $_SESSION['user']["email"])));
        if (!empty($abc)) {
            echo "1";
        } else {
            unset($_SESSION['user']["user_id"]);
            unset($_SESSION['user']["name"]);
            unset($_SESSION['user']["email"]);
            echo "0";
        }
    }

    if ($action == 'pwd_change') {
        $verifyRequest = $csrf->verifyRequest();
        if ($verifyRequest['success'] == 'true') {
            $old_password = $_REQUEST['old_password'];
            $new_password = $_REQUEST['new_password'];
            $get_users = curl_post("/get_users", array("id" => $_SESSION['user']["user_id"]));
            $users = $get_users['data'];
            $password = "";
            if (!empty($users)) {
                $password = $users[0]['password'];
            }
            if ($password != $old_password) {
                $res = array("success" => "false", "errorcode" => "2");
                echo json_encode($res);
            } else {

                $data = array();
                if (ENVIROMENT_ACCESS == 1) {
                    $moduleInfo = module_access_url("35", "1");
                    if ($moduleInfo) {
                        $info = json_decode($moduleInfo, true);
                        $data['chat_url'] = $info['url'];
                    }
                }
                $data['password'] = $new_password;
                $data['id'] = $_SESSION['user']["user_id"];

                $output = curl_post("/manage_user", $data);
                echo json_encode($output);
            }
        } else {
            echo json_encode($verifyRequest);
        }
    }

    if ($action == 'admin_login') {
        $verifyRequest = $csrf->verifyRequest();
        if ($verifyRequest['success'] == 'true') {
            //$csrf->verifyRequest();
            $captchaStatus = "no";
            $advanceSetting = get_module_setting_by_mid(array('mid' => '1', 'smid' => '1'));
            if ($advanceSetting['success'] == 'true' && !empty($advanceSetting['data'][0])) {
                $captchaStatus = $advanceSetting['data'][0]['advanceSetting']['showCaptcha'];
                $showCaptchaAfter = $advanceSetting['data'][0]['advanceSetting']['showCaptchaAfter'];
            }
            if ($captchaStatus == 'yes') {
                $captcha = true;
                $captcha_code = rand(100000, 999999);
            }
//        $username=mysqli_real_escape_string($_POST['username']);
//        $password=mysqli_real_escape_string($_POST['password']); 
            $username = addslashes(trim($_POST['username']));
            $password = addslashes(trim($_POST['password']));
            $permission = array();
            $result = array();

            if ($captchaStatus == 'yes') {
                if (isset($_POST["captcha_code"]) && isset($_SESSION["captcha_code"]) && $_POST["captcha_code"] != $_SESSION["captcha_code"]) {
                    $captcha = false;
                    manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $username, 'action' => 'wrong captcha code', 'stringId' => '1'));
                    $_SESSION["captcha_code"] = $captcha_code;
                    echo json_encode(array('data' => array('captcha_code' => $captcha_code, 'data' => ''), 'error_code' => '100', 'success' => 'false'));
                    return false;
                }
            }
//        if ($captchaStatus == 'yes') {
//            $infoData = get_failed_login_data(array());
//            $failed_login_attempt = $infoData['data'];
//        }
            $_SESSION["captcha_code"] = $captcha_code;
            $output = curl_post("/user_login", array('email' => $username, 'password' => $password, 'client_id' => CLIENT_ID, 'client_secret' => CLIENT_SECRET));
            if ($output['success'] == 'true') {
                if ($output['data']['status'] == 1) {
                    $media = $output['data']['media'];
                    $i = 0;
                    $email = $output['data']['email'];
                    $name = $output['data']['name'];
                    $id = $output['data']['id'];
                    $user_type = $output['data']['user_type'];
                    $lang = $output['data']['currentLang'];
                    $role = json_decode($output['data']['role'], true);
                    $xyz = array("user_id" => $id, "name" => $name, "email" => $email, "permission" => $role, 'token' => $output['data']['token'], 'user_type' => $user_type, 'lang' => $lang);
                    $_SESSION['user'] = $xyz;
                    set_language($lang);
                    if ($captcha == true && $captchaStatus == 'yes') {
//                    $deleteInfo = delete_failed_login_data(array());
                        unset($_SESSION["captcha_code"]);
                    }
                    manage_user(array('id' => $id, 'login_status' => 'ONLINE'));
                    echo json_encode(array('data' => "", 'error_code' => '1035', 'success' => 'true'));
                } else {
                    $failed_login_attempt = array();
//                if ($captcha == true && $captchaStatus == 'yes') {
//                    if ($failed_login_attempt < 1) {
//                        $inserInfo = insert_failed_login_data(array());
//                    }
//                }
                    //echo "Sorry You can't login";
                    echo json_encode(array('data' => $captcha_code, 'failed_login_attempt' => $failed_login_attempt, 'error_code' => '1600', 'success' => 'false'));
                }
            } else {
//            if ($captcha == true && $captchaStatus == 'yes') {
//                if ($failed_login_attempt < 1) {
//                    $inserInfo = insert_failed_login_data(array());
//                }
//            }
                $returnData = array('captcha_code' => $captcha_code, 'data' => $output['data']);
                if ($output['errorcode'] == '116') {
                    // echo "Please enter username or password";
                    echo json_encode(array('data' => $returnData, 'failed_login_attempt' => $failed_login_attempt, 'error_code' => '116', 'success' => 'false'));
                } else if ($output['errorcode'] == '1602') {
                    //echo "Sorry your account has been blocked";
                    echo json_encode(array('data' => $returnData, 'failed_login_attempt' => $failed_login_attempt, 'error_code' => '1602', 'success' => 'false'));
                } else if ($output['errorcode'] == '1603') {
                    //echo "Sorry your account has been locked";
                    echo json_encode(array('data' => $returnData, 'failed_login_attempt' => $failed_login_attempt, 'error_code' => '1603', 'success' => 'false'));
                } else if ($output['errorcode'] == '1500') {
                    //echo "Sorry your account has been locked";
                    echo json_encode(array('data' => $returnData, 'failed_login_attempt' => $failed_login_attempt, 'error_code' => '1500', 'success' => 'false'));
                } else {
                    //echo "username or password is incorrect";
                    echo json_encode(array('data' => $returnData, 'failed_login_attempt' => $failed_login_attempt, 'error_code' => '1036', 'success' => 'false'));
                }
            }
        } else {
            echo json_encode($verifyRequest);
        }
    }
    if (isset($_REQUEST['user_add'])) {
        $verifyRequest = $csrf->verifyRequest();
        if ($verifyRequest['success'] == 'true') {
            $send = array();
            $parentId = "569f7faa7c3d68011e3c9869";
            $superAdminId = $parentId;
            if ($_SESSION['user']["user_type"] == 'super admin') {
                $parentId = $_SESSION['user']["user_id"];
            } else if ($_SESSION['user']["user_type"] == 'license manager') {
                //$send['license_type'] = '1';
                $parentId = $_SESSION['user']["user_id"];
            }
            //$send['license_type'] = '1';
            if (isset($_POST['type']) && $_POST['type'] == 'machine') {
                $send['license_type'] = '1';
            }
            $user_id = 0;
            if(!empty($_REQUEST['user_id'])) {
                $_REQUEST['user_id'] = str_replace(' ', '+', $_REQUEST['user_id']);
                $decrypt = encrypt_decrypt('', 'decrypt', 'nikky', $_REQUEST['user_id']);
                $user_id = str_replace(array('\'', '"'), '', $decrypt['data']);
            }
            $userDetail = get_resource_by_id(array("id" => $_SESSION['user']["user_id"]));
            $userDetail = $userDetail['data']['0'];
            if(!empty($userDetail['type']) && $userDetail['type'] == 'attender') {
                return array('data' => 'Access forbidden for this user!!', 'error_code' => '1056', 'success' => 'false');
            }
            if(!empty($_POST['type']) && !in_array($_POST['type'], array('machine', 'attender'))) {
                return array('data' => 'Invalid User type!!', 'error_code' => '1056', 'success' => 'false');
            }
            if((!empty($userDetail['type']) && $userDetail['type'] == 'machine') && !in_array($_POST['type'], array('attender'))) {
                return array('data' => 'Invalid User type!!', 'error_code' => '1056', 'success' => 'false');
            }
            if (isset($_POST['category']) && $_POST['category'] != "") {
                $category = implode("|", $_POST['category']);
            } else {
                $category = "";
            }
            if (isset($_POST['manager']) && $_POST['manager'] != "") {
                $manager = implode("|", $_POST['manager']);
            } else {
                $manager = "";
            }
            if (isset($_POST['role']) && $_POST['role'] != "") {
                $role = $_POST['role'];
            } else {
                $role = "";
            }
            if (isset($_POST['type']) && $_POST['type'] != "") {
                $type = $_POST['type'];
            } else {
                $type = "";
            }
            if (isset($_POST['machine']) && $_POST['machine'] != "") {
                $machine = explode(',', $_POST['machine']);
            } else {
                $machine = "";
            }

            $name = trim($_REQUEST['name']);
            if (isset($_REQUEST['password'])) {
                $password = trim($_REQUEST['password']);
            }
            $email = trim(strtolower($_REQUEST['email']));
            $designation = trim($_REQUEST['designation']);
            $login_type = $_REQUEST['login_type'];

            if ($user_id != '0') {

                if (ENVIROMENT_ACCESS == 1) {
                    $moduleInfo = module_access_url("35", "1");
                    if ($moduleInfo) {
                        $info = json_decode($moduleInfo, true);
                        $send['chat_url'] = $info['url'];
                    }
                }
                $send['category'] = $category;
                $send['designation'] = $designation;
                $send['role'] = $role;
                $send['name'] = $name;
                $send['id'] = $user_id;
                $send['type'] = $type;
                if ($machine != '') {
                    $send['machine'] = $machine;
                }
                $output = manage_user($send);
                if ($type == 'machine') {
                    $tmp = select_mongo('user', array('_id' => new MongoId($superAdminId)), array('machine'));
                    $retrun = add_id($tmp, "id");
                    if (!empty($retrun[0]['machine'])) {
                        $machine_arr = $retrun[0]['machine'];
                        array_push($machine_arr, $user_id);
                    } else {
                        $machine_arr = array($user_id);
                    }
                    $ret = update_mongo('user', array('machine' => $machine_arr), array('_id' => new MongoId($superAdminId)));
                }
                if ($_FILES['profile_picture']['name'] != "") {
                    $tmp = file_get_contents($_FILES['profile_picture']['tmp_name']);
                    $array = explode('.', $_FILES['profile_picture']['name']);
                    $ext = end($array);
                    $outputs = manage_media(array('id' => "0", 'smid' => "1", 'amid' => "1", 'asmid' => "1", 'aiid' => $user_id, 'mediaName' => "userImg", 'mediaType' => "image", 'userImg' => base64_encode($tmp), 'base64enc' => '1', 'extension' => $ext, 'multimedia' => 0, 'delete_previous' => 'true'), 10, 1);
                }
                echo json_encode($output);
            } else {

                if (ENVIROMENT_ACCESS == 1) {
                    $moduleInfo = module_access_url("35", "1");
                    if ($moduleInfo) {
                        $info = json_decode($moduleInfo, true);
                        $send['chat_url'] = $info['url'];
                    }
                }
                $send['category'] = $category;
                $send['manager'] = $manager;
                $send['designation'] = $designation;
                $send['role'] = $role;
                $send['user_type'] = "user";
                $send['username'] = $email;
                $send['email'] = $email;
                $send['name'] = $name;
                $send['password'] = $password;
                $send['status'] = "0";
                $send['login_type'] = "normal";
                $send['parentId'] = $parentId;
                $send['id'] = "0";
                $send['type'] = $type;
                if ($machine != '') {
                    $send['machine'] = $machine;
                }
                $output = manage_user($send);
                $aiid = $output['data'];
                if ($type == 'machine') {
                    $tmp = select_mongo('user', array('_id' => new MongoId($superAdminId)), array('machine'));
                    $retrun = add_id($tmp, "id");
                    if (!empty($retrun[0]['machine'])) {
                        $machine_arr = $retrun[0]['machine'];
                        array_push($machine_arr, $aiid);
                    } else {
                        $machine_arr = array($aiid);
                    }
                    $ret = update_mongo('user', array('machine' => $machine_arr), array('_id' => new MongoId($superAdminId)));
                }
                if ($_FILES['profile_picture']['name'] != "") {
                    $array = explode('.', $_FILES['profile_picture']['name']);
                    $ext = end($array);
                    $outputs = manage_media(array('id' => "0", 'smid' => "1", 'amid' => "1", 'asmid' => "1", 'aiid' => $aiid, 'mediaName' => 'profile_picture', 'mediaType' => "image", 'multimedia' => "0", 'type' => $ext));
                }
                echo json_encode($output);
            }
        } else {
            echo json_encode($verifyRequest);
        }
    }
    if ($action == 'update_profile_image') {
        $verifyRequest = $csrf->verifyRequest();
        if ($verifyRequest['success'] == 'true') {
            $user_id = $_SESSION['user']['user_id'];
            if ($_FILES['profile_picture']['name'] != "") {
                $array = explode('.', $_FILES['profile_picture']['name']);
                $ext = end($array);
                $outputs = manage_media(array('id' => "0", 'smid' => "1", 'amid' => "1", 'asmid' => "1", 'aiid' => $user_id, 'mediaName' => 'profile_picture', 'mediaType' => "image", 'multimedia' => "0", 'type' => $ext));
                //logger_ui("update_profile_image/manage_media","",$outputs,5);
            }
            $imageData = get_media(array('smid' => '1', 'asmid' => '1', 'amid' => '1', 'aiid' => $user_id, 'object' => 'true'));
            $profile_img = $imageData['data'];
            if (!empty($profile_img)) {
                $_SESSION['user']['media'] = $profile_img;
                $res = array("success" => "true", "errorcode" => "0");
                echo json_encode($res);
            } else {
                $_SESSION['user']['media'] = "";
                $res = array("success" => "false", "errorcode" => "2");
                echo json_encode($res);
            }
        } else {
            echo json_encode($verifyRequest);
        }
    }

    if ($action == 'modify_user') {
        $verifyRequest = $csrf->verifyRequest();
        if ($verifyRequest['success'] == 'true') {
            $userId = $_REQUEST['userId'];
            $name = htmlspecialchars(trim($_REQUEST['name']));
            $send = array();
            if (ENVIROMENT_ACCESS == 1) {
                $moduleInfo = module_access_url("35", "1");
                if ($moduleInfo) {
                    $info = json_decode($moduleInfo, true);
                    $send['chat_url'] = $info['url'];
                }
            }
            $send['name'] = $name;
            $send['id'] = $_SESSION['user']['user_id'];
            $output = manage_user($send);
            if ($output['data']) {
                $_SESSION['user']['name'] = $name;
            }
            echo json_encode($output);
        } else {
            echo json_encode($verifyRequest);
        }
    }

    if (isset($_REQUEST['data_id'])) {
        $data_id = $_REQUEST['data_id'];
        $output = curl_post($webservice_url . "/delete_user", array("user_id" => $data_id));
        if ($output) {
            echo $output;
        } else {
            echo "0";
        }
    }

    if ($action == 'get_user_data') {
        $_REQUEST['id'] = str_replace(' ', '+', $_REQUEST['id']);
        $decrypt = encrypt_decrypt('', 'decrypt', 'nikky', $_REQUEST['id']);
        $data_id = str_replace(array('\'', '"'), '', $decrypt['data']);
        $output = get_resource_by_id(array("id" => $data_id, "asmid" => 1, "amid" => 10));
        echo json_encode($output);
    }

    if ($action == 'change_user_password') {
        if (isset($_REQUEST['uId'])) {
            $id = str_replace(' ', '+', $_REQUEST['uId']);
            $decrypt = encrypt_decrypt('', 'decrypt', 'nikky', $id);
            $uId = str_replace(array('\'', '"'), '', $decrypt['data']);
            $new_password = $_REQUEST['pwd'];
            $userDetail = get_resource_by_id(array("id" => $uId));
            $userDetail = $userDetail['data']['0'];
            if ($userDetail['password'] == $new_password) {
                echo json_encode(array('success' => 'false', 'data' => $ui_string['user_password_unsuccess'], 'errorcode' => '101'));
            } else {
                $send = array();
                if (ENVIROMENT_ACCESS == 1) {
                    $moduleInfo = module_access_url("35", "1");
                    if ($moduleInfo) {
                        $info = json_decode($moduleInfo, true);
                        $send['chat_url'] = $info['url'];
                    }
                }
                $send['password'] = $new_password;
                $send['id'] = $uId;
                $output = manage_user($send);
                echo json_encode($output);
            }
        }
    }

    if ($action == 'get_urgency_data') {
        $data_id = $_POST['id'];
        $output = get_urgency_data(array("id" => $data_id));
        echo json_encode($output);
    }

    if ($action == 'update_urgency') {
        $id = $_POST['uId'];
        $type = trim($_POST['type']);
        $no_of_notification = trim($_POST['no_of_notification']);
        $notification_send_after_time = trim($_POST['notification_send_after_time']);

        $output = update_urgency_data(array("id" => $id, 'type' => $type, 'no_of_notification' => $no_of_notification, 'notification_send_after_time' => $notification_send_after_time));
        echo json_encode($output);
    }
    if ($action == 'forgot_password') {
        $verifyRequest = $csrf->verifyRequest();
        if ($verifyRequest['success'] == 'true') {
            $email = $_POST['email'];
            $output = forgot_password_recovery(array("email" => $email));
            echo json_encode($output);
        } else {
            echo json_encode($verifyRequest);
        }
    }


    if ($action == 'language') {
        $userId = $_REQUEST['id'];
        $lang = trim($_REQUEST['lang']);
        $output = manage_user(array('currentLang' => $lang, 'id' => $userId));
        if ($output['success'] == 'true') {
            set_language($lang);
            $_SESSION['user']['lang'] = $lang;
        }
        echo json_encode($output);
    }


    if ($action == 'get_lang') {
        $output = get_languages(array('deviceType' => ''));
        echo json_encode($output);
    }


    if ($action == 'googlessologin') {
        //pr($_POST);
        $ssoresult = google_sso_login($_POST);
        $ssoresultData = $ssoresult['data'];
        $role = json_decode($ssoresultData['role'], true);
        if ($ssoresult['success'] == 'true') {
            $xyz = array("user_id" => $ssoresultData['id'], "name" => $ssoresultData['name'], "email" => $ssoresultData['email'], "permission" => $role, 'user_type' => $ssoresultData['user_type'], 'lang' => $ssoresultData['lang'], 'loginType' => 'googlesso');

            $_SESSION['user'] = $xyz;

            echo '1';
        } else {
            echo '0';
        }
    }


    if ($action == 'manage_manager') {
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $mid = $_POST['mid'];
        $output = curl_post("/get_resource_by_id", array("id" => $uid, "fields" => "manager"));
        if ($mid == '1') {
            if ($output['success'] == 'true' && !empty($output['data'][0])) {
                if (isset($output['data'][0]['manager'])) {
                    $farray = $output['data'][0]['manager'];
                    if (in_array($cid, $farray)) {
                        $sarray = array($cid);
                        $tarray = array_diff($farray, $sarray);
                        $newManage = implode("|", $tarray);
                        $usetUpdate = manage_user(array('id' => $uid, 'manager' => $newManage));
                        if ($usetUpdate['success'] == 'true') {
                            echo '1';
                        } else {
                            echo '0';
                        }
                    } else {
                        echo '1';
                    }
                }
            } else {
                echo '0';
            }
        } else {
            if ($output['success'] == 'true' && !empty($output['data'][0])) {
                if (isset($output['data'][0]['manager'])) {
                    $manager = $output['data'][0]['manager'];
                    if (!in_array($cid, $manager)) {
                        array_push($manager, $cid);
                    }
                } else {
                    $manager = array();
                    array_push($manager, $cid);
                }
                if ($manager[0] == '') {
                    unset($manager[0]);
                }
                $newManage = implode("|", $manager);
                $usetUpdate = manage_user(array('id' => $uid, 'manager' => $newManage));
                if ($usetUpdate['success'] == 'true') {
                    echo '1';
                } else {
                    echo '0';
                }
            } else {
                echo '0';
            }
        }
    }

    if ($action == 'checkgoogleID') {
        $googleID = $_POST['googleID'];
        $output = check_googleId_exists($googleID);
        if ($output) {
            echo $output;
        } else {
            echo "0";
        }
    }

    if ($action == 'fileimport') {
        $path = server_path() . 'company/9/uploads/import_image/';
        $xlstmp_name = $_FILES['xls_file']['tmp_name'];
        $xlsfilename = $_FILES['xls_file']['name'];
        $ziptmp_name = $_FILES['media_file']['tmp_name'];
        $zipfilename = $_FILES['media_file']['name'];
        $file = $path . $xlsfilename;
        $image = $path . $zipfilename;
        if (file_exists($path . $xlsfilename) || file_exists($path . $zipfilename)) {
            unlink($path . $xlsfilename);
            unlink($path . $zipfilename);
        }
        move_uploaded_file($xlstmp_name, $file);
        move_uploaded_file($ziptmp_name, $image);
        chmod($file, 0777);
        chmod($image, 0777);
        $zip = new ZipArchive;
        if ($zip->open($image) === TRUE) {
            $zip->extractTo($path);
            $zip->close();
            $array = explode(".", $zipfilename);
            $file_name = $array[0];
            $output = import_user_xls(array('tmp_name' => $file, 'filename' => $file_name));
            echo json_encode($output);
        } else {
            $result = array('data' => '', 'error_code' => '100', 'success' => 'false');
            echo json_encode($result);
        }
    }
} else {
    echo json_encode($verifyRequest);
}
?>
