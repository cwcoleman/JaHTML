<?php
include 'set-up/func.php';
session_start();

$user = $_SESSION['user'];
//$ip_add_logout = $_SERVER['REMOTE_ADDR'];

session_destroy();
header("Location:index.php");

?>