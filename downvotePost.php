<?php 

error_reporting(E_ALL & ~E_WARNING);
require('connect.php');
require('getUserDetails.php');

// Incrementing downvote

$downvotePost = $_GET['downvotePost'];
$postTitle = $_GET['postTitle'];

++$downvotePost;

$sql = "UPDATE users SET numOfDownvotes='$downvotePost' WHERE postTitle = '$postTitle' AND type = 'post'";
$result = $conn->query($sql);

echo $downvotePost . ' downvotes';

// adding it to already downvoted

$sql = "INSERT INTO users (username, email, password, downvotedToPost) VALUES ('$username', '$email', '$password', '$postTitle')";
$result = $conn->query($sql);

?>
