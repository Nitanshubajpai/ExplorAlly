<?php
require 'includes/init.php';

if(isset($_SESSION['guide_id']) && isset($_SESSION['email'])){
    $guide_data = $guide_obj->find_guide_by_id($_SESSION['guide_id']);
    if($guide_data ===  false){
        header('Location: logout.php');
        exit;
    }
}
else{
    header('Location: logout.php');
    exit;
}
// TOTAL REQUESTS
$get_req_num = $frnd_obj->request_notification($_SESSION['guide_id'], false);
// TOTLA FRIENDS
$get_frnd_num = $frnd_obj->get_all_bookings($_SESSION['guide_id'], false);
// GET MY($_SESSION['user_id']) ALL FRIENDS
$get_all_friends = $frnd_obj->get_all_bookings($_SESSION['guide_id'], true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $guide_data->guidename;?></title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body>
    <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <img src="profile_images/<?php echo $guide_data->guide_image; ?>" alt="Profile image">
            </div>
            <h1><?php echo  $guide_data->guidename;?></h1>
        </div>
        <nav>
            <ul>
                <li><a href="guideprofile.php" rel="noopener noreferrer">Requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>
                <li><a href="guidebookings.php" rel="noopener noreferrer" class="active">Bookings<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="all_users">
            <h3>Bookings</h3>
            <div class="usersWrapper">
                <?php
                if($get_frnd_num > 0){
                    foreach($get_all_friends as $row){
                        echo '<div class="user_box">
                                <div class="user_img"><img src="profile_images/'.$row->user_image.'" alt="Profile image"></div>
                                <div class="user_info"><span>'.$row->username.'</span>
                                <span>'.$row->city.'</span>
                                <span> DATE: </span>
                                <span> CHARGE: </span></div>
                            </div>';
                    }
                }
                else{
                    echo '<h4>You have no friends!</h4>';
                }
                ?>

            

            </div>
        </div>
    </div>
</body>
</html>