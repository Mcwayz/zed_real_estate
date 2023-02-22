<?php


class Client
{

    protected $db;

    public function __construct()
    {
        $this->db = new Database;
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


    public function insertClient($user_id, $nrc_no, $nrc_attachment, $province, $city, $town)
    {
        $Message = "Client Registration: ";
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `clients`(`user_id`, `nrc_no`, `nrc_attachment`, `client_province`, `client_city`, `client_town`)
        VALUES(:user_id, :nrc_no, :nrc_attachment, :province, :city, :town)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':nrc_no', $nrc_no);
        $query->bindParam(':nrc_attachment', $nrc_attachment);
        $query->bindParam(':province', $province);
        $query->bindParam(':city', $city);
        $query->bindParam(':town', $town);
        if($query->execute()){
            echo "<script>alert('Your Profiles is Now Complete..!')</script>";
            echo "<script>window.location.href = 'dashboard-client.php'</script>";
        }else
        {
            $this->showFailure($Message);
        }
    }



    // Function that updates a client account in the DB


    public function updateClient($user_id, $nrc_no, $nrc_attachment, $province, $city, $town)
    {
        $Message = "Client Update: ";
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE clients SET `nrc_no`=:nrc_no,`nrc_attachment`=:nrc_attachment,
        `client_province`=:province,`client_city`=:city,`client_town`=:town WHERE `user_id`=:user_id";
         $query = $dbConn->prepare($sql);
         $query->bindParam(':user_id', $user_id);
         $query->bindParam(':nrc_no', $nrc_no);
         $query->bindParam(':nrc_attachment', $nrc_attachment);
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


    public function checkDetails($user_id, $nrc_no, $nrc_attachment, $province, $city, $town)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `clients` WHERE `user_id`='$user_id'";
        $query =  $dbConn->query($sql);
        if($query->rowCount() > 0){
            $Message = "User Record Already Exists: Operation";
            $this->showFailure($Message);
        }else{
            $this->insertClient($user_id, $nrc_no, $nrc_attachment, $province, $city, $town);
        }

    }


    // function that saves a transaction based on the payment gateway response


