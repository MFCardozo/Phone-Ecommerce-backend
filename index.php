<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: https://ecommerce-client-test.herokuapp.com');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding,Origin,X-Requested-width,Accept');
header('Content-type:application/json;charset=utf-8');

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable( __DIR__);
$dotenv->load();