<?php
session_start();
if(!isset($_SESSION['loggedinuser']) || $_SESSION['loggedinuser'] != true)
{
  // echo "login fail";
     header("location:loginuser.php");
     exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Bookings</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Nav Bar  -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="welcome.php">BOOKINGWALA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="venuelist.php?venuetype=hall">Halls</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="venuelist.php?venuetype=resort">Resorts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="venuelist.php?venuetype=lawn">Lawns</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="customerbookings.php">MyBookingHistory</a>
          </li>
        </ul>

        <li class="nav-item d-flex">
          <a class="nav-link" href="#">Hello , <?php echo $_SESSION['cusername']; ?></a>
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
      <th scope="col">Customer Username</th>
      <th scope="col">Venue Owner Username</th>
      <th scope="col">Venue Type</th>
      <th scope="col">Venue Name</th>
      <th scope="col">Venue Address</th>
      <th scope="col">Venue Pincode</th>
      <th scope="col">Venue Capacity</th>
      <th scope="col">Booking Date</th>
      <th scope="col">Booking Time</th>
      <th scope="col">Invoice</th>
      
    </tr>
  </thead>
  <tbody>
  <?php
  $cusername=$_SESSION['cusername'];

            include 'database.php';
            $sql = "SELECT * FROM `bookings` where cusername='$cusername'";
            $result = mysqli_query($conn , $sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <td>". $sno . "</td>
            <td>". $row['cusername'] . "</td>
            <td>". $row['username'] . "</td>
            <td>". $row['venuetype'] . "</td>
            <td>". $row['venuename'] . "</td>
            <td>". $row['venueaddress'] . "</td>
            <td>". $row['venuepincode'] . "</td>
            <td>". $row['venuecapacity'] . "</td>
            <td>". $row['bookingdate'] . "</td>
            <td>". $row['timestamp'] . "</td> 
            <td> <a href='invoicevb.php?timestamp=". $row['timestamp'] . "'><button class='edit btn btn-sm btn-primary'>Invoice</button> <td>
          </tr>";}
        ?>
  </tbody>
</table>

</body>
</html>