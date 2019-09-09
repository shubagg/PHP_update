<?php
include_once '../../../../global.php';
$data = array();
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $_SESSION['scheduler_user']['userId'] = $_POST['user_id'];
} else {
    unset($_SESSION['scheduler_user']['userId']);
}
if (isset($_POST['strt_date']) && !empty($_POST['strt_date'])) {
    $_SESSION['scheduler_user']['strt_date'] = $_POST['strt_date'];
} else {
    unset($_SESSION['scheduler_user']['strt_date']);
}
?>