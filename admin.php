<?php
session_start();
if (!isset($_SESSION['loggedinadmin']) || $_SESSION['loggedinadmin'] != true) {
  // echo "login fail";
  header("location:adminlogin.php");
  exit;
}
?>


<?php
include 'database.php';

$sql = "SELECT SUM(venueslotprice) FROM `venueownerpayment`";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  $totalvenueslotsell = $row['SUM(venueslotprice)'];
}

$query = "SELECT SUM(admingets) FROM `venueownerprofit`";
$result1 = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result1)) {
  $totalcommision = $row['SUM(admingets)'];
}

$total = $totalvenueslotsell + $totalcommision;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - BOOKINGWALA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet"> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="assets/css/admin.css"> -->
</head>

<body>
  <!-- Nav Bar Code  -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="admin.php">BOOKINGWALA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              View Users
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="viewusersadmin.php">Customers</a></li>
              <li><a class="dropdown-item" href="viewvenueownersadmin.php">Venue Owners</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Transaction History
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="thistorycustomerbooking.php">Customer Bookings</a></li>
              <li><a class="dropdown-item" href="thistoryvenueslotadmin.php">Venue Owner Purchase</a></li>
              <!-- 't' means transaction..This are all transactions hence only admin can able to view this. -->
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminvpm.php">Price Management</a>
          </li>
        </ul>

        
      </div>
      <li class="nav-item d-flex">
          <a class="nav-link" href="#">Hello , <?php echo $_SESSION['ausername']; ?></a>
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

    </div>
  </nav>


  <!-- Caraousel  -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/img/admin slider1.jpeg" class="d-block w-100" alt="..." style="opacity: 0.75;">
        <div class="carousel-caption d-none d-md-block">
          <h1 class="text-dark">BOOKINGWALA - ADMIN</h1>
          <h4 class="text-dark">Total Earnings : &#8377 <?php echo "$total"; ?> </h4>
          <button type="button" onclick='window.location.href="adminvpm.php"' class="btn btn-primary">Price Managment</button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/admin slider2.jpeg" class="d-block w-100" alt="..." style="opacity: 0.65;">
        <div class="carousel-caption d-none d-md-block">
          <h1 class="text-dark">BOOKINGWALA - ADMIN</h1>
          <h4 class="text-dark">Total Earnings : &#8377 <?php echo "$total"; ?> </h4>
          <button type="button" onclick='window.location.href="adminvpm.php"' class="btn btn-primary">Price Managment</button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/admin slider3.jpeg" class="d-block w-100" alt="..." style="opacity: 0.9;">
        <div class="carousel-caption d-none d-md-block">
          <h1 class="text-dark">BOOKINGWALA - ADMIN</h1>
          <h4 class="text-dark">Total Earnings : &#8377 <?php echo "$total"; ?> </h4>
          <button type="button" onclick='window.location.href="adminvpm.php"' class="btn btn-primary">Price Managment</button>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



  <!-- Cards  -->
  <div class="container my-4">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Earnings - Selling Venue Slots</h5>
            <p class="card-text">Total Earnings by Selling Venue Slot to Venue Owners : &#8377 <?php echo "$totalvenueslotsell"; ?> </p>
            <a href="thistoryvenueslotadmin.php" class="btn btn-primary">View Full History</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Earnings - Commision on Venue Bookings</h5>
            <p class="card-text">Total Earnings by Selling Venue Slot to Venue Owners : &#8377 <?php echo "$totalcommision"; ?></p>
            <a href="thistoryadmincommision.php" class="btn btn-primary">View Full History</a>
          </div>
        </div>
      </div>
    </div>
  </div>



</body>

</html>