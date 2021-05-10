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

if (isset($_REQUEST['timestamp'])) {
    $timestamp = $_GET['timestamp'];
}

$cusername=$_SESSION['cusername'];

include 'database.php';
$sql = "SELECT * FROM `bookings` where cusername='$cusername' AND timestamp='$timestamp'";
$result = mysqli_query($conn , $sql);
$row = mysqli_fetch_assoc($result);
// $cusername = $row['cusername'];
$username = $row['username'];
$venuetype = $row['venuetype'];
$venuename = $row['venuename'];
$venueaddress = $row['venueaddress'];
$venuepincode = $row['venuepincode'];
$venueprice = $row['venueprice'];
$taxvb = $row['taxvb'];
$totalvb = $row['totalvb'];
$bookingdate = $row['bookingdate'];
$timestamp = $row['timestamp'];
$venuecapacity = $row['venuecapacity'];

$sql1 = "SELECT * FROM `users` where cusername='$cusername'";
$result1 = mysqli_query($conn , $sql1);
$row1 = mysqli_fetch_assoc($result1);

$cfname = $row1['firstname'];
$clname = $row1['lastname'];
$cemail = $row1['email'];
$cphone = $row1['phone'];

$sql2 = "SELECT * FROM `venueowners` where username='$username'";
$result2 = mysqli_query($conn , $sql2);
$row2 = mysqli_fetch_assoc($result2);

$fname = $row2['firstname'];
$lname = $row2['lastname'];
$email = $row2['email'];
$phone = $row2['phone'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?php echo $_SESSION['cusername'];?></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="assets/css/invoice.css">
</head>
<body>

<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <a href="welcome.php"><button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> HomePage</button></a>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                    <h1><a href="welcome.php">
                            BookingWala
                            </a></h1>
                    </div>
                    <div class="col company-details">
                    <h2 class="name"><?php echo $fname;?> <?php echo $lname; ?></h2>
                        </h2>
                        <div class="phone">Phone No. - <?php echo $phone; ?></div>
                        <div class="email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?php echo $cfname;?> <?php echo $clname; ?></h2>
                        <div class="phone">Phone No. - <?php echo $cphone; ?></div>
                        <div class="email"><a href="mailto:<?php echo $cemail; ?>"><?php echo $cemail; ?></a></div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE</h1>
                        <div class="date">Time of Booking: <?php echo $timestamp; ?></div>
                        <div class="date">Booking Date: <?php echo $bookingdate; ?></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">Venue Capacity</th>
                            <th class="text-right">Booking Date</th>
                            <th class="text-right">TOTAL Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="no">01</td>
                            <td class="text-left">
                            <h3>
                                <a  href="#">Venue Price</a>
                            </h3>
                                You have booked <a  href="#"><?php echo $venuename;?></a> 
                            </td>

                            <td class="unit"><?php echo $venuecapacity; ?></td>
                            <td class="qty"><?php echo $bookingdate; ?> </td>
                            <td class="total">&#8377 <?php echo $venueprice;?></td>
                        </tr>
                        <tr>
                            <td class="no">02</td>
                            <td class="text-left"><h3>Tax</h3>By the Rules of Income Tax Department, 18% GST is applicable on each Booking.</td>
                            <td class="unit">-</td>
                            <td class="qty">-</td>
                            <td class="total">&#8377 <?php echo $taxvb;?></td>
                        </tr>
                        
                    </tbody>
                    <tfoot>
                    
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>&#8377 <?php echo $totalvb;?></td>
                        </tr>
                    </tfoot>
                </table>
                <br><br>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">90 % Money is Refundable on cancelling the venue within 5 days of Booking. Only Cash at Venue is Refundable.</div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
</body>
</html>


<script>

$('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
</script>