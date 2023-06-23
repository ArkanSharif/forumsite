<?php 

session_start();

$_SESSION["signinUsername"] = '';
$_SESSION["signinEmail"] = '';
$_SESSION["signinPassword"] = '';
$_SESSION["signinProfilePic"] = '';

header('location:home.php');


?>