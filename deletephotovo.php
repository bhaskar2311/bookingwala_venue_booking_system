<?php
include 'database.php';

if (isset($_REQUEST['username'])) {
     $username = $_GET['username'];
     $image_name = $_GET['image_name'];
     echo "$username";
     $sql = "DELETE FROM `tbl_images` WHERE `username`= '".$username."' AND `image_name`='".$image_name."'";
     $result = mysqli_query($conn, $sql);
     if($result)
     {
          echo '<script type="text/javascript">alert("DELETED:)");</script>';
          header("location: addvenuephotos.php");  
     }
}
?>