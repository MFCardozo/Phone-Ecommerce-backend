<?php

$post = file_get_contents('php://input'); // el POST
$secret = $_ENV['API_SECRET']; // Obtener del UI de administración
 
$hmac_req = md5( 'adams' . $post . $secret );
$hmac_rec = @$_SERVER['HTTP_X_ADAMS_NOTIFY_HASH'];
 
if( $hmac_req !== $hmac_rec ){
  die('Validación ha fallado'); // Ignorar esta notificación
}


// Todo OK: Procesar
$data=json_decode($post,true);
error_log( json_encode( $data, JSON_PRETTY_PRINT ), 3, "/tmp/json.txt" );


?>