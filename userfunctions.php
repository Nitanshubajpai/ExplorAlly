<?php
require 'includes/init.php';
// PROFILE REDIRECT FUNCTION
function redirect_to_profile(){
    header('Location: userprofile.php');
    exit;
}
// IF GET ACTION AND ID PARAMETERS
if(isset($_GET['action']) && isset($_GET['id'])){
    // CHEKC USER LOGGED IN OR NOT || IF USER LOGGED IN
    if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
        // IF PARAMETER ID IS EQUAL TO MY ID($_SESSION['user_id']) THEN REDIRECT TO PROFILE
        if($_GET['id'] == $_SESSION['user_id']){
            redirect_to_profile();
        }
        // OTHERWISE DO THIS
        else{
            // ASSIGN TO VARIABLE 
            $guide_id = $_GET['id'];
            $charge = $_GET['charge'];
            $date = $_GET['date'];
            $my_id = $_SESSION['user_id'];

            // IF GET SEND REQUEST ACTION
            if($_GET['action'] == 'send_req'){
                $frnd_obj->make_pending_friends($my_id, $guide_id, $charge, $date);
            }
            elseif($_GET['action'] == 'cancel_req'){
                $frnd_obj->cancel_request($my_id, $guide_id);
            }
            else{
                redirect_to_profile();
            }
        }
    }
    else{
        header('Location: logout.php');
        exit;
    }
}
else{
    redirect_to_profile();
}
?>
