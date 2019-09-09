<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.gc_maxlifetime', 360000);
// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(360000);
session_start();
//print_r($_SESSION);
//echo "time=".time()." - ".$_SESSION['LAST_ACTIVITY'];
//echo "asdasd=".(intval(time())-intval($_SESSION['LAST_ACTIVITY']));
if (isset($_SESSION['LAST_ACTIVITY']) && ((intval(time())-intval($_SESSION['LAST_ACTIVITY'])) > 3600)) {
  //echo "session out";
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$time = time();
$_SESSION['LAST_ACTIVITY'] = $time;
/*if(!isset($noclose)){
	session_write_close();
}*/
?>