<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
  require_once '../Controllers/ownerController.php';
  require_once '../Database/database_connection.php'; 
  require_once '../Models/Owner.php';
  require_once '../Models/Admin.php';
  require_once '../Models/Property.php';
  require_once '../Models/Session.php';
  include_once "../Models/Client.php";
  $session = new Session();
  $model = new Owner();
  $property = new Property();
  $myProperties = new Client();
  $Admin = new Admin();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Dashboard - Rental</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css" rel="stylesheet"/>
  </head>