<?php 

error_reporting(E_ALL & ~E_WARNING);
require('connect.php');
require('getUserDetails.php');

// Incrementing upvote

$upvotePost = $_GET['upvotePost'];
$postTitle = $_GET['postTitle'];

++$upvotePost;

$sql = "UPDATE users SET numOfUpvotes='$upvotePost' WHERE postTitle = '$postTitle' AND type = 'post'";
$result = $conn->query($sql);

echo $upvotePost . ' upvotes';

// adding it to already upvoted

$sql = "INSERT INTO users (username, email, password, upvotedToPost) VALUES ('$username', '$email', '$password', '$postTitle')";
$result = $conn->query($sql);


?>