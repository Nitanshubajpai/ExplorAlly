<?php
require 'includes/init.php';
// PROFILE REDIRECT FUNCTION
function redirect_to_profile(){
    header('Location: guideprofile.php');
    exit;
}
// IF GET ACTION AND ID PARAMETERS
if(isset($_GET['action']) && isset($_GET['id'])){
    // CHEKC USER LOGGED IN OR NOT || IF USER LOGGED IN
    if(isset($_SESSION['guide_id']) && isset($_SESSION['email'])){
        // IF PARAMETER ID IS EQUAL TO MY ID($_SESSION['user_id']) THEN REDIRECT TO PROFILE
        if($_GET['id'] == $_SESSION['guide_id']){
            redirect_to_profile();
        }
        // OTHERWISE DO THIS
        else{
            // ASSIGN TO VARIABLE 
            $user_id = $_GET['id'];
            $my_id = $_SESSION['guide_id'];

            // IF GET CANCEL REQUEST OR IGNORE REQUEST ACTION
            if($_GET['action'] == 'cancel_req' || $_GET['action'] == 'ignore_req'){
                $frnd_obj->cancel_or_ignore_friend_request($my_id, $user_id);
            }
            // IF GET ACCEPT REQUEST ACTION
            elseif($_GET['action'] == 'accept_req'){

            
                    $frnd_obj->make_friends($my_id, $user_id);
                
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