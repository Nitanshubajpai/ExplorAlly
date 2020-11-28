<?php
require 'includes/init.php';
if(isset($_SESSION['guide_id']) && isset($_SESSION['email'])){
    if(isset($_GET['id'])){
        $guide_data = $guide_obj->find_guide_by_id($_GET['id']);
        if($guide_data ===  false){
            header('Location: guideprofile.php');
            exit;

        }
    }
}
else{
    header('Location: logout.php');
    exit;
}
// CHECK FRIENDS
$is_already_friends = $frnd_obj->is_already_friends($_SESSION['guide_id'], $guide_data->id);
//  IF I AM THE REQUEST SENDER
$check_req_sender = $frnd_obj->am_i_the_req_sender($_SESSION['guide_id'], $guide_data->id);
// IF I AM THE REQUEST RECEIVER
$check_req_receiver = $frnd_obj->am_i_the_req_receiver($_SESSION['guide_id'], $guide_data->id);
// TOTAL REQUESTS
$get_req_num = $frnd_obj->request_notification($_SESSION['guide_id'], false);
// TOTAL FRIENDS
$get_frnd_num = $frnd_obj->get_all_friends($_SESSION['guide_id'], false);
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
        <nav>
            <ul>
                <li><a href="guideprofile.php" rel="noopener noreferrer">Home</a></li>
                <li><a href="notifications.php" rel="noopener noreferrer">Requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>
                <li><a href="friends.php" rel="noopener noreferrer">Bookings<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
            <div class="img">
                <img src="profile_images/<?php echo $guide_data->guide_image; ?>" alt="Profile image">
            </div>
            <h1><?php echo  $guide_data->guidename;?></h1>
            
            <h2>Info: </h2>
            <h4><?php echo  "City: $guide_data->city";?></h4>
            <h4><?php echo  "Gender: $guide_data->gender";?></h4>
            <h4><?php echo  "Bio: $guide_data->bio";?></h4>
            
            <div class="actions">
                <?php
                if($is_already_friends){
                    echo '<a href="guidefunctions.php?action=unfriend_req&id='.$guide_data->id.'" class="req_actionBtn unfriend">Unfriend</a>';
                }
                elseif($check_req_sender){
                    echo '<a href="guidefunctions.php?action=cancel_req&id='.$guide_data->id.'" class="req_actionBtn cancleRequest">Cancel Request</a>';
                }
                elseif($check_req_receiver){
                    echo '<a href="functions.php?action=ignore_req&id='.$guide_data->id.'" class="req_actionBtn ignoreRequest">Ignore</a>&nbsp;
                    <a href="guidefunctions.php?action=accept_req&id='.$guide_data->id.'" class="req_actionBtn acceptRequest">Accept</a>';
                }
                else{
                    echo '<a href="guidefunctions.php?action=send_req&id='.$guide_data->id.'" class="req_actionBtn sendRequest">Send Request</a>';
                }
                ?>
        
            </div>
        </div>
     
        </div>
</body>
</html>