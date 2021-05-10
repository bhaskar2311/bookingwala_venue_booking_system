<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
  // echo "login fail";
     header("location:loginvenueowner.php");
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
    $username = $_POST['username'];

    $exist = false;
    $sql="SELECT * FROM `venueownerpayment` WHERE `username` LIKE '$username'";
    $ans = mysqli_query($conn , $sql);
    $num = mysqli_num_rows($ans); 
    if($num == 1)
    {
         $exist = true;
    }

    $venueslotprice = $_POST['venueslotprice'];
    $tax = $_POST['tax'];
    $totalamount = $_POST['totalamount'];

    if($exist == false){
      $sql="INSERT INTO `venueownerpayment` (`username`, `venueslotprice`, `tax`, `totalamount`,`timestamp`) VALUES ( '$username', '$venueslotprice', '$tax', '$totalamount', current_timestamp())";    
        $result = mysqli_query($conn , $sql); 
        if($result)
        {
          echo'<script type="text/javascript">alert("Purchase Successful:)");</script>';
          echo '<script> location.href = "addvenue.php"; </script> ';
        }
    }
    else{
      echo'<script type="text/javascript">alert("You Have Already Purchased a Slot:)");</script>';
          echo '<script> location.href = "addvenue.php"; </script> ';
    }
        
 }
// echo "<br>";
?>



<!DOCTYPE html>
<html>
<head>
  <title>Venue Slot Purchase</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/payment.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
</head>
<body>
  <main class="page payment-page">
    <section class="payment-form dark">
      <div class="container">
        <div class="block-heading">
          <h2>Payment</h2>
          <p>Prices are low so don’t be slow</p>
        </div>
        <form method="POST" action="venueslotpurchase.php">
        <input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>"/>
          <div class="products">
            <h3 class="title">Checkout</h3>
            <div class="item">
              <span class="price">&#8377 <?php echo "$venueslotprice";?></span>
              <input type="hidden" name="venueslotprice" value="<?php echo "$venueslotprice";?>"/>
              <p class="item-name">Venue Slot</p>
              <p class="item-description">Price of Venue Slot</p>
            </div>
            <div class="item">
              <span class="price">&#8377 <?php echo "$tax";?></span>
              <input type="hidden" name="tax" value="<?php echo "$tax";?>"/>
              <p class="item-name">Tax</p>
              <p class="item-description">GST 18%</p>
            </div>
            <div class="total">Total<span class="price">&#8377 <?php echo "$totalamount";?></span></div>
            <input type="hidden" name="totalamount" value="<?php echo "$totalamount";?>"/>
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
                <button type="button" onclick="window.location.href = 'voindex.php'" class="btn btn-primary btn-block">Go to Home Page</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
</body>
<script type="text/javascript">
function JSalert(){
	swal("Congrats!", ", Payment Succesfull!", "success");
}
</script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>