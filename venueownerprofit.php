<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  // echo "login fail";
  header("location:loginvenueowner.php");
  exit;
}
?>

<?php
include 'database.php';

$username = $_SESSION['username'];

$query = "SELECT SUM(ownergets) FROM `venueownerprofit` where username='$username'";
$result1 = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result1)) {
  $total = $row['SUM(ownergets)'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Owner Profit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet"> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>
    
<!-- Nav Bar Code  -->

<!-- Nav Bar  -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="voindex.php">BOOKINGWALA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <li class="nav-item">
            <a class="nav-link " href="addvenue.php"  role="button"  aria-expanded="false">
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
            <a class="nav-link active" href="venueownerprofit.php"  role="button"  aria-expanded="false">
              Profit - &#8377 <?php echo $total; ?>
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

<!-- Table Coding  -->

<!-- Table Coding  -->

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr.No.</th>
      <th scope="col">Venue Owner Username</th>
      <th scope="col">Customer Username</th>
      <th scope="col">Venue Price</th>
      <th scope="col">Venue Owner Gets</th>
      <th scope="col">Admin Gets (10%)</th>
      <th scope="col">Booking Time</th>
      
    </tr>
  </thead>
  <tbody>
  <?php

            include 'database.php';
            $username = $_SESSION['username'];
            $sql = "SELECT * FROM `venueownerprofit` where username='$username'";
            $result = mysqli_query($conn , $sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <td>". $sno . "</td>
            <td>". $row['username'] . "</td>
            <td>". $row['cusername'] . "</td>
            <td>". $row['venueprice'] . "</td>
            <td>". $row['ownergets'] . "</td>
            <td>". $row['admingets'] . "</td>
            <td>". $row['timestamp'] . "</td> 
          </tr>";}
        ?>
  </tbody>
</table>


</body>
</html>