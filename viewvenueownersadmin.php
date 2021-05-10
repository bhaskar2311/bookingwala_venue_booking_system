<?php
session_start();
if (!isset($_SESSION['loggedinadmin']) || $_SESSION['loggedinadmin'] != true) {
  // echo "login fail";
  header("location:adminlogin.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Venue Owners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet"> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
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
            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

<!-- Table Coding  -->

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr.No.</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Time of SignUp</th>
    </tr>
  </thead>
  <tbody>
  <?php
            include 'database.php';
            $sql = "SELECT * FROM `venueowners`";
            $result = mysqli_query($conn , $sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <td>". $sno . "</td>
            <td>". $row['firstname'] . "</td>
            <td>". $row['lastname'] . "</td>
            <td>". $row['username'] . "</td>
            <td>". $row['email'] . "</td>
            <td>". $row['phone'] . "</td>
            <td>". $row['timestamp'] . "</td>
          </tr>";}
        ?>
  </tbody>
</table>


</body>
</html>