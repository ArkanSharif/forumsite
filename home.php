<?php
error_reporting(E_ALL & ~E_WARNING);
require('connect.php');
require('getUserDetails.php');

$sql = "SELECT * FROM users WHERE type = 'post'";
$result = $conn->query($sql);
$posts = $result->fetch_all(MYSQLI_ASSOC);
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

      <section class="home container">
        <div class="text-center mt-5"><a href="createPost.php"><button type="button" class="btn btn-secondary btn-lg"><i class="bi bi-plus-lg plus"></i></button></a></div>
        <div class="postal-area mt-5">
          <?php foreach($posts as $value) 
             echo '<a href="insidePostPg.php?postTitle='.$value['postTitle'].'">
             <div class="alert alert-dark pb-0 post" role="alert">
             <div class="title"><h4>'.$value['postTitle'].'</h4><span>Posted by '.$value['username'].' on '.$value['date'].'</span></div>
             <p class="desc mt-3">'.$value['postDescDotDotDot'].'</p>
           </div>
           </a>';
          ?>
        </div>
      </section>
</body>     
</html>