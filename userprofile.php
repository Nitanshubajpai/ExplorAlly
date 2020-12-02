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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $user_data->username;?></title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body>
    <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <img src="profile_images/<?php echo $user_data->user_image; ?>" alt="Profile image">
            </div>
            <h1><?php echo  $user_data->username;?></h1>
        </div>
        <nav>
            <ul>
                <li><a href="userprofile.php" rel="noopener noreferrer" class="active">Home</a></li>
                <li><a href="userbookings.php" rel="noopener noreferrer">Bookings<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="all_users">
            <label for="city">City: </label>
            <form action="" method="GET">
                <select name="city" id="city" placeholder="Choose a city">
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
                <input type="submit" value="Filter">
            </form>
            <?php
            if(isset($_GET['city'])){
                $guide_by_city = $guide_obj->guide_by_city($_GET['city']);
                $city = $_GET['city'];
                
                if($city ==='Allguides' || $city==='') {       
                    echo '<h3>All Guides</h3>
                    <div class="usersWrapper">';
                        if($all_guide){
                            foreach($all_guide as $row){
                                echo '<div class="user_box">
                                        <div class="user_img"><img src="profile_images/'.$row->guide_image.'" alt="Profile image"></div>
                                        <div class="user_info"><span>'.$row->guidename.'</span><span style="font-size:14px;">'.$row->city.'</span>
                                        <span><a href="user_profile.php?id='.$row->guideid.'" class="see_profileBtn">See profile</a></div>
                                    </div>';
                            }
                        }
                        else{
                            echo '<h4>There is no user!</h4>';
                        }
                    }
                    else {
                        echo '<h3>'.$city.'</h3>
                        <div class="usersWrapper">';
                            if($guide_by_city){
                                foreach($guide_by_city as $row){
                                    echo '<div class="user_box">
                                            <div class="user_img"><img src="profile_images/'.$row->guide_image.'" alt="Profile image"></div>
                                            <div class="user_info"><span>'.$row->guidename.'</span><span style="font-size:14px;">'.$row->city.'</span>
                                            <span><a href="user_profile.php?id='.$row->guideid.'" class="see_profileBtn">See profile</a></div>
                                        </div>';
                                }
                            }
                            else{
                                echo '<h4>There is no user!</h4>';
                            }
                    }
            }
            else {
                echo '<h3>All Guides</h3>
                <div class="usersWrapper">';
                    if($all_guide){
                        foreach($all_guide as $row){
                            echo '<div class="user_box">
                                    <div class="user_img"><img src="profile_images/'.$row->guide_image.'" alt="Profile image"></div>
                                    <div class="user_info"><span>'.$row->guidename.'</span><span style="font-size:14px;">'.$row->city.'</span>
                                    <span><a href="user_profile.php?id='.$row->guideid.'" class="see_profileBtn">See profile</a></div>
                                </div>';
                        }
                    }
                    else{
                        echo '<h4>There is no user!</h4>';
                    }
            }
            
                ?>
            </div>
        </div>
    </div>
</body>
</html>