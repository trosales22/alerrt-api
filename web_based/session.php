<?php
//Start session
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == '')) {
    header("location: ../login/index.php");
    exit();
}
$session_id = $_SESSION['user_id'];
$session_fullname = $_SESSION['user_fullname'];
$session_email = $_SESSION['user_email'];
$session_role = $_SESSION['user_role'];
$session_profile_pic = $_SESSION['user_profile_pic'];

?>