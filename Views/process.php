<?php
session_start();
require_once '../Database/database_connection.php'; 
require_once "../Models/Client.php";
$model = new Client();
if(isset($_GET['status']))
    {
        //* check payment status
        if($_GET['status'] == 'cancelled')
        {
            echo"<script>alert('Transaction Cancelled')</script>";
            echo"<script>window.location.href='dashboard-client.php';</script>";
        }
        elseif($_GET['status'] == 'successful')
        {
            $txid = $_GET['transaction_id'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/json",
                  "Authorization: Bearer FLWSECK_TEST-f34980a6e76d6c89e47f1402bcc7f899-X"
                ),
              ));
              
              $response = curl_exec($curl);
              
              curl_close($curl);
              
              $res = json_decode($response);
              if($res->status)
              {
                  echo 'Payment successful';
                  //* Continue to give item to the user
                  $email = $_SESSION['email'];
                  $name =  $_SESSION['firstname']." ".$_SESSION['lastname'];
                  $property_id = $_SESSION['property_id'];
                  $amount = $_SESSION['amount'];
                  $client_id = $_SESSION['client_id'];
                  $_SESSION['tx_id'] = $txid;
                  $text = $txid;
                  $model->saveTransaction($text, $property_id, $client_id, $amount);
                  echo"<script>window.location.href='dashboard-client.php';</script>";
              }
              else
              {
                echo"<script>alert('Transaction Failed')</script>";
                echo"<script>window.location.href='dashboard-client.php';</script>";
              }
        }
    
    }