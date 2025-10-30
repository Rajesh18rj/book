<?php
session_start();
$_SESSION['user_id'] = null;
//print_r($_SESSION); exit;

header("Location:book-login.php");

?>