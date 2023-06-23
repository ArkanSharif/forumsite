<?php
error_reporting(E_ALL & ~E_WARNING);
require('connect.php');
require('getUserDetails.php');

if(isset($_POST['postSubmit'])){
   $postTitle = $_POST['postTitle'];
   $postDesc = $_POST['postDesc'];

   $sql = "INSERT INTO users (username, email, password, postTitle, postDesc, postDescDotDotDot, type, upvotedToPost, downvotedToPost)
VALUES ('$username', '$email', '$password', '$postTitle', '$postDesc', '$postDesc', 'post', '0', '0')";

if ($conn->query($sql) === TRUE) {
    header('location: home.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
}

?>

<html lang="eng">
<head>
<title> ForumSite.com </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootsrap 5 icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Index CSS-->
<link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">   
</head>   
<body>
<?PHP include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-5">CREATE YOUR POST</h1>
<form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title:</label>
    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="postTitle">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description:</label>
    <textarea class="form-control" id="exampleInputPassword1" name="postDesc" rows="4" cols="50"></textarea>
  </div>
  <button type="submit" class="btn btn-primary" name="postSubmit">Submit</button>
</form>
</div>

</body>     
</html>