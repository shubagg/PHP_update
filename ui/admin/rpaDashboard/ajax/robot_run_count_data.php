<?php
include_once '../../../../global.php';
$data = array();
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $_SESSION['robot_run_count']['userId'] = $_POST['user_id'];
} else {
    unset($_SESSION['robot_run_count']['userId']);
}
if (isset($_POST['strt_date']) && !empty($_POST['strt_date'])) {
    $_SESSION['robot_run_count']['strt_date'] = $_POST['strt_date'];
} else {
    unset($_SESSION['robot_run_count']['strt_date']);
}
?>