    public function saveTransaction($txn, $property_id, $client_id, $amount)
    {
        $Message = "Transaction: ";
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO transactions(`id`,`property_id`,`client_id`,`amount`)
        VALUES (:txn, :property_id, :client_id, :amount)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':txn', $txn);
        $query->bindParam(':property_id', $property_id);
        $query->bindParam(':client_id', $client_id);
        $query->bindParam(':amount', $amount);
        if($query->execute())
        {
            $this->showSuccess($Message);
            echo "<script>alert('Transaction Successful..!')</script>";
            $this->updateStatus($property_id);
        }
        else{
            $this->showFailure($Message);
        }
    }


    // function that saves a transaction based on the payment gateway response


    public function updateStatus($property_id)
    {
        $p_state = "Taken";
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE properties SET `property_status`= :property
        WHERE `id`= :property_id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':property_id', $property_id);
        $query->bindParam(':property', $p_state);
        return $query->execute();
       
    }


    // Function that gets a single transaction


    public function getTransaction($id){
        $dbConn = $this->db->getConnection();
        $sql = "SELECT properties.id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name, 
        property_type.property_type,  properties.property_status, properties.property_amount, 
        property_owners.owner_province, property_owners.owner_city, property_owners.owner_town,
        properties.property_details, transactions.amount, transactions.id AS txn_id, transactions.txn_date
        FROM properties
        INNER JOIN property_type ON property_type.id = properties.property_type_id 
        INNER JOIN property_owners ON property_owners.user_id = properties.property_owner_id
        INNER JOIN users ON users.id = property_owners.user_id
        INNER JOIN transactions ON transactions.property_id = properties.id
        WHERE transactions.id = '$id'";
        return $dbConn->query($sql);
    }


    // Function that gets user information by id


    public function getUser($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM users WHERE id = '$id'";
        return $dbConn->query($sql);
    }


    // Function that sends a message to the Property Owner


    public function sendMsg($property_id, $client_id, $client_msg, $client_msg_date)
    {
        $Message = "Message: ";
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO property_chats(`property_id`,`client_id`,`client_msg_date`, 
        `property_owner_msg`,`property_owner_msg_date`)VALUES(:property_id, :client_id,
        :client_msg, :client_msg_date)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':property_id', $property_id);
        $query->bindParam(':client_id', $client_id);
        $query->bindParam(':client_msg', $client_msg);
        $query->bindParam(':client_msg_date', $client_msg_date);
        if($query->execute())
        {
            $this->showSuccess($Message);
        }
        else{
            $this->showFailure($Message);
        }
    }


    // Function that comments on property


    public function addComment($property_id, $user_id, $comment)
    {
        $Message = "Comment: ";
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `comments_tbl`(`property_id`, `user_id`, `comment`) 
        VALUES(:property, :user, :comment)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':property', $property_id);
        $query->bindParam(':user', $user_id);
        $query->bindParam(':comment', $comment);
        if($query->execute()){
            $this->showSuccess($Message);
        }else{
            $this->showFailure($Message);
        }
    }



    // Function that gets all properties 


    public function getProperties()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT DISTINCT properties.id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name, users.profile_pic, 
        property_type.property_type,  properties.property_status, properties.no_of_views, properties.property_amount, 
        properties.property_details, properties.upload_date, (SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id = properties.id LIMIT 1) AS property_attachment 
        FROM properties 
        INNER JOIN property_type ON property_type.id = properties.property_type_id 
        INNER JOIN property_owners ON property_owners.user_id = properties.property_owner_id
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id
        INNER JOIN users ON users.id = property_owners.user_id
        WHERE properties.property_status = 'Available' AND properties.ad_type_id = '1' ORDER BY properties.id DESC";
        return $dbConn->query($sql);
    }



    // Function that gets all properties 


    public function getPropertiesSale()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT DISTINCT properties.id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name, users.profile_pic, 
        property_type.property_type,  properties.property_status, properties.no_of_views, properties.property_amount, 
        properties.property_details, properties.upload_date, (SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id = properties.id LIMIT 1) AS property_attachment 
        FROM properties 
        INNER JOIN property_type ON property_type.id = properties.property_type_id 
        INNER JOIN property_owners ON property_owners.user_id = properties.property_owner_id
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id
        INNER JOIN users ON users.id = property_owners.user_id
        WHERE properties.property_status = 'Available' AND properties.ad_type_id = '2' ORDER BY properties.id DESC";
        return $dbConn->query($sql);
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


    // Function that gets all properties that are rented


    public function rentedProperties($id)
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
        WHERE transactions.client_id = '$id' AND properties.property_status = 'Taken' AND properties.ad_type_id = '1' ORDER BY properties.id DESC";
        return $dbConn->query($sql);
    }



    // Function that searches for properties


    public function searchProperty($search)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT DISTINCT properties.id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name, 
        property_type.property_type,  properties.property_status, properties.no_of_views, properties.property_amount, 
        properties.property_details, properties.upload_date,(SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id = properties.id LIMIT 1) AS property_attachment 
        FROM properties 
        INNER JOIN property_type ON property_type.id = properties.property_type_id 
        INNER JOIN property_owners ON property_owners.user_id = properties.property_owner_id
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id
        INNER JOIN users ON users.id = property_owners.user_id
        WHERE property_type.property_type LIKE '%$search%' OR properties.property_amount LIKE '%$search%' AND
        properties.property_status = 'Available' ORDER BY properties.id DESC";
        return $dbConn->query($sql);
    }



     // Function that checks for the presence of a client ID


     public function getClientID($id)
     {
        $id = $_SESSION['id'];
        $dbConn = $this->db->getConnection();
        $sql ="SELECT * FROM clients WHERE `user_id` = '$id'";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
            $query->fetch(PDO::FETCH_ASSOC);
        }else{
            $id = $_SESSION['id'];
            $dbConn = $this->db->getConnection();
            $sql ="SELECT * FROM property_owners WHERE `user_id` = '$id'
            AND account_status='0'";
            $query = $dbConn->query($sql);
            if ($query->rowCount() > 0) 
            {
                echo "<script>alert('Your Account is Pending Admin Approval..!')</script>";
                echo "<script>window.load.href='../Views/dashboard-client.php';</script>";
            }else{
                echo "<script>alert('Complete Your Profile To Access This Section..!')</script>";
                echo "<script>window.location.href='../Views/client-sign-up.php';</script>";
            }
        }
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


    // Function that gets a single property


    public function getComments($property_id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT comments_tbl.id, CONCAT(users.firstname, ' ', users.lastname) AS Client_Name, 
        comments_tbl.comment, comments_tbl.comment_date
        FROM comments_tbl
        INNER JOIN users ON users.id = comments_tbl.user_id
        WHERE comments_tbl.property_id ='$property_id'";
        return $dbConn->query($sql);
    }

    
}

?>