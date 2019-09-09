<?php 
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
$licenseRequest = select_mongo('licensesRequest', array());
$licenseRequest = add_id($licenseRequest, 'id');
if(!empty($licenseRequest)) {
    foreach($licenseRequest as $val) {
        if($val['ip_address']) {
            $fields = array(
                'request_from' => 'cron',
                'server_time' => time(),
                'type' => 'verifyServerConfiguration'
            );
            $headers = array(
                'Authorization: key='.API_ACCESS_KEY
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $val['ip_address'] . '/webservices/verify_license_status');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            $result = curl_exec($ch);
            $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $total_cron_count = 0;
            if ($resultStatus != 200) {
                $total_cron_count = !empty($val['server_cron_count']) ? $val['server_cron_count'] + 1 : 1;
                if($total_cron_count > 3) {
                    insert_notification(array('customerId' => '28', 'mid' => "1", 'smid' => "1", 'userId' => $val['userId'], 'itemId' => '', 'eid' => "306", 'extra' => json_encode(array('ip_address' => $val['ip_address']))));
                }
            }
            update_mongo('licensesRequest', array('server_cron_count' => $total_cron_count), array('_id' => new MongoId($val['id'])));
            curl_close($ch);
            $curl_result = json_decode($result, true);
        }
    }
}
echo "1";
?>