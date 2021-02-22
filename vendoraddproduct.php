<?php
require 'includes/init.php';

if(isset($_SESSION['vendor_id']) && isset($_SESSION['email'])){
    $vendor_id = $_SESSION['vendor_id'];
    $vendor_data = $vendor_obj->find_vendor_by_id($_SESSION['vendor_id']);
    if($vendor_data ===  false){
        header('Location: logout.php');
        exit;
    }
}
else{
    header('Location: logout.php');
    exit;
}
//add product
if(!empty($_FILES["image"]["name"])) {
    $error_msg = '';
    $target_dir = "products/";
    $target_file = $target_dir.basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $error_msg= 'File is not an image.';
            $uploadOk = 0;
        }
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        $error_msg= 'Sorry, your file is too large';
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $error_msg= 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error_msg= 'Sorry, your file was not uploaded';
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $productimage = basename( $_FILES["image"]["name"]);
        } else {
            $error_msg= 'Sorry, there was an error uploading your file.';
        }
    }

    
    }
    //send files to database
    if(!empty($productimage) && isset($_POST['submit'])){
        $result = $frnd_obj->addproduct($_SESSION['vendor_id'], $_POST['productname'], $_POST['category'], 
        $_POST['description'], $_POST['price'], $productimage);
    }

$all_product = $frnd_obj->showvendorproductlist($vendor_id, true);
$product_count = $frnd_obj->showvendorproductlist($vendor_id, false);
?>

<!--HTML-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="guideprofile.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title>Add Product</title>
  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <button class='navbar-toggler'  data-toggle='collapse' data-target='#collapse_target'>
        <span class='navbar-toggler-icon'></span>
    </button>

<div class='collapse navbar-collapse' id='collapse_target'>
<span class="nav-logo"><img href="#"src="images/logo.png" alt="LOGO"  width='140px' height='50px';></span>
<ul class='navbar-nav mr-auto'>
<li class='nav-item'>
    <a class='nav-link' href='./vendorprofile.php'><span class="fa fa-home fa-lg"></span> Products <span class="badge navbar-text"><?php echo $product_count;?></a>
</li>
<li class='nav-item active'>
    <a class='nav-link' href='./vendoraddproduct.php'><span class="fa fa-ticket fa-lg"></span>Add Product</a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='#contactus'><span class="fa fa-address-card fa-lg"></span> Contact Us</a>
</li>
</ul>
<ul class='navbar-nav ml-auto'>
<li class='nav-item'>
<span class='navbar-text' href='#'> Welcome, <?php echo  $vendor_data->vendorname;?></span>
</li>
<li class='nav-item'>
<img class='img-fluid' height='50' width='50' src="profile_images/vendor/<?php echo $vendor_data->vendor_image; ?>" alt="Profile image">
</li>
<li class='nav-item'>
<li><a class='nav-link' href="logout.php" rel="noopener noreferrer"><span class="fa fa-sign-out fa-lg"></span> Logout</a></li>
</li>
</ul>
</div>
</nav>
<br/>
<div>
    <h1 style="text-align:center; margin-top: 40px;">Add Product</h1>
    <div class="container">
    <div class="myform">
        <form action="" method="POST" novalidate enctype="multipart/form-data" >
            <div class="row" >
                <div class="form-group col-12">
                    <label for="productname">Product Name</label>
                    <input type="text" id="productname" class="form-control" name="productname" spellcheck="false" placeholder="Name of the Product." required>
                </div>


                <div class="form-group col-12">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" class="form-control" spellcheck="false" placeholder="Enter a category." required>
                </div>

                <div class="form-group col-12">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" spellcheck="false" class="form-control" placeholder="Enter the price" required>
                </div>
                
                <div class="form-group col-12">
                    <label for="image">Upload the product image</label>
                    <input type="file" id="image" name="image" class="form-control" required>
                </div>

                <div class="form-group col-12">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" maxlength="800" spellcheck="false" placeholder="Wrap it up in 100 words.">
                    </textarea>
                </div>

                <input type="submit" name="submit" id="submit" value="Add Product" class="btn btn-outline-success btn-md ml-auto">


            </div>
        </form>


        <div>
            <?php
        if(isset($result['errorMessage'])){
          echo '<p class="errorMsg">'.$result['errorMessage'].'</p>';
        }
        if(isset($result['successMessage'])){
          echo '<p class="successMsg">'.$result['successMessage'].'</p>';
        }
        if(!empty($error_msg)){
            echo '<p class="errorMsg">'.$error_msg.'</p>';
          }
        
      ?>
        </div>
    </div>
</div>
    
</div>
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

/*(window).scroll(function(){
    $('nav').toggleClass('scrolled', $(this).scrollTop()>200);
});*/
</script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>