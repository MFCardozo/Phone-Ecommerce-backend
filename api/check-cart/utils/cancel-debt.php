<?php
function cancel_debt($api_url,$api_key){

$cancel_Response="";
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
    $cancel_Response="Pay canceled successfully";
    
  } else {
    $cancel_Response= "Cannot canceled your debt,try again";
    
  }
}
else {
  echo 'curl_error: ',curl_error($curl);
}
curl_close($curl);

return $cancel_Response;
}

?>