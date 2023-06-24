<?php 

require('connect.php');

session_start();

$username = $_SESSION["signinUsername"];
$email = $_SESSION["signinEmail"];
$password = $_SESSION["signinPassword"];

$sql = "SELECT * FROM users WHERE username = '$username' AND hasUserDetails = 'true'";
$result = $conn->query($sql);
$userProfile = $result->fetch_assoc();

$profilePic = $userProfile['profilePic'];


?>