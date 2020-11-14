<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

//get parameters ulr

$id_product = isset($_GET['id']) ? $_GET['id'] : die();


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog products object
$products = new Products($db);

$result = $products->read_one($id_product);

$row = $result->fetch(PDO::FETCH_ASSOC);



$product_arr['data'] = array(
    'id' => $row['id'],
    'title' => $row['title'],
    'img' => $row['img'],
    'price' => $row['price'],
    'company' => $row['company'],
    'information' => $row['information']
);

echo json_encode($product_arr);
