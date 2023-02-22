<?php


class Owner
{

    protected $db;

    public function __construct()
    {
        $this->db = new Database;
        if(!isset($_SESSION['client_id']))
        {
            $id = $_SESSION['id'];
            //$this->getClientID($id);
        }
    }

    // Function that displays responses to the user


    public function showSuccess($Message){
        echo "<script>alert($Message+' Successful!')</script>";
    }


    // Function that displays responses to the user


    public function showFailure($Message){
        echo "<script>alert($Message+' Failed!')</script>";
    }


    // Function that creates a client account into the DB


    public function insertOwner($user_id, $nrc_no, $nrc_attachment, $proof_attachment, $province, $city, $town)
    {
        $email =  $_SESSION['email'];
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `property_owners`(`user_id`, `nrc_no`, `nrc_attachment`, `proof_of_residence`, 
        `owner_province`, `owner_city`, `owner_town`, `email_address`) VALUES(:user_id, :nrc_no, :nrc_attachment, 
        :proof_of_residence, :province, :city, :town, :email)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':nrc_no', $nrc_no);
        $query->bindParam(':nrc_attachment', $nrc_attachment);
        $query->bindParam(':proof_of_residence', $proof_attachment);
        $query->bindParam(':province', $province);
        $query->bindParam(':city', $city);
        $query->bindParam(':town', $town);
        $query->bindParam(':email', $email);
        if($query->execute()){
            echo "<script>alert('Your Profiles is Now Complete..!')</script>";
            session_destroy();
            echo "<script>window.location.href = 'dashboard-property-owner.php'</script>";
        }else
        {
            echo "<script>alert('Error, Please Try Again..!')</script>";
        }
    }



    // Function that updates a client account in the DB


    public function updateOwner($user_id, $province, $city, $town)
    {
        $Message = "Client Update: ";
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE clients SET `client_province`=:province,`client_city`=:city,`client_town`=:town WHERE `user_id`=:user_id";
         $query = $dbConn->prepare($sql);
         $query->bindParam(':user_id', $user_id);
         $query->bindParam(':province', $province);
         $query->bindParam(':city', $city);
         $query->bindParam(':town', $town);
         if($query->execute()){
             $this->showSuccess($Message);
         }else
         {
             $this->showFailure($Message);
         }
    }


    // Function that checks if the record already exists


    public function checkDetails($user_id, $nrc_no, $nrc_attachment, $proof_attachment, $province, $city, $town)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `property_owners` WHERE `user_id`='$user_id'";
        $query = $dbConn->query($sql);
        if($query->rowCount() > 0){
            echo "<script>alert('User Record Already Exists..!')</script>";
        }else{
            $this->insertOwner($user_id, $nrc_no, $nrc_attachment, $proof_attachment, $province, $city, $town);
        }

    }


    // Function that checks if the record already exists


    public function getPropertyType()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT property_type.id, property_type.property_type FROM property_type";
        return $dbConn->query($sql);
    }



    // Function that gets all properties 


    public function getProperties($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT DISTINCT properties.id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name, property_type.property_type, 
        properties.property_status, properties.property_amount, properties.property_details,
        properties.upload_date, ad_type.ad_type, (SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id = properties.id LIMIT 1) AS property_attachment
        FROM properties 
        INNER JOIN ad_type ON ad_type.id = properties.ad_type_id
        INNER JOIN property_type ON property_type.id = properties.property_type_id
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id 
        INNER JOIN users ON users.id = properties.property_owner_id
        WHERE properties.property_owner_id='$id' ORDER BY properties.id DESC";
        return $dbConn->query($sql);
    }


    // function that saves a transaction based on the payment gateway response


    public function saveTransaction($property_id, $client_id, $amount)
    {
        $Message = "Transaction: ";
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO transactions(`property_id`,`client_id`,`amount`)
        VALUES (:property_id, :client_id, :amount)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':property_id', $property_id);
        $query->bindParam(':client_id', $client_id);
        $query->bindParam(':amount', $amount);
        if($query->execute())
        {
            $this->showSuccess($Message);
        }
        else{
            $this->showFailure($Message);
        }
    }


    // Function that sends a message to the Property Owner


    public function replyMsg($property_id, $client_id, $owner_id, $owner_msg, $owner_msg_date)
    {
        $Message = "Message: ";
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE property_chats SET `property_owner_msg`=:owner_msg, `property_owner_msg_date`=:owner_msg_date
        WHERE `property_id`=:property_id AND `client_id`=:client_id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':property_id', $property_id);
        $query->bindParam(':client_id', $client_id);
        $query->bindParam(':owner_id', $owner_id);
        $query->bindParam(':owner_msg', $owner_msg);
        $query->bindParam(':owner_msg_date', $owner_msg_date);
        if($query->execute())
        {
            $this->showSuccess($Message);
        }
        else{
            $this->showFailure($Message);
        }
    }


    //Function that checks for the presence of a client ID


    public function getClientID($id)
    {
        $id = $_SESSION['id'];
        $dbConn = $this->db->getConnection();
        $sql ="SELECT * FROM property_owners WHERE `user_id` = '$id'
        AND account_status='1'";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
            $result = $query->fetch(PDO::FETCH_ASSOC);
        }else{
            $id = $_SESSION['id'];
            $dbConn = $this->db->getConnection();
            $sql ="SELECT * FROM property_owners WHERE `user_id` = '$id'
            AND account_status='0'";
            $query = $dbConn->query($sql);
            if ($query->rowCount() > 0) 
            {
                echo "<script>alert('Your Account is Pending Admin Approval..!')</script>";
                echo "<script>window.load.href='../Views/dashboard-property-owner.php';</script>";
            }else{
                echo "<script>alert('Complete Your Profile To Access This Section..!')</script>";
                echo "<script>window.load.href='../Views/property-owner-sign-up.php';</script>";
            }
        }
    }




        // function that returns property that has been sold


    public function soldProperty($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT DISTINCT properties.id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name, 
        property_type.property_type,  properties.property_status, properties.no_of_views, properties.property_amount, 
        properties.property_details, properties.upload_date, transactions.client_id, transactions.id AS txn_id, 
        (SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id = properties.id LIMIT 1) AS property_attachment 
        FROM properties 
        INNER JOIN property_type ON property_type.id = properties.property_type_id 
        INNER JOIN property_owners ON property_owners.user_id = properties.property_owner_id
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id
        INNER JOIN users ON users.id = property_owners.user_id
        INNER JOIN ad_type ON ad_type.id = properties.ad_type_id
        INNER JOIN transactions ON transactions.property_id = properties.id
        WHERE transactions.client_id = '$id' AND properties.property_status = 'Taken' AND properties.ad_type_id = '2' ORDER BY properties.id DESC";
        return $dbConn->query($sql);
    }


    // Function that updates a Users Profile details


    public function updateUserProfile($user_id, $firstname, $lastname, $email_address, $password, $profile_pic)
    {
        $Message = "User Profile Update: ";
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE users SET `firstname`=:firstname,`lastname`=:lastname,`email_address`=:email_address,
        `password`=:password,`profile_pic`=:profile_pic WHERE `id`=:user_id";
         $query = $dbConn->prepare($sql);
         $query->bindParam(':user_id', $user_id);
         $query->bindParam(':firstname', $firstname);
         $query->bindParam(':lastname', $lastname);
         $query->bindParam(':email_address', $email_address);
         $query->bindParam(':password', $password);
         $query->bindParam(':profile_pic', $profile_pic);
         if ($query->execute()){
            $this->showSuccess($Message);
        }else{
            $this->showFailure($Message);
        }
    }



    // function that gets the total number  properties


    public function getTotalViews($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT COUNT(*) AS total_properties FROM properties 
        WHERE property_owner_id = '$id'";
        return $dbConn->query($sql);
    }


    public function countProperty($id){
        $dbConn = $this->db->getConnection();
        $sql = "SELECT COUNT(*) AS properties FROM properties 
        WHERE property_owner_id = '$id'";
        return $dbConn->query($sql);
    }

    // function that counts the number of properties for rent


    public function getRentedNo($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT COUNT(*) AS rent_properties FROM properties 
        WHERE ad_type_id = '1' AND property_owner_id = '$id'";
        return $dbConn->query($sql);
    }


    // Function that counts the number of properties for sale


    public function getSales($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT COUNT(*) AS sale_properties FROM properties 
        WHERE ad_type_id = '2' AND property_owner_id = '$id'";
        return $dbConn->query($sql);
    }


    // Function that counts the number of viewed properties


    public function getViewedProperties($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT COUNT(*) AS engaged FROM properties WHERE no_of_views > 0
         AND property_owner_id = '$id'";
        return $dbConn->query($sql);
    }
    
    
}
?>