<?php
// 2 hours in seconds
$inactive = 900; 
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours

session_start();

if (isset($_SESSION['timeout']) && (time() - $_SESSION['timeout'] > $inactive)) {
    // last request was more than 2 hours ago
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}

if (isset($_SESSION['user'])) {
    $_SESSION['timeout'] = time(); // Update session timeout
}
else {
    header("Location: /login");
}

?>
