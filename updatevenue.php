<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:loginvenueowner.php");
  exit;
}
include 'database.php';
$user = $_SESSION['username'];
$query = "DELETE FROM `venue` WHERE `username`='$user'";
mysqli_query($conn, $query);

if (isset($_POST["insert"])) {
  $username = $_POST['username'];
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $query = "INSERT INTO tbl_images(username,name) VALUES ('$username','$file')";
  if (mysqli_query($conn, $query)) {
    echo '<script>alert("Image Inserted into Database")</script>';
  }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'database.php';
  $username = $_POST['username'];
  $venuename = $_POST['venuename'];
  $venueaddress = $_POST['venueaddress'];
  $venuepincode = $_POST['venuepincode'];
  $venuetype = $_POST['venuetype'];
  $venuecapacity = $_POST['venuecapacity'];
  $venueprice = $_POST['venueprice'];
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

  $exist = false;
  $sql = "SELECT * FROM `venue` WHERE `username` LIKE '$username'";
  $ans = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($ans);
  if ($num == 1) {
    $exist = true;
  }

  if ($exist == false) {
    // $sql = "INSERT INTO `venue` (`username`, `venuename`, `venueaddress`, `venuepincode`,`venuetype`,`venuecapacity`,`venueprice`) VALUES ( '$username', '$venuename', '$venueaddress', '$venuepincode', '$venuetype', '$venuecapacity', '$venueprice' )";

    $sql = "INSERT INTO venue(username,venuename,venueaddress,venuepincode,venuetype,venuecapacity,venueprice,image) VALUES ('$username','$venuename', '$venueaddress', '$venuepincode', '$venuetype', '$venuecapacity', '$venueprice','$file')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo '<script type="text/javascript">alert("Venue Added Successfull:)");</script>';
      header("location: addvenue.php");
    }
  } 
  // else {
  //   echo '<script type="text/javascript">alert("You Have Already Added Venue:)");</script>';
  //   header("location: addvenue.php");
  // }
}

?>
