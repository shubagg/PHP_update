<?php
include_once '../../../../global.php';
$type = $_POST['tp'];
$id = str_replace(' ', '+', $_POST['user_id']);
$decrypt = encrypt_decrypt('', 'decrypt', 'nikky', $id);
$user_id = str_replace(array('\'', '"'), '', $decrypt['data']);
$output = manage_user(array('id' => $user_id, 'status' => $type));
if ($output['success'] == 'true') {
    $userInfo = get_users(array('id' => $user_id));
    $loginStatus = "inactive";
    if ($type == '1') {
        $loginStatus = "active";
    }
    if ($userInfo['success'] == 'true' && !empty($userInfo['data'][0])) {
        manage_login_attempt_logs(array('id' => '1', 'email' => $userInfo['data'][0]['email'], 'attemptNo' => 0, 'status' => $type));
        manage_login_details(array('id' => '0', 'email' => $userInfo['data'][0]['email'], 'password' => $userInfo['data'][0]['password'], 'loginStatus' => $loginStatus));
    }
}
echo json_encode($output);
?>