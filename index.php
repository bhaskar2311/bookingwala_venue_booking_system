<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKINGWALA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</head>
<body>
    <!-- NAVBAR  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BOOKINGWALA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo $_SESSION['username'];?></a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Add Venue
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="loginvenueowner.php">Venue Owner Login</a></li>
                            <li><a class="dropdown-item" href="signupvenueowner.php">Venue Owner Sign Up</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button> -->
                    <a class="nav-link" href="loginuser.php">Sign In</a>
                </form>


            </div>
        </div>
    </nav>


    <!-- CAROUSEL  -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/index slider1.jpeg" class="d-block w-100" alt="..." style="opacity : 0.8;">
      <div class="carousel-caption d-none d-md-block">
          <h1 class="text-light">Welcome To BOOKINGWALA</h1>
          <h5 class="text-dark">World's No. 1 Venue Booking Website</h5>
          <button type="button" onclick="window.location.href='welcome.php';" class="btn btn-danger" >Explore With Us</button>
        </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/index slider2.jpeg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      <h1 class="text-light">Welcome To BOOKINGWALA</h1>
          <h5 class="text-dark">World's No. 1 Venue Booking Website</h5>
          <button type="button" onclick="window.location.href='welcome.php';" class="btn btn-danger" >Explore With Us</button>
        </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/index slider3.jpeg" class="d-block w-100" alt="..." style="opacity : 0.8;">
      <div class="carousel-caption d-none d-md-block">
      <h1 class="text-dark">Welcome To BOOKINGWALA</h1>
          <h5 class="text-dark">World's No. 1 Venue Booking Website</h5>
          <button type="button" onclick="window.location.href='welcome.php';" class="btn btn-danger" >Explore With Us</button>
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


 
<!-- FEATURES  -->

<div class="container py-5" id="custom-cards">

<hr>
  <div class="row row-cols-3 align-items-stretch py-5  ">
    <div class="col">
      <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('assets/img/index card1.jpeg');">
        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
          <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Explore The Best With Us</h2>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('assets/img/index card4.jpeg');">
        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
          <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">World's Biggest Venue Booking Platform</h2>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('assets/img/index card3.jpeg');">
        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
          <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Book Your Venue Now</h2>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>