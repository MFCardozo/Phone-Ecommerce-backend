<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding,Origin,X-Requested-width,Accept');
header('Content-type:application/json;charset=utf-8');

$debt_id = isset($_GET['debt-id']) ? $_GET['debt-id'] : die();
echo "working perfect";
?>