<?php
require 'includes/init.php';
if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
    if(isset($_GET['id'])){
        $guide_data = $guide_obj->find_guide_by_id($_GET['id']);
        if($guide_data ===  false){
            header('Location: userprofile.php');
            exit;

        }
    }
}
else{
    header('Location: logout.php');
    exit;
}

$check_req_sender = $frnd_obj->am_i_the_req_sender($_SESSION['user_id'], $guide_data->guideid);

$check_req_receiver = $frnd_obj->am_i_the_req_receiver($_SESSION['user_id'], $guide_data->guideid);
// TOTAL REQUESTS
$get_frnd_num = $frnd_obj->get_all_bookings($_SESSION['user_id'], false);
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
                <li><a href="userprofile.php" rel="noopener noreferrer" class="active">Home</a></li>
                <li><a href="userbookings.php" rel="noopener noreferrer">Bookings<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
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
            
            <?//charges: ?>
            <form action="" method="POST">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" required>
                    <label for="hour">Hours: </label>
                    <input type="number" name="hour" id="hour" required>
                    <input type="submit" value = "Checkprice">
            </form>
            
            <div class="actions">
                <?php
                if($check_req_sender){
                    echo '<a href="userfunctions.php?action=cancel_req&id='.$guide_data->guideid.'" class="req_actionBtn cancleRequest">Cancel Request</a>';
                }
                 elseif(isset($_POST['hour']) && isset($_POST['date'])) {
                    $charge = $_POST['hour']*60*2;
                    $date = $_POST['date'];
                    echo 'Charges: <h1>'.$charge.'</h1>';
                
                    
                        echo '<a href="userfunctions.php?action=send_req&id='.$guide_data->guideid.'&charge='.$charge.'&date='.$date.'
                        " class="req_actionBtn sendRequest">Send Request</a>';
                    
                }
                ?>
                
        
            </div>
        </div>
     
        </div>
</body>
</html>