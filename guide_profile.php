<?php
require 'includes/init.php';
if(isset($_SESSION['guide_id']) && isset($_SESSION['email'])){
    if(isset($_GET['id'])){
        $user_data = $user_obj->find_user_by_id($_GET['id']);
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
        <nav>
            <ul>
                <li><a href="guideprofile.php" rel="noopener noreferrer">Requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>
                <li><a href="guidebookings.php" rel="noopener noreferrer">Bookings<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
            <div class="img">
                <img src="profile_images/<?php echo $user_data->user_image; ?>" alt="Profile image">
            </div>
            <h1><?php echo  $user_data->username;?></h1>
            
            <h2>Info: </h2>
            <h4><?php echo  "City: $user_data->city";?></h4>
            <h4><?php echo  "Gender: $user_data->gender";?></h4>
            <h4><?php echo  "Bio: $user_data->bio";?></h4>
            
            <div class="actions">
                <?php
                if($check_req_receiver){
                    echo '<a href="guidefunctions.php?action=ignore_req&id='.$user_data->userid.'" class="req_actionBtn ignoreRequest">Ignore</a>&nbsp;
                    <a href="guidefunctions.php?action=accept_req&id='.$user_data->userid.'" class="req_actionBtn acceptRequest">Accept</a>';
                }
                else{
                    exit;
                }
                ?>
                
        
            </div>
        </div>
     
        </div>
</body>
</html>