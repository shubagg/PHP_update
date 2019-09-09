<?php

include_once '../../../../global.php';
$verifyRequest = $csrf->verifyRequest();
if ($verifyRequest['success'] == 'true') {
    $data = array();
    $moduleInfo = module_access_url("35", "1");
    if ($moduleInfo) {
        $info = json_decode($moduleInfo, true);
        $data['chat_url'] = $info['url'];
    }
    $id = explode(",", $_POST['user_ids']);
    $decryptId = array();
    foreach ($id as $ids) {
        $ids = str_replace(' ', '+', $ids);
        $decrypt = encrypt_decrypt('', 'decrypt', 'nikky', $ids);
        array_push($decryptId, str_replace(array('\'', '"'), '', $decrypt['data']));
    }
    $user_ids = implode("|", $decryptId);
    $data['id'] = $user_ids;
    $output = delete_user($data);
    echo json_encode($output);
} else {
    echo json_encode($verifyRequest);
}
?>