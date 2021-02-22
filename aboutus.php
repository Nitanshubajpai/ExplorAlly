<?php
require 'includes/init.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="aboutus.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title>About Us</title>
  </head>
  <body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <button class='navbar-toggler'  data-toggle='collapse' data-target='#collapse_target'>
        <span class='navbar-toggler-icon'></span>
    </button>

<div class='collapse navbar-collapse' id='collapse_target'>
<span class="nav-logo"><img href="#"src="images/logo.png" alt="LOGO"  width='140px'
    height='50px';></span>

<ul class='navbar-nav mr-auto'>
<li class='nav-item'>
    <a class='nav-link' href='./redirect.php'><span class="fa fa-home fa-lg"></span> Home</a>
</li>
<li class='nav-item'>
                <a class='nav-link' href='./discover.php'><span class="fa fa-fire fa-lg"></span> Discover</a>
            </li>
<li class='nav-item active'>
    <a class='nav-link' href='#'><span class="fa fa-info fa-lg"></span> About Us</a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='#contactus'><span class="fa fa-address-card fa-lg"></span> Contact Us</a>
</li>
</ul>
<ul class='navbar-nav ml-auto'>
<li class='nav-item'>
<span class='navbar-text' href='#'> Welcome</span>
</li>
</ul>
</div>
</nav>
<br/><br/>



<div class='container'>
  <h2 style="text-align: center;">How This Works?</h2>

    <div class='row'>
        <div class=' col-md-6 order-sm-last col-sm-6'>
        <img src="./images/image18.jpg" alt="image" width="auto" class="col-12">       
     </div>
        <div class='aboutpara col-12 col-sm-6 col-md-6 col-lg-6 text-justify'>
            <h3>EXPLORERS</h3>
            <p>
                An user can simply go to the sign up page 
                and create an account of their own.
                They can discover various cities in the discover
                section and can get to know more about
                India and its cities. This city basically helps 
                the user to get to know more and more 
                about a city. Data collected from local people
                 are presented in each city profile. One 
                can approach a local guide through this website
                 and actually visit the places. The filters
                help with the sorting of guides of a particular city.
                 Choose your next destination, fix a date
                and set how much time you are going to spend in the city.
                Pay your local guide with a smile.
            </p>
        </div>
    </div>
    <br/>
 <div class='row'> 
    <div class=' col-md-6  order-sm-first col-sm-6'>
        <img src="./images/image14.jpg" alt="image" class="col-12">
    </div>
    <div class='aboutpara col-12 col-sm-6 col-md-6 col-lg-6 text-justify'>
        <h3>GUIDES</h3>
        <p>
            If you know your city well and love to interact with
            new personalities and people, then Shoround provides
            you an oppurtunity to earn money by doing it.
            Just create your profile on Shoround.
            As a guide you can login and view requests which are 
            sent by the users of this website to you. The request
            will consist of the date, time and the charge of the  
            particular tour.You can see the user profiles for
            his/her detail. If you are interested you can accept the
            request and the booking will be done successfully. As soon as the 
            user will get a notification, he/she will revert you back.
            It's your time to make people fall in love with your city.
        </p>
    </div>
</div>  
<br/>

    <div class='row' style="height">
        <div class=' col-md-6 order-sm-last col-sm-6'>
        <img src="./images/image15.jpg" alt="image" class="col-12">       
     </div>
        <div class='aboutpara col-12 col-sm-6 col-md-6 col-lg-6 text-justify'>
            <h3>Vendors</h3>
            <p>
              Small businesses dependent on tourism can register 
              on our website as local vendors. After registering, 
              they can list all their products and offer services for 
              the development of their business. The website will 
              automatically create a profile of the vendor using the 
              template provided by us. This registration process is 
              user-friendly. This could help them to give their 
              business an online presence without paying a single penny.
            </p>
        </div>
    </div>
    
</div>
    <br/>
    <?php include('footer.php');?>

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
</script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>