<?php
class Friend{
    
    protected $db;

    public function __construct($db_connection){
        $this->db = $db_connection;
    }

    // CHECK IF ALREADY FRIENDS
    public function is_already_friends($my_id, $user_id){
        try{
            $sql = "SELECT * FROM `bookings` WHERE (userid = :my_id AND guideid = :frnd_id) OR (userid = :frnd_id AND guideid = :my_id)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
        
    }

    //  IF I AM THE REQUEST SENDER
    public function am_i_the_req_sender($my_id, $user_id){
        try{
            $sql = "SELECT * FROM `friend_request` WHERE sender = ? AND receiver = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$my_id, $user_id]);

            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //  IF I AM THE RECEIVER 
    public function am_i_the_req_receiver($my_id, $user_id){
        
        try{
            $sql = "SELECT * FROM `friend_request` WHERE sender = ? AND receiver = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$user_id, $my_id]);

            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // CHECK IF REQUEST HAS ALREADY BEEN SENT
    public function is_request_already_sent($my_id, $user_id){
        
        try{
            $sql = "SELECT * FROM `friend_request` WHERE (sender = :my_id AND receiver = :frnd_id) OR (sender = :frnd_id AND receiver = :my_id)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
    
            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    //SEND FRIEND REQUEST
    public function make_pending_friends($my_id, $guide_id){
        
        try{
            $sql = "INSERT INTO `friend_request`(sender, receiver) VALUES(?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$my_id, $guide_id]);
            header('Location: user_profile.php?id='.$guide_id);
            exit;
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // CANCLE FRIEND REQUEST
    public function cancel_or_ignore_friend_request($my_id, $user_id){
        
        try{
            $sql = "DELETE FROM `friend_request` WHERE (sender = :frnd_id AND receiver = :my_id)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            header('Location: guide_profile.php?id='.$user_id);
            exit;
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // MAKE FRIENDS
    public function make_friends($my_id, $user_id){
        
        try{

            $delete_pending_friends = "DELETE FROM `friend_request` WHERE (sender = :frnd_id AND receiver = :my_id)";
            $delete_stmt = $this->db->prepare($delete_pending_friends);
            $delete_stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $delete_stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT);
            $delete_stmt->execute();
            if($delete_stmt->execute()){

                $sql = "INSERT INTO `bookings`(userid, guideid) VALUES(?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$user_id, $my_id]);
                header('Location: guide_profile.php?id='.$user_id);
                exit;
                
            }            
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // REQUEST NOTIFICATIONS
    public function request_notification($my_id, $send_data){
        try{
            $sql = "SELECT sender, userid, username, user_image, charge FROM `friend_request` JOIN users ON friend_request.sender = users.userid WHERE receiver = ?";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$my_id]);
            if($send_data){
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return $stmt->rowCount();
            }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }


    public function get_all_bookings($my_id, $send_data){
        try{
            $sql = "SELECT * FROM `bookings` WHERE userid = :my_id OR guideid = :my_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->execute();

                if($send_data){

                    $return_data = [];
                    $all_users = $stmt->fetchAll(PDO::FETCH_OBJ);

                    foreach($all_users as $row){
                        if($row->userid == $my_id){
                            $get_user= "SELECT * FROM `guide` WHERE guideid = ?";
                            $get_user_stmt = $this->db->prepare($get_user);
                            $get_user_stmt->execute([$row->guideid]);
                            array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ));
                        }else{
                            $get_user = "SELECT * FROM `users` WHERE userid = ?";
                            $get_user_stmt = $this->db->prepare($get_user);
                            $get_user_stmt->execute([$row->userid]);
                            array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ));
                        }
                    }

                    return $return_data;
                    echo $return_data;
                    
                }
                else{
                    return $stmt->rowCount();
                }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_all_users($my_id, $send_data){
        try{
            $sql = "SELECT * FROM `bookings` WHERE userid = :my_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->execute();

                if($send_data){

                    $return_data = [];
                    $all_users = $stmt->fetchAll(PDO::FETCH_OBJ);

                    foreach($all_users as $row){
                            $get_user = "SELECT userid, username, user_image FROM `users` WHERE userid = ?";
                            $get_user_stmt = $this->db->prepare($get_user);
                            $get_user_stmt->execute([$row->guideid]);
                            array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ));
                            return $return_data;
                        }
                    }
                    
                
                else{
                    return $stmt->rowCount();
                }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>