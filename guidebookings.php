<?php
require 'includes/init.php';

if(isset($_SESSION['guide_id']) && isset($_SESSION['email'])){
    $guide_data = $guide_obj->find_guide_by_id($_SESSION['guide_id']);
    if($guide_data ===  false){
        header('Location: logout.php');
        exit;
    }
}
else{
    header('Location: logout.php');
    exit;
}
// TOTAL REQUESTS
$get_req_num = $frnd_obj->request_notification($_SESSION['guide_id'], false);
// TOTLA FRIENDS
$get_frnd_num = $frnd_obj->get_all_bookings($_SESSION['guide_id'], false);
// GET MY($_SESSION['user_id']) ALL FRIENDS
$get_all_friends = $frnd_obj->get_all_bookings($_SESSION['guide_id'], true);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="bookings.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title>Bookings</title>
  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <button class='navbar-toggler'  data-toggle='collapse' data-target='#collapse_target'>
        <span class='navbar-toggler-icon'></span>
    </button>

<div class='collapse navbar-collapse' id='collapse_target'>
<span class="nav-logo"><img href="#"src="images/logo.png" alt="LOGO"  width='140px' height='50px';></span>
<ul class='navbar-nav mr-auto'>
<li class='nav-item '>
    <a class='nav-link' href='./guideprofile.php'><span class="fa fa-home fa-lg"></span> Home <span class="badge navbar-text"><?php echo $get_req_num;?></a>
</li>
<li class='nav-item active'>
    <a class='nav-link' href='#'><span class="fa fa-ticket fa-lg"></span> Bookings <span class="badge navbar-text"><?php echo $get_frnd_num;?></span></a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='#contactus'><span class="fa fa-address-card fa-lg"></span> Contact Us</a>
</li>
</ul>
<ul class='navbar-nav ml-auto'>
<li class='nav-item'>
<span class='navbar-text' href='#'> Welcome, <?php echo  $guide_data->guidename;?></span>
</li>
<li class='nav-item'>
<img class='img-fluid' height='50' width='50' src="profile_images/<?php echo $guide_data->guide_image; ?>" alt="Profile image" >
</li>
<li class='nav-item'>
<li><a class='nav-link' href="logout.php" rel="noopener noreferrer"><span class="fa fa-sign-out fa-lg"></span> Logout</a></li>
</li>
</ul>
</div>
</nav>

            <br/>
            <h1 style="text-align:center; margin-top:40px;">ALL BOOKINGS</h1>
             
                 <?php
                if($get_frnd_num > 0){
                 foreach($get_all_friends as $row){
                    echo '
                    <div class="container">
                    <div class="row d-flex justify-content-center">
                 <div class="col md-10 mt-5 pt-5">
                   <div class="row z-depth-3">
                        <div class="col-sm-4 image ">
                                <div class="card-block text-center">
                                <img src="profile_images/'.$row[0]->user_image.'" alt="Profile image" width="300px" height="auto">
                                </div>
                            </div>
                            <div class="col-sm-8 details">
                                <h3 class="mt-3 text-center font-weight-bold">INFORMATION</h3>
                                <hr class="badge-primary mt-0 wd-25">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">NAME</p>
                                                <h6 class="text-muted">'.$row[0]->username.'</h6>
                                                <br/>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">CITY</p>
                                                <h6 class="text-muted">'.$row[0]->city.'</h6>
                                                <br/>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">CONTACT</p>
                                                <h6 class="text-muted">'.$row[0]->contact.'</h6>
                                                <br/>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">CHARGE</p>
                                                <h6 class="text-muted">'.$row[1].'</h6>
                                                <br/>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">DATE</p>
                                                <h6 class="text-muted">'.$row[2].'</h6>
                                                <br/>
                                            </div>
                                     </div>
                            </div>
                             </div>
                         </div>
                         </div>
                </div>';
                    }
                }
                    else{
                        echo '<h3 class="nouser">You have no bookings currently</h3><br/>';
                    }
                     ?>     
                <br/>


                <?php include('footer.php'); ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  
  <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/f50b25f16a.js" crossorigin="anonymous"></script>
<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});

/*
$(window).scroll(function(){
    $('nav').toggleClass('scrolled', $(this).scrollTop()>200);
});
*/
</script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>