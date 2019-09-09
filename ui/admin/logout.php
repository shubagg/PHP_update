<?php
$noclose = true;
include_once '../../global.php';
$verifyRequest = $csrf->verifyRequest();
if ($verifyRequest['success'] == 'true') {
    $info = manage_login_details(array('id' => '0', 'mid' => '1', 'smid' => '1', 'type' => '1', 'userId' => $_SESSION['user']["email"], 'action' => 'Logout', 'stringId' => '11'));
    $moduleInfo = module_access_url("35", "1");
    if ($moduleInfo) {
        $info = json_decode($moduleInfo, true);
        $chat_url = $info['url'];
        $chatData = array();
        $chatData['id'] = $_SESSION['user']["user_id"];
        $chatData['login_key'] = "";
        $url = $chat_url . "/webservices/manage_chat_user";
        $updateUserData = curl_post_ext($url, $chatData);
        $params = array();
        $params['logout'] = $_SESSION['user']['user_id'];
        $result = curl_post_ext($chat_url . "/chat/index.php", $params);
    }
    manage_user(array('id' => $_SESSION['user']["user_id"], 'login_status' => 'OFFLINE'));
    unset($_SESSION['user']["user_id"]);
    unset($_SESSION['user']["name"]);
    unset($_SESSION['user']["email"]);
    header("Location:" . admin_ui_url());
} else {
    echo json_encode($verifyRequest);
}
?>
<script>window.location.href = "<?php echo admin_ui_url(); ?>"</script>
