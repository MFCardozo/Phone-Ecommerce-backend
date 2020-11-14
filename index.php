<?php
header('Access-Control-Allow-Origin: https://ecommerce-client-test.herokuapp.com');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding,Origin,X-Requested-width,Accept');
header('Content-type:application/json;charset=utf-8');

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable( __DIR__);
$dotenv->load();