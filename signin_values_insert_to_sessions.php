<?php

session_start();

$username = $_GET['username'];
$email = $_GET['email'];
$password = $_GET['password'];

$_SESSION["signinUsername"] = $username;
$_SESSION["signinEmail"] = $email;
$_SESSION["signinPassword"] = $password;

header('location:home.php');


?>