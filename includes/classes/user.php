<?php
// user.php
class User{
    protected $db;
    protected $user_name;
    protected $user_email;
    protected $user_pass;
    protected $hash_pass;
    protected $gender;
    protected $contact;
    protected $bio;
    protected $city;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // SING UP USER
    function singUpUser($username, $email, $password, $gender, $contact, $bio, $city){
        try{
            $this->user_name = trim($username);
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $this->gender = trim($gender);
            $this->contact = trim($contact);
            $this->bio = trim($bio);
            $this->city = trim($city);
            if(!empty($this->user_name) && !empty($this->user_email) && !empty($this->user_pass) && !empty($this->gender) && !empty($this->contact) && !empty($this->bio) && !empty($this->city)) {

                if (filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) { 
                    $check_email = $this->db->prepare("SELECT * FROM `users` WHERE user_email = ?");
                    $check_email->execute([$this->user_email]);

                    if($check_email->rowCount() > 0){
                        return ['errorMessage' => 'This Email Address is already registered. Please Try another.'];
                    }
                    else{
                        
                        if($this->gender == 'Female'){
                            $user_image = rand(1,17);
                        }
                        else{
                            $user_image = rand(18,36);
                        }

                        $this->hash_pass = password_hash($this->user_pass, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `users` (username, user_email, user_password, user_image, gender, city, contact, bio) VALUES(:username, :user_email, :user_pass, :user_image, :gender, :city, :contact, :bio)";
            
                        $sign_up_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $sign_up_stmt->bindValue(':username',htmlspecialchars($this->user_name), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':user_email',$this->user_email, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':user_pass',$this->hash_pass, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':gender',$this->gender, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':city',$this->city, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':contact',$this->contact, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':bio',$this->bio, PDO::PARAM_STR);
                        // INSERTING RANDOM IMAGE NAME
                        $sign_up_stmt->bindValue(':user_image',$user_image.'.png', PDO::PARAM_STR);
                        $sign_up_stmt->execute();
                        return ['successMessage' => 'You have signed up successfully.'];                   
                    }
                }
                else{
                    return ['errorMessage' => 'Invalid email address!'];
                }    
            }
            else{
                return ['errorMessage' => 'Please fill in all the required fields.'];
            } 
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // LOGIN USER
    function loginUser($email, $password){
        
        try{
            $this->user_email = trim($email);
            $this->user_pass = trim($password);

            $find_email = $this->db->prepare("SELECT * FROM `users` WHERE user_email = ?");
            $find_email->execute([$this->user_email]);
            
            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);

                $match_pass = password_verify($this->user_pass, $row['user_password']);
                if($match_pass){
                    $_SESSION = [
                        'user_id' => $row['userid'],
                        'email' => $row['user_email']
                    ];
                    header('Location: userprofile.php');
                }
                else{
                    return ['errorMessage' => 'Invalid password'];
                }
                
            }
            else{
                return ['errorMessage' => 'Invalid email address!'];
            }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // FIND USER BY ID
    function find_user_by_id($id){
        try{
            $find_user = $this->db->prepare("SELECT * FROM `users` WHERE userid = ?");
            $find_user->execute([$id]);
            if($find_user->rowCount() === 1){
                return $find_user->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
}
?>