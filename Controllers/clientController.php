<?php

//Checking Set Sessions


if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


//Instance of the class


require_once '../Models/Client.php';
require_once '../Database/database_connection.php';  
$model = new Client();


// gets the post data for adding a client


if(isset($_POST['add-client'])){
    if (!empty($_FILES['nrc']['name'])) {
        $image = time() . '_' . $_FILES['nrc']['name'];
        $destination = "../Sys_Uploads/profile/client/".$image;
        $result = move_uploaded_file($_FILES['nrc']['tmp_name'], $destination);
        if ($result) {
           $_POST['nrc'] = $image;
        } else {
           array_push($errors, "Image upload failed");
        }
     } else {
        array_push($errors, "Image is required");
     }
    $user_id = $_SESSION['id'];
    $phone = $_POST['phone'];
    $nrc_attachment = $_POST['nrc'];
    $nrc_no = $_POST['nrc-no'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $town = $_POST['town'];
    $model->checkDetails($user_id, $nrc_no, $nrc_attachment, $province, $city, $town);
}


// gets the post data for updating a client


if(isset($_POST['update-client'])){
    $user_id = $_SESSION['id'];
    $phone = $_POST['phone'];
    $nrc_attachment = $_POST['image'];
    $nrc_no = $_POST['nrc-no'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $town = $_POST['town'];
    $model->updateClient($user_id, $nrc_no, $nrc_attachment, $province, $city, $town);
}



// gets the post data for updating a users profile


if(isset($_POST['add-property'])){
    if (!empty($_FILES['nrc']['name'])) {
        $image = time() . '_' . $_FILES['nrc']['name'];
        $destination = "../Sys_Uploads/profile/client/".$image;
        $result = move_uploaded_file($_FILES['nrc']['tmp_name'], $destination);
        if ($result) {
           $_POST['nrc'] = $image;
        } else {
           array_push($errors, "Image upload failed");
        }
     } else {
        array_push($errors, "Image is required");
     }
    $user_id = $_SESSION['id'];
    $phone = $_POST['phone'];
    $nrc_attachment = $_POST['nrc'];
    $nrc_no = $_POST['nrc-no'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $town = $_POST['town'];
    $model->checkDetails($user_id, $nrc_no, $nrc_attachment, $province, $city, $town);
}


// gets the post data for updating a client


if(isset($_POST['update-users'])){
    if (!empty($_FILES['profile']['name'])) {
        $image = time() . '_' . $_FILES['profile']['name'];
        $destination = "../Sys_Uploads/user_profile_pics/client/".$image;
        $result = move_uploaded_file($_FILES['profile']['tmp_name'], $destination);
        if ($result) {
           $_POST['profile'] = $image;
        } else {
           array_push($errors, "Image upload failed");
        }
     } else {
        array_push($errors, "Image is required");
     }
    $user_id = $_SESSION['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email_address = $_POST['email'];
    $password = $_POST['password'];
    $profile_pic = $_POST['profile'];
    $model->updateUserProfile($user_id, $firstname, $lastname, $email_address, $password, $profile_pic);
}


//gets a transaction response from the payment gateway


// if(isset($_POST['transact']))
// {
//     $txn = $_SESSION['tx_id'];
//     $client_id = $_SESSION['client_id'];
//     $property_id = $_POST['property_id'];
//     $amount = $_POST['amount'];
//     $model->saveTransaction($txn, $property_id, $client_id, $amount);
// }

//gets the massage and calls the send message function

if(isset($_POST['send-msg']))
{
    $client_id = $_SESSION['id'];
    $property_id = $_POST['property_id'];
    $client_msg = $_POST['client_msg'];
    $client_msg_date = date('D-m-Y h:i:s');
    $model->sendMsg($property_id, $client_id, $client_msg, $client_msg_date);
}



if(isset($_POST['comment']))
{
   $user_id = $_SESSION['id'];
   $property = $_SESSION['property'];
   $comment = $_POST['comment_text'];
   $model->addComment($property, $user_id, $comment);
}