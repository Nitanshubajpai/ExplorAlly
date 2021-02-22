
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="discover.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title>Discover</title>
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
<li class='nav-item '>
    <a class='nav-link' href='./userprofile.php'><span class="fa fa-home fa-lg"></span> Home</a>
</li>
<li class='nav-item active'>
    <a class='nav-link' href='#'><span class="fa fa-fire fa-lg"></span> Discover</a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='./aboutus.php'><span class="fa fa-info fa-lg"></span> About Us</a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='#contactus'><span class="fa fa-address-card fa-lg"></span> Contact Us</a>
</li>
</ul>
</div>
</nav>
<br/><br/>

<?php
    $jsondata = file_get_contents("cities.json");
    $json = json_decode($jsondata, true);
      echo'<div class="container"><div class="row main-row">';
                        foreach($json['cities']  as $city){
                            echo '<div class="col md-4 mb-5">
                            <div class="card p-3" style="width: 18rem;">
                            <img class="card-img-top shadow" src="'.$city['images'][0].'" alt="'.$city['city'].' image" >
                            <div class="card-body">
                                    <h5 class="card-title">'.$city['city'].'</h5>
                                    <p class="card-text"></p>
                                    <a  href="city.php?id='.$city['id'].'" class="btn btn-outline-dark" >
                                    Discover '.$city['city'].'</a>
                                    </div>
                                    </div>
                                </div>';
                              }
                        echo'</div></div>';
    
?>

        <?php include('footer.php') ?>

    <!-- Modal -->
<div class="modal fade" id="discover" tabindex="-1" role="dialog" aria-labelledby=" " aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=" "><?php echo $city['city']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Whole body!!
      </div>
      <div class="modal-footer">
        <button type="button" class="ml-auto btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="mr-auto btn btn-outline-primary">View More</button>
      </div>
    </div>
  </div>
</div>



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