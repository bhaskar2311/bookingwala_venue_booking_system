<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     // echo "login fail";
     header("location:loginvenueowner.php");
     exit;
}


include 'database.php';
if (isset($_POST["insert"])) {
     $username = $_POST['username'];
     $image_name = $_POST['image_name'];

     $exist = false;
     $sql="SELECT * FROM `tbl_images` WHERE `image_name` LIKE '$image_name' AND `username` LIKE '$username'";
     $ans = mysqli_query($conn , $sql);
     $num = mysqli_num_rows($ans); 
     if($num == 1)
     {
          $exist = true;
     }

     if($exist == false)
     {
          $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
          $query = "INSERT INTO tbl_images(username,image_name,name) VALUES ('$username','$image_name','$file')";
          if (mysqli_query($conn, $query)) {
               echo '<script>alert("Image Inserted into Database")</script>';
          }   
     }
     else{
          echo '<script>alert("Image name already existed!!!Try another Image Name")</script>';
     }
}
?>
<!DOCTYPE html>
<html>

<head>
     <title>Add Photos</title>
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
<!-- Navbar  -->
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
            <a class="nav-link active" href="addvenuephotos.php"  role="button"  aria-expanded="false">
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
        </ul>

        <li class="nav-item d-flex">
          <a class="nav-link" href="#">Hello , <?php echo $_SESSION['username']; ?></a>
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </div>
    </div>
  </nav>

<!-- Add Image Code  -->
<!-- <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div> -->
<div class="card text-center">
  <div class="card-header">
    Please Add Photos
  </div>
  <div class="card-body">
  <form class="mb-3" method="post" enctype="multipart/form-data">
  <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
 <input class="mb-3 card-title" type="text" name="image_name" placeholder="Image Name" required><br>
    <input class="mb-3" type="file" name="image" id="image" accept=".jpg, .jpeg, .png, .jfif" required/>
    <input type="submit" name="insert" id="insert" value="Insert Image" class="btn btn-primary" />
    <!-- <a href="#" class="btn btn-primary">Insert Image</a> -->
  </div>
  </form>
</div>

<br>
     <div class="container center">
          <?php
          $user = $_SESSION['username'];
          $query = "SELECT * FROM tbl_images where username='$user' ORDER BY id DESC";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_array($result)) {
          ?>
               <div class="card gallery" style="width: 20rem;">
                         <?php
                         echo '
                    <img class="card-img-top box" src="data:image/jpeg;base64,' . base64_encode($row['name']) . '" height="400" width="400" class="img-thumnail" />
                    ';
                    ?>
                    <div class="card-body">
                         <a href="deletephotovo.php?username=<?php echo $row['username']; ?> & image_name=<?php echo $row['image_name'];?>">Delete</a>
                         <?php
                                echo $row['image_name'] ; 
                         ?>
                    </div>
                         
               </div>
          </table>
     </div>
     <?php
          }
          ?>
</body>

</html>


<script>
     $(document).ready(function() {
          $('#insert').click(function() {
               var image_name = $('#image').val();
               if (image_name == '') {
                    alert("Please Select Image");
                    return false;
               } else {
                    var extension = $('#image').val().split('.').pop().toLowerCase();
                    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                         alert('Invalid Image File');
                         $('#image').val('');
                         return false;
                    }
               }
          });
     });
</script>




