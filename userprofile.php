<?php
require 'includes/init.php';
if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
    $user_data = $user_obj->find_user_by_id($_SESSION['user_id']);
    if($user_data ===  false){
        header('Location: logout.php');
        exit;
    }
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    $all_guide = $guide_obj->all_guide();
    
    $randomproduct = $frnd_obj->randomproduct();
    
}
else{
    header('Location: logout.php');
    exit;
}
// REQUEST NOTIFICATION NUMBER
$get_req_num = $frnd_obj->request_notification($_SESSION['user_id'], false);
// TOTAL FRIENDS
$get_frnd_num = $frnd_obj->get_all_bookings($_SESSION['user_id'], false);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="userprofile.css">

    <title>Home</title>
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
<li class='nav-item active'>
    <a class='nav-link' href='./redirect.php'><span class="fa fa-home fa-lg"></span> Home</a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='./discover.php'><span class="fa fa-fire fa-lg"></span> Discover</a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='./userbookings.php'><span class="fa fa-ticket fa-lg"></span> Bookings <span class="badge navbar-text"><?php echo $get_frnd_num;?></span></a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='./aboutus.php'><span class="fa fa-info fa-lg"></span> About Us</a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='#contactus'><span class="fa fa-address-card fa-lg"></span> Contact Us</a>
</li>
</ul>
<ul class='navbar-nav ml-auto'>
<li class='nav-item'>
<span class='navbar-text' href='#'> Welcome, <?php echo  $user_data->username;?></span>
</li>
<li class='nav-item'>
<img class='img-fluid' height='50' width='50' src="profile_images/<?php echo $user_data->user_image; ?>" alt="Profile image">
</li>
<li class='nav-item'>
<li><a class='nav-link' href="logout.php" rel="noopener noreferrer"><span class="fa fa-sign-out fa-lg"></span> Logout</a></li>
</li>
</ul>
</div>
</nav>

<header class='jumbotron'>
    <div class="box">
        <h1>ExplorAlly</h1>
            <form action="" class="form-inline" method="GET">
            <div class=" form-group mx-sm-3 mb-2">
                <select name="city" id="city" class="form-control" placeholder="Choose a city">
                    <option value="Allguides">All cities</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Manali">Manali</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Lucknow">Lucknow</option>
                    <option value="Kanpur">Kanpur</option>
                    <option value="Kolkata">Kolkata</option>
                    <option value="Chennai">Chennai</option>
                    <option value="Goa">Goa</option>
                    <option value="Pune">Pune</option>
                </select>
                <input type="submit" value="FILTER" class="btn btn-warning btn-md ml-auto">
                </div>
            </form>         
            </div>
</header>
<br/>
            <?php
            if(isset($_GET['city'])){
                $guide_by_city = $guide_obj->guide_by_city($_GET['city']);
                $city = $_GET['city'];
                
                if($city ==='Allguides' || $city==='') {       
                    echo '<h1  style="text-align:center;">All Available Guides</h1>
                    <div class="container">';
                        if($all_guide){
                            echo'<div class="row main-row">';
                            foreach($all_guide as $row){
                                echo '<div class="col md-4 mb-5">
                                <div class="card p-3" style="width: 18rem;">
                                        <img class="card-img-top shadow" src="profile_images/'.$row->guide_image.'" alt="Profile image" >
                                        <div class="card-body">
                                        <h5 class="card-title">'.$row->guidename.'</h5>
                                        <p class="card-text">'.$row->city.'</p>
                                        <a href="user_profile.php?id='.$row->guideid.'" class="btn btn-outline-dark">See profile</a>
                                        </div>
                                        </div>
                                    </div>';
                            }
                            echo'</div></div>';
                        }
                        else{
                            echo '<h3 class="nouser">No local guide currently registered from this city!</h3><br/>';
                        }
                        echo'</div></div>';
                    }
                    else {
                        echo '<h1 style="text-align:center;">Local Guide(s) For '.$city.'</h1>
                        <div class="container">';
                            if($guide_by_city){
                                echo'<div class="row main-row">';
                                foreach($guide_by_city as $row){
                                    echo '<div class="col md-4 mb-5">
                                    <div class="card p-3" style="width: 18rem;">
                                            <img class="card-img-top shadow" src="profile_images/'.$row->guide_image.'" alt="Profile image" >
                                            <div class="card-body">
                                            <h5 class="card-title">'.$row->guidename.'</h5>
                                            <p class="card-text">'.$row->city.'</p>
                                            <a href="user_profile.php?id='.$row->guideid.'" class="btn btn-outline-dark">See profile</a>
                                            </div>
                                            </div>
                                        </div>';
                                }
                                echo'</div></div>';
                            }
                            else{
                                echo '<h3 class="nouser">No local guide currently registered from this city!</h3><br/>';
                            }
                    }
            }
            else{
                echo '<h1  style="text-align:center;">All Available Guides</h1>
                <div class="container">';
                    if($all_guide){
                        echo'<div class="row main-row">';
                        foreach($all_guide as $row){
                            echo '<div class="col md-4 mb-5">
                            <div class="card p-3" style="width: 18rem;">
                                    <img class="card-img-top shadow" src="profile_images/'.$row->guide_image.'" alt="Profile image" >
                                    <div class="card-body">
                                    <h5 class="card-title">'.$row->guidename.'</h5>
                                    <p class="card-text">'.$row->city.'</p>
                                    <a href="user_profile.php?id='.$row->guideid.'" class="btn btn-outline-dark">See profile</a>
                                    </div>
                                    </div>
                                </div>';
                        }
                        echo'</div></div>';
                    }
                    else{
                        echo '<h3 class="nouser">No local guide currently registered from this city!</h3><br/>';
                    }
                    echo'</div></div>';
                }
            
                ?>
         
        </div>
    </div>
    

    <br><br>
    <section>
            <?php
                echo '<h1  style="text-align:left; margin-left:20px">To Shop</h1>
                <div class="container">';
                    if($randomproduct){
                        echo'<div class="row main-row">';
                        foreach($randomproduct as $row){
                            echo '<div class="col md-4 mb-5">
                            <div class="card p-3" style="width: 18rem;">
                                    <img class="card-img-top shadow" src="products/'.$row->productimage.'" alt="Profile image" >
                                    <div class="card-body">
                                    <h5 class="card-title">'.$row->productname.'</h5>
                                    <p class="card-text">Rs '.$row->price.'</p>
                                    <a href="productprofile.php?id='.$row->productid.'" class="btn btn-outline-dark">View Item</a>
                                    </div>
                                    </div>
                                </div>';
                        }
                        echo'</div></div>';
                    }
                    else{
                        echo '<h3 class="nouser">No Product Found!</h3><br/>';
                    }
                    echo'</div></div><div style="text-align:right; margin-right: 50px; margin-bottom:20px;">
                    <a href="./userproductview.php" class="btn btn-outline-dark" style="text-align:right;">View more</a></div>';
            ?>
        </section><br>
        <?php include('footer.php') ?>


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

$(window).scroll(function(){
    $('nav').toggleClass('scrolled', $(this).scrollTop()>200);
});
</script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>