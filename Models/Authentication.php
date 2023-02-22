<?php


class Authentication
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


    //Function that logs in users


    public function login($email, $pass)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `users`
        WHERE `email_address` = '$email' AND `password`= '$pass' LIMIT 1";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $result['id'];
            $_SESSION['email'] = $result['email_address'];
            $_SESSION['firstname'] = $result['firstname'];
            $_SESSION['lastname'] = $result['lastname'];
            $_SESSION['phone_no'] = $result['phone_no'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['password'] = $result['password'];
            //if(password_verify($pass, $password)){
                $role = $result['role'];
                if($role == "Admin")
                {
                    echo"<script>alert('Login Successful');</script>";
                    echo "<script>window.location.href = '../Views/dashboard-admin.php';</script>";
                }
                elseif($role == "User")
                {
                    $id = $_SESSION['id'];
                    $this->getClientID($id);
                }
                 else{
                    echo "<script>alert('Invalid Username / Password Error');</script>";
                }
        } 
        else 
        {
            echo "<script>alert('Login Error: User Not Found');</script>";
        }
    }


    //Function that valiates an email


    public function validateEmail($email)
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT * FROM users WHERE `email_address` = '$email'";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
            $_SESSION['email-error'] = "Email that you have entered is already exist!";
        }else{
           unset($_SESSION['email-error']);
        }
    }


    // Function that creates a new user


    public function createUser($firstname, $lastname, $email, $phonenumber, $password)
    {
        $Message = "User Registration:";
        $role = "User";
        $dbConn = $this->db->getConnection();
        $sql = " INSERT INTO users(`firstname`, `lastname`, `email_address`, `phone_no`, `role`, `password`)
        VALUES(:firstname, :lastname, :email, :phonenumber, :role, :password)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':firstname', $firstname);
        $query->bindParam(':lastname', $lastname);
        $query->bindParam(':phonenumber', $phonenumber);
        $query->bindParam(':email', $email);
        $query->bindParam(':role', $role);
        $query->bindParam(':password', $password);
        if($query->execute()){
            $this->showSuccess($Message);
        }else
        {
            $this->showFailure($Message);
        }
    }


    // Function that checks for the presence of a client ID


    public function getClientID($id)
    {
        $id = $_SESSION['id'];
        $dbConn = $this->db->getConnection();
        $sql ="SELECT * FROM property_owners WHERE `user_id` = '$id'";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['client_id'] = $result['id'];
            if($result['account_status'] == 0){
                echo "<script>alert('Account Awaiting Approval..!')</script>";
                echo "<script>window.location.href = '../authentication/sign-in.php';</script>";
            }else{
            //header("Location: ../Views/dashboard-property-owner.php");
            echo "<script>window.location.href = '../Views/dashboard-property-owner.php';</script>";
            }
        }else{
            $dbConn = $this->db->getConnection();
            $sql ="SELECT * FROM clients WHERE `user_id` = '$id'";
            $query = $dbConn->query($sql);
            if ($query->rowCount() > 0) 
            {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION['client_id'] = $result['id'];
                
                //header("Location: ../Views/dashboard-client.php");
                echo "<script>window.location.href = '../Views/dashboard-client.php';</script>";
            }else{
               echo "<script>alert('No Properties Available, Complete Your Profile..!')</script>";
               echo "<script>window.location.href = '../Views/dashboard-client.php';</script>";
            }
        }
   }

        
}
    

?>