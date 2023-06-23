<?php
error_reporting(0);
require('connect.php');
require('getUserDetails.php');

$postTitle = $_GET['postTitle'];
$i = -1;

// Get user post

$sql = "SELECT * FROM users WHERE postTitle = '$postTitle' AND type = 'post'";
$result = $conn->query($sql);
$post = $result->fetch_assoc();

$upvotePost = $post['numOfUpvotes'];
$downvotePost = $post['numOfDownvotes'];

//Get all users' comments

$sql = "SELECT * FROM users WHERE postTitle = '$postTitle' AND type = 'comment'";
$result = $conn->query($sql);
$comments = $result->fetch_all(MYSQLI_ASSOC);

$addedComment = $post['numOfComments'];

//Check if user already upvoted to post

$sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email' AND password = '$password' AND upvotedToPost = '$postTitle'";
$result = $conn->query($sql);
$getResult= $result->fetch_assoc();

if (strpos($getResult['upvotedToPost'], $postTitle) !== false)
{
  $checkIfUpvoted = $getResult['upvotedToPost'];
}
else
{
    $checkIfUpvoted = '';
}

//Check if user already downvoted to post

$sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email' AND password = '$password' AND downvotedToPost = '$postTitle'";
$result = $conn->query($sql);
$getResult= $result->fetch_assoc();

if (strpos($getResult['downvotedToPost'], $postTitle) !== false)
{
  $checkIfDownvoted = $getResult['downvotedToPost'];
}
else
{
    $checkIfDownvoted = '';
}

// Check if user already upvoted to a comment

$sql = "SELECT * FROM users WHERE username = '$username' AND postTitle = '$postTitle' AND upvotedToCommentBoolean = 'true'";
$result = $conn->query($sql);
$getResult = $result->fetch_all(MYSQLI_ASSOC);

foreach($getResult as $value){
    $checkIfUpvotedComment .= ' ' . $value['upvotedToComment'];
}

// Check if user already downvoted to a comment

$sql = "SELECT * FROM users WHERE username = '$username' AND postTitle = '$postTitle' AND downvotedToCommentBoolean = 'true'";
$result = $conn->query($sql);
$getResult = $result->fetch_all(MYSQLI_ASSOC);

foreach($getResult as $value){
    $checkIfDownvotedComment .= ' ' . $value['downvotedToComment'];
}

if(isset($_POST['commentSubmit'])){

   // Increment comment for post

   ++$addedComment;

   $sql = "UPDATE users SET numOfComments='$addedComment' WHERE postTitle = '$postTitle' AND type = 'post'";
   $result = $conn->query($sql);

    // Insert user comment

    $comment = $_POST['comment'];
    $profilePic = $userProfile['profilePic']; 

   $sql = "INSERT INTO users (username, email, password, profilePic, comment, postTitle, type) values ('$username', '$email', '$password', '$profilePic', '$comment', '$postTitle', 'comment')";

   if ($conn->query($sql) === TRUE) {
    header('location:insidePostPg.php?postTitle='.$postTitle.'');
   } 

}

?>

<html lang="eng">
<head>
<title> BestBooks.com </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootsrap 5 icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Index CSS-->
<link rel="stylesheet" href="insidePostPg.css?v=<?php echo time(); ?>">     
</head>   
<body>
  
