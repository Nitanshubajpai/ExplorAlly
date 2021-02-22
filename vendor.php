<?php
// vendor.php
class vendor{
    protected $db;
    protected $vendor_name;
    protected $vendor_email;
    protected $vendor_pass;
    protected $hash_pass;
    protected $address;
    protected $contact;
    protected $bio;
    protected $city;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // SING UP vendor
    function singUpvendor($vendorname, $email, $password, $address, $contact, $city, $bio){
        try{
            $this->vendor_name = trim($vendorname);
            $this->vendor_email = trim($email);
            $this->vendor_pass = trim($password);
            $this->address = trim($address);
            $this->contact = trim($contact);
            $this->bio = trim($bio);
            $this->city = trim($city);
            if(!empty($this->vendor_name) && !empty($this->vendor_email) && !empty($this->vendor_pass) && !empty($this->address) && !empty($this->contact) && !empty($this->bio) && !empty($this->city)) {

                if (filter_var($this->vendor_email, FILTER_VALIDATE_EMAIL)) { 
                    $check_email = $this->db->prepare("SELECT * FROM `vendor` WHERE vendor_email = ?");
                    $check_email->execute([$this->vendor_email]);

                    if($check_email->rowCount() > 0){
                        return ['errorMessage' => 'This Email Address is already registered. Please Try another.'];
                    }
                    else{
                        $vendor_image = rand(1,10);
                        $this->hash_pass = password_hash($this->vendor_pass, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `vendor` (vendorname, vendor_email, vendor_password, vendor_image, `address`, city, contact, bio) VALUES(:vendorname, :vendor_email, :vendor_pass, :vendor_image, :address, :city, :contact, :bio)";
            
                        $sign_up_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $sign_up_stmt->bindValue(':vendorname',htmlspecialchars($this->vendor_name), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':vendor_email',$this->vendor_email, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':vendor_pass',$this->hash_pass, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':address',$this->address, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':city',$this->city, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':contact',$this->contact, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':bio',$this->bio, PDO::PARAM_STR);
                        // INSERTING RANDOM IMAGE NAME
                        $sign_up_stmt->bindValue(':vendor_image',$vendor_image.'.png', PDO::PARAM_STR);
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

    // LOGIN vendor
    function loginvendor($email, $password){
        
        try{
            $this->vendor_email = trim($email);
            $this->vendor_pass = trim($password);

            $find_email = $this->db->prepare("SELECT * FROM `vendor` WHERE vendor_email = ?");
            $find_email->execute([$this->vendor_email]);
            
            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);

                $match_pass = password_verify($this->vendor_pass, $row['vendor_password']);
                if($match_pass){
                    $_SESSION = [
                        'vendor_id' => $row['vendorid'],
                        'email' => $row['vendor_email']
                    ];
                    header('Location: vendorprofile.php');
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

    // FIND vendor BY ID
    function find_vendor_by_id($id){
        try{
            $find_vendor = $this->db->prepare("SELECT * FROM `vendor` WHERE vendorid = ?");
            $find_vendor->execute([$id]);
            if($find_vendor->rowCount() === 1){
                return $find_vendor->fetch(PDO::FETCH_OBJ);
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