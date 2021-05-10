<?php
session_start();
if (!isset($_SESSION['loggedinuser']) || $_SESSION['loggedinuser'] != true) {
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
    <title>VIEW VENUES</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <style>
        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 180px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 300px;
            height: 300px;
            border-radius: 5px;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }

        .box {

            border-radius: 5px;
            margin: 10px 10px;
        }
    </style>

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

    <?php
    include 'database.php';

    if (isset($_REQUEST['username'])) {
        $username = $_GET['username'];
    }
        $query = "SELECT * FROM venue where username='$username'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {

    ?>

    <div class="row mb-2">

        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary"><?php echo $row['venuetype']; ?></strong>
                    <h3 class="mb-0"><?php echo $row['venuename']; ?></h3>
                    <p class="card-text mb-auto"><?php echo $row['venueaddress']; ?></p>
                    <div class="mb-1 text-muted">PINCODE : <?php echo $row['venuepincode']; ?></div>
                    <div class="mb-1 text-muted">Seating Capacity : <?php echo $row['venuecapacity']; ?></div>
                    <div class="mb-1 text-muted">Pricing/Day : &#8377 <?php echo $row['venueprice']; ?></div>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <?php
                    echo ' <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"height="250" width="200" class="img-thumnail"/> ';
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success"><?php echo $row['venuetype']; ?></strong>
          <h3 class="mb-0"><?php echo $row['venuename']; ?></h3>
          <p class="mb-auto">Book This Venue and Make Your Function Memorable.</p>
          <a href="bookvenue.php?username=<?php echo $username;?>"><button type="button" class="btn btn-primary">Book Now</button></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <h1>VIEW MORE PHOTOS OF THIS VENUE</h1>
    <div class="container center">
        <?php
        $query = "SELECT * FROM tbl_images where username='$username' ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="card gallery" style="width: 20rem;">
                <?php
                echo '
                    <img class="card-img-top box" src="data:image/jpeg;base64,' . base64_encode($row['name']) . '" height="400" width="400" class="img-thumnail" />
                    ';
                ?>
            </div>

    </div>

<?php
        } }
?>
</table>
</div>
</body>

</html>