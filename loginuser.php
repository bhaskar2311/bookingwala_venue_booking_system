<?php
$login = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'database.php';
    $cusername = $_POST["cusername"];
    $password = $_POST["password"];

    // $sql="SELECT * FROM `users` WHERE `cusername` LIKE '$cusername' AND `password` LIKE '$password'";
    $sql="SELECT * FROM `users` WHERE `cusername` LIKE '$cusername'";
    $result = mysqli_query($conn , $sql);
    $num= mysqli_num_rows($result);
    if ( $num == 1 )
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        if (password_verify($password, $row['password'])) {
          session_start();
          $_SESSION['loggedinuser'] = true;
          $_SESSION['cusername'] = $cusername;
          echo'<script type="text/javascript">alert("Login successful!!  Welcome");</script>';
          echo '<script> location.href = "welcome.php"; </script> ';
      }
      else{
        echo'<script type="text/javascript">alert("Wrong Password!!!Enter Correct Password");</script>';
      echo '<script> location.href = "#"; </script> ';
      }
    }
  }     
    else
    {
      echo'<script type="text/javascript">alert("Wrong login details!!!");</script>';
      echo '<script> location.href = "#"; </script> ';
}
    
}
?>


<!-- FRONTEND -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">
  <title>BookingWala - Login</title>
</head>
<body>


  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth login">
        <h3 class="text-center form-title">Login</h3>
        <form action="loginuser.php" method="post">
          <div class="form-group">
            <!-- <label>Email</label> -->
            <input type="text" name="cusername" id="cusername" class="form-control form-control-lg" placeholder="username">
          </div>
          <div class="form-group">
            <!-- <label>Password</label> -->
            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password">
          </div>

          <div class="form-group">
            <button type="submit" id="login-button" name="login-btn" class="btn btn-lg btn-block">Login</button>
          </div>
        </form>
        <p>Don't yet have an account? <a href="signupuser.php">Sign up</a></p>
        
      </div>
    </div>
  </div>
</body>
</html>