<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'database.php';
    $first_name=$_POST['firstname'];
    $last_name=$_POST['lastname'];
    $cusername = $_POST['cusername'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $hashpassword = password_hash($password, PASSWORD_DEFAULT);

    $exist = false;
    $sql="SELECT * FROM `users` WHERE `cusername` LIKE '$cusername'";
    $ans = mysqli_query($conn , $sql);
    $num = mysqli_num_rows($ans); 

    if($num == 1)
    {
         $exist = true;
    }

    $sql1="SELECT * FROM `users` WHERE `email` LIKE '$email'";
    $ans1 = mysqli_query($conn , $sql1);
    $num1 = mysqli_num_rows($ans1); 

    if($num1 == 1)
    {
         $exist = true;
    }
    
    // Logic for signup 
    if(( $password == $cpassword) && $exist == false)
    {
        $sql="INSERT INTO `users` (`firstname`, `lastname`, `cusername`, `email`,`phone`, `password`, `timestamp`) VALUES ( '$first_name', '$last_name', '$cusername', '$email','$phone', '$hashpassword', current_timestamp())";
        
        $result = mysqli_query($conn , $sql);
        
        if($result)
        {
          echo'<script type="text/javascript">alert("Sign Up successful!!..Login to continue:)");</script>';
          echo '<script> location.href = "loginuser.php"; </script> ';
        }
       
    }
    else
    {
        if($exist == true)
        {
          echo'<script type="text/javascript">alert("Email already exists!!!...Login to Continue:)");</script>';
          echo '<script> location.href = "loginuser.php"; </script> ';
        }
        
        else
        {
          echo'<script type="text/javascript">alert("Password do not match!!!...Enter password again:)");</script>';
        }
    }
}
echo "<br>";
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>BookingWala - Create Account</title>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth">
        <h3 class="text-center form-title">Register</h3>
    
        <form action="signupuser.php" method="post">
        <div class="form-group">
            <input type="text" name="firstname" class="form-control form-control-lg" placeholder="First Name" required>
          </div>
          <div class="form-group">
            <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Last Name" required>
          </div>
          <div class="form-group">
            <input type="text" id="txt_cusername" name="cusername" class="form-control form-control-lg" placeholder="Username" required>
            <!-- Response -->
          <div id="uname_response" ></div>
          </div>
          <div class="form-group">
            <input type="text" id="#txt_email" name="email" class="form-control form-control-lg" placeholder="Email" required>
          </div>
          <div class="form-group">
            <input type="number" name="phone" class="form-control form-control-lg" placeholder="Phone Number" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control form-control-lg" placeholder="Password" required>
            <h6 style="color:#d8da53d4;">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</h6>
          </div>
          <div class="form-group">
            <input type="password" name="cpassword" id="cpassword" class="form-control form-control-lg" placeholder="Confirm Password" required>
            <span id='message'></span>
          </div>
        <!-- <div class="form-group">
          <label for="rolelist">Select role:</label>
          <select class="form-control form-control-lg" name="role" id="rolelist">
            <option>Admin</option>
            <option>Manager</option>
            <option>Treasurer</option>
            <option>Applicant</option>
          </select>
        </div> -->
          <div class="form-group">
            <button type="submit" name="signup-btn" class="btn btn-lg btn-block">Sign Up</button>
          </div>
        </form>
        <p>Already have an account? <a href="loginuser.php">Login</a></p>
        <p>Go to Home Page <a href="index.php">Home Page</a></p>
      </div>
    </div>
  </div>
</body>
</html>


<script>
$(document).ready(function(){

   $("#txt_cusername").keyup(function(){

      var cusername = $(this).val().trim();

      if(cusername != ''){

         $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {cusername: cusername},
            success: function(response){

                $('#uname_response').html(response);

             }
         });
      }else{
         $("#uname_response").html("");
      }

    });

 });
</script>

<script>
$('#cpassword').on('keyup', function () {
    if ($(this).val() == $('#password').val()) {
        $('#message').html('Password Matching').css('color', 'green');
    } else $('#message').html('Not matching').css('color', 'red');
});
</script>