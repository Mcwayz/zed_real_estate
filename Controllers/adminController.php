<?php


//Checking Set Sessions


if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


//Instance of the class


require_once '../Models/Admin.php';
require_once '../Database/database_connection.php';  
$model = new Admin();


// gets the post data a user


if(isset($_POST['approve-client'])){
    $user_id = $_SESSION['user_id'];
    $model->approveClient($user_id);
}


// gets the post data for updating a user


if(isset($_POST['approve-owner'])){
    $user_id = $_POST['user_id'];
    $model->approveOwner($user_id);
}



?>