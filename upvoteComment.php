<?php 
error_reporting(0);
require('connect.php');
require('getUserDetails.php');

$comment = $_GET['comment'];

$sql = "SELECT * FROM users WHERE comment = '$comment' AND type = 'comment'";
$result = $conn->query($sql);
$getResult = $result->fetch_assoc();

$postTitle = $getResult['postTitle'];
$numOfUpvotes = $getResult['numOfUpvotes']; 

// check if user has upvoted from db

$sql = "SELECT * FROM users WHERE username = '$username' AND postTitle = '$postTitle' AND upvotedToComment = '$comment'";
$result = $conn->query($sql);
$checkIfUserHasUpvoted = $result->num_rows;

if($checkIfUserHasUpvoted > 0){
    echo $numOfUpvotes . ' upvotes';
} else{

// if not increment and update    

++$numOfUpvotes; 

$sql = "UPDATE users SET numOfUpvotes='$numOfUpvotes' WHERE comment = '$comment' AND type = 'comment'";
$result = $conn->query($sql);

// posts to db that specific user has upvoted 

$sql = "INSERT INTO users (username, email, password, postTitle, upvotedToComment, upvotedToCommentBoolean) VALUES ('$username', '$email', '$password', '$postTitle', '$comment', 'true')";
$result = $conn->query($sql);

echo $numOfUpvotes . ' upvotes';
} 








/*$sql = "SELECT * FROM users WHERE comment = '$comment' AND type = 'comment'";
$result = $conn->query($sql);
$getResult= $result->fetch_assoc();

$numOfUpvotes = $getResult['numOfUpvotes'];

if($numOfUpvotes > 0){
    echo '<i class="bi bi-hand-thumbs-up-fill upvoteCommentAlready mt-1 me-1"></i>
<p class="upvoteCom" data-id="<?php echo $i ?>">
    '.$numOfUpvotes.' upvotes
</p>';
} else{

++$numOfUpvotes; 

$sql = "UPDATE users SET numOfUpvotes='$numOfUpvotes' WHERE comment = '$comment' AND type = 'comment'";
$result = $conn->query($sql);

echo '<i class="bi bi-hand-thumbs-up-fill upvoteCommentAlready mt-1 me-1"></i>
<p class="upvoteCom"">
    '.$numOfUpvotes.' upvotes
</p>';

// specific user has upvoted and can't upvote again

$sql = "INSERT INTO users (username, email, password, upvotedToPost) VALUES ('$username', '$email', '$password', '$comment')";
$result = $conn->query($sql);

}*/



?>