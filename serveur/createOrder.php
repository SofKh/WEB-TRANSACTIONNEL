<?php
    require_once('includes/paypalApi.inc.php');

    $reponse = array();
    $data = json_decode(file_get_contents('php://input'), true);

    $total = 0;

    foreach($data as $item) {
        $total += $item['quantite'] * floatval($item['produit']['prix']);
    }

    $options = array(
        'http' => array(
            'header'  => 
                "Content-Type: application/json\r\n".
                "Authorization: Bearer " . $accessToken . "\r\n",
            'method'  => 'POST',
            'content' => json_encode(
                array(
                    "intent" => "CAPTURE",
                    "purchase_units" => [
                        array(
                            "amount" => array(
                                "currency_code" => "CAD",
                                "value" => strval($total),
                            )
                        )
                    ]
                )
            ),
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents(BASE_URL . "/v2/checkout/orders", false, $context);
    if ($result === FALSE) { /* Handle error */ }

    echo $result
?>