<?php 

error_reporting(E_ALL & ~E_WARNING);
require('connect.php');
require('getUserDetails.php');

if(isset($_POST['commentSubmit'])){

    $comment = $_POST['comment'];
    $profilePic = $userProfile['profilePic']; 

   $sql1 = "INSERT INTO users (username, email, password, profilePic, comment, type) values ('$username', '$email', '$password', '$profilePic', '$comment', 'comment')";
   $result = $conn->query($sql);

   if ($conn->query($sql1) === TRUE) {
    header('location: home.php');
  } 
}

?>

<div class="post-comment mt-3">
            <div class="">Post comment as <?php echo $username; ?>: </div>
            <form method="POST">
                <input name="comment">
                <button type="submit" class="btn btn-primary mt-2" name="commentSubmit">Comment</button>
            </form>
        </div>