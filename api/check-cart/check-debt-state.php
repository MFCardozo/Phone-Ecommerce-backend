<?php

require "./utils/cancel-debt.php";
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding,Origin,X-Requested-width,Accept');
header('Content-type:application/json;charset=utf-8');

$debt_id = isset($_GET['debt-id']) ? $_GET['debt-id'] : die();

$api_url = 'https://staging.adamspay.com/api/v1/debts/' . $debt_id;
$api_key= $_ENV['API_KEY']; //GET ENV

$curl = curl_init();
 
curl_setopt_array($curl,[
 CURLOPT_URL => $api_url,
 CURLOPT_HTTPHEADER => ['apikey: '.$api_key],
 CURLOPT_RETURNTRANSFER => true
 ]);
 
$response = curl_exec($curl);
if( $response ){
  $data = json_decode($response,true);
 
  // Verificar estado de pago
  $debt = isset($data['debt']) ? $data['debt'] : null;
  if( $debt ){
    
    
    $payStatus = $debt['payStatus']['status'];
    
    $isPaid =$payStatus === 'paid';
 
    
    if( $isPaid ){
      
      echo "Thanks for purchasing,we wait for you soon.";
    }
    else {
       $response= cancel_debt($api_url,$api_key);
      echo $response;
    }
 
  } else {
    echo "cannot get the pay status\n";
    print_r($data['meta']);
  }
 
}
else {
  echo 'curl_error: ',curl_error($curl);
}
curl_close($curl);
?>