<?php

require_once 'vendor/autoload.php';

$client = new GuzzleHttp\Client();

$username = 'user1';
$apiKey = '[... key here ...]';

$res = $client->post('http://localhost:8080/user/login', [
    'form_params' => [
        'username' => $username,
        'key' => $apiKey
    ]
]);
$result = json_decode($res->getBody());

if ($result->success == false) {
    die('Oops! '.$result->message);
    var_export($result);
}

// Now make a request with the key
$session = $result->message->session;
$body = '';
$messageHash = hash_hmac('SHA512', $body, $session.time());

$res = $client->post('http://localhost:8080/test', [
    'headers' => [
        'X-Token' => $apiKey,
        'X-Token-Hash' => $messageHash
    ]
]);
var_export((string)$res->getBody());
