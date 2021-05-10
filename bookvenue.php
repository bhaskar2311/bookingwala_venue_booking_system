<?php
session_start();
if (!isset($_SESSION['loggedinuser']) || $_SESSION['loggedinuser'] != true) {
  // echo "login fail";
  header("location:loginuser.php");
  exit;
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'database.php';
  $cusername = $_POST['cusername'];
  $username = $_POST['username'];
  $venuetype = $_POST['venuetype'];
  $venuename = $_POST['venuename'];
  $venueaddress = $_POST['venueaddress'];
  $venuepincode = $_POST['venuepincode'];
  $venuecapacity = $_POST['venuecapacity'];
  $venueprice = $_POST['venueprice'];
  $taxvb = $_POST['taxvb'];
  $totalvb = $_POST['totalvb'];
  $bookingdate = $_POST['bookingdate'];


  $sql = "INSERT INTO `bookings` (`cusername`, `username`, `venuetype`,`venuename`, `venueaddress`,`venuepincode`,`venuecapacity`,`venueprice`,`taxvb`,`totalvb`,`bookingdate`,`timestamp`) VALUES ( '$cusername', '$username', '$venuetype','$venuename', '$venueaddress','$venuepincode','$venuecapacity','$venueprice','$taxvb','$totalvb','$bookingdate', current_timestamp())";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $cut = 10;
    $percentage = ($cut / 100) * $venueprice;
    $ownergets = $venueprice - $percentage;
    $admingets = $percentage;
    $query = "INSERT INTO `venueownerprofit` (`username`, `cusername`, `venueprice`, `ownergets`,`admingets`,`timestamp`) VALUES ('$username', '$cusername', '$venueprice','$ownergets','$admingets', current_timestamp())";
    $result1 = mysqli_query($conn, $query);

    echo '<script type="text/javascript">alert("Venue Booked Successful:)");</script>';
    echo '<script> location.href = "customerbookings.php"; </script> ';
  } else {
    echo '<script type="text/javascript">alert("Not Succesfull:)");</script>';
    echo '<script> location.href = "viewvenue.php"; </script> ';
  }
}
// echo "<br>";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Venue</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/payment.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body>
  <?php
  include 'database.php';

  if (isset($_REQUEST['username'])) {
    $username = $_GET['username'];
  }
  $query = "SELECT * FROM venue where username='$username'";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result)) {
    $gstpercent = 18;
    $taxvb = ($gstpercent / 100) * $row['venueprice'];
    $totalvb = $row['venueprice'] + $taxvb;

  ?>
    <main class="page payment-page">
      <section class="payment-form dark">
        <div class="container">
          <div class="block-heading">
            <h2>Payment</h2>
            <p>Prices are low so don’t be slow</p>
          </div>
          <form method="POST" action="bookvenue.php">
            <div class="products">
              <label for="bookingdate" class="form-label">Choose Date</label>
              <input type="date" class="form-control" name="bookingdate" id="bookingdate" required>
              <!-- Response -->
              <div id="message"></div>
            </div>
            <!-- <div id="message" ></div> -->


            <input type="hidden" name="cusername" value="<?php echo $_SESSION['cusername']; ?>" />
            <input type="hidden" name="username" value="<?php echo $username; ?>" />
            <input type="hidden" name="venuetype" value="<?php echo $row['venuetype']; ?>" />
            <input type="hidden" name="venuename" id="venuename" value="<?php echo $row['venuename']; ?>" />
            <input type="hidden" name="venueaddress" value="<?php echo $row['venueaddress']; ?>" />
            <input type="hidden" name="venuepincode" value="<?php echo $row['venuepincode']; ?>" />
            <input type="hidden" name="venuecapacity" value="<?php echo $row['venuecapacity']; ?>" />
            <div class="products">
              <h3 class="title">Checkout</h3>
              <div class="item">
                <span class="price">&#8377 <?php echo $row['venueprice']; ?></span>
                <input type="hidden" name="venueprice" value="<?php echo $row['venueprice']; ?>" />
                <p class="item-name">Venue Slot</p>
                <p class="item-description">Price of Venue Slot</p>
              </div>
              <div class="item">
                <span class="price">&#8377 <?php echo "$taxvb"; ?></span>
                <input type="hidden" name="taxvb" value="<?php echo "$taxvb"; ?>" />
                <p class="item-name">Tax</p>
                <p class="item-description">GST 18%</p>
              </div>
              <div class="total">Total<span class="price">&#8377 <?php echo "$totalvb"; ?></span></div>
              <input type="hidden" name="totalvb" value="<?php echo "$totalvb"; ?>" />
              <p class="item-description">Total Amount Payable</p>

            </div>
            <div class="card-details">
              <h3 class="title">Credit Card Details</h3>
              <div class="row">
                <div class="form-group col-sm-7">
                  <label for="card-holder">Card Holder</label>
                  <input id="card-holder" type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1">
                </div>
                <div class="form-group col-sm-5">
                  <label for="">Expiration Date</label>
                  <div class="input-group expiration-date">
                    <input type="text" class="form-control" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                    <span class="date-separator">/</span>
                    <input type="text" class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                  </div>
                </div>
                <div class="form-group col-sm-8">
                  <label for="card-number">Card Number</label>
                  <input id="card-number" type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
                </div>
                <div class="form-group col-sm-4">
                  <label for="cvc">CVC</label>
                  <input id="cvc" type="text" class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
                </div>
                <div class="form-group col-sm-12">
                  <button type="submit" class="btn btn-primary btn-block">Proceed</button>
                </div>
                <div class="form-group col-sm-12">
                  <button type="button" onclick="window.location.href = 'welcome.php'" class="btn btn-primary btn-block">Go to Home Page</button>
                </div>
              </div>
            </div>
          </form>
        </div>

      <?php } ?>
      </section>
    </main>
    <script type="text/javascript">
      function JSalert() {
        swal("Congrats!", ", Payment Succesfull!", "success");
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
      $(document).ready(function() {
        $("#bookingdate").blur(function() {
          console.log($("#bookingdate").val())
          var bookingdate = $(this).val();
          // var venuename = document.getElementsById("venuename");
          $.ajax({
            url: 'ajaxfile2.php',
            async: true,
            method: 'POST',
            data: {
              bookingdate: bookingdate
            },
            success: function(data) {
              if (data == '0') {
                $("#message").html('Available');
              } else {
                $("#message").html('Booking Date Not Available');
              }
            }
          });
        });
        $("#username").click(function() {
          $("#message").html('');
        });
      });
    </script>

</body>

</html>