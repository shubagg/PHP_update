<?php
include_once '../../../../global.php';
$data = array();
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $_SESSION['task_done']['userId'] = $_POST['user_id'];
} else {
    unset($_SESSION['task_done']['userId']);
}
if (isset($_POST['strt_date']) && !empty($_POST['strt_date'])) {
    $_SESSION['task_done']['strt_date'] = $_POST['strt_date'];
} else {
    unset($_SESSION['task_done']['strt_date']);
}
if (isset($_POST['robot_id']) && !empty($_POST['robot_id'])) {
    $_SESSION['task_done']['robotId'] = $_POST['robot_id'];
} else {
    unset($_SESSION['task_done']['robotId']);
}
?>