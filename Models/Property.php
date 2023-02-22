<?php


class Property
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


    // Function that inserts a property into the DB


    public function insertProperty($owner_id, $p_type, $a_type, $p_amount, $details)
    {
        $p_status ="Available"; $visible=0; $views=0; $ads = 0;
        $Message = "Property Description: "; $owner_id = $_SESSION['id'];
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `properties`(`property_owner_id`, `property_type_id`, `ad_type_id`,
        `property_status`, `property_amount`, `visibility`, `no_of_views`, `property_details`, `ad`)
        VALUES(:owner_id, :p_type, :a_type, :p_status, :amount, :visible, :views, :details, :ads)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':owner_id', $owner_id);
        $query->bindParam(':p_type', $p_type);
        $query->bindParam(':p_status', $p_status);
        $query->bindParam(':a_type', $a_type);
        $query->bindParam(':amount', $p_amount);
        $query->bindParam(':visible', $visible);
        $query->bindParam(':views', $views);
        $query->bindParam(':details', $details);
        $query->bindParam(':ads', $ads);
        if($query->execute()){
            $this->showSuccess($Message);
            $this->getPropertyID($owner_id);
        }else
        {
            $this->showFailure($Message);
        }
    }


    // Function that updates a property in the DB


    public function updateProperty($prop_id, $p_type, $a_type, $p_status, $p_amount, $details, $ads)
    {
        $Message = "Client Update: ";
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `properties` SET `property_type_id`=':p_type',`ad_type_id`=':a_type',
         `property_amount`=':amount', `property_details`=':details', `ad`=:ads WHERE `id`=':prop_id'";
         $query = $dbConn->prepare($sql);
         $query->bindParam(':prop_id', $prop_id);
         $query->bindParam(':p_type', $p_type);
         $query->bindParam(':a_type', $a_type);
         $query->bindParam(':p_status', $p_status);
         $query->bindParam(':amount', $p_amount);
         $query->bindParam(':details', $details);
         $query->bindParam(':ads', $ads);
         if($query->execute()){
             $this->showSuccess($Message);
         }else
         {
            $this->showFailure($Message);
         }
    }


    // Function that gets a single property


    public function getProperty($property_id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT DISTINCT properties.id, CONCAT(users.firstname, ' ', users.lastname) AS Owner_Name, 
        property_type.property_type, users.profile_pic, properties.property_status, properties.no_of_views, properties.property_amount, 
        properties.property_details, properties.upload_date, (SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id = properties.id LIMIT 1) AS property_attachment 
        FROM properties 
        INNER JOIN property_type ON property_type.id = properties.property_type_id 
        INNER JOIN property_owners ON property_owners.user_id = properties.property_owner_id
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id
        INNER JOIN users ON users.id = property_owners.user_id
        WHERE properties.id ='$property_id'";
       return $dbConn->query($sql);
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
    

    // Function that gets a single property


    public function getPropertyImages($property_id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id ='$property_id'";
        return $dbConn->query($sql);
    }


    // Function that gets a single property


    public function getPropertyAds()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT DISTINCT properties.id, properties.property_details,properties.property_amount, 
        (SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id = properties.id LIMIT 1) AS property_attachment
        FROM properties
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id
        WHERE properties.ad ='0' LIMIT 4";
       return $dbConn->query($sql);
    }


    // Function that gets a single property


    public function getPropertyAds1()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT DISTINCT properties.id, properties.property_details,properties.property_amount, 
        (SELECT property_attachments.property_attachment
        FROM property_attachments WHERE property_attachments.property_id = properties.id LIMIT 1) AS property_attachment
        FROM properties
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id
        WHERE properties.ad ='0' LIMIT 1";
       return $dbConn->query($sql);
    }  
    
    

    // Function that gets all properties in the DB


    public function getProperties()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM properties INNER JOIN
        property_owners ON property_owners.user_id = properties.property_owner_id
        INNER JOIN ad_type ON ad_type.id = properties.ad_type_id
        INNER JOIN property_type ON property_type.id = properties.property_type_id
        INNER JOIN property_attachments ON property_attachments.property_id = properties.id 
        ORDER BY properties.id DESC";
        return $dbConn->query($sql);
    }


    // Function that gets all transactions


    public function getPropertyTxns()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM transactions INNER JOIN
        properties ON properies.client_id = transactions.client_id
        ORDER BY transactions.id DESC";
        return $dbConn->query($sql);
    }


    // Function that gets all property types


    public function getPropertyTypes()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `property_type`
        ORDER BY property_type.id DESC";
        return $dbConn->query($sql);
    }


    // Function that gets all A Types


    public function getATypes()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `ad_type`
        ORDER BY ad_type.id DESC";
        return $dbConn->query($sql);
    }


    // Function that gets a single transaction for a property


    public function getPropertyTxn($property_id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM transactions INNER JOIN
        properties ON properies.client_id = transactions.client_id
        WHERE properties.id =:property_id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':property_id', $property_id);
        $query->execute();
    }


    // Function that uploads property images

    
    public function uploadDocuments($id, $document)
    {
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `property_attachments`(`property_id`, `property_attachment`)
         VALUES (:property_id, :document)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':property_id', $id);
        $query->bindParam(':document', $document);
        $query->execute();
    }


    // Function that gets the last id of the property created by the owner


    public function getPropertyID($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT MAX(id) AS property_id 
        FROM properties WHERE properties.property_owner_id = '$id'";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['last_id'] = $result['property_id'];
        }
    }


    // Function that updates the number of viewws


    public function updateView($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE properties SET no_of_views = no_of_views + 1 
        WHERE properties.id = '$id'";
        return $dbConn->query($sql);
    }


        

    
}



?>