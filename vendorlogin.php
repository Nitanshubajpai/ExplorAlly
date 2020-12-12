<?php
require 'includes/init.php';
// IF vendor MAKING LOGIN REQUEST
if(isset($_POST['email']) && isset($_POST['password'])){
  $result = $vendor_obj->loginvendor($_POST['email'],$_POST['password']);
}
// IF vendor ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header('Location: vendorprofile.php');
  exit;
}
?>
    <!DOCTYPE html>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="loginsignup.css">

        <!-- <link rel="stylesheet" href="./style.css"> -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

        <title>Vendor Login</title>

    </head>

    <body id="vendorlogin">
        <div>
            <h1>Vendor Login</h1>
            <br>
            <div class="container">
                <div class="myform">
                    <form action="" method="POST" novalidate>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" spellcheck="false" class="form-control" placeholder="Enter your email address" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                            <input type="submit" value="Login" class="btn btn-outline-info btn-md ml-auto">
                            <a href="vendorsignup.php" class="btn btn-outline-success btn-md form_link mr-auto">Sign Up</a>
                        </div>
                        <div>
                            <?php
        if(isset($result['errorMessage'])){
          echo '<p class="errorMsg">'.$result['errorMessage'].'</p>';
        }
        if(isset($result['successMessage'])){
          echo '<p class="successMsg">'.$result['successMessage'].'</p>';
        }
      ?>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </body>

    </html>