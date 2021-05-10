<?php
include "database.php";

if(isset($_POST['username'])){
   $username = $_POST['username'];

   $query = "select count(*) as cntUser from venueowners where username='".$username."'";

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span style='color: red;'>Not Available.</span>";
      }
   
   }

   echo $response;
   die;
}

?>