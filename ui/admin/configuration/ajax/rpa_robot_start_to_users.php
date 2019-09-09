<?php
include_once '../../../../global.php';
$data = array();
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $_SESSION['robot_status_user']['userId'] = $_POST['user_id'];
} else {
    unset($_SESSION['robot_status_user']['userId']);
}
if (isset($_POST['strt_date']) && !empty($_POST['strt_date'])) {
    $_SESSION['robot_status_user']['strt_date'] = $_POST['strt_date'];
    $_SESSION['robot_status_user']['end_date'] = date('Y-m-d');
} else {
    unset($_SESSION['robot_status_user']['strt_date']);
    unset($_SESSION['robot_status_user']['end_date']);
}
?>