<?php
// guide.php
class guide{
    protected $db;
    protected $guide_name;
    protected $guide_email;
    protected $guide_pass;
    protected $hash_pass;
    protected $gender;
    protected $contact;
    protected $bio;
    protected $city;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // SING UP guide
    function singUpguide($guidename, $email, $password, $gender, $contact, $bio, $city){
        try{
            $this->guide_name = trim($guidename);
            $this->guide_email = trim($email);
            $this->guide_pass = trim($password);
            $this->gender = trim($gender);
            $this->contact = trim($contact);
            $this->bio = trim($bio);
            $this->city = trim($city);
            if(!empty($this->guide_name) && !empty($this->guide_email) && !empty($this->guide_pass) && !empty($this->gender) && !empty($this->contact) && !empty($this->bio) && !empty($this->city)) {

                if (filter_var($this->guide_email, FILTER_VALIDATE_EMAIL)) { 
                    $check_email = $this->db->prepare("SELECT * FROM `guide` WHERE guide_email = ?");
                    $check_email->execute([$this->guide_email]);

                    if($check_email->rowCount() > 0){
                        return ['errorMessage' => 'This Email Address is already registered. Please Try another.'];
                    }
                    else{
                        
                        $guide_image = rand(1,12);

                        $this->hash_pass = password_hash($this->guide_pass, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `guide` (guidename, guide_email, guide_password, guide_image, gender, city, contact, bio) VALUES(:guidename, :guide_email, :guide_pass, :guide_image, :gender, :city, :contact, :bio)";
            
                        $sign_up_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $sign_up_stmt->bindValue(':guidename',htmlspecialchars($this->guide_name), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':guide_email',$this->guide_email, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':guide_pass',$this->hash_pass, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':gender',$this->gender, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':city',$this->city, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':contact',$this->contact, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':bio',$this->bio, PDO::PARAM_STR);
                        // INSERTING RANDOM IMAGE NAME
                        $sign_up_stmt->bindValue(':guide_image',$guide_image.'.png', PDO::PARAM_STR);
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
    // LOGIN guide
    function loginguide($email, $password){
        
        try{
            $this->guide_email = trim($email);
            $this->guide_pass = trim($password);

            $find_email = $this->db->prepare("SELECT * FROM `guide` WHERE guide_email = ?");
            $find_email->execute([$this->guide_email]);
            
            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);

                $match_pass = password_verify($this->guide_pass, $row['guide_password']);
                if($match_pass){
                    $_SESSION = [
                        'guide_id' => $row['guideid'],
                        'email' => $row['guide_email']
                    ];
                    header('Location: guideprofile.php');
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

    // FIND guide BY ID
    function find_guide_by_id($id){
        try{
            $find_guide = $this->db->prepare("SELECT * FROM `guide` WHERE guideid = ?");
            $find_guide->execute([$id]);
            if($find_guide->rowCount() === 1){
                return $find_guide->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    // FETCH ALL guide 
    function all_guide(){
        try{
            $get_guide = $this->db->prepare("SELECT * FROM `guide`");
            $get_guide->execute();
            if($get_guide->rowCount() > 0){
                return $get_guide->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // FETCH GUIDE by CITY
    function guide_by_city($city){
        try{
            $get_guide_city = $this->db->prepare("SELECT * FROM `guide` where city = ?");
            $get_guide_city->execute([$city]);
            if($get_guide_city->rowCount() > 0){
                return $get_guide_city->fetchAll(PDO::FETCH_OBJ);
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