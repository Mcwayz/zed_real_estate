<?php

//Checking Set Sessions

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include_once '../Models/Owner.php';
include_once '../Models/Property.php';
require_once '../Database/database_connection.php'; 
$model = new Owner();
$property = new Property();
// gets the post data for adding a client


if(isset($_POST['add-owner'])){
    if (!empty($_FILES['nrc_att']['name']) || $_FILES['proof']['name']) {
        $image = time() . '_' . $_FILES['nrc_att']['name'];
        $image1 = time() . '_' . $_FILES['proof']['name'];
        $destination = "../Sys_Uploads/profile/landlord/".$image;
        $destination1 = "../Sys_Uploads/profile/landlord/".$image1;
        $result = move_uploaded_file($_FILES['nrc_att']['tmp_name'], $destination);
        $result1 = move_uploaded_file($_FILES['proof']['tmp_name'], $destination1);
        if ($result) {
           $_POST['nrc_att'] = $image;
           $_POST['proof'] = $image1;
        } else {
           array_push($errors, "Image upload failed");
        }
     } else {
        array_push($errors, "Image is required");
    }
    $user_id = $_SESSION['id'];
    $phone =  $_SESSION['phone_no'];
    $nrc_attachment = $_POST['nrc_att'];
    $proof_attachment = $_POST['proof'];
    $nrc_no = $_POST['nrc-no'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $town = $_POST['town'];
    $model->checkDetails($user_id, $nrc_no, $nrc_attachment, $proof_attachment, $province, $city, $town);
} 


// gets the post data for updating a client


if(isset($_POST['update-owner'])){
    $user_id = $_SESSION['user_id'];
    $phone = $_POST['phone'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $town = $_POST['town'];
    $model->updateOwner($user_id, $province, $city, $town);
}


//gets the massage and calls the send message function


if(isset($_POST['reply-msg']))
{
    $client_id = $_SESSION['client_id'];
    $owner_id = $_SESSION['owner_id'];
    $property_id = $_POST['property_id'];
    $owner_msg = $_POST['owner_msg'];
    $owner_msg_date = date('D-m-Y h:i:s');
    $model->replyMsg($property_id, $client_id, $owner_id, $owner_msg, $owner_msg_date);
}



if(isset($_POST['add-property'])){
    $user_id = $_SESSION['client_id'];
    $p_type = $_POST['property_type'];
    $a_type = $_POST['ad_type'];
    $p_amount = $_POST['price'];
    $desc = $_POST['property_desc'];
    $property->insertProperty($user_id, $p_type, $a_type, $p_amount, $desc);
    //header("Location: ../views/add-attachments.php");
    echo "<script>window.location.href = '../Views/add-attachments.php';</script>";
} 


if (isset($_POST['upload_documents'])) 
{
   $documentCount = count($_FILES['image']['name']);
   for($i = 0; $i < $documentCount; $i++){
      $documentName = $_FILES['image']['name'][$i];
      $documentTempName = $_FILES['image']['tmp_name'][$i];
      $destination = "../Sys_Uploads/properties/".$documentName;
      if(move_uploaded_file($_FILES['image']['tmp_name'][$i], $destination)) {
         $property_id = $_SESSION['last_id'];
         $property->uploadDocuments($property_id, $documentName);
      } else {
         echo "<script>Alert('Documents Upload Failed')</script>";
      }
   }
   echo "<script>Alert('Documents Uploaded Successfully')</script>";
   //header("Location: ../views/dashboard-admin.php");
   echo "<script>window.location.href = '../Views/dashboard-property-owner.php';</script>";
   
}