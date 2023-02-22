<?php

//Checking Set Sessions

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


//Instance of the class


require_once '../Models/Authentication.php';
require_once '../Database/database_connection.php';  
$model = new Authentication();


// gets the post data a user


if(isset($_POST['login'])){
    $email= $_POST['email'];
    $password = $_POST['password'];
    $model->login($email, $password);
    //header("Location: ../views/dashboard-admin.php");
}

//registering a user for the first

if(isset($_POST['register-user'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $email= $_POST['email'];
    $password = $_POST['pass'];
    $con_pass = $_POST['con_pass'];

    if($password !== $con_pass){

      echo "<script>Alert('Passwords don't match')</script>";

    }else{
        $model->validateEmail($email);
        if (empty($_SESSION['email-error'])) {
            $link = "https://realestateio.000webhostapp.com/Real-Estate/authentication/sign-in.php";
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $model->createUser($firstname, $lastname, $email, $phonenumber, $password);
            $subject = "Account Activation";
            $message = "Hi! ".$firstname." ".$lastname."\n\n Thank you for registering with Realestate, Your Password is ".$password." .\n\n follow the Link below to access your profile \n\n ".$link." \n\n Thank you!";
            $sender = "From: support@realestate.com";
            $mail = mail($email, $subject, $message, $sender);
            if($mail){
              echo "<script>Alert('We've sent a confirmation to - $email')</script>";
              //header('location: ../Views/sign-in.php');
              echo "<script>window.location.href = '../authentication/sign-in.php';</script>";
              exit();
            }else{
              echo "<script>Alert('Error sending verification code')</script>";
            }
        }
   }
}

?>