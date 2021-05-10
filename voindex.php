<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  // echo "login fail";
  header("location:loginvenueowner.php");
  exit;
}

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

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Venue Owner Index</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
</head>

<body>
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
            <a class="nav-link " href="venueownerprofit.php"  role="button"  aria-expanded="false">
              Profit &nbsp;&nbsp;
            </a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link " data-target="#meramodal"  role="button"  aria-expanded="false">AI Chatbot -->
            <button data-toggle="modal" type="button" class="btn btn-primary" data-target="#chatbotmodal">AI ChatBot</button>
             
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


  <!-- Carousel Code  -->

  <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/img/slider2.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1 class="text-dark">Welcome To BOOKINGWALA</h1>
          <h5 class="text-light">We Make Promotions of Your Venues Simple.</h5>
          <button data-toggle="modal" type="button" class="btn btn-danger" data-target="#chatbotmodal">Ask Questions</button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/slider3.jpeg" class="d-block w-100" alt="..." style="opacity : 0.90;">
        <div class="carousel-caption d-none d-md-block">
        <h1 class="text-dark">Welcome To BOOKINGWALA</h1>
          <h5 class="text-warning">We Make Promotions of Your Venues Simple.</h5>
          <button data-toggle="modal" type="button" class="btn btn-dark" data-target="#chatbotmodal">Ask Questions</button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/slider5.jpeg" class="d-block w-100" alt="..." style="opacity : 0.75;">
        <div class="carousel-caption d-none d-md-block">
        <h1 class="text-light">Welcome To BOOKINGWALA</h1>
          <h5 class="text-dark">We Make Promotions of Your Venues Simple.</h5>
          <button data-toggle="modal" type="button" class="btn btn-success" data-target="#chatbotmodal">Ask Questions</button>
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




<!-- Pricings  -->

<div class="container py-3">
  <hr>

  <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Pricing</h1>
    <p class="fs-5 text-muted">Prices are low so don’t be slow</p>
  </div>

  <main>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
      <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('assets/img/venueowner card1.jpeg');">
        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
          <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold" style="opacity: 0.5;">Show Your Venue To The World</h2>
          
        </div>
      </div>
      </div>
      <div class="col">
      <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Purchase Venue Slot Now</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">&#8377 <?php echo "$venueslotprice";?><small class="text-muted fw-light"> LifeTime</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>*Exclusive of Taxes</li>
              <li>Life Time Support</li>
              <li>Any Venue Type</li>
              <li>Unlimited Photos</li>
            </ul>
            <button type="button" onclick="window.location.href='venueslotpurchase.php'" class="w-100 btn btn-lg btn-primary">Get started</button>
          </div>
        </div>
      </div>
      <div class="col">
      <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('assets/img/venueowner card2.jpeg');">
        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
          <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold" style="opacity: 0.78;">Become a Part of World's Biggest Venue Booking System</h2>
          
        </div>
      </div>
    </div>

   </main>





<!-- Modal  -->

<div class="modal" id="chatbotmodal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">AI ChatBot</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <iframe 
    allow="microphone;"
    width="500"
    height="430"
    src="https://console.dialogflow.com/api-client/demo/embedded/c671237f-1b0c-470a-88a7-ae5643c3eda3">
</iframe>

    </div>
  </div>
  </div>

</body>

</html>