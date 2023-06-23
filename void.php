<?php

error_reporting(E_ALL & ~E_WARNING);
require('connect.php');
require('getUserDetails.php');

$postTitle = $_GET['postTitle'];

header('location:insidePostPg.php?postTitle='.$postTitle .'');




?>