<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  // echo "login fail";
  header("location:loginvenueowner.php");
  exit;
}

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




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Venue</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 
  <link rel="stylesheet" href="assets/css/style1.css">
</head>

<body>
<!-- Navbar  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="voindex.php">BOOKINGWALA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <li class="nav-item">
            <a class="nav-link active" href="addvenue.php"  role="button"  aria-expanded="false">
              Manage Venue
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="addvenuephotos.php"  role="button"  aria-expanded="false">
              Add Photos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="venueownercustomerbookings.php"  role="button"  aria-expanded="false">
              Customer Bookings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="venueownerprofit.php"  role="button"  aria-expanded="false">
              Profit &nbsp;&nbsp;
            </a>
          </li>
        </ul>

        <li class="nav-item d-flex">
          <a class="nav-link" href="#">Hello , <?php echo $_SESSION['username']; ?></a>
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </div>
    </div>
  </nav>


  <!-- Card  -->
  <div class="card mb-3">
    <img src="assets/img/add venue card1.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Welcome , <?php echo $_SESSION['username']; ?></h5>
      <p class="card-text">Add Your Venue , Add Unlimited Photos of Your Venue , Make Ceremonies Memorable.</p>
      <?php
      include 'database.php';
      $user = $_SESSION['username'];
      $query = "SELECT * FROM venue where username='$user'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      if ($row) {
      ?>
        <button type="button" onclick="window.location.href='addvenuephotos.php'" class="btn btn-primary">Add Photos</button>
      <?php } else {

      ?>
        <button data-toggle="modal" type="button" class="btn btn-primary" data-target="#meramodal">Add Venue</button>
    </div>
  <?php } ?>
  <!-- <button type="button" class="btn btn-primary">Primary</button> -->
  </div>
  </div>

  <!-- Modal Form  -->
  <div class="modal" id="meramodal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Your Venue</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="addvenue.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
            <div class="mb-3">
              <input type="text" name="venuename" class="form-control form-control-lg" placeholder="Venue Name" required>
            </div>
            <div class="mb-3">
              <textarea name="venueaddress" cols="20" rows="5" class="form-control form-control-lg" placeholder="Venue Address" required></textarea>
            </div>
            <div class="mb-3">
              <input type="number" name="venuepincode" class="form-control form-control-lg" placeholder="Pin Code" required>
            </div>
            <div class="mb-3">
              <select id="venuetype" name="venuetype" class="form-control form-control-lg">
                <option value="hall">Choose Venue Type</option>
                <option value="hall">Hall</option>
                <option value="lawn">Lawn</option>
                <option value="resort">Resort</option>
              </select>
            </div>
            <div class="mb-3">
              <input type="number" name="venuecapacity" class="form-control form-control-lg" placeholder="Venue Capacity" required>
            </div>
            <div class="mb-3">
              <input type="number" name="venueprice" class="form-control form-control-lg" placeholder="Venue Price" required>
            </div>
            <div class="mb-3">
              <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png, .jfif" />
            </div>
          </div>
          <div style="clear:both;"></div>
          <div class="modal-footer">
            <button type="submit" name="signup-btn" class="btn btn-lg btn-block">Add Venue</button>
            <button class="btn btn-lg btn-block" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>


  <!-- DISPLAY YOUR VENUE  -->
  <?php
  include 'database.php';
  $user = $_SESSION['username'];
  $query = "SELECT * FROM venue where username='$user'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  if ($row) {
  ?>
  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary"><?php echo $row['venuetype']; ?></strong>
          <h3 class="mb-0"><?php echo $row['venuename']; ?></h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto"><?php echo $row['venueaddress']; ?></p>
          <div class="mb-1 text-muted">PINCODE : <?php echo $row['venuepincode']; ?></div>
          <div class="mb-1 text-muted">Seating Capacity : <?php echo $row['venuecapacity']; ?></div>
          <div class="mb-1 text-muted">Pricing/Day : &#8377 <?php echo $row['venueprice']; ?></div>
          <button data-toggle="modal" type="button" class="btn btn-danger" data-target="#mymodal" >Update Information</button>
        </div>
        <div class="col-auto d-none d-lg-block">
          <!-- <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
          <?php
                echo ' <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"height="260" width="250" class="img-thumnail"/> ';
                ?>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
        <div class="card bg-dark text-white">
  <img src="assets/img/add venue card2.jpeg" class="card-img" alt="...">
  <div class="card-img-overlay">
    <h5 class="card-title">Hello , <?php echo $_SESSION['username'] ?></h5>
    <p class="card-text">Come Together and Increase The Good Memories in Minds of People</p>
  </div>
</div>
      </div>
    </div>
  </div>
  <?php } else {
    echo "<h1>No Venue Added !!! Please Add Venue !!!</h1>";
  }

  ?>

<!-- Modal Form to Update  -->

<div class="modal" id="mymodal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Your Venue</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="updatevenue.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
            <div class="mb-3">
              <input type="text" name="venuename" class="form-control form-control-lg" placeholder="Venue Name - <?php echo $row['venuename']; ?>" required>
            </div>
            <div class="mb-3">
              <textarea name="venueaddress" cols="20" rows="5" class="form-control form-control-lg" placeholder="Venue Address - <?php echo $row['venueaddress']; ?>" required></textarea>
            </div>
            <div class="mb-3">
              <input type="number" name="venuepincode" class="form-control form-control-lg" placeholder="Pin Code - <?php echo $row['venuepincode']; ?>" required>
            </div>
            <div class="mb-3">
              <select id="venuetype" name="venuetype" class="form-control form-control-lg">
                <option value="hall">Choose Venue Type - <?php echo $row['venuetype']; ?></option>
                <option value="hall">Hall</option>
                <option value="lawn">Lawn</option>
                <option value="playground">Playground</option>
              </select>
            </div>
            <div class="mb-3">
              <input type="number" name="venuecapacity" class="form-control form-control-lg" placeholder="Venue Capacity - <?php echo $row['venuecapacity']; ?>" required>
            </div>
            <div class="mb-3">
              <input type="number" name="venueprice" class="form-control form-control-lg" placeholder="Venue Price - <?php echo $row['venueprice']; ?>" required>
            </div>
            <div class="mb-3">
              <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png, .jfif" />
            </div>
          </div>
          <div style="clear:both;"></div>
          <div class="modal-footer">
            <button type="submit" name="signup-btn" class="btn btn-lg btn-block">Add Venue</button>
            <button class="btn btn-lg btn-block" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>

</body>

</html>