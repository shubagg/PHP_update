<?php
$process = array(
    "update" => array(
        "start" => array('action' => array("notification" => array("ticket" => array(array("key" => "from_user", "eid" => "174"),
            array("key" => "current_user", "eid" => "174"),array("key" => "creator", "eid" => "174"))))),
        "pause" => array('action' => array("notification" => array("ticket" => array(array("key" => "from_user", "eid" => "175"),
            array("key" => "current_user", "eid" => "175"),array("key" => "creator", "eid" => "175"))))),
        "stop" => array('action' => array("notification" => array("ticket" => array(array("key" => "from_user", "eid" => "176"),
            array("key" => "current_user", "eid" => "176"),array("key" => "creator", "eid" => "176"))))),
        "breached" => array('action' => array("notification" => array("ticket" => array(array("key" => "from_user", "eid" => "177"),
            array("key" => "current_user", "eid" => "177"),array("key" => "creator", "eid" => "177"))))),
        "not_breached" => array('action' => array("notification" => array("ticket" => array(array("key" => "from_user", "eid" => "178"),
            array("key" => "current_user", "eid" => "178"),array("key" => "creator", "eid" => "178"))))),
        ));
$bp_data = json_encode($process);
?>