<?PHP include 'header.php'; ?>

      <section class="home container">
        <div class="description alert alert-secondary mt-5 pb-0" role="alert">
            <div class="posted-by mb-1"><?php echo 'Posted by ' . $post['username'] . ' on ' .  $post['date']; ?></div>
            <div class="title h1"><?php echo $post['postTitle']; ?></div>
            <div class="body mt-3 fs-5"><?php echo $post['postDesc']; ?></div>
            <div class="extra d-flex mt-3">
                <div class="comments d-flex me-2">
                    <i class="bi bi-mailbox mt-1 me-1"></i>
                    <p><?php if($post['numOfComments'] > 0){?>
                        <?php echo $post['numOfComments'] . ' comments'; ?>
                    <?php } else{ ?>
                        <?php echo '0 comments' ?>
                    <?php } ?></p>
                </div>
                <div class="likComment d-flex me-2">
                    <i class="bi bi-hand-thumbs-up-fill upvotePost mt-1 me-1"></i>
                    <p class="upvote"><?php if($post['numOfUpvotes']){ ?>
                         <?php echo $post['numOfUpvotes'] . ' upvotes'; ?>
                    <?php } else{ ?>
                        <?php echo '0 upvotes'; ?>
                    <?php } ?></p>
                </div>
                <div class="dislikes d-flex me-2">
                    <i class="bi bi-hand-thumbs-down-fill downvotePost mt-1 me-1"></i>
                    <p class="downvote"><?php if($post['numOfDownvotes']){ ?>
                        <?php echo $post['numOfDownvotes'] . ' downvotes'; ?>
                    <?php } else{ ?>
                    <?php echo '0 downvotes'; ?>
                    <?php } ?></p>
                </div>
            </div>
        </div>

        <div class="line mt-3"></div>

        <div class="post-comment mt-3">
            <div class="">Post comment as <?php echo $username; ?>: </div>
            <form method="POST">
                <textarea rows="6" cols="150" name="comment"></textarea>
                <button type="submit" class="btn btn-primary mt-2" name="commentSubmit">Comment</button>
            </form>
        </div>

        <div class="comments-area mt-5">

        <?php foreach($comments as $value){ ?> 
            <div class="user-comment alert alert-secondary pb-0" role="alert">
            <div class="user-profile d-flex">
                <div class="img-wrapper">
                  <img src="<?php echo $value['profilePic'] ?>" class="profilePicComment">
                </div>
                <p class="mt-3 ms-2"><?php echo $value['username'] . ':'; ?></p>
            </div>
            <?php
            ++$i;
            ?>
            <p class="fs-5 comment" data-id="<?php echo $i ?>"><?php echo $value['comment'] ?></p>
            <div class="extra d-flex mt-3">
                <div class="d-flex me-2">
                    <i class="bi bi-hand-thumbs-up-fill upvoteComment mt-1 me-1" data-id="<?php echo $i ?>"></i>
                    <p class="upvoteCom" data-id="<?php echo $i ?>"><?php if($value['numOfUpvotes']){
                        echo $value['numOfUpvotes'] . ' upvotes';
                    } else{
                       echo '0 upvotes';
                    }?></p>
                </div>
                <div class="d-flex me-2">
                    <i class="bi bi-hand-thumbs-down-fill downvoteComment mt-1 me-1" data-id="<?php echo $i ?>"></i>
                    <p class="downvoteCom" data-id="<?php echo $i ?>"><?php if($value['numOfDownvotes']){o
                        echo $value['numOfDownvotes'] . ' downvotes';
                    } else{
                       echo '0 downvotes';
                    }?></p>
                </div>
                <div class="comments d-flex me-2">
                <i class="bi bi-reply-fill">reply</i>
                </div>
                </form>
            </div>
          </div>
        <?php } ?>
        </div>
      </section>
      <!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- AJAX code -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script>
        
        //UPVOTEPOST CODE

              document.querySelector('.upvotePost').addEventListener('click', ()=>{

               var checkIfUpvoted = '<?php echo $checkIfUpvoted; ?>';
               if(checkIfUpvoted){
                alert('You already upvoted. You cannot upvote more than once.');
               } else{
              var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.querySelector(".upvote").innerHTML = this.responseText;
        }
      };
        xhttp.open("GET", `upvotePost.php?upvotePost=<?php echo $upvotePost; ?>&postTitle=<?php echo $postTitle; ?>`, true);
        xhttp.send();
    }
              });

        //DOWNVOTEPOST CODE

              document.querySelector('.downvotePost').addEventListener('click', ()=>{

                var checkIfDownvoted = '<?php echo $checkIfDownvoted; ?>';
               if(checkIfDownvoted){
                alert('You already downvoted. You cannot downvote more than once.');
               } else{
               var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.querySelector(".downvote").innerHTML = this.responseText;
        }
      };
        xhttp.open("GET", `downvotePost.php?downvotePost=<?php echo $downvotePost; ?>&postTitle=<?php echo $postTitle; ?>`, true);
        xhttp.send();
    }
              });

              //UPVOTECOMMENT CODE

              document.querySelectorAll('.upvoteComment').forEach((upvote)=>{
                upvote.addEventListener('click', (e)=>{
                    var id = e.currentTarget.dataset.id;
                    var comment = document.querySelectorAll('.comment')[id].innerHTML;
                    var checkIfUpvotedComment = '<?php echo $checkIfUpvotedComment; ?>';
                    var checker = checkIfUpvotedComment.indexOf(comment);

                    if(checker > 0){
                        alert('You already upvoted. You cannot upvote more than once.');
                    } else{
                    
                   var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.querySelectorAll(".upvoteCom")[id].innerHTML = this.responseText;
        }
      };
        xhttp.open("GET", `upvoteComment.php?comment=${comment}`, true);
        xhttp.send();
    }

                })
              });

              //DOWNVOTECOMMENT CODE

              document.querySelectorAll('.downvoteComment').forEach((downvote)=>{
                downvote.addEventListener('click', (e)=>{
                    console.log('hiii');
                    var id = e.currentTarget.dataset.id;
                    var comment = document.querySelectorAll('.comment')[id].innerHTML;
                    console.log(comment);
                    var checkIfDownvotedComment = '<?php echo $checkIfDownvotedComment; ?>';
                    var checker = checkIfDownvotedComment.indexOf(comment);

                    if(checker > 0){
                        alert('You already downvoted. You cannot downvote more than once.');
                    } else{
                    
                   var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.querySelectorAll(".downvoteCom")[id].innerHTML = this.responseText;
        }
      };
        xhttp.open("GET", `downvoteComment.php?comment=${comment}`, true);
        xhttp.send();
    }

                })
              });
              
</script>
</body>     
</html>