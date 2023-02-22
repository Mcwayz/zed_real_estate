<?php


class Admin
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


    // Function that approves a client account into the DB


    public function approveClient($user_id)
    {
        $status = 1;
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE clients SET `account_status`= '$status'
        WHERE `user_id`= '$user_id' ";
       return $dbConn->query($sql);
    }


    // Function that approves a owner account into the DB


    public function approveOwner($user_id)
    {
        $status = 1;
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `property_owners` SET `account_status`= '$status'
        WHERE `user_id`= '$user_id'";
        return $dbConn->query($sql);
        echo "<script>window.location.href = 'dashboard-admin.php'</script>";

    }



    // Function that gets all system users


    public function getUsers()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM users WHERE account_status='1'";
        return $dbConn->query($sql);
    }


    // Function that gets all system users


    public function getPending()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM users WHERE account_status='0' AND `role`='User'";
        return $dbConn->query($sql);
    }




    // Function that gets all clients


    public function getClients()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT clients.user_id, CONCAT(users.firstname, ' ', users.lastname) AS Client_Name, 
        clients.nrc_no, clients.nrc_attachment, clients.client_province, clients.client_city, 
        clients.client_town FROM `clients`
        INNER JOIN users ON users.id = clients.user_id";
        return $dbConn->query($sql);
    }


    // Function that gets a client info


    public function getClient($user_id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM clients WHERE `user_id`='$user_id'";
        return $dbConn->query($sql);
    }



    // Function that gets a client info


    public function getPendingOwners($user_id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT property_owners.user_id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name,
        property_owners.nrc_no, property_owners.nrc_attachment, property_owners.proof_of_residence, 
        property_owners.owner_province, property_owners.owner_town FROM `property_owners` 
        INNER JOIN users ON users.id = property_owners.user_id 
        WHERE property_owners.user_id='$user_id'";
        return $dbConn->query($sql);
    }



    // Function that gets all property owners


    public function getOwners()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT property_owners.user_id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name,
        property_owners.nrc_no, property_owners.nrc_attachment, property_owners.email_address, 
        property_owners.proof_of_residence, property_owners.owner_province, property_owners.owner_city, 
        property_owners.owner_town FROM `property_owners`
        INNER JOIN users ON users.id = property_owners.user_id";
        return $dbConn->query($sql);
    }



    // Function that gets new property owners


    public function getNotApprovedOwners()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT property_owners.user_id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name,
        property_owners.nrc_no, property_owners.nrc_attachment, property_owners.proof_of_residence, 
        property_owners.owner_province, property_owners.owner_city, property_owners.owner_town FROM `property_owners`
        INNER JOIN users ON users.id = property_owners.user_id
        WHERE property_owners.account_status='0'";
        return $dbConn->query($sql);
    }
    
    
    // Function that gets new property owners


    public function getApprovedOwners()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT property_owners.user_id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name,
        property_owners.nrc_no, property_owners.nrc_attachment, property_owners.proof_of_residence, 
        property_owners.owner_province, property_owners.owner_city, property_owners.owner_town FROM `property_owners`
        INNER JOIN users ON users.id = property_owners.user_id
        WHERE property_owners.account_status='1'" ;
        return $dbConn->query($sql);
    } 



    // Function that gets all properties that are rented


    public function rentedProperties()
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
        WHERE properties.property_status = 'Taken' AND properties.ad_type_id = '1' ORDER BY properties.id DESC";
        return $dbConn->query($sql);
    }



    // Function that gets all properties that are rented


    public function soldProperties()
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
        WHERE properties.property_status = 'Taken' AND properties.ad_type_id = '2' ORDER BY properties.id DESC";
        return $dbConn->query($sql);
    }



    // Function that gets  rental property


    public function countRentProperty()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT COUNT(*) AS properties FROM properties
        WHERE properties.ad_type_id = '1'";
        return $dbConn->query($sql);
    }


    // Function that gets property for sale


    public function countSaleProperty()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT COUNT(*) AS properties FROM properties
        WHERE properties.ad_type_id = '2'";
        return $dbConn->query($sql);
    }


    // Function that gets property for sale


    public function countProperty()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT COUNT(*) AS properties FROM properties";
        return $dbConn->query($sql);
    }

    // Function that returns the total number of users in the database


    public function countTotalUsers()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT COUNT(*) AS total_users FROM users
        WHERE users.role = 'User'";
        return $dbConn->query($sql);
    }


    
}



?>