<?php
    define("CLIENT_ID", "AXb0LrW8QGz5saESgskiuKdnAO9XSE5nCnOEY_1vFRGHWd8ArJrXxSuFUShRtPq7SKP4XE69ibaYXQA7");
    define("APP_SECRET", "EOuNVadeCmprh35m5WBGqqxN6fzmd6hkDKF_jC5HXGR3vWFDn7gKwn-CG3rpdGFEfkZACiVvn4fsK_lL");
    define("BASE_URL", "https://api-m.sandbox.paypal.com");

    $auth = base64_encode(CLIENT_ID . ":" . APP_SECRET);
    $options = array(
        'http' => array(
            'header'  => 
                "Content-Type: application/x-www-form-urlencoded\r\n".
                "Authorization: Basic " . $auth . "\r\n",
            'method'  => 'POST',
            'content' => http_build_query(
                array(
                    "grant_type" => "client_credentials",
                )
            ),
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents(BASE_URL . "/v1/oauth2/token", false, $context);
    if ($result === FALSE) { /* Handle error */ }
    global $accessToken;
    $accessToken = json_decode($result, true)["access_token"];
?>