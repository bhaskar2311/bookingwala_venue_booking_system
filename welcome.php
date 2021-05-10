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
  <title>BookingWala</title>

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


  <!-- Carousel Code  -->

  <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/img/slider6.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>Welcome To BOOKINGWALA</h2>
          <p>World's No. 1 Venue Booking Website</p>
          <a href="#venuetype"><button type="button" class="btn btn-primary">Start Exploring</button></a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/slider4.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>Welcome To BOOKINGWALA</h2>
          <p>World's No. 1 Venue Booking Website</p>
          <a href="#venuetype"><button type="button" class="btn btn-primary">Start Exploring</button></a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/slider1.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>Welcome To BOOKINGWALA</h2>
          <p>World's No. 1 Venue Booking Website</p>
          <a href="#venuetype"><button type="button" class="btn btn-primary">Start Exploring</button></a>
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


  <!-- Venue Types  -->

  <div class="album py-5 bg-light">
    <div class="container" id="venuetype">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/welcome card1.jpeg" class="d-block w-100" alt="...">
            <h4 class="center" style="text-align: center;margin: 6px;"><a href="venuelist.php?venuetype=hall">HALLS</a></h4>
            <div class="card-body">
              <p class="card-text">We have Varieties of Halls Available for Function like Marriages , Birthdays , Award Functions , Etc.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="venuelist.php?venuetype=hall"><button class="btn btn-sm btn-outline-secondary">View</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/welcome card2.jpeg" class="d-block w-100" alt="...">
            <h4 class="center" style="text-align: center; margin: 6px;"><a href="venuelist.php?venuetype=resort">RESORTS</a></h4>
            <div class="card-body">
              <p class="card-text">Book Varieties of Resorts for Family Fun Stay , Marriages , Photoshoots & Much More.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="venuelist.php?venuetype=resort"><button class="btn btn-sm btn-outline-secondary">View</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/welcome card3.jpeg" class="d-block w-100" alt="...">
            <h4 class="center" style="text-align: center;margin: 6px;"><a href="venuelist.php?venuetype=lawn">LAWNS</a></h4>
            <div class="card-body">
              <p class="card-text">Book the Lawns for Marriages , Parties , Birthdays and much more.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="venuelist.php?venuetype=lawn"><button class="btn btn-sm btn-outline-secondary">View</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>





</body>

</html>