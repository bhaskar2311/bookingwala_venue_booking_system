<?php
include 'database.php';

if (isset($_POST["bookingdate"]))
{
   
   $bookingdate = mysqli_real_escape_string($conn, $_POST["bookingdate"]);
    
   $query = "SELECT * FROM bookings WHERE bookingdate = '".$bookingdate."'";
   $result = mysqli_query($conn, $query);
   echo mysqli_num_rows($result);
}
   ?>