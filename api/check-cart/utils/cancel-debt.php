<?php
function cancel_debt($api_url,$api_key){


$curl = curl_init();
 
curl_setopt_array($curl,[
 CURLOPT_URL => $api_url,
 CURLOPT_HTTPHEADER => ['apikey: '.$api_key],
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_CUSTOMREQUEST=>'DELETE'
 ]);
 
$response = curl_exec($curl);
if( $response ){
  $data = json_decode($response,true);
 
  $debt = isset($data['debt']) ? $data['debt'] : null;
  if( $debt ){
    echo "Pay canceled successfully";
    print_r($debt);
  } else {
    echo "Cannot canceled,try again";
    print_r($data['meta']);
  }
 
}
else {
  echo 'curl_error: ',curl_error($curl);
}
curl_close($curl);


}

?>