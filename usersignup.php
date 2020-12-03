<?php
require 'includes/init.php';
// IF USER MAKING SIGNUP REQUEST
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['gender']) 
&& isset($_POST['contact']) && isset($_POST['bio']) && isset($_POST['city'])){
  $result = $user_obj->singUpUser($_POST['username'],$_POST['email'],$_POST['password'],$_POST['gender'],$_POST['contact'],$_POST['bio'],$_POST['city']);
}
// IF USER ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header('Location: user_profile.php');
}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="usersignup.css">

   <!-- <link rel="stylesheet" href="./style.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    
    <title>User Sign Up</title>

</head>

<body>
<div>
  <h1>User Sign Up</h1>
    <br>
    <div class="container">
    <div class="myform">
    <form action="" method="POST" novalidate>
    <div class="row">
    <div class="form-group col-12">
      <label for="username">Full Name</label>
      <input type="text" id="username" class="form-control" name="username" spellcheck="false" placeholder="Enter your full name" required>
    </div>


 <div class="form-group col-12">
      <label for="gender">Gender</label><br>
      <input type="radio" id="male" name="gender" value="Male">
      <label for="male"> Male </label><br>
      <input type="radio" id="female" name="gender" value="Female">
      <label for="female"> Female </label><br>
      <input type="radio" id="other" name="gender" value="Other">
      <label for="other"> Other </label><br>
 </div>

 <div class="form-group col-12">
      <label for="contact">Contact no.</label>
      <input type="text" id="contact" name="contact"  class="form-control"  spellcheck="false" placeholder="0000000000" required>
 </div>

      <div class="form-group col-12">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" spellcheck="false"  class="form-control"  placeholder="Enter your email address" required>
      </div>

      <div class="form-group col-12">
      <label for="password">Password</label>
      <input type="password" id="password" name="password"  class="form-control"  placeholder="Enter your password" required>
      </div>

      <div class="form-group col-12">
      <label for="city">Enter your city</label>
      <select name="city"  class="form-control"  id="city" placeholder="City">
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
      </div>

      <div class="form-group col-12">
      <label for="bio">Tell us about yourself</label>
      <textarea class="form-control" 
      id="bio" name="bio" rows="4" 
      maxlength = "800" 
      spellcheck="false" 
      placeholder="Wrap it up in 100 words.">
    </textarea>
      </div>

      <input type="submit" name="submit" id="submit" value="Sign Up" class="btn btn-outline-success btn-md ml-auto">
    
      <a href="userlogin.php" class="btn btn-outline-info btn-md form_link mr-auto">Login</a>
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
      ?>    
    </div>
    </div>
    </div>
</div>
</body>
</html>

