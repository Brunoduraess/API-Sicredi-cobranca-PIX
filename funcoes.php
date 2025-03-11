<?php

function geraAccessToken($certFile, $keyFile, $clientId, $clientSecret)
{

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-pix.sicredi.com.br/oauth/token?grant_type=client_credentials&scope=cob.write%20cob.read%20webhook.read%20webhook.write",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Basic " . base64_encode($clientId . ":" . $clientSecret),
            "Content-Type: application/json"
        ],

        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSLCERT => $certFile,
        CURLOPT_SSLKEY => $keyFile
    ]);

    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($httpcode === 200) {
        $data = json_decode($response, true);
        $accessToken = $data['access_token'];
        $result = $accessToken;
    } else {
        $result = "Falha ao gerar token na API sicredi.";
    }

    curl_close($curl);

    return $result;

}
