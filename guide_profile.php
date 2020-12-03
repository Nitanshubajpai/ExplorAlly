<?php
require 'includes/init.php';
if(isset($_SESSION['guide_id']) && isset($_SESSION['email'])){
    if(isset($_GET['id'])){
        $user_data = $user_obj->find_user_by_id($_GET['id']);
        $guide_data = $guide_obj->find_guide_by_id($_SESSION['guide_id']);
        if($user_data ===  false){
            header('Location: userprofile.php');
            exit;

        }
    }
}
else{
    header('Location: logout.php');
    exit;
}

$check_req_receiver = $frnd_obj->am_i_the_req_receiver($_SESSION['guide_id'], $user_data->userid);
// TOTAL REQUESTS
$get_req_num = $frnd_obj->request_notification($_SESSION['guide_id'], false);
// TOTAL FRIENDS
$get_frnd_num = $frnd_obj->get_all_bookings($_SESSION['guide_id'], false);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="guide_profile.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title>View Profile</title>
  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <button class='navbar-toggler'  data-toggle='collapse' data-target='#collapse_target'>
        <span class='navbar-toggler-icon'></span>
    </button>

<div class='collapse navbar-collapse' id='collapse_target'>
<span class="nav-logo"><img href="#"src="images/logo.png" alt="LOGO"  width='140' height='70';></span>
<ul class='navbar-nav mr-auto'>
<li class='nav-item active'>
    <a class='nav-link' href='./guideprofile.php'><span class="fa fa-home fa-lg"></span> Home <span class="badge navbar-text"><?php echo $get_req_num;?></a>
</li>
<li class='nav-item '>
    <a class='nav-link' href='./guidebookings.php'><span class="fa fa-ticket fa-lg"></span> Bookings <span class="badge navbar-text"><?php echo $get_frnd_num;?></span></a>
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
<img class='img-fluid' height='50' width='50' src="profile_images/<?php echo $guide_data->guide_image; ?>" alt="Profile image">
</li>
<li class='nav-item'>
<li><a class='nav-link' href="logout.php" rel="noopener noreferrer"><span class="fa fa-sign-out fa-lg"></span> Logout</a></li>
</li>
</ul>
</div>
</nav>

<div class="container"> 
                <br/>
            <h1 style="text-align:center;"><?php echo  $user_data->username;?>'s profile</h1>
             <div class="row d-flex justify-content-center">
                 <div class="col md-10 mt-5 pt-5">
                   <div class="row z-depth-3">
                        <div class="col-sm-4 userimage ">
                                <div class="card-block text-center">
                                <img src="profile_images/<?php echo $user_data->user_image; ?>" alt="Profile image" width='340px' height='auto'>
                                </div>
                            </div>
                            <div class="col-sm-8 userdetails">
                                <h3 class="mt-3 text-center font-weight-bold">INFORMATION</h3>
                                <hr class="badge-primary mt-0 wd-25">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">NAME</p>
                                                <h6 class="text-muted"><?php echo  $user_data->username;?></h6>
                                                <br/>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">CITY</p>
                                                <h6 class="text-muted"><?php echo  "$user_data->city";?></h6>
                                                <br/>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">GENDER</p>
                                                <h6 class="text-muted"><?php echo  "$user_data->gender";?></h6>
                                                <br/>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="font-weight-bold">EMAIL</p>
                                                <h6 class="text-muted"><?php echo  "$user_data->user_email";?></h6>
                                                <br/>
                                            </div>
                                            <div class="col-sm-12">
                                                <p class="font-weight-bold">BIO</p>
                                                <h6 class="text-muted"><?php echo  "$user_data->bio";?></h6>
                                                <br/>
                                            </div>
                                     </div>
                                             
                            </div>
                             </div>
                         </div>
                    </div>
                 </div>
                 <br/>    
                 
      
            <div class="actions">
                <?php
                if($check_req_receiver){
                    echo '<div class="text-center"><a href="guidefunctions.php?action=ignore_req&id='.$user_data->userid.'" class="req_actionBtn ignoreRequest btn btn-outline-danger">Ignore</a>
                    <a href="guidefunctions.php?action=accept_req&id='.$user_data->userid.'" class="req_actionBtn acceptRequest btn btn-outline-success">Accept</a></div><br/>';
                }
                else{
                    exit;
                }
                ?>
            </div>
        
            <footer id='contactus' class="footer">
        <div class="container">
            <div class="row">
                <div class="col-4 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="./guideprofile.php">Home</a></li>
                        <li><a href="./guidebookings.php">Bookings</a></li>
                    </ul>
                </div>
                <div class="col-7 col-sm-5">
                <a href='randomgooglemaplink' target='blank'>
								<h1>
									<i class='fa fa-map-marker f-lag'></i>
								</h1>
							</a>
                    <address>
		              121, Shoround<br>
		              Mumbai<br>
		              India<br>
		              <i class="fa fa-phone f-lag"></i> : +91 90043770XX<br>
		              <i class="fa fa-fax fa-lag"></i> : +91 98205702XX<br>
		              <i class="fa fa-envelope fa-lag"></i> : <a href="mailto:shoround@gmail.com">shoround@gmail.com</a>
		           </address>
                </div>
                <div class="col-12 offset-1 col-sm-4 align-self-center">
                    <div class="text-center">
                        <a class="btn btn-social-icon btn-google" href="http://google.com/+"><i class="fa fa-google-plus f-lag"></i></a>
                        <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i class="fa fa-facebook f-lag"></i></a>
                        <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i class="fa fa-linkedin f-lag"></i></a>
                        <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fa fa-twitter f-lag"></i></a>
                        <a class="btn btn-social-icon btn-youtube" href="http://youtube.com/"><i class="fa fa-youtube f-lag"></i></a>
                        <a class="btn btn-social-icon" href="mailto:"><i class="fa fa-envelope f-lag"></i></a>
                    </div>
                </div>
           </div>
           <div class="row justify-content-center">
                <div class="col-auto">
                    <h6 class='copyright'>© Copyright 2020 Shoround</h5>
                </div>
           </div>
        </div>
    </footer>


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