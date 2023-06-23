<?php 

if(isset($_POST['updateSubmit'])){
  $profilepic_uploaded_file = $_FILES['updateProfilePic']['tmp_name'];
  $profilepic_destination_path = 'img/' . $_FILES['updateProfilePic']['name'];
$sql = "UPDATE users SET profilePic='$profilepic_destination_path' WHERE username = '$username' AND hasUserDetails = 'true'";


if ($conn->query($sql) === TRUE) {
  header('location:home.php');
} else {
  echo "Error updating record: " . $conn->error;
}

}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ms-5 fw-bold" href="#">SUICIDE CLUB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <?php if(!$username){
              echo '<a class="nav-link" href="signup.php">Sign up</a>';
              } else {
                echo '<div class="ms-1 mt-1 profilePic"><img src="'.$userProfile['profilePic'].'" class="profilePic"></div>';
              }
              ?>
            </li>
          </ul>
        </div>
      </nav>

      <div class="user-details bg-light container">
              <?php echo '<div class="ms-1 mt-1 profilePicZoom"><img src="'.$userProfile['profilePic'].'" class="profilePicZoom"></div>
              <p class="mt-1">Name: '.$username.'</p>
              <p>Email: '.$email.'</p>
              <p>Password: '.$password.'</p>
              <p>Update profile pic:-</p>
              <form method="POST" enctype="multipart/form-data">
              <div class="mb-3">
              <input class="form-control" type="file" id="formFile" name="updateProfilePic">
  </div>
  <button type="submit" class="btn btn-primary" name="updateSubmit">Submit</button>
              </form>
              <a href="signout.php"> <button class="btn btn-danger mt-4">Sign out</button> </a>';
              ?>
      </div>

      <script>
        document.querySelector('.profilePic').addEventListener('click', ()=>{
          document.querySelector('.user-details').classList.toggle('show-it');
        })

      </script>