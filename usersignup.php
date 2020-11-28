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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body>
  <div class="main_container login_signup_container">
    <h1>Sign Up</h1>
    <form action="" method="POST" novalidate>
      <label for="username">Full Name</label>
      <input type="text" id="username" name="username" spellcheck="false" placeholder="Enter your full name" required>

      <label for="gender">Gender</label><br><br>
      <div style='display: flex;'>
      <input type="radio" id="male" name="gender" value="Male">
      <label for="male"> Male </label><br>
      <input type="radio" id="female" name="gender" value="Female">
      <label for="female"> Female </label><br>
      <input type="radio" id="other" name="gender" value="Other">
      <label for="other"> Other </label><br>
      </div><br>

      <label for="contact">Contact no.</label>
      <input type="text" id="contact" name="contact" spellcheck="false" placeholder="0000000000" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" spellcheck="false" placeholder="Enter your email address" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
      <label for="city">Enter your city</label><br>
      <select name="city" id="city" placeholder="City">
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
      </select><br><br>


      <label for="bio">Tell us about yourself</label><br><br>
      <textarea style="
      resize: none; 
      width: 100%;
      padding: 10px;
      border: 0;
      border-bottom: 1px solid #8795A1;
      outline: none;
      margin-bottom: 10px;
      font-size: 14px;
      background: none;
      color: #232323;
      font-family: 'Open Sans';
      " id="bio" name="bio" rows="4" cols="50" maxlength = "800" spellcheck="false" placeholder="Wrap it up in 100 words." ></textarea><br><br>


      <input type="submit" value="Sign Up">
      <a href="userlogin.php" class="form_link">Login</a>
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
</body>
</html>

