<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog products object
$products = new Products($db);

$result = $products->read();

$products_arr['data'] = array();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  extract($row);

  $product_item = array(
    'id' => $id,
    'title' => $title,
    'img' => $img,
    'price' => $price,
    'company' => $company,
    'information' => $information
  );

  array_push($products_arr['data'], $product_item);
}
echo json_encode($products_arr);
