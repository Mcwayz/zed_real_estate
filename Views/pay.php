<?php 
session_start();
require_once '../Database/database_connection.php'; 
require_once "../Models/Client.php";
$model = new Client();
$id = $_SESSION['id'];
if(empty($_SESSION['client_id']))
{
    $model->getClientID($id);
}else{

    if(isset($_GET['property_id']))
    {
        $email = $_SESSION['email'];
        $name =  $_SESSION['firstname'];
        $property_id = $_GET['property_id'];
        $_SESSION['property_id'] = $property_id;
        $client_id = $_SESSION['client_id'];
        $amount = intval($_GET['price']);
        $_SESSION['amount'] = $amount;

        //* Prepare our rave request
        $request = [
            'tx_ref' => time(),
            'amount' => $amount,
            'currency' => 'ZMW',
            'payment_options' => 'mobile_money_zambia',
            'redirect_url' => 'https://realestateio.000webhostapp.com/Real-Estate/Views/process.php',
            'customer' => [
                'email' => $email,
                'name' =>  $name
            ],
            'meta' => [
                'price' => $amount
            ],
            'customizations' => [
                'title' => 'Real Estate Properties',
                'description' => 'Buy / Rent Property'
            ]
        ];

        //* Call flutterwave endpoint
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($request),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer FLWSECK_TEST-f34980a6e76d6c89e47f1402bcc7f899-X',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $res = json_decode($response);
        if($res->status == 'success')
        {
            $link = $res->data->link;
            header('Location: '.$link);
        }
        else
        {
            echo 'Error: '.$res->message;
            echo 'We can not process your payment';
        }
    }
}

?>