<?php

error_reporting(E_ALL & ~E_WARNING);

require('connect.php');
require('user_validator.php');

if(isset($_POST['submit'])){

    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, email, password, profilePic, hasUserDetails)
           VALUES ('$username', '$email', '$password', 'img/defaultpic.jpg', 'true')";
      
    if ($conn->query($sql) === TRUE) {
        header('location: signin.php');
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
<link rel="stylesheet" href="signup.css?v=<?php echo time(); ?>">   
</head> 
<style>
  .user-details{
    position: fixed;
    left: 200px;
    z-index: 1;
    width: 300px;
    height: 0px;
    overflow: hidden;
    transition: height 0.5s;
}

.show-it{
    height: 275px;
}
</style>   
<body>

<?PHP include 'header.php'; ?>

      <section class="signup container">
        <div class="text-center h1 my-5">SIGN UP FORM</div>
      <form action="" method="POST">
      <div class="mb-3">
    <label for="exampleInputUsername" class="form-label">Username</label>
    <input class="form-control" id="exampleInputUsername" aria-describedby="usernameHelp" name="username" value="<?php echo $_POST['username'] ?? ''?>">
    <div class="error">
                <?php echo $errors['username'] ?? '' ?>
            </div>
  </div>      
  <div class="mb-3">
    <label for="exampleInputEmail" class="form-label">Email</label>
    <input class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="<?php echo $_POST['email'] ?? ''?>">
    <div class="error">
                <?php echo $errors['email'] ?? '' ?>
            </div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword" class="form-label">Password</label>
    <input class="form-control" id="exampleInputPassword" name="password" value="<?php echo $_POST['password'] ?? '' ?>">
    <div class="error">
                <?php echo $errors['password'] ?? '' ?>
            </div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
<div class="h1 text-center"> OR </div>
<div class="text-center"><a href="signin.php">Have an account? Click here to sign in</a>
</div>
      </section>
</body>     
</html>