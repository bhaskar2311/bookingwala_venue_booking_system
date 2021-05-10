<?php
session_start();
if(!isset($_SESSION['loggedinuser']) || $_SESSION['loggedinuser'] != true)
{
  // echo "login fail";
     header("location:loginuser.php");
     exit;
}
?>

<?php
 if (isset($_REQUEST['venuetype'])) {
    $venuetype = $_GET['venuetype'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View <?php echo $venuetype ?></title>
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
            <a class="nav-link " aria-current="page" href="customerbookings.php">MyBookingHistory</a>
          </li>
        </ul>

        <li class="nav-item d-flex">
          <a class="nav-link" href="#">Hello , <?php echo $_SESSION['cusername']; ?></a>
          <a class="nav-link" href="logout.php">Logout</a>
        </li>


      </div>
    </div>
  </nav>



    <!-- View Halls  -->
    <div class="row mb-2">



    <?php
    include 'database.php';
    $query = "SELECT * FROM venue where venuetype='$venuetype'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) { 
    ?>
        <br>
        <div class="col-md-6">
        <div class="card d-inline-block">
        <div class="card-body">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static" style="width:600px; height:300px;">
                        <strong class="d-inline-block mb-2 text-primary"><?php echo $row['venuetype']; ?></strong>
                        <h3 class="mb-0"><?php echo $row['venuename']; ?></h3>
                        <div class="mb-1 text-muted">Nov 12</div>
                        <p class="card-text mb-auto"><?php echo $row['venueaddress']; ?></p>
                        <div class="mb-1 text-muted">PINCODE : <?php echo $row['venuepincode']; ?></div>
                        <div class="mb-1 text-muted">Seating Capacity : <?php echo $row['venuecapacity']; ?></div>
                        <div class="mb-1 text-muted">Pricing/Day : &#8377 <?php echo $row['venueprice']; ?></div>
                        <a href="viewvenue.php?username=<?php echo $row['username'];?>">VIEW</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <!-- <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
                        <?php
                        echo ' <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"height="250" width="200" class="img-thumnail"/> ';
                        ?>
                        </div>
                        </div>
                    </div>
                </div>
           </div>
    <?php } ?>
    </div>
           
        
</body>

</html>