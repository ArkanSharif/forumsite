<?php 
error_reporting(0);
require('connect.php');
require('getUserDetails.php');

// Incrementing upvote

$comment = $_GET['comment'];

$sql = "SELECT * FROM users WHERE comment = '$comment' AND type = 'comment'";
$result = $conn->query($sql);
$getResult = $result->fetch_assoc();

$postTitle = $getResult['postTitle'];
$numOfDownvotes = $getResult['numOfDownvotes']; 

// check if user has downvoted from db

$sql = "SELECT * FROM users WHERE username = '$username' AND postTitle = '$postTitle' AND downvotedToComment = '$comment'";
$result = $conn->query($sql);
$checkIfUserHasDownvoted = $result->num_rows;

if($checkIfUserHasDownvoted > 0){
    echo $numOfDownvotes . ' downvotes';
} else{

// if not increment and update 

++$numOfDownvotes; 

$sql = "UPDATE users SET numOfDownvotes='$numOfDownvotes' WHERE comment = '$comment' AND type = 'comment'";
$result = $conn->query($sql);

// posts to db that specific user has downvoted 

$sql = "INSERT INTO users (username, email, password, postTitle, downvotedToComment, downvotedToCommentBoolean) VALUES ('$username', '$email', '$password', '$postTitle', '$comment', 'true')";
$result = $conn->query($sql);

echo $numOfDownvotes . ' downvotes';


}

?>