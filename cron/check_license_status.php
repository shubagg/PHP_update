<?php 
$basePath=dirname(dirname(__FILE__));
include("$basePath/global.php");
$mediaInfo = select_mongo("company_licenses", array("estatus" => array('$exists' => false)), array());
$mediaInfo = add_id($mediaInfo, "id");
if (count($mediaInfo) > 0) {
    foreach ($mediaInfo as $value) {
        $date_of_expirys = encrypt_decrypt('', 'decrypt', 'opensesame', $value['date_of_expiry']);
        if ($date_of_expirys['success'] == 'true') {
            $date_of_expiry = str_replace("'", "", $date_of_expirys['data']);
            $exdate = $date_of_expiry . " 23:59:59";
            $fexdate = strtotime($exdate);
            $cdate = time();
            $dateDiff = dateDiffInDays($fexdate, $cdate);
            $days_remaining = encrypt_decrypt($dateDiff, 'encrypt', 'opensesame', '');
            $response = update_mongo('company_licenses', array('dateDiff' => $days_remaining['data'], 'updatedOn' => new MongoDate()), array('_id' => new MongoId($value['id'])));
            if ($fexdate < time() || $dateDiff <= 0) {
                delete_mongo('company_licenses', array('_id' => new MongoId($value['id'])));
                if(!empty($value['userId'])) {
                    update_mongo('user', array('license' => '', 'status' => '0'), array('_id' => new MongoId($value['userId'])));
                }
            }
            $bIsConnected = check_internet_connection();
            if($bIsConnected)
            {
                // inform to server1 for license 
                send_data_to_server_for_verification($value);
            }
    	}
	}
}

if (isset($response)) {
    if ($response['n'] == '1') {
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "2";
}

function dateDiffInDays($date1, $date2) {
    // Calulating the difference in timestamps 
    $diff = $date2 - $date1; 
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
}
?>