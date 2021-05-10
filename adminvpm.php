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
$sql = "SELECT * FROM `venueslotprice`";
$result = mysqli_query($conn , $sql);
$sno = 0;
while($row = mysqli_fetch_assoc($result)){
$sno = $sno + 1;
 $venueslotprice = $row['venueslotprice'] ;
 $tax = $row['tax'] ;
 $totalamount = $row['totalamount'] ;
}


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'database.php';
    $venueslotprice = $_POST['venueslotprice'];
    $gstpercent = 18;
    $tax = ($gstpercent / 100) * $venueslotprice;
    $totalamount = $venueslotprice + $tax ; 
    
    if($venueslotprice>=20000 && $venueslotprice<=75000){
        $sql="UPDATE `venueslotprice` SET `venueslotprice`=$venueslotprice,`tax`=$tax,`totalamount`=$totalamount WHERE `id` = 1"; 
        $result = mysqli_query($conn , $sql); 
        if($result)
        {
          echo'<script type="text/javascript">alert("Update Successful:");</script>';
          echo '<script> location.href = "adminvpm.php"; </script> ';
        }
    }
    else{
        echo'<script type="text/javascript">alert("Update Not Successful!!!Please Keep The Price Between 20000 And 75000)");</script>';
        echo '<script> location.href = "adminvpm.php"; </script> ';
    }
}     
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Slot Price Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css?v=<?php echo time();?>" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/adminvpm.css?v=<?php echo time();?>">
</head>
<body>
<!-- Nav Bar Code  -->

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
            <a class="nav-link active" href="adminvpm.php">Price Management</a>
          </li>
        </ul>

      </div>
      <li class="nav-item d-flex">
          <a class="nav-link" href="#">Hello , <?php echo $_SESSION['ausername']; ?></a>
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
    </div>
  </nav>



<div class="card text-center">
  <div class="card-header">
    Admin
  </div>
  <div class="card-body">
    <h5 class="card-title">Current Price</h5>
    <p class="card-text">Venue Slot Price : - &#8377 <?php echo "$venueslotprice";?></p>
    <p class="card-text">Total Tax : - &#8377 <?php echo "$tax";?></p>
    <p class="card-text">Total Amount : - &#8377 <?php echo "$totalamount";?></p>
  </div>
</div>

<br><br>
<form method="POST" action="adminvpm.php">
<div class="row g-3 align-items-center">
  <div class="col-auto">
    <label for="venueslotprice" class="col-form-label">New Price</label>
  </div>
  <div class="col-auto">
    <input type="number" id="venueslotprice" name="venueslotprice" class="form-control" >
  </div>
  <div class="col-auto">
    <span>
    <button type="submit" class="btn btn-primary btn-block">Update</button>
    </span>
  </div>
</div>
</form>

</body>
</html>