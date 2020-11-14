<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-type:application/json");
require_once "../config/apiKeys.php";
echo $api_key;
echo $api_url;
if (isset($_POST['checkCart']) && isset($_POST['checkTotal'])) {
    $cart_raw = $_POST['checkCart'];
    $debt = $_POST['checkTotal'];

    //the true 2d arg allow to use as an array
    $cart_info = json_decode($cart_raw, true);


    $label = '';
    $id_debt = 'deuda';

    $comma_counter = 1;

    foreach ($cart_info as $product) {

        $comma = count($cart_info) > $comma_counter ? "," : "";

        $label = $label . $product['title'] . $comma;

        $id_debt = $id_debt . strval($product['id']);

        $comma_counter++;
    }



    /*-----create debt-----*/
    $now = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    $end = $now->add(new DateInterval('P3D'));

    //model of debt
    $debt = [
        'docId' => $id_debt,
        'label' => $label,
        'amount' => ['currency' => 'PYG', 'value' => $debt],
        'validPeriod' => [
            'start' => $now->format(DateTime::ATOM),
            'end' => $end->format(DateTime::ATOM)
        ]
    ];

    //create JSON for post
    $post = json_encode(['debt' => $debt]);

    //make post
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_HTTPHEADER => ['apikey: ' . $apiKey, 'Content-Type: application/json'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $post
    ]);

    $response = curl_exec($curl);


    if ($response) {
        $data = json_decode($response, true);



        $payUrl = isset($data['debt']) ? $data['debt']['payUrl'] : null;

        if ($payUrl) {
            echo json_encode($data = array(
                'status' => "Deuda creada exitosamente",
                'url' => $payUrl

            ));
        } else {
            echo json_encode($data = array(
                'status' => "No se pudo crear la deuda",
                'error' => $data['meta']
            ));
        }
    } else {

        echo 'curl_error: ', curl_error($curl);
    }

    curl_close($curl);
} else {

    die();
}
