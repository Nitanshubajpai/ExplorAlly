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
            $my_id = $_SESSION['user_id'];

            // IF GET SEND REQUEST ACTION
            if($_GET['action'] == 'send_req'){
                $frnd_obj->make_pending_friends($my_id, $guide_id);
                // CHECK IS REQUEST ALREADY SENT OR NOT
                // is_request_already_sent() FUNCTION RETURN TRUE OR FLASE
                
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