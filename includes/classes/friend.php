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
    public function make_pending_friends($my_id, $guide_id, $charge, $date){
        
        try{
            $sql = "INSERT INTO `friend_request`(`sender`, `receiver`, `charge`, `date`) VALUES(?,?,?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$my_id, $guide_id, $charge, $date]);
            header('Location: user_profile.php?id='.$guide_id);
            exit;
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // CANCLE FRIEND REQUEST for users
    public function cancel_request($my_id, $guide_id){
        
        try{
            $sql = "DELETE FROM `friend_request` WHERE (sender = :my_id AND receiver = :guide_id)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->bindValue(':guide_id', $guide_id, PDO::PARAM_INT);
            $stmt->execute();
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
            $selectquery = "Select * FROM `friend_request` WHERE (sender = :user_id AND receiver = :my_id)";
            $select_info = $this->db->prepare($selectquery);
            $select_info->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $select_info->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $select_info->execute();
            $info = $select_info->fetch(PDO::FETCH_OBJ);
            
            $charge = $info->charge;
            $date = $info->date;
            
            $delete_pending_friends = "DELETE FROM `friend_request` WHERE (sender = :user_id AND receiver = :my_id)";
            $delete_stmt = $this->db->prepare($delete_pending_friends);
            $delete_stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $delete_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $delete_stmt->execute();
            if($delete_stmt->execute()){

                $sql = "INSERT INTO `bookings`(userid, guideid, charge, `date`) VALUES(?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$user_id, $my_id, $charge, $date]);
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
            $sql = "SELECT sender, userid, username, user_image, charge, `date` FROM `friend_request` JOIN users ON friend_request.sender = users.userid WHERE receiver = ?";

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
                            $info = [];
                            $charge = $row->charge;
                            $date = $row->date;
                            $get_user= "SELECT * FROM `guide` WHERE guideid = ?";
                            $get_user_stmt = $this->db->prepare($get_user);
                            $get_user_stmt->execute([$row->guideid]);
                            array_push($info, $get_user_stmt->fetch(PDO::FETCH_OBJ), $charge, $date);
                            array_push($return_data, $info);
                        }else{
                            $info = [];
                            $charge = $row->charge;
                            $date = $row->date;
                            $get_user = "SELECT * FROM `users` WHERE userid = ?";
                            $get_user_stmt = $this->db->prepare($get_user);
                            $get_user_stmt->execute([$row->userid]);
                            array_push($info, $get_user_stmt->fetch(PDO::FETCH_OBJ), $charge, $date);
                            array_push($return_data, $info);
                        }
                    }

                    return $return_data;
                    
                }
                else{
                    return $stmt->rowCount();
                }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    
    // add product 
    public function addproduct($vendorid, $productname, $category, $description, $price, $productimage){
        try{
            
            if(!empty($vendorid) && !empty($productname) && !empty($price) && !empty($category) && !empty($description) && !empty($productimage)) {

                        $sql = "INSERT INTO `product`(`vendorid`, `productname`, `category`, `description`, `price`, `productimage`) VALUES (:vendorid, :productname, :category, :description, :price, :productimage)";
            
                        $sign_up_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $sign_up_stmt->bindValue(':vendorid',$vendorid, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':productname',$productname, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':category',$category, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':description',$description, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':price',$price, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':productimage',$productimage, PDO::PARAM_STR);
                        $sign_up_stmt->execute();
                        return ['successMessage' => 'Product added successfully.'];                   
            }
            else{
                return ['errorMessage' => 'Please fill in all the required fields.'];
            } 
            }
            catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function showvendorproductlist($vendorid, $send_data){
            try {
                $productsql = 'select * from `product` where vendorid = :vendorid';
                $product_stmt = $this->db->prepare($productsql);
                $product_stmt->bindValue(':vendorid',$vendorid, PDO::PARAM_INT);
                $product_stmt->execute();
                $row_number = $product_stmt->rowCount();
                if ($send_data){
                    return $product_stmt->fetchall(PDO::FETCH_OBJ);
                }
                else{
                    return $row_number;
                }
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function allproduct(){
            try {
                $product_all = $this->db->prepare('select city, productimage, productname, price, productid FROM `vendor` JOIN `product` ON vendor.vendorid = product.vendorid ');
                $product_all->execute();
                $row_number = $product_all->rowCount();
                if ($row_number>0){
                    return $product_all->fetchall(PDO::FETCH_OBJ);
                }
                else{
                    return ['errorMessage' => 'No Products available right now!'];
                }
            } catch (PDOException $e) {
                die($e->getMessage());
            }
            
        }

        public function productbycity($city){
            try {
                $product_all = $this->db->prepare('select city, productimage, productname, price, productid FROM `vendor` JOIN `product` ON vendor.vendorid = product.vendorid where city = ?');
                $product_all->execute([$city]);
                $row_number = $product_all->rowCount();
                if ($row_number>0){
                    return $product_all->fetchall(PDO::FETCH_OBJ);
                }
                else{
                    return ['errorMessage' => 'No Products available  right now!'];
                }
            } catch (PDOException $e) {
                die($e->getMessage());
            }
            
        }

        public function showproductbyid($productid){
            try {
                $productsql = 'select * from `product` JOIN `vendor` ON product.vendorid = vendor.vendorid where productid = ?';
                $productstmt = $this->db->prepare($productsql);
                $productstmt->execute([$productid]);
                return $productstmt->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
//4 product
        public function randomproduct(){
            try {
                $productsql = 'select * from `product` ORDER BY RAND() LIMIT 3';
                $productstmt = $this->db->prepare($productsql);
                $productstmt->execute();
                return $productstmt->fetchall(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

}
?>